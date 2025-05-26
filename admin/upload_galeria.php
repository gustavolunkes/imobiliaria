<?php
include '../includes/db.php';

$imovel_id = $_POST['imovel_id'];
foreach ($_FILES['imagens']['tmp_name'] as $i => $tmp) {
    $nome = basename($_FILES['imagens']['name'][$i]);
    $destino = '../assets/img/galeria/' . $nome;

    if (move_uploaded_file($tmp, $destino)) {
        $stmt = $pdo->prepare("INSERT INTO imagens (imovel_id, arquivo) VALUES (?, ?)");
        $stmt->execute([$imovel_id, $nome]);
    }
}
header("Location: imoveis1.php?id=$imovel_id");
?>
