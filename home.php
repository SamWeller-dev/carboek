<?php
require 'db.php';

session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header('location: login.php');
    exit();
}

$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($searchTerm) {
    $queryAuto = $pdo->prepare("
        SELECT auto_model.id AS model_id, model, kenteken, foto_auto, waarde, auto_merk.merk, auto_merk.id AS merk_id
        FROM auto_model
        LEFT JOIN auto_merk
        ON auto_model.merk_id = auto_merk.id
        WHERE model LIKE :search OR auto_merk.merk LIKE :search
        ORDER BY auto_merk.merk, model
    ");
    $queryAuto->bindValue(':search', '%' . $searchTerm . '%');
} else {
    $queryAuto = $pdo->prepare("
    SELECT auto_model.id AS model_id, model, kenteken, foto_auto, waarde, auto_merk.merk, auto_merk.id AS merk_id
    FROM auto_model
    LEFT JOIN auto_merk
    ON auto_model.merk_id = auto_merk.id
    ORDER BY auto_merk.merk, model
    ");
}

$queryAuto->execute();
$row = $queryAuto->fetchALL(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="all">

        <div class="nav-bar">
            <h3><a href="home.php">Home page</a></h3>
            <h3><a href="search.php">Search</a></h3>
            <h3><a href="profile.php">profile</a></h3>
        </div>

        <form class="zoeken" method="GET" action="">
            <input class="search_row" type="text" name="search" id="search" placeholder="Zoeken" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">Zoek</button>
        </form>

        <div class="koopje">
            <?php
            if (!empty($row)) {
                foreach ($row as $model) {
                    echo
                    '<a href="detail_model.php?id=' . urlencode($model['model_id']) . '">
                        <div class="container">
                            <img class="autoMerk" src="' . $model['foto_auto'] . '" alt="">
                            <div class="homemerk">
                                <p>Merk: </p>
                                <p>' . $model['merk'] . '</p>
                            </div>
                            <div class="homemodel">
                                <p>Model: </p>
                                <p>' . $model['model'] . '</p>
                            </div>
                            <div class="homemodel">
                                <p>' . "€" . $model['waarde'] . '</p>
                            </div>
                        </div>
                    </a>';
                }
            } else {
                echo '<p class="Gresultaat">"Geen resultaten gevonden voor"' . ($searchTerm) . '".</p>';
            }
            ?>
        </div>

    </div>
</body>

</html>