<?php
require_once '../includes/db.php';

if (!isset($_GET['id']) || !isset($_GET['imovel_id'])) {
    header('Location: imoveis.php');
    exit;
}

$id = $_GET['id'];
$imovel_id = $_GET['imovel_id'];

// Buscar imagem
$stmt = $pdo->prepare("SELECT arquivo FROM imagens WHERE id = ?");
$stmt->execute([$id]);
$imagem = $stmt->fetch(PDO::FETCH_ASSOC);

if ($imagem) {
    $caminho = '../assets/img/' . $imagem['arquivo'];
    if (file_exists($caminho)) {
        unlink($caminho); // remove o arquivo
    }

    // Remove do banco de dados
    $stmt = $pdo->prepare("DELETE FROM imagens WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: editar.php?id=$imovel_id");
exit;
