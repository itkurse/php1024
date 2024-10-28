<?php
require_once 'db/dbaccess.inc.php';
$dba = new DbAccess();

$errors = [];

if(isset($_POST['bt_neue_person'])){
    $vorname = trim($_POST['vorname']);
    $nachname = trim($_POST['nachname']);
    $geburtsdatumString = trim($_POST['geburtsdatum']);
    $gehalt = trim($_POST['gehalt']);
    $abteilungId = trim($_POST['abteilung_id']);

    // Formularvalidierung
    if(empty($vorname) || strlen($vorname) > 100){
        $errors[] = 'Vorname muss 1-100 Zeichen haben';
    }
    if(empty($nachname) || strlen($nachname) > 100){
        $errors[] = 'Nachname muss 1-100 Zeichen haben';
    }

    // versuche das Geburtsdatum im Format TT.MM.JJJJ in ein DateTime-Objekt umzuwandeln
    // Umwandlung String --> DateTime  geht mit DateTime::createFromFormat
    $geburtsdatum = DateTime::createFromFormat('d.m.Y', $geburtsdatumString);
    if($geburtsdatum === FALSE){
        $errors[] = 'Geburtsdatum ist ungültig';
    }

    if(filter_var($gehalt, FILTER_VALIDATE_FLOAT) === FALSE){
        $errors[] = 'Gehalt ist ungültig';
    }
    if(filter_var($abteilungId, FILTER_VALIDATE_INT) === FALSE){
        $errors[] = 'Abteilung auswählen';
    }

    if(count($errors) == 0){
        
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neue Person</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <?php include 'nav.inc.php'; ?>
        <h1>Neue Person</h1>
        <?php include 'errors.inc.php'; ?>
        <form action="neue_person.php" method="POST">
            <label>Vorname:</label><br>
            <input type="text" name="vorname"><br>
            <label>Nachname:</label><br>
            <input type="text" name="nachname"><br>
            <label>Geburtsdatum (TT.MM.JJJJ):</label><br>
            <input type="text" name="geburtsdatum"><br>
            <label>Gehalt:</label><br>
            <input type="text" name="gehalt"><br>
            <label>Abteilung:</label><br>
            <select name="abteilung_id">
                <?php
                // Lade alle Abteilungen
                $abteilungen = $dba->getAbteilungen();
                foreach($abteilungen as $a){
                    echo '<option value="'.$a->id.'">' . htmlspecialchars($a->name) . '</option>'; 
                }
                ?>
            </select><br>

            <button name="bt_neue_person">Person speichern</button>
        </form>
    </main>
</body>
</html>