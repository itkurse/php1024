<?php
// Ausgabe der Fehlermeldungen
if (isset($errors) && count($errors) > 0) {
    echo '<ul>';
    foreach ($errors as $e) {
        echo '<li>' . htmlspecialchars($e) . '</li>';
    }
    echo '</ul>';
}
