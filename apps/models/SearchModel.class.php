<?php

class SearchModel extends BDatabase {

	public $tableName = "ogo_news";
	public $primaryKey = "fid";
	public $category = "search";

	public function findAll() {
		$data = null;
		if (isset($_POST['search-button'])) {
			if (isset($_POST['searchField'])) {
				$findPhraze = strip_tags(trim($_POST['searchField']));
				$q = "SELECT `fid`,
							 `ftitle`,
							 `fsummary_text`,
							`fcategory`
						FROM `ogo_news`
						WHERE MATCH (`ftitle`, `fnews_text`) AGAINST (:s)
						LIMIT 0, 10";
				$cond = array($findPhraze);
				$data = $this->selectBySql($q, $cond);
			}
		}
		return $data;
	}

	public function getPageCount($dataSet) {
		//return count($dataSet);
		return 1;
	}
}

?>