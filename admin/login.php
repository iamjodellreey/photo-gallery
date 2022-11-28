<?php
ob_start();
require_once("includes/init.php");

if ($session->isSignedIn()) {
    redirect("index.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = User::verifyUser($username, $password);

    if ($user) {
        $session->login($user);
        redirect("index.php");
    } else {
        //FIX ME: Need to add validation message when username or password is incorrect
        $errorMsg = "Username or Password is incorrect!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Photo Gallery</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-gradient-primary">
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-12 col-xl-12">
                        <div class="card shadow-lg o-hidden border-0 my-5">
                            <div class="card-body p-0">
                                <section class="login-clean">
                                    <form action="" method="POST">
                                        <input type="hidden" name="_token" value="k7lftumFEluuLCZ8j5Etvt2upO9fbstjIipqSd0g">
                                        <div class="illustration">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control " type="text" name="username" placeholder="Username" autocomplete="username" autofocus required>
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control " type="password" name="password" placeholder="Password" autocomplete="current-password" required>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary btn-block w-100" name="submit">Log in</button>
                                        </div>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
