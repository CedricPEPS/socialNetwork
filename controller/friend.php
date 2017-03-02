<?php

	class friend {

		function index() {

			if (isset($_POST['notificationId'])) {
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
					'friendId' => $friendId,
					'notificationId' => $notificationId
				);
			} else {
				$list = 'list of friend(s)';

				$data = array(
					'title' => 'Add Friend',
					'asset' => ASSET,
					'root' => ROOT, 
					'online' => true,
					'list' => $list
				);
			}

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
				'search' => true,
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

			log::addFriend($_SESSION['id'], $_POST['friendId']);

			$data = array(
				'title' => 'Add Friend',
				'asset' => ASSET,
				'root' => ROOT, 
				'online' => true,
				'add' => true,
				'pseudo' => $_POST['pseudo']
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