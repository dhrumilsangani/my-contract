-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2021 at 04:47 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lawyer`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT ' 0 = InActive , 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`id`, `page_title`, `page_content`, `page_slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Privacy policy', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum</p>', 'privacy-policy', 1, '2021-06-10 19:52:51', '2021-06-10 19:52:51', NULL),
(2, 'Terms & Conditions', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>', 'terms-conditions', 1, '2021-06-10 20:30:34', '2021-06-10 20:30:34', NULL),
(3, 'Acceptable Use Policy', '<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', 'acceptable-use-policy', 1, '2021-06-10 20:31:55', '2021-06-10 20:31:55', NULL),
(4, 'Cookies Policy', '<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', 'cookies-policy', 1, '2021-06-10 20:32:35', '2021-06-10 20:32:35', NULL),
(5, 'Contact Us', '<h2>We are always open<br />\r\nfor help you.</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered.</p>\r\n\r\n<h3>Call us</h3>\r\n\r\n<p>+1-492-4918-395</p>\r\n\r\n<p>+14-394-409-591</p>\r\n\r\n<h3>Email us</h3>\r\n\r\n<p>info@mail.com</p>\r\n\r\n<p>support@mail.com</p>\r\n\r\n<h3>Our Address</h3>\r\n\r\n<p>34 Madison Street,</p>\r\n\r\n<p>NY, USA 10005</p>', 'contact-us', 1, '2021-06-10 20:35:03', '2021-06-11 14:20:48', NULL),
(6, 'About Us', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 'about-us', 1, '2021-06-11 13:01:27', '2021-06-11 13:01:27', NULL),
(7, 'test', '<p>sfsdf</p>', 'test', 1, '2021-06-11 19:53:29', '2021-06-11 19:53:49', '2021-06-11 19:53:49'),
(8, 'test', '<p>sdsdf test</p>', 'test', 1, '2021-06-11 20:10:41', '2021-06-11 20:10:55', '2021-06-11 20:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `email`, `name`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'ritesh.rana@spec-india.com', 'ritesh', 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2021-06-11 17:10:47', '2021-06-11 17:10:47'),
(2, 'ritesh.rana@spec-india.com', 'ritesh', 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2021-06-11 17:11:16', '2021-06-11 17:11:16'),
(3, 'ritesh.rana@spec-india.com', 'ritesh', 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2021-06-11 17:14:12', '2021-06-11 17:14:12'),
(4, 'ritesh.rana@spec-india.com', 'ritesh', 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2021-06-11 17:14:52', '2021-06-11 17:14:52'),
(5, 'ritesh.rana@spec-india.com', 'ritesh rana', 'test 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting', '2021-06-11 17:16:17', '2021-06-11 17:16:17'),
(6, 'ritesh.rana@spec-india.com', 'ritesh rana', 'test 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting', '2021-06-11 17:16:56', '2021-06-11 17:16:56'),
(7, 'ritesh.rana@spec-india.com', 'ritesh rana', 'test 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting', '2021-06-11 17:17:50', '2021-06-11 17:17:50'),
(8, 'ritesh.rana@spec-india.com', 'ritesh rana', 'test 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting', '2021-06-11 17:18:05', '2021-06-11 17:18:05'),
(9, 'ritesh.rana@spec-india.com', 'ritesh rana', 'test 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting', '2021-06-11 17:18:16', '2021-06-11 17:18:16'),
(10, 'ritesh.rana@spec-india.com', 'ritesh rana', 'test 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting', '2021-06-11 17:18:34', '2021-06-11 17:18:34'),
(11, 'ritesh.rana@spec-india.com', 'ritesh rana', 'test 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting', '2021-06-11 17:18:53', '2021-06-11 17:18:53'),
(12, 'ritesh.rana@spec-india.com', 'ritesh rana', 'test 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2021-06-11 17:19:49', '2021-06-11 17:19:49'),
(13, 'ritesh.rana@spec-india.com', 'ritesh rana test', 'test 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2021-06-11 17:34:34', '2021-06-11 17:34:34'),
(14, 'ritesh.rana@spec-india.com', 'ritesh rana test 4', 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2021-06-11 17:42:05', '2021-06-11 17:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_json_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT ' 0 = InActive , 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`id`, `title`, `contract_detail`, `form_json_data`, `contract_file`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Contract 1', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s</p>', NULL, '1623778297.docx', 1, '2021-06-02 13:20:00', '2021-06-16 00:31:37', NULL),
(2, 'Contract 2', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s test</p>', NULL, '1623230945.png', 1, '2021-06-02 13:20:12', '2021-06-09 16:29:05', NULL),
(3, 'test', '<p>jkhjk</p>', NULL, '1623417610.jpg', 0, '2021-06-11 20:20:10', '2021-06-11 20:20:17', '2021-06-11 20:20:17'),
(4, 'Contract 1', '<p>fgh</p>', NULL, '1623417669.jpg', 0, '2021-06-11 20:21:09', '2021-06-11 20:21:13', '2021-06-11 20:21:13'),
(5, 'Contract 2', '<p>sdf</p>', NULL, '1623417846.jpg', 1, '2021-06-11 20:24:06', '2021-06-11 20:24:10', '2021-06-11 20:24:10'),
(6, 'Contract 3', '<p>dasf test</p>', NULL, '1623418521.docx', 1, '2021-06-11 20:34:34', '2021-06-11 20:35:26', '2021-06-11 20:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `contract_data`
--

CREATE TABLE `contract_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contract_data`
--

INSERT INTO `contract_data` (`id`, `contract_name`, `template_id`, `contract_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Contracts and agreements test test', 1, 1, 2, '2021-06-23 14:08:42', '2021-06-25 19:36:25'),
(2, 'Contracts and agreements', 1, 1, 2, '2021-06-23 20:59:25', '2021-06-23 21:29:14'),
(3, 'ritesh test 12345', 1, 1, 2, '2021-06-24 20:28:51', '2021-06-24 20:28:51'),
(4, 'Contracts and agreements test 12', 1, 1, 2, '2021-06-25 18:04:38', '2021-06-25 18:04:38'),
(5, 'Contracts and agreements test', 1, 1, 2, '2021-06-25 18:07:56', '2021-06-25 18:07:56'),
(6, 'Contracts and agreements test', 1, 1, 2, '2021-06-25 18:18:12', '2021-06-25 18:18:12'),
(7, 'ritesh data', 1, 1, 2, '2021-06-25 19:23:03', '2021-06-25 19:23:03'),
(8, 'ritesh data', 1, 1, 2, '2021-06-25 19:25:15', '2021-06-25 19:25:15'),
(9, 'Contracts and agreements test', 1, 1, 2, '2021-06-25 19:35:08', '2021-06-25 19:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_17_132859_create_cms_page_table', 2),
(25, '2021_05_20_061757_create_contract_table', 3),
(26, '2021_05_21_120817_create_template_table', 3),
(27, '2021_06_02_044834_create_template_form_table', 3),
(32, '2021_06_09_074505_create_testimonials_table', 5),
(33, '2021_06_09_111933_create_team_member_table', 6),
(37, '2021_06_11_074412_create_contact_us_table', 8),
(41, '2021_06_16_130430_create_products_table', 10),
(43, '2021_06_16_121546_create_payment_details_table', 11),
(45, '2021_06_16_125525_create_subscriptions_table', 12),
(46, '2014_10_12_000000_create_users_table', 13),
(47, '2021_06_10_090909_create_temporarily_user_table', 14),
(52, '2021_06_22_091216_create_send_contract_table', 17),
(53, '2021_06_15_125044_create_template_field_data_table', 18),
(54, '2021_06_22_070929_create_contract_data_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `user_id`, `amount`, `type`, `transaction_id`, `transaction_status`, `payment_session_id`, `payment_type`, `currency`, `created_at`, `updated_at`) VALUES
(1, 5, '19.95', 'One-Off Contract', 'pi_1J3IuXDDfbTg1evAJHKwB48Y', 'success', 'cs_test_a1FuNsp8tLzIsTtL6qoedsX9YUcc79jP6Tj6wVM4jvaczVEbfjOVC8D6iu', 'stripe', 'eur', '2021-06-17 17:57:24', '2021-06-17 17:57:56'),
(2, 6, '19.95', 'One-Off Contract', 'pi_1J3J2GDDfbTg1evAdVFbsr1z', 'success', 'cs_test_a1ae0MO4h4cL0GBgBVgq4X6m2XCTnEzD4JGkBUPvwbjgCzaTcWyQyne2hu', 'stripe', 'eur', '2021-06-17 18:05:24', '2021-06-17 18:05:48'),
(3, 15, '19.95', 'One-Off Contract', NULL, 'inprocess', 'cs_test_a1J33F2SWYbwxdYsNaXXKqdwNkdxdAXS6QHxsbX2iqTOeJLdxI3a1SIiy9', NULL, NULL, '2021-06-17 18:05:25', '2021-06-17 18:05:26'),
(4, 8, '9.95', 'month', 'pi_1J3KD2DDfbTg1evANJwknUYp', 'success', 'cs_test_a1HolAFD16HCSZkgalUza5JkBjjmrg1vSiDKS9RPgNr5eLW9YQggKmK6d5', 'stripe', 'eur', '2021-06-17 19:20:35', '2021-06-17 19:22:20'),
(5, 9, '9.95', 'month', 'pi_1J3KFnDDfbTg1evAFXct5IQk', 'success', 'cs_test_a10P2AbGfDxANvbwQ7ALTJVauCyBLJSLuVQyCNV8JhO45FpPyLNbIHsvNY', 'stripe', 'eur', '2021-06-17 19:23:26', '2021-06-17 19:23:49'),
(6, 10, '9.95', 'month', 'pi_1J3KIiDDfbTg1evAmob9yG3i', 'success', 'cs_test_a15Kt5ABdCFwTxcTHZDodBjO6fnvuhQyQHOOoVDStVQqFEE3uI4EYLnVlS', 'stripe', 'eur', '2021-06-17 19:26:27', '2021-06-17 19:27:01'),
(7, 10, '99.95', 'Yearly', 'pi_1J3KojDDfbTg1evA8sUeFfjj', 'success', 'cs_test_a1EUxji4yCEEQrzuY7YYpXTVK55VKt58YocCYOIJa6FMBeVERw3h58HOtu', 'stripe', 'eur', '2021-06-17 19:59:32', '2021-06-17 19:59:59'),
(8, 10, '99.95', 'Yearly', 'pi_1J3KqLDDfbTg1evAoT5q9dbu', 'success', 'cs_test_a125Jy2NY5XPrVpukwxmPbV9ZYLGrDi6VGantSJAuYiZOSu1dNoXIXPn1V', 'stripe', 'eur', '2021-06-17 20:01:12', '2021-06-17 20:01:40'),
(9, 10, '99.95', 'Yearly', 'pi_1J3KuVDDfbTg1evAdJSCIvnj', 'success', 'cs_test_a1fYeAiMGtFutrQH0bfNwELQHw8z0Ecxt0sBw01FmIevptV8X9HPQ0ZVkU', 'stripe', 'eur', '2021-06-17 20:05:30', '2021-06-17 20:05:56'),
(10, 10, '99.95', 'Yearly', 'pi_1J3KwDDDfbTg1evAuSnvAMEM', 'success', 'cs_test_a1mOiXO3XwEN9F9wd2bxztlU0mSODh2ufATEtenJ3j8gcOQOUIJ36CTEZp', 'stripe', 'eur', '2021-06-17 20:07:16', '2021-06-17 20:15:17'),
(11, 10, '99.95', 'Yearly', 'pi_1J3L4oDDfbTg1evAcgPyiZds', 'success', 'cs_test_a1hNOx0R2i8uilPTjDJMK12hrHCo2K0TDWVpBTioetsKpSSvTNiMiMTUgu', 'stripe', 'eur', '2021-06-17 20:16:09', '2021-06-17 20:16:34'),
(12, 10, '9.95', 'month', 'pi_1J3MjdDDfbTg1evAuBFM2WjL', 'success', 'cs_test_a1A4S2a63VbAeHFwA2E4jVTdY3ALhiatwxRv3KFMCVHXFFxTisS44OEGKM', 'stripe', 'eur', '2021-06-17 22:02:24', '2021-06-17 22:02:50'),
(13, 2, '99.95', 'Yearly', 'pi_1J41F3DDfbTg1evAiorq25Ta', 'success', 'cs_test_a18rMAn9L7XlB3X0qcn75LMOjmIw815CvvH6QMERFOFs2Jt8QI8IKONmAP', 'stripe', 'eur', '2021-06-19 17:17:32', '2021-06-19 17:17:59'),
(14, 2, '99.95', 'Yearly', 'pi_1J6EIZDDfbTg1evASay4x1kS', 'success', 'cs_test_a1bwe77umAFFYhH0VT7ewuxZb39JOcQih4LAK5kp34xf7YjsONlOX8Uxi4', 'stripe', 'eur', '2021-06-25 19:38:18', '2021-06-25 19:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `price_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT ' 0 = InActive , 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `type`, `price`, `price_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Starter', 'One-Off Contract', 19.95, 'price_1J1dqkDDfbTg1evABvdw80Gf', 1, NULL, NULL),
(2, 'Exclusive', 'month', 9.95, 'price_1J1eQnDDfbTg1evAzJj85wQJ', 1, NULL, NULL),
(3, 'Premium', 'Yearly', 99.95, 'price_1J1eRxDDfbTg1evAwBuU0sL3', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `send_contract`
--

CREATE TABLE `send_contract` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `contract_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `send_contract`
--

INSERT INTO `send_contract` (`id`, `contract_id`, `contract_url`, `email`, `message`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500', 2, '2021-06-23 14:08:55', '2021-06-23 14:08:55'),
(2, 1, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500', 2, '2021-06-23 14:10:49', '2021-06-23 14:10:49'),
(3, 1, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500', 2, '2021-06-23 14:16:15', '2021-06-23 14:16:15'),
(4, 1, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500', 2, '2021-06-23 14:18:11', '2021-06-23 14:18:11'),
(5, 1, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500', 2, '2021-06-23 14:42:39', '2021-06-23 14:42:39'),
(6, 1, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500', 2, '2021-06-23 15:11:58', '2021-06-23 15:11:58'),
(7, 1, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500', 2, '2021-06-23 15:23:40', '2021-06-23 15:23:40'),
(8, 1, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500', 2, '2021-06-23 15:36:45', '2021-06-23 15:36:45'),
(9, 1, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500', 2, '2021-06-23 20:55:18', '2021-06-23 20:55:18'),
(10, 2, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'teste sdsdsdf', 2, '2021-06-23 20:59:37', '2021-06-23 20:59:37'),
(11, 3, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'testy', 2, '2021-06-24 20:28:59', '2021-06-24 20:28:59'),
(12, 8, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'tesdfsdf', 2, '2021-06-25 19:25:26', '2021-06-25 19:25:26'),
(13, 9, 'C:\\xampp\\htdocs\\lawyers_app/public/uploads/download/2/newDoc.docx', 'ritesh.rana@spec-india.com', 'tessdf', 2, '2021-06-25 19:35:20', '2021-06-25 19:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(12,2) DEFAULT NULL,
  `from_date` timestamp NULL DEFAULT NULL,
  `to_date` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT ' 0 = InActive , 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `total_amount`, `from_date`, `to_date`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 10, '9.95', '2021-06-17 07:00:00', '2024-08-17 07:00:00', 'month', 1, '2021-06-17 19:27:01', '2021-06-17 22:02:50'),
(2, 2, '99.95', '2021-06-25 07:00:00', '2023-06-19 07:00:00', 'Yearly', 1, '2021-06-19 17:17:59', '2021-06-25 19:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `team_member`
--

CREATE TABLE `team_member` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `positions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT ' 0 = InActive , 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_member`
--

INSERT INTO `team_member` (`id`, `name`, `image`, `positions`, `facebook`, `twitter`, `linkedin`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ritesh rana', '1623240711.jpg', 'software developer', 'test', 'test', 'ws', 1, '2021-06-09 19:09:44', '2021-06-09 19:11:51'),
(2, 'mehul patel', '1623249614.jpg', 'software developer', 'test', 'test', 'ws', 1, '2021-06-09 21:14:43', '2021-06-09 21:40:14'),
(3, 'mona shah', '1623249594.jpg', 'software developer', 'test', 'test', 'ws', 1, '2021-06-09 21:15:09', '2021-06-09 21:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_id` int(11) NOT NULL,
  `form_json_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT ' 0 = InActive , 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `template_name`, `contract_id`, `form_json_data`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, '[{\"type\":\"checkbox-group\",\"required\":\"1\",\"label\":\"Status\",\"name\":\"status\",\"values\":[{\"label\":\"Active\",\"value\":\"active\",\"selected\":true},{\"label\":\"Inactive\",\"value\":\"inactive\"}]},{\"type\":\"date\",\"required\":\"1\",\"label\":\"Date\",\"placeholder\":\"Please enter date\",\"className\":\"form-control\",\"name\":\"date\"},{\"type\":\"file\",\"label\":\"File Upload\",\"className\":\"form-control\",\"name\":\"file_1623672153075\"},{\"type\":\"header\",\"subtype\":\"h1\",\"label\":\"Header name\"},{\"type\":\"paragraph\",\"subtype\":\"p\",\"label\":\"Paragraph\"},{\"type\":\"number\",\"label\":\"Number\",\"placeholder\":\"Please enter number\",\"className\":\"form-control\",\"name\":\"number\",\"min\":\"10\",\"max\":\"50\"},{\"type\":\"radio-group\",\"required\":\"1\",\"label\":\"Gender\",\"name\":\"gender\",\"values\":[{\"label\":\"male\",\"value\":\"male\",\"selected\":true},{\"label\":\"female\",\"value\":\"female\"}]},{\"type\":\"select\",\"required\":\"1\",\"label\":\"Country\",\"placeholder\":\"Please select country\",\"className\":\"form-control\",\"name\":\"country\",\"values\":[{\"label\":\"India\",\"value\":\"option-1\",\"selected\":true},{\"label\":\"Uk\",\"value\":\"option-2\"}]},{\"type\":\"text\",\"required\":\"1\",\"label\":\"first name\",\"placeholder\":\"Please enter name\",\"name\":\"first_name\",\"subtype\":\"text\",\"maxlength\":\"150\",\"className\":\"red form-control\"},{\"type\":\"textarea\",\"label\":\"Text Area\",\"className\":\"form-control\",\"name\":\"textarea_1623672935819\",\"subtype\":\"textarea\"},{\"type\":\"textarea\",\"label\":\"address\",\"className\":\"form-control\",\"name\":\"address\",\"subtype\":\"textarea\"}]', 1, '2021-06-14 19:25:00', '2021-06-24 16:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `template_field_data`
--

CREATE TABLE `template_field_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_data_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_field_data`
--

INSERT INTO `template_field_data` (`id`, `contract_data_id`, `field_id`, `template_id`, `meta_key`, `meta_value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'status', 'active,inactive', '2021-06-23 14:08:42', '2021-06-23 14:08:42'),
(2, 1, 2, 1, 'date', '2021-09-24', '2021-06-23 14:08:42', '2021-06-23 21:24:34'),
(3, 1, 3, 1, 'file_1623672153075', '16244626560.jpg', '2021-06-23 14:08:43', '2021-06-23 22:37:36'),
(4, 1, 6, 1, 'number', '987654321033', '2021-06-23 14:08:43', '2021-06-24 18:04:09'),
(5, 1, 7, 1, 'gender', 'male', '2021-06-23 14:08:43', '2021-06-23 21:27:39'),
(6, 1, 8, 1, 'country', 'option-1', '2021-06-23 14:08:43', '2021-06-23 21:27:39'),
(7, 1, 9, 1, 'first_name', 'ritesh test test test', '2021-06-23 14:08:43', '2021-06-24 18:04:09'),
(8, 1, 10, 1, 'textarea_1623672935819', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500 test test', '2021-06-23 14:08:43', '2021-06-24 18:04:09'),
(9, 2, 1, 1, 'status', 'active,inactive', '2021-06-23 20:59:25', '2021-06-23 20:59:25'),
(10, 2, 2, 1, 'date', '2021-10-24', '2021-06-23 20:59:25', '2021-06-23 20:59:25'),
(11, 2, 3, 1, 'file_1623672153075', '16244585540.jpg', '2021-06-23 20:59:25', '2021-06-23 21:29:14'),
(12, 2, 6, 1, 'number', '9876543210', '2021-06-23 20:59:25', '2021-06-23 21:29:14'),
(13, 2, 7, 1, 'gender', 'male', '2021-06-23 20:59:25', '2021-06-23 20:59:25'),
(14, 2, 8, 1, 'country', 'option-1', '2021-06-23 20:59:25', '2021-06-23 21:29:14'),
(15, 2, 9, 1, 'first_name', 'ritesh rana', '2021-06-23 20:59:25', '2021-06-23 21:29:14'),
(16, 2, 10, 1, 'textarea_1623672935819', 'test test', '2021-06-23 20:59:25', '2021-06-23 21:29:14'),
(17, 3, 11, 1, 'status', 'active,inactive', '2021-06-24 20:28:51', '2021-06-24 20:28:51'),
(18, 3, 12, 1, 'date', '2021-06-25', '2021-06-24 20:28:51', '2021-06-24 20:28:51'),
(19, 3, 13, 1, 'file_1623672153075', '16245413310.jpg', '2021-06-24 20:28:51', '2021-06-24 20:28:51'),
(20, 3, 16, 1, 'number', '34345345345345', '2021-06-24 20:28:51', '2021-06-24 20:28:51'),
(21, 3, 17, 1, 'gender', 'male', '2021-06-24 20:28:51', '2021-06-24 20:28:51'),
(22, 3, 18, 1, 'country', 'option-2', '2021-06-24 20:28:51', '2021-06-24 20:28:51'),
(23, 3, 19, 1, 'first_name', 'test', '2021-06-24 20:28:51', '2021-06-24 20:28:51'),
(24, 3, 20, 1, 'textarea_1623672935819', 'ertwewrtew', '2021-06-24 20:28:51', '2021-06-24 20:28:51'),
(25, 3, 21, 1, 'address', 'wert wertwert', '2021-06-24 20:28:51', '2021-06-24 20:28:51'),
(26, 4, 11, 1, 'status', 'active,inactive', '2021-06-25 18:04:38', '2021-06-25 18:04:38'),
(27, 4, 12, 1, 'date', '2021-06-26', '2021-06-25 18:04:38', '2021-06-25 18:04:38'),
(28, 4, 13, 1, 'file_1623672153075', '16246190780.jpg', '2021-06-25 18:04:38', '2021-06-25 18:04:38'),
(29, 4, 16, 1, 'number', '2342423423423', '2021-06-25 18:04:38', '2021-06-25 18:04:38'),
(30, 4, 17, 1, 'gender', 'male', '2021-06-25 18:04:38', '2021-06-25 18:04:38'),
(31, 4, 18, 1, 'country', 'option-2', '2021-06-25 18:04:38', '2021-06-25 18:04:38'),
(32, 4, 19, 1, 'first_name', 'test rrrrr', '2021-06-25 18:04:38', '2021-06-25 18:04:38'),
(33, 4, 20, 1, 'textarea_1623672935819', 'sfsdfsdfsdfs', '2021-06-25 18:04:38', '2021-06-25 18:04:38'),
(34, 4, 21, 1, 'address', 'sdfsdfsdf', '2021-06-25 18:04:38', '2021-06-25 18:04:38'),
(35, 5, 11, 1, 'status', 'active', '2021-06-25 18:07:56', '2021-06-25 18:07:56'),
(36, 5, 12, 1, 'date', '2021-06-25', '2021-06-25 18:07:56', '2021-06-25 18:07:56'),
(37, 5, 13, 1, 'file_1623672153075', '16246192760.jpg', '2021-06-25 18:07:56', '2021-06-25 18:07:56'),
(38, 5, 16, 1, 'number', '23423434', '2021-06-25 18:07:56', '2021-06-25 18:07:56'),
(39, 5, 17, 1, 'gender', 'male', '2021-06-25 18:07:56', '2021-06-25 18:07:56'),
(40, 5, 18, 1, 'country', 'option-2', '2021-06-25 18:07:56', '2021-06-25 18:07:56'),
(41, 5, 19, 1, 'first_name', 'test rrrrr', '2021-06-25 18:07:56', '2021-06-25 18:07:56'),
(42, 5, 20, 1, 'textarea_1623672935819', 'sdfgsfsfg', '2021-06-25 18:07:56', '2021-06-25 18:07:56'),
(43, 5, 21, 1, 'address', 'sdfgsdfgsdfg', '2021-06-25 18:07:56', '2021-06-25 18:07:56'),
(44, 6, 11, 1, 'status', 'active', '2021-06-25 18:18:12', '2021-06-25 18:18:12'),
(45, 6, 12, 1, 'date', '2021-06-25', '2021-06-25 18:18:12', '2021-06-25 18:18:12'),
(46, 6, 13, 1, 'file_1623672153075', '16246198920.jpg', '2021-06-25 18:18:12', '2021-06-25 18:18:12'),
(47, 6, 16, 1, 'number', '23423434', '2021-06-25 18:18:12', '2021-06-25 18:18:12'),
(48, 6, 17, 1, 'gender', 'male', '2021-06-25 18:18:12', '2021-06-25 18:18:12'),
(49, 6, 18, 1, 'country', 'option-2', '2021-06-25 18:18:12', '2021-06-25 18:18:12'),
(50, 6, 19, 1, 'first_name', 'test rrrrr', '2021-06-25 18:18:12', '2021-06-25 18:18:12'),
(51, 6, 20, 1, 'textarea_1623672935819', 'sdfgsfsfg', '2021-06-25 18:18:12', '2021-06-25 18:18:12'),
(52, 6, 21, 1, 'address', 'sdfgsdfgsdfg', '2021-06-25 18:18:12', '2021-06-25 18:18:12'),
(53, 7, 11, 1, 'status', 'active,inactive', '2021-06-25 19:23:03', '2021-06-25 19:23:03'),
(54, 7, 12, 1, 'date', '2021-06-26', '2021-06-25 19:23:03', '2021-06-25 19:23:03'),
(55, 7, 13, 1, 'file_1623672153075', '', '2021-06-25 19:23:03', '2021-06-25 19:23:03'),
(56, 7, 16, 1, 'number', '12123123123', '2021-06-25 19:23:03', '2021-06-25 19:23:03'),
(57, 7, 17, 1, 'gender', 'male', '2021-06-25 19:23:03', '2021-06-25 19:23:03'),
(58, 7, 18, 1, 'country', 'option-2', '2021-06-25 19:23:03', '2021-06-25 19:23:03'),
(59, 7, 19, 1, 'first_name', 'test rrrrr', '2021-06-25 19:23:03', '2021-06-25 19:23:03'),
(60, 7, 20, 1, 'textarea_1623672935819', 'ewrwer werwerwerwer', '2021-06-25 19:23:03', '2021-06-25 19:23:03'),
(61, 7, 21, 1, 'address', 'werwerwe rwerwer', '2021-06-25 19:23:03', '2021-06-25 19:23:03'),
(62, 8, 11, 1, 'status', 'active,inactive', '2021-06-25 19:25:15', '2021-06-25 19:25:15'),
(63, 8, 12, 1, 'date', '2021-06-26', '2021-06-25 19:25:15', '2021-06-25 19:25:15'),
(64, 8, 13, 1, 'file_1623672153075', '', '2021-06-25 19:25:15', '2021-06-25 19:25:15'),
(65, 8, 16, 1, 'number', '12123123123', '2021-06-25 19:25:15', '2021-06-25 19:25:15'),
(66, 8, 17, 1, 'gender', 'male', '2021-06-25 19:25:15', '2021-06-25 19:25:15'),
(67, 8, 18, 1, 'country', 'option-2', '2021-06-25 19:25:15', '2021-06-25 19:25:15'),
(68, 8, 19, 1, 'first_name', 'test rrrrr', '2021-06-25 19:25:15', '2021-06-25 19:25:15'),
(69, 8, 20, 1, 'textarea_1623672935819', 'ewrwer werwerwerwer', '2021-06-25 19:25:15', '2021-06-25 19:25:15'),
(70, 8, 21, 1, 'address', 'werwerwe rwerwer', '2021-06-25 19:25:15', '2021-06-25 19:25:15'),
(71, 9, 11, 1, 'status', 'active,inactive', '2021-06-25 19:35:08', '2021-06-25 19:35:08'),
(72, 9, 12, 1, 'date', '2021-06-25', '2021-06-25 19:35:08', '2021-06-25 19:35:08'),
(73, 9, 13, 1, 'file_1623672153075', '16246245080.jpg', '2021-06-25 19:35:08', '2021-06-25 19:35:08'),
(74, 9, 16, 1, 'number', '2345345345', '2021-06-25 19:35:08', '2021-06-25 19:35:08'),
(75, 9, 17, 1, 'gender', 'male', '2021-06-25 19:35:08', '2021-06-25 19:35:08'),
(76, 9, 18, 1, 'country', 'option-2', '2021-06-25 19:35:08', '2021-06-25 19:35:08'),
(77, 9, 19, 1, 'first_name', 'test rrrrr', '2021-06-25 19:35:08', '2021-06-25 19:35:08'),
(78, 9, 20, 1, 'textarea_1623672935819', 'dfdfgdfgdf', '2021-06-25 19:35:08', '2021-06-25 19:35:08'),
(79, 9, 21, 1, 'address', 'dfgdfgdfgdfg', '2021-06-25 19:35:08', '2021-06-25 19:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `template_form`
--

CREATE TABLE `template_form` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `label` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_required` int(11) NOT NULL DEFAULT 0 COMMENT ' 0 = InActive , 1 => Active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT ' 0 = InActive , 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_form`
--

INSERT INTO `template_form` (`id`, `contract_id`, `template_id`, `label`, `name`, `type`, `meta`, `is_required`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Status', 'status', 'checkbox-group', '{\"options\":[{\"label\":\"Active\",\"value\":\"active\",\"selected\":true},{\"label\":\"Inactive\",\"value\":\"inactive\"}]}', 1, 0, '2021-06-14 19:25:00', '2021-06-24 16:54:58'),
(2, 1, 1, 'Date', 'date', 'date', '{\"placeholder\":\"Please enter date\"}', 1, 0, '2021-06-14 19:25:00', '2021-06-24 16:54:58'),
(3, 1, 1, 'File Upload', 'file_1623672153075', 'file', '{\"placeholder\":\"Please enter date\"}', 0, 0, '2021-06-14 19:25:00', '2021-06-24 16:54:58'),
(4, 1, 1, 'Header name', NULL, 'header', '{\"subtype\":\"h1\"}', 0, 0, '2021-06-14 19:25:00', '2021-06-24 16:54:58'),
(5, 1, 1, 'Paragraph', NULL, 'paragraph', '{\"subtype\":\"p\"}', 0, 0, '2021-06-14 19:25:00', '2021-06-24 16:54:58'),
(6, 1, 1, 'Number', 'number', 'number', '{\"placeholder\":\"Please enter number\",\"min\":\"10\"}', 0, 0, '2021-06-14 19:25:00', '2021-06-24 16:54:58'),
(7, 1, 1, 'Gender', 'gender', 'radio-group', '{\"options\":[{\"label\":\"male\",\"value\":\"male\",\"selected\":true},{\"label\":\"female\",\"value\":\"female\"}]}', 1, 0, '2021-06-14 19:25:00', '2021-06-24 16:54:58'),
(8, 1, 1, 'Country', 'country', 'select', '{\"options\":[{\"label\":\"India\",\"value\":\"option-1\",\"selected\":true},{\"label\":\"Uk\",\"value\":\"option-2\"}],\"placeholder\":\"Please select country\"}', 1, 0, '2021-06-14 19:25:00', '2021-06-24 16:54:58'),
(9, 1, 1, 'first name', 'first_name', 'text', '{\"placeholder\":\"Please enter name\",\"maxlength\":\"150\",\"subtype\":\"text\"}', 1, 0, '2021-06-14 19:25:00', '2021-06-24 16:54:58'),
(10, 1, 1, 'Text Area', 'textarea_1623672935819', 'textarea', '{\"subtype\":\"textarea\"}', 0, 0, '2021-06-14 19:25:00', '2021-06-24 16:54:58'),
(11, 1, 1, 'Status', 'status', 'checkbox-group', '{\"options\":[{\"label\":\"Active\",\"value\":\"active\",\"selected\":true},{\"label\":\"Inactive\",\"value\":\"inactive\"}]}', 1, 1, '2021-06-24 16:54:58', '2021-06-24 16:54:58'),
(12, 1, 1, 'Date', 'date', 'date', '{\"placeholder\":\"Please enter date\"}', 1, 1, '2021-06-24 16:54:58', '2021-06-24 16:54:58'),
(13, 1, 1, 'File Upload', 'file_1623672153075', 'file', '{\"placeholder\":\"Please enter date\"}', 0, 1, '2021-06-24 16:54:58', '2021-06-24 16:54:58'),
(14, 1, 1, 'Header name', NULL, 'header', '{\"subtype\":\"h1\"}', 0, 1, '2021-06-24 16:54:58', '2021-06-24 16:54:58'),
(15, 1, 1, 'Paragraph', NULL, 'paragraph', '{\"subtype\":\"p\"}', 0, 1, '2021-06-24 16:54:58', '2021-06-24 16:54:58'),
(16, 1, 1, 'Number', 'number', 'number', '{\"placeholder\":\"Please enter number\",\"min\":\"10\"}', 0, 1, '2021-06-24 16:54:58', '2021-06-24 16:54:58'),
(17, 1, 1, 'Gender', 'gender', 'radio-group', '{\"options\":[{\"label\":\"male\",\"value\":\"male\",\"selected\":true},{\"label\":\"female\",\"value\":\"female\"}]}', 1, 1, '2021-06-24 16:54:58', '2021-06-24 16:54:58'),
(18, 1, 1, 'Country', 'country', 'select', '{\"options\":[{\"label\":\"India\",\"value\":\"option-1\",\"selected\":true},{\"label\":\"Uk\",\"value\":\"option-2\"}],\"placeholder\":\"Please select country\"}', 1, 1, '2021-06-24 16:54:58', '2021-06-24 16:54:58'),
(19, 1, 1, 'first name', 'first_name', 'text', '{\"placeholder\":\"Please enter name\",\"maxlength\":\"150\",\"subtype\":\"text\"}', 1, 1, '2021-06-24 16:54:58', '2021-06-24 16:54:58'),
(20, 1, 1, 'Text Area', 'textarea_1623672935819', 'textarea', '{\"subtype\":\"textarea\"}', 0, 1, '2021-06-24 16:54:58', '2021-06-24 16:54:58'),
(21, 1, 1, 'address', 'address', 'textarea', '{\"subtype\":\"textarea\"}', 0, 1, '2021-06-24 16:54:58', '2021-06-24 16:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `temporarily_user`
--

CREATE TABLE `temporarily_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temporarily_user`
--

INSERT INTO `temporarily_user` (`id`, `role_id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 2, 'ritesh.rana+6@spec-india.com', '$2y$10$5Ew5jhW8DnkEgJa9EWvfGuwTI0biJVQjvQx9RWjjiYuBc/qNKe8Ky', '2021-06-19 17:17:27', '2021-06-19 17:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `positions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT ' 0 = InActive , 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `title`, `name`, `image`, `positions`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'ritesh rana', '1623251244.png', 'software developer', 1, '2021-06-09 16:33:49', '2021-06-09 22:07:24'),
(3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'mehul patel', '1623251294.png', 'software developer', 1, '2021-06-09 22:08:14', '2021-06-09 22:08:14'),
(4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'miral pate;', '1623251363.png', 'software developer', 1, '2021-06-09 22:09:23', '2021-06-09 22:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `company_name`, `role_id`, `email`, `email_verified_at`, `password`, `address`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 1, 'admin@gmail.com', '2021-06-19 17:13:25', '$2y$10$fLvVTncwTKX9EGrTkNlv1uzlpNzIaIKJwskAnDFeTdc5rIjrZiPs2', 'ahmedabad', 1234567890, NULL, NULL, NULL),
(2, 'ritesh', 'spec-india', 2, 'ritesh.rana+6@spec-india.com', '2021-06-25 12:56:54', '$2y$10$5Ew5jhW8DnkEgJa9EWvfGuwTI0biJVQjvQx9RWjjiYuBc/qNKe8Ky', 'ahmedabad', 123445678901, NULL, '2021-06-19 17:17:59', '2021-06-25 19:56:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_data`
--
ALTER TABLE `contract_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_contract`
--
ALTER TABLE `send_contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_member`
--
ALTER TABLE `team_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_field_data`
--
ALTER TABLE `template_field_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_form`
--
ALTER TABLE `template_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporarily_user`
--
ALTER TABLE `temporarily_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
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
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contract_data`
--
ALTER TABLE `contract_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `send_contract`
--
ALTER TABLE `send_contract`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_member`
--
ALTER TABLE `team_member`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_field_data`
--
ALTER TABLE `template_field_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `template_form`
--
ALTER TABLE `template_form`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `temporarily_user`
--
ALTER TABLE `temporarily_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
