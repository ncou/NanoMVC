<?php

class Example_model extends Model {

	
	public function getSomething($id)
	{
        try {
			$sql = $this->db->prepare('SELECT * FROM media_tags'); 
			$sql->execute();
		    return $sql->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}

	}

}

?>
