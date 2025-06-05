# 🏠 Projeto IMOBILIÁRIA - Site Institucional com Painel Administrativo

## 📌 Descrição do Projeto

Este projeto é um **site institucional para uma imobiliária**, com objetivo de divulgar imóveis disponíveis para **venda** e **aluguel**, apresentar informações da empresa, serviços prestados e permitir o gerenciamento de conteúdo através de um **painel administrativo protegido por login**.

---

## 🛠️ Tecnologias Utilizadas

- **HTML5 / CSS3**: Estrutura e estilização das páginas.
- **Bootstrap**: Framework front-end para responsividade e design moderno.
- **JavaScript (Bootstrap)**: Funcionalidades como carrossel de imagens e menus dropdown.
- **PHP**: Back-end do sistema, controle de rotas, sessões, autenticação, e CRUD de imóveis.
- **MySQL + phpMyAdmin**: Armazenamento de dados de imóveis e usuários.
- **XAMPP**: Ambiente de desenvolvimento local (Apache + MySQL).

---

## 📄 Estrutura de Páginas

- **Home (`home.php`)**  
  Página inicial com banner/carrossel e listagem dinâmica dos imóveis em destaque.

- **Imóveis (`imoveis.php`)**  
  Exibe todos os imóveis cadastrados com filtros de tipo (`venda`, `aluguel`).

- **Detalhes (`detalhes.php`)**  
  Página individual de cada imóvel com descrição, dados, imagem principal e galeria.

- **Serviços (`servicos.php`)**  
  Explicação sobre os serviços oferecidos pela imobiliária (avaliação, consultoria etc).

- **Sobre (`sobre.php`)**  
  Informações institucionais, missão, visão e valores da empresa.

- **Contato (`contato.php`)**  
  Formulário funcional para envio de mensagens, com backend em `enviar_contato.php`.

- **Área Administrativa (`admin/`)**  
  Sistema de login e painel de administração com as seguintes funcionalidades:
  - **Login (`admin/index.php`)**
  - **Cadastro de imóveis (`admin/adicionar.php`)**
  - **Edição de imóveis (`admin/editar.php`)**
  - **Exclusão (`admin/excluir.php`)**
  - **Gerenciamento de galeria (`admin/upload_galeria.php`, `admin/remover_imagem.php`)**
  - **Logout (`admin/logout.php`)**

---

## 📂 Estrutura do Projeto

```
IMOBILIARIA/
├── admin/
│   ├── adicionar.php
│   ├── editar.php
│   ├── excluir.php
│   ├── imoveis.php
│   ├── index.php
│   ├── logout.php
│   ├── remover_imagem.php
│   └── upload_galeria.php
├── assets/
│   ├── css/
│   ├── img/
│   ├── js/
│   └── responsividade/
├── includes/
│   ├── db.php
│   ├── footer.php
│   └── header.php
├── aluguel.php
├── contato.php
├── detalhes.php
├── enviar_contato.php
├── filtro_aluguel.php
├── filtro_imoveis.php
├── filtro_venda.php
├── galeria.php
├── home.php
├── imoveis.php
├── servicos.php
├── sobre.php
└── venda.php
```

---

## 🔐 Funcionalidades do Painel Administrativo

- Login com autenticação por sessão.
- Listagem de imóveis cadastrados.
- Cadastro de imóveis com imagem principal e galeria.
- Edição completa dos dados dos imóveis.
- Upload e remoção de imagens da galeria.
- Exclusão definitiva de imóveis.
- Logout seguro com encerramento da sessão.

---

## ⚙️ Como Rodar o Projeto Localmente

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/seu-usuario/imobiliaria.git
   ```

2. **Coloque o projeto na pasta do XAMPP**:
   ```bash
   C:\xampp\htdocs\imobiliaria
   ```

3. **Inicie o XAMPP** e ative os serviços:
   - Apache
   - MySQL

4. **Importe o banco de dados**:
   - Abra o `phpMyAdmin`: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Crie um banco com o nome `imobiliaria_db` (ou o que estiver em `includes/db.php`)
   - Importe o arquivo `.sql` correspondente (imobiliaria_db.sql).

5. **Acesse o projeto no navegador**:
   ```bash
   http://localhost/imobiliaria/home.php
   ```

6. **Área Admin**:
   ```bash
   http://localhost/imobiliaria/admin/index.php
   ```
