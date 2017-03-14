
CREATE DATABASE IF NOT EXISTS `org` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `org`;
CREATE TABLE tax (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  percentage int(3) NOT NULL,
  constraint PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE taxInstitution (
  id int(11) NOT NULL AUTO_INCREMENT,
  instName varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  officeLocation varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  status varchar(20) COLLATE utf8_unicode_ci NOT NULL,
   constraint PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE organisation (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  taxInstID int(11) NOT NULL,
  officeLocation varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  status varchar(20) COLLATE utf8_unicode_ci NOT NULL,
   constraint PRIMARY KEY (id),
   constraint FOREIGN KEY (taxInstID) REFERENCES taxInstitution (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE outlet (
  id int(11) NOT NULL AUTO_INCREMENT,
  outletName varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  officeLocation varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  orgID int(11) NOT NULL,
  status varchar(20) COLLATE utf8_unicode_ci NOT NULL,
   constraint PRIMARY KEY (id),
   constraint FOREIGN KEY (orgID) REFERENCES outlet(id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE user (
  id int(11) NOT NULL AUTO_INCREMENT,
  email varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  password varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  createdBy int(50) NOT NULL,
  userType varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  userRelatesTo varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  status varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  constraint PRIMARY KEY (id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





