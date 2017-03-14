
CREATE DATABASE IF NOT EXISTS `org` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `org`;
CREATE TABLE tax (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  percentage int(3) NOT NULL,
  constraint PRIMARY KEY (id)
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





