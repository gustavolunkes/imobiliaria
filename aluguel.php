<?php
include 'includes/header.php';
include 'includes/db.php';

$status = 'aluguel';
$stmt = $pdo->prepare("SELECT * FROM imoveis WHERE categoria = :categoria ORDER BY created_at DESC");
$stmt->bindParam(':categoria', $status, PDO::PARAM_STR);
$stmt->execute();
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Imóveis para Alugar</h2>
  <div class="row">
    <?php foreach ($imoveis as $imovel): ?>
      <div class="col-6 col-md-3 mb-4">
        <div class="card h-100 position-relative">
          <?php if (!empty($imovel['imagem'])): ?>
            <img src="assets/img/<?= htmlspecialchars($imovel['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($imovel['titulo']) ?>">
          <?php else: ?>
            <img src="https://via.placeholder.com/350x250?text=Sem+Imagem" class="card-img-top" alt="Sem imagem">
          <?php endif; ?>

          <?php if (!empty($imovel['destaque']) && $imovel['destaque']): ?>
            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">Destaque</span>
          <?php endif; ?>

          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($imovel['titulo']) ?></h5>
            <p class="card-text">
              <strong>R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></strong>
              (<?= ucfirst($imovel['categoria']) ?> - Aluguel)
            </p>
            <p class="card-text">
              <?= ucfirst(htmlspecialchars($imovel['tipo'])) ?>
            </p>
            <a href="detalhes.php?id=<?= $imovel['id'] ?>" class="btn btn-outline-primary w-100">Ver detalhes</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
