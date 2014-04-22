CREATE TABLE `ogoBase`.`ogo_users` (`fid` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`flogin` VARCHAR( 16 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`fpassword` VARCHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`fname` VARCHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`fgroup` VARCHAR( 16 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL 
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT = 'Таблица пользователей';
