<?php

require 'db.php';

session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header('location: login.php');
    exit();
}

$sql = "SELECT merk, id
        FROM auto_merk";
$stmt = $pdo->query($sql);
$merken = $stmt->fetchAll();

$error = '';
$success = false;

if (isset($_POST['opslaan'])) {
    $merk = $_POST['merk_id'];
    $model = $_POST['model'];
    $optrekken_seconde = $_POST['optrekken_seconde'];
    $jaar = $_POST['jaar'];
    $tank = $_POST['tank'];
    $waarde = $_POST['waarde'];
    $kenteken = $_POST['kenteken'];

    if (isset($_FILES['foto_auto']) && $_FILES['foto_auto']['error'] == 0) {
        $foto = $_FILES['foto_auto'];
        $foto_naam = $foto['name'];
        $foto_tmp_naam = $foto['tmp_name'];
        $foto_type = $foto['type'];
        $foto_size = $foto['size'];

        $doelmap = 'images/';

        $unieke_foto_naam = uniqid() . '-' . basename($foto_naam);
        $doel_bestand = $doelmap . $unieke_foto_naam;

        $extensie = pathinfo($foto_naam, PATHINFO_EXTENSION);
        $toegestane_extensies = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($extensie), $toegestane_extensies)) {
            if (move_uploaded_file($foto_tmp_naam, $doel_bestand)) {
                $foto_pad = $doel_bestand; // Of gebruik de bestandsnaam ($unieke_foto_naam)
            } else {
                $error = "Fout bij het uploaden van de foto.";
            }
        } else {
            $error = "Ongeldig bestandstype. Alleen JPG, PNG, en GIF zijn toegestaan.";
        }
    } else {
        $error = "Geen foto geüpload.";
    }

    if (empty($error)) {
        $query = "INSERT INTO auto_model (foto_auto, merk_id, model, optrekken_seconde, jaar, tank, waarde, kenteken)
                  VALUES (:foto_auto, :merk_id, :model, :optrekken_seconde, :jaar, :tank, :waarde, :kenteken)";
        $query_run = $pdo->prepare($query);

        $Data = [
            ':foto_auto' => $foto_pad,
            ':merk_id' => $merk,
            ':model' => $model,
            ':optrekken_seconde' => $optrekken_seconde,
            ':jaar' => $jaar,
            ':tank' => $tank,
            ':waarde' => $waarde,
            ':kenteken' => $kenteken,
        ];

        $query_execute = $query_run->execute($Data);

        if ($query_execute) {
            $success = true;
            header('Location: profile.php');
            exit(0);
        } else {
            $error = "Er is een fout opgetreden bij het opslaan van de gegevens.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Nieuwe auto</h1>
    <form action="profile.php">
        <button type="submit" class="terug">&lt;&lt; Terug</button>
    </form>
    <form action="add.php" method="POST" enctype="multipart/form-data">
        <div class="inputfile">
            <div class="merk row">
                <label for="merk">Merk</label>
                <select name="merk_id" id="merk">
                    <?php
                    foreach ($merken as $merk) {
                        $autonaam = $merk["merk"];
                        $merk_Id = $merk["id"];
                        echo "<option value=\"$merk_Id\">$autonaam</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="model row">
                <label for="model">Model</label>
                <input type="text" name="model" id="model">
            </div>
            <div class="foto row">
                <label for="foto_auto">Foto</label>
                <input type="file" name="foto_auto" id="foto_auto" accept="image/*">
            </div>
            <div class="optrekken row">
                <label for="optrekken_seconde">Optrekken in secondes</label>
                <input type="text" name="optrekken_seconde" id="optrekken_seconde">
            </div>
            <div class="jaar row">
                <label for="jaar">Jaar</label>
                <input type="text" name="jaar" id="jaar">
            </div>
            <div class="tank row">
                <label for="tank">tank</label>
                <select name="tank" id="tank">
                    <option value="Benzine">Benzine</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Elektrisch">Elektrisch</option>
                    <option value="Hybride">Hybride</option>
                </select>
            </div>
            <div class="waarde row">
                <label for="waarde">Waarde</label>
                <input type="text" name="waarde" id="waarde">
            </div>
            <div class="kenteken row">
                <label for="kenteken">Kenteken</label>
                <input type="text" name="kenteken" id="kenteken">
            </div>
        </div>
        <div class="submit-row">
            <button type="submit" name="opslaan" class="opslaan">Opslaan</button>
            <?php if (!empty($error)): ?>
                <span class="error-message"><?php echo htmlspecialchars($error); ?></span>
            <?php endif; ?>
        </div>
    </form>
</body>

</html>