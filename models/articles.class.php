<?php
	class articles {

		public static function insert ($content, $users_id) {
	        $register = DataBase::bdd()->prepare("INSERT INTO articles(content, users_id, date) VALUES(:content, :users_id, NOW())");
	       
	        $register->bindParam(':content', $content);
	       	$register->bindParam(':users_id', $users_id);
	        
	        $register->execute();
       }

       public static function getArticles ($users_id) {
			$query  = DataBase::bdd()->query("SELECT * FROM articles WHERE users_id = $users_id ORDER BY date DESC");
		    
		    $fetch  = $query->fetchAll();
		    $row    = $query->rowCount();
		    $data 	= $fetch;
		    
		    if ($row > 0) {
		    	return $data; 
		    } else {
		    	return false;
		    }
		}
	}
?>