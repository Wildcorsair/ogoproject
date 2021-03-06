<?php

	class BDatabase extends DataAccess {
		public $uid;

		public function __construct() {
			parent::__construct("localhost", "root", "k13ju357", "ogoBase");
		}

		public function dateConvert($dateString) {
			$month = array('01' => "января",
							'02' => "февраля",
							'03' => "марта",
							'04' => "апреля",
							'05' => "мая",
							'06' => "июня",
							'07' => "июля",
							'08' => "августа",
							'09' => "сентября",
							'10' => "октября",
							'11' => "ноября",
							'12' => "декабря");
			$extractedString = substr($dateString, 0, 10);
			$dateParts = explode("-", $extractedString);

			$dateParts[1] = $month[$dateParts[1]];
			return $dateParts;
		}

		public function dateExtract($dateString) {
			$extractedDate = date('d-m-Y', strtotime($dateString));
			return $extractedDate;
		}

		public function getPopLinks($categoryId) {
			$data = null;
			$q = "SELECT 
					`ogo_news`.`fid`,
					`ogo_news`.`ftitle`,
					COUNT(`ogo_comments`.`fid`) AS `fcom_count` 
				FROM `ogo_news`
				LEFT JOIN `ogo_comments` ON `ogo_news`.`fid` = `ogo_comments`.`fnews_id`
				WHERE `ogo_news`.`fcategory` = :i
				GROUP BY `ogo_news`.`fid`
				ORDER BY `fcom_count` DESC
				LIMIT 0, 3";
			$c = array($categoryId);
			$data = $this->selectBySql($q, $c);
			return $data;
		}

		public function emailValidate($email) {
			//"|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i"
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return true;
			} else {
				return false;
			}
		}

/*		public function getPageCount($category) {
			$pageCount = 1;
			$recordsCount = $this->recordsCount($category); //Считаем к-ство записей, соответсвенно категории
			if ($recordsCount > 0) {
				$pageCount = ceil($recordsCount / $this->articlesPerPage);
			}
			return $pageCount;
		}*/
		
		/* Функция обновления счетчика просмотров */
		public function setViewCount($newsId, $currCount) {
			$this->fview_count = $currCount + 1;
			$res = $this->updateById($newsId);
		}
	
		public function pageNavigation(	$currentPage,
										$category,
										$linkCount=5,
										$paramStr=null ) {
			$pageStr = null;
			$pageCount = $this->getPageCount($category);
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
					$this->linkageNavString($pageStr, $pageNum, $currentPage, $category, $paramStr);
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
							$this->linkageNavString($pageStr, $pageNum, $currentPage, $category, $paramStr);
						}
					} else {
						for ($pageNum = $leftOffset; $pageNum <= $linkCount; $pageNum++) {
							$this->linkageNavString($pageStr, $pageNum, $currentPage, $category);
						}
						$pageStr .=	"<li><span>...</span></li>";
						$pageStr .=	"<li><a href='/".$category."/index/{$pageCount}{$paramStr}'>{$pageCount}</a></li>";
					}
				} else if ($rightOffset >= $pageCount - 1) {
					$leftOffset = $pageCount - $linkCount;
					/*
						Тоже что и выше, если правый сдвиг вышел за диапазон страниц, но при этом
						ссылки начинаюся с 1-й страницы, то выводим строку ссылок без многоточий,
						чтобы не было вот так 1 ... 2 3 4 5 6 
					*/
				if ($leftOffset == 1) {
						for ($pageNum = $leftOffset; $pageNum <= $linkCount + 1; $pageNum++) {
							$this->linkageNavString($pageStr, $pageNum, $currentPage, $category, $paramStr);
						}
					} else {
						$pageStr .= "<li><a href='/".$category."/index/1{$paramStr}'>1</a></li>";
						$pageStr .= "<li><span>...</span></li>";
						$leftOffset++;
						for ($pageNum = $leftOffset; $pageNum <= $pageCount; $pageNum++) {
							$this->linkageNavString($pageStr, $pageNum, $currentPage, $category, $paramStr);
						}
					}
	
				} else {
					$pageStr .= "<li><a href='/".$category."/index/1?{$paramStr}'>1</a></li>";
					$pageStr .= "<li><span>...</span></li>";
					for ($pageNum = $leftOffset; $pageNum <= $rightOffset; $pageNum++) {
						$this->linkageNavString($pageStr, $pageNum, $currentPage, $category, $paramStr);
					}
					$pageStr .=	"<li><span>...</span></li>";
					$pageStr .=	"<li><a href='/".$category."/index/{$pageCount}{$paramStr}'>{$pageCount}</a></li>";
				}
			}
			return $pageStr;
		}

		private function linkageNavString(&$linkStr, $pageNum, $currentPage, $category, $paramStr=null) {
			if ($pageNum == $currentPage) {
				$linkStr .= "<li><a href='/".$category."/index/{$pageNum}{$paramStr}' class='curr-page'>{$pageNum}</a></li>\n";	
			} else {
				$linkStr .= "<li><a href='/".$category."/index/{$pageNum}{$paramStr}'>{$pageNum}</a></li>\n";
			}
		}
	} //Class end
?>
