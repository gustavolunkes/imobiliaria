-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/06/2025 às 14:31
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `imobiliaria_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens`
--

CREATE TABLE `imagens` (
  `id` int(11) NOT NULL,
  `imovel_id` int(11) NOT NULL,
  `arquivo` varchar(255) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `imagens`
--

INSERT INTO `imagens` (`id`, `imovel_id`, `arquivo`, `criado_em`) VALUES
(1, 15, '682f3b731a0db_9b308aaa2024f4e90a9da5d544231533.jpg', '2025-05-22 11:57:55'),
(8, 15, '6834a95d1f42a_ALJ07777-cópia .jpg', '2025-05-26 14:48:13'),
(9, 15, '6835b5288d900_image_dx0wut.png', '2025-05-27 09:50:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis`
--

CREATE TABLE `imoveis` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `tipo` enum('casa','apartamento','terreno','comercial') NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `preco` decimal(12,2) NOT NULL,
  `categoria` enum('venda','aluguel') NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `destaque` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `imoveis`
--

INSERT INTO `imoveis` (`id`, `titulo`, `descricao`, `tipo`, `endereco`, `latitude`, `longitude`, `preco`, `categoria`, `imagem`, `destaque`, `created_at`) VALUES
(1, 'Apartamento Moderno Centro', 'Apartamento com 2 quartos, sala ampla e varanda.', 'apartamento', 'Rua das Flores, 123', 0.00000000, 0.00000000, 350000.00, 'venda', '9b308aaa2024f4e90a9da5d544231533.jpg', 1, '2025-05-17 11:27:28'),
(2, 'Casa Espaçosa no Bairro', 'Casa com 3 quartos, jardim e garagem para 2 carros.', 'casa', 'Av. Brasil, 456', 0.00000000, 0.00000000, 550000.00, 'venda', '9b308aaa2024f4e90a9da5d544231533.jpg', 1, '2025-05-17 11:27:28'),
(3, 'Terreno para Construção', 'Terreno plano com 500m², ótimo para construir.', 'terreno', 'Rua das Palmeiras, 789', 0.00000000, 0.00000000, 150000.00, 'venda', '9b308aaa2024f4e90a9da5d544231533.jpg', 0, '2025-05-17 11:27:28'),
(4, 'Loja Comercial Centro', 'Loja bem localizada para seu negócio.', 'comercial', 'Rua Comercial, 101', 0.00000000, 0.00000000, 700000.00, 'venda', '9b308aaa2024f4e90a9da5d544231533.jpg', 0, '2025-05-17 11:27:28'),
(5, 'Apartamento Compacto', 'Apartamento de 1 quarto ideal para solteiros.', 'apartamento', 'Rua Sol, 202', 0.00000000, 0.00000000, 280000.00, 'venda', '9b308aaa2024f4e90a9da5d544231533.jpg', 0, '2025-05-17 11:27:28'),
(6, 'Casa para Aluguel com Quintal', 'Casa com 2 quartos e quintal espaçoso.', 'casa', 'Rua das Acácias, 55', 0.00000000, 0.00000000, 1500.00, 'aluguel', '9b308aaa2024f4e90a9da5d544231533.jpg', 1, '2025-05-17 11:27:28'),
(7, 'Apartamento Mobiliado', 'Apartamento mobiliado próximo ao centro.', 'apartamento', 'Av. Central, 300', 0.00000000, 0.00000000, 2200.00, 'aluguel', '9b308aaa2024f4e90a9da5d544231533.jpg', 1, '2025-05-17 11:27:28'),
(8, 'Sala Comercial para Aluguel', 'Sala comercial em prédio novo.', 'comercial', 'Rua dos Comerciários, 150', 0.00000000, 0.00000000, 1800.00, 'aluguel', '9b308aaa2024f4e90a9da5d544231533.jpg', 0, '2025-05-17 11:27:28'),
(9, 'Apartamento Simples', 'Apartamento com 1 quarto e cozinha americana.', 'apartamento', 'Rua das Laranjeiras, 78', 0.00000000, 0.00000000, 1200.00, 'aluguel', '9b308aaa2024f4e90a9da5d544231533.jpg', 0, '2025-05-17 11:27:28'),
(10, 'Terreno para Aluguel Temporário', 'Terreno com boa localização para eventos.', 'terreno', 'Estrada Velha, 10', 0.00000000, 0.00000000, 800.00, 'aluguel', '9b308aaa2024f4e90a9da5d544231533.jpg', 0, '2025-05-17 11:27:28'),
(11, 'Casa de Campo', 'Casa em área rural, ideal para descanso.', 'casa', 'Zona Rural, Km 15', 0.00000000, 0.00000000, 400000.00, 'venda', '9b308aaa2024f4e90a9da5d544231533.jpg', 1, '2025-05-17 11:27:28'),
(12, 'Sala Comercial no Centro', 'Sala para escritório ou consultório.', 'comercial', 'Rua Central, 400', 0.00000000, 0.00000000, 300000.00, 'venda', '9b308aaa2024f4e90a9da5d544231533.jpg', 0, '2025-05-17 11:27:28'),
(13, 'Apartamento Luxo', 'Apartamento com 3 quartos e varanda gourmet.', 'apartamento', 'Av. das Nações, 500', 0.00000000, 0.00000000, 900000.00, 'venda', '9b308aaa2024f4e90a9da5d544231533.jpg', 0, '2025-05-17 11:27:28'),
(14, 'Terreno Grande', 'Terreno com 1000m² para construção residencial.', 'terreno', 'R. das Missões, 734 - Marechal, Mal. Cândido Rondon - PR, 85960-304', 0.00000000, 0.00000000, 350000.00, 'venda', '9b308aaa2024f4e90a9da5d544231533.jpg', 1, '2025-05-17 11:27:28'),
(15, 'Apartamento para Temporada', 'Apartamento mobiliado para temporada curta.', 'apartamento', 'R. Santa Catarina, 311 - Centro, Mal. Cândido Rondon - PR, 85960-146', -24.56116320, -54.06507930, 2500.00, 'aluguel', '682f5237d8b89_9b308aaa2024f4e90a9da5d544231533.jpg', 0, '2025-05-17 11:27:28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`) VALUES
(1, 'admin', '123456');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imovel_id` (`imovel_id`);

--
-- Índices de tabela `imoveis`
--
ALTER TABLE `imoveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `imoveis`
--
ALTER TABLE `imoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `imagens`
--
ALTER TABLE `imagens`
  ADD CONSTRAINT `imagens_ibfk_1` FOREIGN KEY (`imovel_id`) REFERENCES `imoveis` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
