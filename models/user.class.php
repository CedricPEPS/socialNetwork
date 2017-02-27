<?php

	class log {

		public static function getUser ($name, $password) {
			$query  = DataBase::bdd()->query("SELECT * FROM users WHERE pseudo = '{$name}' and password = '{$password}'");
		    $fetch  = $query->fetch();
		    $row    = $query->rowCount();

		    return ($row > 0) ? $fetch['pseudo'] : false;
		}

	}