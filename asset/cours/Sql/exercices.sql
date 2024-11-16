/**
* Objectif : Créer dans PHPMyAdmin une base de données haribo dont la modélisation est ci-dessous, les étapes sont détaillées ensuite.
*/

/**
+---------------+----------------+------+------+---------+----------------+
| Field         | Type           | Null | Key  | Default | Extra          |
+---------------+----------------+------+------+---------+----------------+
| id_user  | int(11)        | NO   | PK   | NULL    | auto_increment |
| prenom        | varchar(100)   | NO   |      | NULL    |                |
| yeux          | varchar(30)    | NO   |      | NULL    |                |
| genre         | enum('h','f')  | NO   |      | NULL    |                |
+---------------+----------------+------+------+---------+----------------+

+---------------+----------------+------+------+---------+----------------+
| Field         | Type           | Null | Key  | Default | Extra          |
+---------------+----------------+------+------+---------+----------------+
| id_bonbon     | int(11)        | NO   | PK   | NULL    | auto_increment |
| nom           | varchar(100)   | NO   |      | NULL    |                |
| saveur        | varchar(100)   | NO   |      | NULL    |                |
+---------------+----------------+------+------+---------+----------------+

+---------------+----------------+------+------+---------+----------------+
| Field         | Type           | Null | Key  | Default | Extra          |
+---------------+----------------+------+------+---------+----------------+
| id_manger     | int(11)        | NO   | PK   | NULL    | auto_increment |
| id_bonbon     | int(11)        | YES  |      | NULL    |                |
| id_user  		| int(11)        | YES  |      | NULL    |                |
| date_manger   | date           | NO   |      | NULL    |                |
| quantite      | int(11)        | NO   |      | NULL    |                |
+---------------+----------------+------+------+---------+----------------+
*/

/**
* REQUETES A EFFECTUER dans PHPMyAdmin
*/

--1-- lister toutes les BDD de PHPMyAdmin

SHOW DATABASES;

-- ***

--2-- Créer une base de données SQL nommée HARIBO

CREATE DATABASE haribo;

--3--
/**
* créer une table user
* qui comporte 3 champs :
* - id_user => nombre qui s'auto-incrémente, requis et clé primaire
* - prenom => 100 caractères, requis
* - couleur des yeux => 30 caractères, requis
* - genre => homme ou femme, requis
*/

CREATE TABLE user (
	id_user INT NOT NULL AUTO_INCREMENT,
	prenom VARCHAR(100) NOT NULL,
	yeux VARCHAR(30) NOT NULL,
	genre ENUM('h','f') NOT NULL,
	PRIMARY KEY (id_user)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--4--
/**
* insérer dans cette table les informations de votre groupe (faites un copier-coller des lignes ci-dessous) :
*/
INSERT INTO users (id_user, prenom, yeux, genre) VALUES
(4, 'Kenzo', 'marron clair', 'h'),
(5, 'Gally', 'marron', 'f'),
(6, 'Cody', 'vert', 'h'),
(7, 'Opal', 'bleu', 'f'),
(8, 'Saxo', 'marron', 'h'),
(9, 'Moka', 'bleu', 'h'),
(10, 'ONeill', 'marron', 'f'),
(11, 'Ratapoil', 'marron', 'h'),
(12, 'Mila', 'marron', 'f'),
(13, 'Mallow', 'marron', 'h');

--5--
/**
* créer une table bonbon
* qui comporte 3 champs :
* - id_bonbon => nombre qui s'auto-incrémente, requis et clé primaire
* - nom => 100 caractères, requis
* - saveur => 100 caractères, requis
*/

CREATE TABLE bonbons (
	id_bonbon INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(100) NOT NULL,
	saveur VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_bonbon)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--6--
/**
* insérer dans cette table des bonbons haribo (faites un copier-coller des lignes ci-dessous) :
*/
INSERT INTO bonbons (id_bonbon, nom, saveur) VALUES
(10, 'Chamallows', 'fraise'),
(11, 'Dragibus', 'orange'),
(12, 'Tagada', 'pik'),
(13, 'Tagada', 'original'),
(14, 'Tagada', 'purple'),
(15, 'Car en Sac', 'réglisse'),
(16, 'Dragibus', 'pik'),
(17, 'Dragibus', 'soft'),
(18, 'Croco', 'cola'),
(19, 'Croco', 'fraise'),
(20, 'Croco', 'citron');

--7--
/**
* créer une table manger
* qui comporte 5 champs :
* - id_manger => nombre qui s'auto-incrémente, requis et clé primaire
* - id_user => champs de la table user
* - id_bonbon => champs de la table bonbon
* - date_manger => type date, requis
* - quantite => nombre, requis
*/

CREATE TABLE manger (
	id_manger INT NOT NULL AUTO_INCREMENT,
	id_user DEFAULT NULL,
	id_bonbon DEFAULT NULL,
	date_manger DATE NOT NULL,
  quantite VARCHAR(100);
	PRIMARY KEY (id_manger)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--8--
/**
* insérer dans la table manger des informations sur qui a consommé quel bonbon, quand et dans quelles quantités (faites un copier-coller des lignes ci-dessous) :
*/
INSERT INTO manger (id_manger, id_bonbon, id_user, date_manger, quantite) VALUES
(1, 10, 1, '2017-01-19', 4),
(2, 11, 2, '2017-02-20', 1),
(3, 12, 3, '2017-01-29', 3),
(4, 13, 4, '2017-03-22', 9),
(5, 14, 5, '2017-02-19', 8),
(6, 15, 6, '2017-03-20', 11),
(7, 15, 7, '2017-06-13', 4),
(8, 20, 8, '2017-06-15', 1),
(9, 15, 9, '2017-04-17', 5),
(10, 17, 12, '2017-05-03', 7),
(11, 16, 12, '2017-01-31', 3),
(12, 18, 11, '2017-02-12', 6),
(13, 10, 5, '2017-03-20', 1),
(14, 19, 2, '2017-04-04', 2),
(15, 15, 5, '2017-05-19', 14);

--9-- Lister les tables de la BDD *haribo*

SHOW TABLES;

--10-- voir les paramètres de la table *bonbons*

DESC bonbons;

--11-- Sélectionner tous les champs de tous les enregistrements de la table *user*

SELECT * FROM users;

--12-- Rajouter un nouveau user *Patriiiick* en forçant la numérotation de l'id

INSERT INTO users (id_user, prenom, yeux, genre) VALUES (100, 'Patriiiick', 'bleu', 'h');

--13-- Rajouter un nouveau user *Mila* SANS forcer la numérotation de l'id

INSERT INTO users (prenom, yeux, genre) VALUES ('Mila', 'plante', 'f');

--14-- Changer le prénom du user qui a l'id 100 de *Patriiiick* à *Patrick*

UPDATE users SET prenom = Patrick WHERE id_user = 100;

--15-- Rajouter dans la table manger que Patrick a mangé 5 Tagada purpule le 15 septembre

INSERT INTO manger (id_bonbon, id_user, date_manger, quantité) VALUES ((SELECT id_bonbon FROM bonbons WHERE nom = 'Tagada' AND saveur = 'purple'), (SELECT id_user FROM users WHERE prenom = 'Patrick'), '2023-09-15', 5);

--16-- Sélectionner tous les noms des bonbons

SELECT nom FROM bonbons;

--17-- Sélectionner tous les noms des bonbons en enlevant les doublons

SELECT DISTINCT nom FROM bonbons;

--18-- Récupérer les couleurs des yeux et le genre des users (Sélectionner plusieurs champs dans une table)

SELECT nom, genre FROM users;

--19-- Dédoublonner un résultat sur plusieurs champs

SELECT DISTINCT nom, genre FROM users;

--20-- Sélectionner le user qui a l'id 5

SELECT nom FROM users WHERE id_user = 5;

--21-- Sélectionner tous les users qui ont les yeux marrons

SELECT nom FROM users WHERE yeux = 'marron';

--22-- Sélectionner tous les users dont l'id est plus grand que 9

SELECT nom FROM users WHERE id_user > 9;

--23-- Sélectionner tous les users SAUF celui dont l'id est 13 (soyons supersticieux !) :!\ iil y a 2 façons de faire

SELECT nom FROM users WHERE id_user != 13; -- 1
SELECT nom FROM users WHERE id_user <> 13; -- 2

--24-- Sélectionner tous les users qui ont un id inférieur ou égal à 10

SELECT nom FROM users WHERE id_user <= 10;

--25-- Sélectionner tous les users dont l'id est compris entre 7 et 11

SELECT nom FROM users WHERE id_user BETWEEN 7 AND 11;

--26-- Sélectionner les users dont le prénom commence par un *S*

SELECT nom FROM users WHERE nom LIKE 'S%';

--27-- Trier les users femmes par id décroissant

SELECT * FROM users WHERE genre = 'f' ORDER BY id_user DESC;

--28-- Trier les users hommes par prénom dans l'ordre alphabétique

SELECT * FROM users WHERE genre = 'h' ORDER BY nom ASC;

--29-- Trier les users en affichant les femmes en premier et en classant les couleurs des yeux dans l'ordre alphabétique

SELECT * FROM users ORDER BY genre = 'f' DESC, yeux ASC;

--30-- Limiter l'affichage d'une requête de sélection de tous les users aux 3 premires résultats

SELECT * FROM users LIMIT 3;

--31-- Limiter l'affichage d'une requête de sélection de tous les users à partir du 3ème résultat et des 5 suivants

SELECT * FROM users WHERE id_user > 3 LIMIT 5; -- Ne pas trop utiliser les id pour éviter les bugs !!!
SELECT * FROM users LIMIT 5, 3; 

--32-- Afficher les 4 premiers users qui ont les yeux marron

SELECT * FROM users WHERE yeux = 'marron' LIMIT 4;

--33-- Pareil mais en triant les prénoms dans l'ordre alphabétique

SELECT * FROM users WHERE yeux = 'marron' ORDER BY prenom ASC LIMIT 4;

--34-- Compter le nombre de users

SELECT COUNT(*) FROM users;

--35-- Compter le nombre de users hommes mais en changeant le nom de la colonne de résultat par *nb_users_H*

SELECT COUNT(*) AS nb_users_H FROM users WHERE genre = 'h';

--36-- Compter le nombre de couleurs d'yeux différentes

SELECT COUNT(DISTINCT yeux) FROM users;

--37-- Afficher le prénom et les yeux du user qui a l'id le plus petit

SELECT nom, yeux FROM users ORDER BY id_user LIMIT 1;

--38-- Afficher le prénom et les yeux du user qui a l'id le plus grand /!\ c'est une requête imbriquée qu'il faut faire (requête sur le résultat d'une autre requête)

SELECT nom, yeux FROM users ORDER BY id_user = (SELECT MAX(id_user) FROM users) LIMIT 1;

--39-- Afficher les users qui ont les yeux bleu et vert

SELECT nom FROM users WHERE yeux IN('bleu', 'vert');

--40-- A l'inverse maintenant, afficher les users qui n'ont pas les yeux bleu ni vert

SELECT nom FROM users WHERE NOT yeux IN('bleu', 'vert');

--41-- récupérer tous les users qui ont mangé des bonbons, avec le détail de leurs consommations

SELECT u.*, m.*
FROM users u
LEFT JOIN manger m ON u.id_user = m.id_user;

--42-- récupérer que les users qui ont mangé des bonbons, avec le détail de leurs consommations

SELECT u.*, m.*
FROM users u
INNER JOIN manger m ON u.id_user = m.id_user;

--43-- prénom du user, le nom du bonbon, la date de consommation pour tous les users qui ont mangé au moins une fois

SELECT u.prenom, b.nom, m.quantité
FROM users u
INNER JOIN manger m ON u.id_user = m.id_user
LEFT JOIN bonbons b ON b.id_bonbon = m.id_bonbon;


--44-- Afficher les quantités consommées par les users (uniquement ceux qui ont mangé !)

SELECT u.prenom, m.quantité
FROM users u
INNER JOIN manger m ON u.id_user = m.id_user;


--45-- Calculer combien de bonbons ont été mangés au total par chaque user et afficher le nombre de fois où ils ont mangé

SELECT u.prenom, SUM(m.quantité), COUNT(*) AS nb_conso
FROM manger m
INNER JOIN users u ON u.id_user = m.id_user
GROUP BY u.id_user ORDER BY SUM(m.quantité) DESC;

--46-- Afficher combien de bonbons ont été consommés au total

SELECT SUM(quantité)
FROM manger

--47-- Afficher le total de *Tagada* consommées

SELECT SUM(m.quantité)
FROM bonbons b
INNER JOIN manger m ON b.id_bonbon = m.id_bonbon
WHERE b.nom = 'Tagada';

--48-- Afficher les prénoms des users qui n'ont rien mangé

SELECT u.prenom, m.quantité
FROM users u
LEFT JOIN manger m ON u.id_user = m.id_user
WHERE m.quantité = 0 OR m.quantité IS NULL;

--49-- Afficher les saveurs des bonbons (sans doublons)

SELECT DISTINCT saveur FROM bonbons;

--50-- Afficher le prénom du user qui a mangé le plus de bonbons

SELECT u.prenom, m.quantité AS total_quantité
FROM users u
INNER JOIN manger m ON u.id_user = m.id_user
GROUP BY u.prenom
ORDER BY total_quantité DESC
LIMIT 1;

--51-- Aller chercher 1 référence dans 2 tables distinctes

SELECT prenom
FROM users
WHERE id_user = 1
UNION ALL SELECT nom
FROM bonbons WHERE id_bonbon = 12;

--52-- Afficher les prénoms des users qui ont mangé des bonbons à la fraise

SELECT u.prenom, b.nom, b.saveur
FROM users u
INNER JOIN manger m ON u.id_user = m.id_user
LEFT JOIN bonbons b ON b.id_bonbon = m.id_bonbon
WHERE saveur = 'fraise';

--53-- Afficher les prénoms des users qui ont mangé des bonbons à la fraise ou à la réglisse

SELECT u.prenom, b.nom, b.saveur
FROM users u
INNER JOIN manger m ON u.id_user = m.id_user
LEFT JOIN bonbons b ON b.id_bonbon = m.id_bonbon
WHERE saveur = 'fraise' OR saveur = 'réglisse'; -- IN('fraise', 'réglisse')

--54-- Afficher toutes les informations contenues dans la BDD haribo

SELECT * FROM users, bonbons, manger;

--54-- Afficher les prénoms des users qui ont mangé des bonbons à la fraise et à la réglisse

SELECT u.prenom
FROM users u
INNER JOIN manger m ON u.id_user = m.id_user
INNER JOIN bonbons b ON b.id_bonbon = m.id_bonbon
WHERE b.saveur IN('fraise', 'réglisse')
GROUP BY u.prenom
HAVING COUNT(DISTINCT b.saveur) = 2;

--55-- Afficher les prénoms des users qui ont mangé des bonbons à la fraise mais pas à la réglisse

SELECT u.prenom, b.nom, b.saveur
FROM users u
INNER JOIN manger m ON u.id_user = m.id_user
LEFT JOIN bonbons b ON b.id_bonbon = m.id_bonbon
WHERE saveur = 'fraise' AND saveur != 'réglisse';

--56-- Afficher les prénoms des users qui ont mangé des bonbons à la fraise ou à la réglisse mais pas aux deux

SELECT u.prenom, b.nom, b.saveur
FROM users u
INNER JOIN manger m ON u.id_user = m.id_user
LEFT JOIN bonbons b ON b.id_bonbon = m.id_bonbon
WHERE (saveur = 'fraise' OR saveur = 'réglisse') AND NOT (saveur = 'fraise' AND saveur = 'réglisse');
