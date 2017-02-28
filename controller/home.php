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

			if ($user) {
				$data = array(
					'title' => "Profil $user",
					'asset' => ASSET,
					'online' => true
				);
			} else {
				//header('Location: '.WEBROOT.'home');
				$data = array(
					'online' => false,
					'asset' => ASSET
				);
			}

			return $data;
		}
		
		
	}