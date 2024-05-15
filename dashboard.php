<?php
session_start();
// check if there's no user session  
if(empty($_SESSION["isLogged"])){
    header("location: login.php");
    exit;
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
    <title>Dashboard</title>
</head>
<style>
    h1,h5 {
        color: #fff;
        margin-bottom: 40px;
    }
    span {
        color: aqua;
    }
</style>
<body>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <p><i class="fas fa-infinity"></i>Anime</p>
            </div>
            <div class="nav-button">
                <a href="logout.php" class="actionBtn">Log out</a>
            </div>
        </nav>

        <div class="container row">
            <h1 class='text-center'>Welcome <span><?= $_SESSION['username']?></span> to your dashboard</h1>
            <h5 class='text-center'>Here are your list of anime</h5>
            <table class="table table-striped table-hover border rounded-circle">
                <thead>
                    <tr>
                        <th>Anime name</th>
                        <th>Genre</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'>
                    <tr>
                        <td>One piece</td>
                        <td>Action, Adventure, Fantasy</td>
                        <td>8.72</td>
                        <td>
                            <button class="btn btn-outline-warning">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Attack on Titan</td>
                        <td>Action, Award Winning, Drama, Suspense</td>
                        <td>8.55</td>
                        <td>
                            <button class="btn btn-outline-warning">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>HUNTER×HUNTER</td>
                        <td>Action, Adventure, Fantasy</td>
                        <td>9.04</td>
                        <td>
                            <button class="btn btn-outline-warning">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class='text-center'><a href="#" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Explore our anime</a></p>
        </div>
    </div>


<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>