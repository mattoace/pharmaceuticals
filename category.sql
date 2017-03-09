/*
MySQL Data Transfer
Source Host: localhost
Source Database: pharmaceuticals
Target Host: localhost
Target Database: pharmaceuticals
Date: 3/8/2017 12:17:49 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for category
-- ----------------------------
CREATE TABLE `category` (
  `id` int(11) NOT NULL auto_increment,
  `categoryname` varchar(200) default NULL,
  `description` text,
  `parent` int(11) default NULL,
  `img` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=521 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `category` VALUES ('493', 'Home', 'Home', null, null);
INSERT INTO `category` VALUES ('497', 'Medicine', 'Medicine', null, null);
INSERT INTO `category` VALUES ('498', 'Prescription Medicine', 'Prescription Medicine', '497', null);
INSERT INTO `category` VALUES ('499', 'Over the counter medicine', 'Over the counter medicine', '497', null);
INSERT INTO `category` VALUES ('500', 'Vitamins', 'Vitamins', null, null);
INSERT INTO `category` VALUES ('501', 'Supplements', 'Supplements', '500', null);
INSERT INTO `category` VALUES ('502', 'Vitamins', 'Vitamins', '500', null);
INSERT INTO `category` VALUES ('503', 'Products', 'Products', null, null);
INSERT INTO `category` VALUES ('504', 'Baby care products', 'Baby care products', '503', null);
INSERT INTO `category` VALUES ('505', 'Nutrition', 'Nutrition', '503', null);
INSERT INTO `category` VALUES ('507', 'Personal care products', 'Personal care products', '503', null);
INSERT INTO `category` VALUES ('508', 'Equipments', 'Equipments', null, null);
INSERT INTO `category` VALUES ('509', 'Medical devices', 'Medical devices', '508', null);
INSERT INTO `category` VALUES ('510', 'Food', 'Food', '505', null);
INSERT INTO `category` VALUES ('511', 'Beverage', 'Beverage', '505', null);
INSERT INTO `category` VALUES ('512', 'Hard drink', 'Hard drink', '511', null);
INSERT INTO `category` VALUES ('513', 'Soft drink', 'Soft drink', '511', null);
INSERT INTO `category` VALUES ('514', 'Fanta Juice', 'Fanta Juice', '513', null);
INSERT INTO `category` VALUES ('515', 'Delmonte', 'Delmonte', '513', null);
INSERT INTO `category` VALUES ('516', 'User profile', 'User profile', null, null);
INSERT INTO `category` VALUES ('517', 'My Prescriptions', 'My Prescriptions', '516', null);
INSERT INTO `category` VALUES ('518', 'My Invoices', 'My Invoices', '516', null);
INSERT INTO `category` VALUES ('520', 'My Orders', 'My Orders', '516', null);
