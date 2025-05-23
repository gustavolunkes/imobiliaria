<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $tituloPagina ?? 'Imobiliária'; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/responsividade.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Menu de navegação -->
<!-- Menu de navegação moderno -->
<nav class="navbar navbar-expand-lg shadow-sm" style="position: sticky; top: 0; background-color:rgb(31, 41, 53); z-index: 100;">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2 text-white" href="home.php" style="font-weight: bold; font-size: 1.25rem;">
      <img src="assets/img/imobiliaria.png" alt="Logo" width="30" height="30">
      Imobiliária
    </a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="home.php">Home</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white fw-semibold px-3" href="#" role="button" data-bs-toggle="dropdown">Imóveis</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="imoveis.php">Todos os Imóveis</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="venda.php">À Venda</a></li>
            <li><a class="dropdown-item" href="aluguel.php">Para Alugar</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="sobre.php">Sobre</a></li>
        <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="servicos.php">Serviços</a></li>
        <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="contato.php">Contato</a></li>
      </ul>
    </div>
  </div>
</nav>


