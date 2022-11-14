-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Nov-2022 às 19:46
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ci4_rest`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `document` bigint(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `customers`
--

INSERT INTO `customers` (`id`, `name`, `document`) VALUES
(1, 'Bryana Kreiger', 206216226),
(2, 'Javonte Hayes', 401619837),
(3, 'Prof. Johnathon Konopelski II', 404282111),
(4, 'Joan Bode', 430856380),
(5, 'Uriah Kassulke DDS', 356505566),
(6, 'Tess Boyle', 544956807),
(7, 'Aaron Morissette', 631690234),
(8, 'Lucy Runolfsdottir PhD', 973917465),
(9, 'Lamont Fisher', 141567029),
(10, 'Vivianne Hickle', 990112938),
(11, 'Darwin Hodkiewicz IV', 923638729),
(12, 'Haven Moore', 143955825),
(13, 'Doris Rau', 503296174),
(14, 'Francisca Huels', 366767485),
(15, 'Dr. Mason Halvorson II', 359108548),
(16, 'Ms. Carissa Lebsack DVM', 521869229),
(17, 'Axel Shanahan', 820385944),
(18, 'Mr. Israel Daniel', 431385186),
(19, 'Prof. Nathanael Macejkovic I', 150679050),
(20, 'Mr. Warren Hirthe I', 302802632),
(21, 'Mrs. Amie Olson Sr.', 762088782),
(22, 'Zakary Feil', 313661489),
(23, 'Prof. Kareem West', 135155230),
(24, 'Joanne Breitenberg', 776303710),
(25, 'Dr. Tre Anderson I', 770485312),
(26, 'Anastacio Krajcik DDS', 762143312),
(27, 'Marques Wilkinson II', 695702505),
(28, 'Dr. Kaleigh Batz', 874198151),
(29, 'Jammie Kuphal', 888492894),
(30, 'Prof. Chaz Block', 738801298),
(31, '123', 123);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-11-10-233834', 'App\\Database\\Migrations\\UserMigration', 'default', 'App', 1668449514, 1),
(2, '2022-11-10-233936', 'App\\Database\\Migrations\\ProductMigration', 'default', 'App', 1668449514, 1),
(3, '2022-11-11-023450', 'App\\Database\\Migrations\\CustomerMigration', 'default', 'App', 1668449514, 1),
(4, '2022-11-11-034555', 'App\\Database\\Migrations\\OrderMigration', 'default', 'App', 1668449514, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `product_id`, `status`) VALUES
(1, 2, 6, '1'),
(2, 26, 18, '2'),
(3, 18, 14, '3'),
(4, 2, 12, '1'),
(5, 17, 11, '3'),
(7, 5, 3, '3'),
(8, 6, 28, '1'),
(9, 1, 29, '2'),
(10, 24, 15, '3'),
(11, 22, 14, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `title`, `price`) VALUES
(1, 'Produto 45', 34),
(3, 'Produto 74', 56),
(4, 'Produto 43', 29),
(5, 'Produto 17', 44),
(6, 'Produto 21', 60),
(7, 'Produto 72', 45),
(8, 'Produto 24', 85),
(9, 'Produto 15', 65),
(10, 'Produto 15', 26),
(11, 'Produto 93', 75),
(12, 'Produto 64', 64),
(13, 'Produto 38', 27),
(14, 'Produto 29', 24),
(15, 'Produto 78', 45),
(16, 'Produto 38', 46),
(17, 'Produto 53', 76),
(18, 'Produto 33', 35),
(19, 'Produto 46', 83),
(20, 'Produto 71', 56),
(21, 'Produto 64', 66),
(22, 'Produto 53', 56),
(23, 'Produto 01', 40),
(24, 'Produto 25', 69),
(25, 'Produto 38', 44),
(26, 'Produto 46', 52),
(27, 'Produto 45', 72),
(28, 'Produto 17', 79),
(29, 'Produto 70', 42),
(30, 'Produto 56', 91),
(31, 'Arroz', 25),
(32, 'Feijão', 1),
(33, '123', 123),
(34, '2', 323123),
(35, '123', 123),
(36, '123', 123),
(37, '123', 123),
(38, '123', 123),
(39, '123', 123),
(40, '123', 123),
(41, '123', 123);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
