<?php
$host = 'localhost';
$dbname = 'dds_rpg';
$username = 'root'; // substitua pelo seu usuário do banco de dados
$password = ''; // substitua pela sua senha do banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
