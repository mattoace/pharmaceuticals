/*
MySQL Data Transfer
Source Host: 192.168.1.207
Source Database: pharmaceuticals
Target Host: 192.168.1.207
Target Database: pharmaceuticals
Date: 1/5/2017 11:05:19 AM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for default
-- ----------------------------
CREATE TABLE `default` (
  `id` int(11) NOT NULL auto_increment,
  `companyname` varchar(300) default NULL,
  `address` varchar(200) default NULL,
  `telephone1` varchar(200) default NULL,
  `telephone2` varchar(200) default NULL,
  `town` varchar(100) default NULL,
  `country` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `default` VALUES ('1', 'Core Ict Consultancy', 'U.T.I S6B ', '0727310743', '+007 238 564', 'Thika', 'Kenya', 'martin@coreict.co.ke');
INSERT INTO `default` VALUES ('2', null, null, null, null, null, null, null);
