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

		    $data 	= array('pseudo' => $fetch['pseudo'], 'id' => $fetch['id']);

		    if ($row > 0) {
		    	return $data;
		    } else {
		    	return false;
		    }
		}

		public static function getUserById ($id) {
			$query  = DataBase::bdd()->query("SELECT * FROM users WHERE id = '{$id}'");
		    $fetch  = $query->fetch();
		    $row    = $query->rowCount();

		    $data 	= array('pseudo' => $fetch['pseudo'], 'id' => $fetch['id']);

		    if ($row > 0) {
		    	return $data;
		    } else {
		    	return false;
		    }
		}

		public static function setNotifAddUser($user_id, $friend_id, $action) {
			$req = DataBase::bdd()->prepare('INSERT INTO notifications(user_id, friend_id, action) VALUES (:user_id, :friend_id, :action)');

	      	$req->bindParam(":user_id", $user_id);
	        $req->bindParam(":friend_id", $friend_id);
	        $req->bindParam(":action", $action);
	        $req->execute();
		}

		public static function getNotifByUserId($user_id) {
			$query  = DataBase::bdd()->query("SELECT * FROM notifications WHERE friend_id = '{$user_id}' and action = 1");
		    $fetch  = $query->fetch();
		    $row    = $query->rowCount();

		    $data 	= array('friend_id' => $fetch['user_id'], 'action' => $fetch['action'], 'row' => $row, 'id' => $fetch['id']);

		    if ($row > 0) {
		    	return $data;
		    } else {
		    	return false;
		    }
		}

		public static function updateNotif($id) {
			$update = DataBase::bdd()->query("UPDATE notifications SET action = 0 WHERE id = '{$id}'");
		}

		public static function addFriend($user_id, $friend_id) {
			$req = DataBase::bdd()->prepare('INSERT INTO friend(user_id, friend_id) VALUES (:user_id, :friend_id)');
	        $req->execute();
		}

	}