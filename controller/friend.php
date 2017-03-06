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
				Controller::loadClass('user');

				$listId = log::getListFriend($_SESSION['id']);

				$i = 0;

				while ($i < count($listId["friend"]) && count($listId["friend"]) > 0) {
					if ($listId["friend"][$i]["friend_id"] == $_SESSION['id']) {
						$list[] = ["list" => log::getUserById($listId["friend"][$i]['user_id'])];
					} else {
						$list[] = ["list" => log::getUserById($listId["friend"][$i]['friend_id'])];
					}

					$i++;
				}

				if (empty($list)) {
					$list = false;
				}

				$data = array(
					'title' => 'Add Friend',
					'asset' => ASSET,
					'root' => ROOT, 
					'online' => true,
					'lists' => $list
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

			if ($_SESSION['pseudo'] == $_POST['pseudo']) {

				$data = array(
					'title' => 'Add Friend',
					'asset' => ASSET,
					'root' => ROOT, 
					'online' => true,
					'myself' => true
				);
			} else {

				$find = log::getUserByPseudo($_POST['pseudo']);

				if ($find != false) {
					$listId = log::getListFriend($_SESSION['id']);


					if (count($listId["friend"]) > 0) {
						$i = 0;

						while ($i < count($listId["friend"])) {
							if ($listId["friend"][$i]["friend_id"] == $_SESSION['id']) {
								$list[] = ["list" => log::getUserById($listId["friend"][$i]['user_id'])];
							} else {
								$list[] = ["list" => log::getUserById($listId["friend"][$i]['friend_id'])];
							}

							if ($_POST['pseudo'] == $list[$i]['list']['pseudo']) {
								$alreadyFriend = true;
								$add = true;
								break;
							} else {
								$alreadyFriend = false;
								$add = false;
							}

							$i++;
						}

						$data = array(
							'title' => 'Add Friend',
							'asset' => ASSET,
							'root' => ROOT, 
							'online' => true,
							'friend' => $find['pseudo'],
							'pseudo' => $_POST['pseudo'],
							'search' => true,
							'add' => $add,
							'alreadyFriend' => $alreadyFriend
						);
					} else {
						$data = array(
							'title' => 'Add Friend',
							'asset' => ASSET,
							'root' => ROOT, 
							'online' => true,
							'friend' => $find['pseudo'],
							'search' => true
						);
					}
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
			}

			return $data;
		}


		function accept() {
			Controller::loadClass('user');

			log::updateNotif($_POST['notificationId']);

			$addFriend = log::addFriend($_SESSION['id'], $_POST['friendId']);

			if ($addFriend) {
				$data = array(
					'title' => 'Add Friend',
					'asset' => ASSET,
					'root' => ROOT, 
					'online' => true,
					'add' => true,
					'pseudo' => $_POST['pseudo']
				);
			} else {
				$data = array(
					'title' => 'Add Friend',
					'asset' => ASSET,
					'root' => ROOT, 
					'online' => true,
					'add' => true,
					'pseudo' => $_POST['pseudo'],
					'error' => true
				);
			}

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