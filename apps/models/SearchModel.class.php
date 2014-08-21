<?php

class SearchModel extends BDatabase {

	public $tableName = "ogo_news";
	public $primaryKey = "fid";
	public $category = "search";
	public $newsPerPage = 3;

	public function findAll($currentPage) {
		$data = null;
		$offset = ($currentPage - 1) * $this->newsPerPage;
		if (isset($_GET['search-button'])) {
			if (isset($_GET['searchField'])) {
				$findPhraze = strip_tags(trim($_GET['searchField']));
				$q = "SELECT `fid`,
							`ftitle`,
							`fsummary_text`,
							`fcategory`
						FROM `ogo_news`
						WHERE MATCH (`ftitle`, `fnews_text`) AGAINST (:s)
						ORDER BY `fcreate_date` DESC
						LIMIT :i, :i";
				$cond = array($findPhraze, $offset, $this->newsPerPage);
				$data = $this->selectBySql($q, $cond);
			}
		}
		return $data;
	}

	
	/**
		Переопределенный метод из модуля DataAccess.class.php
		модели Новостей и Материалов используют родительский
		метод определенный в базовом классе
	*/

	public function getPageCount() {
		$recordsCount = $this->recordsCount(); //Считаем к-ство записей
		$pageCount = ceil($recordsCount / $this->newsPerPage);
		if ($pageCount === 0) {
			return 1;
		}
		return $pageCount;
	}

	
	/**
		Переопределенный метод из модуля DataAccess.class.php
		модели Новостей и Материалов используют родительский
		метод определенный в базовом классе
	*/

	public function recordsCount() {
		$data = null;
		if (isset($_GET['search-button'])) {
			if (isset($_GET['searchField'])) {
				$findPhraze = strip_tags(trim($_GET['searchField']));
				$q = "SELECT COUNT(`fid`) AS `count`
						FROM `ogo_news`
						WHERE MATCH (`ftitle`, `fnews_text`) AGAINST (:s)
						LIMIT 0, 1";
				$cond = array($findPhraze);
				$data = $this->selectBySql($q, $cond);
			}
		}
		if (is_array($data)) {
			return $data[0]->count; // return INTEGER value
		} else {
			return 0;
		}
	}
}

?>