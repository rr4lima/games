<?php
$conn = new PDO("mysql:host=localhost;dbname=games", "root", "");

$sql = "SELECT * FROM noticias ORDER BY criado_em DESC";
$stmt = $conn->query($sql);

foreach ($stmt as $n) {
    echo "<div>";
    echo "<h3>{$n['titulo']}</h3>";
    echo "<p>{$n['resumo']}</p>";
    echo "</div>";
}