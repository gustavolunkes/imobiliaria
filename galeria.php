<?php
include 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    echo "<p>Imóvel não encontrado.</p>";
    include 'includes/footer.php';
    exit;
}

$id = intval($_GET['id']);

// Buscar dados do imóvel
$stmt = $pdo->prepare("SELECT titulo, imagem FROM imoveis WHERE id = ?");
$stmt->execute([$id]);
$imovel = $stmt->fetch();

if (!$imovel) {
    echo "<p>Imóvel não encontrado.</p>";
    include 'includes/footer.php';
    exit;
}

// Buscar imagens da galeria
$stmt = $pdo->prepare("SELECT arquivo FROM imagens WHERE imovel_id = ? ORDER BY criado_em ASC");
$stmt->execute([$id]);
$imagens = $stmt->fetchAll();
?>

<!-- Botão de Voltar -->
<div class="mt-4 botao-voltar">
    <a href="detalhes.php?id=<?= $id ?>" class="btn btn-secondary">Voltar para Detalhes</a>
</div>

<!-- CSS para responsividade -->
<style>
    /* Estilo geral */
    .imagem-principal {
        max-width: 700px;
        height: auto;
    }

    .card-galeria {
        padding: 15px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .botao-voltar {
       margin-left: 80px !important;
    }

    /* Responsivo para telas menores */
    @media (max-width: 768px) {
        .botao-voltar {
            margin-left: 15px !important;
        }

        .imagem-principal {
            max-width: 100% !important;
        }

        .card-galeria {
            padding: 10px !important;
        }
    }
</style>

<div class="container py-5">

    <!-- Título centralizado -->
    <h2 class="text-center mb-5">Galeria de Fotos: <br> <?= htmlspecialchars($imovel['titulo']) ?></h2>

    <!-- Imagem Principal -->
    <div class="text-center mb-5">
        <img src="assets/img/<?= htmlspecialchars($imovel['imagem']) ?>" 
             class="img-fluid rounded shadow-lg imagem-principal" 
             alt="Imagem Principal">
    </div>

    <!-- Galeria -->
    <?php if (count($imagens) > 0): ?>
        <div class="row">
            <?php foreach ($imagens as $img): ?>
                <div class="col-md-4 mb-4">
                    <div class="card-galeria">
                        <img src="assets/img/<?= htmlspecialchars($img['arquivo']) ?>" 
                             class="img-fluid rounded" 
                             alt="Imagem Galeria">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">Este imóvel ainda não possui outras imagens.</p>
    <?php endif; ?>

</div>


<?php include 'includes/footer.php'; ?>
