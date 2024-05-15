<?php
// Start sessions
session_start();

// Remove all session variables.
session_unset();

// If you want to completely destroy the session, also delete The session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0,
        $params["path"], $params["domain"],
        $params["secure"], isset($params['httponly'])
    );
}

// Destroy all session related to user
session_destroy();

// Redirect to login page
header('location: login.php');
exit;
