<?php 
session_start();
require_once 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    die('ID inválido.');
}

$id = (int) $_GET['id'];

// Busca imóvel
$stmt = $pdo->prepare("SELECT * FROM imoveis WHERE id = :id LIMIT 1");
$stmt->execute([':id' => $id]);
$imovel = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$imovel) {
    die('Imóvel não encontrado.');
}

// Busca imagens adicionais
$stmtImagens = $pdo->prepare("SELECT * FROM imagens WHERE imovel_id = :id");
$stmtImagens->execute([':id' => $id]);
$imagensAdicionais = $stmtImagens->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($imovel['titulo']) ?> - Detalhes do Imóvel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<a href="imoveis.php" class="btn btn-secondary d-btn-voltar">Voltar</a>

<div class="container mt-5">
    <h1><?= htmlspecialchars($imovel['titulo']) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <?php if (!empty($imovel['imagem'])): ?>
                <img src="assets/img/<?= htmlspecialchars($imovel['imagem']) ?>" alt="<?= htmlspecialchars($imovel['titulo']) ?>" class="img-fluid rounded mb-3">
            <?php else: ?>
                <img src="https://via.placeholder.com/600x400?text=Sem+Imagem" alt="Sem imagem" class="img-fluid rounded mb-3">
            <?php endif; ?>

            <?php if ($imagensAdicionais): ?>
              <div class="row">
                <?php foreach ($imagensAdicionais as $img): ?>
                  <div class="col-6 col-md-4 mb-3">
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <h4>Descrição</h4>
            <p><?= nl2br(htmlspecialchars($imovel['descricao'])) ?></p>

            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Tipo:</strong> <?= ucfirst(htmlspecialchars($imovel['tipo'])) ?></li>
                <li class="list-group-item"><strong>Categoria:</strong> <?= ucfirst(htmlspecialchars($imovel['categoria'])) ?></li>
                <li class="list-group-item"><strong>Endereço:</strong> <?= htmlspecialchars($imovel['endereco']) ?></li>
                <li class="list-group-item"><strong>Preço:</strong> R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></li>
                <li class="list-group-item"><strong>Destaque:</strong> <?= $imovel['destaque'] ? 'Sim' : 'Não' ?></li>
                <li class="list-group-item"><strong>Criado em:</strong> <?= date('d/m/Y H:i', strtotime($imovel['created_at'])) ?></li>
            </ul>

            <div class="mt-4 d-flex gap-2">
              <a href="galeria.php?id=<?= $id ?>" class="btn btn-primary">Ver Galeria</a>
              
            </div>
        </div>
    </div>

    <!-- Mapa + Formulário -->
    <div class="card shadow p-4 mt-5">
      <div class="row">
        <div class="col-md-6 mb-4">
          <h5>📍 Localização no mapa</h5>
          <?php if (!empty($imovel['endereco'])): ?>
            <iframe
              width="100%"
              height="300"
              style="border:0"
              loading="lazy"
              allowfullscreen
              referrerpolicy="no-referrer-when-downgrade"
              src="https://www.google.com/maps?q=<?= urlencode($imovel['endereco']) ?>&output=embed">
            </iframe>
          <?php else: ?>
            <p>Endereço não informado para exibir o mapa.</p>
          <?php endif; ?>
        </div>

        <div class="col-md-6">
          <h5>📩 Solicitar mais informações</h5>
          <form method="post" action="enviar_contato.php">
            <input type="hidden" name="imovel_id" value="<?= $imovel['id'] ?>">
            <div class="mb-3">
              <label for="nome" class="form-label">Seu nome</label>
              <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Seu e-mail</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="mensagem" class="form-label">Mensagem</label>
              <textarea name="mensagem" id="mensagem" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>
        </div>
      </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
