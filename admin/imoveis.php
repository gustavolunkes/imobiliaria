<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

// Buscar imóveis
$stmt = $pdo->query("SELECT * FROM imoveis ORDER BY id DESC");
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Imóveis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Gerenciar Imóveis</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="adicionar.php" class="btn btn-success">Adicionar Imóvel</a>
        <div>
            <a href="../home.php" target="blank"  class="btn btn-outline-primary me-2">Home</a>
            <a href="logout.php" class="btn btn-secondary">Sair (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Tipo</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($imoveis as $imovel): ?>
            <tr>
                <td><?= $imovel['id'] ?></td>
                <td><?= htmlspecialchars($imovel['titulo']) ?></td>
                <td><?= htmlspecialchars($imovel['tipo']) ?></td>
                <td><?= htmlspecialchars($imovel['categoria']) ?></td>
                <td>R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></td>
                <td>
                    <a href="editar.php?id=<?= $imovel['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    <a href="excluir.php?id=<?= $imovel['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
