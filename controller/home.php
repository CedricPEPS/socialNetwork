<?php

	class home extends Controller {

		function index() {
			if (isset($_SESSION['pseudo'])) {
				
				Controller::loadClass('articles');
				Controller::loadClass('user');

				require('core/utils.php');

				$notifications = log::getNotifByUserId($_SESSION['id']);
				$articles = articles::getArticles($_SESSION["id"]);
				$info = log::getUserInfo($_SESSION['id']);

				$i = 0;

				while ($i < count($articles) && $articles != false) {

					$articles[$i]['date'] = time_elapsed_string($articles[$i]['date']);

					$i++;
				}

				$data = array(
					'title' => 'Welcome '.$_SESSION['pseudo'].'',
					'asset' => ASSET,
					'online' => true,
					'root' => ROOT,
					'home' => true,
					'articles' => $articles,
					'notifications' => $notifications['row'],
					'friendId' => $notifications['friend_id'],
					'notificationId' => $notifications['id'],
					'avatar' => $info['avatar']
				);
			} else {
				
				$data = array(
					'title' => "Home Social NetWork",
					'asset' => ASSET,
					'root' => ROOT
				);
			}

			return $data;
		}

		function log() {
			Controller::loadClass('user');

			if (!isset($_SESSION['pseudo']) && !empty($_POST['login']) && !empty($_POST['password'])) {
				$user = log::getUser($_POST['login'], $_POST['password']);
				
				// Set SESSION
				$_SESSION['pseudo'] = $user['pseudo'];
				$_SESSION['id'] 	= $user['id'];
			}

			if (!empty($_SESSION['pseudo'])) {
				header("Location: ".ROOT."home");
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