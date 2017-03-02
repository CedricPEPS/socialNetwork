<?php

	class home extends Controller {

		function index() {
			if (isset($_SESSION['pseudo'])) {
				Controller::loadClass('articles');
				Controller::loadClass('user');

				$notifications = log::getNotifByUserId($_SESSION['id']);				
				$articles = articles::getArticles($_SESSION["id"]);

				$data = array(
					'title' => "Home Social NetWork",
					'asset' => ASSET,
					'online' => true,
					'root' => ROOT,
					'home' => true,
					'articles' => $articles,
					'notifications' => $notifications['row'],
					'friendId' => $notifications['friend_id'],
					'notificationId' => $notifications['id']
				);
			} else {
				$data = array(
					'title' => "Home Social NetWork",
					'asset' => ASSET,
					'root' => ROOT,
					'error' => 'Invalid login or password',
					'title' => "Home Social NetWork"
				);
			}
			return $data;
		}

		function log() {
			Controller::loadClass('user');
			Controller::loadClass('articles');
				

			if (!isset($_SESSION['pseudo'])) {
				$user = log::getUser($_POST['login'], $_POST['password']);
				
				// Set SESSION
				$_SESSION['pseudo'] = $user['pseudo'];
				$_SESSION['id'] 	= $user['id'];
			}

			if ($_SESSION['pseudo']) {
				$articles = articles::getArticles($_SESSION["id"]);
				$notifications = log::getNotifByUserId($_SESSION['id']);

				$data = array(
					'title' => 'Profil '.$_SESSION['pseudo'].' ',
					'asset' => ASSET,
					'root' => ROOT,
					'articles' => $articles,
					'home' => true,
					'online' => true,
					'notifications' => $notifications['row'],
					'friendId' => $notifications['friend_id'],
					'notificationId' => $notifications['id']
				);
			} else {
				$data = array(
					'online' => false,
					'root' => ROOT,
					'asset' => ASSET,
					'error' => 'Invalid login or password',
					'title' => "Home Social NetWork"
				);
			}
			return $data;
		}
		
		function createArticle() {
			Controller::loadClass('articles');

			$articles = articles::insert($_POST['content'], $_SESSION["id"]);
			header("Location: ".ROOT."home");
		}

		function disconnect() {
			session_destroy();

			$data = array(
				'title' => "Home Social NetWork",
				'asset' => ASSET,
				'root' => ROOT
			);

			return $data;
		}

	}
