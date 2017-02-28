<?php

	class log {

		public static function getUser ($name, $password) {
			$query  = DataBase::bdd()->query("SELECT * FROM users WHERE pseudo = '{$name}' and password = '{$password}'");
		    $fetch  = $query->fetch();
		    $row    = $query->rowCount();

		    $data 	= array('pseudo' => $fetch['pseudo'], 'id' => $fetch['id']);

		    if ($row > 0) {
		    	return $data; 
		    } else {
		    	return false;
		    }
		}

	}