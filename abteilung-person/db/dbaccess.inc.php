<?php

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

}

?>