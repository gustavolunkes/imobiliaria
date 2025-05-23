<?php
include 'includes/header.php';
include 'includes/db.php';

// Lista inicial de imóveis para aluguel
$status = 'aluguel';
$stmt = $pdo->prepare("SELECT * FROM imoveis WHERE categoria = :categoria ORDER BY created_at DESC");
$stmt->bindParam(':categoria', $status, PDO::PARAM_STR);
$stmt->execute();
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Imóveis para Alugar</h2>

  <!-- Filtro por tipo -->
  <form method="GET" id="filtroAluguelForm" class="row g-3 mb-4">
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
      <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>
  </form>

  <!-- Lista de imóveis -->
  <div class="row" id="lista-aluguel">
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

          <div class="card-body d-flex flex-column justify-content-between">
            <div>
              <h5 class="card-title"><?= htmlspecialchars($imovel['titulo']) ?></h5>
              <p class="card-text">
                <strong>R$ <?= number_format($imovel['preco'], 2, ',', '.') ?></strong>
                (<?= ucfirst($imovel['categoria']) ?> )
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

<?php include 'includes/footer.php'; ?>

<!-- Script AJAX -->
<script>
document.getElementById('filtroAluguelForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const tipo = document.getElementById('tipo').value;

  fetch('filtro_aluguel.php?tipo=' + encodeURIComponent(tipo))
    .then(response => response.text())
    .then(html => {
      document.getElementById('lista-aluguel').innerHTML = html;
    })
    .catch(error => {
      console.error('Erro ao filtrar:', error);
    });
});
</script>
