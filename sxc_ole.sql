-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 24, 2013 at 12:01 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sxc_ole`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE IF NOT EXISTS `chapters` (
  `unitID` varchar(100) NOT NULL,
  `chapterID` varchar(100) NOT NULL,
  `chapterName` varchar(100) DEFAULT NULL,
  `description` text,
  `status` int(11) DEFAULT NULL,
  `questions` int(11) DEFAULT NULL,
  `visibility` int(11) DEFAULT NULL,
  PRIMARY KEY (`unitID`,`chapterID`),
  UNIQUE KEY `chapterID_UNIQUE` (`chapterID`),
  KEY `unitID_Chap_idx` (`unitID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`unitID`, `chapterID`, `chapterName`, `description`, `status`, `questions`, `visibility`) VALUES
('basicarch-U1', 'basicarch-U1-C1', 'Introduction', 'Introduction', 1, NULL, NULL),
('basicarch-U1', 'basicarch-U1-C2', 'Examples of architectural brilliance', 'Examples of architectural brilliance', 1, NULL, NULL),
('basicarch-U2', 'basicarch-U2-C1', 'Contemporary architectrue', 'Contemporary architectrue', 1, NULL, NULL),
('basicarch-U2', 'basicarch-U2-C2', 'Summing up', 'Summing up', 1, NULL, NULL),
('film-U1', 'film-U1-C1', '1895 to 1906', '1895 to 1906', 1, NULL, NULL),
('film-U1', 'film-U1-C2', '1906 to 1914', '1906 to 1914', 1, NULL, NULL),
('film-U1', 'film-U1-C3', '1914 to 1919', '1914 to 1919', 1, NULL, NULL),
('film-U1', 'film-U1-C4', 'Hollywood triumphant', 'Hollywood triumphant', 1, NULL, NULL),
('film-U2', 'film-U2-C1', 'Industry impact of sound', 'Industry impact of sound', 1, NULL, NULL),
('film-U2', 'film-U2-C2', 'Creative impact of sound', 'Creative impact of sound', 1, NULL, NULL),
('film-U2', 'film-U2-C3', 'The 1940s: the war and post-war years', 'The 1940s: the war and post-war years', 1, NULL, NULL),
('film-U2', 'film-U2-C4', 'The 1950s', 'The 1950s', 1, NULL, NULL),
('film-U2', 'film-U2-C5', '1960s', '1960s', 1, NULL, NULL),
('WebDev101-U1', 'WebDev101-U1-C1', 'HTML Elements', 'HTML Elements: An overview', 1, NULL, NULL),
('WebDev101-U1', 'WebDev101-U1-C2', 'HTML Attributes', 'HTML Attributes', 1, NULL, NULL),
('WebDev101-U1', 'WebDev101-U1-C3', 'HTML Headings', 'Headings in HTML', 1, NULL, NULL),
('WebDev101-U1', 'WebDev101-U1-C4', 'HTML Paragraphs', 'HTML Paragraphs', 1, NULL, NULL),
('WebDev101-U1', 'WebDev101-U1-C5', 'HTML Formatting', 'HTML Formatting', 1, NULL, NULL),
('WebDev101-U2', 'WebDev101-U2-C1', 'Introduction', 'Introduction to HTML5', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `courseID` varchar(100) NOT NULL,
  `instructorID` varchar(100) NOT NULL,
  `courseName` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `tags` text,
  `description` text,
  `dateOfCreation` date NOT NULL,
  `status` int(11) DEFAULT NULL,
  `questions` int(11) DEFAULT NULL,
  `popularity` float(11,2) DEFAULT '0.00',
  PRIMARY KEY (`courseID`),
  UNIQUE KEY `courseID` (`courseID`),
  UNIQUE KEY `code` (`code`),
  KEY `subject` (`subject`),
  KEY `instructorID` (`instructorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseID`, `instructorID`, `courseName`, `code`, `subject`, `tags`, `description`, `dateOfCreation`, `status`, `questions`, `popularity`) VALUES
('basicarch', 'I136676271036534800', 'Basic Architecture', 'basicarch', '6', 'architecture, buildings', 'This course is about basic architecture', '2013-04-24', 1, NULL, 6.67),
('film', 'I136676271036534800', 'Film Appreciation', 'film', '4', 'films', 'This course is about appreciating good films', '2013-04-24', 1, NULL, 3.33),
('WebDev101', 'I136674486538334500', 'Web Development', 'WebDev101', '1', 'web, web design, html, css, javascript', 'This course is about web design and web devlopment', '2013-04-24', 1, NULL, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `examquestions`
--

CREATE TABLE IF NOT EXISTS `examquestions` (
  `questionID` varchar(100) NOT NULL,
  `userID` varchar(100) NOT NULL,
  PRIMARY KEY (`questionID`,`userID`),
  KEY `quetionID_exam_idx` (`questionID`),
  KEY `userID_exam_idx` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `userID` varchar(100) NOT NULL,
  `friendID` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`userID`,`friendID`),
  KEY `friendID` (`friendID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`userID`, `friendID`, `status`) VALUES
('I136674486538334500', 'S136674435637058600', 1),
('I136676271036534800', 'S136674435637058600', 1),
('I136676271036534800', 'S136674465988990600', 1),
('S136674435637058600', 'I136674486538334500', 1),
('S136674435637058600', 'I136676271036534800', 1),
('S136674435637058600', 'S136674465988990600', 1),
('S136674465988990600', 'I136676271036534800', 1),
('S136674465988990600', 'S136674435637058600', 1),
('S136674465988990600', 'S136674474597936500', 1),
('S136674465988990600', 'S136677045863638600', 1),
('S136674465988990600', 'S136677051067086700', 1),
('S136674465988990600', 'S136677469982740100', 1),
('S136674474597936500', 'S136674435637058600', 2),
('S136674474597936500', 'S136674465988990600', 1),
('S136677045863638600', 'S136674465988990600', 1),
('S136677051067086700', 'S136674465988990600', 1),
('S136677469982740100', 'S136674465988990600', 1);

-- --------------------------------------------------------

--
-- Table structure for table `instructorbio`
--

CREATE TABLE IF NOT EXISTS `instructorbio` (
  `userID` varchar(100) NOT NULL,
  `organization` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `des` text,
  `cv` varchar(100) DEFAULT NULL,
  `demand` int(11) DEFAULT NULL,
  `status` enum('submitted','approved','rejected','removed') NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `userID_IB_idx` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructorbio`
--

INSERT INTO `instructorbio` (`userID`, `organization`, `position`, `des`, `cv`, `demand`, `status`) VALUES
('I136674486538334500', 'St. Xavier''s College', 'Professor', 'Teaching for 20 years', 'I136674486538334500.pdf', NULL, 'approved'),
('I136676271036534800', 'Architectural School of India', 'Professor', '10 years'' experience', 'I136676271036534800.pdf', NULL, 'approved'),
('I136678131502302900', 'SXC', 'Prof', 'Teacher for 10 years', 'I136678131502302900.pdf', NULL, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `userID` varchar(100) NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`userID`, `latitude`, `longitude`) VALUES
('I136676271036534800', 22.609574, 88.388958),
('S136674465988990600', 22.581750, 88.425372),
('S136674474597936500', 22.587386, 88.401833),
('S136677469982740100', 22.592458, 88.434963);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `chapterID` varchar(100) NOT NULL,
  `pageID` varchar(100) NOT NULL,
  `text` text,
  `image` varchar(100) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `heading` varchar(100) DEFAULT NULL,
  `visibility` int(11) DEFAULT NULL,
  PRIMARY KEY (`chapterID`,`pageID`),
  UNIQUE KEY `pageID_UNIQUE` (`pageID`),
  KEY `chapterID_Page_idx` (`chapterID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`chapterID`, `pageID`, `text`, `image`, `video`, `heading`, `visibility`) VALUES
('basicarch-U1-C1', 'basicarch-U1-C1-P1', 'Architecture (Latin architectura, from the Greek ?????????? – arkhitekton, from ????- "chief" and ?????? "builder, carpenter, mason") is both the process and product of planning, designing, and construction. Architectural works, in the material form of buildings, are often perceived as cultural symbols and as works of art. Historical civilizations are often identified with their surviving architectural achievements.', 'basicarch-U1-C1-P1.jpg', 'basicarch-U1-C1-P1.mp4', 'History of architecture', 1),
('basicarch-U1-C1', 'basicarch-U1-C1-P2', '"Architecture" can mean:\r\nA general term to describe buildings and other physical structures.\r\nThe art and science of designing and erecting buildings and other physical structures.\r\nThe style and method of design and construction of buildings and other physical structures.\r\nThe practice of the architect, where architecture means the offering or rendering of professional services in connection with the design and construction of buildings, or built environments.[1]\r\nThe design activity of the architect, from the macro-level (urban design, landscape architecture) to the micro-level (construction details and furniture).\r\nThe term "architecture" has been adopted to describe the activity of designing any kind of system, and is commonly used in describing information technology.', 'basicarch-U1-C1-P2.jpg', 'basicarch-U1-C1-P2.mp4', 'Meaning of architecture', 1),
('basicarch-U1-C1', 'basicarch-U1-C1-P3', 'The great 19th-century architect of skyscrapers, Louis Sullivan, promoted an overriding precept to architectural design: "Form follows function".\r\nWhile the notion that structural and aesthetic considerations should be entirely subject to functionality was met with both popularity and skepticism, it had the effect of introducing the concept of "function" in place of Vitruvius'' "utility". "Function" came to be seen as encompassing all criteria of the use, perception and enjoyment of a building, not only practical but also aesthetic, psychological and cultural.\r\n\r\n\r\nSydney Opera House, Australia designed by Jørn Utzon.\r\nNunzia Rondanini stated, "Through its aesthetic dimension architecture goes beyond the functional aspects that it has in common with other human sciences. Through its own particular way of expressing values, architecture can stimulate and influence social life without presuming that, in and of itself, it will promote social development.''', 'basicarch-U1-C1-P3.jpg', NULL, 'Modern architecture', 1),
('basicarch-U1-C2', 'basicarch-U1-C2-P1', 'Islamic architecture began in the 7th century CE, incorporating architectural forms from the ancient Middle East and Byzantium, but also developing features to suit the religious and social needs of the society. Examples can be found throughout the Middle East, North Africa, Spain and the Indian Sub-continent. The widespread application of the pointed arch was to influence European architecture of the Medieval period.', 'basicarch-U1-C2-P1.jpg', 'basicarch-U1-C2-P1.mp4', 'Taj Mahal', 1),
('basicarch-U1-C2', 'basicarch-U1-C2-P2', 'In Renaissance Europe, from about 1400 onwards, there was a revival of Classical learning accompanied by the development of Renaissance Humanism which placed greater emphasis on the role of the individual in society than had been the case during the Medieval period. Buildings were ascribed to specific architects – Brunelleschi, Alberti, Michelangelo, Palladio – and the cult of the individual had begun. There was still no dividing line between artist, architect and engineer, or any of the related vocations, and the appellation was often one of regional preference.\r\nA revival of the Classical style in architecture was accompanied by a burgeoning of science and engineering which affected the proportions and structure of buildings. At this stage, it was still possible for an artist to design a bridge as the level of structural calculations involved was within the scope of the generalist.', 'basicarch-U1-C2-P2.jpg', NULL, 'Renaissance and the architect', 1),
('basicarch-U1-C2', 'basicarch-U1-C2-P3', 'In Europe, in both the Classical and Medieval periods, buildings were not often attributed to specific individuals and the names of architects remain frequently unknown, despite the vast scale of the many religious buildings extant from this period.\r\nDuring the Medieval period guilds were formed by craftsmen to organize their trade and written contracts have survived, particularly in relation to ecclesiastical buildings. The role of architect was usually one with that of master mason, or Magister lathomorum as they are sometimes described in contemporary documents.', NULL, 'basicarch-U1-C2-P3.mp4', 'The medieval builder', 1),
('basicarch-U2-C1', 'basicarch-U2-C1-P1', 'Since the 1980s, as the complexity of buildings began to increase (in terms of structural systems, services, energy and technologies), the field of architecture became multi-disciplinary with specializations for each project type, technological expertise or project delivery methods. In addition, there has been an increased separation of the ''design'' architect [Notes 1] from the ''project'' architect who ensures that the project meets the required standards and deals with matters of liability.[Notes 2] The preparatory processes for the design of any large building have become increasingly complicated, and require preliminary studies of such matters as durability, sustainability, quality, money, and compliance with local laws. A large structure can no longer be the design of one person but must be the work of many. Modernism and Postmodernism, have been criticised by some members of the architectural profession who feel that successful architecture is not a personal philosophical or aesthetic pursuit by individualists; rather it has to consider everyday needs of people and use technology to create liveable environments, with the design process being informed by studies of behavioral, environmental, and social sciences.', 'basicarch-U2-C1-P1.jpg', NULL, 'Introduction', 1),
('basicarch-U2-C1', 'basicarch-U2-C1-P2', 'Environmental sustainability has become a mainstream issue, with profound affect on the architectural profession. Many developers, those who support the financing of buildings, have become educated to encourage the facilitation of environmentally sustainable design, rather than solutions based primarily on immediate cost. Major examples of this can be found in greener roof designs, biodegradable materials,and more attention to a structure''s energy usage. This major shift in architecture has also changed architecture schools to focus more on the environment. Sustainability in architecture was pioneered by Frank Lloyd Wright, in the 1960s by Buckminster Fuller and in the 1970s by architects such as Ian McHarg and Sim Van der Ryn in the US and Brenda and Robert Vale in the UK and New Zealand. There has been an acceleration in the number of buildings which seek to meet green building sustainable design principles. Sustainable practices that were at the core of vernacular architecture increasingly provide inspiration for environmentally and socially sustainable contemporary techniques.[12] The U.S. Green Building Council''s LEED (Leadership in Energy and Environmental Design) rating system has been instrumental in this.[13] An example of an architecturally innovative green building is the Dynamic Tower which will be powered by wind turbines and solar panels.[14]', 'basicarch-U2-C1-P2.jpg', 'basicarch-U2-C1-P2.mp4', 'Environment and the architecture', 1),
('basicarch-U2-C2', 'basicarch-U2-C2-P1', 'The intention of sustainable design is to "eliminate negative environmental impact completely through skillful, sensitive design".[1] Manifestations of sustainable design require no non-renewable resources, impact the environment minimally, and connect people with the natural environment.\r\nBeyond the "elimination of negative environmental impact", sustainable design must create projects that are meaningful innovations that can shift behaviour. A dynamic balance between economy and society, intended to generate long-term relationships between user and object/service and finally to be respectful and mindful of the environmental and social differences', 'basicarch-U2-C2-P1.jpg', 'basicarch-U2-C2-P1.mp4', 'Sustainable design', 1),
('basicarch-U2-C2', 'basicarch-U2-C2-P2', 'Conceptual architecture is a form of architecture that utilizes conceptualism, characterized by an introduction of ideas or concepts from outside of architecture often as a means of expanding the discipline of architecture. This produces an essentially different kind of building than one produced by the widely held ''architect as a master-builder'' model, in which craft and construction are the guiding principles. The finished building as product is less important in conceptual architecture, than the ideas guiding them, ideas represented primarily by texts, diagrams, or art installations. Architects that work in this vein are Diller + Scofidio, Bernard Tschumi, Peter Eisenman and Rem Koolhaas.\r\nConceptual architecture was studied in the essay, Notes on Conceptual Architecture: Towards a Definition by Peter Eisenman in 1970, and again by the Harvard Design Magazine in Fall of 2003 and Winter 2004, by a series of articles under the heading Architecture as Conceptual Art. But the understanding of design as a construction of a concept was understood by many modernist architects as well. To quote Louis Kahn on Frank Lloyd Wright:\r\nIt doesn''t work, it doesn''t have to work. Wright had the shape conceived long before he knew what was going into it. I claim that is where architecture starts, with the concept.', NULL, NULL, 'Conceptual architecture', 1),
('basicarch-U2-C2', 'basicarch-U2-C2-P3', 'While the practical application varies among disciplines, some common principles are as follows:\r\nLow-impact materials: choose non-toxic, sustainably produced or recycled materials which require little energy to process\r\nEnergy efficiency: use manufacturing processes and produce products which require less energy\r\nQuality and durability: longer-lasting and better-functioning products will have to be replaced less frequently, reducing the impacts of producing replacements\r\nDesign for reuse and recycling: "Products, processes, and systems should be designed for performance in a commercial ''afterlife''."[8]\r\nDesign impact measures for total carbon footprint and life-cycle assessment for any resource used are increasingly required and available. Many are complex, but some give quick and accurate whole-earth estimates of impacts. One measure estimates any spending as consuming an average economic share of global energy use of 8,000 BTU (8,400 kJ) per dollar and producing CO2 at the average rate of 0.57 kg of CO2 per dollar (1995 dollars US) from DOE figures.[9]\r\nSustainable design standards and project design guides are also increasingly available and are vigorously being developed by a wide array of private organizations and individuals. There is also a large body of new methods emerging from the rapid development of what has become known as ''sustainability science'' promoted by a wide variety of educational and governmental institutions.\r\nBiomimicry: "redesigning industrial systems on biological lines ... enabling the constant reuse of materials in continuous closed cycles..."[10]\r\nService substitution: shifting the mode of consumption from personal ownership of products to provision of services which provide similar functions, e.g., from a private automobile to a carsharing service. Such a system promotes minimal resource use per unit of consumption (e.g., per trip driven).[11]\r\nRenewability: materials should come from nearby (local or bioregional), sustainably managed renewable sources that can be composted when their usefulness has been exhausted.\r\nRobust eco-design: robust design principles are applied to the design of a pollution sources).', 'basicarch-U2-C2-P3.jpg', 'basicarch-U2-C2-P3.mp4', 'Conclusion: Principles', 1),
('film-U1-C1', 'film-U1-C1-P1', 'The first eleven years of motion pictures show the cinema moving from a novelty to an established large-scale entertainment industry. The films represent a movement from films consisting of one shot, completely made by one person with a few assistants, towards films several minutes long consisting of several shots, which were made by large companies in something like industrial conditions.', 'film-U1-C1-P1.jpg', NULL, 'Introduction', 1),
('film-U1-C1', 'film-U1-C1-P2', 'The first commercial exhibition of film took place on April 14, 1894 at Edison''s Kinetoscope peep-show parlor. The most successful motion picture company in the United States, with the largest production until 1900, was the American Mutoscope company. This was initially set up to exploit peep-show type films using designs made by W.K.L. Dickson after he left the Edison company in 1895. His equipment used 70 mm wide film, and each frame was printed separately onto paper sheets for insertion into their viewing machine, called the Mutoscope. The image sheets stood out from the periphery of a rotating drum, and flipped into view in succession.', NULL, NULL, 'Film business (1)', 1),
('film-U1-C1', 'film-U1-C1-P3', 'By 1896, it was clear that more money could be made by showing motion picture films with a projector to a large audience than exhibiting them in peep-show machines. The Edison company took up a projector developed by Armat and Jenkins, the "Phantoscope", which was renamed the Vitascope, and it joined various projecting machines made by other people to show the 480 mm width films being made by the Edison company and others in France and the UK. Besides the Mutoscope, American Mutoscope also made a projector called the Biograph, which could project a continuous positive film print made from the same negatives.\r\nFrom 1896 there was continuous litigation in the United States over the patents covering the basic mechanisms that made motion pictures possible.', 'film-U1-C1-P3.jpg', NULL, 'Film business (2)', 1),
('film-U1-C2', 'film-U1-C2-P1', '1906 saw the production of an Australian film called The Story of the Kelly Gang. The film ran for more than an hour, and was the longest narrative film yet seen in Australia, and the world. Its approximate reel length was 4,000 feet (1,200 m).[13] It was first shown in Melbourne, Australia on 26 December 1906 and in the UK in January 1908', NULL, NULL, 'Introduction', 1),
('film-U1-C2', 'film-U1-C2-P2', 'In 1907 there were about 4,000 small "nickelodeon" cinemas in the United States. The films were shown with the accompaniment of music provided by a pianist, though there could be more musicians. There were also a very few larger cinemas in some of the biggest cities. Initially, the majority of films in the programmes were Pathé films, but this changed fairly quickly as the American companies cranked up production. The programme was made up of just a few films, and the show lasted around 30 minutes. The reel of film, of maximum length 1,000 feet (300 m), which usually contained one individual film, became the standard unit of film production and exhibition in this period.', NULL, NULL, 'The film business', 1),
('film-U1-C3', 'film-U1-C3-P1', 'An even more important development was the use of the Point of View shot. Previously, these had only been used to convey the idea of what someone in the film was seeing through a telescope (or other aperture), and this was indicated by having a black circular mask or vignette within the film frame. The true Point of View (POV) shot, in which a shot of someone looking at something is followed by a cut to a shot taken from their position without any mask, took longer to appear. In 1910, in Vitagraph''s Back to Nature we see a Long Shot of people looking down over the rail of a ship taken from below, followed by a shot of the lifeboat they are looking at taken from their position.', 'film-U1-C3-P1.jpg', 'film-U1-C3-P1.mp4', 'Point of view shots', 1),
('film-U1-C3', 'film-U1-C3-P2', 'The years of the First World War were a complex transitional period for the film industry. It was the period when the exhibition of films changed from short programmes of one-reel films to longer shows consisting of a feature film of four reels or longer, though still supported by short films. The exhibition venues also changed from small nickelodeon cinemas to larger cinemas charging higher prices. These higher prices were partly justified by the new film stars who were now being created. In the United States, nearly all the original film companies which formed the Motion Picture Patents Company went out of business in this period because of their resistance to the changeover to long feature films. The one exception to this was the Vitagraph company, which was already moving over to long films by 1914. The move towards shooting more films on the West coast around Los Angeles continued during World War I, until the bulk of American production was carried out there.', NULL, NULL, 'The film business', 1),
('film-U1-C3', 'film-U1-C3-P3', 'In France, film production and exhibition closed down as its personnel became part of the general military mobilization of the country at the beginning of the war. Although film production began again in 1915, it was on a reduced scale, and the biggest companies gradually retired from production, to concentrate on film distribution and exhibition. Hence the cinemas were given over to imported films, particularly American ones. New small companies entered the business, and new young directors arrived to replace those drafted or working in the United States. The most notable of these was Abel Gance.', 'film-U1-C3-P3.jpg', NULL, 'European Film', 1),
('film-U1-C4', 'film-U1-C4-P1', 'Until this point, the cinemas of France and Italy had been the most globally popular and powerful. But the United States was already gaining quickly when World War I (1914–1918) caused a devastating interruption in the European film industries. The American industry, or "Hollywood", as it was becoming known after its new geographical center in California, gained the position it has held, more or less, ever since: film factory for the world, exporting its product to most countries on earth and controlling the market in many of them.\r\nBy the 1920s, the U.S. reached what is still its era of greatest-ever output, producing an average of 800 feature films annually,[16] or 82% of the global total (Eyman, 1997). The comedies of Charlie Chaplin and Buster Keaton, the swashbuckling adventures of Douglas Fairbanks and the romances of Clara Bow, to cite just a few examples, made these performers’ faces well-known on every continent. The Western visual norm that would become classical continuity editing was developed and exported – although its adoption was slower in some non-Western countries without strong realist traditions in art and drama, such as Japan.', NULL, NULL, 'Why Hollywood', 1),
('film-U1-C4', 'film-U1-C4-P2', 'This development was contemporary with the growth of the studio system and its greatest publicity method, the star system, which characterized American film for decades to come and provided models for other film industries. The studios’ efficient, top-down control over all stages of their product enabled a new and ever-growing level of lavish production and technical sophistication. At the same time, the system''s commercial regimentation and focus on glamorous escapism discouraged daring and ambition beyond a certain degree, a prime example being the brief but still legendary directing career of the iconoclastic Erich von Stroheim in the late teens and the ‘20s.', 'film-U1-C4-P2.jpg', NULL, 'More about Hollywood''s history', 1),
('film-U2-C1', 'film-U2-C1-P1', 'The change was remarkably swift. By the end of 1929, Hollywood was almost all-talkie, with several competing sound systems (soon to be standardized). Total changeover was slightly slower in the rest of the world, principally for economic reasons. Cultural reasons were also a factor in countries like China and Japan, where silents co-existed successfully with sound well into the 1930s, indeed producing what would be some of the most revered classics in those countries, like Wu Yonggang''s The Goddess (China, 1934) and Yasujir? Ozu''s I Was Born, But... (Japan, 1932). But even in Japan, a figure such as the benshi, the live narrator who was a major part of Japanese silent cinema, found his acting career was ending.', 'film-U2-C1-P1.jpg', 'film-U2-C1-P1.mp4', 'Introduction to sounds', 1),
('film-U2-C1', 'film-U2-C1-P2', 'Sound further tightened the grip of major studios in numerous countries: the vast expense of the transition overwhelmed smaller competitors, while the novelty of sound lured vastly larger audiences for those producers that remained. In the case of the U.S., some historians credit sound with saving the Hollywood studio system in the face of the Great Depression (Parkinson, 1995). Thus began what is now often called "The Golden Age of Hollywood", which refers roughly to the period beginning with the introduction of sound until the late 1940s. The American cinema reached its peak of efficiently manufactured glamour and global appeal during this period. The top actors of the era are now thought of as the classic film stars, such as Clark Gable, Katharine Hepburn, Humphrey Bogart, Greta Garbo, and the greatest box office draw of the 1930s, child performer Shirley Temple.', 'film-U2-C1-P2.jpg', 'film-U2-C1-P2.mp4', 'Industry and the sound', 1),
('film-U2-C2', 'film-U2-C2-P1', 'This awkward period was fairly short-lived. 1929 was a watershed year: William Wellman with Chinatown Nights and The Man I Love, Rouben Mamoulian with Applause, Alfred Hitchcock with Blackmail (Britain''s first sound feature), were among the directors to bring greater fluidity to talkies and experiment with the expressive use of sound (Eyman, 1997). In this, they both benefited from, and pushed further, technical advances in microphones and cameras, and capabilities for editing and post-synchronizing sound (rather than recording all sound directly at the time of filming).', 'film-U2-C2-P1.jpg', NULL, 'Sound and creativity', 1),
('film-U2-C2', 'film-U2-C2-P2', 'Creatively, however, the rapid transition was a difficult one, and in some ways, film briefly reverted to the conditions of its earliest days. The late ''20s were full of static, stagey talkies as artists in front of and behind the camera struggled with the stringent limitations of the early sound equipment and their own uncertainty as to how to utilize the new medium. Many stage performers, directors and writers were introduced to cinema as producers sought personnel experienced in dialogue-based storytelling. Many major silent filmmakers and actors were unable to adjust and found their careers severely curtailed or even ended.', NULL, NULL, 'How sound became creative', 1),
('film-U2-C3', 'film-U2-C3-P1', 'The desire for wartime propaganda created a renaissance in the film industry in Britain, with realistic war dramas like 49th Parallel (1941), Went the Day Well? (1942), The Way Ahead (1944) and Noël Coward and David Lean''s celebrated naval film In Which We Serve in 1942, which won a special Academy Award. These existed alongside more flamboyant films like Michael Powell and Emeric Pressburger''s The Life and Death of Colonel Blimp (1943), A Canterbury Tale (1944) and A Matter of Life and Death (1946), as well as Laurence Olivier''s 1944 film Henry V, based on the Shakespearean history Henry V. The success of Snow White and the Seven Dwarfs allowed Disney to make more animated features like Pinocchio (1940), Fantasia (1940), Dumbo (1941) and Bambi (1942).', 'film-U2-C3-P1.jpg', 'film-U2-C3-P1.mp4', 'Introduction', 1),
('film-U2-C3', 'film-U2-C3-P2', 'The onset of US involvement in World War II also brought a proliferation of films as both patriotism and propaganda. American propaganda films included Desperate Journey, Mrs. Miniver, Forever and a Day and Objective Burma. Notable American films from the war years include the anti-Nazi Watch on the Rhine (1943), scripted by Dashiell Hammett; Shadow of a Doubt (1943), Hitchcock''s direction of a script by Thornton Wilder; the George M. Cohan biopic, Yankee Doodle Dandy (1942), starring James Cagney, and the immensely popular Casablanca, with Humphrey Bogart. Bogart would star in 36 films between 1934 and 1942 including John Huston''s The Maltese Falcon (1941), one of the first films now considered a classic film noir. In 1941, RKO Pictures released Citizen Kane made by Orson Welles. It is often considered the greatest film of all time. It would set the stage for the modern motion picture, as it revolutionized film story telling.', 'film-U2-C3-P2.jpg', 'film-U2-C3-P2.mp4', 'More about the post war period', 1),
('film-U2-C3', 'film-U2-C3-P3', 'The strictures of wartime also brought an interest in more fantastical subjects. These included Britain''s Gainsborough melodramas (including The Man in Grey and The Wicked Lady), and films like Here Comes Mr. Jordan, Heaven Can Wait, I Married a Witch and Blithe Spirit. Val Lewton also produced a series of atmospheric and influential small-budget horror films, some of the more famous examples being Cat People, Isle of the Dead and The Body Snatcher. The decade probably also saw the so-called "women''s pictures", such as Now, Voyager, Random Harvest and Mildred Pierce at the peak of their popularity.', 'film-U2-C3-P3.jpg', 'film-U2-C3-P3.mp4', 'Popularity', 1),
('film-U2-C4', 'film-U2-C4-P1', 'The House Un-American Activities Committee investigated Hollywood in the early 1950s. Protested by the Hollywood Ten before the committee, the hearings resulted in the blacklisting of many actors, writers and directors, including Chayefsky, Charlie Chaplin, and Dalton Trumbo, and many of these fled to Europe, especially the United Kingdom.', 'film-U2-C4-P1.jpg', 'film-U2-C4-P1.mp4', 'American and British Movies of the era', 1),
('film-U2-C4', 'film-U2-C4-P2', 'The Cold War era zeitgeist translated into a type of near-paranoia manifested in themes such as invading armies of evil aliens, (Invasion of the Body Snatchers, The War of the Worlds); and communist fifth columnists, (The Manchurian Candidate).', 'film-U2-C4-P2.jpg', NULL, 'The cold war era', 1),
('film-U2-C5', 'film-U2-C5-P1', 'Main article: Asian cinema\r\n\r\n\r\nSatyajit Ray, Indian Bengali film director.\r\nFollowing the end of World War II in the 1940s, the following decade, the 1950s, marked a ''Golden Age'' for non-English world cinema,[17][18] especially for Asian cinema.[19][20] Many of the most critically acclaimed Asian films of all time were produced during this decade, including Yasujir? Ozu''s Tokyo Story (1953), Satyajit Ray''s The Apu Trilogy (1955–1959) and The Music Room (1958), Kenji Mizoguchi''s Ugetsu (1954) and Sansho the Bailiff (1954), Raj Kapoor''s Awaara (1951), Mikio Naruse''s Floating Clouds (1955), Guru Dutt''s Pyaasa (1957) and Kaagaz Ke Phool (1959), and the Akira Kurosawa films Rashomon (1950), Ikiru (1952), Seven Samurai (1954) and Throne of Blood (1957))', NULL, NULL, 'Golden Age of Asian cinema', 1),
('film-U2-C5', 'film-U2-C5-P2', 'During Japanese cinema''s ''Golden Age'' of the 1950s, successful films included Rashomon (1950), Seven Samurai (1954) and The Hidden Fortress (1958) by Akira Kurosawa, as well as Yasujir? Ozu''s Tokyo Story (1953) and Ishir? Honda''s Godzilla (1954).[21] These films have had a profound influence on world cinema. In particular, Kurosawa''s Seven Samurai has been remade several times as Western films, such as The Magnificent Seven (1960) and Battle Beyond the Stars (1980), and has also inspired several Bollywood films, such as Sholay (1975) and China Gate (1998). Rashomon was also remade as The Outrage (1964), and inspired films with "Rashomon effect" storytelling methods, such as Andha Naal (1954), The Usual Suspects (1995) and Hero (2002). The Hidden Fortress was also the inspiration behind George Lucas'' Star Wars (1977). Other famous Japanese filmmakers from this period include Kenji Mizoguchi, Mikio Naruse, Hiroshi Inagaki and Nagisa Oshima.[19] Japanese cinema later became one of the main inspirations behind the New Hollywood movement of the 1960s to 1980s.', 'film-U2-C5-P2.jpg', NULL, 'Indian Cinema and Satyajit Ray', 1),
('WebDev101-U1-C1', 'WebDev101-U1-C1-P1', 'HTML headings are defined with the h1 to h6 tags', 'WebDev101-U1-C1-P1.jpg', 'WebDev101-U1-C1-P1.mp4', 'HTML Headings', 1),
('WebDev101-U1-C1', 'WebDev101-U1-C1-P2', 'HTML paragraphs are defined with the <p> tag.', 'WebDev101-U1-C1-P2.jpg', 'WebDev101-U1-C1-P2.mp4', 'HTML paragraphs', 1),
('WebDev101-U1-C1', 'WebDev101-U1-C1-P3', 'HTML links are defined with the <a> tag.', NULL, NULL, 'HTML links', 1),
('WebDev101-U1-C1', 'WebDev101-U1-C1-P4', 'HTML images are defined with the <img> tag.', NULL, NULL, 'HTML Images', 1),
('WebDev101-U1-C2', 'WebDev101-U1-C2-P1', 'An HTML attribute is a modifier of an HTML element. HTML attributes generally appear as name-value pairs, separated by "=", and are written within the start tag of an element, after the element''s name:\r\n<tag attribute="value">(content to be modified by the tag)</tag>', NULL, NULL, 'Introduction', 1),
('WebDev101-U1-C2', 'WebDev101-U1-C2-P2', 'The value may be enclosed in single or double quotes, although values consisting of certain characters can be left unquoted in HTML (but not XHTML). Leaving attribute values unquoted is considered unsafe.\r\nAlthough most attributes are provided as paired names and values, some affect the element simply by their presence in the start tag of the element (like the ismap attribute for the img element).', NULL, NULL, 'More about attributes', 1),
('WebDev101-U1-C2', 'WebDev101-U1-C2-P3', 'Most elements can take any of several common attributes:\r\nThe id attribute provides a document-wide unique identifier for an element. This can be used as CSS selector to provide presentational properties, by browsers to focus attention on the specific element, or by scripts to alter the contents or presentation of an element. Appended to the URL of the page, the URL directly targets the specific element within the document, typically a sub-section of the page. For example, the ID "Attributes" in http://en.wikipedia.org/wiki/HTML#Attributes\r\nThe class attribute provides a way of classifying similar elements. This can be used for semantic or presentation purposes. Semantically, for example, classes are used in microformats. Presentationally, for example, an HTML document might use the designation class="notation" to indicate that all elements with this class value are subordinate to the main text of the document. Such elements might be gathered together and presented as footnotes on a page instead of appearing in the place where they occur in the HTML source.\r\nAn author may use the style non-attributal codes presentational properties to a particular element. It is considered better practice to use an element’s id or class attributes to select the element with a stylesheet, though sometimes this can be too cumbersome for a simple and specific or ad hoc application of styled properties.\r\nThe title attribute is used to attach subtextual explanation to an element. In most browsers this attribute is displayed as what is often referred to as a tooltip.\r\nThe abbreviation element, abbr, can be used to demonstrate these various attributes:\r\n<abbr id="anId" class="aClass"  title="Hypertext Markup Language">HTML</abbr>\r\nThis example displays as HTML; in most browsers, pointing the cursor at the abbreviation should display the title text "Hypertext Markup Language."\r\nMost elements also take the language-related attributes lang and dir.', NULL, NULL, 'Types of attributes', 1),
('WebDev101-U1-C3', 'WebDev101-U1-C3-P1', 'Headings are defined with the <h1> to <h6> tags.\r\n\r\n<h1> defines the most important heading. <h6> defines the least important heading.', NULL, NULL, 'Introduction', 1),
('WebDev101-U1-C3', 'WebDev101-U1-C3-P2', 'Take a look at the following code:\r\n<h1>This is a heading</h1>\r\n<h2>This is a heading</h2>\r\n<h3>This is a heading</h3>', NULL, NULL, 'Example', 1),
('WebDev101-U1-C4', 'WebDev101-U1-C4-P1', 'Publishing any kind of written work requires the use of a paragraph. The paragraph tag is very basic and a great introductory tag for beginner''s because of its simplicity. HTML documents are divided into paragraphs.', NULL, NULL, 'Why do we need paragraphs?', 1),
('WebDev101-U1-C4', 'WebDev101-U1-C4-P2', 'The <p> tag defines a paragraph. Using this tag places a blank line above and below the text of the paragraph. These automated blank lines are examples of how a tag "marks" a paragraph and the web browser automatically understands how to display the paragraph text because of the paragraph tag.\r\n\r\nHTML Code:\r\n<p>Avoid losing floppy disks with important school...</p>\r\n<p>For instance, let''s say you had a HUGE school...</p>', NULL, NULL, 'The use of paragraphs', 1),
('WebDev101-U1-C5', 'WebDev101-U1-C5-P1', '<p><b>This text is bold</b></p>\r\n<p><strong>This text is strong</strong></p>\r\n<p><i>This text is italic</i></p>\r\n<p><em>This text is emphasized</em></p>\r\n<p><code>This is computer output</code></p>\r\n<p>This is<sub> subscript</sub> and <sup>superscript</sup></p>', NULL, NULL, 'The use of formatting', 1),
('WebDev101-U2-C1', 'WebDev101-U2-C1-P1', 'HTML5 is a markup language for structuring and presenting content for the World Wide Web and a core technology of the Internet. It is the fifth revision of the HTML standard (created in 1990 and standardized as HTML 4 as of 1997) and, as of December 2012, is a W3C Candidate Recommendation. Its core aims have been to improve the language with support for the latest multimedia while keeping it easily readable by humans and consistently understood by computers and devices (web browsers, parsers, etc.). HTML5 is intended to subsume not only HTML 4, but also XHTML 1 and DOM Level 2 HTML', 'WebDev101-U2-C1-P1', 'WebDev101-U2-C1-P1', 'Why HTML 5?', 1),
('WebDev101-U2-C1', 'WebDev101-U2-C1-P2', 'The Web Hypertext Application Technology Working Group (WHATWG) began work on the new standard in 2004. At that time, HTML 4.01 had not been updated since 2000,[8] and the World Wide Web Consortium (W3C) was focusing future developments on XHTML 2.0. In 2009, the W3C allowed the XHTML 2.0 Working Group''s charter to expire and decided not to renew it. W3C and WHATWG are currently working together on the development of HTML5.[9]\r\nWhile HTML5 is often compared to Flash, the two technologies are very different. Both include features for playing audio and video within web pages, and for using Scalable Vector Graphics. HTML5 on its own cannot be used for animation and interactivity — it must be supplemented with CSS3 or JavaScript. There are many Flash capabilities that have no direct counterpart in HTML5. See Comparison of HTML5 and Flash.\r\nAlthough HTML5 has been well known among web developers for years, it became the topic of mainstream media around April 2010[10][11][12][13] after Apple Inc''s then-CEO Steve Jobs issued a public letter titled "Thoughts on Flash" where he concludes that "[Adobe] Flash is no longer necessary to watch video or consume any kind of web content" and that "new open standards created in the mobile era, such as HTML5, will win".[14] This sparked a debate in web development circles where some suggested that while HTML5 provides enhanced functionality, developers must consider the varying browser support of the different parts of the standard as well as other functionality differences between HTML5 and Flash.[15] In early November 2011, Adobe announced that it will discontinue development of Flash for mobile devices and reorient its efforts in developing tools utilizing HTML5', NULL, NULL, 'History of HTML5', 1),
('WebDev101-U2-C1', 'WebDev101-U2-C1-P3', 'The canvas element is used to draw graphics, on the fly, on a web page.\r\n\r\nDraw a red rectangle, a gradient rectangle, a multicolor rectangle, and some multicolor text onto the canvas', NULL, NULL, 'HTML5 Canvas', 1),
('WebDev101-U2-C1', 'WebDev101-U2-C1-P4', 'The HTML5 Geolocation API is used to get the geographical position of a user.\r\n\r\nSince this can compromise user privacy, the position is not available unless the user approves it.\r\n\r\nUse the getCurrentPosition() method to get the user''s position.\r\n\r\nThe example below is a simple Geolocation example returning the latitude and longitude of the user''s position', 'WebDev101-U2-C1-P4.jpg', 'WebDev101-U2-C1-P4.mp4', 'HTML5 Geolocation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `postID` varchar(100) NOT NULL,
  `threadID` varchar(100) DEFAULT NULL,
  `userID` varchar(100) DEFAULT NULL,
  `content` text,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`postID`),
  KEY `userID_posts_idx` (`userID`),
  KEY `threadID_posts_idx` (`threadID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `threadID`, `userID`, `content`, `date`) VALUES
('basicarch-T1-P1', 'basicarch-T1', 'S136674465988990600', 'test!!', '30 Apr 2013 17:26:01'),
('WebDev101-T1-P1', 'WebDev101-T1', 'I136674486538334500', 'Use the div tag', '24 Apr 2013 02:23:31'),
('WebDev101-T1-P2', 'WebDev101-T1', 'S136674474597936500', 'Thank You Sir!', '24 Apr 2013 02:23:41'),
('WebDev101-T1-P3', 'WebDev101-T1', 'I136674486538334500', ':)', '24 Apr 2013 02:23:47'),
('WebDev101-T2-P5', 'WebDev101-T2', 'S136677469982740100', 'LOL', '24 Apr 2013 09:22:40'),
('WebDev101-T2-P6', 'WebDev101-T2', 'S136677469982740100', 'LOL', '24 Apr 2013 09:23:42'),
('WebDev101-T2-P7', 'WebDev101-T2', 'S136677469982740100', 'LOL', '24 Apr 2013 09:23:57'),
('WebDev101-T2-P8', 'WebDev101-T2', 'S136677469982740100', 'LOL', '24 Apr 2013 09:24:44'),
('WebDev101-T3-P1', 'WebDev101-T2', 'I136674486538334500', 'Intersted people please contact me at xyz@yyy.gmail.com', '24 Apr 2013 02:25:29'),
('WebDev101-T3-P2', 'WebDev101-T2', 'S136674474597936500', 'Sir I am intersted! When is it from?', '24 Apr 2013 02:26:03'),
('WebDev101-T3-P3', 'WebDev101-T2', 'I136674486538334500', 'It is from 21st May 2013', '24 Apr 2013 02:26:22'),
('WebDev101-T3-P4', 'WebDev101-T2', 'I136674486538334500', 'I just told you', '24 Apr 2013 02:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `questionbank`
--

CREATE TABLE IF NOT EXISTS `questionbank` (
  `questionID` varchar(100) NOT NULL,
  `courseID` varchar(100) DEFAULT NULL,
  `question` varchar(100) DEFAULT NULL,
  `wrongOptions` varchar(100) DEFAULT NULL,
  `correctOption` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `difficulty` int(2) DEFAULT NULL,
  `attempts` int(11) DEFAULT NULL,
  `correctAttempts` int(11) DEFAULT NULL,
  PRIMARY KEY (`questionID`),
  KEY `chapterID_QB_idx` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questionbank`
--

INSERT INTO `questionbank` (`questionID`, `courseID`, `question`, `wrongOptions`, `correctOption`, `status`, `difficulty`, `attempts`, `correctAttempts`) VALUES
('film-Q1', 'film', 'Who is the first Oscar winner of India?', 'Satyajit Ray,A.R. Rahman,Aamir Khan', 'Bhanu Athaiya', 1, 8, 0, 0),
('film-Q10', 'film', 'Where was the Indian International Film (IIFA) held last year?', 'Mumbai,Chennai,Bhubaneshwar', 'Goa', 1, 0, 0, 0),
('film-Q11', 'film', 'Who was featured in last year''s Cannes Festival to mark her 50th death wanniversary?', 'Audrey Hepburn,Princess Diana,Elizabeth Taylor', 'Marilyn Monroe', 1, 4, 0, 0),
('film-Q12', 'film', 'Which actor played the role of The Joker of the 90''s era Batman movie?', 'Michael Caine,Bruce Lee,Bruce Willis', 'Jack Nicholson', 1, 1, 0, 0),
('film-Q2', 'film', 'Who starred in the movie "3 Idiots"?', 'Hrithik Roshan,A.R. Rahman,Shah Rukh Khan', 'Aamir Khan', 1, 3, 0, 0),
('film-Q3', 'film', 'Who is the director of the movie Schindler''s List?', 'Satyajit Ray,A.R. Rahman,Aamir Khan', 'Steven Spielberg', 1, 5, 0, 0),
('film-Q4', 'film', 'Which movie got the oscar for best orignial soundtrack in the 83rd Academy Awards?', 'Life of Pi,Argo,Lagaan', 'Skyfall', 1, 4, 0, 0),
('film-Q5', 'film', 'Who is the only Indian to get The Life time Achievement Award at the Oscars?', 'Amitabh Bachhan,Dev Anand,Pran', 'Satyajit Ray', 1, 0, 0, 0),
('film-Q6', 'film', 'Who was given The life time achievement award at the recent Mumbai Film Festival', 'Rekha,Suchitra Sen,Amitabh Bacchan', 'Fareeda Rehman', 1, 0, 0, 0),
('film-Q7', 'film', 'Who is known as the father of Indian Cinema?', 'Amitabh Bachhan,Raj Kapoor,Satyajit Ray', 'Dadahaheb Phalke', 1, 0, 0, 0),
('film-Q8', 'film', 'Which Indian Actor was chosen by the Ministry of Rural Development as the brand ambassador for the T', 'Priyanka Chopra,Ashwarya Ray,Frieda Pinto', 'Vidya Balan', 1, 0, 0, 0),
('film-Q9', 'film', 'Which India documentary was awarded the best documentary award a few years back?', 'The Road to my village,Suffar,Mumbai Talkies', 'Smile Pinki', 1, 0, 0, 0),
('WebDev101-Q1', 'WebDev101', 'What is the full form of HTML?', 'Hypertext marking language,Hypertext marked language,Hypertext markup logarithm', 'Hypertext markup language', 1, 1, 1, 1),
('WebDev101-Q10', 'WebDev101', 'What is the latest version of HTML?', 'HTML 4,HTML 3,HTML 2', 'HTML 5', 1, 0, 2, 1),
('WebDev101-Q11', 'WebDev101', 'What is the full form of CSS?', 'Clear Styling using Styles,Cool Style Sheets,Composite Style Sheets', 'Cascading Style Sheets', 1, 4, 2, 2),
('WebDev101-Q12', 'WebDev101', 'What is the the use of # in links in HTML?', 'External Links,Calling another page,Decoration', 'Internal Links', 1, 4, 0, 0),
('WebDev101-Q13', 'WebDev101', 'Who parses an HTML document?', 'Server,C Compiler,PHP Compiler', 'Browser', 1, 5, 0, 0),
('WebDev101-Q14', 'WebDev101', 'Who is regarded as the founder of WWW?', 'Bill Gates,Steve Jobs,Anuvabh Dutt', 'Tim Berners-Lee ', 1, 6, 0, 0),
('WebDev101-Q15', 'WebDev101', 'Which of the following is NOT a browser?', 'Google Chrome,Mozilla Firefox,Netscape', 'MS Access', 1, 2, 2, 2),
('WebDev101-Q16', 'WebDev101', 'Where is the database generally stored?', 'Client,Standalone machine,Satellite', 'Server', 1, 3, 1, 1),
('WebDev101-Q2', 'WebDev101', 'Why do we use Javascript?', 'Server Side Scripting,Layout in a webpage,AJAX', 'Client Side Scripting', 1, 3, 1, 0),
('WebDev101-Q3', 'WebDev101', 'Why do we need PHP?', 'Client Side Scripting,For designing HTML documents,AJAX', 'Server Side Scripting', 1, 1, 1, 1),
('WebDev101-Q4', 'WebDev101', 'HTML tags are surrounded by', 'Curly brackets,No bracket,First Bracket', 'Angular brackets', 1, 3, 2, 2),
('WebDev101-Q5', 'WebDev101', 'The outermost tag in a HTML document is', 'body tag,div tag,table tag', 'html tag', 1, 2, 1, 0),
('WebDev101-Q6', 'WebDev101', 'HTML tags are', 'Case Sensitive,Numbered and case sensitive,Composed of symbols. So no question of case sensitivity', 'Case insensitive', 1, 3, 1, 0),
('WebDev101-Q7', 'WebDev101', 'What is the use of a &lt;br&gt; tag?', 'Broad line,Borad ruler,End of file', 'Break line', 1, 2, 2, 1),
('WebDev101-Q8', 'WebDev101', 'What tag is used for links?', 'br tag,hr tag,img tag', 'a tag', 1, 3, 0, 0),
('WebDev101-Q9', 'WebDev101', 'Which tag is used for submitting data to the server from an input?', 'hr tag,br tag,div tag', 'form tag', 1, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `registryvalues`
--

CREATE TABLE IF NOT EXISTS `registryvalues` (
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`name`,`value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentchapterstats`
--

CREATE TABLE IF NOT EXISTS `studentchapterstats` (
  `userID` varchar(100) NOT NULL,
  `chapterID` varchar(100) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  PRIMARY KEY (`userID`,`chapterID`),
  KEY `userID_SCS_idx` (`userID`),
  KEY `chapterID_SCS_idx` (`chapterID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentcoursestats`
--

CREATE TABLE IF NOT EXISTS `studentcoursestats` (
  `userID` varchar(100) NOT NULL,
  `courseID` varchar(100) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `percentage` int(11) DEFAULT '0',
  PRIMARY KEY (`userID`,`courseID`),
  KEY `userID_idx` (`userID`),
  KEY `courseID_idx` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentcoursestats`
--

INSERT INTO `studentcoursestats` (`userID`, `courseID`, `startDate`, `endDate`, `percentage`) VALUES
('S136674435637058600', 'webdev101', '2013-04-24', NULL, 0),
('S136674465988990600', 'basicarch', '2013-04-24', NULL, 0),
('S136674465988990600', 'film', '2013-04-24', NULL, 0),
('S136674474597936500', 'basicarch', '2013-04-24', NULL, 0),
('S136674474597936500', 'WebDev101', '2013-04-24', '2013-04-24', 70),
('S136677045863638600', 'basicarch', '2013-04-24', NULL, 0),
('S136677469982740100', 'basicarch', '2013-04-24', NULL, 0),
('S136677469982740100', 'film', '2013-04-24', NULL, 0),
('S136677469982740100', 'WebDev101', '2013-04-24', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `studentprogress`
--

CREATE TABLE IF NOT EXISTS `studentprogress` (
  `userID` varchar(100) NOT NULL,
  `courseID` varchar(100) NOT NULL,
  `lastPage` varchar(100) DEFAULT NULL,
  `completed` int(11) NOT NULL DEFAULT '0',
  `certified` int(11) DEFAULT NULL,
  PRIMARY KEY (`userID`,`courseID`),
  KEY `userID_idx` (`userID`),
  KEY `courseID_idx` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentprogress`
--

INSERT INTO `studentprogress` (`userID`, `courseID`, `lastPage`, `completed`, `certified`) VALUES
('S136674435637058600', 'webdev101', 'WebDev101-U2-C1-P4', 1, 0),
('S136674465988990600', 'basicarch', 'basicarch-U1-C1-P1', 0, 0),
('S136674465988990600', 'film', 'film-U1-C2-P1', 0, 0),
('S136674474597936500', 'basicarch', 'basicarch-U2-C2-P3', 1, 0),
('S136674474597936500', 'WebDev101', 'WebDev101-U2-C1-P4', 1, 1),
('S136677045863638600', 'basicarch', '0', 0, 0),
('S136677469982740100', 'basicarch', '0', 0, 0),
('S136677469982740100', 'film', '0', 0, 0),
('S136677469982740100', 'WebDev101', '0', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subjectID` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `stream` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`subjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectID`, `name`, `stream`) VALUES
('1', 'Computer Science', 'Science'),
('2', 'Mathematics', 'Science'),
('3', 'English', 'Humanities'),
('4', 'History', 'Humanities'),
('5', 'Statistics', 'Science'),
('6', 'Physics', 'Science'),
('7', 'Biology', 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `courseID` varchar(100) NOT NULL,
  `threadID` varchar(100) NOT NULL,
  `userID` varchar(100) DEFAULT NULL,
  `subject` text,
  `content` text,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`courseID`,`threadID`),
  UNIQUE KEY `threadID` (`threadID`),
  KEY `userID_thread_idx` (`userID`),
  KEY `courseID` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`courseID`, `threadID`, `userID`, `subject`, `content`, `date`) VALUES
('basicarch', 'basicarch-T1', 'S136674465988990600', 'Inception', 'is it true?', '25 Apr 2013 00:03:33'),
('WebDev101', 'WebDev101-T1', 'S136674474597936500', 'DIV tag', 'How to create a div?', '24 Apr 2013 02:00:47'),
('WebDev101', 'WebDev101-T2', 'I136674486538334500', 'HTML5 Workshop', 'Is  anyone interested in HTML5 Workshop?', '24 Apr 2013 02:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `courseID` varchar(100) NOT NULL,
  `unitID` varchar(100) NOT NULL,
  `unitName` varchar(100) DEFAULT NULL,
  `description` text,
  `status` int(11) DEFAULT NULL,
  `chapters` int(11) DEFAULT NULL,
  `questions` int(11) DEFAULT NULL,
  PRIMARY KEY (`courseID`,`unitID`),
  UNIQUE KEY `unitID_UNIQUE` (`unitID`),
  KEY `courseID_UNITS_idx` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`courseID`, `unitID`, `unitName`, `description`, `status`, `chapters`, `questions`) VALUES
('basicarch', 'basicarch-U1', 'Residential Buildings', 'This unit dicusses about residential architecture', 1, NULL, NULL),
('basicarch', 'basicarch-U2', 'Architechture Today', 'Architechture Today', 1, NULL, NULL),
('film', 'film-U1', 'Early Movies', 'Early Movies', 1, NULL, NULL),
('film', 'film-U2', 'The sound era', 'The sound era', 1, NULL, NULL),
('film', 'film-U3', 'Late Movies', '12', 1, NULL, NULL),
('WebDev101', 'WebDev101-U1', 'Basic HTML', 'Introduction to HTML', 1, NULL, NULL),
('WebDev101', 'WebDev101-U2', 'HTML 5', 'The newest version of HTML is HTML5\r\n', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` varchar(100) NOT NULL,
  `userType` enum('student','instructor','admin','guest') DEFAULT 'guest',
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `gender` enum('m','f') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `lastUpdate` date DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userType`, `username`, `email`, `password`, `firstName`, `lastName`, `gender`, `dob`, `status`, `photo`, `lastLogin`, `lastUpdate`) VALUES
('1', 'admin', 'admin', 'admin@gmail.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'admin', 'admin', 'm', NULL, 1, NULL, '2013-04-24 10:59:15', NULL),
('I136674486538334500', 'instructor', 'kg', 'kg@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Kaushik', 'Goswami', 'm', '1982-12-01', 1, 'I136674486538334500.jpg', '2013-04-24 02:02:22', '2013-04-24'),
('I136676271036534800', 'instructor', 'ted', 'ted@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Ted', 'Mosby', 'm', '1782-12-09', 1, 'I136676271036534800.jpg', '2013-04-24 10:55:34', '2013-04-24'),
('I136678131502302900', 'instructor', NULL, 'abc@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'BCC', 'DEB', NULL, NULL, 1, 'default.jpg', '2013-04-24 10:58:35', '2013-04-24'),
('S136674435637058600', 'student', 'mourjo', 'sen.mourjo@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Mourjo', 'Sen', 'm', '1992-06-09', 1, 'S136674435637058600.jpg', '2013-04-24 10:54:20', '2013-04-24'),
('S136674465988990600', 'student', 'anuvabh', 'anuvabhdutt@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Anuvabh', 'Dutt', 'm', '1992-01-02', 1, 'S136674465988990600.jpg', '2013-05-24 00:40:57', '2013-05-24'),
('S136674474597936500', 'student', 'jenni', 'jennifer@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Jennifer', 'Shah', 'f', '1991-07-16', 1, 'S136674474597936500.jpg', '2013-04-24 09:25:16', '2013-04-24'),
('S136677045863638600', 'student', NULL, 'aritra@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Aritra', 'Mitra', NULL, NULL, 1, 'default.jpg', '2013-04-24 07:57:38', '2013-04-24'),
('S136677051067086700', 'student', NULL, 'barney@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Barney', 'Stinson', NULL, NULL, 1, 'default.jpg', '2013-04-24 07:58:30', '2013-04-24'),
('S136677469982740100', 'student', NULL, 'avik@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Avik', 'Guha', 'm', NULL, 1, 'default.jpg', '2013-04-30 17:27:20', '2013-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `visitedpages`
--

CREATE TABLE IF NOT EXISTS `visitedpages` (
  `userID` varchar(100) NOT NULL,
  `pageID` varchar(100) NOT NULL,
  PRIMARY KEY (`userID`,`pageID`),
  KEY `pageID` (`pageID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitedpages`
--

INSERT INTO `visitedpages` (`userID`, `pageID`) VALUES
('S136674465988990600', 'basicarch-U1-C1-P1'),
('S136674474597936500', 'basicarch-U1-C1-P1'),
('S136674474597936500', 'basicarch-U1-C1-P2'),
('S136674474597936500', 'basicarch-U1-C1-P3'),
('S136674465988990600', 'basicarch-U1-C2-P1'),
('S136674474597936500', 'basicarch-U1-C2-P1'),
('S136674474597936500', 'basicarch-U1-C2-P2'),
('S136674474597936500', 'basicarch-U1-C2-P3'),
('S136674474597936500', 'basicarch-U2-C1-P1'),
('S136674474597936500', 'basicarch-U2-C1-P2'),
('S136674474597936500', 'basicarch-U2-C2-P1'),
('S136674474597936500', 'basicarch-U2-C2-P2'),
('S136674474597936500', 'basicarch-U2-C2-P3'),
('S136674465988990600', 'film-U1-C1-P1'),
('S136674465988990600', 'film-U1-C1-P2'),
('S136674465988990600', 'film-U1-C1-P3'),
('S136674465988990600', 'film-U1-C2-P1'),
('S136674435637058600', 'webdev101-U1-C1-P1'),
('S136674474597936500', 'WebDev101-U1-C1-P1'),
('S136674435637058600', 'WebDev101-U1-C1-P2'),
('S136674474597936500', 'WebDev101-U1-C1-P2'),
('S136674435637058600', 'WebDev101-U1-C1-P3'),
('S136674474597936500', 'WebDev101-U1-C1-P3'),
('S136674435637058600', 'WebDev101-U1-C1-P4'),
('S136674474597936500', 'WebDev101-U1-C1-P4'),
('S136674435637058600', 'WebDev101-U1-C2-P1'),
('S136674474597936500', 'WebDev101-U1-C2-P1'),
('S136674435637058600', 'WebDev101-U1-C2-P2'),
('S136674474597936500', 'WebDev101-U1-C2-P2'),
('S136674435637058600', 'WebDev101-U1-C2-P3'),
('S136674474597936500', 'WebDev101-U1-C2-P3'),
('S136674435637058600', 'WebDev101-U1-C3-P1'),
('S136674474597936500', 'WebDev101-U1-C3-P1'),
('S136674435637058600', 'WebDev101-U1-C3-P2'),
('S136674474597936500', 'WebDev101-U1-C3-P2'),
('S136674435637058600', 'WebDev101-U1-C4-P1'),
('S136674474597936500', 'WebDev101-U1-C4-P1'),
('S136674435637058600', 'WebDev101-U1-C4-P2'),
('S136674474597936500', 'WebDev101-U1-C4-P2'),
('S136674435637058600', 'WebDev101-U1-C5-P1'),
('S136674474597936500', 'WebDev101-U1-C5-P1'),
('S136674435637058600', 'WebDev101-U2-C1-P1'),
('S136674474597936500', 'WebDev101-U2-C1-P1'),
('S136674435637058600', 'WebDev101-U2-C1-P2'),
('S136674474597936500', 'WebDev101-U2-C1-P2'),
('S136674435637058600', 'WebDev101-U2-C1-P3'),
('S136674474597936500', 'WebDev101-U2-C1-P3'),
('S136674435637058600', 'WebDev101-U2-C1-P4'),
('S136674474597936500', 'WebDev101-U2-C1-P4');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `unitID_Chap` FOREIGN KEY (`unitID`) REFERENCES `units` (`unitID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`instructorID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_ibfk_3` FOREIGN KEY (`subject`) REFERENCES `subjects` (`subjectID`) ON UPDATE CASCADE;

--
-- Constraints for table `examquestions`
--
ALTER TABLE `examquestions`
  ADD CONSTRAINT `questionID_exam` FOREIGN KEY (`questionID`) REFERENCES `questionbank` (`questionID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userID_exam` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friendID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructorbio`
--
ALTER TABLE `instructorbio`
  ADD CONSTRAINT `userID_IB` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `chapterID_Page` FOREIGN KEY (`chapterID`) REFERENCES `chapters` (`chapterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`threadID`) REFERENCES `thread` (`threadID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userID_posts` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questionbank`
--
ALTER TABLE `questionbank`
  ADD CONSTRAINT `questionbank_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentchapterstats`
--
ALTER TABLE `studentchapterstats`
  ADD CONSTRAINT `chapterID_SCS` FOREIGN KEY (`chapterID`) REFERENCES `chapters` (`chapterID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userID_SCS` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `studentcoursestats`
--
ALTER TABLE `studentcoursestats`
  ADD CONSTRAINT `courseID_Sc` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userID_Sc` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `studentprogress`
--
ALTER TABLE `studentprogress`
  ADD CONSTRAINT `courseID_SP` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userID_SP` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userID_thread` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `courseID_UNITS` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visitedpages`
--
ALTER TABLE `visitedpages`
  ADD CONSTRAINT `visitedpages_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visitedpages_ibfk_2` FOREIGN KEY (`pageID`) REFERENCES `pages` (`pageID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
