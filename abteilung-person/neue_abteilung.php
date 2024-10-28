<?php
require_once 'db/dbaccess.inc.php';
$dba = new DbAccess();

$errors = []; // leeres Array, darin werden Fehlermeldungen gespeichert

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
        <?php
        // Ausgabe der Fehlermeldungen
        if(isset($errors) && count($errors) > 0){
            echo '<ul>';
            foreach($errors as $e){
                echo '<li>' . htmlspecialchars($e) . '</li>';
            }
            echo '</ul>';
        }
        ?>

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