-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/01/2025 às 16:53
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
-- Banco de dados: `fitness_gym`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `schedule` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `schedule`) VALUES
(1, 'Yoga', '2024-01-15 08:00:00'),
(2, 'Pilates', '2024-01-16 09:00:00'),
(3, 'Spinning', '2024-01-17 18:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `client_classes`
--

CREATE TABLE `client_classes` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `assigned_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `client_exercises`
--

CREATE TABLE `client_exercises` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `assigned_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `client_exercises`
--

INSERT INTO `client_exercises` (`id`, `client_id`, `exercise_id`, `assigned_date`) VALUES
(7, 1, 26, '2025-01-06'),
(8, 1, 27, '2025-01-06'),
(9, 1, 28, '2025-01-06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `exercise_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `equipment` varchar(100) NOT NULL,
  `sets` int(11) DEFAULT NULL,
  `reps` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `exercises`
--

INSERT INTO `exercises` (`id`, `exercise_name`, `description`, `equipment`, `sets`, `reps`) VALUES
(25, 'Dumbbell bench press', 'Bench, dumbbells', 'Bench, dumbbells', 3, '10'),
(26, 'Dumbbell Bench Press', 'Repetições: 8, 10, 12', 'Bench, dumbbells', 3, '8,10,12'),
(27, 'Lat Pulldown', 'Repetiï¿½es:10', 'Adjustable cable machine, lat pulldown bar', 3, '10'),
(28, 'Overhead Dumbbell Press', 'Repetições: 8, 10, 12', 'Dumbbells', 3, '8,10,12'),
(29, 'Leg Press', 'Repetições: 8, 10, 12', 'Leg press', 3, '8,10,12'),
(30, 'Lying Leg Curl', 'Repetições: 8, 10, 12', 'Lying leg curl', 3, '8,10,12'),
(31, 'Rope Press Down', 'Repetições: 8, 10, 12', 'Adjustable cable machine, rope attachment', 3, '8,10,12'),
(32, 'Barbell Biceps Curl', 'Repetições: 8, 10, 12', 'Barbell', 3, '8,10,12'),
(33, 'Standing Calf Raise', 'Repetições: 8, 10, 12', 'Box', 3, '8,10,12'),
(34, 'Crunch', 'Repetições: 15', 'No equipment', 3, '15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `timetables`
--

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `timetables`
--

INSERT INTO `timetables` (`id`, `day`, `start_time`, `end_time`) VALUES
(1, 'Monday', '06:00:00', '22:00:00'),
(2, 'Tuesday', '06:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','trainer','client') NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `profile_image`) VALUES
(1, 'client', '$2y$10$hzu1QamJM.NDmzJzFWO9r.B.GmfB9HELPObLXrxok7dXNWNQCNHfC', 'client', NULL),
(2, 'rafael', '$2y$10$vkbz2FGkSnAxPdC0MZRO/.UoIMaAEZZMdQl.QKNw2cRtBzkOn/HMC', 'trainer', NULL),
(3, 'dericson', '$2y$10$pwNhvIxQGEFdDDSZJ3/5w.1SzvPG9XU9qhcezyDdV5hPi.HyoJA2a', 'admin', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `client_classes`
--
ALTER TABLE `client_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Índices de tabela `client_exercises`
--
ALTER TABLE `client_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Índices de tabela `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `client_classes`
--
ALTER TABLE `client_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `client_exercises`
--
ALTER TABLE `client_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `client_classes`
--
ALTER TABLE `client_classes`
  ADD CONSTRAINT `client_classes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `client_classes_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Restrições para tabelas `client_exercises`
--
ALTER TABLE `client_exercises`
  ADD CONSTRAINT `client_exercises_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `client_exercises_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
