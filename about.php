<?php
require_once 'app/helpers.php';
$userAuth = user_auth();
$page_title = 'About US'
?>
<?php include 'tpl/header.php';?>
<main>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5">
        <h1 class="display-4">About Us</h1>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam, inventore!Lorem ipsum dolor sit, amet
          consectetur adipisicing elit. Magnam, inventore!Lorem ipsum dolor sit, amet consectetur adipisicing elit.
          Magnam, inventore!</p>
      </div>
    </div>
  </div>
</main>
<?php include 'tpl/footer.php';?>