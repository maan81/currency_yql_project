-- CREATE TABLE IF NOT EXISTS `minute_table` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `Symbol` varchar(6) NOT NULL,
--   `Name` varchar(11) NOT NULL,
--   `Rate` float NOT NULL,
--   `Date` varchar(11) NOT NULL,
--   `Time` varchar(8) NOT NULL,
--   `Ask` float NOT NULL,
--   `Bid` float NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `minute_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Symbol` varchar(6) NOT NULL,
  `Name` varchar(11) NOT NULL,
  `Rate` float NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Ask` float NOT NULL,
  `Bid` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;
