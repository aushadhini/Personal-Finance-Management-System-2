<?php
// ✔ Use double underscores and the correct path
require_once '/db/sqlite.php';

$pdo = sqlite();

echo "<h3>Tables in the Database:</h3>";

// list tables
$query  = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
$tables = $query->fetchAll(PDO::FETCH_COLUMN);

foreach ($tables as $table) {
    echo "<strong>$table</strong><br>";

    // show first 5 rows of each table
    $rows = $pdo->query("SELECT * FROM $table LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($rows);
    echo "</pre><hr>";
}