-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2025 at 05:36 PM
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
-- Database: `quantumaxis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `type`, `icon`, `value`) VALUES
(1, 'address', 'fas fa-map-marker-alt', '1st Floor, Block E, Level 2, Bandar Utama, No.2, 50480 Petaling Jaya, Selangor, Malaysia'),
(2, 'hours', 'fas fa-clock', 'Mon - Fri: 9:00 AM - 6:00 PM'),
(3, 'phone', 'fas fa-phone', '016-334 7378'),
(4, 'email', 'fas fa-envelope', 'quantumaxis212@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `id` int(11) NOT NULL,
  `refnum` varchar(10) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `bday` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `streetaddress` varchar(40) NOT NULL,
  `suburb_town` varchar(40) NOT NULL,
  `state_territory` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `techlist` varchar(255) DEFAULT NULL,
  `other_skills` text DEFAULT NULL,
  `status` enum('New','Current','Final') DEFAULT 'New',
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `reference_number` varchar(50) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `salary_range` varchar(100) NOT NULL,
  `reports_to` varchar(255) NOT NULL,
  `overview` text NOT NULL,
  `responsibilities` text NOT NULL,
  `essential_qualifications` text NOT NULL,
  `preferable_qualifications` text NOT NULL,
  `icon_class` varchar(100) NOT NULL,
  `posted_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `reference_number`, `job_type`, `category`, `salary_range`, `reports_to`, `overview`, `responsibilities`, `essential_qualifications`, `preferable_qualifications`, `icon_class`, `posted_date`, `is_active`) VALUES
(1, 'Artificial Intelligence Engineer', 'AI123', 'Full-time', 'Engineering', '$80,000 - $120,000 per year', 'Head of Data Science', 'We are seeking an innovative and driven AI Engineer to develop and implement machine learning models and AI-driven solutions to improve our business operations and products.', '[\"Design and develop machine learning algorithms and AI models.\", \"Collaborate with cross-functional teams to integrate AI solutions into products.\", \"Evaluate and improve model performance and scalability.\", \"Stay updated with the latest AI technologies and research trends.\"]', '[\"Bachelor\'s degree in Computer Science, Data Science, or related field.\", \"Proficiency in programming languages such as Python or R.\", \"3+ years of experience in machine learning or AI development.\", \"Strong understanding of neural networks and deep learning frameworks (e.g., TensorFlow, PyTorch).\"]', '[\"Master\'s degree in Artificial Intelligence or related field.\", \"Experience with cloud platforms (AWS, Azure, Google Cloud).\", \"Familiarity with natural language processing (NLP) techniques.\"]', 'fas fa-robot', '2025-11-04 08:22:23', 1),
(2, 'Cybersecurity Analyst', 'CS456', 'Full-time', 'Cybersecurity', '$70,000 - $100,000 per year', 'Chief Information Security Officer (CISO)', 'The Cybersecurity Analyst will be responsible for protecting our company\'s digital assets, detecting potential threats, and implementing robust security measures to prevent breaches.', '[\"Monitor networks for security breaches and investigate alerts.\", \"Implement and maintain security systems and controls.\", \"Conduct vulnerability assessments and penetration testing.\", \"Train staff on cybersecurity best practices and awareness.\"]', '[\"Bachelor\'s degree in Cybersecurity, Information Technology, or related field.\", \"2+ years of experience in cybersecurity or network security.\", \"Knowledge of firewalls, intrusion detection systems, and encryption.\", \"Strong analytical and problem-solving skills.\"]', '[\"Industry certifications such as CEH, CISSP, or CompTIA Security+.\", \"Experience with incident response and digital forensics.\", \"Familiarity with cloud security solutions.\"]', 'fas fa-shield-alt', '2025-11-04 08:22:23', 1),
(3, 'Data Scientist', 'DS789', 'Full-time', 'Data Science', '$90,000 - $130,000 per year', 'Head of Data Science', 'We\'re looking for a Data Scientist to analyze complex datasets, build predictive models, and provide data-driven insights to drive business decisions.', '[\"Analyze large, complex datasets to extract actionable insights.\", \"Develop and implement machine learning models and algorithms.\", \"Collaborate with business stakeholders to identify opportunities for leveraging data.\", \"Create data visualizations and reports to communicate findings.\"]', '[\"Master\'s degree in Data Science, Statistics, Computer Science, or related field.\", \"Proficiency in Python, R, and SQL.\", \"Experience with data visualization tools (Tableau, Power BI, etc.).\", \"Strong statistical analysis and modeling skills.\"]', '[\"PhD in a quantitative field.\", \"Experience with big data technologies (Hadoop, Spark, etc.).\", \"Publications in relevant academic journals or conferences.\"]', 'fas fa-chart-bar', '2025-11-04 08:22:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manage`
--

CREATE TABLE `manage` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `login_attempts` int(11) DEFAULT 0,
  `locked_until` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `username`, `password_hash`, `email`, `created_at`, `login_attempts`, `locked_until`, `is_active`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@quantumaxis.com', '2025-11-15 15:20:24', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `icon`, `description`) VALUES
(1, 'Cybersecurity analyst', 'fas fa-shield-alt', 'Protect systems and networks from cyber threats.'),
(2, 'Artificial Intelligence Engineering', 'fas fa-robot', 'Design AI solutions for modern engineering challenges.'),
(3, 'Data Scientist', 'fas fa-chart-line', 'Analyze data, build predictive models, and extract insights for business decisions.');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `class_time` varchar(50) DEFAULT NULL,
  `class_day` varchar(20) DEFAULT NULL,
  `student_ids` varchar(255) DEFAULT NULL,
  `tutor_name` varchar(100) DEFAULT NULL,
  `photo_caption` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `class_time`, `class_day`, `student_ids`, `tutor_name`, `photo_caption`) VALUES
(1, 'QuantumAxis Engineering', '12:00–2:00 PM', 'Wednesday', '105728022, 105959039, 106218155, 1054683299', 'Ms. Pawani T. Rasaratnam', 'Our amazing team: Fatin, Shikto, Xuan, Jia'),
(2, 'QuantumAxis Engineering', '12:00–2:00 PM', 'Wednesday', '105728022, 105959039, 106218155, 1054683299', 'Ms. Pawani T. Rasaratnam', 'Our amazing team: Fatin, Shikto, Xuan, Jia');

-- --------------------------------------------------------

--
-- Table structure for table `team_cards`
--

CREATE TABLE `team_cards` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `card_type` enum('commitment','mission','vision') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_cards`
--

INSERT INTO `team_cards` (`id`, `title`, `icon`, `content`, `card_type`) VALUES
(1, 'Our Commitment', 'fas fa-handshake', 'QuantumAxis Engineering delivers innovative solutions with a team committed to excellence and customer satisfaction.', 'commitment'),
(2, 'Our Mission', 'fas fa-bullseye', 'Our mission is to innovate engineering solutions that empower businesses worldwide.', 'mission'),
(3, 'Our Vision', 'fas fa-eye', 'We envision a future where technology and engineering create sustainable, smart environments.', 'vision');

-- --------------------------------------------------------

--
-- Stand-in structure for view `team_complete_view`
-- (See below for the actual view)
--
CREATE TABLE `team_complete_view` (
`team_id` int(11)
,`team_name` varchar(100)
,`class_time` varchar(50)
,`class_day` varchar(20)
,`student_ids` varchar(255)
,`tutor_name` varchar(100)
,`photo_caption` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `member_id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `contribution` text DEFAULT NULL,
  `interests` text DEFAULT NULL,
  `hobbies` text DEFAULT NULL,
  `favorite_books` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`member_id`, `team_id`, `full_name`, `contribution`, `interests`, `hobbies`, `favorite_books`) VALUES
(1, 1, 'Wong Jia Lun', 'PHP Home page, CSS styling, Job application', 'HTML/CSS', 'Making Latte Art', 'I Had That Same Dream Again'),
(2, 1, 'Ng Ting Xuan', '—', 'Web Development', 'Collecting Frog Keychains', 'Historical Books'),
(3, 1, 'Shariar Oasib Shikto', 'PHP Job Description, CSS Styling, Job Application', 'Machine Learning', 'Playing Cricket', 'Sherlock Holmes'),
(4, 1, 'Mohammad Fatin Anjum Fahim', 'PHP About page, CSS Styling, Validation', 'Back-end Development', 'Singing, Playing Guitar', 'The Secret'),
(5, 1, 'Wong Jia Lun', 'PHP Home page, CSS styling, Job application', 'HTML/CSS', 'Making Latte Art', 'I Had That Same Dream Again'),
(6, 1, 'Ng Ting Xuan', '—', 'Web Development', 'Collecting Frog Keychains', 'Historical Books'),
(7, 1, 'Shariar Oasib Shikto', 'PHP Job Description, CSS Styling, Job Application', 'Machine Learning', 'Playing Cricket', 'Sherlock Holmes'),
(8, 1, 'Mohammad Fatin Anjum Fahim', 'PHP About page, CSS Styling, Validation', 'Back-end Development', 'Singing, Playing Guitar', 'The Secret');

-- --------------------------------------------------------

--
-- Table structure for table `team_skills`
--

CREATE TABLE `team_skills` (
  `skill_id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `skill_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_skills`
--

INSERT INTO `team_skills` (`skill_id`, `team_id`, `skill_name`) VALUES
(1, 1, 'HTML5'),
(2, 1, 'CSS3'),
(3, 1, 'JavaScript'),
(4, 1, 'Python'),
(5, 1, 'UI/UX Design'),
(6, 1, 'Machine Learning'),
(7, 1, 'HTML5'),
(8, 1, 'CSS3'),
(9, 1, 'JavaScript'),
(10, 1, 'Python'),
(11, 1, 'UI/UX Design'),
(12, 1, 'Machine Learning');

-- --------------------------------------------------------

--
-- Structure for view `team_complete_view`
--
DROP TABLE IF EXISTS `team_complete_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `team_complete_view`  AS SELECT `t`.`team_id` AS `team_id`, `t`.`team_name` AS `team_name`, `t`.`class_time` AS `class_time`, `t`.`class_day` AS `class_day`, `t`.`student_ids` AS `student_ids`, `t`.`tutor_name` AS `tutor_name`, `t`.`photo_caption` AS `photo_caption` FROM `teams` AS `t` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference_number` (`reference_number`);

--
-- Indexes for table `manage`
--
ALTER TABLE `manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `team_cards`
--
ALTER TABLE `team_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `team_skills`
--
ALTER TABLE `team_skills`
  ADD PRIMARY KEY (`skill_id`),
  ADD KEY `team_id` (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manage`
--
ALTER TABLE `manage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_cards`
--
ALTER TABLE `team_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `team_skills`
--
ALTER TABLE `team_skills`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `team_members_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`) ON DELETE CASCADE;

--
-- Constraints for table `team_skills`
--
ALTER TABLE `team_skills`
  ADD CONSTRAINT `team_skills_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
