<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

// Termo de pesquisa
$termo = '';
if (!empty($_GET['pesquisa'])) {
    $termo = trim($_GET['pesquisa']);
    $stmt = $pdo->prepare("SELECT * FROM imoveis WHERE titulo LIKE :termo OR tipo LIKE :termo OR categoria LIKE :termo ORDER BY id DESC");
    $stmt->execute([':termo' => "%$termo%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM imoveis ORDER BY id DESC");
}

$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Imóveis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .search-bar {
            width: 300px;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <!-- Cabeçalho com busca -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="mb-0">Gerenciar Imóveis</h2>
        <form class="d-flex search-bar" method="get" action="">
            <input type="text" name="pesquisa" class="form-control me-2" placeholder="Buscar..." value="<?= htmlspecialchars($termo) ?>">
            <button type="submit" class="btn btn-primary me-2">Pesquisar</button>
            <?php if ($termo): ?>
                <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-outline-secondary">Limpar</a>
            <?php endif; ?>
        </form>
    </div>

    <p class="text-muted">
        <?= $termo ? "Mostrando resultados para: <strong>" . htmlspecialchars($termo) . "</strong> — " : "" ?>
        Total de imóveis: <strong><?= count($imoveis) ?></strong>
    </p>

    <!-- Ações -->
    <div class="d-flex justify-content-between mb-3">
        <a href="adicionar.php" class="btn btn-success">Adicionar Imóvel</a>
        <div>
            <a href="../home.php" target="_blank" class="btn btn-outline-primary me-2">Home</a>
            <a href="logout.php" class="btn btn-secondary">Sair (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
        </div>
    </div>

    <!-- Tabela -->
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
        <?php if (count($imoveis) > 0): ?>
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
        <?php else: ?>
            <tr><td colspan="6" class="text-center text-muted">Nenhum imóvel encontrado.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="text-start mb-4" style="margin-top: 80px; padding-bottom: 200px;;">
  <a href="acessos.php" class="btn btn-outline-secondary">Ver Acessos do site</a>
</div>
</div>
</body>
</html>
