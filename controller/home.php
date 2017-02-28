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

			$user = log::getUser($login, $password);

			// Set SESSION
			$_SESSION['pseudo'] = $user['pseudo'];
			$_SESSION['id'] 	= $user['id'];

			if ($user['pseudo']) {
				$data = array(
					'title' => 'Profil '.$user['pseudo'].' ',
					'asset' => ASSET,
					'online' => true
				);
			} else {
				$data = array(
					'online' => false,
					'asset' => ASSET
				);
			}

			return $data;
		}
		
		function createArticle(){

			extract($_POST);

			Controller::loadClass('articles');

			$articles=articles::insert($content, $_SESSION["id"]);


			$data = array(
					'title' => 'Profil '.$_SESSION['pseudo'].' ',
					'asset' => ASSET,
					'online' => true
				);

			return $data;
		}
	}