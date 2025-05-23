<?php
session_start();
require_once 'includes/db.php';
include 'includes/header.php';

// Busca imóveis em destaque
$stmtDestaque = $pdo->prepare("SELECT * FROM imoveis WHERE destaque = 1 ORDER BY created_at DESC LIMIT 12");
$stmtDestaque->execute();
$imoveisDestaque = $stmtDestaque->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Carousel de banners -->
<div id="carouselExampleIndicators" class="carousel slide mb-5">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/+55 4599999-9999 (1).png" class="d-block w-100" alt="Banner 1">
    </div>
    <div class="carousel-item">
      <img src="assets/img/+55 4599999-9999 (1).png" class="d-block w-100" alt="Banner 2">
    </div>
    <div class="carousel-item">
      <img src="assets/img/+55 4599999-9999 (1).png" class="d-block w-100" alt="Banner 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>

<!-- Imóveis em destaque -->
<div class="container mt-4">
  <h2 class="text-center mb-4">Imóveis em Destaque</h2>
  <div class="row">
    <?php foreach ($imoveisDestaque as $imovel): ?>
      <div class="col-6 col-md-3 mb-4">
        <div class="card h-100 position-relative">
          <?php if (!empty($imovel['imagem'])): ?>
            <img src="assets/img/<?= htmlspecialchars($imovel['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($imovel['titulo']) ?>">
          <?php else: ?>
            <img src="https://via.placeholder.com/350x250?text=Sem+Imagem" class="card-img-top" alt="Sem imagem">
          <?php endif; ?>

          <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">Destaque</span>

          <div class="card-body d-flex flex-column justify-content-between">
            <div>
              <h5 class="card-title"><?= htmlspecialchars($imovel['titulo']) ?></h5>
              <p class="card-text">
                <strong>R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></strong>
                (<?= ucfirst($imovel['categoria']) ?>)
              </p>
              <p class="card-text"><?= ucfirst(htmlspecialchars($imovel['tipo'])) ?></p>
            </div>
            <a href="detalhes.php?id=<?= $imovel['id'] ?>" class="btn btn-outline-primary w-100 mt-3">Ver detalhes</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Todos os imóveis com filtro -->
<div class="py-5 mt-5">
  <div class="container bg-white p-4 rounded-4" style="box-shadow: 0 8px 20px rgba(44, 42, 42, 0.7);">
    <h2 class="text-center mb-4 display-6 text-dark fw-bold">Todos os Imóveis</h2>

    <!-- Filtro -->
    <form method="GET" id="filtroForm" class="row g-3 mb-4">
      <div class="col-md-4">
        <label for="tipo" class="form-label">Filtrar por tipo:</label>
        <select name="tipo" id="tipo" class="form-select">
          <option value="">Todos</option>
          <option value="casa">Casa</option>
          <option value="apartamento">Apartamento</option>
          <option value="terreno">Terreno</option>
          <option value="comercial">Comercial</option>
        </select>
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100 btn-filtro">Filtrar</button>
      </div>
    </form>

    <!-- Lista de imóveis -->
    <div id="lista-imoveis" class="row">
      <?php
      $stmt = $pdo->prepare("SELECT * FROM imoveis ORDER BY created_at DESC");
      $stmt->execute();
      $imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($imoveis as $imovel):
      ?>
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
              <div>
                <h5 class="card-title"><?= htmlspecialchars($imovel['titulo']) ?></h5>
                <p class="card-text">
                  <strong>R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></strong>
                  (<?= ucfirst($imovel['categoria']) ?>)
                </p>
                <p class="card-text"><?= ucfirst(htmlspecialchars($imovel['tipo'])) ?></p>
              </div>
              <a href="detalhes.php?id=<?= $imovel['id'] ?>" class="btn btn-outline-primary w-100 mt-3">Ver detalhes</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- AJAX Script filtro_imoveis.php -->
<script>
document.getElementById('filtroForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const tipo = document.getElementById('tipo').value;

  fetch('filtro_imoveis.php?tipo=' + encodeURIComponent(tipo))
    .then(response => response.text())
    .then(html => {
      document.getElementById('lista-imoveis').innerHTML = html;
    })
    .catch(error => {
      console.error('Erro ao carregar imóveis:', error);
    });
});
</script>
