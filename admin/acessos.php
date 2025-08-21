<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

require_once '../includes/db.php';

// Define o fuso horário correto (Paraná / GMT-3)
date_default_timezone_set('America/Sao_Paulo');
$pdo->exec("SET time_zone = '-03:00'");

// Totais
$totalAcessos = $pdo->query("SELECT COUNT(*) FROM acessos")->fetchColumn();
$totalVisitantes = $pdo->query("SELECT COUNT(DISTINCT CONCAT(ip, user_agent)) FROM acessos")->fetchColumn();

// Consulta TODOS os acessos (sem filtro de tempo, mostrando todos os registros do banco)
$stmt = $pdo->query("SELECT * FROM acessos ORDER BY data_acesso DESC");
$acessos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Relatório de Acessos - Todos os Registros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3 class="mb-4">Relatório de Acessos (Todos os Registros)</h3>

  <div class="mb-3">
    <span class="badge bg-primary me-2">Total de Acessos (Banco): <?= $totalAcessos ?></span>
    <span class="badge bg-success">Visitantes Diferentes: <?= $totalVisitantes ?></span>
  </div>

  <a href="imoveis.php" class="btn btn-sm btn-outline-primary mb-3">Voltar para imóveis</a>

  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>IP</th>
        <th>Data e Hora</th>
        <th>Localização</th>
        <th>Latitude / Longitude</th>
        <th>Navegador / Sistema</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($acessos as $acesso): ?>
        <tr>
          <td><?= htmlspecialchars($acesso['id']) ?></td>
          <td><?= htmlspecialchars($acesso['ip']) ?></td>
          <td><?= htmlspecialchars($acesso['data_acesso']) ?></td>
          <td><?= "{$acesso['cidade']} / {$acesso['estado']} - {$acesso['pais']}" ?></td>
          <td><?= "{$acesso['latitude']} / {$acesso['longitude']}" ?></td>
          <td><?= htmlspecialchars($acesso['user_agent']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
