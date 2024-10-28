<?php

// binde die Model-Klassen ein, damit wir in der DbAccess Objekte dieser Klassen erzeugen können
require_once 'models.inc.php';

class DbAccess 
{
    // PDO-Connection ist die Verbindung zur Datenbank
    private PDO $conn;

    // Konstruktor, wird aufgerufen wenn ein neues Objekt der Klasse
    // DbAccess erzeugt wird
    public function __construct(){
        // baue die DB-Connection auf wenn ein Objekt erzeugt wird
        
        // Verbindungs-Informationen
        $host = '127.0.0.1';
        $dbname = '20241028_abteilungpersonen';
        $user = 'root';
        $pw = '';

        // Datenbank-Verbindung aufbauen
        $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pw);
        // Fehlermeldungen aktivieren
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    // Speichert eine neue Abteilung, übergeben werden Name und Email
    // Gibt die ID der erzeugten Abteilung zurück
    public function createAbteilung(string $name, string $email) : int {
        $sql = 'INSERT INTO abteilung 
        (name, email) 
        VALUES 
        (:n, :e)';
        // erzeuge Prepared Statement zur Vermeidung von SQL-Injections
        $ps = $this->conn->prepare($sql);
        // im PS muss jeder "Named Parameter" mit dem eigentlichen Wert ersetzt werden
        $ps->bindValue('n', $name);
        $ps->bindValue('e', $email);
        // schicke SQL-Statement zur Datenbank
        $ps->execute();

        $id = $this->conn->lastInsertId();
        return $id;
    }


    // Sucht alle Abteilungen in der Tabelle und 
    // gibt diese als Array von Objekten der Klasse Abteilung zurück
    public function getAbteilungen() : array {
        $sql = 'SELECT * 
        FROM abteilung';
        $ps = $this->conn->prepare($sql);
        $ps->execute();

        $abteilungen = []; // sammle alle Abteilungen in diesem Array

        // iteriere über jeden gefundenen Datensatz, $row ist immer eine Zeile der Tabelle
        while($row = $ps->fetch()){
            // Erzeuge aus dem Datensatz ein neues Objekt der Klasse Abteilung
            $a = new Abteilung($row['id'], $row['name'], $row['email']);

            // füge das Objekt im Array ein
            $abteilungen[] = $a;
        }
        return $abteilungen;
    }

}

?>