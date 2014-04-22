SELECT `ogo_news`.`fid`, `ftitle`, `ogo_users`.`fname`
FROM `ogo_news`
LEFT JOIN `ogo_users` ON `ogo_news`.`fauthor_id` = `ogo_users`.`fid`
WHERE `ogo_users`.`flogin` LIKE "admin"
ORDER BY `ogo_news`.`fid`
LIMIT 0, 10