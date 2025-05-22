<?php
$tituloPagina = "Contato - Imobiliária";
include 'includes/header.php';
?>

<div class="container mt-5 mb-5">
  <h1 class="text-center mb-4">Fale Conosco</h1>
  <div class="row">
    <div class="col-md-6">
      <form method="POST" action="https://formsubmit.co/gustavo@tryideas.com.br">


        
        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome completo" required />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="seuemail@exemplo.com" required />
        </div>
        <div class="mb-3">
          <label for="mensagem" class="form-label">Mensagem</label>
          <textarea class="form-control" id="mensagem" name="mensagem" rows="5" placeholder="Escreva uma mensagem" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
    <div class="col-md-6">
      <br><br>
      <h5>Endereço</h5>
      <p>Rua Santa Catarina, 123 - Centro<br>Cidade - Marechal Cândido Rondon<br>CEP 85960000</p>
      <h5>Telefone</h5>
      <p>(45) 1234-5678</p>
      <h5>E-mail</h5>
      <p>contato@imobiliaria.com.br</p>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
