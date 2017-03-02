<?php

	class friend {

		function index() {
			$notificationId = $_POST['notificationId'];

			$friendId = $_POST['friendId'];

			Controller::loadClass('user');

			$userAsk = log::getUserById($friendId);

			$data = array(
				'title' => 'Add Friend',
				'asset' => ASSET,
				'root' => ROOT, 
				'online' => true,
				'userAsk' => $userAsk['pseudo'],
				'notificationId' => $notificationId
			);

			return $data;
		}

		function send() {

			$friendPseudo = $_POST['pseudo'];

			Controller::loadClass('user');

			$find = log::getUserByPseudo($_POST['pseudo']);

			$request = log::setNotifAddUser($_SESSION['id'], $find['id'], 1);

			$data = array(
				'title' => 'Add Friend',
				'asset' => ASSET,
				'root' => ROOT, 
				'online' => true,
				'send' => true
			);

			return $data;
		}

		function search() {
			Controller::loadClass('user');

			$find = log::getUserByPseudo($_POST['pseudo']);

			if ($find != false) {
				$data = array(
					'title' => 'Add Friend',
					'asset' => ASSET,
					'root' => ROOT, 
					'online' => true,
					'friend' => $find['pseudo'],
					'search' => true
				);
			} else {
				$data = array(
					'title' => 'Add Friend',
					'asset' => ASSET,
					'root' => ROOT, 
					'online' => true,
					'pseudo' => $_POST['pseudo'],
					'search' => false
				);
			}

			return $data;
		}


		function accept() {
			Controller::loadClass('user');

			log::updateNotif($_POST['notificationId']);

			log::addFriend($_SESSION['id'], $_POST['friend_id']);

			$data = array(
				'title' => 'Add Friend',
				'asset' => ASSET,
				'root' => ROOT, 
				'online' => true
			);

			return $data;
		}

		function refuse() {
			Controller::loadClass('user');

			log::updateNotif($_POST['notificationId']);



			$data = array(
				'title' => 'Add Friend',
				'asset' => ASSET,
				'root' => ROOT, 
				'online' => true
			);

			return $data;
		}

	}