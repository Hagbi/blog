<?php

require_once 'app/helpers.php';
$userAuth = user_auth();

if ($userAuth) {

    header('location: blog.php');
    exit;

}

$error = '';

if (isset($_POST['submit'])) { //אם הגולש לחץ על הכפתור

    if (isset($_POST['token']) && isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

//איסוף נתונים לתוך משתנים
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

        if (!$email) { //ולידציה על האימייל

            $error = ' * A valid Email is required';

        } elseif (!$password) { //ולידציה על הסיסמא

            $error = ' * Please enter your password';

        } else {

            $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
            $email = mysqli_real_escape_string($link, $email);
            $password = mysqli_real_escape_string($link, $password);
            $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($link, $sql);

            if ($result && mysqli_num_rows($result) == 1) {

                $user = mysqli_fetch_assoc($result);

                if (password_verify($password, $user['password'])) {
                    $_SESSION['profile_image'] = $user['profile_image'];
                    $_SESSION['uid'] = $user['id'];
                    $_SESSION['uname'] = $user['name'];
                    $_SESSION['uip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['uagent'] = $_SERVER['HTTP_USER_AGENT'];
                    header('location:blog.php');
                } else {

                    $error = ' * Wrong email or password ...';

                }

            } else {

                $error = ' * Wrong email or password ...';

            }

        }

    }
    $token = crsf_token();
} else {

    $token = crsf_token();
}
$page_title = 'Sign in page';

?>

<?php include 'tpl/header.php';?>

<main>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5">
        <h1 class="display-4">Signin with your account</h1>
        <p>Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet.Lorem ipsum dolor sitLorem
          ipsum dolor sit amet.Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet.
          amet.Lorem ipsum dolor sit amet.</p>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-5">
        <form action="" method="POST" novalidate="novalidate" autocomplete="off">
          <input type="hidden" name="token" value="<?=$token;?>">
          <div class="form-group">
            <label class="label" for="email">Email:</label>
            <input value="<?=old('email')?> " class="form-control" type="email" name="email" id="email">
          </div>
          <div class="form-group">
            <label class="label" for="password">Password:</label>
            <input class="form-control" type="password" name="password" id="password">
          </div>
          <button type="submit" name="submit" class="btn btn-primary bg-primary"><i class="fas fa-sign-in-alt"></i>
            Sign In</button><span class="text-danger"><?=$error?></span>
        </form>
      </div>
    </div>
  </div>
</main>

<?php include 'tpl/footer.php';?>