-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 12 Décembre 2017 à 09:36
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
(3, 'DeckMatrix', 20, 1, 7, 0),
(4, 'DeckDino', 20, 2, 8, 0),
(18, 'Default', 20, 2, 7, 0),
(30, 'NeoLeBoss', 20, 1, 8, 0),
(42, 'Neo', 20, 1, 9, 0),
(43, 'Default', 20, 1, NULL, 0),
(44, 'Dino2', 20, 2, 9, 0),
(45, 'Default', 20, 2, 10, 0);

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
(1, 18, 13),
(1, 18, 14),
(1, 18, 15),
(2, 18, 16),
(2, 18, 17),
(2, 18, 18),
(2, 18, 19),
(2, 18, 20),
(2, 18, 21),
(2, 18, 22),
(2, 18, 23),
(1, 18, 24),
(1, 30, 1),
(1, 30, 2),
(1, 30, 3),
(2, 30, 4),
(2, 30, 5),
(2, 30, 6),
(2, 30, 7),
(2, 30, 8),
(2, 30, 9),
(2, 30, 10),
(2, 30, 11),
(1, 30, 12),
(1, 42, 1),
(1, 42, 2),
(1, 42, 3),
(2, 42, 4),
(2, 42, 5),
(2, 42, 6),
(2, 42, 7),
(2, 42, 8),
(2, 42, 9),
(2, 42, 10),
(2, 42, 11),
(1, 42, 12),
(1, 44, 13),
(1, 44, 14),
(1, 44, 15),
(2, 44, 16),
(2, 44, 17),
(2, 44, 18),
(2, 44, 19),
(2, 44, 20),
(2, 44, 21),
(2, 44, 22),
(2, 44, 23),
(1, 44, 24),
(1, 45, 13),
(1, 45, 14),
(1, 45, 15),
(2, 45, 16),
(2, 45, 17),
(2, 45, 18),
(2, 45, 19),
(2, 45, 20),
(2, 45, 21),
(2, 45, 22),
(2, 45, 23),
(1, 45, 24);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE `game` (
  `g_id` int(20) NOT NULL,
  `g_data` text NOT NULL,
  `g_player1` int(11) NOT NULL,
  `g_player2` int(11) NOT NULL,
  `g_running` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Structure de la table `langue`
--

CREATE TABLE `langue` (
  `l_id` int(11) NOT NULL,
  `l_libelle` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `langue`
--

INSERT INTO `langue` (`l_id`, `l_libelle`) VALUES
(1, 'français'),
(2, 'english');

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

CREATE TABLE `partie` (
  `p_id` int(11) NOT NULL,
  `p_tour` int(11) NOT NULL,
  `p_jeton` tinyint(1) NOT NULL,
  `p_etat` tinyint(1) DEFAULT NULL,
  `p_gagnant` int(25) DEFAULT NULL,
  `p_message` varchar(250) NOT NULL,
  `p_erreur` varchar(250) NOT NULL,
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
  `s_pv` int(11) DEFAULT NULL,
  `s_lieu` varchar(25) DEFAULT NULL,
  `s_visable` tinyint(1) NOT NULL,
  `s_att` tinyint(1) NOT NULL,
  `s_cible` tinyint(1) NOT NULL,
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
  `u_dateNaissance` date NOT NULL,
  `u_langue_fk` int(11) NOT NULL,
  `u_offre` tinyint(1) NOT NULL,
  `u_question` varchar(255) NOT NULL,
  `u_reponse` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`u_id`, `u_mail`, `u_pseudo`, `u_mdp`, `u_nom`, `u_prenom`, `u_dateNaissance`, `u_langue_fk`, `u_offre`, `u_question`, `u_reponse`) VALUES
(3, 'ruffault.arnaud@gmail.com', '', '$2y$10$m9awnISVY8THZk9ZnAY9z..NiBhUQ9a58VDIPcWW.s9qz0aVskgXq', 'RUFFAULT', 'Arnaud', '1990-09-07', 1, 0, 'ma prenom?', 'Arnaud'),
(4, 'jane.doe@gmail.com', '', '$2y$10$YbS4z/BOLXDHJPwF88NnDOg8p8QIA8nBV7ZMkSH5oYQzJc5RKlxiu', 'DOE', 'Jane', '1990-09-07', 1, 0, 'mon prenom?', 'Jane'),
(5, 'user@mail.mail', 'user', '$2y$10$0WlGRtieSdwaC5asS8POR.fjKLbyTAmPHxzT/mahYJNbdQghfPRJK', 'user', 'user', '2011-11-11', 1, 0, 'Pourquoi?', 'Parce que'),
(6, 'test@mail.mail', 'test', '$2y$10$TfBLqnjGzY68i29PI89iIOe0zSRfKAY.a5asKL5Eka0b2J/qCbyzy', 'test', 'test', '2010-10-10', 1, 0, 'p', 'p'),
(7, 'user1@mail.mail', 'User1', '$2y$10$NGkAn05xK4MHUHRuAyX1se/Qiqr4LliZ2D.MKKJBvZGU0./XikW0y', 'Un', 'User', '2000-12-20', 1, 0, 'Why?', 'Because'),
(8, 'user2@mail.mail', 'User2', '$2y$10$sSEwEdb7HJLqrS.75zNAPeyVdACoX2HMiJ5m8VW3AWvIxbdBJzFw.', 'Deux', 'User', '1998-05-10', 1, 0, 'Why?', 'Because'),
(9, 'arnaud.ruffault@hotmail.fr', 'Criko', '$2y$10$x8TIvUKLD6bHW0Vw9YGYfOjKKqeb8MsrTxtMBheHsQOAE8NloOMHS', 'RUFFAULT', 'Arnaud', '0000-00-00', 1, 0, 'dit coucou', 'coucou'),
(10, 'user3@mail.mail', 'User3', '$2y$10$XfAcsZlXpc6gdUkVp6uAh.hAtd5ckBXnQAI1xOeALVtkJqnLZeDYy', 'rtrthrty', 'rteryery', '2014-03-28', 1, 0, 'dit oui', 'oui'),
(11, 'ronan.ruffault@hotmail.fr', 'ronan', '$2y$10$z5kQN.DNfuGqPQtlHSwHmeRcRb.WBlRYG/R2A7gjy3TJT9fs2OmfO', 'ruffault', 'ronan', '1990-09-07', 1, 0, 'ecrit ronan', 'ronan');

-- --------------------------------------------------------

--
-- Structure de la table `u_p_jouer`
--

CREATE TABLE `u_p_jouer` (
  `u_p_pvPersonnage` int(11) DEFAULT NULL,
  `u_p_manaPersonnage` int(11) DEFAULT NULL,
  `u_p_personnage_fk` int(11) NOT NULL,
  `u_p_visable` tinyint(1) NOT NULL,
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
-- Index pour la table `langue`
--
ALTER TABLE `langue`
  ADD PRIMARY KEY (`l_id`);

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
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `u_langue_fk` (`u_langue_fk`);

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
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT pour la table `game`
--
ALTER TABLE `game`
  MODIFY `g_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `langue`
--
ALTER TABLE `langue`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
  ADD CONSTRAINT `FK_deck_u_id` FOREIGN KEY (`d_user_fk`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `d_c_inclure`
--
ALTER TABLE `d_c_inclure`
  ADD CONSTRAINT `FK_d_c_inclure_c_id` FOREIGN KEY (`d_c_carte_fk`) REFERENCES `carte` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_d_c_inclure_d_id` FOREIGN KEY (`d_c_deck_fk`) REFERENCES `deck` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`u_langue_fk`) REFERENCES `langue` (`l_id`);

--
-- Contraintes pour la table `u_p_jouer`
--
ALTER TABLE `u_p_jouer`
  ADD CONSTRAINT `FK_u_p_jouer_p_id` FOREIGN KEY (`u_p_partie_fk`) REFERENCES `partie` (`p_id`),
  ADD CONSTRAINT `FK_u_p_jouer_u_id` FOREIGN KEY (`u_p_user_fk`) REFERENCES `user` (`u_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
