<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">


  <!-- BootStrap -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS -->

  <link rel="stylesheet" href="css\style.css">

  <title>Blog | <?=$page_title?></title>


</head>

<body>
  <!-- header -->

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
      <div class="container">
        <a class="navbar-brand text-white" href="./"><i class="fas fa-utensils fa-2x"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-hamburger text-white fa-2x"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link text-white" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="blog.php">Blog</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <?php if (!$userAuth): ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="signin.php">Sign In</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="signup.php">Sign Up</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="edit_profile.php?pid=<?=$_SESSION['uid'];?>"><img src="images/<?=$_SESSION['profile_image'];?>"alt="" class="rounded-circle img-thumbnail"  width="35"></a>
            </li><li class="nav-item">
              <a class="nav-link text-white" href="edit_profile.php?pid=<?=$_SESSION['uid'];?>"><b><?=htmlentities($_SESSION['uname']);?></B></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="logout.php">Logout</a>
            </li>
            <?php endif;?>
          </ul>

        </div>
      </div>
    </nav>
  </header>