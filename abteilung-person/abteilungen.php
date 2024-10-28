<?php
require_once 'db/dbaccess.inc.php';
$dba = new DbAccess();

// Lade alle Abteilungen
// Die Variable $abteilungen hat den Datentyp: array, gefüllt mit Objekten der Klasse Abteilung
$abteilungen = $dba->getAbteilungen();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abteilungen</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <?php include 'nav.inc.php'; ?>
        <h1>Abteilungen</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            // iteriere über jede Abteilung
            foreach($abteilungen as $a){
                echo '<tr>';
                
                echo '<td>' . htmlspecialchars($a->id) . '</td>';
                echo '<td>' . htmlspecialchars($a->name) . '</td>';
                echo '<td>' . htmlspecialchars($a->email) . '</td>';

                echo '</tr>';
            }
            ?>
            </tbody>
        </table>

    </main>
</body>
</html>