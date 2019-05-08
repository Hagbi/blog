<?php
require_once 'app/helpers.php';
$userAuth = user_auth();

$page_title = 'Blog Page';
$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
mysqli_query($link, "set NAMES utf8");
$sql = "SELECT u.name ,u.profile_image,p.*,DATE_FORMAT(p.date, '%d/%m/%Y  %H:%i:%s') pdate FROM posts p JOIN users u ON u.id = p.user_id ORDER BY p.date DESC";
$result = mysqli_query($link, $sql);

?>
<?php include 'tpl/header.php';?>
<main>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5">
        <h1 class="display-4">Blog Posts</h1>
        <p class="mt-4">
          <?php if ($userAuth): ?>
          <a href="add_post.php" class="btn btn-primary btn-lg "><i class="fas fa-plus mr-3"></i> Add
            Your Post</a>
          <?php else: ?>
          <a href="signup.php" class="btn btn-primary btn-lg "><i class="fas fa-user-plus mr-3"></i> Sign Up</a>
          <?php endif;?>
        </p>
      </div>
    </div>
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
    <div class="row">
      <?php while ($post = mysqli_fetch_assoc($result)): ?>
      <div class="col-12 my-3">
        <div class="card">
          <div class="card-header">
            <h5 class="justify-content-between">
              <img class="rounded-circle img-thumbnail" width="30" src="images/<?=$post['profile_image'];?>" alt="">
              <?=htmlentities($post['name']);?>


              <span class="float-right"><?=$post['pdate'];?></span>
              <span  class="btn btn-primary "><form action="#" method="POST">
   <input  class="btn btn-primary" type="submit" name="like<?=$post['id'];?>" value = "<?=$post['likes'];?>"/><i class="fas fa-thumbs-up"></i></i></i>
</form></span>
<?php if (isset($_POST['like' . $post['id']])):
    $postId = $post['id'];
    $sql1 = "UPDATE posts set likes = likes+1 where id = $postId";
    $result1 = mysqli_query($link, $sql1);?>
																																	<?php endif;?>
            </h5>
          </div>
          <div class="card-body">
            <h6><?=htmlentities($post['title']);?></h6>
            <p><?=htmlentities($post['article']);?></p>
            <?php if (isset($_SESSION['uid'])): ?>
            <?php if ($_SESSION['uid'] == $post['user_id']): ?>
            <ul class="navbar-nav float-right">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-h"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="edit_post.php?pid=<?=$post['id'];?>"><i class="fas fa-pen"></i>
                    Edit</a>
                  <a class="dropdown-item delete-post-btn" href="delete_post.php?pid=<?=$post['id'];?>"><i
                      class="fas fa-eraser"></i> Delete</a>
                </div>
              </li>
            </ul>
            <?php endif;?>
            <?php endif;?>
          </div>
        </div>
      </div>
      <?php endwhile;?>
    </div>
    <?php endif;?>
  </div>
</main>
<?php include 'tpl/footer.php';?>