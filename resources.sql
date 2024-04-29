-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: sdb-61.hosting.stackcp.net
-- Generation Time: Apr 29, 2024 at 07:59 PM
-- Server version: 10.4.31-MariaDB-log
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flashi-35303237fcad`
--

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `url` varchar(2048) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `name`, `url`, `status`, `created_at`) VALUES
(3903, 'A-level Further Mathematics SharePoint', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics?csf=1&web=1&e=kDgxjn', 'approved', '2024-03-12 11:06:28'),
(3904, 'A-level Mathematics SharePoint', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel?csf=1&web=1&e=7hpZ6U', 'approved', '2024-03-12 11:06:41'),
(3905, 'Casio Emulator', 'https://torchacademygatewaytrust.sharepoint.com/:u:/r/sites/NUAST-New/StudentResources/Maths/ks5%20archive/Casio%20Emulator.exe?csf=1&web=1&e=k1AWI8', 'approved', '2024-03-12 11:06:56'),
(3906, 'Further Mechanics 1 Textbook', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Further%20Mechanics/Pearson%20FM%20Further%20Mechanics%201.pdf?csf=1&web=1&e=Lh9UMg', 'approved', '2024-03-12 11:07:10'),
(3907, 'Further Mechanics Homework', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Further%20Mechanics?csf=1&web=1&e=1KcdAr', 'approved', '2024-03-12 11:07:23'),
(3908, 'Further Pure 1 Textbook', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Further%20Pure/Edexcel%20Further%20Pure%20Mathematics%201.pdf?csf=1&web=1&e=7lcPdS', 'approved', '2024-03-12 11:07:35'),
(3909, 'Further Pure Homework', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Further%20Pure?csf=1&web=1&e=geZCh5', 'approved', '2024-03-12 11:07:48'),
(3910, 'Further Statistics 1 Textbook', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Further%20Statistics/Pearson%20FM%20Further%20Statistics%201.pdf?csf=1&web=1&e=XboYe0', 'approved', '2024-03-12 11:08:02'),
(3911, 'Further Statistics Homework', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Further%20Statistics?csf=1&web=1&e=daQyj8', 'approved', '2024-03-12 11:08:23'),
(3912, 'Maths SharePoint', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths?csf=1&web=1&e=FlJ5Gf', 'approved', '2024-03-12 11:08:57'),
(3913, 'Maths SharePoint', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths?csf=1&web=1&e=FlJ5Gf', 'hidden', '2024-03-12 11:08:57'),
(3914, 'Student Resources', 'https://torchacademygatewaytrust.sharepoint.com/sites/NUAST-New/StudentResources/Forms/AllItems.aspx?viewid=426dc2ff-d9df-4f7b-ae3e-ce232be9cefb', 'approved', '2024-03-12 11:09:08'),
(3915, 'Year 1 Further Core Pure AS Textbook', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Y1%20FM%20Pure%20Core%201/Pearson%20FM%20Y1%20-%20Core%20Pure.pdf?csf=1&web=1&e=gtlQWo', 'approved', '2024-03-12 11:09:26'),
(3916, 'Year 1 Further Mathematics Homework', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Y1%20FM%20Pure%20Core%201?csf=1&web=1&e=RgBad1', 'approved', '2024-03-12 11:09:39'),
(3917, 'Year 1 Further Core Pure Solutions', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Y1%20FM%20Pure%20Core%201/alevel_core_pure_1_solutionbank_combined.pdf?csf=1&web=1&e=00eN3F', 'approved', '2024-03-12 11:09:48'),
(3918, 'Year 1 Mechanics Homework', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y1%20Mechanics?csf=1&web=1&e=v6Yq8k', 'approved', '2024-03-12 11:10:00'),
(3919, 'Year 1 Pure Mathematics AS Textbook', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/Section_NUA-2023-12A-Fm1/Class%20Materials/Pearson%20Maths%20Y1%20Pure.pdf?csf=1&web=1&e=EE7abn', 'approved', '2024-03-12 11:10:19'),
(3920, 'Year 1 Pure Mathematics Solutions', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y1%20Pure%20Maths/Yr%201%20Edexcel%20Text%20Book%20-%20Solutions.pdf?csf=1&web=1&e=kQ3pki', 'approved', '2024-03-12 11:10:30'),
(3921, 'Year 1 Pure Mathematics Homework', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y1%20Pure%20Maths?csf=1&web=1&e=Pe5cSL', 'approved', '2024-03-12 11:10:40'),
(3922, 'Year 1 Statistics and Mechanics AS Textbook', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y1%20Statistics/Pearson%20Maths%20Y1%20Statistics%20and%20Mechanics.pdf?csf=1&web=1&e=lLOyKA', 'approved', '2024-03-12 11:11:59'),
(3923, 'Year 1 Statistics and Mechanics Solutions', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y1%20Mechanics/Pearson%20Maths%20Y1%20Solutions%20-%20Stats%20%26%20Mech.pdf?csf=1&web=1&e=EPTdb4', 'approved', '2024-03-12 11:12:11'),
(3924, 'Year 1 Statistics Homework', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y1%20Statistics?csf=1&web=1&e=0KR6Ok', 'approved', '2024-03-12 11:12:23'),
(3925, 'Year 2 Further Mathematics Homework', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Y2%20FM%20Pure%20Core%202?csf=1&web=1&e=DNqo9L', 'approved', '2024-03-12 11:12:36'),
(3926, 'Year 2 Further Core Pure Solutions', 'https://torchacademygatewaytrust.sharepoint.com/sites/NUAST-New/StudentResources/Forms/AllItems.aspx?csf=1&web=1&e=RgBad1&cid=7ef1fe3a%2Dfb78%2D4471%2Dbdfb%2D2fb961ebb563&FolderCTID=0x012000F742269E1B8BE249A393C359251176D8&id=%2Fsites%2FNUAST%2DNew%2FStudentResources%2FMaths%2FA%20level%20Further%20Mathematics%2FY2%20FM%20Pure%20Core%202%2Falevel%5Fcore%5Fpure%5F2%5Fsolutionbank%5Fcombined%2Epdf&viewid=426dc2ff%2Dd9df%2D4f7b%2Dae3e%2Dce232be9cefb&parent=%2Fsites%2FNUAST%2DNew%2FStudentResources%2FMaths%2FA%20level%20Further%20Mathematics%2FY2%20FM%20Pure%20Core%202', 'approved', '2024-03-12 11:12:48'),
(3927, 'Year 2 Further Core Pure Textbook', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Y2%20FM%20Pure%20Core%202/Pearson%20FM%20Y2%20-%20Core%20Pure.pdf?csf=1&web=1&e=raAcqC', 'approved', '2024-03-12 11:13:00'),
(3928, 'Year 2 Mechanics Homework', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y2%20Mechanics?csf=1&web=1&e=m96e8c', 'approved', '2024-03-12 11:13:10'),
(3929, 'Year 2 Pure Mathematics Solutions', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y2%20Pure%20Maths/Pearson%20Maths%20Y2%20Pure%20solutionbank.pdf?csf=1&web=1&e=yDT3Sn', 'approved', '2024-03-12 11:13:26'),
(3930, 'Year 2 Pure Mathematics Textbook', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y2%20Pure%20Maths/Pearson%20Maths%20Y2%20Pure.pdf?csf=1&web=1&e=oSi7XY', 'approved', '2024-03-12 11:13:38'),
(3931, 'Year 2 Pure Mathematics Homework', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y2%20Pure%20Maths?csf=1&web=1&e=dge3oC', 'approved', '2024-03-12 11:13:49'),
(3932, 'Year 2 Statistics and Mechanics Solutions', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y2%20Mechanics/Pearson%20Maths%20Y2%20Solutions%20-%20Stats%20Mechanics_2.pdf?csf=1&web=1&e=y5YIxr', 'approved', '2024-03-12 11:14:05'),
(3933, 'Year 2 Statistics and Mechanics Textbook', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y2%20Mechanics/Pearson%20Maths%20Y2%20Statistics%20and%20Mechanics.pdf?csf=1&web=1&e=fD0RTr', 'approved', '2024-03-12 11:14:17'),
(3934, 'Year 2 Statistics Homework', 'https://torchacademygatewaytrust.sharepoint.com/:f:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Mathematics%20Edexcel/Y2%20Statistics?csf=1&web=1&e=1yVVGm', 'approved', '2024-03-12 11:14:26'),
(3935, 'Test', 'https://test.com', 'hidden', '2024-03-14 10:49:42'),
(3936, 'Maths Practice Papers', 'https://torchacademygatewaytrust.sharepoint.com/sites/NUAST-New/StudentResources/Forms/AllItems.aspx?csf=1&web=1&e=FlJ5Gf&cid=f5e75fc6%2D23b1%2D4ff7%2Da674%2Dcb35ee2e25a2&FolderCTID=0x012000F742269E1B8BE249A393C359251176D8&id=%2Fsites%2FNUAST%2DNew%2FStudentResources%2FMaths%2FA%20level%20Mathematics%20Edexcel%2FA%20Level%20Mathematics%20practice%20papers&viewid=426dc2ff%2Dd9df%2D4f7b%2Dae3e%2Dce232be9cefb', 'approved', '2024-03-14 13:22:29'),
(3937, 'A-level Computer Science Specification', 'https://filestore.aqa.org.uk/resources/computing/specifications/AQA-7516-7517-SP-2015.PDF?classId=23ce0ee4-0ef2-4f49-8d82-823b55280245&assignmentId=09a85c93-f968-46af-8324-88ec95a06c6f&submissionId=a0ed2433-071b-5e91-6e13-fbb0f02cc1aa', 'approved', '2024-03-15 11:52:47'),
(3938, 'Further Mechanics 1 Solutions', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Further%20Mechanics/alevel_further_mechanics_1_solutionbank_combined.pdf?csf=1&web=1&e=NKxQJF', 'approved', '2024-03-15 12:44:31'),
(3939, 'Further Statistics 1 Solutions', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Further%20Statistics/alevel_further_statistics_1_solutionbank_combined.pdf?csf=1&web=1&e=s9x7ko', 'approved', '2024-03-15 12:45:00'),
(3940, 'Further Pure 1 Solutions', 'https://torchacademygatewaytrust.sharepoint.com/:b:/r/sites/NUAST-New/StudentResources/Maths/A%20level%20Further%20Mathematics/Further%20Pure/alevel_further_pure_1_solutionbank_combined.pdf?csf=1&web=1&e=ONza0o', 'approved', '2024-03-15 12:45:46'),
(3941, 'Year 1 Statistics and Mechanics Solution Bank (organised)', 'https://www.physicsandmathstutor.com/maths-revision/solutionbanks/edexcel-statistics-mechanics-year-1/', 'approved', '2024-03-24 10:06:59'),
(3942, 'Year 1 Further Core Pure Solution Bank (organised)', 'https://www.physicsandmathstutor.com/maths-revision/solutionbanks/edexcel-core-pure-maths-1/', 'approved', '2024-04-12 07:42:04'),
(3943, 'A-level Physics Formulae AQA', 'https://filestore.aqa.org.uk/resources/physics/AQA-7408-SDB.PDF', 'approved', '2024-04-15 08:24:22'),
(3944, 'Core Pure Textbook', 'https://torchacademygatewaytrust.sharepoint.com/sites/NUAST-New/StudentResources/Forms/AllItems.aspx?id=%2Fsites%2FNUAST%2DNew%2FStudentResources%2FMaths%2FA%20level%20Further%20Mathematics%2FY1%20FM%20Pure%20Core%201%2FPearson%20FM%20Y1%20%2D%20Core%20Pure%2Epdf&viewid=426dc2ff%2Dd9df%2D4f7b%2Dae3e%2Dce232be9cefb&parent=%2Fsites%2FNUAST%2DNew%2FStudentResources%2FMaths%2FA%20level%20Further%20Mathematics%2FY1%20FM%20Pure%20Core%201', 'hidden', '2024-04-17 13:44:06'),
(3945, 'Year 2 Statistics and Mechanics Solution Bank (organised)', 'https://www.physicsandmathstutor.com/maths-revision/solutionbanks/edexcel-statistics-mechanics-year-2/', 'approved', '2024-04-19 08:23:12'),
(3946, 'Further Statistics Solution Bank (organized)', 'https://www.physicsandmathstutor.com/maths-revision/solutionbanks/edexcel-further-statistics-1/', 'hidden', '2024-04-22 09:34:42'),
(3947, 'Fat', 'https://flashi.uk/nuast/', 'hidden', '2024-04-22 10:50:35'),
(3948, 'A-level Physics Kerboodle Textbook', 'https://www.kerboodle.com/api/courses/19142/interactives/111863.html', 'pending', '2024-04-23 12:11:44'),
(3949, 'Year 1 Pure Mathematics Solution Bank (organised)', 'https://www.physicsandmathstutor.com/maths-revision/solutionbanks/edexcel-pure-maths-year-1/', 'approved', '2024-04-28 20:59:49'),
(3950, 'Year 2 Pure Mathematics Solution Bank (organised)', 'https://www.physicsandmathstutor.com/maths-revision/solutionbanks/edexcel-pure-maths-year-2/', 'approved', '2024-04-28 21:00:13'),
(3951, 'Year 2 Further Core Pure Solution Bank (oragnised)', 'https://www.physicsandmathstutor.com/maths-revision/solutionbanks/edexcel-core-pure-maths-2/', 'approved', '2024-04-28 21:03:39'),
(3952, 'Further Pure 1 Solution Bank (organised)', 'https://www.physicsandmathstutor.com/maths-revision/solutionbanks/edexcel-further-pure-maths-1/', 'approved', '2024-04-28 21:04:59'),
(3953, 'Further Statistics 1 Solution Bank (organised)', 'https://www.physicsandmathstutor.com/maths-revision/solutionbanks/edexcel-further-statistics-1/', 'approved', '2024-04-28 21:05:38'),
(3954, 'Further Mechanics 1 Solution Bank (organised)', 'https://www.physicsandmathstutor.com/maths-revision/solutionbanks/edexcel-further-mechanics-1/', 'approved', '2024-04-28 21:06:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
