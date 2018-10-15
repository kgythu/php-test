-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2018. Okt 15. 17:30
-- Kiszolgáló verziója: 10.1.28-MariaDB
-- PHP verzió: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `phplocal`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cats`
--

CREATE TABLE `cats` (
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(127) COLLATE utf8_hungarian_ci NOT NULL,
  `cat_sex` bigint(20) UNSIGNED NOT NULL,
  `cat_chip` tinyint(1) NOT NULL DEFAULT '1',
  `cat_birth` date NOT NULL,
  `cat_neutered` tinyint(1) NOT NULL DEFAULT '0',
  `cat_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `cats`
--

INSERT INTO `cats` (`cat_id`, `cat_name`, `cat_sex`, `cat_chip`, `cat_birth`, `cat_neutered`, `cat_deleted`) VALUES
(1, 'Micike', 2, 0, '2018-09-22', 1, 0),
(2, 'Peti', 1, 1, '2018-09-26', 0, 0),
(3, 'Cirmi', 2, 1, '2018-09-26', 1, 0),
(4, 'Mici', 1, 1, '2018-10-01', 0, 1),
(5, 'Béla', 2, 0, '2018-10-01', 0, 0),
(6, 'Gizi', 1, 0, '2018-10-02', 0, 0),
(7, 'Ági', 2, 1, '2018-10-01', 0, 0),
(8, 'Zoli', 1, 0, '2018-10-02', 1, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cat_sexes`
--

CREATE TABLE `cat_sexes` (
  `cat_sex_id` bigint(20) UNSIGNED NOT NULL,
  `cat_sex_name` varchar(63) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `cat_sexes`
--

INSERT INTO `cat_sexes` (`cat_sex_id`, `cat_sex_name`) VALUES
(1, 'kandúr'),
(2, 'nőstény');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menupoints`
--

CREATE TABLE `menupoints` (
  `menupoint_name` varchar(63) COLLATE utf8_hungarian_ci NOT NULL,
  `page_id` varchar(127) COLLATE utf8_hungarian_ci NOT NULL,
  `menupoint_order` smallint(6) NOT NULL DEFAULT '1000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `menupoints`
--

INSERT INTO `menupoints` (`menupoint_name`, `page_id`, `menupoint_order`) VALUES
('Béla', 'bela', 4000),
('Home', 'index', 1000),
('Kapcsolat', 'kapcsolat', 2000),
('Macskadmin', 'macskak', 3500),
('Szolgáltatások', 'szolgaltatasok', 3000);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `options`
--

CREATE TABLE `options` (
  `option_id` varchar(127) COLLATE utf8_hungarian_ci NOT NULL,
  `option_value` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `options`
--

INSERT INTO `options` (`option_id`, `option_value`) VALUES
('site_name', 'Phlegmatic Cat'),
('timeout_default', '900'),
('timeout_max', '1800'),
('timeout_min', '120');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pages`
--

CREATE TABLE `pages` (
  `page_id` varchar(127) COLLATE utf8_hungarian_ci NOT NULL,
  `page_title` varchar(63) COLLATE utf8_hungarian_ci NOT NULL,
  `page_text` mediumtext COLLATE utf8_hungarian_ci NOT NULL,
  `page_public` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `pages`
--

INSERT INTO `pages` (`page_id`, `page_title`, `page_text`, `page_public`) VALUES
('403', '403 Access forbidden', '	<p>Az oldal védett.</p>', 1),
('404', '404 Not found', '	<p>Az oldal nem található.</p>', 1),
('bela', 'Béla', '	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n	<p>Béééééééééééla</p>\r\n', 1),
('index', 'Index oldal', '	<p>Blabla</p>\r\n', 1),
('kapcsolat', 'Kapcsolat', '	<p><a href=\"tel:+36201234567\">+36 20 123 4567</a></p>\r\n', 1),
('macskak', 'Macskadmin', '[module catadmin]\r\nBlabla bla', 0),
('profil', 'Felhasználói profil', '[module profil]', 0),
('szolgaltatasok', 'Szolgáltatások', '	<ul>\r\n		<li>masszázs</li>\r\n		<li>adótanácsadás</li>\r\n		<li>jóslás</li>\r\n		<li>szabás-vallás</li>\r\n		<li>catering</li>\r\n	</ul>\r\n', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `session_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `session_ip` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `session_ua` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `user_id` varchar(63) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `session_timeout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `sessions`
--

INSERT INTO `sessions` (`session_id`, `session_created`, `session_ip`, `session_ua`, `user_id`, `session_timeout`) VALUES
('541a21effadb61040fe414b70e1be87dbe5dac82', '2018-09-24 17:56:28', '127_0_0_1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', 'webler', '2018-10-15 17:27:39'),
('560c1c2bbb07b6f216d545f5ce69e25b837fcb53', '2018-09-24 19:50:25', '127_0_0_1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)', NULL, NULL);

-- --------------------------------------------------------

--
-- A nézet helyettes szerkezete `sessions_fulldata`
-- (Lásd alább az aktuális nézetet)
--
CREATE TABLE `sessions_fulldata` (
`session_id` varchar(40)
,`session_created` datetime
,`session_ip` varchar(255)
,`session_ua` varchar(255)
,`user_id` varchar(63)
,`session_timeout` datetime
,`now` datetime
,`user_timeout` smallint(6) unsigned
,`user_firstname` varchar(127)
,`user_lastname` varchar(127)
,`user_easternorder` tinyint(1)
,`user_title` varchar(63)
,`user_sex` tinyint(3) unsigned
,`user_email` varchar(255)
);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` varchar(63) COLLATE utf8_hungarian_ci NOT NULL,
  `user_pass` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `user_timeout` smallint(6) UNSIGNED NOT NULL DEFAULT '0',
  `user_firstname` varchar(127) COLLATE utf8_hungarian_ci NOT NULL,
  `user_lastname` varchar(127) COLLATE utf8_hungarian_ci NOT NULL,
  `user_easternorder` tinyint(1) NOT NULL DEFAULT '1',
  `user_title` varchar(63) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `user_sex` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `user_email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `user_pass`, `user_timeout`, `user_firstname`, `user_lastname`, `user_easternorder`, `user_title`, `user_sex`, `user_email`) VALUES
('webler', '4ba0e83f109b1b13f9f736feb61072520f514e48', 1300, 'Rebecca', 'Hawk', 0, 'Mrs.', 2, 'kgyt@kgyt.hu');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_sexes`
--

CREATE TABLE `user_sexes` (
  `user_sex_id` tinyint(3) UNSIGNED NOT NULL,
  `user_sex_name` varchar(63) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `user_sexes`
--

INSERT INTO `user_sexes` (`user_sex_id`, `user_sex_name`) VALUES
(0, 'nincs megadva'),
(1, 'férfi'),
(2, 'nő'),
(3, 'egyéb');

-- --------------------------------------------------------

--
-- Nézet szerkezete `sessions_fulldata`
--
DROP TABLE IF EXISTS `sessions_fulldata`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sessions_fulldata`  AS  select `sessions`.`session_id` AS `session_id`,`sessions`.`session_created` AS `session_created`,`sessions`.`session_ip` AS `session_ip`,`sessions`.`session_ua` AS `session_ua`,`sessions`.`user_id` AS `user_id`,`sessions`.`session_timeout` AS `session_timeout`,now() AS `now`,`users`.`user_timeout` AS `user_timeout`,`users`.`user_firstname` AS `user_firstname`,`users`.`user_lastname` AS `user_lastname`,`users`.`user_easternorder` AS `user_easternorder`,`users`.`user_title` AS `user_title`,`users`.`user_sex` AS `user_sex`,`users`.`user_email` AS `user_email` from (`sessions` left join `users` on((`sessions`.`user_id` = `users`.`user_id`))) ;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_id` (`cat_id`),
  ADD KEY `cat_sex` (`cat_sex`);
ALTER TABLE `cats` ADD FULLTEXT KEY `cat_name` (`cat_name`);

--
-- A tábla indexei `cat_sexes`
--
ALTER TABLE `cat_sexes`
  ADD PRIMARY KEY (`cat_sex_id`),
  ADD UNIQUE KEY `cat_sex_id` (`cat_sex_id`),
  ADD UNIQUE KEY `cat_sex_name` (`cat_sex_name`);

--
-- A tábla indexei `menupoints`
--
ALTER TABLE `menupoints`
  ADD PRIMARY KEY (`menupoint_name`,`page_id`),
  ADD UNIQUE KEY `page_id` (`page_id`),
  ADD UNIQUE KEY `menupoint_name` (`menupoint_name`);

--
-- A tábla indexei `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`);

--
-- A tábla indexei `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`),
  ADD KEY `page_title` (`page_title`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_sex` (`user_sex`);

--
-- A tábla indexei `user_sexes`
--
ALTER TABLE `user_sexes`
  ADD PRIMARY KEY (`user_sex_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `cats`
--
ALTER TABLE `cats`
  MODIFY `cat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `cat_sexes`
--
ALTER TABLE `cat_sexes`
  MODIFY `cat_sex_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `user_sexes`
--
ALTER TABLE `user_sexes`
  MODIFY `user_sex_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `cats`
--
ALTER TABLE `cats`
  ADD CONSTRAINT `cats_ibfk_1` FOREIGN KEY (`cat_sex`) REFERENCES `cat_sexes` (`cat_sex_id`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `menupoints`
--
ALTER TABLE `menupoints`
  ADD CONSTRAINT `menupoints_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`page_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Megkötések a táblához `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_sex`) REFERENCES `user_sexes` (`user_sex_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
