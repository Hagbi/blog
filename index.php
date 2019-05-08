<?php
require_once 'app/helpers.php';
$userAuth = user_auth();
$page_title = 'Home Page';
$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
mysqli_query($link, "set NAMES utf8");
$sql = "SELECT u.name ,u.profile_image,p.*,DATE_FORMAT(p.date, '%d/%m/%Y  %H:%i:%s') pdate FROM posts p JOIN users u ON u.id = p.user_id ORDER BY p.date DESC";

$result = mysqli_query($link, $sql);
$post = mysqli_fetch_assoc($result)
?>

<?php include 'tpl/header.php';?>
<!-- main -->
<main>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5 text-center">
        <h1 class="display-4 text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </h1>
        <p class="text-center">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Architecto possimus, numquam asperiores </p>
        <p><a class="btn btn-primary btn-lg mt-3" href="signin.php">start post</a></p>
      </div>
    </div>
    <div class="container">

  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2500">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
    <div class="col-md-12 mt-3 ">
    <div class="card">
          <div class="card-header">
            <h5>
              <img class="rounded-circle img-thumbnail" width="30" src="images/<?=$post['profile_image'];?>" alt="">
              <?=htmlentities($post['name']);?>
              <span class="float-right"><?=$post['pdate'];?></span>
            </h5>
          </div>
          <div class="card-body">
            <h6><?=htmlentities($post['title']);?></h6>
            <p><?=htmlentities($post['article']);?></p>

                </div>
              </li>
            </ul>

          </div>
      </div>
    </div>
    <?php if ($result && mysqli_num_rows($result) > 0): ?>

      <?php while ($post = mysqli_fetch_assoc($result)): ?>
      <div class="carousel-item">
      <div class="col-12 my-3">
        <div class="card">
          <div class="card-header">
            <h5>
              <img class="rounded-circle img-thumbnail" width="30" src="images/<?=$post['profile_image'];?>" alt="">
              <?=htmlentities($post['name']);?>
              <span class="float-right"><?=$post['pdate'];?></span>
            </h5>
          </div>
          <div class="card-body">
            <h6><?=htmlentities($post['title']);?></h6>
            <p><?=htmlentities($post['article']);?></p>

                </div>
              </li>
            </ul>

          </div>
        </div>
      </div>
      <?php endwhile;?>
    </div>
    <?php endif;?>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

</div>


  </div>
</main>
<?php include 'tpl/footer.php';?>