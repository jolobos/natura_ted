-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Mar-2024 às 04:21
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `natura_ted`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_clientes` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `CPF` char(14) NOT NULL,
  `telefone` bigint(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `endereco` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_clientes`, `nome`, `CPF`, `telefone`, `email`, `endereco`) VALUES
(11, 'eduardo ted da tegma', '00000000000', 51993596160, 'ted123@gmail.com', 'rua da tegma nÃ£o 000 B. logo ao lado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_venda`
--

CREATE TABLE `itens_venda` (
  `id_it_venda` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` double NOT NULL,
  `data_prod` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itens_venda`
--

INSERT INTO `itens_venda` (`id_it_venda`, `id_venda`, `id_produto`, `quantidade`, `data_prod`) VALUES
(57, 222, 12, 1, '2024-03-28 00:28:03'),
(58, 223, 12, 1, '2024-03-28 21:44:18'),
(59, 223, 15, 1, '2024-03-28 21:44:18'),
(60, 224, 14, 3, '2024-03-28 21:58:53'),
(61, 225, 14, 1, '2024-03-28 22:16:01'),
(62, 226, 14, 3, '2024-03-28 22:30:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `cod_prod` bigint(25) NOT NULL,
  `produto` varchar(100) NOT NULL,
  `quantidade` double(10,2) NOT NULL,
  `valor` double(10,2) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `cod_prod`, `produto`, `quantidade`, `valor`, `descricao`, `status`) VALUES
(12, 102111001, 'nome-do-produto', 3.00, 0.50, 'adicione uma descriÃ§Ã£o rapida.', 1),
(14, 111, 'produto-status-0', 0.00, 11.00, 'adicione uma descriÃ§Ã£o rapida.', 0),
(15, 11111, 'produto-status-1', 11.00, 1111.00, 'adicione uma descriÃ§Ã£o rapida.', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `usuario` varchar(100) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(60) CHARACTER SET utf8 NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `usuario`, `senha`, `nivel`) VALUES
(2, 'josias', '854a3864c2bef0b3948892a2c7b93ddd', 2),
(9, 'eduardo', 'f246a7ca5923d8efb8ffbc84ebacbadb', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id_venda` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total` double(11,2) NOT NULL,
  `data_periodo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id_venda`, `data`, `id_cliente`, `id_usuario`, `total`, `data_periodo`) VALUES
(222, '2024-03-28 00:28:03', 11, 2, 0.50, '2024-03-28 00:00:00'),
(223, '2024-03-28 21:44:18', 11, 2, 1111.50, '2024-03-28 00:00:00'),
(224, '2024-03-28 21:58:53', 11, 2, 33.00, '2024-03-28 00:00:00'),
(225, '2024-03-28 22:16:01', 11, 2, 11.00, '2024-03-28 00:00:00'),
(226, '2024-03-28 22:30:08', 11, 2, 33.00, '2024-03-28 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_clientes`);

--
-- Indexes for table `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD PRIMARY KEY (`id_it_venda`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id_venda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `itens_venda`
--
ALTER TABLE `itens_venda`
  MODIFY `id_it_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
