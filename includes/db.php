<?php
$host = 'localhost';
$dbname = 'imobiliaria'; 
$username = 'root';
$password = ''; // Senha vazia por padrão no XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>