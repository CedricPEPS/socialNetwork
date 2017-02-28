<?php

	class signUp extends Controller 
	{

		function index() 
		{
			$data = array('title' => "Home Social NetWork");

			return $data;
		}

		function create () 
		{
			
			// var_dump($_POST);
			$pseudo = $_POST['pseudo'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$mail = $_POST['mail'];
			$password = $_POST['password'];

			// var_dump($pseudo);

			Controller::loadClass('signUpAccount');
			$db = new signUpAccount($pseudo, $firstname, $lastname, $mail, $password);
			
			// $user = signUpAccount::insertUser($pseudo, $firstname, $lastname, $mail, $password);

			$db->insertUser($pseudo, $firstname, $lastname, $mail, $password);



			
		}
		
	}

	?>