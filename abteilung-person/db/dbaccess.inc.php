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


    // Lädt eine Abteilung anhand der ID
    // Gibt ein Objekt der Klasse Abteilung zurück, oder FALSE falls keine Abteilung gefunden wurde
    public function getAbteilungById(int $id) : Abteilung|FALSE {
        $sql = 'SELECT * 
        FROM abteilung 
        WHERE id = :id ';
        $ps = $this->conn->prepare($sql);
        $ps->bindValue('id', $id);
        $ps->execute();

        // Code geht nur in while wenn eine Abteilung gefunden wurde
        while($row = $ps->fetch()){
            // erzeuge aus dem Datensatz ein Objekt der Klasse Abteilung
            return new Abteilung($row['id'], $row['name'], $row['email']);
        }

        // wenn keine Abteilung gefunden wurde, gehen wir nicht in while
        return FALSE;
    }


    // aktualisiert eine Abteilung in der Datenbank
    // übergeben wird ein Objekt der Klasse Abteilung
    // die neuen Werte sind bereits in diesem Objekt enthalten
    public function updateAbteilung(Abteilung $a){
        $sql = 'UPDATE abteilung 
        SET name = :n, email = :e 
        WHERE id = :id ';
        $ps = $this->conn->prepare($sql);
        $ps->bindValue('n', $a->name);
        $ps->bindValue('e', $a->email);
        $ps->bindValue('id', $a->id);
        $ps->execute();
    }

}

?>