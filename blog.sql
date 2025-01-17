-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2025 at 11:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `thumbnail`, `date_time`) VALUES
(22, 'AI Robots: The Current State of Progress', 'Umjetna inteligencija (AI) i robotika značajno su napredovali u posljednjih nekoliko desetljeća. Današnji AI sustavi koriste duboko učenje, strojno učenje i ogromne količine podataka kako bi postigli razinu autonomije i preciznosti koja je prije bila nezamisliva. Robotika, s druge strane, kombinira naprednu tehnologiju s AI-jem kako bi omogućila stvaranje robota koji mogu obavljati složene zadatke, od operacija u medicini do autonomnih vozila.', '1677835638blog15.jpg', '2023-03-03 08:27:18'),
(23, 'Advancements in VR: The Future of Immersive Gaming', 'Virtualna stvarnost (VR) postala je jedan od ključnih elemenata modernog gaminga. Zahvaljujući naprednim VR sustavima poput Oculus Rifta i PlayStation VR-a, igrači mogu doživjeti potpuno uranjanje u digitalne svjetove. No, primjena VR tehnologije ne staje na gamingu; koristi se i u edukaciji, medicini te arhitekturi za simulacije i vizualizacije.', '1677835859blog20.jpg', '2023-03-03 08:30:59'),
(34, 'Uspon kvantnog računarstva', 'Kvantno računarstvo otvara vrata revoluciji u računalnim znanostima. Kvantni računalni sustavi koriste kubite, koji omogućuju simultano procesiranje informacija, čime nadmašuju tradicionalna računala u specifičnim zadacima poput kriptoanalize i molekularnog modeliranja. Iako je tehnologija još u ranim fazama, potencijal kvantnog računarstva u znanosti i industriji je ogroman.', '1737137969-1678235660blog17.jpg', '2025-01-17 18:17:50'),
(35, 'Istraživanje svemira: Najnovija otkrića', 'Svemirska istraživanja donijela su nam mnoga otkrića, uključujući dokaze o postojanju vode na Marsu i detaljne slike udaljenih galaksija. Razvoj novih tehnologija poput teleskopa James Webb otvara nove mogućnosti za razumijevanje svemira i potrage za izvanzemaljskim životom.', '1737137958-1678235515avatar9.jpg', '2025-01-17 18:17:50'),
(36, 'Prednosti biljne prehrane', 'Biljna prehrana nije samo zdrava, već i održiva. Ovakav način prehrane smanjuje emisiju stakleničkih plinova i doprinosi očuvanju prirodnih resursa. Osim ekoloških koristi, biljna prehrana može smanjiti rizik od kroničnih bolesti poput dijabetesa i srčanih oboljenja.', '1737137950-1678237190blog101.jpg', '2025-01-17 18:17:50'),
(37, 'Top 10 programskih jezika u 2023.', 'Programski jezici poput Pythona, JavaScripta i Go-a dominiraju tehnološkom industrijom zbog svoje fleksibilnosti i snage. Python je najpopularniji za znanstvena istraživanja i AI projekte, dok je JavaScript ključan za razvoj web aplikacija. Go, s druge strane, postaje sve popularniji zbog svoje brzine i učinkovitosti.', '1737137939-1677835638blog15.jpg', '2025-01-17 18:17:50'),
(38, 'Kako AI mijenja zdravstvenu skrb', 'Umjetna inteligencija mijenja način na koji se pruža zdravstvena skrb. Od dijagnostike uz pomoć strojnog učenja do personaliziranih terapija, AI omogućuje brže i preciznije liječenje. Posebno su značajni AI sustavi u analizi medicinskih slika i otkrivanju ranih stadija bolesti.', '1737137933-1678237029avatar8.jpg', '2025-01-17 18:17:50'),
(39, 'Obnovljivi izvori energije: Budućnost struje', 'Obnovljivi izvori energije, poput solarne i vjetroenergije, ključni su za borbu protiv klimatskih promjena. Ovi izvori ne samo da smanjuju emisije ugljičnog dioksida već pružaju i ekonomsku stabilnost smanjenjem ovisnosti o fosilnim gorivima. Ulaganje u infrastrukturu za obnovljive izvore postaje globalni prioritet.', '1737138217-1737137908-1677835859blog20.jpg', '2025-01-17 18:17:50'),
(40, 'Svijest o mentalnom zdravlju u digitalnom dobu', 'Mentalno zdravlje postaje sve značajnije u digitalnom dobu. Društvene mreže mogu imati negativan utjecaj na osjećaj vlastite vrijednosti i uzrokovati anksioznost. No, istovremeno nude platformu za podizanje svijesti i podršku zajednici, čime se doprinosi boljitku mentalnog zdravlja.', '1737137923-1678235660blog17.jpg', '2025-01-17 18:17:50'),
(41, 'Evolucija pametnih telefona', 'Pametni telefoni evoluirali su od jednostavnih uređaja za pozive do sofisticiranih alata za svakodnevni život. Danas pružaju mogućnosti poput snimanja visokokvalitetnih fotografija, navigacije i upravljanja pametnim domovima. Njihova uloga postaje sve važnija u profesionalnom i osobnom životu.', '1737137915-1678237190blog101.jpg', '2025-01-17 18:17:50'),
(42, 'Sigurno putovanje nakon pandemije', 'Putovanja nakon pandemije zahtijevaju dodatne mjere opreza. Od provjere zdravstvenih certifikata do izbora destinacija s manjim brojem posjetitelja, sigurnost je ključna. Putnici se sve više oslanjaju na tehnologiju za praćenje zdravstvenih preporuka i prilagodbu svojih planova.', '1737137908-1677835859blog20.jpg', '2025-01-17 18:17:50'),
(43, 'Moć svjesnosti u svakodnevnom životu', 'Prakticiranje svjesnosti pomaže u smanjenju stresa i povećava fokus. Ova drevna praksa, ukorijenjena u meditaciji, sve se više koristi u modernom životu za poboljšanje mentalnog i fizičkog zdravlja. Svjesnost donosi mir i ravnotežu u užurbani svakodnevni život.', '1737137902-1677835638blog15.jpg', '2025-01-17 18:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
(5, 'Joe', 'Doel', 'Joe', 'john@doe.com', '$2y$10$Sxg.qjlHzi9UpdVvfxlozenXKQPAljvd50tH3i5vmCw5IcjEgUPzq'),
(13, 'Ivan', 'Radanović', 'iradanovic', 'iradanovic@gmail.com', '$2y$10$0opBKUumRmYzA97QbGD3kO3lZEBMTZdm6CeXGMmLZiAl8IQG6JulG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD UNIQUE KEY `thumbnail` (`thumbnail`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
