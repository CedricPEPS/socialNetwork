<?php

	class signUp extends Controller 
	{

		function index() 
		{
			$data = array(
				'title' => "SignUp",
				'asset' => ASSET,
				'root' => ROOT
			);

			return $data;
		}

		function create () 
		{
		
			$pseudo = $_POST['pseudo'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$mail = $_POST['mail'];
			$password = $_POST['password'];

			Controller::loadClass('user');

			log::insertUser($pseudo, $firstname, $lastname, $mail, $password);

			$data = array(
				'title' => "SignUp",
				'asset' => ASSET,
				'root' => ROOT
			);

			return $data;
		}
		
	}

	?>
