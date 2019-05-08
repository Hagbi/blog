<?php

require_once 'app/helpers.php';
$userAuth = user_auth();

if (!$userAuth) {

    header('location: signin.php');
    exit;

}

$errors = [
    'title' => '',
    'article' => '',
];

$page_title = 'Edit Post';
$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
mysqli_query($link, "SET NAMES utf8");

$pid = $_GET['pid'] ?? null;
$uid = $_SESSION['uid'];

if ($pid && is_numeric($pid)) {

    $pid = mysqli_real_escape_string($link, $pid);
    $sql = "SELECT * FROM posts WHERE id = $pid AND user_id = $uid";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) == 1) {

        $post = mysqli_fetch_assoc($result);

    } else {
        header('location: logout.php');
        exit;
    }

} else {
    header('location: logout.php');
    exit;
}

if (isset($_POST['submit'])) {

    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $article = trim(filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $isFormValid = true;

    if (!$title || mb_strlen($title) < 2) {

        $errors['title'] = '* Title is required for at least 2 characters';
        $isFormValid = false;

    }

    if (!$article || mb_strlen($article) < 3) {

        $errors['article'] = '* Article is required for at least 3 characters';
        $isFormValid = false;

    }

    if ($isFormValid) {

        $uid = $_SESSION['uid'];
        //mysqli_set_charset($link, 'utf8');
        $title = mysqli_real_escape_string($link, $title);
        $article = mysqli_real_escape_string($link, $article);
        $sql = "UPDATE posts SET title = '$title',article = '$article' WHERE id = $pid";
        $result = mysqli_query($link, $sql);

        if ($result) {
            header('location: blog.php');
        }

    }

}

?>

<?php include 'tpl/header.php'?>
<main>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5">
        <h1 class="display-4">Edit this post</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mt-5">
        <form action="" method="POST" autocomplete="off" novalidate="novalidate">
          <div class="form-group">
            <label for="title"><span class="text-danger">*</span> Title</label>
            <input type="text" value="<?=$post['title'];?>" name="title" id="title" class="form-control">
            <span class="text-danger"><?=$errors['title'];?></span>
          </div>
          <div class="form-group">
            <label for="article"><span class="text-danger">*</span> Article</label>
            <textarea name="article" id="article" cols="30" rows="10"
              class="form-control"><?=$post['article'];?></textarea>
            <span class="text-danger"><?=$errors['article'];?></span>
          </div>
          <input name="submit" type="submit" value="Save" class="btn btn-primary">
          <a href="blog.php" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</main>
<?php include 'tpl/footer.php'?>