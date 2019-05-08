<?php

require_once 'app/helpers.php';
$userAuth = user_auth();

if ($userAuth) {

    header('location: blog.php');
    exit;

}
$errors = [
    'name' => '',
    'email' => '',
    'password' => '',
    'image' => '',
];

if (isset($_POST['submit'])) {

    if (isset($_POST['token']) && isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
        mysqli_query($link, "SET NAMES utf8");
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        $name = mysqli_real_escape_string($link, $name);
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
        $email = mysqli_real_escape_string($link, $email);
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $password = mysqli_real_escape_string($link, $password);
        $profile_image = date('Y.m.d.H.m.i.u') . '-' . $_FILES['image']['name'];
        $formValid = true;

        if (!$name || mb_strlen($name) < 2 || mb_strlen($name) > 255) {

            $errors['name'] = '* Name is required for at least 2 - 255 characters';
            $formValid = false;

        }

        if (!$email) {
            $errors['email'] = '* A valid email is required';
            $formValid = false;
        } elseif (email_exist($link, $email)) {
            $errors['email'] = '* This email is taken';
            $formValid = false;
        }

        if (!$password || strlen($password) < 6 || strlen($password) > 20) {

            $errors['password'] = '* Password is required for at least 6 - 20 characters';
            $formValid = false;

        }

        if (($formValid) && isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {

            $max_size = 1024 * 1024 * 5;
            $ex = ['png', 'jpeg', 'jpg', 'gif', 'bmp'];

            if (isset($_FILES['image']['size']) && $_FILES['image']['size'] <= $max_size) {

                $fileInfo = pathinfo($_FILES['image']['name']);

                if (in_array(strtolower($fileInfo['extension']), $ex)) {

                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

                        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $profile_image);

                    }

                } else {

                    $errors['image'] = '* you can upload only jpg , jpeg , png ,bmp , gif extension file';
                    $formValid = false;

                }

            } else {

                $errors['image'] = '* You cannot upload a file larger than 5MB';
                $formValid = false;

            }

        } else {

            $profile_image = 'default_profile.png';
        }

        if ($formValid) {

            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users VALUES(null,'$name','$email','$password','$profile_image')";
            $result = mysqli_query($link, $sql);

            if ($result && mysqli_affected_rows($link) == 1) {

                $_SESSION['uid'] = mysqli_insert_id($link);
                $_SESSION['uname'] = $name;
                $_SESSION['uip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['uagent'] = $_SERVER['HTTP_USER_AGENT'];
                header('location: blog.php');

            }

        }

    }

    $token = crsf_token();
} else {

    $token = crsf_token();
}

$page_title = 'Signup Page';

?>

<?php include 'tpl/header.php';?>

<main>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5">
        <h1 class="display-4">Sign Up a new account</h1>

      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-5">
        <form action="" method="POST" novalidate="novalidate" enctype="multipart/form-data" autocomplete="off">
          <input type="hidden" name="token" value="<?=$token;?>">
          <div class="form-group">
            <label for="name">Name:</label>
            <input value="<?=old('name');?>" type="text" name="name" id="name" class="form-control">
            <span class="text-danger"><?=$errors['name'];?></span>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input value="<?=old('email');?>" type="email" name="email" id="email" class="form-control">
            <span class="text-danger"><?=$errors['email'];?></span>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control">
            <span class="text-danger"><?=$errors['password'];?></span>
          </div>
          <div class="form-group">
            <label for="image">Profile Image:</label>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="image" name="image"
                aria-describedby="inputGroupFileAddon01">
              <label class="custom-file-label" for="inputGroupFile01">

              </label>
            </div>
          </div>
          <div class="form-group">
            <span class="text-danger"><?=$errors['image'];?></span>
          </div>
          <button type="submit" name="submit" class="btn btn-primary bg-primary"><i class="fas fa-sign-in-alt"></i>
            Sign Up</button>
        </form>
      </div>
    </div>
  </div>
</main>

<?php include 'tpl/footer.php';?>