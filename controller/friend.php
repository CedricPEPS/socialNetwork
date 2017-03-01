<?php

	class friend {

		function send() {

			$friendPseudo = $_POST['pseudo'];

			$data = array(
				'title' => 'Add Friend',
				'asset' => ASSET,
				'root' => ROOT, 
				'online' => true
			);

			return $data;
		}

		function search() {
			Controller::loadClass('user');

			$find = log::getUserByPseudo($_POST['pseudo']);

			$data = array(
				'title' => 'Profil '.$_SESSION['pseudo'].' ',
				'asset' => ASSET,
				'root' => ROOT, 
				'online' => true,
				'friend' => $find['pseudo'],
				'search' => true
			);

			return $data;
		}


	}