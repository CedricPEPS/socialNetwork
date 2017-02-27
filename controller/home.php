<?php

	class home extends Controller {

		function index() {
			$data = array('title' => "Home Social NetWork");

			return $data;
		}

		function log() {
			extract($_POST);

			Controller::loadClass('User');

			$user = log::getUser($login);

			if ($user) {
				$data = array(
					'title' => "Profil $user",
					'online' => true
				);
			} else {
				//header('Location: '.WEBROOT.'home');
				$data = array(
					'online' => false
				);
			}

			return $data;
		}
		
	}