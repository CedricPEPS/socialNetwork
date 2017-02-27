<?php

	class home extends Controller {

		function index() {
			$data = array('title' => "Home Social NetWork");

			return $data;
		}

		function log () {
			extract($_POST);

			Controller::loadClass('log');

			$user = log::getUser($login);

			return $data = array(
				'title' => "Profil $user",
				'online' => 'true'
			);
		}
		
	}