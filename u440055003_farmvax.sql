-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 26, 2025 at 12:24 AM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u440055003_farmvax`
--

-- --------------------------------------------------------

--
-- Table structure for table `alert_preferences`
--

CREATE TABLE `alert_preferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `farm_record_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sms_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `email_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `whatsapp_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `phone_call_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `push_notification_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `primary_phone` varchar(255) DEFAULT NULL,
  `secondary_phone` varchar(255) DEFAULT NULL,
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `primary_email` varchar(255) DEFAULT NULL,
  `secondary_email` varchar(255) DEFAULT NULL,
  `preferred_method` enum('sms','email','whatsapp','phone','push') NOT NULL DEFAULT 'sms',
  `backup_method` enum('sms','email','whatsapp','phone','push','none') NOT NULL DEFAULT 'none',
  `outbreak_alerts` tinyint(1) NOT NULL DEFAULT 1,
  `outbreak_sms` tinyint(1) NOT NULL DEFAULT 1,
  `outbreak_email` tinyint(1) NOT NULL DEFAULT 0,
  `outbreak_whatsapp` tinyint(1) NOT NULL DEFAULT 0,
  `outbreak_urgency` enum('immediate','within_hour','within_day') NOT NULL DEFAULT 'immediate',
  `outbreak_radius_km` int(11) NOT NULL DEFAULT 50,
  `outbreak_diseases_interest` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`outbreak_diseases_interest`)),
  `vaccine_alerts` tinyint(1) NOT NULL DEFAULT 1,
  `vaccine_sms` tinyint(1) NOT NULL DEFAULT 1,
  `vaccine_email` tinyint(1) NOT NULL DEFAULT 0,
  `vaccine_whatsapp` tinyint(1) NOT NULL DEFAULT 0,
  `vaccine_radius_km` int(11) NOT NULL DEFAULT 30,
  `vaccine_types_interest` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`vaccine_types_interest`)),
  `campaign_alerts` tinyint(1) NOT NULL DEFAULT 1,
  `campaign_sms` tinyint(1) NOT NULL DEFAULT 0,
  `campaign_email` tinyint(1) NOT NULL DEFAULT 1,
  `campaign_whatsapp` tinyint(1) NOT NULL DEFAULT 0,
  `campaign_topics_interest` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`campaign_topics_interest`)),
  `campaign_formats` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`campaign_formats`)),
  `announcement_alerts` tinyint(1) NOT NULL DEFAULT 1,
  `announcement_sms` tinyint(1) NOT NULL DEFAULT 1,
  `announcement_email` tinyint(1) NOT NULL DEFAULT 0,
  `announcement_whatsapp` tinyint(1) NOT NULL DEFAULT 0,
  `announcement_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`announcement_types`)),
  `vaccination_reminder` tinyint(1) NOT NULL DEFAULT 1,
  `appointment_reminder` tinyint(1) NOT NULL DEFAULT 1,
  `health_checkup_reminder` tinyint(1) NOT NULL DEFAULT 1,
  `service_update` tinyint(1) NOT NULL DEFAULT 1,
  `weather_alerts` tinyint(1) NOT NULL DEFAULT 0,
  `price_alerts` tinyint(1) NOT NULL DEFAULT 0,
  `policy_updates` tinyint(1) NOT NULL DEFAULT 1,
  `quiet_hours_start` time DEFAULT NULL,
  `quiet_hours_end` time DEFAULT NULL,
  `preferred_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`preferred_days`)),
  `weekend_alerts` tinyint(1) NOT NULL DEFAULT 1,
  `night_alerts` tinyint(1) NOT NULL DEFAULT 0,
  `alert_frequency` enum('real_time','hourly','daily','weekly') NOT NULL DEFAULT 'real_time',
  `max_daily_alerts` int(11) NOT NULL DEFAULT 10,
  `digest_mode` tinyint(1) NOT NULL DEFAULT 0,
  `digest_frequency` enum('daily','weekly','monthly') DEFAULT NULL,
  `preferred_language` enum('english','french','swahili','hausa','fulfulde','yoruba','igbo','pidgin','other') NOT NULL DEFAULT 'english',
  `other_language` varchar(255) DEFAULT NULL,
  `alert_location_village` varchar(255) DEFAULT NULL,
  `alert_location_lga` varchar(255) DEFAULT NULL,
  `alert_location_state` varchar(255) DEFAULT NULL,
  `additional_locations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional_locations`)),
  `detailed_alerts` tinyint(1) NOT NULL DEFAULT 0,
  `include_links` tinyint(1) NOT NULL DEFAULT 1,
  `include_images` tinyint(1) NOT NULL DEFAULT 0,
  `actionable_only` tinyint(1) NOT NULL DEFAULT 0,
  `total_alerts_received` int(11) NOT NULL DEFAULT 0,
  `last_alert_sent_at` timestamp NULL DEFAULT NULL,
  `alerts_this_month` int(11) NOT NULL DEFAULT 0,
  `last_digest_sent` date DEFAULT NULL,
  `is_subscribed` tinyint(1) NOT NULL DEFAULT 1,
  `subscribed_at` timestamp NULL DEFAULT NULL,
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  `unsubscribe_reason` text DEFAULT NULL,
  `opt_out_marketing` tinyint(1) NOT NULL DEFAULT 0,
  `opt_out_promotional` tinyint(1) NOT NULL DEFAULT 0,
  `opt_out_surveys` tinyint(1) NOT NULL DEFAULT 0,
  `emergency_override` tinyint(1) NOT NULL DEFAULT 1,
  `device_tokens` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`device_tokens`)),
  `device_platform` varchar(255) DEFAULT NULL,
  `test_alerts_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `last_test_alert_at` timestamp NULL DEFAULT NULL,
  `phone_verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `custom_preferences` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_preferences`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `animal_health_professionals`
--

CREATE TABLE `animal_health_professionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `professional_type` enum('veterinarian','paraveterinarian','community_animal_health_worker','others') NOT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `experience_years` int(11) NOT NULL DEFAULT 0,
  `specialization` varchar(255) DEFAULT NULL,
  `assigned_territory` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `application_notes` text DEFAULT NULL,
  `verification_documents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`verification_documents`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `animal_health_professionals`
--

INSERT INTO `animal_health_professionals` (`id`, `user_id`, `professional_type`, `license_number`, `organization`, `experience_years`, `specialization`, `assigned_territory`, `contact_phone`, `contact_email`, `approval_status`, `approved_by`, `approved_at`, `rejection_reason`, `submitted_at`, `application_notes`, `verification_documents`, `created_at`, `updated_at`) VALUES
(1, 5, 'veterinarian', 'VET-2024-001', 'Lagos Veterinary Clinic', 10, 'Livestock Health', 'Lagos State', NULL, NULL, 'approved', 1, '2025-12-14 22:00:46', NULL, '2025-12-09 22:00:46', NULL, NULL, '2025-12-14 22:00:46', '2025-12-14 22:00:46'),
(2, 6, 'veterinarian', 'VET-2024-002', 'Abuja Animal Health Center', 5, 'Farm Advisory', 'FCT Abuja', NULL, NULL, 'approved', 1, '2025-12-17 10:34:27', NULL, '2025-12-12 22:00:46', 'Looking forward to helping farmers in my community.', NULL, '2025-12-14 22:00:46', '2025-12-17 10:34:27'),
(3, 8, 'paraveterinarian', '3322', 'Skillscore IT Solutions', 1, NULL, NULL, '+2348119281144', 'tijani@farmvax.com', 'approved', 1, '2025-12-14 23:04:38', NULL, '2025-12-14 22:44:48', NULL, NULL, '2025-12-14 22:44:48', '2025-12-14 23:04:38'),
(4, 11, 'veterinarian', NULL, 'Farm Alert', 0, 'Cattle', 'FCT', '+2348110837426', 'rodiyahadegoke@gmail.com', 'approved', 1, '2025-12-17 10:33:53', NULL, '2025-12-16 07:07:19', 'I\'m interested in being a part of the team', NULL, '2025-12-16 07:07:19', '2025-12-17 10:33:53'),
(5, 12, 'veterinarian', '10040', 'Farm Alert', 4, 'All', 'Abuja', '08104127121', 'nancy.eni-otu@farmalert.com.ng', 'approved', 1, '2025-12-17 10:33:44', NULL, '2025-12-16 07:08:54', 'To connect with farmers and also get updates', NULL, '2025-12-16 07:08:54', '2025-12-17 10:33:44'),
(6, 15, 'veterinarian', '11512', 'Farm Alert', 1, 'Mixed', 'Abuja Municipal', '08107827497', 'imaniojay@gmail.com', 'approved', 1, '2025-12-17 10:33:35', NULL, '2025-12-16 08:55:05', NULL, NULL, '2025-12-16 08:55:05', '2025-12-17 10:33:35'),
(7, 16, 'veterinarian', '3796', 'NVMA/GALVmed', 23, 'Poultry & Ruminant', 'Oyo & Abuja', '+2348037779060', 'survival_moe@yahoo.com', 'approved', 1, '2025-12-17 10:33:26', NULL, '2025-12-16 10:08:23', 'Data collation, management & deployment is the assured way to growth & development', NULL, '2025-12-16 10:08:23', '2025-12-17 10:33:26'),
(8, 18, 'veterinarian', '11919', 'Bauchi State', 1, 'Large Animal veterinarian', 'Misau-Azare', '08166817415', 'ibrahimadamudvm@gmail.com', 'approved', 1, '2025-12-17 10:33:14', NULL, '2025-12-16 11:31:24', NULL, NULL, '2025-12-16 11:31:24', '2025-12-17 10:33:14'),
(9, 19, 'veterinarian', '4982', 'Diamond Integrated Animal Farms', 17, 'Poultry and Small Animals', 'AMAC,Jos', '+234 805 627 5434', 'jinedu72@gmail.com', 'approved', 1, '2025-12-17 10:33:05', NULL, '2025-12-16 11:32:21', NULL, NULL, '2025-12-16 11:32:21', '2025-12-17 10:33:05'),
(10, 20, 'veterinarian', '11518', 'Lionheart petstore', 1, 'Small Animal practice', 'FCT', '+2349020994680', 'saadmuidin@gmail.com', 'approved', 1, '2025-12-17 10:32:54', NULL, '2025-12-16 11:33:08', 'I\'m an passionate vet with health of animals and humans at heart. I want to assist in gathering real life reliable data from clients and farmers to promote health and wellness of everyone.', NULL, '2025-12-16 11:33:08', '2025-12-17 10:32:54'),
(11, 21, 'veterinarian', '8786', 'Ministry of Livestock Development', 7, 'Ruminants,Pets and Poultry', 'Bauchi', '07066763892', 'yugurai5@gmail.com', 'approved', 1, '2025-12-17 10:32:44', NULL, '2025-12-16 11:34:36', 'Am living in a remote area and their animals suffers from certain preventable diseases and being part of this program I think will help reduce morbidity and mortality', NULL, '2025-12-16 11:34:36', '2025-12-17 10:32:44'),
(12, 22, 'veterinarian', '10507', 'Chi Farms Limited', 2, 'Poultry', NULL, '+2349036063156', 'solomonokongwu1@gmail.com', 'approved', 1, '2025-12-17 10:32:02', NULL, '2025-12-16 11:36:50', NULL, NULL, '2025-12-16 11:36:50', '2025-12-17 10:32:02'),
(13, 23, 'veterinarian', '9882', 'Bauchi State Ministry of Livestock Development', 4, 'Ruminant', 'Bauchi', '+2348063930361', 'bilalchinade@gmail.com', 'approved', 1, '2025-12-17 10:32:37', NULL, '2025-12-16 11:38:41', 'I am a Veterinarian, currently pursuing my MSc in Animal Genetics and Breeding at  Bogor Institute of Agriculture, Indonesia. I wanted to join to be part of the quality data recording and improvement process.', NULL, '2025-12-16 11:38:41', '2025-12-17 10:32:37'),
(14, 24, 'veterinarian', '9500', 'Ministry of Livestock and Fisheries Development Sokoto', 5, 'Large Animal and Poultry', 'Bodinga Local government', '+2348030454598', 'muhammadnurullahee@gmail.com', 'approved', 1, '2025-12-17 10:32:28', NULL, '2025-12-16 11:38:53', 'I worked as Livestock investigator with Emsaar Veterinary Medical and Diagnostics Services and now Veterinary Officer Bodinga Veterinary Clinic', NULL, '2025-12-16 11:38:53', '2025-12-17 10:32:28'),
(15, 26, 'paraveterinarian', NULL, NULL, 5, 'Ruminant and poultry', 'Oyo state', '+2348158921659', 'muhideenolayode@gmail.com', 'approved', 1, '2025-12-17 10:32:18', NULL, '2025-12-16 12:34:43', NULL, NULL, '2025-12-16 12:34:43', '2025-12-17 10:32:18'),
(16, 27, 'veterinarian', 'Temporary licence given', 'Al-mansoor vet care-agro enterprises', 3, 'Sheep and goat', 'Kaduna', '+2348062246974', 'mansurnuhu55@gmail.com', 'approved', 1, '2025-12-17 10:21:38', NULL, '2025-12-16 14:16:16', 'Faculty of Veterinary Medicine, Ahmadu Bello University (ABU), Zaria, with a strong passion for large animal practice. Over the years, I have actively attached myself to various veterinary clinics to acquire hands-on clinical skills aligned with my goal of becoming a competent clinician dedicated to improving animal health and welfare.\r\n\r\nIn addition to formal training, I have occasionally attended to clinical cases involving family members and friends, which further strengthened my practical exposure and confidence. My skills have continued to improve during my current internship at Saint Jerome Veterinary Clinic, Zaria, where I can confidently clerk cases, administer drugs (both injectable and enteral), carry out vaccination and deworming protocols, and assist in surgical procedures such as caesarean section, ruminotomy, and ear cropping.\r\n\r\nI have a strong interest in farm alert and field-based veterinary services, as I am eager to learn, collaborate, and work with like-minded professionals to enhance animal health, welfare, and productivity.', NULL, '2025-12-16 14:16:16', '2025-12-17 10:21:38'),
(17, 29, 'community_animal_health_worker', '12121', 'Farmvax', 7, 'Poultry', 'Lagos', '+2348033899217', 'bulama10906@gmail.com', 'approved', 1, '2025-12-17 09:29:46', NULL, '2025-12-16 22:33:38', NULL, NULL, '2025-12-16 22:33:38', '2025-12-17 09:29:46'),
(18, 30, 'veterinarian', '10842', 'World Health Organization', 6, 'Epidemiology', 'Abuja/FCT', '+2347061234157', 'abudeinkechicho@gmail.com', 'approved', 1, '2025-12-17 13:53:05', NULL, '2025-12-17 11:15:17', 'I am a veterinarian passionate in food security, food safety, one health and disease prevention.', NULL, '2025-12-17 11:15:17', '2025-12-17 13:53:05'),
(19, 31, 'veterinarian', '3476', 'Joseph Sarwuan Tarka University, Makurdi, Benue State, Nigeria', 25, 'Cattle', 'Makurdi, Benue State, Nigeria', '+2348035958939', 'drbenonoja@gmail.com', 'approved', 1, '2025-12-17 13:53:21', NULL, '2025-12-17 11:28:43', 'I am currently running a PhD Program in Ruminant (Cattle, Sheep, Goat, Buffalo, Deer, Antelope & Illama) Bacterial Medicine at Faculty of Veterinary Medicine, Universiti Putra Malaysia. I would love to join FarmVax to Contribute my Quota to Livestock Improvement in Nigeria. I am also a Lecturer in the College of Veterinary Medicine, Joseph Sarwuan Tarka University, Makurdi, Benue State, Nigeria', NULL, '2025-12-17 11:28:43', '2025-12-17 13:53:21'),
(20, 32, 'veterinarian', '6370', 'NE-MO VETERINARY SERVICES', 15, 'All animal species', 'DELTA', '08142667294', 'nemoveterinary@gmail.com', 'approved', 1, '2025-12-22 13:22:06', NULL, '2025-12-19 12:51:23', 'I need additional resources, which are in line with present day technological advances, to better improve service delivery to clients', NULL, '2025-12-19 12:51:23', '2025-12-22 13:22:06'),
(21, 34, 'veterinarian', NULL, 'Kano state ministry of livestock development', 2, 'Small and large ruminant, poultry', 'Kano', '+2349169042784', 'ahmadabdulkadir520@gmail.com', 'approved', 1, '2025-12-22 13:24:26', NULL, '2025-12-19 13:03:04', NULL, NULL, '2025-12-19 13:03:04', '2025-12-22 13:24:26'),
(22, 35, 'paraveterinarian', 'VPP/REG/3282', 'Ministry of livestock Development Yobe State government', 13, 'Large ruminant(Cattle, Sheep and goats)', 'Damaturu central', '08030716081', 'isamallamkbn@gmail.com', 'approved', 1, '2025-12-22 13:27:04', NULL, '2025-12-19 13:05:31', 'I have finished my Nation diploma Animal Health and Production 2012, HND Animal Health and Technology 2015 and PGD Animal Health and Production 2023. Since 2013 I started practicing veterinary services ( treatment of sick Animals, routing treatment, disease investigation and control). Further more I continue working with Zone 1 Veterinary clinic Damaturu Yobe State since 2018 to date. \r\n  I am interested in this because I have an experience little bit so I want to expand and deliver to my community', NULL, '2025-12-19 13:05:31', '2025-12-22 13:27:04'),
(23, 41, 'veterinarian', '11857', 'Ministry of Animal Health Husbandry and Fisheries', 1, 'Cattle, Sheep and Goats, and Poultry', 'Bunza, Kebbi State', '+2348062732554', 'kabirumuhammad269@gmail.com', 'approved', 1, '2025-12-22 13:26:56', NULL, '2025-12-19 14:11:02', 'I am a graduate of a Veterinary Medicine with hands-on experience in livestock and poultry management\r\nI want to join Farm Alert because it aligns with my passion for early disease reporting, farmer education, and preventive veterinary care. I believe timely alerts and accurate farm information can help farmers make better decisions, reduce losses, and improve productivity. Being part of Farm Alert will allow me to contribute my veterinary knowledge while learning more about data-driven agriculture and community-based farming', NULL, '2025-12-19 14:11:02', '2025-12-22 13:26:56'),
(24, 42, 'veterinarian', 'VET/ 10123', 'Ministry for livestock development and fisheries', 4, 'Small and large animals', 'Kebbi, Sokoto, zamfara', '7085656923', 'ambursadvm50@gmail.com', 'approved', 1, '2025-12-22 13:26:42', NULL, '2025-12-19 14:14:58', 'My name is Dr. Salim Umar Ambursa, DVM, a licensed veterinarian from Nigeria with clinical experience in small and large animals medicine, soft-tissue surgery, diagnostics, emergency care, and preventive veterinary practice.', NULL, '2025-12-19 14:14:58', '2025-12-22 13:26:42'),
(25, 43, 'veterinarian', 'VCN 1592', 'Private practice', 30, 'Dairy/Small ruminants Consultant', 'Katsina State', '+2347034728933', 'dandaura2015@gmail.com', 'approved', 1, '2025-12-22 13:26:30', NULL, '2025-12-19 14:26:35', NULL, NULL, '2025-12-19 14:26:35', '2025-12-22 13:26:30'),
(26, 45, 'paraveterinarian', NULL, NULL, 2, NULL, NULL, '08073145325', 'Zakariyaidris6742@gmail.com', 'approved', 1, '2025-12-22 13:26:20', NULL, '2025-12-19 14:55:26', NULL, NULL, '2025-12-19 14:55:26', '2025-12-22 13:26:20'),
(27, 47, 'community_animal_health_worker', '7/7/2015', 'Ministry of Livestock Kano', 10, 'Animal Health Technology', 'Rijiyar lemon Fagge LGA Kano', '09034246474', 'iukadawa@gmail.com', 'approved', 1, '2025-12-22 13:26:09', NULL, '2025-12-19 15:44:00', 'I\'m Good on Poultry, Fish farming,  \r\nCattle and Crops Production', NULL, '2025-12-19 15:44:00', '2025-12-22 13:26:09'),
(28, 48, 'veterinarian', 'VCN:8390', '1. UniqueVet and Agropharm LTD 2. College of Agriculture, Science and Technology Lafia', 6, 'Ruminants and poultry', 'Nasarawa state and Abuja', '+2347040161827', 'dvmaaladan@gmail.com', 'approved', 1, '2025-12-22 13:25:59', NULL, '2025-12-19 16:23:03', 'I\'m a Veterinarian with 6 years of clinical practice experience mostly in Ruminants and poultry. But I do attended to other livestock occasionally. I want to join this noble team in order to keep to my professional obligation and to connect to more farmers in my state, other part of Nigeria and the entire world.', NULL, '2025-12-19 16:23:03', '2025-12-22 13:25:59'),
(29, 50, 'veterinarian', NULL, 'Ministry of livestock and fisheries development sokoto state', 2, 'Ruminant medicine', 'Sokoto state', '09034864839', 'karibubashir089@gmail.com', 'approved', 1, '2025-12-22 13:25:46', NULL, '2025-12-19 17:14:49', 'I am Bashir karibu gatawa, a dedicated veterinary professional with a deep-rooted passion for animal health and welfare. With 2years of experience in veterinary medicine, I have developed a strong foundation in clinical practices and a commitment to advancing veterinary care. \r\nI earned my degree in Veterinary Medicine from 2016 to 2023, where I gained essential knowledge in animal anatomy, physiology, and disease management. During my time at Aliyu Jodi veterinary clinic sokoto, I honed my skills in diagnosing and treating various conditions, working collaboratively with a talented team of veterinarians. I actively participated in surgeries and was responsible for client education, ensuring pet owners were informed and confident in their pets\' care. \r\nAdditionally, I do a research project on prevalence of giardia parasite in dogs in Aliyu jodi veterinary clinic and Usmanu danfodiyo university veterinary teaching hospital sokoto, which allowed me to explore the prevalence of giardia parasite is more in Aliyu jodi veterinary clinic than that of usmanu danfodiyo university veterinary teaching hospital sokoto, enhancing my understanding of risk factors associated with the prevalence of the parasite. I have also participated in workshops focused on artificial insemination conducted by the sokoto state veterinary doctors in collaboration with the Indonesian countries, which further enriched my professional development.\r\n\r\nI am particularly drawn to FamVax because of its commitment to  revolutionizing the management of animal health and vaccinations for veterinarians, livestock farmers, and pet owners. The innovative approach to veterinary medicine and emphasis on community outreach resonate deeply with my own aspirations. Being part of FamVax would not only provide an opportunity for personal and professional growth but also allow me to play a role in advancing veterinary practices that prioritize animal health and community well-being.\r\nI am excited about the possibility of joining FamVax and contributing to its mission. Thank you for considering my application.', NULL, '2025-12-19 17:14:49', '2025-12-22 13:25:46'),
(30, 51, 'veterinarian', 'Vet 10642', 'Clinic', 10, 'Cattle poultry', 'Bauchi', '+2348066783177', 'abuabdulhaleem66@gmail.com', 'approved', 1, '2025-12-22 13:25:32', NULL, '2025-12-19 17:51:23', 'I am a professional veterinary surgeon', NULL, '2025-12-19 17:51:23', '2025-12-22 13:25:32'),
(31, 53, 'veterinarian', NULL, NULL, 0, NULL, NULL, '+2348097128868', 'azeezatfasasi3@gmail.com', 'approved', 1, '2025-12-22 13:22:24', NULL, '2025-12-19 18:36:30', NULL, NULL, '2025-12-19 18:36:30', '2025-12-22 13:22:24'),
(32, 55, 'veterinarian', '11462', 'Ministry of agriculture and food security, Osun state', 2, 'Cattle,swine, poultry', 'Abuja', '+2348061129029', 'ibrahim2000aliyu@gmail.com', 'approved', 1, '2025-12-22 13:25:20', NULL, '2025-12-19 21:54:53', NULL, NULL, '2025-12-19 21:54:53', '2025-12-22 13:25:20'),
(33, 56, 'veterinarian', NULL, 'Usmanu Danfodiyo University, Sokoto', 20, 'Quantitative Epidemiology and Animal Health', 'Sokoto', '+2348065489917', 'shittuaminu38@gmail.com', 'approved', 1, '2025-12-22 13:25:12', NULL, '2025-12-19 21:59:19', NULL, NULL, '2025-12-19 21:59:19', '2025-12-22 13:25:12'),
(34, 57, 'veterinarian', '11949', 'Barnex Veterinary Hospital', 2, 'Large animal, small animal, poultry, fishery.', 'Adamawa state', '+2349022925891', 'Jesseharun68@gmail.com', 'approved', 1, '2025-12-22 13:25:00', NULL, '2025-12-19 23:26:12', NULL, NULL, '2025-12-19 23:26:12', '2025-12-22 13:25:00'),
(35, 60, 'veterinarian', NULL, 'Bauchi State ministry of livestock development', 0, 'Small ruminants and poultry', 'Bauchi, jigawa, Gombe', '+2348138505739', 'yahayamousadvm@gmail.com', 'approved', 1, '2025-12-22 13:24:44', NULL, '2025-12-20 03:25:55', NULL, NULL, '2025-12-20 03:25:55', '2025-12-22 13:24:44'),
(36, 63, 'veterinarian', '12009', 'Moade value farm', 2, 'Livestock', 'Lagos', '07060679493', 'sasrabiat212@gmail.com', 'approved', 1, '2025-12-22 13:24:11', NULL, '2025-12-20 08:31:30', NULL, NULL, '2025-12-20 08:31:30', '2025-12-22 13:24:11'),
(37, 64, 'veterinarian', '10845', 'Private veterinarian', 3, 'Small animal', 'Delta state', '+2348035639338', 'amahamogema@gmail.com', 'approved', 1, '2025-12-22 13:23:29', NULL, '2025-12-20 08:36:42', NULL, NULL, '2025-12-20 08:36:42', '2025-12-22 13:23:29'),
(38, 65, 'veterinarian', 'VCN/ 8040', 'Ministry of Livestock Development, Bauchi state', 9, 'Food animal and Poultry Veterinarian', 'Azare, Bauchi state', '08060029532', 'drasgiade07@gmail.com', 'approved', 1, '2025-12-22 13:23:12', NULL, '2025-12-20 09:40:31', 'I have 9years experience in clinical and ambulatory veterinary delivery. Although, I am a general practitioner but I have special interest in poultry practice too.\r\nI want to join FarmVax in order to increase my networking with veterinarians and clients seeking for my services.', NULL, '2025-12-20 09:40:31', '2025-12-22 13:23:12'),
(39, 70, 'veterinarian', NULL, 'Faculty of veterinary medicine ABU ZARIA', 3, 'PUBLIC HEALTH AND PREVENTIVE MEDICINE', 'KADUNA', '+2348129137208', 'yushauu411@gmail.com', 'approved', 1, '2025-12-22 13:20:10', NULL, '2025-12-21 06:19:21', 'experience in breeding of animals but large and small animals, manufacturing of pasture and feeds to them using agricultural products and a certain chemical', NULL, '2025-12-21 06:19:21', '2025-12-22 13:20:10'),
(40, 74, 'veterinarian', NULL, NULL, 0, NULL, NULL, '09038140619', 'khadeemeedey@gmail.com', 'approved', 1, '2025-12-22 18:50:33', NULL, '2025-12-22 16:39:07', NULL, NULL, '2025-12-22 16:39:07', '2025-12-22 18:50:33'),
(41, 79, 'veterinarian', NULL, NULL, 0, 'Cattle, poultry', 'Lagos', '07059552833', 'ifeanyimikeallison1@gmail.com', 'approved', 1, '2025-12-23 17:48:45', NULL, '2025-12-23 17:35:02', 'I havent had any experience yey but would love to learn and have an experience as a new graduating vet', NULL, '2025-12-23 17:35:02', '2025-12-23 17:48:45'),
(42, 120, 'veterinarian', NULL, 'University of Ilorin', 0, 'Poultry', 'Ilorin/Lagos', '+2349065165097', 'sakariyahabdulhazeem@gmail.com', 'pending', NULL, NULL, NULL, '2025-12-24 11:52:36', 'To gain experience, insights and connect with like minded fellows', NULL, '2025-12-24 11:52:36', '2025-12-24 11:52:36'),
(43, 137, 'veterinarian', 'VCNID 12115', 'Ministry of Agriculture', 3, 'Cats, Dog, Sheep, Goats', 'Kano', '+2348147294619', 'pojogbede@gmail.com', 'approved', 1, '2025-12-25 17:54:22', NULL, '2025-12-24 23:33:50', 'I’m a veterinary doctor with a strong interest in public health, leadership, and community development. I have served in both clinical and public health capacities, contributing to improved animal welfare, food safety, and antimicrobial resistance awareness through veterinary practice and outreach programs. Currently in my service year I have volunteered to educate ND, HND students undergoing SIWES training, farmers on animal welfare, responsible drug use, and the public health dangers of antimicrobial misuse.', NULL, '2025-12-24 23:33:50', '2025-12-25 17:54:22'),
(44, 141, 'veterinarian', '5044', 'Farm Alert Ltd', 17, NULL, 'FCT', '08168008052', 'kayodementoring@gmail.com', 'approved', 1, '2025-12-25 11:53:28', NULL, '2025-12-25 10:52:31', NULL, NULL, '2025-12-25 10:52:31', '2025-12-25 11:53:28'),
(45, 143, 'veterinarian', '11119', 'FurryPaws Veterinary Healthcare', 2, 'Dogs, cats and poultry', 'Abuja municipal city', '+2348102097767', 'asikaaustine@gmail.com', 'pending', NULL, NULL, NULL, '2025-12-25 21:18:59', 'I have worked with small animals/pets and poultry farmers for a while and with farmvax, we can do more for the animal health sector', NULL, '2025-12-25 21:18:59', '2025-12-25 21:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('farmvax-cache-abduljabbardaudaabdullahi001@gmail.com|105.112.206.2', 'i:1;', 1766191059),
('farmvax-cache-abduljabbardaudaabdullahi001@gmail.com|105.112.206.2:timer', 'i:1766191059;', 1766191059),
('farmvax-cache-abudeinkechicho@gmail.com|102.91.104.63', 'i:1;', 1765969941),
('farmvax-cache-abudeinkechicho@gmail.com|102.91.104.63:timer', 'i:1765969941;', 1765969941),
('farmvax-cache-admin@farmalert.com.ng|102.91.102.3', 'i:1;', 1766663516),
('farmvax-cache-admin@farmalert.com.ng|102.91.102.3:timer', 'i:1766663516;', 1766663516);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_collectors`
--

CREATE TABLE `data_collectors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `experience_years` int(11) NOT NULL DEFAULT 0,
  `assigned_territory` varchar(255) DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `application_notes` text DEFAULT NULL,
  `verification_documents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`verification_documents`)),
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_collector_profiles`
--

CREATE TABLE `data_collector_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `reason_for_applying` text NOT NULL,
  `experience` text DEFAULT NULL,
  `education_level` varchar(255) DEFAULT NULL,
  `id_card_type` varchar(255) DEFAULT NULL,
  `id_card_number` varchar(255) DEFAULT NULL,
  `id_card_document` varchar(255) DEFAULT NULL,
  `certificates` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`certificates`)),
  `professional_certification` varchar(255) DEFAULT NULL,
  `assigned_territory` varchar(255) DEFAULT NULL,
  `coverage_area` varchar(255) DEFAULT NULL,
  `work_regions` text DEFAULT NULL,
  `verification_document` varchar(255) DEFAULT NULL,
  `reference_name` varchar(255) DEFAULT NULL,
  `reference_phone` varchar(255) DEFAULT NULL,
  `reference_email` varchar(255) DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected','under_review') NOT NULL DEFAULT 'pending',
  `rejection_reason` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `total_submissions` int(11) NOT NULL DEFAULT 0,
  `approved_submissions` int(11) NOT NULL DEFAULT 0,
  `accuracy_rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `last_submission_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `farmer_enrollments`
--

CREATE TABLE `farmer_enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farmer_id` bigint(20) UNSIGNED NOT NULL,
  `enrolled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `enrollment_method` enum('self','volunteer','professional','admin') NOT NULL DEFAULT 'self',
  `location` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmer_enrollments`
--

INSERT INTO `farmer_enrollments` (`id`, `farmer_id`, `enrolled_by`, `enrollment_method`, `location`, `notes`, `created_at`, `updated_at`) VALUES
(1, 9, 7, 'volunteer', 'No 22Oba Akran Avenue Ikeja, LA NG\r\nOba Akran Avenue', 'Enrolled by volunteer: Alice Volunteer', '2025-12-15 05:00:10', '2025-12-15 05:00:10'),
(2, 10, NULL, 'self', 'No 22Oba Akran Avenue Ikeja, LA NG\r\nOba Akran Avenue', 'Self-registered', '2025-12-16 05:58:52', '2025-12-16 05:58:52'),
(3, 13, NULL, 'self', '29. Adegbite street, Irepodun, Agbowo, Ibadan, Oyo state, Nigeria', 'Self-registered', '2025-12-16 07:12:25', '2025-12-16 07:12:25'),
(4, 14, NULL, 'self', 'Kubwa Bwari LGA', 'Self-registered', '2025-12-16 08:49:43', '2025-12-16 08:49:43'),
(5, 17, NULL, 'self', 'Babangida Aliyu crescent Life camp Abuja 16\r\nBabangida Aliyu crescent Life camp Abuja 16', 'Self-registered', '2025-12-16 10:54:23', '2025-12-16 10:54:23'),
(6, 25, NULL, 'self', 'Damaturu yobe state', 'Self-registered', '2025-12-16 11:41:48', '2025-12-16 11:41:48'),
(7, 37, NULL, 'self', 'Bwari', 'Self-registered', '2025-12-19 13:17:39', '2025-12-19 13:17:39'),
(8, 38, NULL, 'self', 'Tofa', 'Self-registered', '2025-12-19 13:18:43', '2025-12-19 13:18:43'),
(9, 40, NULL, 'self', 'Iwaro town,ipetumodu,ife north, osun state', 'Self-registered', '2025-12-19 14:04:23', '2025-12-19 14:04:23'),
(10, 44, NULL, 'self', 'Opposite AA Rano gas station Ombi 1 Lafia', 'Self-registered', '2025-12-19 14:53:22', '2025-12-19 14:53:22'),
(11, 49, NULL, 'self', 'Gafan cikin gari along Zaria road\r\nKANO Nigeria', 'Self-registered', '2025-12-19 16:40:56', '2025-12-19 16:40:56'),
(12, 58, NULL, 'self', 'Qasarawa farms, Wamakko LGA, Sokoto State', 'Self-registered', '2025-12-20 00:39:47', '2025-12-20 00:39:47'),
(13, 62, NULL, 'self', 'Maikunkele, Bosso Local Government area, Minna, Niger State', 'Self-registered', '2025-12-20 06:35:43', '2025-12-20 06:35:43'),
(14, 69, NULL, 'self', 'Bele, soba, kaduna', 'Self-registered', '2025-12-21 05:26:52', '2025-12-21 05:26:52'),
(15, 72, NULL, 'self', 'Kisahip, Bassa local government area, plateau state', 'Self-registered', '2025-12-21 12:00:08', '2025-12-21 12:00:08'),
(16, 73, NULL, 'self', 'W11 Dogon Bauchi Sabon Gari Zaria Kaduna State', 'Self-registered', '2025-12-22 15:21:00', '2025-12-22 15:21:00'),
(17, 75, NULL, 'self', '121C Tudun Wada, Dauda Alhamdu Street', 'Self-registered', '2025-12-22 21:38:53', '2025-12-22 21:38:53'),
(18, 89, NULL, 'self', 'Jushin waje sabon gari zaria kaduna state Nigeria', 'Self-registered', '2025-12-23 18:06:28', '2025-12-23 18:06:28'),
(19, 114, NULL, 'self', 'Ganjuwa local government', 'Self-registered', '2025-12-24 11:21:49', '2025-12-24 11:21:49'),
(20, 116, NULL, 'self', 'Lamido Street yola', 'Self-registered', '2025-12-24 11:41:28', '2025-12-24 11:41:28'),
(21, 119, NULL, 'self', 'Kwajffa,, Hawul, Borno state', 'Self-registered', '2025-12-24 11:47:46', '2025-12-24 11:47:46'),
(22, 122, NULL, 'self', 'usmanti opposite galtimari primary school\r\nusmanti opposite galtimari primary school', 'Self-registered', '2025-12-24 12:06:40', '2025-12-24 12:06:40'),
(23, 130, NULL, 'self', 'Kufang, Jos South, Plateau state', 'Self-registered', '2025-12-24 15:58:37', '2025-12-24 15:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `farm_records`
--

CREATE TABLE `farm_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `farmer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_role` enum('individual','data_collector') NOT NULL DEFAULT 'individual',
  `farmer_name` varchar(255) NOT NULL,
  `farmer_email` varchar(255) DEFAULT NULL,
  `farmer_phone` varchar(255) NOT NULL,
  `farmer_address` text DEFAULT NULL,
  `farmer_city` varchar(255) NOT NULL,
  `farmer_state` varchar(255) NOT NULL,
  `farmer_lga` varchar(255) DEFAULT NULL,
  `farm_name` varchar(255) DEFAULT NULL,
  `farm_size` decimal(10,2) DEFAULT NULL,
  `farm_size_unit` varchar(255) NOT NULL DEFAULT 'hectares',
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `location_accuracy` varchar(255) DEFAULT NULL,
  `farm_type` enum('commercial','subsistence','mixed') NOT NULL DEFAULT 'subsistence',
  `average_household_size` int(11) DEFAULT NULL,
  `farming_purpose` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`farming_purpose`)),
  `total_livestock_count` int(11) NOT NULL DEFAULT 0,
  `livestock_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`livestock_types`)),
  `livestock_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`livestock_details`)),
  `young_count` int(11) NOT NULL DEFAULT 0,
  `adult_count` int(11) NOT NULL DEFAULT 0,
  `old_count` int(11) NOT NULL DEFAULT 0,
  `breed_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`breed_information`)),
  `last_vaccination_date` date DEFAULT NULL,
  `vaccination_history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`vaccination_history`)),
  `has_health_issues` tinyint(1) NOT NULL DEFAULT 0,
  `current_health_issues` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`current_health_issues`)),
  `health_notes` text DEFAULT NULL,
  `veterinarian_name` varchar(255) DEFAULT NULL,
  `veterinarian_phone` varchar(255) DEFAULT NULL,
  `last_vet_visit` date DEFAULT NULL,
  `disease_outbreak_history` tinyint(1) NOT NULL DEFAULT 0,
  `past_diseases` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`past_diseases`)),
  `disease_notes` text DEFAULT NULL,
  `service_needs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`service_needs`)),
  `urgency_level` enum('low','medium','high','emergency') NOT NULL DEFAULT 'low',
  `service_description` text DEFAULT NULL,
  `preferred_service_date` date DEFAULT NULL,
  `needs_immediate_attention` tinyint(1) NOT NULL DEFAULT 0,
  `sms_alerts` tinyint(1) NOT NULL DEFAULT 1,
  `email_alerts` tinyint(1) NOT NULL DEFAULT 0,
  `phone_alerts` tinyint(1) NOT NULL DEFAULT 0,
  `alert_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`alert_types`)),
  `preferred_contact_method` varchar(255) NOT NULL DEFAULT 'sms',
  `alternative_phone` varchar(255) DEFAULT NULL,
  `data_sharing_consent` tinyint(1) NOT NULL DEFAULT 0,
  `research_participation_consent` tinyint(1) NOT NULL DEFAULT 0,
  `marketing_consent` tinyint(1) NOT NULL DEFAULT 0,
  `additional_comments` text DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `status` enum('draft','submitted','under_review','approved','rejected') NOT NULL DEFAULT 'submitted',
  `admin_notes` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `data_completeness_score` decimal(5,2) NOT NULL DEFAULT 0.00,
  `validation_errors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`validation_errors`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livestock`
--

CREATE TABLE `livestock` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_record_id` bigint(20) UNSIGNED DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `recorded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `tag_number` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `livestock_type` enum('cattle','goat','sheep','pig','chicken','duck','turkey','rabbit','horse','donkey','other') NOT NULL,
  `other_type` varchar(255) DEFAULT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `breed_purity` enum('purebred','crossbred','unknown') NOT NULL DEFAULT 'unknown',
  `breed_origin` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','unknown') NOT NULL DEFAULT 'unknown',
  `color` varchar(255) DEFAULT NULL,
  `markings` text DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `weight_unit` varchar(255) NOT NULL DEFAULT 'kg',
  `height` decimal(8,2) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `age_years` int(11) DEFAULT NULL,
  `age_months` int(11) DEFAULT NULL,
  `age_category` enum('young','adult','old','unknown') NOT NULL DEFAULT 'unknown',
  `acquisition_date` date DEFAULT NULL,
  `acquisition_method` enum('birth','purchase','gift','inheritance','other') DEFAULT NULL,
  `purchase_price` decimal(10,2) DEFAULT NULL,
  `previous_owner` varchar(255) DEFAULT NULL,
  `mother_id` bigint(20) UNSIGNED DEFAULT NULL,
  `father_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_breeding_animal` tinyint(1) NOT NULL DEFAULT 0,
  `offspring_count` int(11) NOT NULL DEFAULT 0,
  `production_purpose` enum('meat','dairy','eggs','breeding','work','mixed','other') DEFAULT NULL,
  `daily_milk_production` decimal(8,2) DEFAULT NULL,
  `monthly_egg_production` int(11) DEFAULT NULL,
  `last_production_date` date DEFAULT NULL,
  `health_status` enum('healthy','sick','recovering','deceased') NOT NULL DEFAULT 'healthy',
  `last_health_check` date DEFAULT NULL,
  `current_conditions` text DEFAULT NULL,
  `medical_history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`medical_history`)),
  `quarantine_status` tinyint(1) NOT NULL DEFAULT 0,
  `quarantine_start_date` date DEFAULT NULL,
  `quarantine_end_date` date DEFAULT NULL,
  `is_vaccinated` tinyint(1) NOT NULL DEFAULT 0,
  `last_vaccination_date` date DEFAULT NULL,
  `due_vaccinations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`due_vaccinations`)),
  `total_vaccinations` int(11) NOT NULL DEFAULT 0,
  `feed_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`feed_types`)),
  `daily_feed_amount` decimal(8,2) DEFAULT NULL,
  `feeding_schedule` varchar(255) DEFAULT NULL,
  `dietary_notes` text DEFAULT NULL,
  `housing_type` varchar(255) DEFAULT NULL,
  `housing_location` varchar(255) DEFAULT NULL,
  `pen_number` int(11) DEFAULT NULL,
  `status` enum('active','sold','deceased','transferred','missing') NOT NULL DEFAULT 'active',
  `status_change_date` date DEFAULT NULL,
  `status_notes` text DEFAULT NULL,
  `death_date` date DEFAULT NULL,
  `death_cause` varchar(255) DEFAULT NULL,
  `death_notes` text DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `buyer_name` varchar(255) DEFAULT NULL,
  `buyer_contact` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `primary_image` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `custom_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_fields`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `livestock`
--

INSERT INTO `livestock` (`id`, `farm_record_id`, `owner_id`, `type`, `user_id`, `recorded_by`, `tag_number`, `name`, `livestock_type`, `other_type`, `breed`, `breed_purity`, `breed_origin`, `gender`, `color`, `markings`, `weight`, `weight_unit`, `height`, `date_of_birth`, `age_years`, `age_months`, `age_category`, `acquisition_date`, `acquisition_method`, `purchase_price`, `previous_owner`, `mother_id`, `father_id`, `is_breeding_animal`, `offspring_count`, `production_purpose`, `daily_milk_production`, `monthly_egg_production`, `last_production_date`, `health_status`, `last_health_check`, `current_conditions`, `medical_history`, `quarantine_status`, `quarantine_start_date`, `quarantine_end_date`, `is_vaccinated`, `last_vaccination_date`, `due_vaccinations`, `total_vaccinations`, `feed_types`, `daily_feed_amount`, `feeding_schedule`, `dietary_notes`, `housing_type`, `housing_location`, `pen_number`, `status`, `status_change_date`, `status_notes`, `death_date`, `death_cause`, `death_notes`, `sale_date`, `sale_price`, `buyer_name`, `buyer_contact`, `images`, `primary_image`, `notes`, `custom_fields`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 2, 'cattle', 2, NULL, 'COW-001', NULL, 'cattle', NULL, 'Holstein', 'unknown', NULL, 'female', NULL, NULL, NULL, 'kg', NULL, '2023-12-14', NULL, NULL, 'unknown', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 'healthy', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'High milk producer', NULL, '2025-12-14 22:00:47', '2025-12-14 22:00:47', NULL),
(2, NULL, 2, 'cattle', 2, NULL, 'COW-002', NULL, 'cattle', NULL, 'Angus', 'unknown', NULL, 'male', NULL, NULL, NULL, 'kg', NULL, '2022-12-14', NULL, NULL, 'unknown', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 'healthy', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Breeding bull', NULL, '2025-12-14 22:00:47', '2025-12-14 22:00:47', NULL),
(3, NULL, 3, 'goat', 3, NULL, 'GOAT-001', NULL, 'cattle', NULL, 'Boer', 'unknown', NULL, 'female', NULL, NULL, NULL, 'kg', NULL, '2024-12-14', NULL, NULL, 'unknown', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 'healthy', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 22:00:47', '2025-12-14 22:00:47', NULL),
(4, NULL, 3, 'sheep', 3, NULL, 'SHEEP-001', NULL, 'cattle', NULL, 'Merino', 'unknown', NULL, 'female', NULL, NULL, NULL, 'kg', NULL, '2024-06-14', NULL, NULL, 'unknown', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 'healthy', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 22:00:47', '2025-12-14 22:00:47', NULL),
(5, NULL, 4, 'poultry', 4, NULL, 'CHICKEN-FLOCK-A', NULL, 'cattle', NULL, 'Rhode Island Red', 'unknown', NULL, 'female', NULL, NULL, NULL, 'kg', NULL, '2025-06-14', NULL, NULL, 'unknown', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 'healthy', NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Egg laying flock - 50 birds', NULL, '2025-12-14 22:00:47', '2025-12-14 22:00:47', NULL);

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(5, '2024_01_01_000005_create_data_collectors_table', 1),
(6, '2024_12_06_000001_create_data_collector_profiles_table', 1),
(7, '2024_12_06_000002_create_verification_documents_table', 1),
(8, '2024_12_06_000003_create_farm_records_table', 1),
(9, '2024_12_06_000004_create_livestock_table', 1),
(10, '2024_12_06_000005_create_vaccination_history_table', 1),
(11, '2024_12_06_000006_create_service_requests_table', 1),
(12, '2024_12_06_000007_create_alert_preferences_table', 1),
(13, '2024_12_06_000008_create_sessions_table', 1),
(14, '2024_12_06_100000_add_owner_id_to_livestock_table', 1),
(15, '2024_12_06_210000_add_missing_farm_record_columns_safe', 1),
(16, '2024_12_06_220000_make_alert_preferences_nullable', 1),
(17, '2024_12_07_000000_make_farm_record_id_nullable', 1),
(18, '2024_12_07_emergency_fix_farm_records_columns', 1),
(19, '2024_12_07_make_owner_id_nullable', 1),
(20, '2024_12_15_000001_update_users_role_column', 1),
(21, '2024_12_15_000002_create_animal_health_professionals_table', 1),
(22, '2024_12_15_000003_create_volunteers_table', 1),
(23, '2024_12_15_000004_create_farmer_enrollments_table', 1),
(24, '2024_12_15_000005_migrate_existing_roles_data', 1),
(25, '2025_12_06_165243_add_state_to_farm_records_table', 1),
(26, '2025_12_08_comprehensive_service_requests_fix', 1),
(27, '2025_12_08_fix_service_requests_table', 1),
(28, '2025_12_09_fix_farm_records_nullable_fields', 1),
(29, '2025_12_14_add_columns_to_livestock', 1),
(30, '2025_12_14_add_columns_to_livestock_UPDATED', 1),
(31, '2025_12_14_add_status_to_volunteers', 1),
(32, '2025_12_14_fix_service_requests_table', 1),
(33, '2025_12_14_fix_vaccination_history_table', 1),
(34, '2025_12_14_make_user_id_nullable_in_livestock', 1),
(35, '2025_12_15_fix_service_type_enum', 2),
(36, '2025_12_15_fix_all_service_request_enums', 3);

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
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `farm_record_id` bigint(20) UNSIGNED DEFAULT NULL,
  `livestock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `requested_by_role` enum('individual','data_collector') NOT NULL DEFAULT 'individual',
  `service_type` enum('vaccination','treatment','consultation','emergency','routine_checkup','breeding','deworming','castration','pregnancy_check','artificial_insemination','nutritional_advice','nutrition_advice','disease_diagnosis','surgery','other') NOT NULL,
  `description` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `other_service_type` varchar(255) DEFAULT NULL,
  `service_title` varchar(255) DEFAULT 'Service Request',
  `service_description` text DEFAULT NULL,
  `livestock_type` varchar(255) DEFAULT NULL,
  `number_of_animals` int(11) NOT NULL DEFAULT 1,
  `affected_animals` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`affected_animals`)),
  `symptoms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`symptoms`)),
  `symptoms_description` text DEFAULT NULL,
  `symptoms_start_date` date DEFAULT NULL,
  `is_contagious` tinyint(1) DEFAULT NULL,
  `affected_count` int(11) DEFAULT NULL,
  `urgency_level` varchar(255) DEFAULT 'medium',
  `priority` enum('low','medium','high','routine','important','critical') NOT NULL DEFAULT 'medium',
  `requires_immediate_attention` tinyint(1) NOT NULL DEFAULT 0,
  `urgency_reason` text DEFAULT NULL,
  `preferred_date` date DEFAULT NULL,
  `preferred_time` time DEFAULT NULL,
  `alternative_date` date DEFAULT NULL,
  `alternative_time` time DEFAULT NULL,
  `time_preference` enum('morning','afternoon','evening','anytime') NOT NULL DEFAULT 'anytime',
  `scheduling_notes` text DEFAULT NULL,
  `service_location` text DEFAULT NULL,
  `location_type` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `location_instructions` text DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `assigned_by` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_veterinarian_name` varchar(255) DEFAULT NULL,
  `assigned_veterinarian_phone` varchar(255) DEFAULT NULL,
  `status` enum('pending','acknowledged','assigned','scheduled','in_progress','completed','cancelled','rejected') NOT NULL DEFAULT 'pending',
  `status_notes` text DEFAULT NULL,
  `acknowledged_at` timestamp NULL DEFAULT NULL,
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `actual_service_date` date DEFAULT NULL,
  `actual_service_time` time DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `service_notes` text DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `treatment_provided` text DEFAULT NULL,
  `medications_prescribed` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`medications_prescribed`)),
  `recommendations` text DEFAULT NULL,
  `requires_followup` tinyint(1) NOT NULL DEFAULT 0,
  `followup_date` date DEFAULT NULL,
  `followup_instructions` text DEFAULT NULL,
  `followup_completed` tinyint(1) NOT NULL DEFAULT 0,
  `followup_completed_date` date DEFAULT NULL,
  `estimated_cost` decimal(10,2) DEFAULT NULL,
  `actual_cost` decimal(10,2) DEFAULT NULL,
  `service_fee` decimal(10,2) DEFAULT NULL,
  `medication_cost` decimal(10,2) DEFAULT NULL,
  `transport_cost` decimal(10,2) DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `currency` varchar(255) DEFAULT 'NGN',
  `payment_status` varchar(255) DEFAULT 'unpaid',
  `payment_date` date DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_reference` varchar(255) DEFAULT NULL,
  `outcome` enum('successful','partially_successful','unsuccessful','pending') NOT NULL DEFAULT 'pending',
  `outcome_description` text DEFAULT NULL,
  `outcome_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`outcome_data`)),
  `animal_recovered` tinyint(1) DEFAULT NULL,
  `recovery_date` date DEFAULT NULL,
  `documents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`documents`)),
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `prescription_document` varchar(255) DEFAULT NULL,
  `service_report` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `feedback_date` timestamp NULL DEFAULT NULL,
  `would_recommend` tinyint(1) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `alternative_contact` varchar(255) DEFAULT NULL,
  `preferred_contact_method` varchar(255) DEFAULT 'phone',
  `admin_notes` text DEFAULT NULL,
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `cancellation_reason` text DEFAULT NULL,
  `requester_notified` tinyint(1) NOT NULL DEFAULT 0,
  `requester_notified_at` timestamp NULL DEFAULT NULL,
  `provider_notified` tinyint(1) NOT NULL DEFAULT 0,
  `provider_notified_at` timestamp NULL DEFAULT NULL,
  `reminder_sent` tinyint(1) NOT NULL DEFAULT 0,
  `reminder_sent_at` timestamp NULL DEFAULT NULL,
  `reminder_count` int(11) NOT NULL DEFAULT 0,
  `reference_number` varchar(255) DEFAULT NULL,
  `external_reference` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `custom_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_fields`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `user_id`, `farm_record_id`, `livestock_id`, `requested_by_role`, `service_type`, `description`, `location`, `other_service_type`, `service_title`, `service_description`, `livestock_type`, `number_of_animals`, `affected_animals`, `symptoms`, `symptoms_description`, `symptoms_start_date`, `is_contagious`, `affected_count`, `urgency_level`, `priority`, `requires_immediate_attention`, `urgency_reason`, `preferred_date`, `preferred_time`, `alternative_date`, `alternative_time`, `time_preference`, `scheduling_notes`, `service_location`, `location_type`, `latitude`, `longitude`, `location_instructions`, `assigned_to`, `assigned_at`, `assigned_by`, `assigned_veterinarian_name`, `assigned_veterinarian_phone`, `status`, `status_notes`, `acknowledged_at`, `scheduled_at`, `started_at`, `completed_at`, `cancelled_at`, `actual_service_date`, `actual_service_time`, `duration_minutes`, `service_notes`, `diagnosis`, `treatment_provided`, `medications_prescribed`, `recommendations`, `requires_followup`, `followup_date`, `followup_instructions`, `followup_completed`, `followup_completed_date`, `estimated_cost`, `actual_cost`, `service_fee`, `medication_cost`, `transport_cost`, `total_cost`, `currency`, `payment_status`, `payment_date`, `payment_method`, `payment_reference`, `outcome`, `outcome_description`, `outcome_data`, `animal_recovered`, `recovery_date`, `documents`, `images`, `prescription_document`, `service_report`, `rating`, `feedback`, `feedback_date`, `would_recommend`, `contact_phone`, `contact_email`, `alternative_contact`, `preferred_contact_method`, `admin_notes`, `reviewed_by`, `reviewed_at`, `rejection_reason`, `cancellation_reason`, `requester_notified`, `requester_notified_at`, `provider_notified`, `provider_notified_at`, `reminder_sent`, `reminder_sent_at`, `reminder_count`, `reference_number`, `external_reference`, `notes`, `custom_fields`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, NULL, NULL, 'individual', 'vaccination', 'Need FMD vaccination for 10 cattle', NULL, NULL, 'Service Request', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'medium', 'routine', 0, NULL, '2025-12-19', NULL, NULL, NULL, 'anytime', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NGN', 'unpaid', NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+234-800-111-1111', NULL, NULL, 'phone', NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, '2025-12-14 22:00:47', '2025-12-14 22:00:47', NULL),
(2, 3, NULL, NULL, 'individual', 'treatment', 'One goat showing signs of illness - fever and loss of appetite', NULL, NULL, 'Service Request', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'high', 'routine', 0, NULL, '2025-12-15', NULL, NULL, NULL, 'anytime', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NGN', 'unpaid', NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+234-800-111-2222', NULL, NULL, 'phone', NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, '2025-12-14 22:00:47', '2025-12-14 22:00:47', NULL),
(3, 4, NULL, NULL, 'individual', 'consultation', 'Advice on improving poultry egg production', NULL, NULL, 'Service Request', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'low', 'routine', 0, NULL, '2025-12-21', NULL, NULL, NULL, 'anytime', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NGN', 'unpaid', NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+234-800-111-3333', NULL, NULL, 'phone', NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, '2025-12-14 22:00:47', '2025-12-14 22:00:47', NULL),
(4, 2, NULL, 2, 'individual', 'vaccination', NULL, NULL, NULL, 'Service Request', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'medium', 'medium', 0, NULL, '2025-12-16', NULL, NULL, NULL, 'anytime', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NGN', 'unpaid', NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+234-800-111-1111', NULL, NULL, 'phone', NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, 0, 'SR-U00X88C4', NULL, NULL, NULL, '2025-12-15 11:16:15', '2025-12-15 11:16:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('08tITq4RtipfUhfoifLfChdbhwksaj4hv1ra4sbt', NULL, '44.200.141.111', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/138.0.7204.23 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUVsV214aThZNHFIWWEzOENUbXh2TFRoa3o0VkdHdHNMZjNMTTVVZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766694678),
('6ABOKU6z0W1n28FpFD3P6DtcmPEvIwQyZrGAOxL4', NULL, '102.91.102.243', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDJSZDg4czNaMElGRWFNTTZUZklBTkRPWXBDNzFQZEdrNjFVeVVuQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vZmFybXZheC5jb20vcmVnaXN0ZXIvdm9sdW50ZWVyIjtzOjU6InJvdXRlIjtzOjE4OiJyZWdpc3Rlci52b2x1bnRlZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1766697054),
('6pHe6kedFobsjLv5cVbkeJ8NLorIv9YSZOWr4yb7', NULL, '197.211.63.156', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTRwbUM5eFkxb3QyR3pSZGNxelFubXZZSHNJY3p2bm5GZjVHeVVFVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766701994),
('E34ZZ25RzYJNagdU47hNMwE1pyeQJ7rteb20F6nm', NULL, '91.84.64.84', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFBEcnExcDZ4eVBqUGVVbE5uZ2dYbGlLbW9Na29aN3Z0WmZPTGxpeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766695131),
('EcmSZTqUmzyR1iDgAjmuRukmNdJGbBeqKRvxp0KD', NULL, '107.20.15.20', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/534.34 (KHTML, like Gecko) QupZilla/1.2.0 Safari/534.34', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY3pvZWVObXdoYW5vb0Fid3hTZzQzY2NNVERPSGZnYW9HQm5kemFWRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766690696),
('F4vK3Vlt4xyzqVu15lxDz7I02yWjNXLBAhnVo74H', NULL, '102.91.71.51', 'WhatsApp/2.23.20.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFJJNHlJSDU0NFJLY3ExWXVlSWhxNjdwcVlDeG5rMHNmckZnVXdCbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766696756),
('FWKjZc2UJYlOp2SEw71VOIFX3mlxw8fMDryZlj0D', NULL, '102.91.71.51', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/29.0 Chrome/136.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUV3eENuOWpua3Jub05kTFVTa1IyOXR3cnN2dTJwaTRUV3RXNWQwciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766700373),
('jhIfD0wp0XBYhD5Vk6GBg6CWOUYP4ipgqA8e6hRG', NULL, '102.67.11.162', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVd1Qm5qRTk2V3JLT3NiWXJRaXFlbkJTUkhPa2Z6SGhFNFNrNUlOSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766697792),
('JkT4f1v1hkP1MvewmnTAgOBskGm90rnHe3Hb8WzI', NULL, '44.205.248.142', 'Mozilla/5.0 (Windows NT 11.0) AppleWebKit/537.36 (KHTML, like Gecko) Safari/104.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGpRMTNwT3dBUmhoMzdtcUVYY3BNajI1WkZ0RmhoUnAyYmw2OG9BUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766700611),
('kkIwRPtUwX4MHfEqaekXHvwBXrhBwlEmxKcr8dtd', NULL, '107.20.15.20', 'Mozilla/2.02E (Win95; U)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDNKRUdvVzM0WTVwV1V5ZHVUNHBNT0t2OEtjWTFUcWZiYVZWREhyayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766690696),
('LmNhMhYG8O0USCfSLe683naR1rqyZvrbcG3jwWbN', NULL, '178.62.60.81', 'Mozilla/5.0 (X11; Linux x86_64; rv:142.0) Gecko/20100101 Firefox/142.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUFkelhpalpSdUU1Q1dLVlB2dXBUU3E2UkJFOTM5aW5oR0xOd0x1VCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vd3d3LmZhcm12YXguY29tIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1766697386),
('LN5fhNf0BLPr1oWDZApVa6P9aeaUXY27TWmDmkKr', NULL, '102.91.71.51', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicVRaYmFBZW5GcXVHQXpCRlg0b3RUTFRoV1VCcmdKb0JPVE5ZUGxZMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766699496),
('NcpEIzkIOdzCU5cD338SdbRX3NrFwwctcxzueRKi', NULL, '102.91.71.51', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGtvWW91R0NTSkZuUnN1TVRzRWhXeFNFeUhMV0U5VGpGVVZjQXFCcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766696271),
('nlXkGFtDWHNCOxaKB16GCUsmWRKfT1fJurvJB3pa', NULL, '197.211.53.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYjhVRFkwWURzME9sV2ZFVWUzT2RKQjlXYWR2ZHNIeWJtUTJKb0RkOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vZmFybXZheC5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1766700155),
('NWZN9bSP88iP9PptGvYIRKd1NJBfveSBpfPRHnU2', NULL, '105.115.10.15', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWk1sTFRkdUNaU2tHcWE5aDdhZU50NG9oSlZYbFp4VEpHN2dDcmp6eSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766697113),
('OK9B7KnU3jp1CSTGCK0zRyuaqn6Tzp8speExFJz4', NULL, '105.117.10.126', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3JMOVp3dmZ5ZGlWeVM1VGJTMjlleUt4d2VxVzZkenh4R0tSZ29DMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766694562),
('pmEXv6TbSkfw1dTpI122dAdu4sBxDfmi4p9QYAlV', NULL, '107.20.15.20', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2hQTm9ieE80NXlKM09tOHJhcmNmRmZiWXhpamtUU2t3ejdzYUp0NCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766690697),
('QFP02gTF3C26CydU0QymWsCFm8JILsEW5nVSdVzx', NULL, '105.113.67.8', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXhTTUdKVGNta2JqdVNibm95RlJKUlQ4QlFkOWw1cUVyNXR2bmtrNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766698987),
('S0YGCw2NqlFew6S0qGT7gi06JyNe45lQ9pIJ1vB3', NULL, '102.91.102.39', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHUxSDB6QzQzV2NCQU5BM1dkMjlzSHhXZzFUY01MMVdlMWxhYWdRZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766697987),
('SDT8IpGoRWZkBPpmTRJS0A0PqNF7JcYvdNlRpwcx', NULL, '102.91.105.230', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidFBodHpwY05wT1J6VWtoalp6NVhPc3RvWlpVa2c1NDJlOGRYdXlkSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766699918),
('tIzXIlz0WitRPZWxUqDYSNqnMiDch2GEn3kv4EA0', NULL, '2a06:5906:43f:900:b028:72d1:c6b1:5e57', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Brave/1 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTJPR1J6ZW1ZalVlRXJTeE9wV2p0NzR5dnVXd05Hck9jb2hIbmlONiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vZmFybXZheC5jb20vcmVnaXN0ZXIvZmFybWVyIjtzOjU6InJvdXRlIjtzOjE1OiJyZWdpc3Rlci5mYXJtZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1766704054),
('tx5XPzn5Gm9vkme3iKSURXZfvgOBLkHaXG7D2N14', NULL, '102.88.114.75', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2tWcDM1YVBDMThCUGZHZW9qT21pVk5VenZPUXhGc1RCR1RtdXhHUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766697014),
('UVH7D5SUHlnVvY12sGqZxIjo2AsAg9nfYrISpf8S', 143, '102.91.102.19', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicXBNN0wzT0NuSXo0Nzl5ajdsZmNuVXhiczEyUjFSUUFtRjUwUDM0QSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHBzOi8vZmFybXZheC5jb20vcHJvZmVzc2lvbmFsL3BlbmRpbmctYXBwcm92YWwiO3M6NToicm91dGUiO3M6Mjk6InByb2Zlc3Npb25hbC5wZW5kaW5nLWFwcHJvdmFsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTQzO30=', 1766697540),
('vZA1q8xuJ6Lvjsd03maZJAnlGlbcbo22Cn8y3evE', NULL, '44.205.248.142', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 14_4_1) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4.1 Safari/605.1.15', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGxyVnY0cldJSERjVFRrUEFGVVlwc1dsd3JTalZreUxtbEswelVJcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766700619),
('Y5lPjXgybBOcPIWACrlgNXmCUneC7I6Gr9SpnbLo', 144, '141.0.13.187', 'Mozilla/5.0 (Linux; U; Android 8.1.0; Infinix X650 Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/129.0.6668.70 Mobile Safari/537.36 OPR/85.0.2254.74549', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ2VCSmY5YTFRRFV5OUw5ZGhSS0c1WWFCdUNlZ0dDTlA3ZlR0ekdndiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vZmFybXZheC5jb20vdm9sdW50ZWVyL215LWZhcm1lcnMiO3M6NToicm91dGUiO3M6MjA6InZvbHVudGVlci5teS1mYXJtZXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTQ0O30=', 1766699901),
('zRWOn50hiGMbn87DsteAlb05xFXc9YuhSjgrBhGY', NULL, '98.92.149.12', 'okhttp/5.3.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2VWSmFmQmtPMEcwQmZtWVBIYkRCckM5ZkpEN0Y3TWIxcTJTSFZCeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vZmFybXZheC5jb20iO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766694643);

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
  `role` enum('admin','farmer','animal_health_professional','volunteer') NOT NULL DEFAULT 'farmer',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'Nigeria',
  `status` enum('active','suspended','pending') NOT NULL DEFAULT 'active',
  `is_approved` tinyint(1) NOT NULL DEFAULT 1,
  `profile_image` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `phone`, `address`, `city`, `state`, `country`, `status`, `is_approved`, `profile_image`, `bio`, `approved_at`, `approved_by`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin User', 'admin@farmvax.com', '2025-12-14 22:00:45', '$2y$12$tuB/YxG0XYwqzreZaH8CWeRmrOrVqLPSqPRtlqIJWwnYUsAt7Vcbi', 'admin', '+234-800-000-0001', 'FarmVax Headquarters, Abuja, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, 'DQaG7McAbtZsyTMVy7IxTW8WkYeQVsVrE2Wu6v667IKszu2oq2qImFZY3Lhp', '2025-12-14 22:00:45', '2025-12-14 22:00:45', NULL),
(2, 'John Farmer', 'farmer@farmvax.com', '2025-12-14 22:00:45', '$2y$12$NIm5z25KfJeyQxO/RRTwsuSkyJPQoLxfv9b8O.1416II/IgBNswW6', 'farmer', '+234-800-111-1111', 'Farm Village, Kaduna State, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-14 22:00:45', '2025-12-14 22:00:45', NULL),
(3, 'Mary Livestock', 'mary@farmvax.com', '2025-12-14 22:00:45', '$2y$12$LkV8rZB7IVX5itl7Pxv4cePiSMmvk2i6VVfQtN6UsI2UzjeTqcZBW', 'farmer', '+234-800-111-2222', 'Green Valley Farm, Kano State, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-14 22:00:45', '2025-12-14 22:00:45', NULL),
(4, 'David Rancher', 'david@farmvax.com', '2025-12-14 22:00:46', '$2y$12$5IZ4E5qBtaOt3WstuP9QUeYcyaq7KHlnyf0s1EmRVxpqzlvqXQGDm', 'farmer', '+234-800-111-3333', 'Sunrise Ranch, Plateau State, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-14 22:00:46', '2025-12-14 22:00:46', NULL),
(5, 'Dr. Sarah Veterinarian', 'professional@farmvax.com', '2025-12-14 22:00:46', '$2y$12$UxPwjezZLUX1KYD5.9.Sxe.iv6NL2Ag3jqNi7EoJ4k6SNCD6j4y1m', 'animal_health_professional', '+234-800-222-1111', 'Veterinary Clinic, Lagos State, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-14 22:00:46', '2025-12-14 22:00:46', NULL),
(6, 'Dr. James Veterinary', 'pending@farmvax.com', '2025-12-14 22:00:46', '$2y$12$hw4KJhx1QVV0b2gdSyF6xezO8txcXE/3AxZmtvM1Qz4X.wtciobwq', 'animal_health_professional', '+234-800-222-2222', 'Animal Clinic, Abuja, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-14 22:00:46', '2025-12-14 22:00:46', NULL),
(7, 'Alice Volunteer', 'volunteer@farmvax.com', '2025-12-14 22:00:47', '$2y$12$7wpilYUc5RgNc.nk8GQKLuSOKgBQQ9xA/Iua.DJuw4bqPwYsNcpMa', 'volunteer', '+234-800-333-1111', 'Community Center, Kano State, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-14 22:00:47', '2025-12-14 22:00:47', NULL),
(8, 'Tijani Bulama', 'tijani@farmvax.com', NULL, '$2y$12$CPGUXdmYYgOEnE2pWyf/aebMna3xYq04E7jLM7K5HlZ6qHDL2.ILi', 'animal_health_professional', '+2348119281144', 'No 22Oba Akran Avenue Ikeja, LA NG\r\nOba Akran Avenue', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-14 22:44:48', '2025-12-14 22:44:48', NULL),
(9, 'Tijani Bulama', 'tj@farmvax.com', NULL, '$2y$12$Me8cYOVfkdANFl5S/HT4OOu6o0708iRNSquyF7Y3ULhJknBmPzMke', 'farmer', '08119281144', 'No 22Oba Akran Avenue Ikeja, LA NG\r\nOba Akran Avenue', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-15 05:00:10', '2025-12-15 05:00:10', NULL),
(10, 'Tijani Bulama', 'bulamabukar10906@gmail.com', NULL, '$2y$12$A1Jgtp40cU0r72/gApYxJeI2rC3fqDh8cId95b9DPWyeC9ponHMwa', 'farmer', '+2348119281144', 'No 22Oba Akran Avenue Ikeja, LA NG\r\nOba Akran Avenue', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 05:58:52', '2025-12-16 05:58:52', NULL),
(11, 'Rodiyah Adegoke', 'rodiyahadegoke@gmail.com', NULL, '$2y$12$d2lYlqKstKAmNaITBq5EMOAY2frwsGuUf4x03GI70c1vNjMZMNska', 'animal_health_professional', '+2348110837426', '29. Adegbite street, Irepodun, Agbowo, Ibadan, Oyo state, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:07:19', '2025-12-16 07:07:19', NULL),
(12, 'Dr.Nancy Otu', 'nancy.eni-otu@farmalert.com.ng', NULL, '$2y$12$qa74T.J1VnmMwVw0GKZEhOhtQMjn2cX1Bakg6iWbMxd4sjvo8ka1e', 'animal_health_professional', '08104127121', 'Afikpo north ,Ebonyi', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:08:54', '2025-12-16 07:08:54', NULL),
(13, 'Rodiyah Adegoke', 'adegokerodiyah@gmail.com', NULL, '$2y$12$BP7TEhxnrMo7z/MD02ORdu6f8d0FA6SPX9yy18BxpYmjKX7Lsigja', 'farmer', '+2348110837426', '29. Adegbite street, Irepodun, Agbowo, Ibadan, Oyo state, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 07:12:25', '2025-12-16 07:12:25', NULL),
(14, 'Ojedokun Faith', 'ojedokunfaithayomide68@gmail.com', NULL, '$2y$12$3KqSch7DqVQsOOrVmKkpd.ny5HgtW7X5RQjwqjPNpobyGHga1vOP2', 'farmer', '08107827497', 'Kubwa Bwari LGA', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 08:49:43', '2025-12-16 08:49:43', NULL),
(15, 'Dr Ojedokun Faith', 'imaniojay@gmail.com', NULL, '$2y$12$lOpVV8s6Yt45Mbw9OinGZeBfbETselCgU0DlUViCJEEpdEKWVv9XO', 'animal_health_professional', '08107827497', 'Kubwa Bwari LGA', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 08:55:05', '2025-12-16 08:55:05', NULL),
(16, 'Dr Moses Arokoyo', 'survival_moe@yahoo.com', NULL, '$2y$12$cRMD6PYt6zi7GrPUHECKHObJZZBtINBRACEluJASpVEaRqAGZyYMW', 'animal_health_professional', '+2348037779060', 'Ibadan, Egbeda LGA, Oyo State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 10:08:23', '2025-12-16 10:08:23', NULL),
(17, 'Umair Hashim saeed Dutsinma', 'umairhashim702@gmail.com', NULL, '$2y$12$WSsbTwggTll3UETS98KqYunCx3HV5vgD/M7lMACTUR/JmshlFilp6', 'farmer', '+2347033867234', 'Babangida Aliyu crescent Life camp Abuja 16\r\nBabangida Aliyu crescent Life camp Abuja 16', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 10:54:23', '2025-12-16 10:54:23', NULL),
(18, 'Ibrahim Musa Adamu', 'ibrahimadamudvm@gmail.com', NULL, '$2y$12$5XXx8Bexi2OGdKMpTpMymOA0G57mRWLQVrinYMYwPoubDR6/DQcZa', 'animal_health_professional', '08166817415', 'Galadima zadawa\r\nSabon fegi', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 11:31:24', '2025-12-16 11:31:24', NULL),
(19, 'Dr Joseph Oti Inedu', 'jinedu72@gmail.com', NULL, '$2y$12$TWllr20AiS8N2Un2tdmAnu6Yn2JHPk/QSA9IU4PQc95s1yAS529xO', 'animal_health_professional', '+234 805 627 5434', 'Gidan Mangoro,FCT,Abuja', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 11:32:21', '2025-12-16 11:32:21', NULL),
(20, 'Dr. Saadudeen Muhideen Aremu', 'saadmuidin@gmail.com', NULL, '$2y$12$aX6Fn5ML3wH7SZPvxWnq2e5BFsQzE5bIFBDLaEKDjNM1uBdqkP/k2', 'animal_health_professional', '+2349020994680', '75, Oregele Compound Okelele Ilorin Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 11:33:08', '2025-12-16 11:33:08', NULL),
(21, 'DR. YUSUF UBAJI GURAI', 'yugurai5@gmail.com', NULL, '$2y$12$9ECMPdtmBExV9iQSNcyQP.oxtpmgUZVok7NJttzhRNEAYdwtXEgAa', 'animal_health_professional', '07066763892', 'Ran Road, Bauchi.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 11:34:36', '2025-12-16 11:34:36', NULL),
(22, 'Onyekachukwu Solomon Okongwu', 'solomonokongwu1@gmail.com', NULL, '$2y$12$GILh5TqW4/g4jTZI62gjjuKF0Jdri/QtRYcr6XRrKYZUBe0C6mhTW', 'animal_health_professional', '+2349036063156', 'Ibadan, Oyo State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 11:36:50', '2025-12-16 11:36:50', NULL),
(23, 'Bilal Muhammad', 'bilalchinade@gmail.com', NULL, '$2y$12$l6xHAXGNkDfmBn6Bn/WzuuOTxFqgt5Luh.aaAqR0/SP3ZUeCVigwW', 'animal_health_professional', '+2348063930361', 'Azare, Bauchi State. Nigeria.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 11:38:41', '2025-12-16 11:38:41', NULL),
(24, 'Dr. Nura Muhammad Tukur', 'muhammadnurullahee@gmail.com', NULL, '$2y$12$nAfbsbtUs.01VTmlRAU36uCgsr0jAznkNdLelfRTtQzqnXCpaAKw2', 'animal_health_professional', '+2348030454598', 'Gidan Marna Area Sifawa Bodinga Local government, Sokoto', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 11:38:53', '2025-12-16 11:38:53', NULL),
(25, 'Muhammad Nagabasku Bulama', 'nagabaskumuhammedbulama@gmail.com', NULL, '$2y$12$rniLEw2HjuelEpiALDWv9uE4oYlI4dQ6DqYEDYjtcZ/OTuGGZf4G6', 'farmer', '07025125700', 'Damaturu yobe state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, '19BMVmQ2tU9J2T2r26dDWJFP4wkJhbfKS5LnQMel2hCFGgciSJ1aoYri5Tps', '2025-12-16 11:41:48', '2025-12-16 11:41:48', NULL),
(26, 'Oladele Muhideen', 'muhideenolayode@gmail.com', NULL, '$2y$12$9xxkrRIw60BE.fnELXrPVepm557Em6aTEB7e8JWqyaNPBdMozu0nC', 'animal_health_professional', '+2348158921659', 'Oladele\'s house, Ikogba, Ayete', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 12:34:43', '2025-12-16 12:34:43', NULL),
(27, 'Dr Mansur Nuhu', 'mansurnuhu55@gmail.com', NULL, '$2y$12$TiZ1.LJ1bTID4n.iyJjk5eOB9FA6oizSW43iikDDPCn1vqG5L2LDm', 'animal_health_professional', '+2348062246974', 'No 92, unguwan Rimi Basawa Zaria\r\nSakadadi road', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 14:16:16', '2025-12-16 14:16:16', NULL),
(28, 'Usman Garba Suleiman', 'garbausman2324@gmail.com', NULL, '$2y$12$U6Sq1VjFzCAkNalUF/h7u.egY2Fx0xig0I7guGfV97oOWiiIqocEG', 'volunteer', '08100083226', 'Kwantaresha Dogarawa, sabon gari LGA, Kaduna state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 18:23:04', '2025-12-16 18:23:04', NULL),
(29, 'Tijani Bulama', 'bulama10906@gmail.com', NULL, '$2y$12$sNRmEZ3hW5nvBzDPqYZuFee5ktmFy/E99SEQ6ts6f2hdJ0y3KGG7G', 'animal_health_professional', '+2348033899217', 'Lagos Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-16 22:33:38', '2025-12-16 22:33:38', NULL),
(30, 'Abudei Andrea', 'abudeinkechicho@gmail.com', NULL, '$2y$12$PMJuW0Efhxf1An6UsfKbO.McBEQREQE1WPS9wlj8WxfwDAtSmhav.', 'animal_health_professional', '+2347061234157', '30 Okemesi crescent Garki Abuja', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-17 11:15:17', '2025-12-17 11:15:17', NULL),
(31, 'Dr Onoja Benedict Onu', 'drbenonoja@gmail.com', NULL, '$2y$12$YAex1P5gx5ML23LGnQC62OcPRDiLA3rW/oy4DQ2Svtv9TP5sacMga', 'animal_health_professional', '+2348035958939', 'Joseph Sarwuan Tarka University, Makurdi, Benue State, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-17 11:28:43', '2025-12-17 11:28:43', NULL),
(32, 'Dr. Umogba Eneto-Junior', 'nemoveterinary@gmail.com', NULL, '$2y$12$8.8simdGjed6ZLmVkaPCDeV1874b4RZ8PVC8LDDDB/PLZRIIcsFlC', 'animal_health_professional', '08142667294', 'Shop S2/S11, UG-COM PLAZA, EKETE, UDU LGA, DELTA STATE', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 12:51:23', '2025-12-19 12:51:23', NULL),
(33, 'EMMANUEL TOLU, OLORUNMO-DADA', 'yomidele4@gmail.com', NULL, '$2y$12$4Nm4F3LCdBhdfGwUG7qO6.vCTKH8NPJ9RK/xTkcC0Qh7/CyHViXJS', 'volunteer', '+2348056354613', 'Samaru, Zaria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 12:55:36', '2025-12-19 12:55:36', NULL),
(34, 'Dr Ahmad ABDULKADIR', 'ahmadabdulkadir520@gmail.com', NULL, '$2y$12$syFE1HaCzAYOLjbJFKlyAOTuwRcUMRKKNDEahDifCYITbdJm/iWfe', 'animal_health_professional', '+2349169042784', 'Gama B, NASS. LGA', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 13:03:04', '2025-12-19 13:03:04', NULL),
(35, 'ISA M. SANI', 'isamallamkbn@gmail.com', NULL, '$2y$12$WxLR53hzlqMPXbcYmktJOuMTVj5kbI7mjicD2fcjPtNwofL36Z4XS', 'animal_health_professional', '08030716081', 'Waziri Ibrahim extension damaturu Yobe State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, 'c6ec9KwQ1kPhhJlK0zI2Xm4tBiJpnbCbWWB7Bnb4OFEPTu8mbMCPdtE9nAQd', '2025-12-19 13:05:31', '2025-12-19 13:05:31', NULL),
(36, 'Kazeem Abdulmalik', 'tayokazeem185@gmail.com', NULL, '$2y$12$8CeDsEf.s1lE3yxafFHThOk/0JmpVD79Fda7dGi2duJSOnrrlzejG', 'volunteer', '08167386460', 'Number 50 Graceland, samaru, Zaria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 13:15:52', '2025-12-19 13:15:52', NULL),
(37, 'Abdullahi Mohammed Gana', 'abdulbirama47@gmail.com', NULL, '$2y$12$A/tLUfyzIIRzzpGVg0cGmON64mjQTP0bnL1Kacrn0iEy3BIV7JHI.', 'farmer', '+2347063189508', 'Bwari', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 13:17:39', '2025-12-19 13:17:39', NULL),
(38, 'Dauda Yusuf Tofa', 'yusufdaud14@gmail.com', NULL, '$2y$12$WJtGXvaW..sGYuXRmuuhtOn0lsefNBT0MPxjFgUCOsGanB1FUzeo.', 'farmer', '08034626044', 'Tofa', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 13:18:43', '2025-12-19 13:18:43', NULL),
(39, 'Dr Joshua Nehemiah kallo', 'kallojoshua9@gmail.com', NULL, '$2y$12$o8ZXFqCYg1OxGxsVRgKaZeBocXfvZWzkZYq0Nx2xDa6X6toEWRvhW', 'volunteer', '09163440118', 'kilometre 21 along ABUJA-KEFFI EXPRESS KARU LOCAL GOVERNMENT AREA, Masaka 961105, Nasarawa, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 13:30:38', '2025-12-19 13:30:38', NULL),
(40, 'Hassan shuaibu', 'sasramat@gmail.com', NULL, '$2y$12$imDI2mOadjtFuegL7wOsMeveA1NYxyQWYuHSjn060SDFGmgf52N9K', 'farmer', '07060679493', 'Iwaro town,ipetumodu,ife north, osun state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 14:04:23', '2025-12-19 14:04:23', NULL),
(41, 'Dr KABIRU MUHAMMAD', 'kabirumuhammad269@gmail.com', NULL, '$2y$12$Gf4ngrnVnBBux2TY/215HOimHHMrPtZgtsb5BobLAgEwwN8NQ1FXC', 'animal_health_professional', '+2348062732554', 'Kofar Kitari Area Bunza', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 14:11:02', '2025-12-19 14:11:02', NULL),
(42, 'Salim Umar Ambursa', 'ambursadvm50@gmail.com', NULL, '$2y$12$RA5UaX7O.2GIkUUifX.r5ulP59EPxtBbRqMty1ug4zKaRmoPF2mJG', 'animal_health_professional', '7085656923', 'Ambursa 860101, Kebbi, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 14:14:58', '2025-12-19 14:14:58', NULL),
(43, 'Husaini Umar Danjuma', 'dandaura2015@gmail.com', NULL, '$2y$12$P6AHBleHxnTgO75ElOTA4Opkf93jxvdQ6XHM3STYsTOiW9VYRFami', 'animal_health_professional', '+2347034728933', 'Daar Agrovet Nigeria Services \r\nMaiadua Road  Opp. Police Area Command Hqtrs  Daura,  Katsina  State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 14:26:35', '2025-12-19 14:26:35', NULL),
(44, 'ABDULLAHI OGBENJUWA', 'abdullahiogbe1@gmail.com', NULL, '$2y$12$WO5VTpWt5Z5o5UzEojZ33.WiOG8/DcnZOmIX4YrE/6IAbDIm4GUBq', 'farmer', '09049035637', 'Opposite AA Rano gas station Ombi 1 Lafia', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 14:53:22', '2025-12-19 14:53:22', NULL),
(45, 'Zakariya Idris', 'Zakariyaidris6742@gmail.com', NULL, '$2y$12$Ly6z/bCsNTFPn.WoPmH2EufXLIarihABnHcP5YFDzO3SfJm2AmiYK', 'animal_health_professional', '08073145325', 'Nyanya quarters Damaturu, Yobe State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 14:55:26', '2025-12-19 14:55:26', NULL),
(46, 'habibullahi USMAN', 'habibusman64@gmail.com', NULL, '$2y$12$MKKBNYWoibyBU9Ru4Hm72OKtoc1yP8QGIhQdB4ZIpPP/lUAUp/M6.', 'volunteer', '+2348062067507', 'yp 32 kabala road tudun wada kaduna', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 15:36:58', '2025-12-19 15:36:58', NULL),
(47, 'Ismaila Usman Kadawa', 'iukadawa@gmail.com', NULL, '$2y$12$EgRcljc32wgJ.Qu3oPHNj.Xj3qVoWkf70iaGhAG6YCjZnLvUmLZmy', 'animal_health_professional', '09034246474', 'Rijiyar lemon Fagge LGA Kano', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 15:44:00', '2025-12-19 15:44:00', NULL),
(48, 'Dr ABUBAKAR LADAN AHMED', 'dvmaaladan@gmail.com', NULL, '$2y$12$ahHjxYel1HLFsSJbh.ENZ.K5I3ClgfRxHE2z8Hbp5M7nDwYyqVLrW', 'animal_health_professional', '+2347040161827', 'Garaku, KOKONA LGA Nasarawa state of Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 16:23:03', '2025-12-19 16:23:03', NULL),
(49, 'Haruna Rabiu', 'harunarabiu76@gmail.com', NULL, '$2y$12$lbB6LtvOkyVruubMHuT14uZWCpOF7m17ND4U.WG8E8NXwhnbJWX06', 'farmer', '07018896074', 'Gafan cikin gari along Zaria road\r\nKANO Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 16:40:56', '2025-12-19 16:40:56', NULL),
(50, 'Dr bashir karibu gatawa', 'karibubashir089@gmail.com', NULL, '$2y$12$tsceBx3bXI4RHoFyABmp1eN48G92WHBehmerGZAC6s4ZxH.62yJPu', 'animal_health_professional', '09034864839', 'Mabera gidan dahala\r\nKanwuri area gatawa', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:14:49', '2025-12-19 17:14:49', NULL),
(51, 'Dr  Ibrahim hussaini', 'abuabdulhaleem66@gmail.com', NULL, '$2y$12$gCxPAevfzt9Fe8OHI46sjeK/uAZVb.aZQHj3UNIvb.eG3j5epkPSS', 'animal_health_professional', '+2348066783177', 'Nassarawa Jahun bauchi\r\nDustin tanshi', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:51:23', '2025-12-19 17:51:23', NULL),
(52, 'Yusuf Muhamamd Kabir', 'yusufmkabir@gmail.com', NULL, '$2y$12$flnrRExoOJdoiVyTH1YMMufJ74n1LHilYd91uzvokk85ZpIbuApTS', 'volunteer', '+2348065235504', 'House No 5 behind Police Barrack Area Birnin Kebbi, Kebbi State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:52:25', '2025-12-19 17:52:25', NULL),
(53, 'Dr. Azeezat Fasasi', 'azeezatfasasi3@gmail.com', NULL, '$2y$12$98CJBYTYQdbEWamg7yaqjOzspYYwBYcLXMM0FtdOm21nHWcT7FX1y', 'animal_health_professional', '+2348097128868', 'Apete, Ido local government, Ibadan, Oyo State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 18:36:30', '2025-12-19 18:36:30', NULL),
(54, 'Reuben Mathew Yensam', 'reubenmatthewyensam2021@gmail.com', NULL, '$2y$12$YknMIwhZls6ggcAv044/cOl2vdJa3Mt.03JBIaOqcIXqG7/tIXX/S', 'volunteer', '07089291196', 'Behind Nukkai model primary School Jalingo Taraba State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 20:47:02', '2025-12-19 20:47:02', NULL),
(55, 'Dr Ibrahim Aliu', 'ibrahim2000aliyu@gmail.com', NULL, '$2y$12$YGz.ip7nFXwYHSJKdD35AOt5kw369j0wviJnHUyG4BKBCpgjpTxKe', 'animal_health_professional', '+2348061129029', 'Ayetutu street off isinkan market, Ondo road, Akure, ondo state.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 21:54:53', '2025-12-19 21:54:53', NULL),
(56, 'Aminu Shittu', 'shittuaminu38@gmail.com', NULL, '$2y$12$rNqgSxLl1CETaHZsvA.iSOZyk8ElEiT5XfkkiRED3dWI/x4nEeCTW', 'animal_health_professional', '+2348065489917', 'Department of Veterinary Public Health and Preventive Medicine, Faculty of Veterinary Medicine, Usmanu Danfodiyo University Sokoto, Sokoto State, Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 21:59:19', '2025-12-19 21:59:19', NULL),
(57, 'Dr. Jesse Haruna', 'Jesseharun68@gmail.com', NULL, '$2y$12$uOcNsuTVSY9jSpSO9bsZVeZHIuud.7Wf0qNbVpFIqDwaZda9iNIwa', 'animal_health_professional', '+2349022925891', 'Gibson Jalo Army Cantonment Yola', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-19 23:26:12', '2025-12-19 23:26:12', NULL),
(58, 'Dr. Abduljabbar Dauda Abdullahi', 'abduljabbardaudaabdullahi001@gmail.com', NULL, '$2y$12$jMX91NHfcO3jvVduvPuuQ.6pmPQ9All3cb3M7OaW098O4RVPSIT3q', 'farmer', '08066198217', 'Qasarawa farms, Wamakko LGA, Sokoto State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-20 00:39:47', '2025-12-20 00:39:47', NULL),
(59, 'Ibrahim Yusuf Olamilekan', 'yibrahimolamilekan@gmail.com', NULL, '$2y$12$/uW3CyfWVAjxnfG9IUQHPuoZObEu7wF6I6HM7BifZu5ML7jPyf2h6', 'volunteer', '08148561957', '29d11, Temidire street Gaa-Akanbi, Ilorin, Kwara State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-20 02:57:24', '2025-12-20 02:57:24', NULL),
(60, 'Dr Yahaya Musa', 'yahayamousadvm@gmail.com', NULL, '$2y$12$yI0ocab.KSyG9MIS3iNQw.cCKI.a0v00bKumrSAFuUmMN1pwQjUZW', 'animal_health_professional', '+2348138505739', 'Makama S-19 dutsen tanshi Bauchi, Bauchi State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-20 03:25:55', '2025-12-20 03:25:55', NULL),
(61, 'Ibrahim Badamasi', 'ibrahimbadamasi2002@gmail.com', NULL, '$2y$12$zMx4QG5CkMXU2juL5ylVmuU8ofp0YaQy3ceoFLYpMy150TLxdJIHC', 'volunteer', '+2349039189177', 'No 04 Anguwan magajiya zaria city\r\nzaria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-20 04:49:05', '2025-12-20 04:49:05', NULL),
(62, 'Isah Musa Gusau', 'algusaweee@gmail.com', NULL, '$2y$12$2pMEW0C10OhdAPd9g9To3.wV2KUofNGd1NCH3XwYkLxl8XylF969K', 'farmer', '08050434342', 'Maikunkele, Bosso Local Government area, Minna, Niger State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-20 06:35:43', '2025-12-20 06:35:43', NULL),
(63, 'Hassan shuaibu', 'sasrabiat212@gmail.com', NULL, '$2y$12$SGfYWBlV7M.Xv4PpHWEy7.V45B3OsUSN94naKybZkt7rylB9ygw7i', 'animal_health_professional', '07060679493', 'Barikin sale, minna, Niger state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-20 08:31:30', '2025-12-20 08:31:30', NULL),
(64, 'Dr. Amah Amogema', 'amahamogema@gmail.com', NULL, '$2y$12$ZXwyszJeL3VfXYd892uRaeE5FL77QACG0EQ9LNiOP9OMt67.y7ICO', 'animal_health_professional', '+2348035639338', 'Ibusa, Delta state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-20 08:36:42', '2025-12-20 08:36:42', NULL),
(65, 'Dr. Abubakar Suleiman Giade', 'drasgiade07@gmail.com', NULL, '$2y$12$zdaM6OC1.h0.XlU1q1OS3usKUBuq/PGG0PCHIbfxPsXWk3t5q1EPe', 'animal_health_professional', '08060029532', 'Sarkin shanu street, Giade LGA, Bauchi state.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-20 09:40:31', '2025-12-20 09:40:31', NULL),
(66, 'Bethuel Lynn', 'Bethuellynn@gmail.com', NULL, '$2y$12$Jt7Rsph8IwWDjva7fc7OUeQpBjduHCA8gDp0saXfYiGSmwBqRdH/6', 'volunteer', '+2348108433843', 'No 20 Galadima aminu way Jimeta/Yola', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-20 10:39:19', '2025-12-20 10:39:19', NULL),
(67, 'Muhammad Shehu Abubakar', 'muhammadshehuabubakar15@gmail.com', NULL, '$2y$12$8GHGhjUb2kjr708NNsx/EeItZXvX51jlvLi29MO50so/s9qg7llNS', 'volunteer', '09164886647', 'No.57 Shafii road Tudun wada zaria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-20 11:52:55', '2025-12-20 11:52:55', NULL),
(68, 'Ismail Yusuf Olumoh', 'isholaowonikoko@gmail.com', NULL, '$2y$12$IgIVYbi2HBQa7pIJyGoUXuYxcK7RzWWJ9ZtUAJi33HqVOX2/9kKTq', 'volunteer', '+2349069513696', '10, Olumoh Compound, Akodudu Area.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-20 16:39:32', '2025-12-20 16:39:32', NULL),
(69, 'Ahmad Bashir', 'ahmadbashir3990@gmail.com', NULL, '$2y$12$wDmB3aKk77MQ1LW2XfUE.u/mZhOhvmdwEaxV1MBQ.pKV6AGGk1xFO', 'farmer', '+2347017831092', 'Bele, soba, kaduna', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-21 05:26:52', '2025-12-21 05:26:52', NULL),
(70, 'DVM.UMAR MUHAMMAD YUSHAU', 'yushauu411@gmail.com', NULL, '$2y$12$4VWeQ8YyzhS28kDmj5RAPO/y6nZeTuUpvpbxU20rp6iOl48m7hE5a', 'animal_health_professional', '+2348129137208', 'No. 18 madaki road gyallesu zaria\r\nNo. 18 madaki road gyallesu zaria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-21 06:19:21', '2025-12-21 06:19:21', NULL),
(71, 'Zakariya Idris', 'Zakariyaidriss7314@gmail.com', NULL, '$2y$12$r1tH25eziK3TQOwwK5u2heiUSlWbXJ386XNfPeOPaEsFxQeFFuQjW', 'volunteer', '+2348067427847', 'Nyanya quarters Damaturu, Yobe State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-21 07:32:09', '2025-12-21 07:32:09', NULL),
(72, 'Dr Arnold KUJE', 'kujearnold@gmail.com', NULL, '$2y$12$GymiZpc8iqg2uAlK1CHFMe8EHB/a9NeuSkperZDubJ8H8Ts7QN9qW', 'farmer', '+2348030820445', 'Kisahip, Bassa local government area, plateau state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-21 12:00:08', '2025-12-21 12:00:08', NULL),
(73, 'Zubairu Ibrahim Yahaya', 'yahayaibrahimzubairu@gmail.com', NULL, '$2y$12$SFBRR0tYFY8Y5BKWAq2I5.0zbPTTjkN8yWn/fWbhMeHMSVetPFzTK', 'farmer', '+2348135087372', 'W11 Dogon Bauchi Sabon Gari Zaria Kaduna State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-22 15:21:00', '2025-12-22 15:21:00', NULL),
(74, 'Dr Khadijah Dere', 'khadeemeedey@gmail.com', NULL, '$2y$12$ta4XsH4uHqcMzY1hvMfTCODq3o0eKTDdoVBJILHGhHAj8cYopDsku', 'animal_health_professional', '09038140619', '67 ifesowapo community, oke ogun, ilorin, kwara state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-22 16:39:07', '2025-12-22 16:39:07', NULL),
(75, 'Nura Muhammad Abdullahi', 'nuraabdullahi86@gmail.com', NULL, '$2y$12$zsz4NRa66bQ0vSa0C8ie7.ewxCNgNnzHNlmDefffOb6uD.AiLcF4C', 'farmer', '+2348067834240', '121C Tudun Wada, Dauda Alhamdu Street', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-22 21:38:53', '2025-12-22 21:38:53', NULL),
(76, 'Muhammed Mubaraq', 'muhammedmubaraq1960@gmail.com', NULL, '$2y$12$Iu.pgOzicwU3bxXmaSSfZeVc2MaMclTOxa2VmcKygDGvTT7nOPS8K', 'volunteer', '08169131094', 'No 18A Isokan community, along ikotun road offa kwara state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 05:24:51', '2025-12-23 05:24:51', NULL),
(77, 'Abdulazeez Oluwadamilola, IYIOLA', 'ayokunleabdulazeez@gmail.com', NULL, '$2y$12$1nLAHZDPyURsEAU6vzIaE.fN/24Kw5r6dQ5pEWIpMFKDUx7Pwrrca', 'volunteer', '+2348103154077', '12, Mustapha Osuolale Street, Ayobo, Ipaja ,Lagos State.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 17:32:18', '2025-12-23 17:32:18', NULL),
(78, 'Andrea Dooter Uvah', 'andreauvah@gmail.com', NULL, '$2y$12$asjPvY39u7O85W2RiuwyPOiP42/lVaayj18Lwwz5JRfj74dQUZ.Ky', 'volunteer', '09131985788', 'No 20 Benin Street Ankpa Wards Behind First Bank Wadata Makurdi Benue State\r\nSouth Core Joseph Sarwuan Tarka University Makurdi Benue State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 17:32:42', '2025-12-23 17:32:42', NULL),
(79, 'Dr. Mike_allison', 'ifeanyimikeallison1@gmail.com', NULL, '$2y$12$CT8LquMlMY.hzVM2VFBsx.yV5JmguhRP4niwsA09EhV2eI4X8tgDK', 'animal_health_professional', '07059552833', 'Akwakuma\r\nCom Road', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 17:35:02', '2025-12-23 17:35:02', NULL),
(80, 'Abubakar Abubakar Sayyadi', 'abubakarsayyadi456@gmail.com', NULL, '$2y$12$jctOvaeWUWz6T.a2sNfFDuR.UxsNeocvHyIW9yQKJJ/G56jVxr1aC', 'volunteer', '07044609974', 'ABU ZARIA, Kaduna State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 17:38:43', '2025-12-23 17:38:43', NULL),
(81, 'Jabir Zakariyya WUNTI', 'wuntizjr2004@gmail.com', NULL, '$2y$12$LCVauYL8Z21ZaDyAfLEkqu3pW8u93bvWy09qCX.Lxr/1SNBlo0c2q', 'volunteer', '07064723236', 'Zaria Kaduna state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 17:38:46', '2025-12-23 17:38:46', NULL),
(82, 'Hyelhira Zakka Shallangwa', 'zakkahyelhira@gmail.com', NULL, '$2y$12$AHEY5bC7E8cTU0MSD4WZVekc1x3gHapIW9Xo7JYcq1/jaECaDesCK', 'volunteer', '07049725222', '303 Housing estate, Maiduguri, Borno state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 17:39:09', '2025-12-23 17:39:09', NULL),
(83, 'Okehie Ifeanyi Mike-allison', 'imikeallison@gmail.com', NULL, '$2y$12$AlxxAn72jri1kDkVNpoHFuwumxQGmNdu7m5da6WbQIwGzW1NLwIhe', 'volunteer', '07059552833', 'Akwakuma\r\nCom Road', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 17:39:51', '2025-12-23 17:39:51', NULL),
(84, 'Ibrahim Hauwa\'u Jumare', 'hauwajumare24@gmail.com', NULL, '$2y$12$RdDse3/za412e.yy0WQFY.dkagiUFMuD.Ei8.FaF3.k7/RWUR7gB2', 'volunteer', '07048426491', 'GR 27 Barde road Barakallahu Rigachikun Kaduna', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 17:42:08', '2025-12-23 17:42:08', NULL),
(85, 'Aliyah Abdulmumini', 'mbaina17@gmail.com', NULL, '$2y$12$D8s4cl2UywV.swReptC02em/lcyvaMBv2OUj.M19zVncbKnGElFcS', 'volunteer', '+234 911 303 0659', 'No.2 Hayin Liman Road Zangon Shanu Zaria, Sabon Gari, Kaduna state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 17:49:29', '2025-12-23 17:49:29', NULL),
(86, 'Jamiu shukuralillah', 'jamiushukuralillah@gmail.com', NULL, '$2y$12$4Y7qVaaKB5X/V81nadp16eXvH7cIyOAwijSfKJ8o5U5GKMTwU4Fte', 'volunteer', '08151608232', 'No 37A, Alagbado area, Ilorin, Kwara state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 17:52:28', '2025-12-23 17:52:28', NULL),
(87, 'Ibrahim Jamiu Mohammed', 'ibrahimjamiu05@gmail.com', NULL, '$2y$12$.yuxTxSaT3D0Is8OJOLcie71AjCS7MT/gSXFLl3HQ.iNgn7PyxNiW', 'volunteer', '+2349080963080', 'Umuahia close, area 11 Garki Abuja.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 18:00:41', '2025-12-23 18:00:41', NULL),
(88, 'Chris Izumah', 'izumahchristian438@gmail.com', NULL, '$2y$12$v.THMGLt7eWrYvh/Jc6r2.r51tOv2jhVqcA8aFV8wgWeWG9xyerNS', 'volunteer', '+2347047734657', 'Sule Gora Street. Hayin Mallam, Zango-Shanu', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 18:05:38', '2025-12-23 18:05:38', NULL),
(89, 'Bashir Abdulsamiu Abdul', 'bashirabdulsamii@gmail.com', NULL, '$2y$12$X8cqEJA3f.CeUVVZUe0CkeahchhO9tT38XFNR2GH9p7nY7D7nxVEC', 'farmer', '+2348161788354', 'Jushin waje sabon gari zaria kaduna state Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 18:06:28', '2025-12-23 18:06:28', NULL),
(90, 'Abdulkadir solihat', 'solihatabdulkadir@gmail.com', NULL, '$2y$12$HWnTkytfIZc5Sz7x7OJ2je5mO01BcubpPF2E1omyfk60qiNl7ki1G', 'volunteer', '+2348160428844', 'Ilorin west, kwara state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 18:07:15', '2025-12-23 18:07:15', NULL),
(91, 'Muhammad Jamiu Habibat Oyiza', 'habeebat003@gmail.com', NULL, '$2y$12$TvOTU5G6tU.onrwlGFziYOJufAIzETajj0mXb3OX4rAGF645vnwYW', 'volunteer', '09161879191', 'Block K flat 3, Goshen court estate, Gbazango, kubwa Abuja.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 18:24:10', '2025-12-23 18:24:10', NULL),
(92, 'Philibus Dazi Choji', 'daziphilibus850@gmail.com', NULL, '$2y$12$3hzvA4pzyr1Xpe6R1deppuVeqpCWvPn925WW82pnJrSrNW7GJ99DC', 'volunteer', '09132965468', 'Jos South', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 18:26:11', '2025-12-23 18:26:11', NULL),
(93, 'Anthony Blessing Nnkiruka', 'nnkiruka2000@gmail.com', NULL, '$2y$12$iBvLy7X3ycexJCtSANN7JOWETkbzpScflM.ANH/7.iBPbuN2fg.IG', 'volunteer', '08079174780', 'Kaduna, Nigeria.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 18:37:22', '2025-12-23 18:37:22', NULL),
(94, 'Ralph Precious Chinaza', 'preciousralph2018@gmail.com', NULL, '$2y$12$nNAGGe0ixwCQL7HqkExbteXR/MkHlwkpWz6TyOVDO0uyLIT6xE/3.', 'volunteer', '+2349019223149', 'Oboni Ariam Usaka, Ikwuano, Abia', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 18:38:32', '2025-12-23 18:38:32', NULL),
(95, 'MOHAMMAD AHMED', 'ahmedanuna67@gmail.com', NULL, '$2y$12$IFUpFZNUTjRN1IPD3CNtc.3EU72oHpgjYkqioEWVD49e7i7jpj.sq', 'volunteer', '+2349118126004', 'Low Cost', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 18:45:07', '2025-12-23 18:45:07', NULL),
(96, 'Tajudeen Abdulazeez', 'tajudeenabdulazeez@yahoo.com', NULL, '$2y$12$TzRTvO8Viu5SNbdnUSj9cuH39981pQlpZlbTrISzStUBwVw.UZ7GW', 'volunteer', '+2349060991493', 'Samara zaria kaduna', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 18:54:57', '2025-12-23 18:54:57', NULL),
(97, 'Emmanuel Ononuju', 'ononujuemmanuelsomtochukwu@gmail.com', NULL, '$2y$12$VnL1TXhDFR/xQpsZoA8KGOOtQMgSk5nBHzVpckLwN1YXCO6YkXwDe', 'volunteer', '+2349133797682', 'JG79 Chollom street Apata', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 19:06:20', '2025-12-23 19:06:20', NULL),
(98, 'Samuel Miriam', 'samuelmiriam44@gmail.com', NULL, '$2y$12$kS0kINO2WQuBvmpiovx50.2e.VZenAccWcW7xrpIWVTKu0PO7PEW6', 'volunteer', '09120987215', 'Namua, Jos Plateau State Nigeria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 19:24:33', '2025-12-23 19:24:33', NULL),
(99, 'Ibrahim Adebanjo', 'ibrahimadebanjo283@gmail.com', NULL, '$2y$12$96hRMRkv0mGXtmEsdERm3eVSudiuPnOPXxjNPQSP116Bx3auD30Cu', 'volunteer', '08158310258', 'Ruga madaki, Nassarawa state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 20:02:10', '2025-12-23 20:02:10', NULL),
(100, 'Josephine Gogosaba Mamman', 'josephinemammangogosaba@gmail.com', NULL, '$2y$12$kGqUEgwDcDar.VGSrTgxCO6wPyCpwWekAdC73/Nrp/0gkc1Q9eEJi', 'volunteer', '08144884562', 'Shanu Village, Niger state.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 20:28:21', '2025-12-23 20:28:21', NULL),
(101, 'Khair Abdullahi', 'khairabdullahi@gmail.com', NULL, '$2y$12$NM.1sYb3D5EPgmhzEmXBC.w1kg97Ux9aSHc4yjRVWXiB0Y./xWpb.', 'volunteer', '+2348138241217', 'no50 Sokoto Road Samaru Zaria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 20:30:11', '2025-12-23 20:30:11', NULL),
(102, 'Josephine Gogosaba Mamman', 'josephinegogosabamamman@gmail.com', NULL, '$2y$12$.rJCPT6EY/zSAfysbzG93OhGwAruYrdYhTD78NFGl18lX/z4FxpiO', 'volunteer', '08144884562', 'Shanu village, Bosso, Niger State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-23 20:38:48', '2025-12-23 20:38:48', NULL),
(103, 'Ibrahim khaleel jibrin', 'jibrini518@gmail.com', NULL, '$2y$12$iwRB2bJBs1EKDeqYHbonFuOa6uKYNnq2WDQo9ZQTnrAbkZ5st7oTu', 'volunteer', '+2348174206335', 'Kaduna north, kaduna state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 04:52:18', '2025-12-24 04:52:18', NULL),
(104, 'Maruff Zainab Opeyemi', 'maruffzainab497@gmail.com', NULL, '$2y$12$rUVmxXur4XOIUac9xFXqeOTZqem7bWeZvn/sUWP.RaTl2KErtS37q', 'volunteer', '09059353634', 'No 21,Moboluwaduro street,Palupo area,asolo,Ibadan.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 06:59:55', '2025-12-24 06:59:55', NULL),
(105, 'Abdulaziz', 'withny2020@gmail.com', NULL, '$2y$12$/.nqs6ldaz4c/z.IqpvWuevT4pg3cD9RmdTyjF8EFykrqFNvLLvoC', 'volunteer', '09049149827', '10,Kazeem tiamiyu papa yahoo,Ibafo ogun state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 07:03:53', '2025-12-24 07:03:53', NULL),
(106, 'Umar Haruna Mohammed', 'harunaumar6768@gmail.com', NULL, '$2y$12$59rs7kDflmJXJkDPEknWv.KDnDAwo8uZw4xXBNWNb5FhX0XI//5uS', 'volunteer', '09167050275', 'Gbegabu Bosso LGA Minna, Niger state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 09:03:52', '2025-12-24 09:03:52', NULL),
(107, 'Yohanna Jacinta Awuniya', 'jacintayohanna433@gmail.com', NULL, '$2y$12$nXgJe/f5/Y.XnMIDBNS2we2yCReQXMvXoRmpTVBEa0Lv4BNNgZ6t6', 'volunteer', '08107953959', 'Zango kataf', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 09:17:10', '2025-12-24 09:17:10', NULL),
(108, 'Silas Cynthia', 'silascynthia64@gmail.com', NULL, '$2y$12$lIk.8P8iARCaYegImILwtuMjZBe5rfx/MOsjaAZeiEHz.BayDWo4C', 'volunteer', '07042868157', 'Palladan zaria, Kaduna state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 09:17:52', '2025-12-24 09:17:52', NULL),
(109, 'Praise Chikwesiri Targema', 'praisetargema@gmail.com', NULL, '$2y$12$QmSlD0o701FY7Gfs0yy0X.DVbscVmwfTis81E84y0PzeS7JKVbdW6', 'volunteer', '+2349124274359', '14 Atii street Tyowanye, Buruku, Benue state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 09:21:26', '2025-12-24 09:21:26', NULL),
(110, 'AKINGBADE Abdullahi Abiola', 'abiolaabdullahi4@gmail.com', NULL, '$2y$12$pLR8Gi67Sph/GU5M4g6KBuXiFXGo2jBKCT0QKc/MOGyWDLnkCSgB6', 'volunteer', '+2347062383567', 'Amuloko, Ibadan, Oyo state.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 09:35:25', '2025-12-24 09:35:25', NULL),
(111, 'Mariam Iyiola', 'iyiolamariam114@gmail.com', NULL, '$2y$12$EF.XEcxmNcRcRKid3r0Bo.PzOHAMZr0FskeyGEgSes6AkQmmq9IWy', 'volunteer', '+2347061605868', 'Bob h, gwagwalada', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 09:40:47', '2025-12-24 09:40:47', NULL),
(112, 'Chinaza Loveth Nwani', 'chinaza.nwani.244384@unn.edu.ng', NULL, '$2y$12$nQ/KSXd/bPyDgfrojGFHWutm/R.b253gJdN669XxxfedhFeRJN2xe', 'volunteer', '+2348128952543', 'University of Nigeria Nsukka, Enugu State.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:16:57', '2025-12-24 11:16:57', NULL),
(113, 'Yahaya Abdulkarim', 'yahayaabdulkarim087@gmail.com', NULL, '$2y$12$Qs0IfJ33NjBWreNSQwyyzugvO1xiySOP6Y2/6Qv64aKppEyNxoGtq', 'volunteer', '+2348125024597', 'Chad basin\r\nMaiduguri', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:21:44', '2025-12-24 11:21:44', NULL),
(114, 'Abdulrahman Muhammad usman', 'abbatitilde123@gmail.com', NULL, '$2y$12$ZIskBPcODMh7/Ca1uqfW/OzAuxqv1LykcqjJ2Noq4vAMABPz8ktw2', 'farmer', '09037719811', 'Ganjuwa local government', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:21:49', '2025-12-24 11:21:49', NULL),
(115, 'Joy Otohan', 'joyootohan@gmail.com', NULL, '$2y$12$VwBqRi84ZqA9HVFYWtJFJ.odEAmwuYhFiDtgnTCiHAFliS4YW4arS', 'volunteer', '+2348120790200', 'Kurna Asabe', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:27:00', '2025-12-24 11:27:00', NULL),
(116, 'Khalifa Abubakar Ibrahim', 'khalifaabubakar042@gmail.com', NULL, '$2y$12$fROIcgmx4hdJv4MzIB9fPenNpPElPg1RBtWkXqyyvLYX1ImzVFooy', 'farmer', '08128233234', 'Lamido Street yola', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:41:28', '2025-12-24 11:41:28', NULL),
(117, 'Ogunrinola Oluwabusolami Araola', 'araolaog@gmail.com', NULL, '$2y$12$gmgWafWvJzP7icbt6Me9a.62hA6hK0evUJ.aVi6VLKp2bccu791My', 'volunteer', '+2348112451753', 'Opic Estate,Agbara, Ogun State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:42:00', '2025-12-24 11:42:00', NULL),
(118, 'Okesiji Zaynab Arike', 'okesijiz@gmail.com', NULL, '$2y$12$LbucDLs6IoWkVukFNYaRv.hptoWPqhTEDloRJKSJkSrblIpDRKoxi', 'volunteer', '+2348128039027', 'Along Coca-cola Road, Ojuore Bustop, Sango Otta, Ogun state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:46:55', '2025-12-24 11:46:55', NULL),
(119, 'Ibrahim Muhammad Ali', 'ibrahimmuhd3435@gmail.com', NULL, '$2y$12$AiTxH.xPJQZLeLy9TO2S0.kZHuPrvkWqa7zRFrPPnC0aP68bLZxEK', 'farmer', '07037824410', 'Kwajffa,, Hawul, Borno state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:47:46', '2025-12-24 11:47:46', NULL),
(120, 'Sakariyah Abdulhazeem', 'sakariyahabdulhazeem@gmail.com', NULL, '$2y$12$8c.OCwiUNFqvXejtHPFPkey2pCNtsQ8Gcq4OjF6DAYvdJdePC49Ny', 'animal_health_professional', '+2349065165097', '144, kuntu ilorin, 5, Aljanat str, ilorin kwara state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:52:36', '2025-12-24 11:52:36', NULL),
(121, 'Margaret', 'Margaretkaidal@gmail.com', NULL, '$2y$12$FzI3t6M7qcOyGzxcxmkEueHfVyKhHfV1Qc2/lxLI.CmddvBHhnj0W', 'volunteer', '08105672341', 'Shagari phase 2 yola town Adamawa stste', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:53:37', '2025-12-24 11:53:37', NULL),
(122, 'Umoru Moris', 'morisumoru26@gmail.com', NULL, '$2y$12$Rz/HRKG1BJn1SK/Fk5uHkeUbJmTqc4tN2fbSRvQ8wgb6r7rj2Rdsa', 'farmer', '+2347068670110', 'usmanti opposite galtimari primary school\r\nusmanti opposite galtimari primary school', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 12:06:40', '2025-12-24 12:06:40', NULL),
(123, 'Aliyu Salihu Shettima', 'Aliyusalihushettima2019@gmail.com', NULL, '$2y$12$HaJsmoUYuNrat3Brmhf0rubweWJMHpQP/qqgT4O676akoQupgent.', 'volunteer', '08120109969', 'Giwa Barracks,Maiduguri, Borno State.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 12:18:42', '2025-12-24 12:18:42', NULL),
(124, 'Ibrahim Muhammad', 'ibrahimmuhamma51@gmail.com', NULL, '$2y$12$ulVOEzkx8ujOCAmc6ArokeDhYyLo0tTVxPWUEMLs2RNvxyFHYhpEa', 'volunteer', '09037553097', 'Gombole roads Giwa Barracks Maiduguri Borno state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 12:19:49', '2025-12-24 12:19:49', NULL),
(125, 'Joshua Ayodeji Oyekanmi', 'joshuaoyekanmi99@gmail.com', NULL, '$2y$12$doxdfXYR7X5vbj6p.XGVJO6gr5FJwS2/zAI7eZ3K.gdOVbbFn/EVe', 'volunteer', '+2348157418869', 'University of abuja', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 12:37:34', '2025-12-24 12:37:34', NULL),
(126, 'Chukwuma Solomon uchechukwu', 'chukwumastephen393@gmail.com', NULL, '$2y$12$fMKS78IwOZKCdJzN.NjQgeyrkQUnV5Ndjft3mlczV9IXVLpW4dFQa', 'volunteer', '09059393643', 'Abia state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 12:41:49', '2025-12-24 12:41:49', NULL),
(127, 'Abdulwahab Bala', 'abdulwahabbala123@gmail.com', NULL, '$2y$12$mgqUrQjG1gHQKyH1AxoZ8OJ1x3syxCIeUbqv9w3U0CFoFBnc.CicO', 'volunteer', '+2348108184848', 'Yelwa', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 12:58:19', '2025-12-24 12:58:19', NULL),
(128, 'Vallita Jesse Balla', 'vallitajesse7@gmail.com', NULL, '$2y$12$NwIfhUcxQ5u6VXzpfUgIle2emRkj.VyfAfgrqlnlbMkagEC7PBJy2', 'volunteer', '+2348035768626', 'University of Maiduguri, Maiduguri, Borno state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 13:31:02', '2025-12-24 13:31:02', NULL),
(129, 'Fatima Adebisi Tajudeen', 'tajudeenfatima77@gmail.com', NULL, '$2y$12$eQDkL0LTNBN8g65N.smejeMbf6PqfFBmKaH256qYDLXu3GOfIwm0K', 'volunteer', '08162769812', 'No, 11 Hong Street Karewa Extension \r\nJimeta,Yola Adamawa state.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 15:19:19', '2025-12-24 15:19:19', NULL),
(130, 'Galadima Nanpon Timothy', 'heraogwudu@gmail.com', NULL, '$2y$12$wqYem1DePLC0oVZZAXJm0.pTyZhZL8lz/MVKMVgM2ydErAFAKCgde', 'farmer', '+234-07068756432', 'Kufang, Jos South, Plateau state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 15:58:37', '2025-12-24 15:58:37', NULL),
(131, 'Akinyemi Bimbo Barakat', 'akinyemibimbo398@gmail.com', NULL, '$2y$12$u2e2dw51whkDNRs27qYCae3n1NLX1GY.pIr4z0o1/64.O0jT4Xlxy', 'volunteer', '+2348036416437', '2, Zone B, Surulere Okelookoole, Iyana Àgbàlá, Ona Ara Local Government, Oyo state.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 16:04:08', '2025-12-24 16:04:08', NULL),
(132, 'Babagoni Alh Modu', 'babagonialhmodu0019@gmail.com', NULL, '$2y$12$AQuZWLuC/8cfWTapXCQFP.ZCbh1C7t1JlyEoD1adaqZaK34DLtOQW', 'volunteer', '+2348035137045', 'Bolori layout, Maiduguri, Borno State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 19:28:45', '2025-12-24 19:28:45', NULL),
(133, 'Audu Sani', 'absan715@gmail.com', NULL, '$2y$12$3YFf5HUyweQNoIP.653v0.0xulhT4EgaFEgTYOzPFKnymctqJ3D56', 'volunteer', '08063766329', 'Zonal livestock office, Nguru Yobe State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 20:55:37', '2025-12-24 20:55:37', NULL),
(134, 'Abdulwahab Muhammad Karumi', 'amkarumi001@gmail.com', NULL, '$2y$12$MUsOuqT3w/hrLRImW08RxOVcSHINEadvavzb3EXaFr8NSWcdMwcF2', 'volunteer', '+2349011319444', 'Gomari Bus Stop', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 21:35:50', '2025-12-24 21:35:50', NULL),
(135, 'Nimatallah Gurumoh IBRAHIM', 'ibrahimnimatallahgurumoh@gmail.com', NULL, '$2y$12$5MXJIqacJT4leZ7idLr81e1rF1Q3r7QhGYrwLexrsFvFGyhYFSIDS', 'volunteer', '07073572422', '10, Koro Gurumoh, Ilorin, Kwara state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 22:10:32', '2025-12-24 22:10:32', NULL),
(136, 'Joseph Torkuma Japeh', 'josephjaps1@gmail.com', NULL, '$2y$12$QS8RA7bMyNeYJcKdxeLIV.ufhUA7oKvGRmOl9sJViQOJ9UeQqM4h2', 'volunteer', '090565247933', 'No 23 Behind Salvation ministries off iorchiya Ayu Road, Wurukum, Makurdi', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 23:32:46', '2025-12-24 23:32:46', NULL),
(137, 'Dr Precious Ojogbede', 'pojogbede@gmail.com', NULL, '$2y$12$aL2PjeWe/yIFOPr3zTQSauoJUBIJknUoMZXUE1QZ5H/7iDrtIVmua', 'animal_health_professional', '+2348147294619', '1, Corper’s close, Badawa Layout, Kano State', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 23:33:50', '2025-12-24 23:33:50', NULL),
(138, 'Zakariyyah Abdulsalam', 'abdulsalamzakariyyah@gmail.com', NULL, '$2y$12$KPDM8cjZXbGrcV588XcZ7.i3MqxBHhoJVlRmeETuX3.G5tHpl.X32', 'volunteer', '07063361644', 'No_27 Bomo road Samaru Zaria', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-24 23:40:11', '2025-12-24 23:40:11', NULL),
(139, 'Aisha Muhammad Sambo', 'muhammadaishasambo42@gmail.com', NULL, '$2y$12$kfxm3DmmOclXFLptJJJbKOZRcscZpnHWxtMUwcLt080ic3c14EP.6', 'volunteer', '07067534871', 'Samaru,Sabon gari,kaduna state', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-25 05:14:34', '2025-12-25 05:14:34', NULL),
(140, 'Abdulmumin Yusrah Eniola', 'abdulmuminyusroh@gmail.com', NULL, '$2y$12$MjbR4EsMzh1rnWsSKuqgM.q8npSwe0WgFLNg0QI7dWltBhUcdVeum', 'volunteer', '08145193670', 'Gra, Oyun, Orisunbare, off old jebba road, Ilorin, Kwara state.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-25 07:59:40', '2025-12-25 07:59:40', NULL),
(141, 'DR. KAYODE FEMI', 'kayodementoring@gmail.com', NULL, '$2y$12$hROIK/Blt5LYBDM8mR/w9e4ZKOUQ5/LUOdYz/6SuwzjRnjbY8yfsi', 'animal_health_professional', '08168008052', 'FCT, Abuja', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-25 10:52:31', '2025-12-25 10:52:31', NULL),
(142, 'SABIU Amina', 'sabiuamina1@gmail.com', NULL, '$2y$12$gi/PcOPG7EX9d6g9v.l0XeOJQr3He.lz1A76vDc.NHQ.Rxd7TqWl6', 'volunteer', '07082365053', 'No. 12b unguwan liman, Zaria city.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-25 15:37:44', '2025-12-25 15:37:44', NULL),
(143, 'Asika Onyekachi Augustine', 'asikaaustine@gmail.com', NULL, '$2y$12$bqmlKA4mFsd1xpN9psnRSuB.9jCvYTD80VIe41daNTfo4VfED.VBK', 'animal_health_professional', '+2348102097767', 'Okada Park, Dogon Gada By Efab City Estate, Lokogoma', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-25 21:18:59', '2025-12-25 21:18:59', NULL),
(144, 'Patience Joshua Bwala', 'pjbwala2019@gmail.com', NULL, '$2y$12$iSWYehP7oeGvmzO.y8nPVOta5Dkfci/8yGAzn.UUxC2pzv.jCxoX2', 'volunteer', '+2347083573339', 'Kushari ward, behind CBN Quarters. Maiduguri, Borno state.', NULL, NULL, 'Nigeria', 'active', 1, NULL, NULL, NULL, NULL, NULL, '2025-12-25 21:56:43', '2025-12-25 21:56:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_history`
--

CREATE TABLE `vaccination_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `livestock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `farm_record_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `recorded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `livestock_type` varchar(255) DEFAULT NULL,
  `number_of_animals` int(11) NOT NULL DEFAULT 1,
  `vaccine_name` varchar(255) NOT NULL,
  `vaccine_type` varchar(255) DEFAULT NULL,
  `disease_target` varchar(255) DEFAULT NULL,
  `vaccine_description` text DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `batch_number` varchar(255) DEFAULT NULL,
  `lot_number` varchar(255) DEFAULT NULL,
  `manufacture_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `vaccination_date` date NOT NULL,
  `administered_by` varchar(255) DEFAULT NULL,
  `next_vaccination_date` date DEFAULT NULL,
  `vaccination_time` time DEFAULT NULL,
  `administration_route` enum('intramuscular','subcutaneous','intranasal','oral','intravenous','other') DEFAULT NULL,
  `injection_site` varchar(255) DEFAULT NULL,
  `dosage` decimal(8,2) DEFAULT NULL,
  `dosage_unit` varchar(255) NOT NULL DEFAULT 'ml',
  `veterinarian_name` varchar(255) DEFAULT NULL,
  `veterinarian_license` varchar(255) DEFAULT NULL,
  `veterinarian_phone` varchar(255) DEFAULT NULL,
  `administrator_name` varchar(255) DEFAULT NULL,
  `administrator_type` enum('veterinarian','vet_technician','farmer','data_collector','other') DEFAULT NULL,
  `is_initial_dose` tinyint(1) NOT NULL DEFAULT 1,
  `is_booster` tinyint(1) NOT NULL DEFAULT 0,
  `dose_number` int(11) NOT NULL DEFAULT 1,
  `total_doses_required` int(11) NOT NULL DEFAULT 1,
  `next_dose_due_date` date DEFAULT NULL,
  `next_booster_due_date` date DEFAULT NULL,
  `booster_interval_days` int(11) DEFAULT NULL,
  `vaccine_cost` decimal(10,2) DEFAULT NULL,
  `administration_cost` decimal(10,2) DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'NGN',
  `payment_method` varchar(255) DEFAULT NULL,
  `pre_vaccination_health` text DEFAULT NULL,
  `pre_vaccination_temperature` decimal(5,2) DEFAULT NULL,
  `post_vaccination_observation` text DEFAULT NULL,
  `post_vaccination_temperature` decimal(5,2) DEFAULT NULL,
  `adverse_reaction` tinyint(1) NOT NULL DEFAULT 0,
  `reaction_severity` enum('none','mild','moderate','severe') NOT NULL DEFAULT 'none',
  `reaction_symptoms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`reaction_symptoms`)),
  `reaction_notes` text DEFAULT NULL,
  `reaction_start_date` date DEFAULT NULL,
  `reaction_resolution_date` date DEFAULT NULL,
  `reaction_reported` tinyint(1) NOT NULL DEFAULT 0,
  `requires_followup` tinyint(1) NOT NULL DEFAULT 0,
  `followup_date` date DEFAULT NULL,
  `followup_notes` text DEFAULT NULL,
  `followup_completed` tinyint(1) NOT NULL DEFAULT 0,
  `certificate_number` varchar(255) DEFAULT NULL,
  `documents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`documents`)),
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `vaccination_location` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `campaign_name` varchar(255) DEFAULT NULL,
  `program_sponsor` varchar(255) DEFAULT NULL,
  `is_government_program` tinyint(1) NOT NULL DEFAULT 0,
  `is_subsidized` tinyint(1) NOT NULL DEFAULT 0,
  `subsidy_amount` decimal(10,2) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verification_notes` text DEFAULT NULL,
  `status` enum('scheduled','completed','missed','cancelled') NOT NULL DEFAULT 'completed',
  `status_notes` text DEFAULT NULL,
  `reminder_sent` tinyint(1) NOT NULL DEFAULT 0,
  `reminder_sent_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `custom_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom_fields`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verification_documents`
--

CREATE TABLE `verification_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `data_collector_profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `document_type` varchar(255) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `document_number` varchar(255) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `issuing_authority` varchar(255) DEFAULT NULL,
  `verification_status` enum('pending','verified','rejected','expired') NOT NULL DEFAULT 'pending',
  `verification_notes` text DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `category` enum('identification','educational','professional','authorization','reference','other') NOT NULL DEFAULT 'other',
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `is_visible_to_admin` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `assigned_area` varchar(255) DEFAULT NULL,
  `motivation` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `availability` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `farmers_enrolled` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `user_id`, `organization`, `assigned_area`, `motivation`, `status`, `availability`, `contact_phone`, `contact_email`, `farmers_enrolled`, `is_active`, `approval_status`, `approved_by`, `approved_at`, `submitted_at`, `notes`, `created_at`, `updated_at`) VALUES
(1, 7, 'Community Development NGO', NULL, 'Want to help local farmers improve their livestock health.', 'active', 'Weekends', NULL, NULL, 1, 1, 'approved', NULL, NULL, NULL, NULL, '2025-12-14 22:00:47', '2025-12-15 05:00:10'),
(2, 28, NULL, 'Sabon gari LGA, Kaduna state', 'I want to help farmers because healthy animal are essential for food security, livelihoods, and rural development. As a veterinary student, working directly with farmers allow me to apply my knowledge in real life settings while learning from local practice and challenges by educating farmers on diseases prevention, nutrition, and animal welfare.', 'active', NULL, '08100083226', 'garbausman2324@gmail.com', 0, 1, 'approved', NULL, '2025-12-16 18:23:04', '2025-12-16 18:23:04', NULL, '2025-12-16 18:23:04', '2025-12-16 18:23:04'),
(3, 33, 'Faculty of Veterinary Medicine, Ahmadu Bello University, Zaria', 'Zaria, Kaduna State', 'As a soon-to-be animal health care professional, I want to get access to all the knowledge.', 'active', NULL, '+2348056354613', 'yomidele4@gmail.com', 0, 1, 'approved', NULL, '2025-12-19 12:55:36', '2025-12-19 12:55:36', NULL, '2025-12-19 12:55:36', '2025-12-19 12:55:36'),
(4, 36, NULL, 'Zaria, kaduna', 'Because I wish to better myself and improve my community and nation as a whole', 'active', NULL, '08167386460', 'tayokazeem185@gmail.com', 0, 1, 'approved', NULL, '2025-12-19 13:15:52', '2025-12-19 13:15:52', NULL, '2025-12-19 13:15:52', '2025-12-19 13:15:52'),
(5, 39, 'university of Jos', 'mararaba, masaka', 'to ensure professionalism and skills to the farmers in producing quality and healthy farm products', 'active', NULL, '09163440118', 'kallojoshua9@gmail.com', 0, 1, 'approved', NULL, '2025-12-19 13:30:38', '2025-12-19 13:30:38', NULL, '2025-12-19 13:30:38', '2025-12-19 13:30:38'),
(6, 46, 'Beevet Agro consult', NULL, 'I want to support livestock disease surveillance and vaccine-based prevention while gaining hands-on One Health experience.', 'active', NULL, '+2348062067507', 'habibusman64@gmail.com', 0, 1, 'approved', NULL, '2025-12-19 15:36:58', '2025-12-19 15:36:58', NULL, '2025-12-19 15:36:58', '2025-12-19 15:36:58'),
(7, 52, 'Kebbi Youth Progressive Forum', 'Birnin kebbi Metropolice', 'I\'m passionate about herd health, by making positive inputs like this can make a long way in improving herd health', 'active', NULL, '+2348065235504', 'yusufmkabir@gmail.com', 0, 1, 'approved', NULL, '2025-12-19 17:52:25', '2025-12-19 17:52:25', NULL, '2025-12-19 17:52:25', '2025-12-19 17:52:25'),
(8, 54, 'Community leader', 'Jalingo Taraba State', 'I\'m so enthusiastic about livestock business with some level of knowledge. People are around my community are not well educated about the livestock production in a good way to have a better yield. I will like to acquire more knowledge that I can easily teach to help update and increase their production and also help encourage others that are not interested in the livestock business.', 'active', NULL, '07089291196', 'reubenmatthewyensam2021@gmail.com', 0, 1, 'approved', NULL, '2025-12-19 20:47:02', '2025-12-19 20:47:02', NULL, '2025-12-19 20:47:02', '2025-12-19 20:47:02'),
(9, 59, 'ioVetConsultz', 'Ilorin, Kwara State', 'To broadcast outbreaks of diseases and to enroll livestock farmers in my area so they can get quick access to vaccine as and when due.', 'active', NULL, '08148561957', 'yibrahimolamilekan@gmail.com', 0, 1, 'approved', NULL, '2025-12-20 02:57:24', '2025-12-20 02:57:24', NULL, '2025-12-20 02:57:24', '2025-12-20 02:57:24'),
(10, 61, 'ABU Zaria', 'Zaria city', 'Because I am Vet. Student', 'active', NULL, '+2349039189177', 'ibrahimbadamasi2002@gmail.com', 0, 1, 'approved', NULL, '2025-12-20 04:49:05', '2025-12-20 04:49:05', NULL, '2025-12-20 04:49:05', '2025-12-20 04:49:05'),
(11, 66, 'B2 veterinary Services', 'Adamawa', 'It gives me joy to see myself solving problems, especially in my Community', 'active', NULL, '+2348108433843', 'Bethuellynn@gmail.com', 0, 1, 'approved', NULL, '2025-12-20 10:39:19', '2025-12-20 10:39:19', NULL, '2025-12-20 10:39:19', '2025-12-20 10:39:19'),
(12, 67, 'Student', 'Zaria', 'To help farmers in my area to gain access to quality veterinary care and enlighten them on the emerging trends in livestock care and production like AI and other areas', 'active', NULL, '09164886647', 'muhammadshehuabubakar15@gmail.com', 0, 1, 'approved', NULL, '2025-12-20 11:52:55', '2025-12-20 11:52:55', NULL, '2025-12-20 11:52:55', '2025-12-20 11:52:55'),
(13, 68, 'Faculty of Veterinary Medicine in the University of Maiduguri', 'Maiduguri, Borno State. And Ilorin, Kwara State.', 'Being a veterinary Medical Student, I am excited to volunteer with Farm Alert because I would love to help protect animals and support local communities in Nigeria through livestock health and outbreak prevention. I am also mostly passionate about making a difference in community development, and this platform seems like a great way to contribute. I would enjoy enrolling farmers, spreading awareness, and tracking the impact of my efforts.', 'active', NULL, '+2349069513696', 'isholaowonikoko@gmail.com', 0, 1, 'approved', NULL, '2025-12-20 16:39:32', '2025-12-20 16:39:32', NULL, '2025-12-20 16:39:32', '2025-12-20 16:39:32'),
(14, 71, 'Self employed', 'Damaturu', 'To help in sensitizing our community farmer  in disease control and vaccines with accurate record keeping in their farms', 'active', NULL, '+2348067427847', 'Zakariyaidriss7314@gmail.com', 0, 1, 'approved', NULL, '2025-12-21 07:32:09', '2025-12-21 07:32:09', NULL, '2025-12-21 07:32:09', '2025-12-21 07:32:09'),
(15, 76, 'Farm alert leadership and enterprise network', 'Kaduna', 'I want to enroll farmers so they can receive outbreaks alert as fast as possible', 'active', NULL, '08169131094', 'muhammedmubaraq1960@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 05:24:51', '2025-12-23 05:24:51', NULL, '2025-12-23 05:24:51', '2025-12-23 05:24:51'),
(16, 77, 'Ahmadu Bello university', 'Lagos', 'To assist is getting statistical data on vaccination records among livestocks.', 'active', NULL, '+2348103154077', 'ayokunleabdulazeez@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 17:32:18', '2025-12-23 17:32:18', NULL, '2025-12-23 17:32:18', '2025-12-23 17:32:18'),
(17, 78, 'Joseph Sarwuan Tarka University Makurdi Benue State', 'Makurdi', 'To enlighten them on animal care and maintenance', 'active', NULL, '09131985788', 'andreauvah@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 17:32:42', '2025-12-23 17:32:42', NULL, '2025-12-23 17:32:42', '2025-12-23 17:32:42'),
(18, 80, 'IVSA ABU ZARIA', 'Samaru', 'Improve agricultural production', 'active', NULL, '07044609974', 'abubakarsayyadi456@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 17:38:43', '2025-12-23 17:38:43', NULL, '2025-12-23 17:38:43', '2025-12-23 17:38:43'),
(19, 81, 'Ahmadu Bello University zaria', 'Zaria', 'I have a complete trust in your activities. Being part of farm alart campus tour was fantastic', 'active', NULL, '07064723236', 'wuntizjr2004@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 17:38:46', '2025-12-23 17:38:46', NULL, '2025-12-23 17:38:46', '2025-12-23 17:38:46'),
(20, 82, 'University of Maiduguri', 'Maiduguri borno State', 'I am eager to volunteer with Farmalert because of its commitment to supporting farmers through innovation, education, and access to quality animal-health solutions. With my background and interest in veterinary science and community engagement, I see this opportunity as a platform to serve, learn, and contribute to improving livestock health and farmer livelihoods. I am motivated by Farmalert’s mission to empower farmers with timely, reliable information and practical solutions.', 'active', NULL, '07049725222', 'zakkahyelhira@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 17:39:09', '2025-12-23 17:39:09', NULL, '2025-12-23 17:39:09', '2025-12-23 17:39:09'),
(21, 83, 'Community development', 'Abuja Fct', 'It is not just about helping but also to have new learning experience', 'active', NULL, '07059552833', 'imikeallison@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 17:39:51', '2025-12-23 17:39:51', NULL, '2025-12-23 17:39:51', '2025-12-23 17:39:51'),
(22, 84, 'FALEN ABU', 'Kaduna', 'I want to volunteer because I enjoy helping people and animals. Supporting farmers means helping the whole community, and I’d love to be part of that', 'active', NULL, '07048426491', 'hauwajumare24@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 17:42:08', '2025-12-23 17:42:08', NULL, '2025-12-23 17:42:08', '2025-12-23 17:42:08'),
(23, 85, 'Ahmadu Bello University', 'Zaria, Kaduna', 'As a veterinary student, I am deeply passionate about One Health, animal safety, and advocacy. I believe that the health of animals, humans, and the environment are closely connected, and supporting farmers is a vital part of that balance. I would love to actively participate in shaping the future of farming in my community by promoting better animal welfare, sustainable practices, and informed decision making that benefits both farmers and society at large.', 'active', NULL, '+234 911 303 0659', 'mbaina17@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 17:49:29', '2025-12-23 17:49:29', NULL, '2025-12-23 17:49:29', '2025-12-23 17:49:29'),
(24, 86, NULL, 'Ilorin, Kwara state', 'To help spread awareness', 'active', NULL, '08151608232', 'jamiushukuralillah@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 17:52:28', '2025-12-23 17:52:28', NULL, '2025-12-23 17:52:28', '2025-12-23 17:52:28'),
(25, 87, 'Farm alert leadership and enterprise.', 'Garki, Abuja.', 'To be a part of livestock improvement, to gain knowledge and experience in the process too.', 'active', NULL, '+2349080963080', 'ibrahimjamiu05@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 18:00:41', '2025-12-23 18:00:41', NULL, '2025-12-23 18:00:41', '2025-12-23 18:00:41'),
(26, 88, NULL, 'Zaria, Kaduna state', 'I am interested in helping farmers because they play a critical role in food security, economic growth, and community development, yet many face persistent challenges such as limited access to quality inputs, finance, markets, and modern farming knowledge. Supporting farmers improves productivity, income stability, and resilience to climate and market shocks. From an agribusiness perspective, empowered farmers create more reliable supply chains, better-quality produce, and sustainable market growth', 'active', NULL, '+2347047734657', 'izumahchristian438@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 18:05:38', '2025-12-23 18:05:38', NULL, '2025-12-23 18:05:38', '2025-12-23 18:05:38'),
(27, 90, NULL, 'Ilorin west', 'Anything that helps the  community to grow should be done without doubt but sincerely. I belief', 'active', NULL, '+2348160428844', 'solihatabdulkadir@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 18:07:15', '2025-12-23 18:07:15', NULL, '2025-12-23 18:07:15', '2025-12-23 18:07:15'),
(28, 91, NULL, 'AMAC', 'To help enhance animals\' health and humanity', 'active', NULL, '09161879191', 'habeebat003@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 18:24:10', '2025-12-23 18:24:10', NULL, '2025-12-23 18:24:10', '2025-12-23 18:24:10'),
(29, 92, 'Nil', 'Jos', 'To know how the system works', 'active', NULL, '09132965468', 'daziphilibus850@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 18:26:11', '2025-12-23 18:26:11', NULL, '2025-12-23 18:26:11', '2025-12-23 18:26:11'),
(30, 93, NULL, 'Goningora, kaduna.', 'To be a part of the mission the organization have towards improving farmers and my community at large.', 'active', NULL, '08079174780', 'nnkiruka2000@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 18:37:22', '2025-12-23 18:37:22', NULL, '2025-12-23 18:37:22', '2025-12-23 18:37:22'),
(31, 94, NULL, 'Enroll farmers to the platform', 'I see the way farmers toil and struggle each day to make proceeds, and I want them to be updated especially on outbreaks', 'active', NULL, '+2349019223149', 'preciousralph2018@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 18:38:32', '2025-12-23 18:38:32', NULL, '2025-12-23 18:38:32', '2025-12-23 18:38:32'),
(32, 95, 'University of Maiduguri', 'Gaidam Local Government Yobe State', 'I want to contribute to food security, learning about farming,', 'active', NULL, '+2349118126004', 'ahmedanuna67@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 18:45:07', '2025-12-23 18:45:07', NULL, '2025-12-23 18:45:07', '2025-12-23 18:45:07'),
(33, 96, NULL, 'Samaru', 'To help get into Farming,', 'active', NULL, '+2349060991493', 'tajudeenabdulazeez@yahoo.com', 0, 1, 'approved', NULL, '2025-12-23 18:54:57', '2025-12-23 18:54:57', NULL, '2025-12-23 18:54:57', '2025-12-23 18:54:57'),
(34, 97, 'Veterinary student UNIJOS', 'Jos north, Plateau state', 'To help impact knowledge about zoonotic diseases and also create awareness about AMR', 'active', NULL, '+2349133797682', 'ononujuemmanuelsomtochukwu@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 19:06:20', '2025-12-23 19:06:20', NULL, '2025-12-23 19:06:20', '2025-12-23 19:06:20'),
(35, 98, NULL, NULL, 'So I could contribute', 'active', NULL, '09120987215', 'samuelmiriam44@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 19:24:33', '2025-12-23 19:24:33', NULL, '2025-12-23 19:24:33', '2025-12-23 19:24:33'),
(36, 99, NULL, 'Zaria, Kaduna', 'I want to volunteer because am a vet student and I am passionate about livestock wellbeing and how I can serve the nation with my profession.', 'active', NULL, '08158310258', 'ibrahimadebanjo283@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 20:02:10', '2025-12-23 20:02:10', NULL, '2025-12-23 20:02:10', '2025-12-23 20:02:10'),
(37, 100, 'University of Ilorin student', 'Ilorin, Kwara State', 'As an undergraduate student of the Veterinary medicine profession, I have the desire and passion to use my profession as a means to help spread one health for the Betterment of my community and the world at large.', 'active', NULL, '08144884562', 'josephinemammangogosaba@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 20:28:21', '2025-12-23 20:28:21', NULL, '2025-12-23 20:28:21', '2025-12-23 20:28:21'),
(38, 101, NULL, 'Zaria, Kaduna', 'I love to volunteer because there is always something to learn and develop yourself in volunteering', 'active', NULL, '+2348138241217', 'khairabdullahi@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 20:30:11', '2025-12-23 20:30:11', NULL, '2025-12-23 20:30:11', '2025-12-23 20:30:11'),
(39, 102, 'University of Ilorin student', 'Ilorin, Kwara State', 'As an undergraduate student of the Veterinary Medical profession, I have developed a passion and desire to advocate for One Health and help improve the health of my community and by extension, Global health.', 'active', NULL, '08144884562', 'josephinegogosabamamman@gmail.com', 0, 1, 'approved', NULL, '2025-12-23 20:38:48', '2025-12-23 20:38:48', NULL, '2025-12-23 20:38:48', '2025-12-23 20:38:48'),
(40, 103, 'FALEN ABU zaria', 'Zaria', 'To help achieve farmalerts goal of registering 2M farmers nationwide', 'active', NULL, '+2348174206335', 'jibrini518@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 04:52:18', '2025-12-24 04:52:18', NULL, '2025-12-24 04:52:18', '2025-12-24 04:52:18'),
(41, 104, NULL, 'Ilorin/Ibadan', 'As a veterinary student, volunteering with FarmVax will help me apply what I’m learning in real farm settings while supporting vaccination, animal welfare, and sustainable livestock health.', 'active', NULL, '09059353634', 'maruffzainab497@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 06:59:55', '2025-12-24 06:59:55', NULL, '2025-12-24 06:59:55', '2025-12-24 06:59:55'),
(42, 105, NULL, NULL, 'I am interested in volunteering at Farm Alerts because of its commitment to improving animal health through timely information and community engagement. As a veterinary student, I value initiatives that bridge the gap between veterinary knowledge and farmers’ everyday challenges. This opportunity would allow me to contribute meaningfully while gaining hands-on experience in livestock health advocacy and disease prevention.', 'active', NULL, '09049149827', 'withny2020@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 07:03:53', '2025-12-24 07:03:53', NULL, '2025-12-24 07:03:53', '2025-12-24 07:03:53'),
(43, 106, NULL, 'Minna Niger state', 'To help my community stay informed about any outbreaks, how to manage them and also track the progress of the farmers and community at large.', 'active', NULL, '09167050275', 'harunaumar6768@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 09:03:52', '2025-12-24 09:03:52', NULL, '2025-12-24 09:03:52', '2025-12-24 09:03:52'),
(44, 107, 'Community Development Association', 'Kubwa FCT', 'To improve animal health and welfare in my community', 'active', NULL, '08107953959', 'jacintayohanna433@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 09:17:10', '2025-12-24 09:17:10', NULL, '2025-12-24 09:17:10', '2025-12-24 09:17:10'),
(45, 108, NULL, 'Zaria', 'So that I\'ll gain knowledge', 'active', NULL, '07042868157', 'silascynthia64@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 09:17:52', '2025-12-24 09:17:52', NULL, '2025-12-24 09:17:52', '2025-12-24 09:17:52'),
(46, 109, NULL, NULL, 'Animal farmers in my community have no knowledge about animal health, every year, especially during the harmattan season, birds keep dying. I\'d like to help them with the knowledge to prevent this and reduce losses', 'active', NULL, '+2349124274359', 'praisetargema@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 09:21:26', '2025-12-24 09:21:26', NULL, '2025-12-24 09:21:26', '2025-12-24 09:21:26'),
(47, 110, 'Ahmadu Bello University, Zaria-Nigeria', 'Zaria', 'I want to volunteer in order to curb the losses farmers face by bridging the information gap. This will directly increase their profit and indirectly increase the nation\'s GDP.', 'active', NULL, '+2347062383567', 'abiolaabdullahi4@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 09:35:25', '2025-12-24 09:35:25', NULL, '2025-12-24 09:35:25', '2025-12-24 09:35:25'),
(48, 111, NULL, 'Gwagwalada FCT', 'To experience different things, like culture, lifestyle of people and also to improve myself and for great connections', 'active', NULL, '+2347061605868', 'iyiolamariam114@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 09:40:47', '2025-12-24 09:40:47', NULL, '2025-12-24 09:40:47', '2025-12-24 09:40:47'),
(49, 112, NULL, 'Nsukka, Enugu State.', 'I am very passionate about veterinary medicine and am fully committed to serving farmers and society.\r\n\r\nAs a Vet-Med student, I participated in such outreach as Antimicrobial Awareness Week and Rabies Day.\r\n\r\nThese experiences have opened my mind to understand why it is important to educate farmers on taking good care of the animals and why animal health is interconnected with human health. I would be happy to volunteer to fill that gap, share the word, and promote sustainable agriculture.', 'active', NULL, '+2348128952543', 'chinaza.nwani.244384@unn.edu.ng', 0, 1, 'approved', NULL, '2025-12-24 11:16:57', '2025-12-24 11:16:57', NULL, '2025-12-24 11:16:57', '2025-12-24 11:16:57'),
(50, 113, NULL, NULL, 'Extension working and enlightenment campaigns', 'active', NULL, '+2348125024597', 'yahayaabdulkarim087@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 11:21:44', '2025-12-24 11:21:44', NULL, '2025-12-24 11:21:44', '2025-12-24 11:21:44'),
(51, 115, NULL, 'Kano state', 'Farmers are the back bone of this country and a key player in food security', 'active', NULL, '+2348120790200', 'joyootohan@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 11:27:00', '2025-12-24 11:27:00', NULL, '2025-12-24 11:27:00', '2025-12-24 11:27:00'),
(52, 117, NULL, NULL, 'To improve the technical know how of farmers and communities', 'active', NULL, '+2348112451753', 'araolaog@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 11:42:00', '2025-12-24 11:42:00', NULL, '2025-12-24 11:42:00', '2025-12-24 11:42:00'),
(53, 118, NULL, NULL, 'I want to contribute in my little ways, together we can build a conducive environment for the upcoming generation.', 'active', NULL, '+2348128039027', 'okesijiz@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 11:46:55', '2025-12-24 11:46:55', NULL, '2025-12-24 11:46:55', '2025-12-24 11:46:55'),
(54, 121, NULL, 'Maiduguri', 'To help improve livestock production in any way possible I can and work with the team leaders to achieve a common goal', 'active', NULL, '08105672341', 'Margaretkaidal@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 11:53:37', '2025-12-24 11:53:37', NULL, '2025-12-24 11:53:37', '2025-12-24 11:53:37'),
(55, 123, NULL, 'Maiduguri, Borno', 'As a student with keen interest in public health and food security and a prior knowledge about the risk of animal diseases to human.\r\nI will like to use my knowledge and experience to prevent animal diseases from spreading', 'active', NULL, '08120109969', 'Aliyusalihushettima2019@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 12:18:42', '2025-12-24 12:18:42', NULL, '2025-12-24 12:18:42', '2025-12-24 12:18:42'),
(56, 124, NULL, 'Borno', 'To help mitigate the risk of contracting diseases from animals,to spread awareness about the humane handling of livestocks and safe use of antibiotics on animals.', 'active', NULL, '09037553097', 'ibrahimmuhamma51@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 12:19:49', '2025-12-24 12:19:49', NULL, '2025-12-24 12:19:49', '2025-12-24 12:19:49'),
(57, 125, NULL, 'University of abuja', 'It\'s a dream come true', 'active', NULL, '+2348157418869', 'joshuaoyekanmi99@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 12:37:34', '2025-12-24 12:37:34', NULL, '2025-12-24 12:37:34', '2025-12-24 12:37:34'),
(58, 126, 'VET CONNECT', 'Abia state', 'To help expand outreach', 'active', NULL, '09059393643', 'chukwumastephen393@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 12:41:49', '2025-12-24 12:41:49', NULL, '2025-12-24 12:41:49', '2025-12-24 12:41:49'),
(59, 127, 'IATECH consultant', 'Bauchi', 'I want to help farmers understand the essence of their livestock\'s health and also enlighten them to take good care of it', 'active', NULL, '+2348108184848', 'abdulwahabbala123@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 12:58:19', '2025-12-24 12:58:19', NULL, '2025-12-24 12:58:19', '2025-12-24 12:58:19'),
(60, 128, NULL, 'Maiduguri, Borno state', 'I want to volunteer in order to help retrieve data and help farmers to take good decisions and establish strong financial decisions', 'active', NULL, '+2348035768626', 'vallitajesse7@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 13:31:02', '2025-12-24 13:31:02', NULL, '2025-12-24 13:31:02', '2025-12-24 13:31:02'),
(61, 129, 'Volunteer', 'Maiduguri', 'This is because Farmers play a vital role in almost every aspect of our lives by producing us with farm products and by educating and helping them it aids in promoting their efficiency as well as their products.\r\nThe community as well needs to be informed and educated about our present world because most things happen as a result of negligence or ignorance.', 'active', NULL, '08162769812', 'tajudeenfatima77@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 15:19:19', '2025-12-24 15:19:19', NULL, '2025-12-24 15:19:19', '2025-12-24 15:19:19'),
(62, 131, 'Ahmadu Bello University, Zaria.', 'Sabon Gari/Zaria, Kaduna state', 'I want to volunteer because I care about animal health, the farmers who depend on their animals for their livelihood, and the communities that rely on animal products. As a veterinary medicine student, I understand how important timely information and early outbreak alerts are in preventing losses.\r\nI will be happy to help enroll farmers on the platform, share outbreak alerts in my area, and support my community with useful information. Volunteering also allows me to learn, serve, and make a real impact in a simple but meaningful way.', 'active', NULL, '+2348036416437', 'akinyemibimbo398@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 16:04:08', '2025-12-24 16:04:08', NULL, '2025-12-24 16:04:08', '2025-12-24 16:04:08'),
(63, 132, NULL, 'Maiduguri Borno state', 'To improve their livelihood. \r\nTo protect them and their animals from diseases. \r\nHelp them to increase their production.', 'active', NULL, '+2348035137045', 'babagonialhmodu0019@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 19:28:45', '2025-12-24 19:28:45', NULL, '2025-12-24 19:28:45', '2025-12-24 19:28:45'),
(64, 133, NULL, 'Nguru Yobe State', 'It\'s the responsibility of every member of the community to share the acquired skills living for a positive development', 'active', NULL, '08063766329', 'absan715@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 20:55:37', '2025-12-24 20:55:37', NULL, '2025-12-24 20:55:37', '2025-12-24 20:55:37'),
(65, 134, 'International Veterinary Students\' Association, IVSA', 'Gomari Airport, Maiduguri, Borno State', 'To ensure good health continuity', 'active', NULL, '+2349011319444', 'amkarumi001@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 21:35:50', '2025-12-24 21:35:50', NULL, '2025-12-24 21:35:50', '2025-12-24 21:35:50'),
(66, 135, NULL, NULL, 'To learn and network', 'active', NULL, '07073572422', 'ibrahimnimatallahgurumoh@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 22:10:32', '2025-12-24 22:10:32', NULL, '2025-12-24 22:10:32', '2025-12-24 22:10:32'),
(67, 136, 'Student', 'Makurdi, Benue State', 'I want to volunteer because as a Veterinary student I\'m exposed to a certain level of information concerning animal health and disease outbreak management and consider myself as been in a position capable of contributing in my little way in spreading awareness and collecting necessary information in my immediate community for the improvement of lives of both farmers,basic management methods and the welfare of livestock in general.', 'active', NULL, '090565247933', 'josephjaps1@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 23:32:46', '2025-12-24 23:32:46', NULL, '2025-12-24 23:32:46', '2025-12-24 23:32:46'),
(68, 138, 'Ahmadu Bello University Zaria', 'Ahmadu Bello University Zaria', 'I want to volunteer for Farm Alert because I am passionate about supporting sustainable agriculture and helping farmers access timely information to improve productivity. I believe my skills and dedication can contribute to creating a positive impact in local farming communities, while also giving me the opportunity to learn and grow in a practical, hands-on environment.', 'active', NULL, '07063361644', 'abdulsalamzakariyyah@gmail.com', 0, 1, 'approved', NULL, '2025-12-24 23:40:11', '2025-12-24 23:40:11', NULL, '2025-12-24 23:40:11', '2025-12-24 23:40:11'),
(69, 139, 'Ahmadu Bello University Zaria', 'Samaru,kaduna state', 'I want to help farmers and my community because I’m passionate about animal farming and its role in providing food and income. By volunteering, I hope to support better animal care, improve productivity, and contribute to a healthier, more informed farming community.', 'active', NULL, '07067534871', 'muhammadaishasambo42@gmail.com', 0, 1, 'approved', NULL, '2025-12-25 05:14:34', '2025-12-25 05:14:34', NULL, '2025-12-25 05:14:34', '2025-12-25 05:14:34'),
(70, 140, NULL, 'Ilorin, Kwara State', 'To improve the quality of life', 'active', NULL, '08145193670', 'abdulmuminyusroh@gmail.com', 0, 1, 'approved', NULL, '2025-12-25 07:59:40', '2025-12-25 07:59:40', NULL, '2025-12-25 07:59:40', '2025-12-25 07:59:40'),
(71, 142, NULL, 'Zaria, Kaduna', 'To help prevent animal disease outbreaks and protection of public health,preventing zoonosis, while enhancing animal production.', 'active', NULL, '07082365053', 'sabiuamina1@gmail.com', 0, 1, 'approved', NULL, '2025-12-25 15:37:44', '2025-12-25 15:37:44', NULL, '2025-12-25 15:37:44', '2025-12-25 15:37:44'),
(72, 144, 'Vet konect', 'Kushari ward, Maiduguri.', 'To advance veterinary Medicine in my community and also contribute my quarter to disease prevention, surviellance and control.', 'active', NULL, '+2347083573339', 'pjbwala2019@gmail.com', 0, 1, 'approved', NULL, '2025-12-25 21:56:43', '2025-12-25 21:56:43', NULL, '2025-12-25 21:56:43', '2025-12-25 21:56:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alert_preferences`
--
ALTER TABLE `alert_preferences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alert_preferences_user_id_unique` (`user_id`),
  ADD KEY `alert_preferences_farm_record_id_foreign` (`farm_record_id`),
  ADD KEY `alert_preferences_user_id_index` (`user_id`),
  ADD KEY `alert_preferences_preferred_method_index` (`preferred_method`),
  ADD KEY `alert_preferences_is_subscribed_index` (`is_subscribed`),
  ADD KEY `alert_preferences_outbreak_alerts_index` (`outbreak_alerts`),
  ADD KEY `alert_preferences_vaccine_alerts_index` (`vaccine_alerts`),
  ADD KEY `alert_preferences_alert_location_state_index` (`alert_location_state`),
  ADD KEY `alert_preferences_alert_location_lga_index` (`alert_location_lga`);

--
-- Indexes for table `animal_health_professionals`
--
ALTER TABLE `animal_health_professionals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_health_professionals_approved_by_foreign` (`approved_by`),
  ADD KEY `animal_health_professionals_approval_status_index` (`approval_status`),
  ADD KEY `animal_health_professionals_professional_type_index` (`professional_type`),
  ADD KEY `animal_health_professionals_user_id_index` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `data_collectors`
--
ALTER TABLE `data_collectors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_collectors_approval_status_index` (`approval_status`),
  ADD KEY `data_collectors_user_id_index` (`user_id`),
  ADD KEY `data_collectors_approved_by_index` (`approved_by`);

--
-- Indexes for table `data_collector_profiles`
--
ALTER TABLE `data_collector_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_collector_profiles_user_id_unique` (`user_id`),
  ADD KEY `data_collector_profiles_reviewed_by_foreign` (`reviewed_by`),
  ADD KEY `data_collector_profiles_approval_status_index` (`approval_status`),
  ADD KEY `data_collector_profiles_assigned_territory_index` (`assigned_territory`),
  ADD KEY `data_collector_profiles_submitted_at_index` (`submitted_at`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `farmer_enrollments`
--
ALTER TABLE `farmer_enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer_enrollments_farmer_id_index` (`farmer_id`),
  ADD KEY `farmer_enrollments_enrolled_by_index` (`enrolled_by`),
  ADD KEY `farmer_enrollments_enrollment_method_index` (`enrollment_method`);

--
-- Indexes for table `farm_records`
--
ALTER TABLE `farm_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farm_records_approved_by_foreign` (`approved_by`),
  ADD KEY `farm_records_user_id_index` (`user_id`),
  ADD KEY `farm_records_farmer_id_index` (`farmer_id`),
  ADD KEY `farm_records_status_index` (`status`),
  ADD KEY `farm_records_created_by_role_index` (`created_by_role`),
  ADD KEY `farm_records_farm_type_index` (`farm_type`),
  ADD KEY `farm_records_urgency_level_index` (`urgency_level`),
  ADD KEY `farm_records_submitted_at_index` (`submitted_at`),
  ADD KEY `farm_records_latitude_longitude_index` (`latitude`,`longitude`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livestock`
--
ALTER TABLE `livestock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `livestock_tag_number_unique` (`tag_number`),
  ADD KEY `livestock_recorded_by_foreign` (`recorded_by`),
  ADD KEY `livestock_mother_id_foreign` (`mother_id`),
  ADD KEY `livestock_father_id_foreign` (`father_id`),
  ADD KEY `livestock_farm_record_id_index` (`farm_record_id`),
  ADD KEY `livestock_user_id_index` (`user_id`),
  ADD KEY `livestock_livestock_type_index` (`livestock_type`),
  ADD KEY `livestock_tag_number_index` (`tag_number`),
  ADD KEY `livestock_health_status_index` (`health_status`),
  ADD KEY `livestock_status_index` (`status`),
  ADD KEY `livestock_gender_index` (`gender`),
  ADD KEY `livestock_is_vaccinated_index` (`is_vaccinated`),
  ADD KEY `livestock_age_category_index` (`age_category`),
  ADD KEY `livestock_owner_id_index` (`owner_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_requests_reference_number_unique` (`reference_number`),
  ADD KEY `service_requests_livestock_id_foreign` (`livestock_id`),
  ADD KEY `service_requests_assigned_by_foreign` (`assigned_by`),
  ADD KEY `service_requests_reviewed_by_foreign` (`reviewed_by`),
  ADD KEY `service_requests_user_id_index` (`user_id`),
  ADD KEY `service_requests_farm_record_id_index` (`farm_record_id`),
  ADD KEY `service_requests_service_type_index` (`service_type`),
  ADD KEY `service_requests_status_index` (`status`),
  ADD KEY `service_requests_urgency_level_index` (`urgency_level`),
  ADD KEY `service_requests_priority_index` (`priority`),
  ADD KEY `service_requests_assigned_to_index` (`assigned_to`),
  ADD KEY `service_requests_preferred_date_index` (`preferred_date`),
  ADD KEY `service_requests_actual_service_date_index` (`actual_service_date`),
  ADD KEY `service_requests_payment_status_index` (`payment_status`),
  ADD KEY `service_requests_reference_number_index` (`reference_number`),
  ADD KEY `service_requests_latitude_longitude_index` (`latitude`,`longitude`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_approved_by_foreign` (`approved_by`),
  ADD KEY `users_status_index` (`status`),
  ADD KEY `users_is_approved_index` (`is_approved`);

--
-- Indexes for table `vaccination_history`
--
ALTER TABLE `vaccination_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vaccination_history_recorded_by_foreign` (`recorded_by`),
  ADD KEY `vaccination_history_verified_by_foreign` (`verified_by`),
  ADD KEY `vaccination_history_livestock_id_index` (`livestock_id`),
  ADD KEY `vaccination_history_farm_record_id_index` (`farm_record_id`),
  ADD KEY `vaccination_history_user_id_index` (`user_id`),
  ADD KEY `vaccination_history_vaccination_date_index` (`vaccination_date`),
  ADD KEY `vaccination_history_next_dose_due_date_index` (`next_dose_due_date`),
  ADD KEY `vaccination_history_next_booster_due_date_index` (`next_booster_due_date`),
  ADD KEY `vaccination_history_vaccine_name_index` (`vaccine_name`),
  ADD KEY `vaccination_history_disease_target_index` (`disease_target`),
  ADD KEY `vaccination_history_status_index` (`status`),
  ADD KEY `vaccination_history_adverse_reaction_index` (`adverse_reaction`),
  ADD KEY `vaccination_history_is_verified_index` (`is_verified`);

--
-- Indexes for table `verification_documents`
--
ALTER TABLE `verification_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verification_documents_data_collector_profile_id_foreign` (`data_collector_profile_id`),
  ADD KEY `verification_documents_verified_by_foreign` (`verified_by`),
  ADD KEY `verification_documents_user_id_index` (`user_id`),
  ADD KEY `verification_documents_document_type_index` (`document_type`),
  ADD KEY `verification_documents_verification_status_index` (`verification_status`),
  ADD KEY `verification_documents_category_index` (`category`),
  ADD KEY `verification_documents_expiry_date_index` (`expiry_date`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `volunteers_approved_by_foreign` (`approved_by`),
  ADD KEY `volunteers_approval_status_index` (`approval_status`),
  ADD KEY `volunteers_is_active_index` (`is_active`),
  ADD KEY `volunteers_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alert_preferences`
--
ALTER TABLE `alert_preferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `animal_health_professionals`
--
ALTER TABLE `animal_health_professionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `data_collectors`
--
ALTER TABLE `data_collectors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_collector_profiles`
--
ALTER TABLE `data_collector_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmer_enrollments`
--
ALTER TABLE `farmer_enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `farm_records`
--
ALTER TABLE `farm_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `livestock`
--
ALTER TABLE `livestock`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `vaccination_history`
--
ALTER TABLE `vaccination_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verification_documents`
--
ALTER TABLE `verification_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alert_preferences`
--
ALTER TABLE `alert_preferences`
  ADD CONSTRAINT `alert_preferences_farm_record_id_foreign` FOREIGN KEY (`farm_record_id`) REFERENCES `farm_records` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `alert_preferences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `animal_health_professionals`
--
ALTER TABLE `animal_health_professionals`
  ADD CONSTRAINT `animal_health_professionals_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `animal_health_professionals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_collectors`
--
ALTER TABLE `data_collectors`
  ADD CONSTRAINT `data_collectors_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_collectors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_collector_profiles`
--
ALTER TABLE `data_collector_profiles`
  ADD CONSTRAINT `data_collector_profiles_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `data_collector_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `farmer_enrollments`
--
ALTER TABLE `farmer_enrollments`
  ADD CONSTRAINT `farmer_enrollments_enrolled_by_foreign` FOREIGN KEY (`enrolled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `farmer_enrollments_farmer_id_foreign` FOREIGN KEY (`farmer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `farm_records`
--
ALTER TABLE `farm_records`
  ADD CONSTRAINT `farm_records_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `farm_records_farmer_id_foreign` FOREIGN KEY (`farmer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `farm_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `livestock`
--
ALTER TABLE `livestock`
  ADD CONSTRAINT `livestock_farm_record_id_foreign` FOREIGN KEY (`farm_record_id`) REFERENCES `farm_records` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `livestock_father_id_foreign` FOREIGN KEY (`father_id`) REFERENCES `livestock` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `livestock_mother_id_foreign` FOREIGN KEY (`mother_id`) REFERENCES `livestock` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `livestock_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `livestock_recorded_by_foreign` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `livestock_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD CONSTRAINT `service_requests_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_requests_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_requests_farm_record_id_foreign` FOREIGN KEY (`farm_record_id`) REFERENCES `farm_records` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_requests_livestock_id_foreign` FOREIGN KEY (`livestock_id`) REFERENCES `livestock` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_requests_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vaccination_history`
--
ALTER TABLE `vaccination_history`
  ADD CONSTRAINT `vaccination_history_farm_record_id_foreign` FOREIGN KEY (`farm_record_id`) REFERENCES `farm_records` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vaccination_history_livestock_id_foreign` FOREIGN KEY (`livestock_id`) REFERENCES `livestock` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vaccination_history_recorded_by_foreign` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vaccination_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vaccination_history_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `verification_documents`
--
ALTER TABLE `verification_documents`
  ADD CONSTRAINT `verification_documents_data_collector_profile_id_foreign` FOREIGN KEY (`data_collector_profile_id`) REFERENCES `data_collector_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `verification_documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `verification_documents_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD CONSTRAINT `volunteers_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `volunteers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
