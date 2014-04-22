CREATE TABLE `ogoBase`.`ogo_news` (`fid` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`fsummary_text` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`fnews_text` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`fauthor_id` INT( 11 ) NOT NULL ,
`fcreate_date` TIMESTAMP NOT NULL ,
`fexpiry_date` TIMESTAMP NOT NULL ,
`fcomments_count` MEDIUMINT NOT NULL 
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


ALTER TABLE `ogo_news` ADD `ftitle` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `fid` ,
ADD FULLTEXT (`ftitle` 
)
