-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 11:24 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eas-web`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `checkout` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `user_id`, `order_id`, `quantity`, `total`, `checkout`, `created_at`, `updated_at`) VALUES
(54, 21, 10, 22, 1, 879000, 1, '2023-06-27 01:04:59', '2023-06-27 01:05:28'),
(55, 24, 10, 22, 1, 729000, 1, '2023-06-27 01:05:06', '2023-06-27 01:05:28'),
(56, 22, 10, 23, 1, 759000, 1, '2023-06-27 01:06:23', '2023-06-27 01:07:40'),
(57, 26, 10, 23, 1, 640000, 1, '2023-06-27 01:06:31', '2023-06-27 01:07:40'),
(58, 20, 10, 23, 1, 1025000, 1, '2023-06-27 01:06:41', '2023-06-27 01:07:40'),
(59, 30, 10, 24, 1, 812000, 1, '2023-06-27 01:08:15', '2023-06-27 01:09:19'),
(60, 32, 10, 24, 1, 759000, 1, '2023-06-27 01:09:00', '2023-06-27 01:09:19'),
(61, 31, 10, 24, 1, 599000, 1, '2023-06-27 01:09:09', '2023-06-27 01:09:19'),
(62, 25, 10, 25, 1, 729000, 1, '2023-06-27 01:09:49', '2023-06-27 01:13:41'),
(63, 27, 10, 25, 1, 749000, 1, '2023-06-27 01:09:55', '2023-06-27 01:13:41'),
(64, 28, 10, 25, 1, 309000, 1, '2023-06-27 01:10:08', '2023-06-27 01:13:41'),
(65, 29, 10, 25, 1, 699000, 1, '2023-06-27 01:10:20', '2023-06-27 01:13:41'),
(66, 23, 10, 26, 1, 729000, 1, '2023-06-27 01:18:45', '2023-06-27 01:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `installed` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `user_id`, `product_id`, `installed`, `created_at`, `updated_at`) VALUES
(38, 10, 21, 0, '2023-06-27 01:05:28', '2023-06-27 01:05:28'),
(39, 10, 24, 0, '2023-06-27 01:05:28', '2023-06-27 01:05:28'),
(40, 10, 22, 0, '2023-06-27 01:07:40', '2023-06-27 01:07:40'),
(41, 10, 26, 0, '2023-06-27 01:07:40', '2023-06-27 01:07:40'),
(42, 10, 20, 0, '2023-06-27 01:07:40', '2023-06-27 01:07:40'),
(43, 10, 30, 0, '2023-06-27 01:09:19', '2023-06-27 01:09:19'),
(44, 10, 32, 0, '2023-06-27 01:09:19', '2023-06-27 01:09:19'),
(45, 10, 31, 0, '2023-06-27 01:09:19', '2023-06-27 01:09:19'),
(46, 10, 25, 0, '2023-06-27 01:13:41', '2023-06-27 01:13:41'),
(47, 10, 27, 0, '2023-06-27 01:13:41', '2023-06-27 01:13:41'),
(48, 10, 28, 0, '2023-06-27 01:13:41', '2023-06-27 01:13:41'),
(49, 10, 29, 0, '2023-06-27 01:13:41', '2023-06-27 01:13:41'),
(50, 10, 23, 0, '2023-06-27 01:19:04', '2023-06-27 01:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(19, '2014_10_12_000000_create_users_table', 1),
(20, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(21, '2019_08_19_000000_create_failed_jobs_table', 1),
(22, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(23, '2023_05_13_113954_create_products_table', 1),
(24, '2023_05_13_114034_create_orders_table', 1),
(25, '2023_05_13_114049_create_order_details_table', 1),
(26, '2023_05_29_052353_create_carts_table', 1),
(27, '2023_06_06_055245_create_payment-methods_table', 1),
(28, '2023_06_08_062744_create_games_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `total_price` int(11) NOT NULL,
  `pay` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`, `status`, `total_price`, `pay`, `created_at`, `updated_at`) VALUES
(22, 10, '2023-06-27', 1, 1608000, 7800000, '2023-06-27 01:04:59', '2023-06-27 01:05:28'),
(23, 10, '2023-06-27', 1, 2424000, 6192000, '2023-06-27 01:06:23', '2023-06-27 01:07:40'),
(24, 10, '2023-06-27', 1, 2170000, 3768000, '2023-06-27 01:08:15', '2023-06-27 01:09:19'),
(25, 10, '2023-06-27', 1, 2486000, 2798000, '2023-06-27 01:09:49', '2023-06-27 01:13:41'),
(26, 10, '2023-06-27', 1, 729000, 912000, '2023-06-27 01:18:45', '2023-06-27 01:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL DEFAULT '',
  `portrait_cover` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image_url`, `portrait_cover`, `description`, `created_at`, `updated_at`) VALUES
(20, 'Call of Duty®: Modern Warfare® II', 1025000, 'codmw2-cover.jpg', 'codmw2.png', 'Welcome to the new era of Call of Duty®.\r\n\r\nCall of Duty®: Modern Warfare® II drops players into an unprecedented global conflict that features the return of the iconic Operators of Task Force 141. From small-scale, high-stakes infiltration tactical ops to highly classified missions, players will deploy alongside friends in a truly immersive experience.\r\n\r\nInfinity Ward brings fans state-of-the-art gameplay, with all-new gun handling, advanced AI system, a new Gunsmith and a suite of other gameplay and graphical innovations that elevate the franchise to new heights.\r\n\r\nModern Warfare® II launches with a globe-trotting single-player campaign, immersive Multiplayer combat, and a narrative-driven, co-op Special Ops experience.\r\n\r\nYou also get access to Call of Duty®: Warzone™, the all-new Battle Royale experience.', NULL, NULL),
(21, 'Marvel’s Spider-Man Remastered', 879000, 'spidermanremas-cover.jpg', '5ef3979a19438889f51b12d75d0169d7.png', 'Developed by Insomniac Games in collaboration with Marvel, and optimized for PC by Nixxes Software, Marvel\'s Spider-Man Remastered on PC introduces an experienced Peter Parker who’s fighting big crime and iconic villains in Marvel’s New York. At the same time, he’s struggling to balance his chaotic personal life and career while the fate of Marvel’s New York rests upon his shoulders.', NULL, NULL),
(22, 'EA SPORTS™ FIFA 23', 759000, 'FIFA-23.jpeg', 'fifa23-library.png', 'EA SPORTS™ FIFA 23 brings The World’s Game to the pitch, with HyperMotion2 Technology that delivers even more gameplay realism, both the men’s and women’s FIFA World Cup™ coming to the game as post-launch updates, the addition of women’s club teams, cross-play features**, and more. Experience unrivaled authenticity with over 19,000 players, 700+ teams, 100 stadiums, and over 30 leagues in FIFA 23.', NULL, NULL),
(23, 'UNCHARTED™: Legacy of Thieves', 729000, 'wp10511331.jpg', '952d418cbb6e096e1c6eb2b075d097ac.png', 'Several years after his last adventure, retired fortune hunter Nathan Drake, is forced back into the world of thieves. Fate comes calling when Sam, Drake’s presumed dead brother, resurfaces seeking his help to save his own life and offering an adventure Drake can’t resist. Drake’s greatest adventure will test his physical limits, his resolve, and ultimately what he’s willing to sacrifice to save the ones he loves.\r\n\r\nOn the hunt for Captain Henry Avery’s long-lost treasure, Sam and Drake set off to find Libertalia, the pirate utopia deep in the forests of Madagascar – leading to a journey around the globe through jungle isles, far-flung cities, and snow capped peaks on the search for Avery’s fortune.', NULL, '2023-06-27 00:08:00'),
(24, 'Marvel\'s Spider-Man: Miles Morales', 729000, 'spiderman-cover.jpeg', '494b6bb2c25c38bb08bdf12b40cf5c85.png', 'Following the events of Marvel’s Spider-Man Remastered, teenager Miles Morales is adjusting to his new home while following in the footsteps of his mentor, Peter Parker, as a new Spider-Man. But when a fierce power struggle threatens to destroy his new home, the aspiring hero realizes that with great power, there must also come great responsibility. To save all of Marvel’s New York, Miles must take up the mantle of Spider-Man and own it.', NULL, NULL),
(25, 'God of War', 729000, '1445299.png', 'd1e6275ba67b9deba97c36664a972a9.png', 'His vengeance against the Gods of Olympus years behind him, Kratos now lives as a man in the realm of Norse Gods and monsters. It is in this harsh, unforgiving world that he must fight to survive… and teach his son to do the same.', NULL, NULL),
(26, 'Red Dead Redemption 2', 640000, 'rdr2-header.jpg', 'rdr2.png', 'Arthur Morgan and the Van der Linde gang are outlaws on the run. With federal agents and the best bounty hunters in the nation massing on their heels, the gang must rob, steal and fight their way across the rugged heartland of America in order to survive. As deepening internal divisions threaten to tear the gang apart, Arthur must make a choice between his own ideals and loyalty to the gang who raised him.', NULL, NULL),
(27, 'Hogwarts Legacy', 749000, 'hogwarts-legacy.jpg', 'b257b2c770d6926678e40ba7c97d070f-fakepng.png', 'Hogwarts Legacy is an open-world action RPG set in the world first introduced in the Harry Potter books. Embark on a journey through familiar and new locations as you explore and discover magical beasts, customize your character and craft potions, master spell casting, upgrade talents and become the wizard you want to be.\r\nExperience Hogwarts in the 1800s. Your character is a student who holds the key to an ancient secret that threatens to tear the wizarding world apart. Make allies, battle Dark wizards, and ultimately decide the fate of the wizarding world. Your legacy is what you make of it. Live the Unwritten.', NULL, NULL),
(28, 'Watch_Dogs™', 309000, 'zbzfb9map4o6w750.jpg', 'df827da31d664707840bc6c221f22d72.png', 'All it takes is the swipe of a finger. We connect with friends. We buy the latest gadgets and gear. We find out what’s happening in the world. But with that same simple swipe, we cast an increasingly expansive shadow. With each connection, we leave a digital trail that tracks our every move and milestone, our every like and dislike. And it’s not just people. Today, all major cities are networked. Urban infrastructures are monitored and controlled by complex operating systems.\r\nYou play as Aiden Pearce, a brilliant hacker and former thug, whose criminal past led to a violent family tragedy. Now on the hunt for those who hurt your family, you\'ll be able to monitor and hack all who surround you by manipulating everything connected to the city’s network. Access omnipresent security cameras, download personal information to locate a target, control traffic lights and public transportation to stop the enemy…and more.', NULL, NULL),
(29, 'Forza Horizon 5', 699000, 'ForzaHorizon5.jpg', '56215ebca1b05fd240764d8532e37ba1.png', 'Your Ultimate Horizon Adventure awaits! Explore the vibrant open world landscapes of Mexico with limitless, fun driving action in the world’s greatest cars. Conquer the rugged Sierra Nueva in the ultimate Horizon Rally experience. Requires Forza Horizon 5 game, expansion sold separately.', NULL, NULL),
(30, 'Call of Duty®: Black Ops Cold War', 812000, 'thumb-1920-1097309.png', '1baf650eb654d2f0e54a87c96713b3e1.png', 'Black Ops Cold War, the direct sequel to Call of Duty®: Black Ops, will drop fans into the depths of the Cold War’s volatile geopolitical battle of the early 1980s. Nothing is ever as it seems in a gripping single-player Campaign, where players will come face-to-face with historical figures and hard truths, as they battle around the globe through iconic locales like East Berlin, Vietnam, Turkey, Soviet KGB headquarters and more.', NULL, NULL),
(31, 'ELDEN RING', 599000, 'ELDENRING.jpg', 'eldenring-library.jpg', 'THE NEW FANTASY ACTION RPG. Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.', NULL, NULL),
(32, 'STAR WARS Jedi: Survivor™', 759000, 'wp12005386 (1).PNG', '56af732315294213f3c253636923f507.png', 'The story of Cal Kestis continues in Star Wars Jedi: Survivor™, a third-person, galaxy-spanning, action-adventure game from Respawn Entertainment, developed in collaboration with Lucasfilm Games. This narratively driven, single-player title picks up 5 years after the events of Star Wars Jedi: Fallen Order™ and follows Cal’s increasingly desperate fight as the galaxy descends further into darkness. Pushed to the edges of the galaxy by the Empire, Cal will find himself surrounded by threats new and familiar. As one of the last surviving Jedi Knights, Cal is driven to make a stand during the galaxy’s darkest times — but how far is he willing to go to protect himself, his crew, and the legacy of the Jedi Order?', NULL, NULL),
(33, 'Rise of the Tomb Raider™', 570000, 'Tomb-Raider-2018-Wallpapers-HD-71-background-pictures-.jpg', 'e64b845130b2374ecfd519aa008a9429.jpg', 'Rise of the Tomb Raider: 20 Year Celebration includes the base game and Season Pass featuring all-new content. Explore Croft Manor in the new “Blood Ties” story, then defend it against a zombie invasion in “Lara’s Nightmare”. Survive extreme conditions with a friend in the new online Co-Op Endurance mode, and brave the new “Extreme Survivor” difficulty. Also features an outfit and weapon inspired by Tomb Raider III, and 5 classic Lara skins. Existing DLC will challenge you to explore a new tomb that houses an ancient terror in Baba Yaga: The Temple of the Witch, and combat waves of infected predators in Cold Darkness Awakened.', NULL, NULL),
(34, 'The Last of Us™ Part I', 879000, '1295037.jpg', '4bf0cb09754825332a5ff64d5ed98436.png', 'Experience the emotional storytelling and unforgettable characters in The Last of Us™, winner of over 200 Game of the Year awards.\r\n\r\nIn a ravaged civilization, where infected and hardened survivors run rampant, Joel, a weary protagonist, is hired to smuggle 14-year-old Ellie out of a military quarantine zone. However, what starts as a small job soon transforms into a brutal cross-country journey.\r\n\r\nIncludes the complete The Last of Us single-player story and celebrated prequel chapter, Left Behind, which explores the events that changed the lives of Ellie and her best friend Riley forever.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `balance` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `role`, `balance`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'admin', 'admin@gmail.com', NULL, '$2y$10$Lv2JIf8NZEq1VTkim//7rebvysykhMLcyKS0icfOjH/URVuOhrVpa', 'default.png', 'Admin', 0, NULL, NULL, NULL),
(10, 'Zar', 'test@gmail.com', NULL, '$2y$10$jn0GzkpUSZIqpvph6.buU.678WZCr/OiGrR5hc6M5/YjJzwoGbOf2', 'a903efb0ec7d542c0037aa8799e82a8f.jpg', 'customer', 183000, NULL, NULL, '2023-06-27 01:19:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_order_id_foreign` (`order_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `games_user_id_foreign` (`user_id`),
  ADD KEY `games_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `games_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
