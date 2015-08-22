<?php

class CpanelModel extends BDatabase {
	public $primaryKey = 'fid';
	public $recsPerPage = 5;
	public $offset = 0;
	public $currentPage;
	public $pageCount;

	public function usersList($currentPage) {
		try {
			$this->pageCount = $this->getPageCount("ogo_users", null);
			if ($currentPage <= 0 || $currentPage > $this->pageCount) {
				throw new Exception ("Error 404! Нет накой страницы!");
			}
			$this->currentPage = $currentPage;
			$this->offset = ($currentPage - 1) * $this->recsPerPage;
			$q = "SELECT `ogo_users`.`fid`,
							`flogin`,
							`fname`,
							`fuserMail`,
							`fcreateAccount`,
							`ogo_groups`.`fgroup_name`
					FROM `ogo_users`
					LEFT JOIN `ogo_groups` ON `ogo_users`.`fgroup_id` = `ogo_groups`.`fid`
					LIMIT :i, :i";
			$c = array($this->offset, $this->recsPerPage);
			$dataSet = $this->selectBySql($q, $c);
			return $dataSet;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function newsList($currentPage) {
		try {
			$cond = array('fcategory' => 1);
			$this->pageCount = $this->getPageCount("ogo_news", $cond);
			if ($currentPage <= 0 || $currentPage > $this->pageCount) {
				throw new Exception ("Error 404! Нет такой страницы!");
			}
			$this->currentPage = $currentPage;
			$this->offset = ($currentPage - 1) * $this->recsPerPage;
			$q = "SELECT 
						`fid`,
						`fcategory`,
						`ftitle`,
						`fcreate_date`
					FROM `ogo_news`
					WHERE `fcategory` = 1
					LIMIT :i, :i";
			$c = array($this->offset, $this->recsPerPage);
			$dataSet = $this->selectBySql($q, $c);
			return $dataSet;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getUserData() {
		if (isset($_GET['id']) && preg_match('/^\d+$/', $_GET['id'])) {
			$uid = $_GET['id'];
			$this->tableName = 'ogo_users';
			$query = 'SELECT `ou`.`fid`,
							 `flogin`,
							 `fname`,
							 `fuserMail`,
							 `fcreateAccount`,
							 `fgroup_id`,
							 `og`.`fgroup_name`
					  FROM `ogo_users` `ou`
					  LEFT JOIN `ogo_groups` `og` ON `ou`.`fgroup_id` = `og`.`fid`
					  WHERE `ou`.`fid` = :i
					  LIMIT 0, 1';
			$cond = array($uid);
			$record = $this->selectBySql($query, $cond);
		} else {
			//$this->showErrorMessage(10);
		}
		return $record;
	}

	public function getGroups() {
		$items = null;
		$this->tableName ='ogo_groups';
		$query = "SELECT `fid`, `fgroup_name` FROM `ogo_groups` LIMIT 0, 30";
        $data = $this->selectBySql($query);
        if (!empty($data)) {
            foreach ($data as $value) {
                $items .= "<li data-value='{$value->fid}'>{$value->fgroup_name}</li>";
            }
        }
        echo $items;

	}

public function userSaveAction() {
	$this->tableName ='ogo_users';
	if (isset($_POST['uID']) && is_numeric($_POST['uID'])) {
		$uID = $_POST['uID'];
		$this->fname = $_POST['uname'];
		$this->fuserMail = $_POST['email'];
		$this->fgroup_id = $_POST['groupId'];
		$this->updateById($uID);
	} else {
		echo 'Nothing';
	}
}

	public function getPageCount($tableName, $cond) {
		$pageCount = 1;
		$recordsCount = $this->recCountCond($tableName, $cond);
		$this->rc = $recordsCount;
		if ($recordsCount > 0) {
			$pageCount = ceil($recordsCount / $this->recsPerPage);
		}
		return $pageCount;
	}

	/*
		$cond = string ('`fcategory` = 1 AND `fauthor_id` = 15');
	*/
	
	public function recCountCond($tableName, $cond = null) {
		$count = 0;
		$condStr = 'WHERE ';
		$query = "SELECT COUNT(`{$this->primaryKey}`) AS `count`
					FROM `{$tableName}` ";
		if (isset($cond)) {
			$query .= "WHERE {$cond} ";
		}
		$query .= 'LIMIT 0, 1';
		$result = $this->db->query($query) or die("Database Error: ".$this->db->error);
			if ($result->num_rows > 0) {
				$count = $result->fetch_assoc();
			}
		$result->close();
		return $count['count']; //Returns INTEGER value
	}
	
	public function dataGrid($dataSet, $fieldsList, $route, $title, $colspan) {
		$startRec = $this->offset + 1;
		$recCount = count($dataSet);
		$endRec = $this->offset + $recCount;
		echo "<table class='grey-table'><thead>
				<tr><th colspan='{$colspan}'>{$title}</th></tr>
				<tr>";
		foreach ($fieldsList as $fieldName => $fieldCaption) {
			echo "<th>".$fieldCaption."</th>";
		}
		echo "<th></th><th></th></tr></thead><tbody>";
		foreach ($dataSet as $record) {
			echo "<tr>";
				foreach ($fieldsList as $fieldName => $fieldCaption) {
					echo "<td>".htmlspecialchars($record->$fieldName)."</td>";
				}
			echo "<td class='btn-cont'>
						<a class='btn-tb ico-edit' 
							href='/{$route}Edit?id={$record->fid}'></a>
					</td>
					<td class='btn-cont'>
						<a class='btn-tb ico-delete'
							href='/{$route}Delete?id={$record->fid}'></a>
					</td>
					</tr>";
		}
		echo "</tbody>
				<tfoot>
					<tr>
						<td colspan='{$colspan}'>
							<div class='pagination'>";
							echo $this->pagination($this->currentPage, $route);
		echo				"</div>
							<div class='counter'>
								{$startRec} - {$endRec} из {$this->rc} записей
							</div>
						</td>
					</tr>
				</tfoot></table>";
	}

	public function pagination(	$currentPage,
									$route,
									$linkCount=5,
									$paramStr=null ) {
		$pageStr = null;
		$pageCount = $this->pageCount;
		if (!isset($currentPage) && !is_numeric($currentPage)) {
			$currentPage = 1;
		}
	
		if ($currentPage <= 0) {
			$currentPage = 1;
		} elseif ($currentPage > $pageCount) {
			$currentPage = $pageCount;
		}
		
		$prevPage = $currentPage - 1;
		$nextPage = $currentPage + 1;
		
		if ($pageCount <= $linkCount) {
			for ($pageNum = 1; $pageNum <= $pageCount; $pageNum++) { 
				$this->linkageNavString($pageStr, $pageNum, $currentPage, $route, $paramStr);
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
						$this->linkageNavString($pageStr, $pageNum, $currentPage, $route, $paramStr);
					}
				} else {
					for ($pageNum = $leftOffset; $pageNum <= $linkCount; $pageNum++) {
						$this->linkageNavString($pageStr, $pageNum, $currentPage, $route);
					}
					$pageStr .= "<a class='btn f-left ico-next' href='/{$route}/{$nextPage}'></a>";
					$pageStr .=	"<a class='btn f-left ico-last' href='/".$route."/{$pageCount}{$paramStr}'></a>";
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
						$this->linkageNavString($pageStr, $pageNum, $currentPage, $route, $paramStr);
					}
				} else {
					$pageStr .= "<a class='btn f-left ico-first' href='/".$route."/1{$paramStr}'></a>";
					$pageStr .= "<a class='btn f-left ico-prev' href='/{$route}/{$prevPage}'></a>";
					$leftOffset++;
					for ($pageNum = $leftOffset; $pageNum <= $pageCount; $pageNum++) {
						$this->linkageNavString($pageStr, $pageNum, $currentPage, $route, $paramStr);
					}
				}

			} else {
				/*
					Блок вывода средней части пагинации с кнопками "first" и
					"last" по краям
				*/
				$pageStr .= "<a class='btn f-left ico-first' href='/".$route."/1?{$paramStr}'></a>";
				$pageStr .= "<a class='btn f-left ico-prev' href='/{$route}/{$prevPage}'></a>";
				for ($pageNum = $leftOffset; $pageNum <= $rightOffset; $pageNum++) {
					$this->linkageNavString($pageStr, $pageNum, $currentPage, $route, $paramStr);
				}
				$pageStr .= "<a class='btn f-left ico-next' href='/{$route}/{$nextPage}'></a>";
				$pageStr .=	"<a class='btn f-left ico-last' href='/".$route."/{$pageCount}{$paramStr}'></a>";
			}
		}
		return $pageStr;
	}
	
	private function linkageNavString(&$linkStr, $pageNum, $currentPage, $route, $paramStr=null) {
		if ($pageNum == $currentPage) {
			$linkStr .= "<span class='btn f-left active' href='/".$route."/{$pageNum}{$paramStr}' class='curr-page'>{$pageNum}</span>\n";
			//$linkStr .= "<a class='btn f-left active' href='/".$route."/{$pageNum}{$paramStr}' class='curr-page'>{$pageNum}</a>\n";
		} else {
			$linkStr .= "<a class='btn f-left' href='/".$route."/{$pageNum}{$paramStr}'>{$pageNum}</a>\n";
		}
	}
}

?>