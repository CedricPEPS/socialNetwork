<?php
	class articles {

		public static function insert ($content, $users_id) {
	        $register = DataBase::bdd()->prepare("INSERT INTO articles(content, users_id, date) VALUES(:content, :users_id, NOW())");

	       
	        $register->bindParam(':content', $content);
	       	$register->bindParam(':users_id', $users_id);
	        
	        $register->execute();

       }
	}

?>