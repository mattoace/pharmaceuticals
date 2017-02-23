/*
MySQL Data Transfer
Source Host: 192.168.1.207
Source Database: pharmaceuticals
Target Host: 192.168.1.207
Target Database: pharmaceuticals
Date: 12/6/2016 2:08:48 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for users
-- ----------------------------
CREATE TABLE `users` (
  `id` int(9) NOT NULL auto_increment,
  `username` varchar(20) default NULL,
  `pass` varchar(100) default NULL,
  `employeeid` int(9) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'matto', 'a1eb3ef34d8529b75bdf9791d028ec15', '1');
INSERT INTO `users` VALUES ('2', 'mike', '18126e7bd3f84b3f3e4df094def5b7de', '2');
INSERT INTO `users` VALUES ('3', 'eliud', '293c052f49c1d998421f37e962ff78c1', '3');
