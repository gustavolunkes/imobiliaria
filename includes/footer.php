<!-- Rodapé -->
<footer class="bg-dark text-white text-center py-4 mt-5">
  <div class="container">
    <!-- Links do site -->
    <div class="mb-4">
      <a href="home.php" class="footer-link">Home</a>
      <a href="imoveis.php" class="footer-link">Imóveis</a>
      <a href="sobre.php" class="footer-link">Sobre</a>
      <a href="servicos.php" class="footer-link">Serviços</a>
      <a href="contato.php" class="footer-link">Contato</a>

      <!-- Separador e Admin destacado -->
      <span class="text-white mx-2">|</span>
      <a href="../imobiliaria/admin/index.php" class="footer-link text-warning">
        <i class="bi bi-person-lock"></i> Admin
      </a>
    </div>

    <br><br>

    <!-- Direitos autorais -->
    <p class="mb-2">&copy; 2025 Imobiliária. Todos os direitos reservados.</p>

    <!-- Desenvolvedor -->
    <p class="mb-0">
      Desenvolvido por 
      <a href="https://portfolio-gustavo-lunkes.vercel.app/#inicio" target="_blank" class="footer-link text-info">
        Gustavo Lunkes
      </a>
      <a href="https://github.com/gustavolunkes" target="_blank" class="footer-link text-info ms-2">
        <i class="bi bi-github"></i>
      </a>
    </p>
  </div>
</footer>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Estilos personalizados para o rodapé -->
<style>
  .footer-link {
    color: white;
    text-decoration: none;
    margin: 0 10px;
    transition: color 0.3s ease, text-decoration 0.3s ease;
    position: relative;
  }

  .footer-link:hover {
    color: #0d6efd;
    text-decoration: underline;
  }

  .footer-link.text-warning:hover {
    color: #ffc107;
  }

  .footer-link i {
    font-size: 1.1rem;
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
