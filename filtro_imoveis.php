<?php
require_once 'includes/db.php';

$tipo = $_GET['tipo'] ?? '';
$sql = "SELECT * FROM imoveis";
$params = [];

if (!empty($tipo)) {
  $sql .= " WHERE tipo = :tipo";
  $params[':tipo'] = $tipo;
}
$sql .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($imoveis) === 0) {
  echo '<p class="text-center">Nenhum imóvel encontrado com esse filtro.</p>';
}

foreach ($imoveis as $imovel): ?>
  <div class="col-6 col-md-3 mb-4">
    <div class="card h-100 position-relative">
      <?php if (!empty($imovel['imagem'])): ?>
        <img src="assets/img/<?= htmlspecialchars($imovel['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($imovel['titulo']) ?>">
      <?php else: ?>
        <img src="https://via.placeholder.com/350x250?text=Sem+Imagem" class="card-img-top" alt="Sem imagem">
      <?php endif; ?>

      <?php if (!empty($imovel['destaque'])): ?>
        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">Destaque</span>
      <?php endif; ?>

      <div class="card-body d-flex flex-column justify-content-between">
        <h5 class="card-title"><?= htmlspecialchars($imovel['titulo']) ?></h5>
        <p class="card-text">
          <strong>R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></strong>
          (<?= ucfirst($imovel['categoria']) ?>)
        </p>
        <p class="card-text"><?= ucfirst(htmlspecialchars($imovel['tipo'])) ?></p>
        <a href="detalhes.php?id=<?= $imovel['id'] ?>" class="btn btn-outline-primary w-100 mt-3">Ver detalhes</a>
      </div>
    </div>
  </div>
<?php endforeach;
