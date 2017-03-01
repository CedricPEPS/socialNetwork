<?php

	class log {

		public static function insertUser ($pseudo, $firstname, $lastname, $mail, $password) 
	    {    		
			$password = PassHash::hash($password);

	        $req = DataBase::bdd()->prepare('INSERT INTO users (pseudo, firstname, lastname, password, mail) VALUES (:pseudo, :firstname, :lastname, :password, :mail)');

	      	$req->bindParam(":pseudo", $pseudo);
	        $req->bindParam(":firstname", $firstname);
	        $req->bindParam(":lastname", $lastname);
	        $req->bindParam(":password", $password);
	        $req->bindParam(":mail", $mail);
	        $req->execute();
		}

		public static function getUser ($name, $password) {
			$query  = DataBase::bdd()->query("SELECT * FROM users WHERE pseudo = '{$name}' ");
			$fetch  = $query->fetch();
			$row    = $query->rowCount();
		
			$hash = $fetch['password'];
			$check = PassHash::check_password($hash, $password);
			
			if($check == 1){
				$data 	= array('pseudo' => $fetch['pseudo'], 'id' => $fetch['id']);
				return $data;
			} else {
				return false;
			}
		}

		public static function getUserByPseudo ($pseudo) {
			$query  = DataBase::bdd()->query("SELECT * FROM users WHERE pseudo = '{$pseudo}'");
		    $fetch  = $query->fetch();
		    $row    = $query->rowCount();

		    $data 	= array('pseudo' => $fetch['pseudo']);

		    if ($row > 0) {
		    	return $data; 
		    } else {
		    	return false;
		    }
		}

	}