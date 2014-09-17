<?php
require_once("CommentsModel.class.php");

	class MaterialsModel extends BDatabase{
		public $tableName = "ogo_news";
		public $primaryKey = "fid";
		public $articlesPerPage = 3;
		public $commentsObject;
		public $category = "materials";

		public function __construct() {
			parent::__construct();
			$this->commentsObject = new CommentsModel();
	
		}

		public function getArticlesList($currentPage) {
			try {
				$offset = 0;
				$pageCount = 5;
				$pageCount = $this->getPageCount();
				if ($currentPage <= 0 or $currentPage > $pageCount or !is_numeric($currentPage)) {
					throw new Exception ("Error 404! Нет такой страницы!");
				}
				$offset = ($currentPage - 1) * $this->articlesPerPage;
				$data = null;
				$q = "SELECT 
						`ogo_news`.`fid`, 
						`ogo_news`.`ftitle`,
						`ogo_news`.`fsummary_text`,
						`ogo_users`.`fname`,
						`ogo_news`.`fcreate_date`,
						COUNT(`ogo_comments`.`fid`) AS `fcomments_count`
					FROM `ogo_news`
					LEFT JOIN `ogo_users` ON `ogo_news`.`fauthor_id`=`ogo_users`.`fid`
					LEFT JOIN `ogo_comments` ON `ogo_news`.`fid`=`ogo_comments`.`fnews_id`
					WHERE `ogo_news`.`fcategory` = 2
					GROUP BY `ogo_news`.`fid`
					ORDER BY `ogo_news`.`fcreate_date` DESC
					LIMIT :i, :i";
				$c = array($offset, $this->articlesPerPage);
				$data = $this->selectBySql($q, $c);
				return $data;

			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}

		public function getPageCount() {
			$pageCount = 1;
			$recordsCount = $this->recordsCount(2); //Считаем к-ство записей, соответсвенно категории
			if ($recordsCount > 0) {
				$pageCount = ceil($recordsCount / $this->articlesPerPage);
			}
			return $pageCount;
		}

		public function getFullArticle($articleId) {
			$data = null;
			if (!is_null($articleId) && is_numeric($articleId)) {
				$q = "SELECT `ogo_news`.`fid`,
							`ogo_news`.`ftitle`,
							`ogo_news`.`fcreate_date`,
							`ogo_news`.`fnews_text`,
							`ogo_users`.`fname`,
							`ogo_news`.`fview_count`,
							COUNT(`ogo_comments`.`fid`) AS `fcomments_count`
					FROM `ogo_news`
					LEFT JOIN `ogo_users` ON `ogo_news`.`fauthor_id`=`ogo_users`.`fid`
					LEFT JOIN `ogo_comments` ON `ogo_news`.`fid`=`ogo_comments`.`fnews_id`
					WHERE `ogo_news`.`fid` = :i
					LIMIT 0, 1";
				$c = array($articleId);
				$data = $this->selectBySql($q, $c);
			}
			return $data;
		}

	} //Class end
?>