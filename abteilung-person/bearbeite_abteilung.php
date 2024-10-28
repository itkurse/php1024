<?php
// Das Bearbeiten einer Abteilung
// Welche Abteilung soll bearbeitet werden? 
// Übergebe die ID als GET-Parameter --> bearbeite_abteilung.php?id=5

require_once 'db/dbaccess.inc.php';
$dba = new DbAccess(); // ich benötige ein Objekt der Klasse um auf die Methoden darin zugreifen zu können

// Check: Gibt es GET-Parameter ID und steht eine Zahl drinnnen? Wenn nein --> Fehler
if(isset($_GET['id']) === FALSE 
    || filter_var($_GET['id'], FILTER_VALIDATE_INT) === FALSE){
    exit('GET-Parameter ID fehlt!');
}

// Lade die Abteilung anhand der ID
$abteilung = $dba->getAbteilungById($_GET['id']);
// wenn keine Abteilung gefunden wurde, Fehlermeldung
if($abteilung === FALSE){
    exit('Abteilung nicht gefunden');
}

$errors = [];

if(isset($_POST['bt_bearbeite_abteilung'])){
    // Formulardaten einlesen
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Formularvalidierung
    if(empty($name) || strlen($name)>50){
        $errors[] = 'Name muss 1-50 Zeichen enthalten';
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE){
        $errors[] = 'E-Mail Adresse ist ungültig';
    }

    // ändere die Daten im Objekt
    $abteilung->name = $name;
    $abteilung->email = $email;

    // wenn es keine Fehler gibt, speichern
    if(count($errors) == 0){
        $dba->updateAbteilung($abteilung);
        header('Location: abteilungen.php');
        exit();
    }
}


if(isset($_POST['bt_loesche_abteilung'])){
    $dba->deleteAbteilung($abteilung->id);
    header('Location: abteilungen.php');
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abteilung bearbeiten</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <?php include 'nav.inc.php'; ?>
        <h1><?php echo $abteilung->name; ?></h1>
        <?php include 'errors.inc.php'; ?>

        <form action="bearbeite_abteilung.php?id=<?php echo $abteilung->id; ?>" method="POST">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?php echo htmlspecialchars($abteilung->name); ?>"><br>
            <label>Email:</label><br>
            <input type="text" name="email" value="<?php echo htmlspecialchars($abteilung->email); ?>"><br>
            <button name="bt_bearbeite_abteilung">Abteilung bearbeiten</button>
        </form>

        <form action="bearbeite_abteilung.php?id=<?php echo $abteilung->id; ?>" method="POST">
            <button name="bt_loesche_abteilung">Abteilung löschen</button>
        </form>

    </main>
</body>
</html>