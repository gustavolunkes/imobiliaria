<?php
$tituloPagina = "Todos os Imóveis";
include 'includes/header.php';
include 'includes/db.php'; // conexão PDO

// Captura o parâmetro da busca (GET)
$busca = $_GET['busca'] ?? '';

// Consulta imóveis filtrando pelo texto da busca (em título, tipo ou categoria)
if (!empty($busca)) {
    $stmt = $pdo->prepare("SELECT * FROM imoveis WHERE titulo LIKE :busca OR tipo LIKE :busca OR categoria LIKE :busca ORDER BY created_at DESC");
    $stmt->execute(['busca' => '%' . $busca . '%']);
} else {
    $stmt = $pdo->query("SELECT * FROM imoveis ORDER BY created_at DESC");
}
$imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($tituloPagina) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/responsividade.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
  .total-imoveis {
    margin-top: 1.5rem;
  }
</style>

</head>
<body>


<p class="text-muted text-center mb-4 total-imoveis" >
    <?= $busca ? "Mostrando resultados para: <strong>" . htmlspecialchars($busca) . "</strong> — " : "" ?>
    Total de imóveis: <strong><?= count($imoveis) ?></strong>
</p>

<!-- Conteúdo principal -->
<div class="py-5 mt-5">
  <div class="container bg-white p-4 rounded-4" style="box-shadow: 0 8px 20px rgba(44, 42, 42, 0.7);">
    <h2 class="text-center mb-4 display-6 text-dark fw-bold"><?= htmlspecialchars($tituloPagina) ?></h2>

    <!-- Lista de imóveis -->
    <div id="lista-imoveis" class="row">
      <?php if (count($imoveis) === 0): ?>
        <p class="text-center text-muted">Nenhum imóvel encontrado para sua busca.</p>
      <?php else: ?>
        <?php foreach ($imoveis as $imovel): ?>
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
                    (<?= ucfirst(htmlspecialchars($imovel['categoria'])) ?>)
                  </p>
                  <p class="card-text"><?= ucfirst(htmlspecialchars($imovel['tipo'])) ?></p>
                </div>
                <a href="detalhes.php?id=<?= $imovel['id'] ?>" class="btn btn-outline-primary w-100 mt-3">Ver detalhes</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
