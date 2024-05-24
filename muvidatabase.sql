-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/05/2024 às 22:18
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `muvidatabase`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `poster_path` varchar(255) DEFAULT NULL,
  `genres` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `movie_id`, `title`, `poster_path`, `genres`) VALUES
(28, 4, 1023922, 'MaXXXine', '/k2L4Lsuo7dndJXBFGm2j95eTi1X.jpg', 'Crime, Terror, Thriller'),
(29, 4, 50546, 'Esposa de Mentirinha', '/v8ct2LskBXLcPHrW3uvtpyTcwfl.jpg', 'Comédia, Romance'),
(30, 4, 14836, 'Coraline e o Mundo Secreto', '/rranXmvqPT4NoXzmxhFtXr9nNYT.jpg', 'Animação, Família, Fantasia'),
(34, 3, 50546, 'Esposa de Mentirinha', '/v8ct2LskBXLcPHrW3uvtpyTcwfl.jpg', 'Comédia, Romance'),
(35, 3, 9297, 'A Casa Monstro', '/qBEpDF693Bql7roL6LY3SsNHg52.jpg', 'Animação, Comédia, Família, Fantasia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome_sobrenome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `apelido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome_sobrenome`, `senha`, `apelido`, `email`, `data_nascimento`) VALUES
(2, 'Ana Banana', 'senha1234', 'Ana a Banana', 'anabanana@banana.com', '2004-05-16'),
(3, 'Joao Bananao', 'senha1234', 'Joao o Bananao', 'joaobananao@banana.com', '2004-04-16'),
(4, 'Emillaynes', 'senha123', 'Beijinho', 'emillayne@beijinho.com', '1999-09-25');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`movie_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
