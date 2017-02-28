<?php

	class home extends Controller {

		function index() {
			$data = array(
				'title' => "Home Social NetWork",
				'asset' => ASSET
			);

			return $data;
		}

		function log() {
			extract($_POST);

			Controller::loadClass('user');
			Controller::loadClass('articles');
echo $_SESSION['pseudo'];
			if (isset($_SESSION['pseudo'])) {
				$articles = articles::getArticles($_SESSION["id"]);
			} else {
				$user = log::getUser($login, $password);
				// Set SESSION
				$_SESSION['pseudo'] = $user['pseudo'];
				$_SESSION['id'] 	= $user['id'];
			}

			if ($_SESSION['pseudo']) {
				$data = array(
					'title' => 'Profil '.$_SESSION['pseudo'].' ',
					'asset' => ASSET,
					'root' => ROOT, 
					'online' => true,
					'articles' => $articles
				);
			} else {
				$data = array(
					'online' => false,
					'root' => ROOT,
					'asset' => ASSET,
					'error' => 'Invalid login or password'
				);
			}

			return $data;
		}
		
		function createArticle() {
			extract($_POST);

			Controller::loadClass('articles');

			$articles = articles::insert($content, $_SESSION["id"]);

			header("Location: ".ROOT."home/log");
		}
	}