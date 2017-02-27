<?php

	class User {

		public static function getUser ($name) {
			$query  = DataBase::bdd()->query("SELECT * FROM users WHERE pseudo = '{$name}'");
		    $fetch  = $query->fetch();
		    $row    = $query->rowCount();

		    return ($row > 0) ? $fetch['pseudo'] : false;
		}

	}