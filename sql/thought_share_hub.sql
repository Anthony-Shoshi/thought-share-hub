-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 07, 2024 at 01:09 AM
-- Server version: 11.2.3-MariaDB-1:11.2.3+maria~ubu2204
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thought_share_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `slug`) VALUES
(2, 'Cloud Computing', 'cloud-computing'),
(5, 'Backend Development', 'backend-development'),
(6, 'Frontend', 'frontend'),
(7, 'Tips and Tricks', 'tips-and-tricks'),
(9, 'Mobile Application', 'mobile-application');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `name`, `email`, `post_id`, `comment_text`, `created_at`) VALUES
(5, 'Anthony Gomes ', 'gomesanthonyshoshi@gmail.com', 16, 'really nice', '2024-03-09 04:06:32'),
(9, 'Novotel', 'anthony@gmail.com', 16, 'Mooi', '2024-03-09 06:47:27'),
(11, 'Test', 'gomesanthonyshoshi@gmail.com', 16, 'Test', '2024-03-09 06:57:26'),
(19, 'Anthony', 'gomesanthonyshoshi@gmail.com', 15, 'New', '2024-03-18 05:07:15'),
(20, 'Anthony', 'gomesanthonyshoshi@gmail.com', 15, 'Really Nice!', '2024-03-18 05:07:27'),
(21, 'Anthony', 'gomesanthonyshoshi@gmail.com', 14, 'Nice!', '2024-03-18 08:51:17'),
(22, 'Corendon', 'gomesanthonyshoshi@gmail.com', 14, 'New Comments@!', '2024-04-07 02:28:44'),
(23, 'Anthony Shoshi Gomes', 'gomesanthonyshoshi@gmail.com', 14, 'Moi!!', '2024-04-07 02:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `post_id`, `user_ip`, `created_at`) VALUES
(5, 14, 'test\r\n', '2024-03-05 04:25:34'),
(6, 16, '172.22.0.1', '2024-03-06 13:51:05'),
(8, 18, '172.22.0.1', '2024-03-09 05:35:34'),
(9, 15, '172.22.0.1', '2024-03-09 06:19:10'),
(10, 15, '172.24.0.1', '2024-03-18 05:05:20'),
(11, 14, '172.24.0.1', '2024-03-18 08:50:36'),
(12, 16, '172.24.0.1', '2024-04-07 02:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `title`, `short_description`, `content`, `image_url`, `is_featured`, `slug`, `created_at`, `updated_at`, `category_id`) VALUES
(14, 1, 'Mastering Backend Development: A Comprehensive Guide', 'Delve into the world of backend development with our comprehensive guide. From understanding the fundamentals to mastering advanced techniques, this blog post covers everything you need to know to become a proficient backend developer.', 'Welcome to our ultimate guide on mastering backend development! Whether you\'re a beginner looking to explore the world of server-side programming or an experienced developer aiming to enhance your skills, this blog post is your go-to resource. We\'ll take you on a journey through the essentials of backend development, covering key concepts, best practices, and advanced techniques.\r\n\r\nUnderstanding Backend Development:\r\nWe\'ll kick off by demystifying backend development, explaining its role in web development and its significance in powering dynamic websites and applications. You\'ll gain insights into server-side languages, databases, and frameworks, laying the foundation for your backend development journey.\r\n\r\nEssential Tools and Technologies:\r\nNext, we\'ll delve into the essential tools and technologies used in backend development. From programming languages like Python, Java, and Node.js to databases such as MySQL, MongoDB, and PostgreSQL, we\'ll explore the diverse ecosystem of backend technologies. You\'ll learn how to select the right tools for your projects and set up your development environment effectively.\r\n\r\nBuilding RESTful APIs:\r\nOne of the core tasks of backend development is building RESTful APIs (Application Programming Interfaces). We\'ll guide you through the process of designing, implementing, and testing APIs using industry-standard practices. You\'ll discover how to create endpoints, handle requests and responses, and ensure scalability and security in your API architecture.\r\n\r\nData Management and Storage:\r\nData management is a critical aspect of backend development. We\'ll cover essential topics such as database design, data modeling, and CRUD (Create, Read, Update, Delete) operations. You\'ll learn how to interact with databases efficiently, optimize queries, and ensure data integrity and security.\r\n\r\nAuthentication and Authorization:\r\nSecurity is paramount in backend development, especially when handling sensitive user data. We\'ll explore authentication and authorization mechanisms, including token-based authentication, OAuth, and role-based access control. You\'ll discover how to implement robust security measures to protect your applications from unauthorized access and data breaches.\r\n\r\nScalability and Performance Optimization:\r\nAs your applications grow, scalability and performance become crucial considerations. We\'ll discuss strategies for optimizing backend performance, including caching, load balancing, and horizontal scaling. You\'ll learn how to architect scalable systems that can handle increasing traffic and maintain optimal performance under heavy loads.\r\n\r\nTesting and Debugging:\r\nEffective testing and debugging are essential for ensuring the reliability and stability of your backend code. We\'ll introduce you to various testing methodologies, including unit testing, integration testing, and end-to-end testing. You\'ll discover tools and techniques for identifying and fixing bugs, ensuring the robustness of your applications.\r\n\r\nDeployment and Continuous Integration/Continuous Deployment (CI/CD):\r\nFinally, we\'ll cover the deployment of backend applications and the implementation of CI/CD pipelines. You\'ll learn how to automate the deployment process, streamline version control, and ensure seamless delivery of updates to production environments.\r\n\r\nConclusion:\r\nBy the end of this guide, you\'ll have a comprehensive understanding of backend development and the skills to build robust, scalable, and secure web applications. Whether you\'re developing APIs, managing databases, or optimizing performance, you\'ll be equipped with the knowledge and tools to excel in the world of backend development.\r\n\r\nStart your journey to mastering backend development today and unlock endless possibilities for building innovative web solutions!\r\n\r\nHappy coding!', '/images/6611ed55dfa39_65e863738e286_img01.jpg', 0, 'mastering-backend-development-a-comprehensive-guide', '2024-03-04 00:04:44', '2024-04-07 02:48:21', 5),
(15, 1, 'A Beginner\'s Guide to Frontend Development', 'Dive into the world of frontend development with this comprehensive guide for beginners.', 'Are you interested in creating stunning user interfaces and interactive web applications? Frontend development is the key to crafting visually appealing and engaging experiences for users. In this guide, we\'ll take you through the fundamentals of frontend development, including HTML, CSS, and JavaScript. You\'ll learn how to structure web pages, style elements with CSS, and add interactivity using JavaScript. We\'ll also cover popular frontend frameworks like React, Vue.js, and Angular, empowering you to build modern web applications with ease. Whether you\'re a complete beginner or looking to expand your skills, this guide will equip you with the knowledge and tools you need to succeed in frontend development.', '/images/6611ed9a6ce9e_65e86383c246b_op-Ten-Front-End-Design-Rules-For-Developers_Luke-Social-33a3a7c9b759fdaa22973906070f8065.png', 1, 'a-beginner-s-guide-to-frontend-development', '2024-03-06 13:26:17', '2024-04-07 02:49:30', 6),
(16, 1, 'Mastering Backend Development with Node.js', 'Take your backend development skills to the next level with Node.js, the popular JavaScript runtime.', 'Backend development is the backbone of every web application, handling data processing, server-side logic, and database management. With Node.js, you can build scalable and high-performance backend systems using JavaScript, the same language you use on the frontend. In this comprehensive guide, we\'ll explore the ins and outs of backend development with Node.js. You\'ll learn how to create RESTful APIs, interact with databases using MongoDB and Mongoose, and implement authentication and authorization using JWT tokens. We\'ll also cover advanced topics like asynchronous programming, error handling, and performance optimization. By the end of this guide, you\'ll have the skills and confidence to build robust backend systems with Node.js.', '/images/6611edae0cfff_65e863cd6ac0e_developer-responsebilities.png', 0, 'mastering-backend-development-with-node-js', '2024-03-06 13:26:45', '2024-04-07 02:49:50', 5),
(17, 1, 'Demystifying Cloud Computing: A Beginner\'s Guide', 'Discover the power of cloud computing and learn how to leverage cloud services for your projects.', 'Cloud computing has revolutionized the way we build, deploy, and scale applications, offering on-demand access to a wide range of computing resources and services. In this beginner-friendly guide, we\'ll demystify cloud computing and explore its key concepts and principles. You\'ll learn about different cloud service models, including Infrastructure as a Service (IaaS), Platform as a Service (PaaS), and Software as a Service (SaaS). We\'ll also delve into popular cloud providers like Amazon Web Services (AWS), Microsoft Azure, and Google Cloud Platform (GCP), guiding you through the process of setting up your own cloud environment and deploying applications. Whether you\'re a developer, entrepreneur, or IT professional, this guide will empower you to harness the full potential of cloud computing.', '/images/6611edd4508cb_6610a6ba2dc47_0_RW3STIBmezNAIL9T.jpg', 1, 'demystifying-cloud-computing-a-beginner-s-guide', '2024-03-06 13:27:07', '2024-04-07 02:50:28', 2),
(18, 1, 'Building Cross-Platform Mobile Apps with Flutter', 'Unlock the power of cross-platform development with Flutter and create beautiful mobile apps for iOS and Android.', 'Gone are the days of building separate codebases for iOS and Android. With Flutter, Google\'s open-source UI toolkit, you can write code once and deploy it across multiple platforms, saving time and effort in the development process. In this hands-on guide, we\'ll show you how to build stunning mobile apps with Flutter. You\'ll learn how to design beautiful user interfaces using Flutter\'s rich set of widgets, manage state effectively, and interact with device features like camera, location, and sensors. We\'ll also cover topics like navigation, state management, and app deployment, giving you the skills you need to bring your app ideas to life. Whether you\'re a beginner or experienced developer, Flutter offers a fast and productive way to build high-quality mobile apps.', '/images/6611ede58d4da_65e8639a315d9_download (1).jpg', 0, 'building-cross-platform-mobile-apps-with-flutter', '2024-03-06 13:27:38', '2024-04-07 02:50:45', 9),
(19, 1, 'Exploring the World of Serverless Computing', 'Delve into the realm of serverless computing and discover a new paradigm for building scalable and cost-effective applications.', 'Serverless computing has emerged as a game-changer in the world of cloud computing, allowing developers to focus on writing code without worrying about managing servers or infrastructure. In this insightful guide, we\'ll explore the principles of serverless computing and its advantages for modern application development. You\'ll learn how serverless platforms like AWS Lambda, Azure Functions, and Google Cloud Functions work under the hood, and how to design and deploy serverless applications efficiently. We\'ll also discuss use cases for serverless computing, including web applications, APIs, data processing pipelines, and more. Whether you\'re a developer, architect, or IT professional, this guide will help you navigate the exciting world of serverless computing and harness its potential for your projects.', '/images/6611edf43725f_65e863a1ea3b3_download.jpg', 0, 'exploring-the-world-of-serverless-computing', '2024-03-06 13:28:02', '2024-04-07 02:51:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registration_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `registration_date`) VALUES
(1, 'admin', '$2y$10$JD9s3Og9iEJRArcij9o5Xe9dcpdMTDDQh7z6t7ccIeuejW22.s9qS', 'anthony@gmail.com', '2024-01-21 02:51:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_posts_categories` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
