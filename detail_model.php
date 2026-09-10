<?php
require 'db.php';
session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <a class="een" href="home.php">Terug</a>

    <?php

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$id) {
        echo '<p>No ID provided in the URL.</p>';
        exit;
    }

    $Stmt = $pdo->prepare("SELECT auto_model.id AS model_id, auto_model.foto_auto, auto_model.model, auto_model.optrekken_seconde, auto_model.jaar, auto_model.kenteken, auto_model.tank, auto_model.waarde, auto_model.merk_id, auto_merk.merk FROM auto_model LEFT JOIN auto_merk ON auto_model.merk_id = auto_merk.id WHERE auto_model.id = :model_id");
    $Stmt->execute(['model_id' => $id]);
    $Data1 = $Stmt->fetch(PDO::FETCH_ASSOC);

    if ($Data1) {
        $fieldsToDisplay = ['merk', 'model', 'optrekken_seconde', 'jaar', 'kenteken', 'tank', 'waarde'];
        echo '<table class="content">
              <h1>' . htmlspecialchars($Data1['merk']) . '</h1>
              <img class="autoModel" src="' . htmlspecialchars($Data1['foto_auto']) . '" alt="">';

        foreach ($fieldsToDisplay as $field) {
            echo '<tr>
                  <td>' . htmlspecialchars($field) . '</td>
                  <td>' . htmlspecialchars($Data1[$field]) . '</td>
                  </tr>';
        }
        echo '<form action="verlanglijst_toevoegen.php" method="POST">
            <input type="hidden" name="auto_ID" value="' . htmlspecialchars($Data1['model_id']) . '">
            <button type="submit">Voeg toe aan verlanglijst</button>
            </form>';
        echo '</table>';
    } else {
        echo '<p>No data found for ID: ' . ($id) . '</p>';
    }
    ?>

</body>

</html>