-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-07-2025 a las 05:01:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_ajetreados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones`
--

CREATE TABLE `canciones` (
  `id_cancion` int(11) NOT NULL,
  `titulo_cancion` varchar(255) NOT NULL,
  `portada_cancion` varchar(255) NOT NULL,
  `letra_cancion` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `canciones`
--

INSERT INTO `canciones` (`id_cancion`, `titulo_cancion`, `portada_cancion`, `letra_cancion`) VALUES
(14, 'Fama', 'uploads/6866da1cb43ea_no-fue-suerte.jpeg', 'Pero ni con el dinero compra el amor que yo te tenía a ti\r\nA veces me siento solo, necesito a alguien y no estás ahí\r\nDéjame besar tus labios, quiero acariciarte, ya dime qué sí\r\nSolo una noche dame, te lo juro baby, te voy a divertir\r\nFueron bonitos recuerdos, pero ahora tú te encuentras algo más\r\nQuiero volver a pensarte, quiero recordarte y no sentirme mal\r\n\r\nY fama, morritas en mi cama, no me hace falta nada\r\nPero te recuerdo y no estás aquí\r\nFama, no me hace falta nada\r\nPero recordaba en las noches que tú me hacías feliz\r\n\r\nEste 14 la pasaré solo, baby\r\nPero bien acompañado, já\r\nPuro Chuy Montanna, ¿o no, compa güero?\r\nFuerza regida\r\n\r\nMaldito arrepentimiento, la conciencia atrapa y no me deja en paz\r\nPuedo estar con varias morras, pero aun así no te puedo olvidar\r\nEl alcohol a veces sana, pero es momentáneo y todo sigue igual\r\nY aunque te bloqueé del Insta, tus fotos ahí siguen en mi celular\r\n\r\nY fama, morritas en mi cama, no me hace falta nada\r\nPero te recuerdo y no estás ahí\r\nFama, no me hace falta nada\r\nPero recordaba en las noches que tú me hacías feliz\r\n\r\nFama morritas en mi cama (fama, morritas en mi camaa)\r\nPero recordaba en las noches que tú me hacías feliz\r\n\r\nArriba la empresa SM\r\nCompa guero compa chuyy'),
(16, 'Harley Quinn', 'uploads/6866e12c7e802_harley-quinn.avif', 'Baby, bésame la boca, aunque te sepa a vodka\r\nEse polvo rosa que te aloca me provoca\r\nAhí tan los escoltas, vida peligrosa\r\nLa corta en la bolsa, niña, claro que se nota\r\nEn el antro bien coco\r\nY me pongo bien loco\r\nCon las luces en rojo\r\nY tu vato no sabe que yo te provoco\r\nPatrullando en los monstros\r\nBien tapados los rostros\r\nBélico, peligroso, tu culo redondo\r\n¡Otro pedo!\r\nFuerza Regida, viejo\r\nCompa Marshmello\r\nFancy, ella es una fresa\r\nMueve su cadera, todos la desean\r\nCrazy, la plebe está buena\r\nMe cuida la merca, con mis metralletas\r\nSe arma la loquera, Harley Quinn, lista pa guerra\r\nEn el antro bien coco\r\nY me pongo bien loco\r\nCon las luces en rojo\r\nY tu vato no sabe que yo te provoco\r\nPatrullando en los monstros\r\nBien tapados los rostros\r\nBélico, peligroso, tu culo redondo\r\n¡Mafia!\r\nBabies, babies en el antro\r\nMe siguen bailando\r\nQuiere que las ponga en cuatro si ando maníaco\r\nEn el antro bien coco\r\nY me pongo bien loco\r\nCon las luces en rojo\r\nY tu vato no sabe que yo te provoco\r\nJa-ja, ja-ja-ja, ja\r\nBaby\r\nCompa Marshmello\r\nTamos a la orden, viejo'),
(17, 'Ven porque te necesito', 'uploads/68673a522e745_temerarios.jpeg', 'Cuando pienso en ti\r\nMi tristeza crece\r\nTu recuerdo hiere en mi corazón\r\nY quisiera verte\r\nCuando pienso en ti\r\nCuando pienso en ti\r\n\r\n¿Cuándo te veré otra vez, mi vida? ¿Cuándo?\r\nPaso noches imposibles sin tu calor\r\n¿Cuándo te veré otra vez, mi vida? ¿Cuándo?\r\nSon las noches imposibles soñándote\r\n\r\nVen, ven, ven, mi amor\r\nVen alegrar mi vida\r\nVen, ven, mi amor\r\n\r\nSon las noches imposibles\r\nSolo, ya no puedo más\r\nEs tu ausencia la razón\r\nVen, porque te necesito mía, mi amor\r\n\r\n¿Cuándo te veré otra vez, mi vida? ¿Cuándo?\r\nSon las noches imposibles soñándote\r\n\r\nVen, ven, ven, mi amor\r\nVen alegrar mi vida\r\nVen, ven, mi amor\r\n\r\nSon las noches imposibles\r\nSolo ya no puedo más\r\nEs tu ausencia la razón\r\nVen porque te necesito mía, mi amor\r\n\r\nVen alegrar mi vida\r\nVen, porque te necesito mía, mi amor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integrantes`
--

CREATE TABLE `integrantes` (
  `id_integrante` int(11) NOT NULL,
  `nombre_integrante` varchar(255) NOT NULL,
  `numero_telefono_integrante` varchar(10) NOT NULL,
  `contrasena_integrante` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `integrantes`
--

INSERT INTO `integrantes` (`id_integrante`, `nombre_integrante`, `numero_telefono_integrante`, `contrasena_integrante`) VALUES
(1, 'Jonathan Ramos', '8442867567', '$2y$10$tW5FxAX9yZ5wHqMLbJYxEeCBC8a566l0IYnFDPBTbZsSRkWh1Czby'),
(2, 'Alan Ramos', '8441752822', '$2y$10$LEwnIt.iXHU.A8Vvuk9/Cejre0mFQUV3xoGsogItCPxazGFxmcTQe');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD PRIMARY KEY (`id_cancion`);

--
-- Indices de la tabla `integrantes`
--
ALTER TABLE `integrantes`
  ADD PRIMARY KEY (`id_integrante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canciones`
--
ALTER TABLE `canciones`
  MODIFY `id_cancion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `integrantes`
--
ALTER TABLE `integrantes`
  MODIFY `id_integrante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
