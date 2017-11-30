--
-- Base de données :  `neozorus`
--

-- --------------------------------------------------------

--
-- Structure de la table `abilite`
--

CREATE TABLE `abilite` (
  `a_id` int(11) NOT NULL,
  `a_libelle` varchar(60) DEFAULT NULL,
  `a_description` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `abilite`
--

INSERT INTO `abilite` (`a_id`, `a_libelle`, `a_description`) VALUES
(1, 'Bouclier', 'L’adversaire sera obligé d’attaquer en premier les serviteurs dotés de Bouclier. Cependant, il est possible de choisir une cible entre plusieurs créatures avec Provocation.'),
(2, 'Pioche1', 'Pioche une carte'),
(3, 'Pioche2', 'Pioche deux cartes');

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

CREATE TABLE `carte` (
  `c_id` int(11) NOT NULL,
  `c_libelle` varchar(60) DEFAULT NULL,
  `c_type` varchar(60) DEFAULT NULL,
  `c_puissance` int(11) DEFAULT NULL,
  `c_pvMax` int(11) DEFAULT NULL,
  `c_mana` int(11) DEFAULT NULL,
  `c_personnage_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `carte`
--

INSERT INTO `carte` (`c_id`, `c_libelle`, `c_type`, `c_puissance`, `c_pvMax`, `c_mana`, `c_personnage_fk`) VALUES
(1, 'TRINITY', 'sort', 1, NULL, 1, 1),
(2, 'MORPHEUS', 'sort', 4, NULL, 3, 1),
(3, 'L''ORACLE', 'sort', 6, NULL, 5, 1),
(4, 'L''AGENT SMITH', 'creature', 2, 1, 1, 1),
(5, 'LE MAÎTRE DES CLEFS', 'creature', 2, 3, 2, 1),
(6, 'CYPHER', 'creature', 5, 3, 3, 1),
(7, 'LES TWINS', 'creature', 2, 4, 4, 1),
(8, 'NIOBE', 'creature', 7, 5, 5, 1),
(9, 'L''ARCHITECTE', 'creature', 8, 6, 7, 1),
(10, 'LE FEMME EN ROUGE', 'creature', 1, 3, 1, 1),
(11, 'SENTINELLE', 'creature', 3, 6, 3, 1),
(12, 'LE CHAT NOIR', 'speciale', 9, 9, 9, 1),
(13, 'PARASAUROLOPHUS', 'sort', 2, NULL, 1, 2),
(14, 'TRICÉRATOPS', 'sort', 5, NULL, 3, 2),
(15, 'PTERODACTYL', 'sort', 7, NULL, 5, 2),
(16, 'KRONOSAURUS', 'creature', 1, 1, 1, 2),
(17, 'PROTOCERATOPS', 'creature', 2, 3, 2, 2),
(18, 'BRACHIOSAURE', 'creature', 4, 3, 3, 2),
(19, 'DILOPHOSAURE', 'creature', 2, 4, 4, 2),
(20, 'SPINOSAURE', 'creature', 6, 5, 5, 2),
(21, 'PACHYCEPHALOSAURUS', 'creature', 8, 6, 7, 2),
(22, 'ANKYLOSAURE', 'creature', 1, 3, 1, 2),
(23, 'ELASMASAURUS', 'creature', 3, 6, 3, 2),
(24, 'RAPTOR JESUS', 'speciale', 9, 9, 9, 2);

-- --------------------------------------------------------

--
-- Structure de la table `c_a_inclure`
--

CREATE TABLE `c_a_inclure` (
  `c_a_abilite_fk` int(11) NOT NULL,
  `c_a_carte_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `c_a_inclure`
--

INSERT INTO `c_a_inclure` (`c_a_abilite_fk`, `c_a_carte_fk`) VALUES
(1, 10),
(1, 11),
(1, 22),
(1, 23),
(2, 8),
(2, 18),
(3, 2),
(3, 11),
(3, 14),
(3, 20);

-- --------------------------------------------------------

--
-- Structure de la table `deck`
--

CREATE TABLE `deck` (
  `d_id` int(11) NOT NULL,
  `d_libelle` varchar(60) NOT NULL,
  `d_nbMaxCarte` int(11) DEFAULT NULL,
  `d_personnage_fk` int(11) DEFAULT NULL,
  `d_user_fk` int(11) DEFAULT NULL,
  `d_waiting` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `deck`
--

INSERT INTO `deck` (`d_id`, `d_libelle`, `d_nbMaxCarte`, `d_personnage_fk`, `d_user_fk`, `d_waiting`) VALUES
(1, 'Matrix', 20, 1, 1, 0),
(2, 'Dino', 20, 2, 2, 0),
(3, 'DeckMatrix', 20, 1, 7, 0),
(4, 'DeckDino', 20, 2, 8, 0),
(5, 'Default', 20, 2, 7, 0),
(6, 'Default', 20, 1, 8, 0);

-- --------------------------------------------------------

--
-- Structure de la table `d_c_inclure`
--

CREATE TABLE `d_c_inclure` (
  `d_c_nbExemplaire` int(11) DEFAULT NULL,
  `d_c_deck_fk` int(11) NOT NULL,
  `d_c_carte_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `d_c_inclure`
--

INSERT INTO `d_c_inclure` (`d_c_nbExemplaire`, `d_c_deck_fk`, `d_c_carte_fk`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 1, 3),
(2, 1, 4),
(2, 1, 5),
(2, 1, 6),
(2, 1, 7),
(2, 1, 8),
(2, 1, 9),
(2, 1, 10),
(2, 1, 11),
(1, 1, 12),
(1, 2, 13),
(1, 2, 14),
(1, 2, 15),
(2, 2, 16),
(2, 2, 17),
(2, 2, 18),
(2, 2, 19),
(2, 2, 20),
(2, 2, 21),
(2, 2, 22),
(2, 2, 23),
(1, 2, 24),
(1, 3, 1),
(1, 3, 2),
(1, 3, 3),
(2, 3, 4),
(2, 3, 5),
(2, 3, 6),
(2, 3, 7),
(2, 3, 8),
(2, 3, 9),
(2, 3, 10),
(2, 3, 11),
(1, 3, 12),
(1, 4, 13),
(1, 4, 14),
(1, 4, 15),
(2, 4, 16),
(2, 4, 17),
(2, 4, 18),
(2, 4, 19),
(2, 4, 20),
(2, 4, 21),
(2, 4, 22),
(2, 4, 23),
(1, 4, 24),
(1, 5, 13),
(1, 5, 14),
(1, 5, 15),
(2, 5, 16),
(2, 5, 17),
(2, 5, 18),
(2, 5, 19),
(2, 5, 20),
(2, 5, 21),
(2, 5, 22),
(2, 5, 23),
(1, 5, 24),
(1, 6, 1),
(1, 6, 2),
(1, 6, 3),
(2, 6, 4),
(2, 6, 5),
(2, 6, 6),
(2, 6, 7),
(2, 6, 8),
(2, 6, 9),
(2, 6, 10),
(2, 6, 11),
(1, 6, 12);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE `game` (
  `g_id` int(20) NOT NULL,
  `g_data` mediumtext NOT NULL,
  `g_player1` int(11) NOT NULL,
  `g_player2` int(11) NOT NULL,
  `g_running` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`g_id`, `g_data`, `g_player1`, `g_player2`, `g_running`) VALUES
(1, 'O:14:"GameController":9:{s:18:"\0GameController\0id";s:1:"1";s:23:"\0GameController\0players";a:4:{i:0;O:6:"Joueur":10:{s:10:"\0Joueur\0id";s:1:"8";s:14:"\0Joueur\0pseudo";s:5:"User2";s:12:"\0Joueur\0deck";O:8:"GameDeck":3:{s:12:"\0GameDeck\0id";s:1:"4";s:16:"\0GameDeck\0cartes";a:20:{i:0;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"18";s:17:"\0GameCard\0libelle";s:12:"BRACHIOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"4";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\18.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:1;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"15";s:17:"\0GameCard\0libelle";s:11:"PTERODACTYL";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"7";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:32:".\\assets\\img\\gabarit\\sort\\15.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:2;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"21";s:17:"\0GameCard\0libelle";s:18:"PACHYCEPHALOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\21.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:3;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"22";s:17:"\0GameCard\0libelle";s:11:"ANKYLOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\22.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:4;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"16";s:17:"\0GameCard\0libelle";s:11:"KRONOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"1";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\16.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:5;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"19";s:17:"\0GameCard\0libelle";s:12:"DILOPHOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"4";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\19.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:6;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"21";s:17:"\0GameCard\0libelle";s:18:"PACHYCEPHALOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\21.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:7;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"17";s:17:"\0GameCard\0libelle";s:13:"PROTOCERATOPS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\17.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:8;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"18";s:17:"\0GameCard\0libelle";s:12:"BRACHIOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"4";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\18.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:9;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"20";s:17:"\0GameCard\0libelle";s:10:"SPINOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"6";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";s:1:"5";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\20.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:10;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"22";s:17:"\0GameCard\0libelle";s:11:"ANKYLOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\22.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:11;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"13";s:17:"\0GameCard\0libelle";s:15:"PARASAUROLOPHUS";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:32:".\\assets\\img\\gabarit\\sort\\13.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:12;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"24";s:17:"\0GameCard\0libelle";s:12:"RAPTOR JESUS";s:14:"\0GameCard\0type";s:8:"speciale";s:19:"\0GameCard\0puissance";s:1:"9";s:15:"\0GameCard\0pvMax";s:1:"9";s:14:"\0GameCard\0mana";s:1:"9";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"9";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\speciale\\24.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:13;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"23";s:17:"\0GameCard\0libelle";s:12:"ELASMASAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\23.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:14;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"14";s:17:"\0GameCard\0libelle";s:12:"TRICÉRATOPS";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"5";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:32:".\\assets\\img\\gabarit\\sort\\14.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:15;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"17";s:17:"\0GameCard\0libelle";s:13:"PROTOCERATOPS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\17.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:16;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"19";s:17:"\0GameCard\0libelle";s:12:"DILOPHOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"4";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\19.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:17;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"16";s:17:"\0GameCard\0libelle";s:11:"KRONOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"1";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\16.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:18;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"20";s:17:"\0GameCard\0libelle";s:10:"SPINOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"6";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";s:1:"5";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\20.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:19;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"23";s:17:"\0GameCard\0libelle";s:12:"ELASMASAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\23.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}}s:15:"\0GameDeck\0heros";s:1:"2";}s:12:"\0Joueur\0main";a:0:{}s:14:"\0Joueur\0pioche";a:20:{i:0;r:10;i:1;r:25;i:2;r:40;i:3;r:55;i:4;r:70;i:5;r:85;i:6;r:100;i:7;r:115;i:8;r:130;i:9;r:145;i:10;r:160;i:11;r:175;i:12;r:190;i:13;r:205;i:14;r:220;i:15;r:235;i:16;r:250;i:17;r:265;i:18;r:280;i:19;r:295;}s:15:"\0Joueur\0plateau";a:0:{}s:16:"\0Joueur\0defausse";a:0:{}s:10:"\0Joueur\0pv";i:20;s:12:"\0Joueur\0mana";i:0;s:15:"\0Joueur\0visable";i:1;}i:1;O:6:"Joueur":10:{s:10:"\0Joueur\0id";s:1:"7";s:14:"\0Joueur\0pseudo";s:5:"User1";s:12:"\0Joueur\0deck";O:8:"GameDeck":3:{s:12:"\0GameDeck\0id";s:1:"3";s:16:"\0GameDeck\0cartes";a:20:{i:0;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"7";s:17:"\0GameCard\0libelle";s:9:"LES TWINS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"4";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\7.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:1;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"6";s:17:"\0GameCard\0libelle";s:6:"CYPHER";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"5";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\6.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:2;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"5";s:17:"\0GameCard\0libelle";s:20:"LE MAÎTRE DES CLEFS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\5.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:3;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"9";s:17:"\0GameCard\0libelle";s:12:"L''ARCHITECTE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\9.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:4;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"8";s:17:"\0GameCard\0libelle";s:5:"NIOBE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"7";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";s:1:"5";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\8.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:5;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"4";s:17:"\0GameCard\0libelle";s:13:"L''AGENT SMITH";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"1";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\4.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:6;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"5";s:17:"\0GameCard\0libelle";s:20:"LE MAÎTRE DES CLEFS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\5.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:7;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"2";s:17:"\0GameCard\0libelle";s:8:"MORPHEUS";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"4";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:31:".\\assets\\img\\gabarit\\sort\\2.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:8;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"11";s:17:"\0GameCard\0libelle";s:10:"SENTINELLE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:2:{i:0;s:1:"1";i:1;s:1:"3";}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\11.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:9;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"10";s:17:"\0GameCard\0libelle";s:17:"LE FEMME EN ROUGE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\10.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:10;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"11";s:17:"\0GameCard\0libelle";s:10:"SENTINELLE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:2:{i:0;s:1:"1";i:1;s:1:"3";}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\11.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:11;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"1";s:17:"\0GameCard\0libelle";s:7:"TRINITY";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:31:".\\assets\\img\\gabarit\\sort\\1.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:12;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"9";s:17:"\0GameCard\0libelle";s:12:"L''ARCHITECTE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\9.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:13;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"10";s:17:"\0GameCard\0libelle";s:17:"LE FEMME EN ROUGE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\10.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:14;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"3";s:17:"\0GameCard\0libelle";s:8:"L''ORACLE";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"6";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:31:".\\assets\\img\\gabarit\\sort\\3.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:15;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"4";s:17:"\0GameCard\0libelle";s:13:"L''AGENT SMITH";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"1";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\4.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:16;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"8";s:17:"\0GameCard\0libelle";s:5:"NIOBE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"7";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";s:1:"5";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\8.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:17;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"12";s:17:"\0GameCard\0libelle";s:12:"LE CHAT NOIR";s:14:"\0GameCard\0type";s:8:"speciale";s:19:"\0GameCard\0puissance";s:1:"9";s:15:"\0GameCard\0pvMax";s:1:"9";s:14:"\0GameCard\0mana";s:1:"9";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"9";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\speciale\\12.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:18;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"7";s:17:"\0GameCard\0libelle";s:9:"LES TWINS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"4";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\7.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:19;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"6";s:17:"\0GameCard\0libelle";s:6:"CYPHER";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"5";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\6.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}}s:15:"\0GameDeck\0heros";s:1:"1";}s:12:"\0Joueur\0main";a:0:{}s:14:"\0Joueur\0pioche";a:20:{i:0;r:344;i:1;r:359;i:2;r:374;i:3;r:389;i:4;r:404;i:5;r:419;i:6;r:434;i:7;r:449;i:8;r:464;i:9;r:480;i:10;r:495;i:11;r:511;i:12;r:526;i:13;r:541;i:14;r:556;i:15;r:571;i:16;r:586;i:17;r:601;i:18;r:616;i:19;r:631;}s:15:"\0Joueur\0plateau";a:0:{}s:16:"\0Joueur\0defausse";a:0:{}s:10:"\0Joueur\0pv";i:20;s:12:"\0Joueur\0mana";i:0;s:15:"\0Joueur\0visable";i:1;}i:2;O:6:"Joueur":10:{s:10:"\0Joueur\0id";s:1:"7";s:14:"\0Joueur\0pseudo";s:5:"User1";s:12:"\0Joueur\0deck";O:8:"GameDeck":3:{s:12:"\0GameDeck\0id";s:1:"3";s:16:"\0GameDeck\0cartes";a:20:{i:0;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"11";s:17:"\0GameCard\0libelle";s:10:"SENTINELLE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:2:{i:0;s:1:"1";i:1;s:1:"3";}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\11.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:1;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"8";s:17:"\0GameCard\0libelle";s:5:"NIOBE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"7";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";s:1:"5";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\8.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:2;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"4";s:17:"\0GameCard\0libelle";s:13:"L''AGENT SMITH";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"1";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\4.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:3;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"6";s:17:"\0GameCard\0libelle";s:6:"CYPHER";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"5";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\6.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:4;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"9";s:17:"\0GameCard\0libelle";s:12:"L''ARCHITECTE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\9.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:5;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"10";s:17:"\0GameCard\0libelle";s:17:"LE FEMME EN ROUGE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\10.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:6;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"5";s:17:"\0GameCard\0libelle";s:20:"LE MAÎTRE DES CLEFS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\5.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:7;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"9";s:17:"\0GameCard\0libelle";s:12:"L''ARCHITECTE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\9.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:8;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"12";s:17:"\0GameCard\0libelle";s:12:"LE CHAT NOIR";s:14:"\0GameCard\0type";s:8:"speciale";s:19:"\0GameCard\0puissance";s:1:"9";s:15:"\0GameCard\0pvMax";s:1:"9";s:14:"\0GameCard\0mana";s:1:"9";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"9";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\speciale\\12.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:9;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"6";s:17:"\0GameCard\0libelle";s:6:"CYPHER";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"5";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\6.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:10;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"4";s:17:"\0GameCard\0libelle";s:13:"L''AGENT SMITH";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"1";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\4.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:11;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"5";s:17:"\0GameCard\0libelle";s:20:"LE MAÎTRE DES CLEFS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\5.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:12;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"3";s:17:"\0GameCard\0libelle";s:8:"L''ORACLE";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"6";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:31:".\\assets\\img\\gabarit\\sort\\3.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:13;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"1";s:17:"\0GameCard\0libelle";s:7:"TRINITY";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:31:".\\assets\\img\\gabarit\\sort\\1.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:14;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"11";s:17:"\0GameCard\0libelle";s:10:"SENTINELLE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:2:{i:0;s:1:"1";i:1;s:1:"3";}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\11.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:15;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"7";s:17:"\0GameCard\0libelle";s:9:"LES TWINS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"4";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\7.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:16;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"10";s:17:"\0GameCard\0libelle";s:17:"LE FEMME EN ROUGE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\10.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:17;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"8";s:17:"\0GameCard\0libelle";s:5:"NIOBE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"7";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";s:1:"5";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\8.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:18;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"7";s:17:"\0GameCard\0libelle";s:9:"LES TWINS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"4";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\7.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:19;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"2";s:17:"\0GameCard\0libelle";s:8:"MORPHEUS";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"4";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:31:".\\assets\\img\\gabarit\\sort\\2.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}}s:15:"\0GameDeck\0heros";s:1:"1";}s:12:"\0Joueur\0main";a:3:{i:111;r:680;i:81;r:696;i:42;r:711;}s:14:"\0Joueur\0pioche";a:17:{i:0;r:726;i:1;r:741;i:2;r:756;i:3;r:771;i:4;r:786;i:5;r:801;i:6;r:816;i:7;r:831;i:8;r:846;i:9;r:861;i:10;r:876;i:11;r:891;i:12;r:907;i:13;r:922;i:14;r:937;i:15;r:952;i:16;r:967;}s:15:"\0Joueur\0plateau";a:0:{}s:16:"\0Joueur\0defausse";a:0:{}s:10:"\0Joueur\0pv";i:20;s:12:"\0Joueur\0mana";i:1;s:15:"\0Joueur\0visable";i:1;}i:3;O:6:"Joueur":10:{s:10:"\0Joueur\0id";s:1:"8";s:14:"\0Joueur\0pseudo";s:5:"User2";s:12:"\0Joueur\0deck";O:8:"GameDeck":3:{s:12:"\0GameDeck\0id";s:1:"4";s:16:"\0GameDeck\0cartes";a:20:{i:0;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"19";s:17:"\0GameCard\0libelle";s:12:"DILOPHOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"4";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\19.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:1;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"22";s:17:"\0GameCard\0libelle";s:11:"ANKYLOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\22.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:2;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"16";s:17:"\0GameCard\0libelle";s:11:"KRONOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"1";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\16.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:3;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"17";s:17:"\0GameCard\0libelle";s:13:"PROTOCERATOPS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\17.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:4;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"21";s:17:"\0GameCard\0libelle";s:18:"PACHYCEPHALOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\21.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:5;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"15";s:17:"\0GameCard\0libelle";s:11:"PTERODACTYL";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"7";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:32:".\\assets\\img\\gabarit\\sort\\15.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:6;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"17";s:17:"\0GameCard\0libelle";s:13:"PROTOCERATOPS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\17.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:7;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"14";s:17:"\0GameCard\0libelle";s:12:"TRICÉRATOPS";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"5";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:32:".\\assets\\img\\gabarit\\sort\\14.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:8;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"23";s:17:"\0GameCard\0libelle";s:12:"ELASMASAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\23.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:9;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"18";s:17:"\0GameCard\0libelle";s:12:"BRACHIOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"4";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\18.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:10;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"24";s:17:"\0GameCard\0libelle";s:12:"RAPTOR JESUS";s:14:"\0GameCard\0type";s:8:"speciale";s:19:"\0GameCard\0puissance";s:1:"9";s:15:"\0GameCard\0pvMax";s:1:"9";s:14:"\0GameCard\0mana";s:1:"9";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"9";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\speciale\\24.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:11;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"20";s:17:"\0GameCard\0libelle";s:10:"SPINOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"6";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";s:1:"5";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\20.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:12;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"22";s:17:"\0GameCard\0libelle";s:11:"ANKYLOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\22.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:13;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"13";s:17:"\0GameCard\0libelle";s:15:"PARASAUROLOPHUS";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:32:".\\assets\\img\\gabarit\\sort\\13.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:14;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"20";s:17:"\0GameCard\0libelle";s:10:"SPINOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"6";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";s:1:"5";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\20.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:15;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"16";s:17:"\0GameCard\0libelle";s:11:"KRONOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"1";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\16.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:16;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"19";s:17:"\0GameCard\0libelle";s:12:"DILOPHOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"4";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\19.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:17;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"23";s:17:"\0GameCard\0libelle";s:12:"ELASMASAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\23.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:18;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"18";s:17:"\0GameCard\0libelle";s:12:"BRACHIOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"4";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\18.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:19;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"21";s:17:"\0GameCard\0libelle";s:18:"PACHYCEPHALOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\21.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}}s:15:"\0GameDeck\0heros";s:1:"2";}s:12:"\0Joueur\0main";a:0:{}s:14:"\0Joueur\0pioche";a:20:{i:0;r:1016;i:1;r:1031;i:2;r:1046;i:3;r:1061;i:4;r:1076;i:5;r:1091;i:6;r:1106;i:7;r:1121;i:8;r:1136;i:9;r:1151;i:10;r:1166;i:11;r:1181;i:12;r:1196;i:13;r:1211;i:14;r:1226;i:15;r:1241;i:16;r:1256;i:17;r:1271;i:18;r:1286;i:19;r:1301;}s:15:"\0Joueur\0plateau";a:0:{}s:16:"\0Joueur\0defausse";a:0:{}s:10:"\0Joueur\0pv";i:20;s:12:"\0Joueur\0mana";i:0;s:15:"\0Joueur\0visable";i:1;}}s:20:"\0GameController\0tour";i:1;s:19:"\0GameController\0EoG";b:0;s:21:"\0GameController\0jeton";i:0;s:28:"\0GameController\0piocheEtMana";i:1;s:13:"\0*\0parameters";a:3:{s:10:"controller";s:4:"game";s:6:"action";s:4:"wait";s:2:"id";s:1:"4";}s:7:"\0*\0data";a:0:{}s:10:"\0*\0session";a:1:{s:4:"u_id";s:1:"8";}}', 7, 8, 0);
INSERT INTO `game` (`g_id`, `g_data`, `g_player1`, `g_player2`, `g_running`) VALUES
(3, 'O:14:"GameController":9:{s:18:"\0GameController\0id";s:1:"3";s:23:"\0GameController\0players";a:2:{i:0;O:6:"Joueur":10:{s:10:"\0Joueur\0id";s:1:"8";s:14:"\0Joueur\0pseudo";s:5:"User2";s:12:"\0Joueur\0deck";O:8:"GameDeck":3:{s:12:"\0GameDeck\0id";s:1:"4";s:16:"\0GameDeck\0cartes";a:20:{i:0;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"22";s:17:"\0GameCard\0libelle";s:11:"ANKYLOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\22.png";s:16:"\0GameCard\0active";i:1;s:17:"\0GameCard\0visable";i:1;}i:1;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"20";s:17:"\0GameCard\0libelle";s:10:"SPINOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"6";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\20.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:2;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"19";s:17:"\0GameCard\0libelle";s:12:"DILOPHOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\19.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:3;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"21";s:17:"\0GameCard\0libelle";s:18:"PACHYCEPHALOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\21.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:4;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"16";s:17:"\0GameCard\0libelle";s:11:"KRONOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\16.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:0;}i:5;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"22";s:17:"\0GameCard\0libelle";s:11:"ANKYLOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\22.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:6;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"23";s:17:"\0GameCard\0libelle";s:12:"ELASMASAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\23.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:7;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"20";s:17:"\0GameCard\0libelle";s:10:"SPINOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"6";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";s:1:"5";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\20.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:8;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"23";s:17:"\0GameCard\0libelle";s:12:"ELASMASAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\23.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:9;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"21";s:17:"\0GameCard\0libelle";s:18:"PACHYCEPHALOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\21.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:10;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"14";s:17:"\0GameCard\0libelle";s:12:"TRICÉRATOPS";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"5";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:32:".\\assets\\img\\gabarit\\sort\\14.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:11;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"18";s:17:"\0GameCard\0libelle";s:12:"BRACHIOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"4";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\18.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:12;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"17";s:17:"\0GameCard\0libelle";s:13:"PROTOCERATOPS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\17.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:13;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"15";s:17:"\0GameCard\0libelle";s:11:"PTERODACTYL";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"7";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:32:".\\assets\\img\\gabarit\\sort\\15.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:14;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"24";s:17:"\0GameCard\0libelle";s:12:"RAPTOR JESUS";s:14:"\0GameCard\0type";s:8:"speciale";s:19:"\0GameCard\0puissance";s:1:"9";s:15:"\0GameCard\0pvMax";s:1:"9";s:14:"\0GameCard\0mana";s:1:"9";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"9";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\speciale\\24.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:15;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"17";s:17:"\0GameCard\0libelle";s:13:"PROTOCERATOPS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\17.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:16;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"19";s:17:"\0GameCard\0libelle";s:12:"DILOPHOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"4";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\19.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:17;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"18";s:17:"\0GameCard\0libelle";s:12:"BRACHIOSAURE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"4";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\18.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:18;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"16";s:17:"\0GameCard\0libelle";s:11:"KRONOSAURUS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"1";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\16.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:19;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"13";s:17:"\0GameCard\0libelle";s:15:"PARASAUROLOPHUS";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:32:".\\assets\\img\\gabarit\\sort\\13.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}}s:15:"\0GameDeck\0heros";s:1:"2";}s:12:"\0Joueur\0main";a:5:{i:212;r:55;i:201;r:115;i:211;r:145;i:172;r:190;i:171;r:235;}s:14:"\0Joueur\0pioche";a:4:{i:0;r:250;i:1;r:265;i:2;r:280;i:3;r:295;}s:15:"\0Joueur\0plateau";a:1:{i:241;r:220;}s:16:"\0Joueur\0defausse";a:10:{i:161;r:70;i:221;r:10;i:232;r:100;i:222;r:85;i:192;r:40;i:141;r:160;i:151;r:205;i:231;r:130;i:202;r:25;i:181;r:175;}s:10:"\0Joueur\0pv";i:0;s:12:"\0Joueur\0mana";i:0;s:15:"\0Joueur\0visable";i:1;}i:1;O:6:"Joueur":10:{s:10:"\0Joueur\0id";s:1:"7";s:14:"\0Joueur\0pseudo";s:5:"User1";s:12:"\0Joueur\0deck";O:8:"GameDeck":3:{s:12:"\0GameDeck\0id";s:1:"3";s:16:"\0GameDeck\0cartes";a:20:{i:0;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"5";s:17:"\0GameCard\0libelle";s:20:"LE MAÎTRE DES CLEFS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\5.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:0;}i:1;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"11";s:17:"\0GameCard\0libelle";s:10:"SENTINELLE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:2:{i:0;s:1:"1";i:1;s:1:"3";}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\11.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:2;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"3";s:17:"\0GameCard\0libelle";s:8:"L''ORACLE";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"6";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:31:".\\assets\\img\\gabarit\\sort\\3.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:3;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"7";s:17:"\0GameCard\0libelle";s:9:"LES TWINS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\7.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:4;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"9";s:17:"\0GameCard\0libelle";s:12:"L''ARCHITECTE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\9.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:5;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"10";s:17:"\0GameCard\0libelle";s:17:"LE FEMME EN ROUGE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\10.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:6;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"8";s:17:"\0GameCard\0libelle";s:5:"NIOBE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"7";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";s:1:"5";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\8.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:7;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"11";s:17:"\0GameCard\0libelle";s:10:"SENTINELLE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"3";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:2:{i:0;s:1:"1";i:1;s:1:"3";}s:12:"\0GameCard\0pv";i:0;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\11.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:8;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"8";s:17:"\0GameCard\0libelle";s:5:"NIOBE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"7";s:15:"\0GameCard\0pvMax";s:1:"5";s:14:"\0GameCard\0mana";s:1:"5";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"2";}s:12:"\0GameCard\0pv";i:1;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\8.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:9;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"2";s:17:"\0GameCard\0libelle";s:8:"MORPHEUS";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"4";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"3";}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:31:".\\assets\\img\\gabarit\\sort\\2.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:10;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"5";s:17:"\0GameCard\0libelle";s:20:"LE MAÎTRE DES CLEFS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"2";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\5.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:11;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"4";s:17:"\0GameCard\0libelle";s:13:"L''AGENT SMITH";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"1";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\4.png";s:16:"\0GameCard\0active";i:1;s:17:"\0GameCard\0visable";i:1;}i:12;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"1";s:17:"\0GameCard\0libelle";s:7:"TRINITY";s:14:"\0GameCard\0type";s:4:"sort";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";N;s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";N;s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:31:".\\assets\\img\\gabarit\\sort\\1.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:13;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"6";s:17:"\0GameCard\0libelle";s:6:"CYPHER";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"5";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\6.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:14;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"9";s:17:"\0GameCard\0libelle";s:12:"L''ARCHITECTE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"8";s:15:"\0GameCard\0pvMax";s:1:"6";s:14:"\0GameCard\0mana";s:1:"7";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"6";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\9.png";s:16:"\0GameCard\0active";i:1;s:17:"\0GameCard\0visable";i:1;}i:15;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"7";s:17:"\0GameCard\0libelle";s:9:"LES TWINS";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"4";s:14:"\0GameCard\0mana";s:1:"4";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"4";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\7.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:16;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"12";s:17:"\0GameCard\0libelle";s:12:"LE CHAT NOIR";s:14:"\0GameCard\0type";s:8:"speciale";s:19:"\0GameCard\0puissance";s:1:"9";s:15:"\0GameCard\0pvMax";s:1:"9";s:14:"\0GameCard\0mana";s:1:"9";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"9";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\speciale\\12.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:17;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"6";s:17:"\0GameCard\0libelle";s:6:"CYPHER";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"5";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"3";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:2;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\6.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:18;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:2:"10";s:17:"\0GameCard\0libelle";s:17:"LE FEMME EN ROUGE";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"1";s:15:"\0GameCard\0pvMax";s:1:"3";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;s:1:"1";}s:12:"\0GameCard\0pv";s:1:"3";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:1;s:14:"\0GameCard\0path";s:36:".\\assets\\img\\gabarit\\creature\\10.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}i:19;O:8:"GameCard":13:{s:12:"\0GameCard\0id";s:1:"4";s:17:"\0GameCard\0libelle";s:13:"L''AGENT SMITH";s:14:"\0GameCard\0type";s:8:"creature";s:19:"\0GameCard\0puissance";s:1:"2";s:15:"\0GameCard\0pvMax";s:1:"1";s:14:"\0GameCard\0mana";s:1:"1";s:17:"\0GameCard\0abilite";a:1:{i:0;i:0;}s:12:"\0GameCard\0pv";s:1:"1";s:22:"\0GameCard\0localisation";i:1;s:16:"\0GameCard\0indice";i:2;s:14:"\0GameCard\0path";s:35:".\\assets\\img\\gabarit\\creature\\4.png";s:16:"\0GameCard\0active";i:0;s:17:"\0GameCard\0visable";i:1;}}s:15:"\0GameDeck\0heros";s:1:"1";}s:12:"\0Joueur\0main";a:7:{i:92;r:405;i:82;r:435;i:51;r:496;i:62;r:541;i:71;r:571;i:121;r:586;i:61;r:601;}s:14:"\0Joueur\0pioche";a:2:{i:0;r:616;i:1;r:631;}s:15:"\0Joueur\0plateau";a:3:{i:81;r:466;i:41;r:511;i:91;r:556;}s:16:"\0Joueur\0defausse";a:8:{i:31;r:375;i:111;r:359;i:21;r:481;i:112;r:450;i:52;r:344;i:102;r:420;i:72;r:390;i:11;r:526;}s:10:"\0Joueur\0pv";i:8;s:12:"\0Joueur\0mana";i:9;s:15:"\0Joueur\0visable";i:1;}}s:20:"\0GameController\0tour";i:9;s:19:"\0GameController\0EoG";b:1;s:21:"\0GameController\0jeton";s:1:"1";s:28:"\0GameController\0piocheEtMana";i:1;s:13:"\0*\0parameters";a:3:{s:10:"controller";s:4:"game";s:6:"action";s:4:"play";s:5:"jeton";s:1:"1";}s:7:"\0*\0data";a:0:{}s:10:"\0*\0session";a:2:{s:4:"u_id";s:1:"7";s:4:"GAME";s:1:"3";}}', 8, 7, 0);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `h_id` int(11) NOT NULL,
  `h_numTour` int(11) DEFAULT NULL,
  `h_attaquant` tinyint(1) DEFAULT NULL,
  `h_action` varchar(25) DEFAULT NULL,
  `h_cible` varchar(25) DEFAULT NULL,
  `h_date` date DEFAULT NULL,
  `h_partie_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

CREATE TABLE `partie` (
  `p_id` int(11) NOT NULL,
  `p_etat` tinyint(1) DEFAULT NULL,
  `p_gagnant` varchar(25) DEFAULT NULL,
  `p_joueur1` int(11) DEFAULT NULL,
  `p_joueur2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

CREATE TABLE `personnage` (
  `p_id` int(11) NOT NULL,
  `p_libelle` varchar(60) NOT NULL,
  `p_pvMax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `personnage`
--

INSERT INTO `personnage` (`p_id`, `p_libelle`, `p_pvMax`) VALUES
(1, 'NEO', 20),
(2, 'TYRANNOSAURE REX', 20);

-- --------------------------------------------------------

--
-- Structure de la table `saloncarte`
--

CREATE TABLE `saloncarte` (
  `s_id` int(11) NOT NULL,
  `s_mana` int(11) DEFAULT NULL,
  `s_pv` int(11) DEFAULT NULL,
  `s_puissance` int(11) DEFAULT NULL,
  `s_lieu` varchar(25) DEFAULT NULL,
  `s_user_fk` int(11) DEFAULT NULL,
  `s_partie_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `s_c_composer`
--

CREATE TABLE `s_c_composer` (
  `s_c_salonCarte_fk` int(11) NOT NULL,
  `s_c_carte_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_mail` varchar(60) DEFAULT NULL,
  `u_pseudo` varchar(60) DEFAULT NULL,
  `u_mdp` varchar(255) DEFAULT NULL,
  `u_nom` varchar(60) DEFAULT NULL,
  `u_prenom` varchar(60) DEFAULT NULL,
  `u_dateNaissance` date DEFAULT NULL,
  `u_offre` tinyint(1) NOT NULL,
  `u_question` mediumtext NOT NULL,
  `u_reponse` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`u_id`, `u_mail`, `u_pseudo`, `u_mdp`, `u_nom`, `u_prenom`, `u_dateNaissance`, `u_offre`, `u_question`, `u_reponse`) VALUES
(1, 'arnaud.ruffault@hotmail.fr', 'Nono', 'test', 'ruffault', 'arnaud', '1990-09-07', 0, '', ''),
(2, 'amandine@mail.com', 'mignon', 'cornichon', 'di bernardo', 'amandine', '1992-11-05', 0, '', ''),
(3, 'ruffault.arnaud@gmail.com', '', '$2y$10$m9awnISVY8THZk9ZnAY9z..NiBhUQ9a58VDIPcWW.s9qz0aVskgXq', 'RUFFAULT', 'Arnaud', '1990-09-07', 0, 'ma prenom?', 'Arnaud'),
(4, 'jane.doe@gmail.com', '', '$2y$10$YbS4z/BOLXDHJPwF88NnDOg8p8QIA8nBV7ZMkSH5oYQzJc5RKlxiu', 'DOE', 'Jane', '1990-09-07', 0, 'mon prenom?', 'Jane'),
(5, 'user@mail.mail', 'user', '$2y$10$0WlGRtieSdwaC5asS8POR.fjKLbyTAmPHxzT/mahYJNbdQghfPRJK', 'user', 'user', '2011-11-11', 0, 'Pourquoi?', 'Parce que'),
(6, 'test@mail.mail', 'test', '$2y$10$TfBLqnjGzY68i29PI89iIOe0zSRfKAY.a5asKL5Eka0b2J/qCbyzy', 'test', 'test', '2010-10-10', 0, 'p', 'p'),
(7, 'user1@mail.mail', 'User1', '$2y$10$NGkAn05xK4MHUHRuAyX1se/Qiqr4LliZ2D.MKKJBvZGU0./XikW0y', 'Un', 'User', '2000-12-20', 0, 'Why?', 'Because'),
(8, 'user2@mail.mail', 'User2', '$2y$10$sSEwEdb7HJLqrS.75zNAPeyVdACoX2HMiJ5m8VW3AWvIxbdBJzFw.', 'Deux', 'User', '1998-05-10', 0, 'Why?', 'Because');

-- --------------------------------------------------------

--
-- Structure de la table `u_p_jouer`
--

CREATE TABLE `u_p_jouer` (
  `u_p_pvPersonnage` int(11) DEFAULT NULL,
  `u_p_manaPersonnage` int(11) DEFAULT NULL,
  `u_p_user_fk` int(11) NOT NULL,
  `u_p_partie_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `abilite`
--
ALTER TABLE `abilite`
  ADD PRIMARY KEY (`a_id`);

--
-- Index pour la table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `FK_carte_p_id` (`c_personnage_fk`);

--
-- Index pour la table `c_a_inclure`
--
ALTER TABLE `c_a_inclure`
  ADD PRIMARY KEY (`c_a_abilite_fk`,`c_a_carte_fk`),
  ADD KEY `FK_c_a_inclure_c_id` (`c_a_carte_fk`);

--
-- Index pour la table `deck`
--
ALTER TABLE `deck`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `FK_deck_p_id` (`d_personnage_fk`),
  ADD KEY `FK_deck_u_id` (`d_user_fk`);

--
-- Index pour la table `d_c_inclure`
--
ALTER TABLE `d_c_inclure`
  ADD PRIMARY KEY (`d_c_deck_fk`,`d_c_carte_fk`),
  ADD KEY `FK_d_c_inclure_c_id` (`d_c_carte_fk`);

--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`g_id`),
  ADD KEY `g_player1` (`g_player1`),
  ADD KEY `g_player2` (`g_player2`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`h_id`),
  ADD KEY `FK_historique_p_id` (`h_partie_fk`);

--
-- Index pour la table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`p_id`);

--
-- Index pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD PRIMARY KEY (`p_id`);

--
-- Index pour la table `saloncarte`
--
ALTER TABLE `saloncarte`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `FK_salonCarte_u_id` (`s_user_fk`),
  ADD KEY `FK_salonCarte_p_id` (`s_partie_fk`);

--
-- Index pour la table `s_c_composer`
--
ALTER TABLE `s_c_composer`
  ADD PRIMARY KEY (`s_c_salonCarte_fk`,`s_c_carte_fk`),
  ADD KEY `FK_s_c_composer_c_id` (`s_c_carte_fk`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- Index pour la table `u_p_jouer`
--
ALTER TABLE `u_p_jouer`
  ADD PRIMARY KEY (`u_p_user_fk`,`u_p_partie_fk`),
  ADD KEY `FK_u_p_jouer_p_id` (`u_p_partie_fk`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `abilite`
--
ALTER TABLE `abilite`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `carte`
--
ALTER TABLE `carte`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `deck`
--
ALTER TABLE `deck`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `game`
--
ALTER TABLE `game`
  MODIFY `g_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `partie`
--
ALTER TABLE `partie`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `personnage`
--
ALTER TABLE `personnage`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `saloncarte`
--
ALTER TABLE `saloncarte`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `FK_carte_p_id` FOREIGN KEY (`c_personnage_fk`) REFERENCES `personnage` (`p_id`);

--
-- Contraintes pour la table `c_a_inclure`
--
ALTER TABLE `c_a_inclure`
  ADD CONSTRAINT `FK_c_a_inclure_a_id` FOREIGN KEY (`c_a_abilite_fk`) REFERENCES `abilite` (`a_id`),
  ADD CONSTRAINT `FK_c_a_inclure_c_id` FOREIGN KEY (`c_a_carte_fk`) REFERENCES `carte` (`c_id`);

--
-- Contraintes pour la table `deck`
--
ALTER TABLE `deck`
  ADD CONSTRAINT `FK_deck_p_id` FOREIGN KEY (`d_personnage_fk`) REFERENCES `personnage` (`p_id`),
  ADD CONSTRAINT `FK_deck_u_id` FOREIGN KEY (`d_user_fk`) REFERENCES `user` (`u_id`);

--
-- Contraintes pour la table `d_c_inclure`
--
ALTER TABLE `d_c_inclure`
  ADD CONSTRAINT `FK_d_c_inclure_c_id` FOREIGN KEY (`d_c_carte_fk`) REFERENCES `carte` (`c_id`),
  ADD CONSTRAINT `FK_d_c_inclure_d_id` FOREIGN KEY (`d_c_deck_fk`) REFERENCES `deck` (`d_id`);

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`g_player1`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`g_player2`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `FK_historique_p_id` FOREIGN KEY (`h_partie_fk`) REFERENCES `partie` (`p_id`);

--
-- Contraintes pour la table `saloncarte`
--
ALTER TABLE `saloncarte`
  ADD CONSTRAINT `FK_salonCarte_p_id` FOREIGN KEY (`s_partie_fk`) REFERENCES `partie` (`p_id`),
  ADD CONSTRAINT `FK_salonCarte_u_id` FOREIGN KEY (`s_user_fk`) REFERENCES `user` (`u_id`);

--
-- Contraintes pour la table `s_c_composer`
--
ALTER TABLE `s_c_composer`
  ADD CONSTRAINT `FK_s_c_composer_c_id` FOREIGN KEY (`s_c_carte_fk`) REFERENCES `carte` (`c_id`),
  ADD CONSTRAINT `FK_s_c_composer_s_id` FOREIGN KEY (`s_c_salonCarte_fk`) REFERENCES `saloncarte` (`s_id`),
  ADD CONSTRAINT `s_c_composer_ibfk_1` FOREIGN KEY (`s_c_salonCarte_fk`) REFERENCES `saloncarte` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `u_p_jouer`
--
ALTER TABLE `u_p_jouer`
  ADD CONSTRAINT `FK_u_p_jouer_p_id` FOREIGN KEY (`u_p_partie_fk`) REFERENCES `partie` (`p_id`),
  ADD CONSTRAINT `FK_u_p_jouer_u_id` FOREIGN KEY (`u_p_user_fk`) REFERENCES `user` (`u_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
