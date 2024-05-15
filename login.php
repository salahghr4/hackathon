<?php 
// Initialize sessions
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["isLogged"]) && $_SESSION["isLogged"] === true){
    header("location: dashboard.php");
    exit;
}

// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$username = $password = '';

// Process submitted form data
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // validation of username and email with regular expression
    if (!preg_match('/^[a-zA-Z0-9_]+$/u', $_POST['username'])) {
        // Display error message
        $errors['username'] = 'Please enter a valid username.';
    } else {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (!preg_match('/^[a-zA-Z0-9!@#?]+$/u', $_POST['password'])) {
        $errors['password'] = 'Please enter a valid password.';
    } else {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // if it was no errors check the user in database
    if (empty($errors)) {
        try {

          $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
          $stmt->execute([$username]);
          $user = $stmt->fetch();

          // Check if username exists and Verify his password
          if ($user && password_verify($password, $user['password'])) {

            session_start();
            $_SESSION["isLogged"] = true;
            $_SESSION['userId'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('location: dashboard.php');  

          } else {

            $errors['loginState'] = "Sorry we can't find this account. try again";
          }
        } catch (PDOException $e) {
          echo 'error :' . $e->getMessage();
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/7751476fd8.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <title>Log in to your dashboard</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p><i class="fas fa-infinity"></i>Anime</p>
        </div>
        <div class="nav-button">
            <a href="register.php" class="actionBtn">Register</a>
        </div>
    </nav>


    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="form-box">

        <h2>Login</h2>

        <?php if (isset($errors['loginState'])): ?>
            <div class="alert alert-warning" role="alert">
                <strong><?= $errors['loginState'] ?></strong>
            </div>
        <?php endif; ?>

        <div class="input-box">
            <input type="text" class="input-field" placeholder="Username " name="username" value='<?= $username; ?>' >
            <i class="bx bx-user"></i>
            <span class='errorMsj'><?= isset($errors['username']) ? $errors['username'] : '' ?></span>
        </div>

        <div class="input-box">
            <input type="password" class="input-field" placeholder="Password" name="password" value='<?= $password; ?>'>
            <i class="bx bx-lock-alt"></i>
            <span class='errorMsj'><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
        </div>

        <div class="input-box">
            <input type="submit" class="submit" value="Sign In">
        </div>
        
        <div class="footer">
            <span>Don't have an account? <a href="register.php">Sign Up</a></span>
        </div>
    </form>
</div>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>