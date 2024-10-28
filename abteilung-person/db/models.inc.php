<?php
// Für jede Tabelle eine Klasse erstellen
// aus jeder Spalte wird eine Eigenschaft der Klasse
// --> jeder Datensatz in der Tabelle wird als Objekt der Klasse im PHP Script eingelesen

class Abteilung {
    // Eigenschaften (Instanzvariablen)
    public int $id;
    public string $name;
    public string $email;

    // Konstruktor
    public function __construct(int $id, string $name, string $email){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
}


class Person 
{
    public int $id;
    public string $vorname;
    public string $nachname;
    public DateTime $geburtsdatum;
    public float $gehalt;
    public int $abteilung_id;

    // ?DateTime heißt null oder DateTime
    public ?DateTime $date_removed;

    public function __construct(int $id, string $vorname, string $nachname, DateTime $geburtsdatum, 
                            float $gehalt, int $abteilung_id, ?DateTime $date_removed){
        $this->id = $id;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->geburtsdatum = $geburtsdatum;
        $this->gehalt = $gehalt;
        $this->abteilung_id = $abteilung_id;
        $this->date_removed = $date_removed;
    }
}

?>