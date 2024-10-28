<?php
require_once 'db/dbaccess.inc.php';
$dba = new DbAccess();

$errors = []; // leeres Array, darin werden Fehlermeldungen gespeichert

// wurde das Formular abgesendet?
if(isset($_POST['bt_neue_abteilung'])){
    // Formulardaten in Variablen einlesen
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Formularvalidierung
    if(empty($name) || strlen($name) > 50){
        $errors[] = 'Name muss 1-50 Zeichen enthalten';
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE){
        $errors[] = 'E-Mail ist ungültig';
    }

    // Speichern
    if(count($errors) == 0){
        $dba->createAbteilung($name, $email);
        header('Location: abteilungen.php');
        exit();
    }


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <?php include 'nav.inc.php'; ?>
        <h1>Neue Abteilung</h1>
        <?php include 'errors.inc.php'; ?>

        <!-- action: URL, wohin sollen die Daten gesendet werden? -->
        <!-- method: GET oder POST -->
        <form action="neue_abteilung.php" method="POST">
            <label>Name:</label><br>
            <input type="text" name="name"><br>
            <label>Email:</label><br>
            <input type="text" name="email"><br>
            <button name="bt_neue_abteilung">Abteilung erstellen</button>
        </form>

    </main>
</body>
</html>