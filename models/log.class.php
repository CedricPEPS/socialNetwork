<?php

	class log {

		public static function getUser ($name) {
			$query  = DataBase::bdd()->query("SELECT * FROM users");
		    $fetch  = $query->fetch();
		    $row    = $query->rowCount();

		    return ($row > 0) ? $fetch['pseudo'] : false;
		}

	}