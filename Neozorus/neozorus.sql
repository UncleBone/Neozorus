-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 13 fév. 2018 à 11:41
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Déchargement des données de la table `abilite`
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
-- Déchargement des données de la table `carte`
--

INSERT INTO `carte` (`c_id`, `c_libelle`, `c_type`, `c_puissance`, `c_pvMax`, `c_mana`, `c_personnage_fk`) VALUES
(1, 'TRINITY', 'sort', 1, NULL, 1, 1),
(2, 'MORPHEUS', 'sort', 4, NULL, 3, 1),
(3, 'L\'ORACLE', 'sort', 6, NULL, 5, 1),
(4, 'L\'AGENT SMITH', 'creature', 2, 1, 1, 1),
(5, 'LE MAÎTRE DES CLEFS', 'creature', 2, 3, 2, 1),
(6, 'CYPHER', 'creature', 5, 3, 3, 1),
(7, 'LES TWINS', 'creature', 2, 4, 4, 1),
(8, 'NIOBE', 'creature', 7, 5, 5, 1),
(9, 'L\'ARCHITECTE', 'creature', 8, 6, 7, 1),
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
-- Déchargement des données de la table `c_a_inclure`
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
-- Déchargement des données de la table `deck`
--

INSERT INTO `deck` (`d_id`, `d_libelle`, `d_nbMaxCarte`, `d_personnage_fk`, `d_user_fk`, `d_waiting`) VALUES
(30, 'Neo', 20, 1, 8, 0),
(43, 'Default', 20, 1, NULL, 0),
(44, 'T-rex', 20, 2, 9, 0),
(45, 'Default', 20, 2, 10, 0),
(46, 'Default', 20, 1, 9, 0),
(59, 'Default', 20, 2, 8, 0),
(75, 'Deck dinozzz', 20, 2, 14, 0),
(76, 'Matrix', 20, 1, 14, 0);

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
-- Déchargement des données de la table `d_c_inclure`
--

INSERT INTO `d_c_inclure` (`d_c_nbExemplaire`, `d_c_deck_fk`, `d_c_carte_fk`) VALUES
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
(1, 45, 24),
(1, 46, 1),
(1, 46, 2),
(1, 46, 3),
(2, 46, 4),
(2, 46, 5),
(2, 46, 6),
(2, 46, 7),
(2, 46, 8),
(2, 46, 9),
(2, 46, 10),
(2, 46, 11),
(1, 46, 12),
(1, 59, 13),
(1, 59, 14),
(1, 59, 15),
(2, 59, 16),
(2, 59, 17),
(2, 59, 18),
(2, 59, 19),
(2, 59, 20),
(2, 59, 21),
(2, 59, 22),
(2, 59, 23),
(1, 59, 24),
(1, 75, 13),
(1, 75, 14),
(1, 75, 15),
(2, 75, 16),
(2, 75, 17),
(2, 75, 18),
(2, 75, 19),
(2, 75, 20),
(2, 75, 21),
(2, 75, 22),
(2, 75, 23),
(1, 75, 24),
(1, 76, 1),
(1, 76, 2),
(1, 76, 3),
(2, 76, 4),
(2, 76, 5),
(2, 76, 6),
(2, 76, 7),
(2, 76, 8),
(2, 76, 9),
(2, 76, 10),
(2, 76, 11),
(1, 76, 12);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `e_id` int(11) NOT NULL,
  `e_nom` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`e_id`, `e_nom`) VALUES
(1, 'play'),
(2, 'att_card'),
(3, 'att_player');

-- --------------------------------------------------------

--
-- Structure de la table `event_att_card`
--

CREATE TABLE `event_att_card` (
  `eac_id` int(11) NOT NULL,
  `eac_att` int(11) NOT NULL,
  `eac_cible` int(11) NOT NULL,
  `eac_mort_att` tinyint(1) DEFAULT NULL,
  `eac_mort_cible` tinyint(1) NOT NULL,
  `eac_hist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `event_att_player`
--

CREATE TABLE `event_att_player` (
  `eap_id` int(11) NOT NULL,
  `eap_att` int(11) NOT NULL,
  `eap_cible` int(11) DEFAULT NULL,
  `eap_mort_cible` tinyint(1) NOT NULL,
  `eap_hist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `event_play`
--

CREATE TABLE `event_play` (
  `ep_id` int(11) NOT NULL,
  `ep_carte` int(11) NOT NULL,
  `ep_hist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `h_id` int(11) NOT NULL,
  `h_tour` int(20) DEFAULT NULL,
  `h_partie` int(20) DEFAULT NULL,
  `h_joueur` int(25) DEFAULT NULL,
  `h_event` int(25) DEFAULT NULL,
  `h_ep_id` int(11) DEFAULT NULL,
  `h_eac_id` int(11) DEFAULT NULL,
  `h_eap_id` int(11) DEFAULT NULL
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
-- Déchargement des données de la table `langue`
--

INSERT INTO `langue` (`l_id`, `l_libelle`) VALUES
(1, 'français'),
(2, 'english');

-- --------------------------------------------------------

--
-- Structure de la table `old_game`
--

CREATE TABLE `old_game` (
  `g_id` int(20) NOT NULL,
  `g_data` text NOT NULL,
  `g_player1` int(11) NOT NULL,
  `g_player2` int(11) NOT NULL,
  `g_running` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

CREATE TABLE `partie` (
  `p_id` int(11) NOT NULL,
  `p_tour` int(11) NOT NULL,
  `p_jeton` tinyint(1) NOT NULL,
  `p_piocheEtMana` tinyint(1) NOT NULL,
  `p_etat` tinyint(1) DEFAULT NULL,
  `p_gagnant` int(25) DEFAULT NULL,
  `p_joueur1` int(11) DEFAULT NULL,
  `p_joueur2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `partie_carte`
--

CREATE TABLE `partie_carte` (
  `pc_id` int(11) NOT NULL,
  `pc_cid_fk` int(11) NOT NULL,
  `pc_pv` int(11) DEFAULT NULL,
  `pc_lieu` varchar(25) DEFAULT NULL,
  `pc_indice` int(11) NOT NULL,
  `pc_visable` tinyint(1) NOT NULL,
  `pc_active` tinyint(1) NOT NULL DEFAULT '0',
  `pc_user_fk` int(11) DEFAULT NULL,
  `pc_partie_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `partie_joueur`
--

CREATE TABLE `partie_joueur` (
  `pj_pvPersonnage` int(11) DEFAULT NULL,
  `pj_manaPersonnage` int(11) DEFAULT NULL,
  `pj_personnage_fk` int(11) NOT NULL,
  `pj_deck_fk` int(11) NOT NULL,
  `pj_visable` tinyint(1) NOT NULL,
  `pj_user_fk` int(11) NOT NULL,
  `pj_partie_fk` int(11) NOT NULL
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
-- Déchargement des données de la table `personnage`
--

INSERT INTO `personnage` (`p_id`, `p_libelle`, `p_pvMax`) VALUES
(1, 'NEO', 20),
(2, 'TYRANNOSAURE REX', 20);

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
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`u_id`, `u_mail`, `u_pseudo`, `u_mdp`, `u_nom`, `u_prenom`, `u_dateNaissance`, `u_langue_fk`, `u_offre`, `u_question`, `u_reponse`) VALUES
(3, 'ruffault.arnaud@gmail.com', '', '$2y$10$m9awnISVY8THZk9ZnAY9z..NiBhUQ9a58VDIPcWW.s9qz0aVskgXq', 'RUFFAULT', 'Arnaud', '1990-09-07', 1, 0, 'ma prenom?', 'Arnaud'),
(4, 'jane.doe@gmail.com', '', '$2y$10$YbS4z/BOLXDHJPwF88NnDOg8p8QIA8nBV7ZMkSH5oYQzJc5RKlxiu', 'DOE', 'Jane', '1990-09-07', 1, 0, 'mon prenom?', 'Jane'),
(5, 'user@mail.mail', 'user', '$2y$10$0WlGRtieSdwaC5asS8POR.fjKLbyTAmPHxzT/mahYJNbdQghfPRJK', 'user', 'user', '2011-11-11', 1, 0, 'Pourquoi?', 'Parce que'),
(6, 'test@mail.mail', 'test', '$2y$10$TfBLqnjGzY68i29PI89iIOe0zSRfKAY.a5asKL5Eka0b2J/qCbyzy', 'test', 'test', '2010-10-10', 1, 0, 'p', 'p'),
(8, 'user2@mail.mail', 'User2', '$2y$10$sSEwEdb7HJLqrS.75zNAPeyVdACoX2HMiJ5m8VW3AWvIxbdBJzFw.', 'Deux', 'User', '1998-05-10', 1, 0, 'Why?', 'Because'),
(9, 'arnaud.ruffault@hotmail.fr', 'Criko', '$2y$10$x8TIvUKLD6bHW0Vw9YGYfOjKKqeb8MsrTxtMBheHsQOAE8NloOMHS', 'RUFFAULT', 'Arnaud', '0000-00-00', 1, 0, 'coucou?', 'coucou'),
(10, 'user3@mail.mail', 'User3', '$2y$10$XfAcsZlXpc6gdUkVp6uAh.hAtd5ckBXnQAI1xOeALVtkJqnLZeDYy', 'rtrthrty', 'rteryery', '2014-03-28', 1, 0, 'dit oui', 'oui'),
(11, 'ronan.ruffault@hotmail.fr', 'ronan', '$2y$10$z5kQN.DNfuGqPQtlHSwHmeRcRb.WBlRYG/R2A7gjy3TJT9fs2OmfO', 'ruffault', 'ronan', '1990-09-07', 1, 0, 'ecrit ronan', 'ronan'),
(12, 'jeanjean@mail.mail', 'JJ', '$2y$10$QzyiUEgZ4NYOz7KRBZaJTukENrJA1QP9tFxxfuaKpGmB0IhcHQSAm', 'Petitpapier', 'Jeanjean', '1998-10-01', 1, 0, 'Why?', 'Because'),
(14, 'albus@mail.mail', 'Albus', '$2y$10$fOsfuaWyROKyF86n4ZeZQe3DePp6mErGvioT.r6XC28zYmBe0W6..', 'Dumbledore', 'Albus', '1910-10-10', 1, 0, 'kedh', 'lqkhzd');

--
-- Index pour les tables déchargées
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
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`e_id`);

--
-- Index pour la table `event_att_card`
--
ALTER TABLE `event_att_card`
  ADD PRIMARY KEY (`eac_id`),
  ADD KEY `FK_eac_cible` (`eac_cible`),
  ADD KEY `FK_eac_historique` (`eac_hist`),
  ADD KEY `FK_eac_att` (`eac_att`);

--
-- Index pour la table `event_att_player`
--
ALTER TABLE `event_att_player`
  ADD PRIMARY KEY (`eap_id`),
  ADD KEY `FK_eap_tt` (`eap_att`),
  ADD KEY `FK_eap_cible` (`eap_cible`),
  ADD KEY `FK_eap_historique` (`eap_hist`);

--
-- Index pour la table `event_play`
--
ALTER TABLE `event_play`
  ADD PRIMARY KEY (`ep_id`),
  ADD KEY `FK_ep_carte` (`ep_carte`),
  ADD KEY `FK_ep_hist` (`ep_hist`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`h_id`),
  ADD KEY `FK_historique_p_id` (`h_eac_id`),
  ADD KEY `FK_historique_eap` (`h_eap_id`),
  ADD KEY `FK_historique_ep` (`h_ep_id`),
  ADD KEY `FK_historique_event` (`h_event`),
  ADD KEY `FK_historique_joueur` (`h_joueur`),
  ADD KEY `FK_historique_partie` (`h_partie`);

--
-- Index pour la table `langue`
--
ALTER TABLE `langue`
  ADD PRIMARY KEY (`l_id`);

--
-- Index pour la table `old_game`
--
ALTER TABLE `old_game`
  ADD PRIMARY KEY (`g_id`),
  ADD KEY `g_player1` (`g_player1`),
  ADD KEY `g_player2` (`g_player2`);

--
-- Index pour la table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`p_id`);

--
-- Index pour la table `partie_carte`
--
ALTER TABLE `partie_carte`
  ADD PRIMARY KEY (`pc_id`),
  ADD KEY `FK_salonCarte_u_id` (`pc_user_fk`),
  ADD KEY `FK_salonCarte_p_id` (`pc_partie_fk`);

--
-- Index pour la table `partie_joueur`
--
ALTER TABLE `partie_joueur`
  ADD PRIMARY KEY (`pj_user_fk`,`pj_partie_fk`),
  ADD KEY `FK_u_p_jouer_p_id` (`pj_partie_fk`);

--
-- Index pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD PRIMARY KEY (`p_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `u_langue_fk` (`u_langue_fk`);

--
-- AUTO_INCREMENT pour les tables déchargées
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
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT pour la table `event_att_card`
--
ALTER TABLE `event_att_card`
  MODIFY `eac_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT pour la table `old_game`
--
ALTER TABLE `old_game`
  MODIFY `g_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partie`
--
ALTER TABLE `partie`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partie_carte`
--
ALTER TABLE `partie_carte`
  MODIFY `pc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personnage`
--
ALTER TABLE `personnage`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
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
-- Contraintes pour la table `event_att_card`
--
ALTER TABLE `event_att_card`
  ADD CONSTRAINT `FK_eac_att` FOREIGN KEY (`eac_att`) REFERENCES `partie_carte` (`pc_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_eac_cible` FOREIGN KEY (`eac_cible`) REFERENCES `partie_carte` (`pc_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_eac_historique` FOREIGN KEY (`eac_hist`) REFERENCES `historique` (`h_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `event_att_player`
--
ALTER TABLE `event_att_player`
  ADD CONSTRAINT `FK_eap_cible` FOREIGN KEY (`eap_cible`) REFERENCES `partie_joueur` (`pj_user_fk`),
  ADD CONSTRAINT `FK_eap_historique` FOREIGN KEY (`eap_hist`) REFERENCES `historique` (`h_id`),
  ADD CONSTRAINT `FK_eap_tt` FOREIGN KEY (`eap_att`) REFERENCES `partie_carte` (`pc_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `event_play`
--
ALTER TABLE `event_play`
  ADD CONSTRAINT `FK_ep_carte` FOREIGN KEY (`ep_carte`) REFERENCES `partie_carte` (`pc_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ep_hist` FOREIGN KEY (`ep_hist`) REFERENCES `historique` (`h_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `FK_historique_eac` FOREIGN KEY (`h_eac_id`) REFERENCES `event_att_card` (`eac_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_historique_eap` FOREIGN KEY (`h_eap_id`) REFERENCES `event_att_player` (`eap_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_historique_ep` FOREIGN KEY (`h_ep_id`) REFERENCES `event_play` (`ep_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_historique_event` FOREIGN KEY (`h_event`) REFERENCES `event` (`e_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_historique_joueur` FOREIGN KEY (`h_joueur`) REFERENCES `partie_joueur` (`pj_user_fk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_historique_partie` FOREIGN KEY (`h_partie`) REFERENCES `partie` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `old_game`
--
ALTER TABLE `old_game`
  ADD CONSTRAINT `old_game_ibfk_1` FOREIGN KEY (`g_player1`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `old_game_ibfk_2` FOREIGN KEY (`g_player2`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `partie_carte`
--
ALTER TABLE `partie_carte`
  ADD CONSTRAINT `FK_salonCarte_p_id` FOREIGN KEY (`pc_partie_fk`) REFERENCES `partie` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_salonCarte_u_id` FOREIGN KEY (`pc_user_fk`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `partie_joueur`
--
ALTER TABLE `partie_joueur`
  ADD CONSTRAINT `FK_u_p_jouer_p_id` FOREIGN KEY (`pj_partie_fk`) REFERENCES `partie` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_u_p_jouer_u_id` FOREIGN KEY (`pj_user_fk`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`u_langue_fk`) REFERENCES `langue` (`l_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
