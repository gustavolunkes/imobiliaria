<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $endereco = $_POST['endereco'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $destaque = isset($_POST['destaque']) ? 1 : 0;

    // Diretório de upload
    $uploadDir = '../assets/img/';

    // Upload da imagem principal
    $imagemNome = '';
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagemNome = uniqid() . '_' . $_FILES['imagem']['name'];
        move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadDir . $imagemNome);
    }

    // Inserir o imóvel sem latitude e longitude
    $stmt = $pdo->prepare("INSERT INTO imoveis (titulo, descricao, tipo, endereco, preco, categoria, imagem, destaque) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$titulo, $descricao, $tipo, $endereco, $preco, $categoria, $imagemNome, $destaque]);

    $imovel_id = $pdo->lastInsertId();

    // Upload de imagens da galeria
    if (isset($_FILES['galeria'])) {
        foreach ($_FILES['galeria']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['galeria']['error'][$key] == 0) {
                $galeriaNome = uniqid() . '_' . $_FILES['galeria']['name'][$key];
                move_uploaded_file($tmpName, $uploadDir . $galeriaNome);

                $stmtImg = $pdo->prepare("INSERT INTO imagens (imovel_id, arquivo) VALUES (?, ?)");
                $stmtImg->execute([$imovel_id, $galeriaNome]);
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
    <title>Adicionar Imóvel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Adicionar Imóvel</h2>
    <form method="post" enctype="multipart/form-data">
        <!-- Campos do formulário -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo" required>
                <option value="">Selecione...</option>
                <option value="casa">Casa</option>
                <option value="apartamento">Apartamento</option>
                <option value="terreno">Terreno</option>
                <option value="comercial">Comercial</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" required>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select class="form-select" id="categoria" name="categoria" required>
                <option value="">Selecione...</option>
                <option value="venda">Venda</option>
                <option value="aluguel">Aluguel</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem Principal</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="galeria" class="form-label">Galeria de Imagens</label>
            <input type="file" class="form-control" id="galeria" name="galeria[]" accept="image/*" multiple>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="destaque" name="destaque" value="1">
            <label class="form-check-label" for="destaque">Destaque</label>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="imoveis.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
