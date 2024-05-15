<?php 
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";

// Process submitted form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // validation of username, email and confirmation password
    if (!preg_match('/^[a-zA-Z0-9_]+$/u', $_POST['username'])) {
        // Display error message
        $errors['username'] = 'Please enter a valid username.';
    } else {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (!preg_match('/^[a-zA-Z0-9!@#?]+$/u', $_POST['password']) ) {
        $errors['password'] = 'Please enter a valid and strong password.';
    } else {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if(empty($_POST['confirm_password']) || $password != $_POST['confirm_password']){
        $errors['confirm_password'] = "Passwords did not match.";
    } else {
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    

    // if it was no errors insert the user in database
    if(empty($errors)) {
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
        try {

            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $passwordhash]);
            header('Location: login.php');

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Duplicate entry error
                $errors['registrationState'] = "Sorry username already exist. choose another one";
            } else {
                echo 'error :' . $e->getMessage();
            }
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
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Register and save your time searching for animes</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p><i class="fas fa-infinity"></i>Anime</p>
        </div>
        <div class="nav-button">
        <div class="nav-button">
            <a href="login.php" class="actionBtn">Log in</a>
        </div>
        </div>
    </nav>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="form-box">

        <h2>Register</h2>

        <?php if (isset($errors['registrationState'])): ?>
            <div class="alert alert-warning" role="alert">
                <strong><?= $errors['registrationState'] ?></strong>
            </div>
        <?php endif; ?>
        
        <div class="input-box">
            <input type="text" class="input-field" placeholder="Username " name="username" value='<?= $username; ?>'>
            <i class="bx bx-user"></i>
            <span class='errorMsj'><?= isset($errors['username']) ? $errors['username'] : '' ?></span>
        </div>

        <div class="input-box">
            <input type="password" class="input-field" placeholder="Password" name="password" value='<?= $password; ?>'>
            <i class="bx bx-lock-alt"></i>
            <span class='errorMsj'><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
        </div>

        <div class="input-box">
            <input type="password" class="input-field" placeholder="Reset your password" name="confirm_password" value='<?= $confirm_password; ?>'>
            <i class="bx bx-lock-alt"></i>
            <span class='errorMsj'><?= isset($errors['confirm_password']) ? $errors['confirm_password'] : '' ?></span>
        </div>

        <div class="input-box">
            <input type="submit" class="submit" value="Sign Un">
        </div>
        <div class="footer">
            <span>Already have an account? <a href="login.php">Sign in</a></span>
        </div>
    </form>
</div>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>