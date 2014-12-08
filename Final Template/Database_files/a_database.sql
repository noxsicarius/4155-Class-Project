-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2014 at 09:30 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `a_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_uncc_1212`
--

CREATE TABLE IF NOT EXISTS `class_uncc_1212` (
`SentenceNo` int(11) NOT NULL,
  `Keywords` text NOT NULL,
  `Sentence` text NOT NULL,
  `Hits` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `class_uncc_1212`
--

INSERT INTO `class_uncc_1212` (`SentenceNo`, `Keywords`, `Sentence`, `Hits`) VALUES
(1, 'ricky,years,old', 'Ricky is 22 years old.', 1),
(2, 'ricky,drives,truck', 'Ricky drives a truck.', 1),
(3, 'most,nascar,teams,use,nitrogen,in,their,tires,instead,of,air', 'Most NASCAR Teams use nitrogen in their tires instead of air.', 0),
(4, 'famous,billionaire,howard,hughes,stored,his,own,urine,in,large,bottles', 'Famous billionaire Howard Hughes stored his own urine in large bottles.', 0),
(5, 'women,end,up,digesting,most,of,the,lipstick,apply', 'Women end up digesting most of the lipstick they apply.', 0),
(6, 'grenades,were,invented,in,china,over,years,ago', 'Grenades were invented in China over 1,000 years ago.', 0),
(7, 'bob,hope,and,billy,joel,were,both,once,boxers', 'Bob Hope and Billy Joel were both once boxers.', 0),
(8, 'women,wishing,to,enter,canada,to,work,as,strippers,must,provide,naked,photos,of,themselves,to,qualify,for,visa,three,mile,island,only,miles,long', 'Women wishing to enter Canada to work as strippers must provide naked photos of themselves to qualify for a visa!Three Mile Island is only 2 1/2 miles long.', 0),
(9, 'degrees,celsius,equal,to,-,degrees,fahrenheit', '-40 degrees Celsius is equal to -40 degrees Fahrenheit.', 0),
(10, 'it,will,let,you,go,instantly', 'It will let you go instantly.', 0),
(11, 'in,bob,hawke,immortalized,by,the,guinness,book,of,records,for,chugging', 'In 1954, Bob Hawke was immortalized by the Guinness Book of Records for chugging 2.', 0),
(12, 'pints,of,beer,in,seconds', '5 pints of beer in 12 seconds.', 0),
(13, 'it,takes,up,to,four,hours,to,hard,boil,an,ostrich,egg', 'It takes up to four hours to hard boil an ostrich egg.', 0),
(14, 'it,possible,to,see,rainbow,at,night,given,the,opportunity,deer,will,chew,gum,and,marijuana', 'It is possible to see a rainbow at night!Given the opportunity, deer will chew gum and marijuana.', 0),
(15, 'they,make,over,million,in,royalties,every,year,from,the,commercial,use,of,the,song', 'They make over $1 million in royalties every year from the commercial use of the song.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_uncc_4155`
--

CREATE TABLE IF NOT EXISTS `class_uncc_4155` (
`SentenceNo` int(11) NOT NULL,
  `Keywords` text NOT NULL,
  `Sentence` text NOT NULL,
  `Hits` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `class_uncc_4155`
--

INSERT INTO `class_uncc_4155` (`SentenceNo`, `Keywords`, `Sentence`, `Hits`) VALUES
(1, 'hey,my,name,evan', 'hey my name is evan.', 0),
(2, 'evan,years,old', 'evan is 22 years old.', -3),
(3, 'evan,drives,truck', 'evan drives a truck.', -7),
(4, 'his,truck,tacoma', 'his truck is a tacoma.', 4),
(5, 'most,nascar,teams,use,nitrogen,in,their,tires,instead,of,air', 'Most NASCAR Teams use nitrogen in their tires instead of air.', 10),
(6, 'famous,billionaire,howard,hughes,stored,his,own,urine,in,large,bottles', 'Famous billionaire Howard Hughes stored his own urine in large bottles.', 10),
(7, 'women,end,up,digesting,most,of,the,lipstick,apply', 'Women end up digesting most of the lipstick they apply.', 10),
(8, 'grenades,were,invented,in,china,over,years,ago', 'Grenades were invented in China over 1,000 years ago.', 10),
(9, 'bob,hope,and,billy,joel,were,both,once,boxers', 'Bob Hope and Billy Joel were both once boxers.', 10),
(10, 'women,wishing,to,enter,canada,to,work,as,strippers,must,provide,naked,photos,of,themselves,to,qualify,for,visa,three,mile,island,only,miles,long', 'Women wishing to enter Canada to work as strippers must provide naked photos of themselves to qualify for a visa!Three Mile Island is only 2 1/2 miles long.', 10),
(11, 'degrees,celsius,equal,to,-,degrees,fahrenheit', '-40 degrees Celsius is equal to -40 degrees Fahrenheit.', 10),
(12, 'it,will,let,you,go,instantly', 'It will let you go instantly.', 10),
(13, 'in,bob,hawke,immortalized,by,the,guinness,book,of,records,for,chugging', 'In 1954, Bob Hawke was immortalized by the Guinness Book of Records for chugging 2.', 10),
(14, 'pints,of,beer,in,seconds', '5 pints of beer in 12 seconds.', 10),
(15, 'it,takes,up,to,four,hours,to,hard,boil,an,ostrich,egg', 'It takes up to four hours to hard boil an ostrich egg.', 10),
(16, 'it,possible,to,see,rainbow,at,night,given,the,opportunity,deer,will,chew,gum,and,marijuana', 'It is possible to see a rainbow at night!Given the opportunity, deer will chew gum and marijuana.', 10),
(17, 'they,make,over,million,in,royalties,every,year,from,the,commercial,use,of,the,song', 'They make over $1 million in royalties every year from the commercial use of the song.', 10);

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
`FeedID` int(11) NOT NULL,
  `FeedDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `FeedTitle` varchar(60) NOT NULL,
  `FeedAuthor` varchar(100) NOT NULL,
  `FeedContant` text NOT NULL,
  `FeedShow` int(11) DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `feeds`
--

INSERT INTO `feeds` (`FeedID`, `FeedDate`, `FeedTitle`, `FeedAuthor`, `FeedContant`, `FeedShow`) VALUES
(37, '2014-12-01 01:16:10', 'update', 'update', 'update', 1),
(38, '2014-12-03 01:24:57', 'Feed One', 'Asif Subhan', 'this should first feed from webiste', 1),
(42, '2014-12-03 01:53:51', 'Asif Subhan', 'Asif Subhan', 'this should first feed from webiste', 1);

-- --------------------------------------------------------

--
-- Table structure for table `filerating`
--

CREATE TABLE IF NOT EXISTS `filerating` (
  `FileID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filerating`
--

INSERT INTO `filerating` (`FileID`, `StudentID`, `Rate`) VALUES
(20, 1, -1),
(21, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `FileID` int(11) NOT NULL,
  `Keyword` text NOT NULL,
  `ComparedTO` text NOT NULL,
  `MatchedTO` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`FileID`, `Keyword`, `ComparedTO`, `MatchedTO`) VALUES
(19, 'ricky,years,old,drives,truck', ',13,14,20,21,22,23', ',13-100,14-80,20-80,21-20,22-20,23-20'),
(20, 'hey,my,name,evan,years,old,drives,truck,his,tacoma', ',14,19,21,22,23', ',14-100,19-40,21-20,22-20,23-20'),
(21, 'most,nascar,teams,use,nitrogen,in,their,tires,instead,of,air,famous,billionaire,howard,hughes,stored,his,own,urine,large,bottles,women,end,up,digesting,most,the,lipstick,apply,grenades,were,invented,china,over,years,ago,bob,hope,and,billy,joel,both,once,boxers,wishing,to,enter,canada,work,as,strippers,must,provide,naked,photos,themselves,qualify,for,visa,three,mile,island,only,miles,long,goat,''s,milk,used,more,widely,throughout,world,than,cow,degrees,celsius,equal,-,fahrenheit,to,escape,grip,crocodile,jaws,push,your,thumbs,into,its,eyeballs,it,will,let,you,go,instantly,in,hawke,immortalized,by,guinness,book,records,chugging,pints,beer,seconds,takes,four,hours,hard,boil,an,ostrich,egg,possible,see,rainbow,at,night,given,opportunity,deer,chew,gum,marijuana,warner,chappel,music,owns,copyright,song,''happy,birthday,'',they,make,million,royalties,every,year,from,commercial', ',14,19,20,22,23', ',14-1,19-0,20-1,22-100,23-100'),
(22, 'most,nascar,teams,use,nitrogen,in,their,tires,instead,of,air,famous,billionaire,howard,hughes,stored,his,own,urine,large,bottles,women,end,up,digesting,most,the,lipstick,apply,grenades,were,invented,china,over,years,ago,bob,hope,and,billy,joel,both,once,boxers,wishing,to,enter,canada,work,as,strippers,must,provide,naked,photos,themselves,qualify,for,visa,three,mile,island,only,miles,long,goat,''s,milk,used,more,widely,throughout,world,than,cow,degrees,celsius,equal,-,fahrenheit,to,escape,grip,crocodile,jaws,push,your,thumbs,into,its,eyeballs,it,will,let,you,go,instantly,in,hawke,immortalized,by,guinness,book,records,chugging,pints,beer,seconds,takes,four,hours,hard,boil,an,ostrich,egg,possible,see,rainbow,at,night,given,opportunity,deer,chew,gum,marijuana,warner,chappel,music,owns,copyright,song,''happy,birthday,'',they,make,million,royalties,every,year,from,commercial', ',14,19,20,21,23', ',14-1,19-0,20-1,21-100,23-100'),
(23, 'most,nascar,teams,use,nitrogen,in,their,tires,instead,of,air,famous,billionaire,howard,hughes,stored,his,own,urine,large,bottles,women,end,up,digesting,most,the,lipstick,apply,grenades,were,invented,china,over,years,ago,bob,hope,and,billy,joel,both,once,boxers,wishing,to,enter,canada,work,as,strippers,must,provide,naked,photos,themselves,qualify,for,visa,three,mile,island,only,miles,long,goat,''s,milk,used,more,widely,throughout,world,than,cow,degrees,celsius,equal,-,fahrenheit,to,escape,grip,crocodile,jaws,push,your,thumbs,into,its,eyeballs,it,will,let,you,go,instantly,in,hawke,immortalized,by,guinness,book,records,chugging,pints,beer,seconds,takes,four,hours,hard,boil,an,ostrich,egg,possible,see,rainbow,at,night,given,opportunity,deer,chew,gum,marijuana,warner,chappel,music,owns,copyright,song,''happy,birthday,'',they,make,million,royalties,every,year,from,commercial', ',19,20,21,22', ',19-0,20-1,21-100,22-100');

-- --------------------------------------------------------

--
-- Table structure for table `sentencerating`
--

CREATE TABLE IF NOT EXISTS `sentencerating` (
  `ClassID` int(11) NOT NULL,
  `SentenceID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sentencerating`
--

INSERT INTO `sentencerating` (`ClassID`, `SentenceID`, `StudentID`, `Rate`) VALUES
(1, 2, 1, 1),
(1, 3, 1, 1),
(1, 4, 1, -1),
(1, 5, 1, -1),
(2, 1, 1, -1),
(2, 2, 1, -10),
(2, 3, 1, -1),
(2, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `st_class_names`
--

CREATE TABLE IF NOT EXISTS `st_class_names` (
`ClassID` int(11) NOT NULL,
  `ClassName` varchar(50) NOT NULL,
  `SchoolName` varchar(50) NOT NULL,
  `TableName` varchar(100) NOT NULL,
  `RelatedClass` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `st_class_names`
--

INSERT INTO `st_class_names` (`ClassID`, `ClassName`, `SchoolName`, `TableName`, `RelatedClass`) VALUES
(1, '1212', 'uncc', 'class_uncc_1212', -1),
(2, '4155', 'uncc', 'class_uncc_4155', -1);

-- --------------------------------------------------------

--
-- Table structure for table `table_19`
--

CREATE TABLE IF NOT EXISTS `table_19` (
`SentenceNO` int(11) NOT NULL,
  `Sentence` text NOT NULL,
  `Keywords` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `table_19`
--

INSERT INTO `table_19` (`SentenceNO`, `Sentence`, `Keywords`) VALUES
(1, 'Ricky is 22 years old', 'ricky,years,old'),
(2, 'Ricky drives a truck', 'ricky,drives,truck');

-- --------------------------------------------------------

--
-- Table structure for table `table_20`
--

CREATE TABLE IF NOT EXISTS `table_20` (
`SentenceNO` int(11) NOT NULL,
  `Sentence` text NOT NULL,
  `Keywords` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `table_20`
--

INSERT INTO `table_20` (`SentenceNO`, `Sentence`, `Keywords`) VALUES
(1, 'hey my name is evan', 'hey,my,name,evan'),
(2, 'evan is 22 years old', 'evan,years,old'),
(3, 'evan drives a truck', 'evan,drives,truck'),
(4, 'his truck is a tacoma', 'his,truck,tacoma');

-- --------------------------------------------------------

--
-- Table structure for table `table_21`
--

CREATE TABLE IF NOT EXISTS `table_21` (
`SentenceNO` int(11) NOT NULL,
  `Sentence` text NOT NULL,
  `Keywords` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `table_21`
--

INSERT INTO `table_21` (`SentenceNO`, `Sentence`, `Keywords`) VALUES
(1, 'Most NASCAR Teams use nitrogen in their tires instead of air', 'most,nascar,teams,use,nitrogen,in,their,tires,instead,of,air'),
(2, 'Famous billionaire Howard Hughes stored his own urine in large bottles', 'famous,billionaire,howard,hughes,stored,his,own,urine,in,large,bottles'),
(3, 'Women end up digesting most of the lipstick they apply', 'women,end,up,digesting,most,of,the,lipstick,apply'),
(4, 'Grenades were invented in China over 1,000 years ago', 'grenades,were,invented,in,china,over,years,ago'),
(5, 'Bob Hope and Billy Joel were both once boxers', 'bob,hope,and,billy,joel,were,both,once,boxers'),
(6, 'Women wishing to enter Canada to work as strippers must provide naked photos of themselves to qualify for a visa!Three Mile Island is only 2 1/2 miles long', 'women,wishing,to,enter,canada,to,work,as,strippers,must,provide,naked,photos,of,themselves,to,qualify,for,visa,three,mile,island,only,miles,long'),
(7, '-40 degrees Celsius is equal to -40 degrees Fahrenheit', 'degrees,celsius,equal,to,-,degrees,fahrenheit'),
(8, 'It will let you go instantly', 'it,will,let,you,go,instantly'),
(9, 'In 1954, Bob Hawke was immortalized by the Guinness Book of Records for chugging 2', 'in,bob,hawke,immortalized,by,the,guinness,book,of,records,for,chugging'),
(10, '5 pints of beer in 12 seconds', 'pints,of,beer,in,seconds'),
(11, 'It takes up to four hours to hard boil an ostrich egg', 'it,takes,up,to,four,hours,to,hard,boil,an,ostrich,egg'),
(12, 'It is possible to see a rainbow at night!Given the opportunity, deer will chew gum and marijuana', 'it,possible,to,see,rainbow,at,night,given,the,opportunity,deer,will,chew,gum,and,marijuana'),
(13, 'They make over $1 million in royalties every year from the commercial use of the song', 'they,make,over,million,in,royalties,every,year,from,the,commercial,use,of,the,song');

-- --------------------------------------------------------

--
-- Table structure for table `table_22`
--

CREATE TABLE IF NOT EXISTS `table_22` (
`SentenceNO` int(11) NOT NULL,
  `Sentence` text NOT NULL,
  `Keywords` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `table_22`
--

INSERT INTO `table_22` (`SentenceNO`, `Sentence`, `Keywords`) VALUES
(1, 'Most NASCAR Teams use nitrogen in their tires instead of air', 'most,nascar,teams,use,nitrogen,in,their,tires,instead,of,air'),
(2, 'Famous billionaire Howard Hughes stored his own urine in large bottles', 'famous,billionaire,howard,hughes,stored,his,own,urine,in,large,bottles'),
(3, 'Women end up digesting most of the lipstick they apply', 'women,end,up,digesting,most,of,the,lipstick,apply'),
(4, 'Grenades were invented in China over 1,000 years ago', 'grenades,were,invented,in,china,over,years,ago'),
(5, 'Bob Hope and Billy Joel were both once boxers', 'bob,hope,and,billy,joel,were,both,once,boxers'),
(6, 'Women wishing to enter Canada to work as strippers must provide naked photos of themselves to qualify for a visa!Three Mile Island is only 2 1/2 miles long', 'women,wishing,to,enter,canada,to,work,as,strippers,must,provide,naked,photos,of,themselves,to,qualify,for,visa,three,mile,island,only,miles,long'),
(7, '-40 degrees Celsius is equal to -40 degrees Fahrenheit', 'degrees,celsius,equal,to,-,degrees,fahrenheit'),
(8, 'It will let you go instantly', 'it,will,let,you,go,instantly'),
(9, 'In 1954, Bob Hawke was immortalized by the Guinness Book of Records for chugging 2', 'in,bob,hawke,immortalized,by,the,guinness,book,of,records,for,chugging'),
(10, '5 pints of beer in 12 seconds', 'pints,of,beer,in,seconds'),
(11, 'It takes up to four hours to hard boil an ostrich egg', 'it,takes,up,to,four,hours,to,hard,boil,an,ostrich,egg'),
(12, 'It is possible to see a rainbow at night!Given the opportunity, deer will chew gum and marijuana', 'it,possible,to,see,rainbow,at,night,given,the,opportunity,deer,will,chew,gum,and,marijuana'),
(13, 'They make over $1 million in royalties every year from the commercial use of the song', 'they,make,over,million,in,royalties,every,year,from,the,commercial,use,of,the,song');

-- --------------------------------------------------------

--
-- Table structure for table `table_23`
--

CREATE TABLE IF NOT EXISTS `table_23` (
`SentenceNO` int(11) NOT NULL,
  `Sentence` text NOT NULL,
  `Keywords` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `table_23`
--

INSERT INTO `table_23` (`SentenceNO`, `Sentence`, `Keywords`) VALUES
(1, 'Most NASCAR Teams use nitrogen in their tires instead of air', 'most,nascar,teams,use,nitrogen,in,their,tires,instead,of,air'),
(2, 'Famous billionaire Howard Hughes stored his own urine in large bottles', 'famous,billionaire,howard,hughes,stored,his,own,urine,in,large,bottles'),
(3, 'Women end up digesting most of the lipstick they apply', 'women,end,up,digesting,most,of,the,lipstick,apply'),
(4, 'Grenades were invented in China over 1,000 years ago', 'grenades,were,invented,in,china,over,years,ago'),
(5, 'Bob Hope and Billy Joel were both once boxers', 'bob,hope,and,billy,joel,were,both,once,boxers'),
(6, 'Women wishing to enter Canada to work as strippers must provide naked photos of themselves to qualify for a visa!Three Mile Island is only 2 1/2 miles long', 'women,wishing,to,enter,canada,to,work,as,strippers,must,provide,naked,photos,of,themselves,to,qualify,for,visa,three,mile,island,only,miles,long'),
(7, '-40 degrees Celsius is equal to -40 degrees Fahrenheit', 'degrees,celsius,equal,to,-,degrees,fahrenheit'),
(8, 'It will let you go instantly', 'it,will,let,you,go,instantly'),
(9, 'In 1954, Bob Hawke was immortalized by the Guinness Book of Records for chugging 2', 'in,bob,hawke,immortalized,by,the,guinness,book,of,records,for,chugging'),
(10, '5 pints of beer in 12 seconds', 'pints,of,beer,in,seconds'),
(11, 'It takes up to four hours to hard boil an ostrich egg', 'it,takes,up,to,four,hours,to,hard,boil,an,ostrich,egg'),
(12, 'It is possible to see a rainbow at night!Given the opportunity, deer will chew gum and marijuana', 'it,possible,to,see,rainbow,at,night,given,the,opportunity,deer,will,chew,gum,and,marijuana'),
(13, 'They make over $1 million in royalties every year from the commercial use of the song', 'they,make,over,million,in,royalties,every,year,from,the,commercial,use,of,the,song');

-- --------------------------------------------------------

--
-- Table structure for table `uploadinfo`
--

CREATE TABLE IF NOT EXISTS `uploadinfo` (
  `StudentID` int(11) NOT NULL,
`FileID` int(11) NOT NULL,
  `FileName` varchar(50) NOT NULL,
  `FileLocation` varchar(60) NOT NULL,
  `School` varchar(100) NOT NULL,
  `ClassName` varchar(50) NOT NULL,
  `Teacher` varchar(50) NOT NULL,
  `Chapter` varchar(50) NOT NULL,
  `NotesTitle` varchar(100) NOT NULL,
  `Comments` text NOT NULL,
  `Content` mediumblob NOT NULL,
  `VoteUp` int(11) NOT NULL,
  `VoteDown` int(11) NOT NULL,
  `VoteAverage` double NOT NULL,
  `Abuse` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `uploadinfo`
--

INSERT INTO `uploadinfo` (`StudentID`, `FileID`, `FileName`, `FileLocation`, `School`, `ClassName`, `Teacher`, `Chapter`, `NotesTitle`, `Comments`, `Content`, `VoteUp`, `VoteDown`, `VoteAverage`, `Abuse`) VALUES
(1, 19, '111.txt', 'uploads/', 'UNCC', '1212', 'as', '3', 'Checking', 'None', 0x5269636b79206973203232207965617273206f6c642e205269636b7920647269766573206120747275636b2e, 0, 0, 0, 0),
(1, 20, 'hhhh.txt', 'uploads/', 'UNCC', '4155', 'jamie', '2', 'evan', 'None', 0x686579206d79206e616d65206973206576616e2e206576616e206973203232207965617273206f6c642e206576616e20647269766573206120747275636b2e2068697320747275636b2069732061207461636f6d612e, 0, 1, 0, 0),
(1, 21, 'Not working.txt', 'uploads/', 'UNCC', '4155', 'jamie', '2', 'Not-Working', 'None', 0x4d6f7374204e4153434152205465616d7320757365206e6974726f67656e20696e20746865697220746972657320696e7374656164206f66206169722e46616d6f75732062696c6c696f6e6169726520486f77617264204875676865732073746f72656420686973206f776e207572696e6520696e206c6172676520626f74746c65732e0d0a576f6d656e20656e6420757020646967657374696e67206d6f7374206f6620746865206c6970737469636b2074686579206170706c792e0d0a4772656e61646573207765726520696e76656e74656420696e204368696e61206f76657220312c3030302079656172732061676f2e0d0a426f6220486f706520616e642042696c6c79204a6f656c207765726520626f7468206f6e636520626f786572732e0d0a576f6d656e2077697368696e6720746f20656e7465722043616e61646120746f20776f726b20617320737472697070657273206d7573742070726f76696465206e616b65642070686f746f73206f66207468656d73656c76657320746f207175616c69667920666f7220612076697361215468726565204d696c652049736c616e64206973206f6e6c79203220312f32206d696c6573206c6f6e672e0d0a476f61745c2773206d696c6b2069732075736564206d6f726520776964656c79207468726f7567686f75742074686520776f726c64207468616e20636f775c2773206d696c6b2e0d0a2d343020646567726565732043656c7369757320697320657175616c20746f202d343020646567726565732046616872656e686569742e546f20657363617065207468652067726970206f6620612063726f636f64696c655c2773206a6177732c207075736820796f7572207468756d627320696e746f206974732065796562616c6c732e2049742077696c6c206c657420796f7520676f20696e7374616e746c792e496e20313935342c20426f62204861776b652077617320696d6d6f7274616c697a656420627920746865204775696e6e65737320426f6f6b206f66205265636f72647320666f72206368756767696e6720322e352070696e7473206f66206265657220696e203132207365636f6e64732e0d0a49742074616b657320757020746f20666f757220686f75727320746f206861726420626f696c20616e206f737472696368206567672e497420697320706f737369626c6520746f207365652061207261696e626f77206174206e6967687421476976656e20746865206f70706f7274756e6974792c20646565722077696c6c20636865772067756d20616e64206d6172696a75616e612e5761726e6572204368617070656c204d75736963206f776e732074686520636f7079726967687420746f2074686520736f6e67205c2748617070792042697274686461795c272e2054686579206d616b65206f766572202431206d696c6c696f6e20696e20726f79616c7469657320657665727920796561722066726f6d2074686520636f6d6d65726369616c20757365206f662074686520736f6e672e, 1, 0, 0, 0),
(2, 22, 'Not working 1.txt', 'uploads/', 'UNCC', '4155', 'jamie', 'j', 'Not-wroking-1', 'None', 0x4d6f7374204e4153434152205465616d7320757365206e6974726f67656e20696e20746865697220746972657320696e7374656164206f66206169722e46616d6f75732062696c6c696f6e6169726520486f77617264204875676865732073746f72656420686973206f776e207572696e6520696e206c6172676520626f74746c65732e0d0a576f6d656e20656e6420757020646967657374696e67206d6f7374206f6620746865206c6970737469636b2074686579206170706c792e0d0a4772656e61646573207765726520696e76656e74656420696e204368696e61206f76657220312c3030302079656172732061676f2e0d0a426f6220486f706520616e642042696c6c79204a6f656c207765726520626f7468206f6e636520626f786572732e0d0a576f6d656e2077697368696e6720746f20656e7465722043616e61646120746f20776f726b20617320737472697070657273206d7573742070726f76696465206e616b65642070686f746f73206f66207468656d73656c76657320746f207175616c69667920666f7220612076697361215468726565204d696c652049736c616e64206973206f6e6c79203220312f32206d696c6573206c6f6e672e0d0a476f61745c2773206d696c6b2069732075736564206d6f726520776964656c79207468726f7567686f75742074686520776f726c64207468616e20636f775c2773206d696c6b2e0d0a2d343020646567726565732043656c7369757320697320657175616c20746f202d343020646567726565732046616872656e686569742e546f20657363617065207468652067726970206f6620612063726f636f64696c655c2773206a6177732c207075736820796f7572207468756d627320696e746f206974732065796562616c6c732e2049742077696c6c206c657420796f7520676f20696e7374616e746c792e496e20313935342c20426f62204861776b652077617320696d6d6f7274616c697a656420627920746865204775696e6e65737320426f6f6b206f66205265636f72647320666f72206368756767696e6720322e352070696e7473206f66206265657220696e203132207365636f6e64732e0d0a49742074616b657320757020746f20666f757220686f75727320746f206861726420626f696c20616e206f737472696368206567672e497420697320706f737369626c6520746f207365652061207261696e626f77206174206e6967687421476976656e20746865206f70706f7274756e6974792c20646565722077696c6c20636865772067756d20616e64206d6172696a75616e612e5761726e6572204368617070656c204d75736963206f776e732074686520636f7079726967687420746f2074686520736f6e67205c2748617070792042697274686461795c272e2054686579206d616b65206f766572202431206d696c6c696f6e20696e20726f79616c7469657320657665727920796561722066726f6d2074686520636f6d6d65726369616c20757365206f662074686520736f6e672e, 0, 0, 0, 0),
(1, 23, 'new FIle.txt', 'uploads/', 'UNCC', '1212', 'asif', '1', 'New File', 'None', 0x4d6f7374204e4153434152205465616d7320757365206e6974726f67656e20696e20746865697220746972657320696e7374656164206f66206169722e46616d6f75732062696c6c696f6e6169726520486f77617264204875676865732073746f72656420686973206f776e207572696e6520696e206c6172676520626f74746c65732e0d0a576f6d656e20656e6420757020646967657374696e67206d6f7374206f6620746865206c6970737469636b2074686579206170706c792e0d0a4772656e61646573207765726520696e76656e74656420696e204368696e61206f76657220312c3030302079656172732061676f2e0d0a426f6220486f706520616e642042696c6c79204a6f656c207765726520626f7468206f6e636520626f786572732e0d0a576f6d656e2077697368696e6720746f20656e7465722043616e61646120746f20776f726b20617320737472697070657273206d7573742070726f76696465206e616b65642070686f746f73206f66207468656d73656c76657320746f207175616c69667920666f7220612076697361215468726565204d696c652049736c616e64206973206f6e6c79203220312f32206d696c6573206c6f6e672e0d0a476f61745c2773206d696c6b2069732075736564206d6f726520776964656c79207468726f7567686f75742074686520776f726c64207468616e20636f775c2773206d696c6b2e0d0a2d343020646567726565732043656c7369757320697320657175616c20746f202d343020646567726565732046616872656e686569742e546f20657363617065207468652067726970206f6620612063726f636f64696c655c2773206a6177732c207075736820796f7572207468756d627320696e746f206974732065796562616c6c732e2049742077696c6c206c657420796f7520676f20696e7374616e746c792e496e20313935342c20426f62204861776b652077617320696d6d6f7274616c697a656420627920746865204775696e6e65737320426f6f6b206f66205265636f72647320666f72206368756767696e6720322e352070696e7473206f66206265657220696e203132207365636f6e64732e0d0a49742074616b657320757020746f20666f757220686f75727320746f206861726420626f696c20616e206f737472696368206567672e497420697320706f737369626c6520746f207365652061207261696e626f77206174206e6967687421476976656e20746865206f70706f7274756e6974792c20646565722077696c6c20636865772067756d20616e64206d6172696a75616e612e5761726e6572204368617070656c204d75736963206f776e732074686520636f7079726967687420746f2074686520736f6e67205c2748617070792042697274686461795c272e2054686579206d616b65206f766572202431206d696c6c696f6e20696e20726f79616c7469657320657665727920796561722066726f6d2074686520636f6d6d65726369616c20757365206f662074686520736f6e672e, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`Id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(80) NOT NULL,
  `school` varchar(80) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `verified` int(1) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `username`, `password`, `name`, `school`, `email`, `verified`, `role`) VALUES
(1, 'asubhan', 'password', 'Asif Subhan', 'UNCC', NULL, NULL, 'Admin'),
(2, 'ksubhan', 'password', 'Kashif Subhan', 'UNCG', NULL, NULL, 'Student'),
(3, 'hello', 'hello', 'hello', 'hello', NULL, NULL, 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_uncc_1212`
--
ALTER TABLE `class_uncc_1212`
 ADD PRIMARY KEY (`SentenceNo`);

--
-- Indexes for table `class_uncc_4155`
--
ALTER TABLE `class_uncc_4155`
 ADD PRIMARY KEY (`SentenceNo`);

--
-- Indexes for table `feeds`
--
ALTER TABLE `feeds`
 ADD PRIMARY KEY (`FeedID`);

--
-- Indexes for table `filerating`
--
ALTER TABLE `filerating`
 ADD PRIMARY KEY (`FileID`,`StudentID`), ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
 ADD PRIMARY KEY (`FileID`);

--
-- Indexes for table `sentencerating`
--
ALTER TABLE `sentencerating`
 ADD PRIMARY KEY (`ClassID`,`SentenceID`,`StudentID`), ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `st_class_names`
--
ALTER TABLE `st_class_names`
 ADD PRIMARY KEY (`ClassID`);

--
-- Indexes for table `table_19`
--
ALTER TABLE `table_19`
 ADD PRIMARY KEY (`SentenceNO`);

--
-- Indexes for table `table_20`
--
ALTER TABLE `table_20`
 ADD PRIMARY KEY (`SentenceNO`);

--
-- Indexes for table `table_21`
--
ALTER TABLE `table_21`
 ADD PRIMARY KEY (`SentenceNO`);

--
-- Indexes for table `table_22`
--
ALTER TABLE `table_22`
 ADD PRIMARY KEY (`SentenceNO`);

--
-- Indexes for table `table_23`
--
ALTER TABLE `table_23`
 ADD PRIMARY KEY (`SentenceNO`);

--
-- Indexes for table `uploadinfo`
--
ALTER TABLE `uploadinfo`
 ADD PRIMARY KEY (`FileID`), ADD UNIQUE KEY `FileName` (`FileName`,`StudentID`), ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_uncc_1212`
--
ALTER TABLE `class_uncc_1212`
MODIFY `SentenceNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `class_uncc_4155`
--
ALTER TABLE `class_uncc_4155`
MODIFY `SentenceNo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `feeds`
--
ALTER TABLE `feeds`
MODIFY `FeedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `st_class_names`
--
ALTER TABLE `st_class_names`
MODIFY `ClassID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `table_19`
--
ALTER TABLE `table_19`
MODIFY `SentenceNO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `table_20`
--
ALTER TABLE `table_20`
MODIFY `SentenceNO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `table_21`
--
ALTER TABLE `table_21`
MODIFY `SentenceNO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `table_22`
--
ALTER TABLE `table_22`
MODIFY `SentenceNO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `table_23`
--
ALTER TABLE `table_23`
MODIFY `SentenceNO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `uploadinfo`
--
ALTER TABLE `uploadinfo`
MODIFY `FileID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `filerating`
--
ALTER TABLE `filerating`
ADD CONSTRAINT `filerating_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `users` (`Id`),
ADD CONSTRAINT `filerating_ibfk_2` FOREIGN KEY (`FileID`) REFERENCES `uploadinfo` (`FileID`);

--
-- Constraints for table `keywords`
--
ALTER TABLE `keywords`
ADD CONSTRAINT `keywords_ibfk_1` FOREIGN KEY (`FileID`) REFERENCES `uploadinfo` (`FileID`);

--
-- Constraints for table `sentencerating`
--
ALTER TABLE `sentencerating`
ADD CONSTRAINT `sentencerating_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `users` (`Id`);

--
-- Constraints for table `uploadinfo`
--
ALTER TABLE `uploadinfo`
ADD CONSTRAINT `uploadinfo_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `users` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
