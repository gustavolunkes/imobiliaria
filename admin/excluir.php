<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: imoveis.php');
    exit;
}

$id = $_GET['id'];

// Verificar se o imóvel existe
$stmt = $pdo->prepare("SELECT * FROM imoveis WHERE id = ?");
$stmt->execute([$id]);
$imovel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$imovel) {
    echo "Imóvel não encontrado.";
    exit;
}

// Excluir imóvel
$stmt = $pdo->prepare("DELETE FROM imoveis WHERE id = ?");
$stmt->execute([$id]);

header('Location: imoveis.php');
exit;
?>
