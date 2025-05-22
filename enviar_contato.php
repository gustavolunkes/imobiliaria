<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $mensagem = htmlspecialchars($_POST['mensagem']);
    $imovel_id = (int) $_POST['imovel_id'];

    // Aqui você pode salvar no banco ou enviar e-mail
    // Simplesmente redireciona por enquanto
    header("Location: detalhes.php?id=$imovel_id&sucesso=1");
    exit;
} else {
    header('Location: home.php');
    exit;
}
