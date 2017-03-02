<?php

	class fPassword extends Controller {

		function index() {
			Controller::loadClass('user');

			if (empty($_POST['login']) && (empty($_POST['mail']))){
				$data = array(
					'title' => 'Lost Password',
					'asset' => ASSET,
					'root' => ROOT,
					'error' => 'invalid login or mail'
				);
			} else {
				$login = $_POST['login'];
				$mail = $_POST['mail'];

				$userExist = log::getLogin($login, $mail);

				$data = array(
					'title' => 'Lost Password',
					'asset' => ASSET,
					'root' => ROOT,
					'userExist' => $userExist, 
					'pseudo'=> $login
				);

			}

			return $data;
		}

		function newPassword() {
			Controller::loadClass('user');

			$pseudo = $_POST['pseudo'];
			$password = $_POST['password'];
			$confPasswordl = $_POST['confPassword'];

			if (empty($password) && (empty($confPassword)) && $passord == $confPassword) {
				$data = array(
					'title' => 'Lost Password',
					'asset' => ASSET,
					'root' => ROOT,
					'error' => 'the password are different'
				);
			} else {
				log::setNewPassword($password, $pseudo);

				header("Location: ".ROOT."home");
				
			}
			return $data;
		}

	}
		
?>