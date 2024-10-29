<?php
require_once 'db/dbaccess.inc.php';
// DbAccess ist eine Klasse. Man benötigt ein Objekt der Klasse, um auf die
// darin enthaltenen Methoden zugreifen zu können. 
$dba = new DbAccess();

// lade alle Personen
$personen = $dba->getPersonen();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle Personen</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <?php include 'nav.inc.php'; ?>
        <h1>Personen</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Geburtsdatum</th>
                <th>Gehalt</th>
                <th>Abteilung</th>
            </tr>
            <?php
            // für jede Person eine Zeile hinzufügen
            foreach($personen as $p){
                echo '<tr>';
                echo '<td>' . htmlspecialchars($p->id) . '</td>';
                echo '<td>' . htmlspecialchars($p->vorname) . '</td>';
                echo '<td>' . htmlspecialchars($p->nachname) . '</td>';
                echo '<td>' . htmlspecialchars($p->geburtsdatum->format('d.m.Y')) . '</td>';
                echo '<td>' . htmlspecialchars($p->gehalt) . '</td>';

                // Ausgabe des Abteilungs-Namens
                // suche die Abteilung anhand der ID
                $abteilung = $dba->getAbteilungById($p->abteilung_id);
                echo '<td>' . htmlspecialchars($abteilung->name) . '</td>';

                echo '</tr>';
            }
            ?>
        </table>
    </main>
</body>
</html>