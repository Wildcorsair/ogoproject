<?php
require_once("CommentsModel.class.php");

class NewsModel extends BDatabase {
	public $tableName = "ogo_news";
	public $primaryKey = "fid";
	public $newsPerPage = 3;
	public $commentsObject;
	
	public function __construct() {
		parent::__construct();
		$this->commentsObject = new CommentsModel();

	}
	
	public function getNewsList($currentPage) {
		try {
			$offset = 0;
			$pageCount = $this->getPageCount();
			if ($currentPage <= 0 or $currentPage > $pageCount or !is_numeric($currentPage)) {
				throw new Exception ("Error 404!");
			}
			$offset = ($currentPage - 1) * $this->newsPerPage;
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
					GROUP BY `ogo_news`.`fid`
					LIMIT :i, :i";
			$c = array($offset, $this->newsPerPage);
			$data = $this->selectBySql($q, $c);
			return $data;
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getFullNews($newsId) {
		$data = null;
		if (!is_null($newsId) && is_numeric($newsId)) {
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
			$c = array($newsId);
			$data = $this->selectBySql($q, $c);
			//var_dump($data);
		}
		return $data;
	}
	
	public function setViewCount($newsId, $currCount) {
		$this->fview_count = $currCount + 1;
		$res = $this->updateById($newsId);
	}

	/*
		Функция возвращает количество страниц,
		если мы будем отображать по $this->newsPerPage
		записей на странице. 
		Значение по-умолчанию 5 записей.
	*/
	public function getPageCount() {
		$pageCount = 1;
		$recordsCount = $this->recordsCount();
		if ($recordsCount > 0) {
			$pageCount = ceil($recordsCount / $this->newsPerPage);
		}
		return $pageCount;
	}

	public function pageNavigation($currentPage, $linkCount=5) {
		$pageStr = null;
		$pageCount = $this->getPageCount();
		if (!isset($currentPage) && !is_numeric($currentPage)) {
			$currentPage = 1;
		}
		
		if ($currentPage <= 0) {
			$currentPage = 1;
		} elseif ($currentPage > $pageCount) {
			$currentPage = $pageCount;
		}

		if ($pageCount <= $linkCount) {
			for ($pageNum = 1; $pageNum <= $pageCount; $pageNum++) { 
				$this->linkageNavString($pageStr, $pageNum, $currentPage);
			}
		} else {
			$leftOffset = $currentPage - 2;
			$rightOffset = $currentPage + 2;

			if ($leftOffset <= 2) {
				$leftOffset = 1;
				/*
					Если количество страниц будет всего на 1-ну больше чем значение в
					$linkCount, то добавляем еще одну ссылку на страницу, для того 
					чтобы не вставлялось многоточие между предпоследней и последней ссылкой
					вот так: 1 2 3 4 5 ... 6
				*/
				if ($pageCount == ($linkCount + 1)) {
					for ($pageNum = $leftOffset; $pageNum <= $linkCount + 1; $pageNum++) {
						$this->linkageNavString($pageStr, $pageNum, $currentPage);
					}
				} else {
					for ($pageNum = $leftOffset; $pageNum <= $linkCount; $pageNum++) {
						$this->linkageNavString($pageStr, $pageNum, $currentPage);
					}
					$pageStr .=	"<li><span>...</span></li>";
					$pageStr .=	"<li><a href='/news/index/{$pageCount}'>{$pageCount}</a></li>";
				}
			} else if ($rightOffset >= $pageCount - 1) {
				$leftOffset = $pageCount - $linkCount;
				/*
					Тоже что и выше, если правый сдвиг вышел за диапазон страниц, но при этом
					ссылки начинаюся с 1-й страницы, то выводим строку ссылок без много точий,
					чтобы не было вот так 1 ... 2 3 4 5 6 
				*/
				if ($leftOffset == 1) {
					for ($pageNum = $leftOffset; $pageNum <= $linkCount + 1; $pageNum++) {
						$this->linkageNavString($pageStr, $pageNum, $currentPage);
					}
				} else {
					$pageStr .= "<li><a href='/news/index/1'>1</a></li>";
					$pageStr .= "<li><span>...</span></li>";
					$leftOffset++;
					for ($pageNum = $leftOffset; $pageNum <= $pageCount; $pageNum++) {
						$this->linkageNavString($pageStr, $pageNum, $currentPage);
					}
				}

			} else {
				$pageStr .= "<li><a href='/news/index/1'>1</a></li>";
				$pageStr .= "<li><span>...</span></li>";
				for ($pageNum = $leftOffset; $pageNum <= $rightOffset; $pageNum++) {
					$this->linkageNavString($pageStr, $pageNum, $currentPage);
				}
				$pageStr .=	"<li><span>...</span></li>";
				$pageStr .=	"<li><a href='/news/index/{$pageCount}'>{$pageCount}</a></li>";
			}
		}
		return $pageStr;
	}

	private function linkageNavString(&$linkStr, $pageNum, $currentPage) {
		if ($pageNum == $currentPage) {
			$linkStr .= "<li><a href='/news/index/{$pageNum}' class='curr-page'>{$pageNum}</a></li>\n";	
		} else {
			$linkStr .= "<li><a href='/news/index/{$pageNum}'>{$pageNum}</a></li>\n";
		}
	}
}
?>
