/*
MySQL Data Transfer
Source Host: 192.168.1.207
Source Database: pharmaceuticals
Target Host: 192.168.1.207
Target Database: pharmaceuticals
Date: 1/9/2017 2:49:35 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for menu
-- ----------------------------
CREATE TABLE `menu` (
  `id` int(11) NOT NULL auto_increment,
  `menuname` varchar(200) default NULL,
  `parentid` int(11) default NULL,
  `class` varchar(200) default NULL,
  `img` varchar(200) default NULL,
  `url` varchar(200) default NULL,
  `option` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Dashboard', null, 'fa fa-dashboard', ' ', 'admin', '           <span class=\"pull-right-container\">\r\n                <i class=\"fa fa-angle-left pull-right\"></i>\r\n            </span>');
INSERT INTO `menu` VALUES ('2', 'Stores', null, 'fa fa-files-o', null, '#', '           <span class=\"pull-right-container\">\r\n              <span class=\"label label-primary pull-right\">4</span>\r\n            </span>');
INSERT INTO `menu` VALUES ('3', 'Pharmacy', '2', 'fa fa-circle-o', '', 'pharm', null);
INSERT INTO `menu` VALUES ('4', 'Drugs', '2', 'fa fa-circle-o', '', 'med', null);
INSERT INTO `menu` VALUES ('5', 'Drug Prices', '2', 'fa fa-circle-o', '', 'prices', null);
INSERT INTO `menu` VALUES ('6', 'Clinics', '2', 'fa fa-circle-o', '', 'clinic', null);
INSERT INTO `menu` VALUES ('7', 'Person', null, 'fa fa-pie-chart', null, '#', '         <span class=\"pull-right-container\">\r\n              <i class=\"fa fa-angle-left pull-right\"></i>\r\n            </span>');
INSERT INTO `menu` VALUES ('8', 'Patient', '7', 'fa fa-circle-o', null, 'patient', '');
INSERT INTO `menu` VALUES ('9', 'Staff', '7', 'fa fa-circle-o', null, 'staff', null);
INSERT INTO `menu` VALUES ('10', 'System users', '7', 'fa fa-circle-o', null, 'users', null);
INSERT INTO `menu` VALUES ('11', 'Supplier', '7', 'fa fa-circle-o', null, 'supplier', null);
INSERT INTO `menu` VALUES ('12', 'Patient', null, 'fa fa-laptop', null, '#', '            <span class=\"pull-right-container\">\r\n              <i class=\"fa fa-angle-left pull-right\"></i>\r\n            </span>');
INSERT INTO `menu` VALUES ('13', 'Patient Refill', '12', 'fa fa-circle-o', null, 'patientrefill', null);
INSERT INTO `menu` VALUES ('14', 'Patient Insurance', '12', 'fa fa-circle-o', null, 'patientinsurance', null);
INSERT INTO `menu` VALUES ('15', 'Patient Bill', '12', 'fa fa-circle-o', null, 'patientbill', null);
INSERT INTO `menu` VALUES ('16', 'Patient Payments', '12', 'fa fa-circle-o', null, 'patientpayments', null);
INSERT INTO `menu` VALUES ('17', 'Immunizations', '12', 'fa fa-circle-o', null, 'immunizations', null);
INSERT INTO `menu` VALUES ('18', 'Health Information', '12', 'fa fa-circle-o', null, 'healthinfo', null);
INSERT INTO `menu` VALUES ('19', 'Transactions', null, 'fa fa-edit', null, '#', '            <span class=\"pull-right-container\">\r\n              <i class=\"fa fa-angle-left pull-right\"></i>\r\n            </span>');
INSERT INTO `menu` VALUES ('20', 'Orders/Refill', '19', 'fa fa-circle-o', null, 'orders', null);
INSERT INTO `menu` VALUES ('21', 'Confirmed Orders', '19', 'fa fa-circle-o', null, 'corders', null);
INSERT INTO `menu` VALUES ('22', 'Invoices', '19', 'fa fa-circle-o', null, 'invoice', null);
INSERT INTO `menu` VALUES ('23', 'Admin', null, 'fa fa-table', null, null, '            <span class=\"pull-right-container\">\r\n              <i class=\"fa fa-angle-left pull-right\"></i>\r\n            </span>');
INSERT INTO `menu` VALUES ('24', 'Users', '23', 'fa fa-circle-o', null, 'users', null);
INSERT INTO `menu` VALUES ('25', 'Roles', '23', 'fa fa-circle-o', null, 'roles', null);
INSERT INTO `menu` VALUES ('26', 'Setings', '23', 'fa fa-circle-o', null, 'settings', null);
INSERT INTO `menu` VALUES ('27', 'Calendar', null, 'fa fa-calendar', null, 'calendar', '            <span class=\"pull-right-container\">\r\n              <small class=\"label pull-right bg-red\">3</small>\r\n              <small class=\"label pull-right bg-blue\">17</small>\r\n            </span>');
