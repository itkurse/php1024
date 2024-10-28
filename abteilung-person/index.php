<?php
require_once 'db/dbaccess.inc.php';
$dba = new DbAccess(); // erzeuge ein Objekt der Klasse DbAccess

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abteilungen und Personen</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <?php include 'nav.inc.php'; ?>
        <h1>Abteilung und Personen</h1>
    </main>
</body>
</html>