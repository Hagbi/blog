<?php

require_once 'dbconfig.php';

if (!function_exists('old')) {
/**
 *
 * Keep value from field.
 *
 * @param   string $fn The filed name to keep value to
 * @return  string
 *
 */
    function old($fn)
    {
        return $_REQUEST[$fn] ?? '';
    }

}

if (!function_exists('crsf_token')) {
    /**
     *
     * Generate a random string and store in session.
     * @return  string
     *
     */
    function crsf_token()
    {
        $token = sha1(rand(1, 1000) . '$$blog');
        $_SESSION['token'] = $token;
        return $token;
    }

}

if (!function_exists('user_auth')) {

/**
 *
 * Client authorization
 *
 * @return   bool
 *
 */
    function user_auth()
    {

        session_start();
        $auth = false;

        if (isset($_SESSION['uid'])) {
            if (isset($_SESSION['uip']) && $_SERVER['REMOTE_ADDR'] == $_SESSION['uip']) {
                if (isset($_SESSION['uagent']) && $_SERVER['HTTP_USER_AGENT'] == $_SESSION['uagent']) {
                    $auth = true;

                }

            }
        }
        return $auth;
    }
}

if (!function_exists('email_exist')) {

    /**
     *
     * Check if mail is exist.
     *
     * @param    object  $link The connection
     * @param    string  $email The email to check for
     * @return   boolean
     *
     */
    function email_exist($link, $email)
    {

        $exist = false;
        $sql = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result) > 0) {

            $exist = true;

        }

        return $exist;

    }

}
