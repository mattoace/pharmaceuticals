/*
MySQL Data Transfer
Source Host: 192.168.1.207
Source Database: pharmaceuticals
Target Host: 192.168.1.207
Target Database: pharmaceuticals
Date: 12/23/2016 4:35:57 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for smtp
-- ----------------------------
CREATE TABLE `smtp` (
  `id` int(11) NOT NULL auto_increment,
  `host` varchar(200) default NULL,
  `port` int(11) default NULL,
  `username` varchar(200) default NULL,
  `pass` varchar(255) default NULL,
  `default` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `smtp` VALUES ('1', 'coreict.co.ke', '25', 'martin@coreict.co.ke', 'martincoreict2016', '1');
