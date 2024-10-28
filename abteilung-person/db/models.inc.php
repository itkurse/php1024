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

?>