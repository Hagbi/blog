<?php

require_once 'app/helpers.php';
$userAuth = user_auth();

if (!$userAuth) {

    header('location:signin.php');
    exit;

}

$errors = [
    'title' => '',
    'article' => '',
];

$page_title = 'Add New Post';

if (isset($_POST['submit'])) {

    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $article = trim(filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $isForomValid = true;

    if (!$title || mb_strlen($title) < 2) {

        $errors['title'] = '* Title is required for at least 2 character';
        $isForomValid = false;

    }

    if (!$article || mb_strlen($article) < 3) {

        $errors['article'] = '* Article is required for at least 2 character';
        $isForomValid = false;

    }

    if ($isForomValid) {

        $uid = $_SESSION['uid'];
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
        mysqli_query($link, "set NAMES utf8");
        // mysql_set_charset($link,'utf8');
        $title = mysqli_real_escape_string($link, $title);
        $article = mysqli_real_escape_string($link, $article);
        $sql = "INSERT INTO posts VALUE (null,$uid,'$title','$article',NOW())";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_affected_rows($link) > 0) {
            header('location: blog.php');
        }

    }

}

?>

<?php include 'tpl/header.php';?>

<main>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5">
        <h1 class="display-4">Add Your Post Here</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mt-5">
        <form action="" method="POST" novalidate="novalidate" autocomplete="off">
          <div class="form-group">
            <label for="title"><span class="text-danger">*</span> Title</label>
            <input value="<?=old('title')?>" class="form-control" type="text" name="title" id="title">
            <span class="text-danger"><?=$errors['title']?></span>
          </div>
          <div class="form-group">
            <label for="article"><span class="text-danger">*</span> Article</label>
            <textarea name="article" id="article" cols="30" rows="10"
              class="form-control"><?=old('article')?></textarea>
            <span class="text-danger"><?=$errors['article']?></span>
          </div>
          <input class="btn btn-primary" type="submit" name="submit" value="Save">
          <a href="blog.php" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
</main>
<?php include 'tpl/footer.php';?>