<?php

	class MaterialsModel extends BDatabase{
	
		public function getArticle() {
			$result = $this->db->query("SELECT * FROM articles WHERE `fid` = 8");
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$dataSet[] = $row;
				}
			}
			foreach ($dataSet as $data){
				echo "<h5>".$data['ftitle']."</h5>".$data['ftext']."<hr />";
			}
		}
	
	}


?>
