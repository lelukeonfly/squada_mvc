-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 08:30 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `squada`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `passwort`) VALUES
(1, 'admin', '$2y$10$n5Zqsu07bNLRkbhKQRO.iO4Y4kSxD8ouBaCaapR9gPv7ITHweo0w2');

-- --------------------------------------------------------

--
-- Table structure for table `auktion`
--

CREATE TABLE `auktion` (
  `id` int(11) NOT NULL,
  `anfang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dauer` int(11) NOT NULL DEFAULT 600,
  `spieler_fk` int(11) NOT NULL,
  `vertragszeit` int(11) NOT NULL DEFAULT 3600
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mannschaft`
--

CREATE TABLE `mannschaft` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `loginname` varchar(128) NOT NULL,
  `passwort` varchar(128) NOT NULL,
  `guthaben` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mannschaft`
--

INSERT INTO `mannschaft` (`id`, `name`, `loginname`, `passwort`, `guthaben`) VALUES
(1, 'AB Calcio', 'ABCalcio', '$2y$10$au0.wH/DH6WseEtZbxGWBOsd0ak3Xhs79wMJCvLrBbrJK9PaXRAFa', 27),
(2, 'BVB Prodigy Baileys', 'BVBProdigyBaileys', '$2y$10$xa8gF8x1njA05.oEL.wKjeUjotf1YyHdpD3raezLbURwndK/FueBK', 47),
(3, 'FC Torpedo', 'FCTorpedo', '$2y$10$Zlaz0KMocTQNpkFNZxwENOXIne.0ISBUsliQayZN1rhbt8dGvGwky', 105),
(4, 'FC Stardust', 'FCStardust', '$2y$10$TsO1aaVH8VAMfDwCMrT63uqf/dmetq8yTZZ/yXxN6Gtc0s5yEuIR2', 43),
(5, 'The Annoying B\'s FC', 'TheAnnoyingBsFC', '$2y$10$G2.zYQyRWezNbCOHG5uH0.YkkH6/ZLph.vOuoKXX/fIwisV8lsIya', 120),
(6, 'Real Dugongo', 'RealDugongo', '$2y$10$4YLO8ivelL.UhMjOFdL6kupjW8QkQowHTvidPVWAAVEvEqZMFRz8O', 59),
(7, 'FC Gogo RabBits', 'FCGogoRabBits', '$2y$10$igmQqVshxnDf5ul8kDnB0utNCHNo6lHrpofx1G8gJ9wYDzFFcxi6O', 70),
(8, 'Pollo Zabov', 'PolloZabov', '$2y$10$GaNVGdmWWuQic5bXgxXt0e8PSj0ViS8nKp4OGcMfOa1wi0vVgQsk.', 78),
(9, 'Reggina 2021', 'Reggina2021', '$2y$10$jjz1NRyUtL28C9JXgBNCG.gQlhfOfkfH9mhstpWO7W.O55O6SGsZu', 55),
(10, 'SG Club', 'SGClub', '$2y$10$SeSw5hehZsT9n4Zduzmr5.O6ktUo8EDI9xOkJ0IGvgGL9BifyaUZ2', 70);

-- --------------------------------------------------------

--
-- Table structure for table `nimmt_teil`
--

CREATE TABLE `nimmt_teil` (
  `mannschaft_fk` int(11) NOT NULL,
  `auktion_fk` int(11) NOT NULL,
  `wann` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `geld` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `spieler`
--

CREATE TABLE `spieler` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `position` char(1) NOT NULL,
  `mannschaft` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spieler`
--

INSERT INTO `spieler` (`id`, `name`, `position`, `mannschaft`) VALUES
(3, 'Neri Filippo', 'G', 'VENEZIA'),
(4, 'Russo Antonio', 'G', 'SALERNITANA'),
(5, 'Satalino Giacomo', 'G', 'SASSUOLO'),
(6, 'Cangiano Gianmarco', 'S', 'BOLOGNA'),
(7, 'Munteanu Louis', 'S', 'FIORENTINA'),
(8, 'Yepes Gerard', 'M', 'SAMPDORIA'),
(13, 'Distefano Filippo', 'S', 'FIORENTINA'),
(14, 'Soulé Matìas', 'S', 'JUVENTUS'),
(15, 'Volpato Cristian', 'C', 'ROMA'),
(101, 'Aresti Simone', 'G', 'CAGLIARI'),
(103, 'Belec Vid', 'G', 'SALERNITANA'),
(104, 'Berardi Alessandro ', 'G', 'VERONA'),
(106, 'Boer Pietro', 'G', 'ROMA'),
(114, 'Falcone Wladimiro', 'G', 'SAMPDORIA'),
(115, 'Fuzato Daniel', 'G', 'ROMA'),
(117, 'Guerrieri Guido', 'G', 'SALERNITANA'),
(119, 'Furlan Jacopo', 'G', 'EMPOLI'),
(121, 'Lezzerini Luca', 'G', 'VENEZIA'),
(124, 'Marchetti Federico', 'G', 'GENOA'),
(130, 'Padelli Daniele', 'G', 'UDINESE'),
(132, 'Pandur Ivor', 'G', 'VERONA'),
(133, 'Pegolo Gianluca', 'G', 'SASSUOLO'),
(135, 'Pinsoglio Carlo', 'G', 'JUVENTUS'),
(136, 'Plizzari Alessandro', 'G', 'MILAN'),
(138, 'Radu Ionut Andrei', 'G', 'INTER'),
(141, 'Ravaglia Nicola', 'G', 'SAMPDORIA'),
(143, 'Rosati Antonio', 'G', 'FIORENTINA'),
(144, 'Rossi Francesco', 'G', 'ATALANTA'),
(155, 'Terracciano Pietro', 'G', 'FIORENTINA'),
(157, 'Jeroen Zoet', 'G', 'SPEZIA'),
(159, 'Andrenacci Lorenzo', 'G', 'GENOA'),
(162, 'Adamonis Marius', 'G', 'LAZIO'),
(163, 'Fiorillo Vincenzo', 'G', 'SALERNITANA'),
(164, 'Semper Adrian', 'G', 'GENOA'),
(165, 'Bertinato Bruno', 'G', 'VENEZIA'),
(166, 'Gemello Luca', 'G', 'TORINO'),
(167, 'Marfella Davide', 'G', 'NAPOLI'),
(168, 'Zovko Petar', 'G', 'SPEZIA'),
(169, 'Ujkani Samir', 'G', 'EMPOLI'),
(176, 'Romero Sergio', 'G', 'VENEZIA'),
(207, 'Aya Ramzi', 'D', 'SALERNITANA'),
(208, 'Ayhan Kaan', 'D', 'SASSUOLO'),
(209, 'Bani Mattia', 'D', 'GENOA'),
(213, 'Binks Luis Thomas', 'D', 'BOLOGNA'),
(217, 'Bogdan Luka', 'D', 'SALERNITANA'),
(221, 'Buongiorno Alessandro', 'D', 'TORINO'),
(224, 'Calafiori Riccardo', 'D', 'ROMA'),
(227, 'Carboni Andrea', 'D', 'CAGLIARI'),
(230, 'Ceccherini Federico', 'D', 'VERONA'),
(231, 'Ceppitelli Luca', 'D', 'CAGLIARI'),
(232, 'Cetin Mert', 'D', 'VERONA'),
(233, 'Chabot Julian', 'D', 'SAMPDORIA'),
(235, 'Chiriches Vlad', 'D', 'SASSUOLO'),
(238, 'Conti Andrea', 'D', 'MILAN'),
(239, 'Corbo Gabriele', 'D', 'BOLOGNA'),
(243, 'D\'Ambrosio Danilo', 'D', 'INTER'),
(247, 'Dawidowicz Pawel', 'D', 'VERONA'),
(249, 'De Maio Sebastian', 'D', 'UDINESE'),
(250, 'De Sciglio Mattia', 'D', 'JUVENTUS'),
(256, 'Depaoli Fabio', 'D', 'SAMPDORIA'),
(258, 'Dijks Mitchell', 'D', 'BOLOGNA'),
(260, 'Djidji Koffi', 'D', 'TORINO'),
(262, 'Dragusin Radu', 'D', 'SAMPDORIA'),
(264, 'Durmisi Riza', 'D', 'LAZIO'),
(265, 'Ebuehi Tyronne', 'D', 'VENEZIA'),
(269, 'Fares Mohamed', 'D', 'GENOA'),
(270, 'Ferrari Alex', 'D', 'SAMPDORIA'),
(273, 'Ferrer Salva', 'D', 'SPEZIA'),
(274, 'Fiamozzi Riccardo', 'D', 'EMPOLI'),
(276, 'Frabotta Gianluca', 'D', 'VERONA'),
(277, 'Gabbia Matteo', 'D', 'MILAN'),
(278, 'Ghiglione Paolo', 'D', 'GENOA'),
(279, 'Ghoulam Faouzi', 'D', 'NAPOLI'),
(281, 'Goldaniga Edoardo', 'D', 'SASSUOLO'),
(284, 'Gyomber Norbert', 'D', 'SALERNITANA'),
(292, 'Ismajli Ardian', 'D', 'EMPOLI'),
(294, 'Jaroszynski Pawel', 'D', 'SALERNITANA'),
(295, 'Kalulu', 'D', 'MILAN'),
(296, 'Kamenovic Dimitrije', 'D', 'LAZIO'),
(299, 'Kolarov Aleksandar', 'D', 'INTER'),
(301, 'Kumbulla Marash', 'D', 'ROMA'),
(302, 'Kyriakopoulos Georgios', 'D', 'SASSUOLO'),
(306, 'Lovato Matteo', 'D', 'ATALANTA'),
(308, 'Luperto Sebastiano', 'D', 'EMPOLI'),
(312, 'Magnani Giangiacomo', 'D', 'VERONA'),
(313, 'Malcuit Kevin', 'D', 'NAPOLI'),
(317, 'Marchizza Riccardo', 'D', 'EMPOLI'),
(321, 'Masiello Andrea', 'D', 'GENOA'),
(322, 'Mazzocchi Pasquale', 'D', 'VENEZIA'),
(323, 'Mbaye Ibrahima', 'D', 'BOLOGNA'),
(324, 'Medel Gary', 'M', 'BOLOGNA'),
(326, 'Modolo Marco', 'D', 'VENEZIA'),
(328, 'Molinaro Cristian', 'D', 'VENEZIA'),
(331, 'Murru Nicola', 'D', 'SAMPDORIA'),
(332, 'Nikolaou Dimitrios', 'D', 'SPEZIA'),
(336, 'Parisi Fabiano', 'D', 'EMPOLI'),
(337, 'Patric', 'D', 'LAZIO'),
(340, 'Peluso Federico', 'D', 'SASSUOLO'),
(343, 'Radovanovic Ivan', 'D', 'GENOA'),
(344, 'Radu Stefan', 'D', 'LAZIO'),
(346, 'Ranieri Luca', 'D', 'SALERNITANA'),
(347, 'Ranocchia Andrea', 'D', 'INTER'),
(348, 'Reca Arkadiusz', 'D', 'SPEZIA'),
(349, 'Reynolds Bryan', 'D', 'ROMA'),
(354, 'Romagna Filippo', 'D', 'SASSUOLO'),
(356, 'Romagnoli Simone', 'D', 'EMPOLI'),
(359, 'Rüegg Kevin', 'D', 'VERONA'),
(360, 'Rugani Daniele', 'D', 'JUVENTUS'),
(362, 'Sabelli Stefano', 'D', 'GENOA'),
(363, 'Sala Jacopo', 'D', 'SPEZIA'),
(365, 'Samir', 'D', 'UDINESE'),
(366, 'Schnegg David', 'D', 'VENEZIA'),
(371, 'Soumaoro Adama', 'D', 'BOLOGNA'),
(372, 'Sutalo Bosko', 'D', 'VERONA'),
(375, 'Terzic Aleksa', 'D', 'FIORENTINA'),
(376, 'Toljan Jeremy', 'D', 'SASSUOLO'),
(380, 'Tonelli Lorenzo', 'D', 'EMPOLI'),
(383, 'Vavro Denis', 'D', 'LAZIO'),
(384, 'Venuti Lorenzo', 'D', 'FIORENTINA'),
(385, 'Veseli Frederic', 'D', 'SALERNITANA'),
(388, 'Vojvoda Mergim', 'D', 'TORINO'),
(389, 'Walukiewicz Sebastian', 'D', 'CAGLIARI'),
(392, 'Zeegelaar Marvin', 'D', 'UDINESE'),
(393, 'Ballo-Touré Fodé', 'D', 'MILAN'),
(394, 'Vanheusden Zinho', 'D', 'GENOA'),
(396, 'Altare Giorgio', 'D', 'CAGLIARI'),
(397, 'Zortea Nadir', 'D', 'SALERNITANA'),
(399, 'Amian Kelvin', 'D', 'SPEZIA'),
(400, 'Strandberg Stefan', 'D', 'SALERNITANA'),
(401, 'Pezzella Giuseppe', 'D', 'ATALANTA'),
(403, 'Kechrida Wajdi', 'D', 'SALERNITANA'),
(404, 'Faragò Paolo', 'D', 'CAGLIARI'),
(406, 'Vásquez Johan', 'D', 'GENOA'),
(409, 'Serpe Laurens', 'D', 'GENOA'),
(410, 'Juan Jesus', 'D', 'NAPOLI'),
(411, 'Nastasic Matija', 'D', 'FIORENTINA'),
(413, 'Pérez Nehuén', 'D', 'UDINESE'),
(416, 'Zanoli Alessandro', 'D', 'NAPOLI'),
(418, 'Maksimovic Nikola', 'D', 'GENOA'),
(419, 'Soppy Brandon', 'D', 'UDINESE'),
(420, 'Delli Carri Filippo', 'D', 'SALERNITANA'),
(421, 'Zima David', 'D', 'TORINO'),
(423, 'Haps Ridgeciano', 'D', 'VENEZIA'),
(425, 'Bellanova Raoul', 'D', 'CAGLIARI'),
(426, 'Kiwior Jakub', 'D', 'SPEZIA'),
(427, 'Caceres Martin', 'D', 'CAGLIARI'),
(431, 'Obert Adam', 'D', 'CAGLIARI'),
(436, 'Scalvini Giorgio', 'D', 'ATALANTA'),
(501, 'Akpa Akpro Jean-Daniel', 'M', 'LAZIO'),
(505, 'Askildsen Kristoffer', 'M', 'SAMPDORIA'),
(511, 'Baselli Daniele', 'M', 'TORINO'),
(513, 'Kone Ben Lhassine', 'M', 'TORINO'),
(514, 'Benassi Marco', 'M', 'FIORENTINA'),
(523, 'Capezzi Leonardo', 'M', 'SALERNITANA'),
(524, 'Cassata Francesco', 'M', 'GENOA'),
(530, 'Crnigoj Domen', 'M', 'VENEZIA'),
(532, 'Damiani Samuele', 'M', 'EMPOLI'),
(533, 'Darboe Ebrima', 'M', 'ROMA'),
(536, 'Demme Diego', 'M', 'NAPOLI'),
(537, 'Dezi Jacopo', 'M', 'VENEZIA'),
(539, 'Diawara Amadou', 'M', 'ROMA'),
(542, 'Duncan Joseph Alfred', 'M', 'FIORENTINA'),
(546, 'Escalante Gonzalo', 'M', 'LAZIO'),
(549, 'Fiordilino Luca', 'M', 'VENEZIA'),
(553, 'Gagliardini Roberto', 'M', 'INTER'),
(555, 'Hongla Martin', 'M', 'VERONA'),
(557, 'Jajalo Mato', 'M', 'UDINESE'),
(560, 'Michael Kingsley', 'M', 'BOLOGNA'),
(561, 'Kovalenko Viktor', 'M', 'SPEZIA'),
(562, 'Krunic Rade', 'M', 'MILAN'),
(564, 'Ladinetti Riccardo', 'M', 'CAGLIARI'),
(571, 'Lobotka Stanislav', 'M', 'NAPOLI'),
(577, 'Magnanelli Francesco', 'M', 'SASSUOLO'),
(579, 'Maleh Youssef', 'M', 'FIORENTINA'),
(584, 'Melegoni Filippo', 'M', 'GENOA'),
(587, 'Nicolussi Caviglia Hans', 'M', 'JUVENTUS'),
(588, 'Obiang Pedro', 'M', 'SASSUOLO'),
(589, 'Oliva Christian', 'M', 'CAGLIARI'),
(590, 'Palumbo Martin', 'M', 'JUVENTUS'),
(599, 'Portanova Manolo', 'M', 'GENOA'),
(603, 'Rincon Tomas', 'M', 'TORINO'),
(607, 'Schiavone Andrea', 'M', 'SALERNITANA'),
(608, 'Schouten Jerdy', 'M', 'BOLOGNA'),
(610, 'Sena Léo', 'M', 'SPEZIA'),
(612, 'Silva Adrian', 'M', 'SAMPDORIA'),
(615, 'Sturaro Stefano', 'M', 'GENOA'),
(621, 'Vacca Antonio Junior', 'M', 'VENEZIA'),
(622, 'Vecino Matias', 'M', 'INTER'),
(625, 'Vidal Arturo', 'M', 'INTER'),
(626, 'Vieira Ronaldo', 'M', 'SAMPDORIA'),
(627, 'Villar Gonzalo', 'M', 'ROMA'),
(633, 'Behrami Valon', 'M', 'GENOA'),
(639, 'Coulibaly Lassana', 'M', 'SALERNITANA'),
(640, 'Henrique Matheus', 'M', 'SASSUOLO'),
(643, 'Kastanos Grigoris', 'M', 'SALERNITANA'),
(645, 'Asllani Kristjan', 'M', 'EMPOLI'),
(646, 'Bianco Alessandro', 'M', 'FIORENTINA'),
(647, 'Sher Aimar', 'M', 'SPEZIA'),
(648, 'Grassi Alberto', 'M', 'CAGLIARI'),
(649, 'Basic Toma', 'M', 'LAZIO'),
(651, 'Bakayoko Tiemouè', 'M', 'MILAN'),
(653, 'Kiyine Sofian', 'M', 'VENEZIA'),
(655, 'Touré Abdoulaye', 'M', 'GENOA'),
(657, 'Harroui Abdou', 'M', 'SASSUOLO'),
(658, 'De Vries Jack', 'M', 'VENEZIA'),
(659, 'Galdames Pablo', 'M', 'GENOA'),
(662, 'Bove Edoardo', 'D', 'ROMA'),
(666, 'Viola Nicolas', 'S', 'BOLOGNA'),
(701, 'Ala-Myllymäki Lauri', 'M', 'VENEZIA'),
(707, 'Bessa Daniel', 'M', 'VERONA'),
(708, 'Bjarkason Bjarki Steinn', 'M', 'VENEZIA'),
(709, 'Adekanye Bobby', 'S', 'LAZIO'),
(716, 'Castillejo Samu', 'M', 'MILAN'),
(719, 'Colley Ebrima', 'S', 'SPEZIA'),
(726, 'Edera Simone', 'S', 'TORINO'),
(738, 'Johnsen Dennis', 'S', 'VENEZIA'),
(739, 'Jony', 'M', 'LAZIO'),
(745, 'Maldini Daniel', 'M', 'MILAN'),
(747, 'Micin Petar', 'S', 'UDINESE'),
(752, 'Moro Raul', 'S', 'LAZIO'),
(756, 'Ounas Adam', 'S', 'NAPOLI'),
(758, 'Pereiro Gastón', 'S', 'CAGLIARI'),
(759, 'Pérez Carles', 'S', 'ROMA'),
(764, 'Ragusa Antonino', 'S', 'VERONA'),
(765, 'Ramsey Aaron', 'M', 'JUVENTUS'),
(769, 'Sansone Nicola', 'S', 'BOLOGNA'),
(771, 'Skov Olsen Andreas', 'M', 'BOLOGNA'),
(775, 'Urbanski Kacper', 'M', 'BOLOGNA'),
(777, 'Verdi Simone', 'M', 'TORINO'),
(778, 'Verre Valerio', 'M', 'SAMPDORIA'),
(780, 'Warming Magnus', 'S', 'TORINO'),
(782, 'Zalewski Nicola', 'M', 'ROMA'),
(787, 'Stojkovic Dennis', 'M', 'TORINO'),
(789, 'Cancellieri Matteo', 'S', 'VERONA'),
(790, 'Sigurdsson Arnór', 'M', 'VENEZIA'),
(791, 'Samardzic Lazar', 'M', 'UDINESE'),
(792, 'Romero Luka', 'M', 'LAZIO'),
(794, 'Anderson André', 'M', 'LAZIO'),
(795, 'Ihattaren Mohamed', 'S', 'SAMPDORIA'),
(799, 'Bah Issa', 'S', 'VENEZIA'),
(801, 'Ciervo Riccardo', 'M', 'SAMPDORIA'),
(804, 'Podgoreanu Suf', 'M', 'SPEZIA'),
(807, 'Farias Diego', 'S', 'CAGLIARI'),
(808, 'Gondo Cedric', 'S', 'SALERNITANA'),
(903, 'Bianchi Flavio', 'S', 'GENOA'),
(904, 'Bocalon Riccardo', 'S', 'VENEZIA'),
(906, 'Buksa Aleksander', 'S', 'GENOA'),
(909, 'Ceter Damir', 'S', 'CAGLIARI'),
(910, 'Colidio Facundo', 'S', 'INTER'),
(915, 'Djuric Milan', 'S', 'SALERNITANA'),
(918, 'Forestieri Fernando', 'S', 'UDINESE'),
(919, 'Forte Francesco', 'S', 'VENEZIA'),
(925, 'Kokorin Aleksandr', 'S', 'FIORENTINA'),
(929, 'La Mantia Andrea', 'S', 'EMPOLI'),
(937, 'Mayoral Borja', 'S', 'ROMA'),
(941, 'Mraz Samuel', 'S', 'SPEZIA'),
(944, 'Nestorovski Ilija', 'S', 'UDINESE'),
(946, 'Okaka Stefano', 'S', 'UDINESE'),
(957, 'Salcedo Mora Eddy Anthony', 'S', 'SPEZIA'),
(960, 'Santander Federico', 'S', 'BOLOGNA'),
(965, 'Teodorczyk Lukasz', 'S', 'UDINESE'),
(966, 'Torregrossa Ernesto', 'S', 'SAMPDORIA'),
(967, 'Van Hooijdonk Sydney', 'S', 'BOLOGNA'),
(971, 'Zaza Simone', 'S', 'TORINO'),
(974, 'Satriano Martín', 'S', 'INTER'),
(975, 'Kaio Jorge', 'S', 'JUVENTUS'),
(976, 'Ekuban Caleb', 'S', 'GENOA'),
(978, 'Ekong Emmanuel', 'S', 'EMPOLI'),
(984, 'Kallon Yayah', 'S', 'GENOA'),
(988, 'Pellegri Pietro', 'S', 'MILAN'),
(993, 'Manaj Rey', 'S', 'SPEZIA'),
(995, 'Vergani Edoardo', 'S', 'SALERNITANA'),
(997, 'Strelec David', 'S', 'SPEZIA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auktion`
--
ALTER TABLE `auktion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spieler_fk` (`spieler_fk`);

--
-- Indexes for table `mannschaft`
--
ALTER TABLE `mannschaft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nimmt_teil`
--
ALTER TABLE `nimmt_teil`
  ADD KEY `mannschaft_fk` (`mannschaft_fk`),
  ADD KEY `auktion_fk` (`auktion_fk`);

--
-- Indexes for table `spieler`
--
ALTER TABLE `spieler`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auktion`
--
ALTER TABLE `auktion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mannschaft`
--
ALTER TABLE `mannschaft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `spieler`
--
ALTER TABLE `spieler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=998;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auktion`
--
ALTER TABLE `auktion`
  ADD CONSTRAINT `spieler_fk` FOREIGN KEY (`spieler_fk`) REFERENCES `spieler` (`id`);

--
-- Constraints for table `nimmt_teil`
--
ALTER TABLE `nimmt_teil`
  ADD CONSTRAINT `auktion_fk` FOREIGN KEY (`auktion_fk`) REFERENCES `auktion` (`id`),
  ADD CONSTRAINT `mannschaft_fk` FOREIGN KEY (`mannschaft_fk`) REFERENCES `mannschaft` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
