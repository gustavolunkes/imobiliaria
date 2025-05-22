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

// Buscar dados do imóvel
$stmt = $pdo->prepare("SELECT * FROM imoveis WHERE id = ?");
$stmt->execute([$id]);
$imovel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$imovel) {
    echo "Imóvel não encontrado.";
    exit;
}

// Buscar imagens da galeria
$stmtGaleria = $pdo->prepare("SELECT * FROM imagens WHERE imovel_id = ?");
$stmtGaleria->execute([$id]);
$galeria = $stmtGaleria->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $endereco = $_POST['endereco'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $destaque = isset($_POST['destaque']) ? 1 : 0;

    $uploadDir = '../assets/img/';

    // Atualizar imagem principal se enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagemNome = uniqid() . '_' . $_FILES['imagem']['name'];
        move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadDir . $imagemNome);
    } else {
        $imagemNome = $imovel['imagem'];
    }

    // Atualizar imóvel
    $stmt = $pdo->prepare("UPDATE imoveis SET titulo = ?, descricao = ?, tipo = ?, endereco = ?, preco = ?, categoria = ?, imagem = ?, destaque = ? WHERE id = ?");
    $stmt->execute([$titulo, $descricao, $tipo, $endereco, $preco, $categoria, $imagemNome, $destaque, $id]);

    // Upload de novas imagens da galeria
    if (isset($_FILES['galeria'])) {
        foreach ($_FILES['galeria']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['galeria']['error'][$key] == 0) {
                $galeriaNome = uniqid() . '_' . $_FILES['galeria']['name'][$key];
                move_uploaded_file($tmpName, $uploadDir . $galeriaNome);

                $stmtImg = $pdo->prepare("INSERT INTO imagens (imovel_id, arquivo) VALUES (?, ?)");
                $stmtImg->execute([$id, $galeriaNome]);
            }
        }
    }

    header('Location: imoveis.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Imóvel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-preview {
            border: 2px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            max-width: 200px;
            margin-bottom: 10px;
        }
        .gallery-img {
            max-width: 150px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 3px;
        }
        .gallery-img {
            max-width: 150px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 3px;
            display: block;
        }
        .position-relative .btn-danger {
            padding: 2px 6px;
            font-size: 12px;
            border-radius: 50%;
        }

    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Editar Imóvel</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= htmlspecialchars($imovel['titulo']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3" required><?= htmlspecialchars($imovel['descricao']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo" required>
                <option value="">Selecione...</option>
                <option value="casa" <?= $imovel['tipo'] == 'casa' ? 'selected' : '' ?>>Casa</option>
                <option value="apartamento" <?= $imovel['tipo'] == 'apartamento' ? 'selected' : '' ?>>Apartamento</option>
                <option value="terreno" <?= $imovel['tipo'] == 'terreno' ? 'selected' : '' ?>>Terreno</option>
                <option value="comercial" <?= $imovel['tipo'] == 'comercial' ? 'selected' : '' ?>>Comercial</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" value="<?= htmlspecialchars($imovel['endereco']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?= htmlspecialchars($imovel['preco']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select class="form-select" id="categoria" name="categoria" required>
                <option value="">Selecione...</option>
                <option value="venda" <?= $imovel['categoria'] == 'venda' ? 'selected' : '' ?>>Venda</option>
                <option value="aluguel" <?= $imovel['categoria'] == 'aluguel' ? 'selected' : '' ?>>Aluguel</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem Principal Atual</label><br>
            <?php if ($imovel['imagem']): ?>
                <img src="../assets/img/<?= htmlspecialchars($imovel['imagem']) ?>" class="img-preview" alt="Imagem do imóvel">
            <?php else: ?>
                <p>Nenhuma imagem cadastrada.</p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="imagem" class="form-label">Alterar Imagem Principal</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
        </div>

       <div class="mb-3">
    <label class="form-label">Galeria Atual</label><br>
    <div class="d-flex flex-wrap">
        <?php foreach ($galeria as $img): ?>
            <div class="position-relative m-2">
                <a href="remover_imagem.php?id=<?= $img['id'] ?>&imovel_id=<?= $id ?>" class="btn btn-sm btn-danger position-absolute top-0 end-0" style="z-index: 2;" onclick="return confirm('Tem certeza que deseja remover esta imagem?')">X</a>
                <img src="../assets/img/<?= htmlspecialchars($img['arquivo']) ?>" class="gallery-img" alt="Galeria">
            </div>
        <?php endforeach; ?>
    </div>
</div>


        <div class="mb-3">
            <label for="galeria" class="form-label">Adicionar Imagens à Galeria</label>
            <input type="file" class="form-control" id="galeria" name="galeria[]" accept="image/*" multiple>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="destaque" name="destaque" value="1" <?= $imovel['destaque'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="destaque">Destaque</label>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="imoveis.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
