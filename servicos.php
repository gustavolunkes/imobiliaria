<?php
$tituloPagina = "Serviços - Imobiliária";
include 'includes/header.php';
?>

<style>
.card-hover {
  transition: transform 0.3s ease;
}
.card-hover:hover {
  transform: scale(1.05);
  cursor: pointer;
  text-decoration: none;
}
</style>

<div class="container mt-5 mb-5">
  <h1 class="text-center mb-4">Nossos Serviços</h1>
  <div class="row text-center">

    <?php
    $servicos = [
      [
        "titulo" => "Compra e Venda de Imóveis",
        "icone" => "bi-house-door-fill",
        "cor" => "text-primary",
        "descricao" => "Atendimento completo em negociações de imóveis residenciais, comerciais e terrenos.",
        "arquivo" => "servico_compra_venda.php"
      ],
      [
        "titulo" => "Locação de Imóveis",
        "icone" => "bi-key-fill",
        "cor" => "text-success",
        "descricao" => "Gestão eficiente da locação, com análise de crédito e acompanhamento jurídico.",
        "arquivo" => "servico_locacao.php"
      ],
      [
        "titulo" => "Avaliação Imobiliária",
        "icone" => "bi-bar-chart-line-fill",
        "cor" => "text-warning",
        "descricao" => "Laudos profissionais para venda, financiamento, inventário e partilha.",
        "arquivo" => "servico_avaliacao.php"
      ],
      [
        "titulo" => "Assessoria Jurídica",
        "icone" => "bi-shield-lock-fill",
        "cor" => "text-danger",
        "descricao" => "Suporte com advogados especializados em direito imobiliário.",
        "arquivo" => "servico_juridico.php"
      ],
      [
        "titulo" => "Consultoria Imobiliária",
        "icone" => "bi-lightbulb-fill",
        "cor" => "text-info",
        "descricao" => "Orientação estratégica para investidores e compradores.",
        "arquivo" => "servico_consultoria.php"
      ],
      [
        "titulo" => "Regularização de Imóveis",
        "icone" => "bi-file-earmark-check-fill",
        "cor" => "text-secondary",
        "descricao" => "Acompanhamento em escrituração, averbações e registro de imóveis.",
        "arquivo" => "servico_regularizacao.php"
      ],
    ];

    foreach ($servicos as $servico): ?>
      <div class="col-md-4 mb-5">
        <a href="<?= $servico['arquivo'] ?>" class="text-decoration-none text-dark">
          <div class="p-4 border rounded shadow-sm h-100 card-hover">
            <i class="bi <?= $servico['icone'] ?> fs-1 <?= $servico['cor'] ?> mb-3"></i>
            <h4><?= $servico['titulo'] ?></h4>
            <p><?= $servico['descricao'] ?></p>
          </div>
        </a>
      </div>
    <?php endforeach; ?>

  </div>
</div>

<br><br>
<?php include 'includes/footer.php'; ?>
