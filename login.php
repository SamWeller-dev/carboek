<?php

require 'db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    if ($username === '' || $wachtwoord === '') {
        $error = 'Vul zowel gebruikersnaam als wachtwoord in.';
    } else {
        $Stmt = $pdo->prepare("SELECT * FROM gebruikers WHERE username = :username");
        $Stmt->execute([':username' => $username]);
        $user = $Stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($wachtwoord, $user['wachtwoord'])) {
            $_SESSION['loggedInUser'] = $user['id'];
            header('location: home.php');
            exit();
        } else {
            $error = "gebruikersnaam/wachtwoord combinatie onjuist";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="body_login">
    <form action="login.php" method="POST">
        <div class="login-page">
            <h2>Login Pagina</h2>
            <div class="username">
                <input class="inputveld" type="text" name="username" id="username" placeholder="gebruikersnaam">
            </div>
            <div class="wachtwoord">
                <input class="inputveld" type="password" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord">
            </div>

            <?php if (!empty($error)): ?>
                <p class="error-message"><?= ($error) ?></p>
            <?php endif; ?>

            <button type="submit" name="login" class="login">Login</button>
            <a href="registreren.php">
                <p>nog geen account?</p>
            </a>
        </div>
    </form>
</body>

</html>