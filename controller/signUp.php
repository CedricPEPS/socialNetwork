<?php
	class signUp extends Controller 
	{
		function index() 
		{
			$data = array(
				'title' => "SignUp",
				'asset' => ASSET,
				'root' 	=> ROOT
			);
			return $data;
		}
		function create () 
		{
		
			$pseudo 		= $_POST['pseudo'];
			$firstname 		= $_POST['firstname'];
			$lastname 		= $_POST['lastname'];
			$mail 			= $_POST['mail'];
			$confPassword 	= $_POST['confPassword'];
			$password 		= $_POST['password'];
			$query  = DataBase::bdd()->query("SELECT * FROM users WHERE pseudo ='{$pseudo}'");
			$fetch  = $query->fetch();
			$row    = $query->rowCount();
			
			if ($row == 0) 
			{
				if ($password === $confPassword) 
				{
					
					$password = PassHash::hash($password);
					
					Controller::loadClass('user');
					log::insertUser($pseudo, $firstname, $lastname, $mail, $password);
					
					$data = array(
						'title' 	=> "Profile",
						'asset' 	=> ASSET,
						'root' 		=> ROOT,
						'validate'	=> true
					);
					
					return $data;
				}
				else 
				{	
					$data = array(
						'title' 	=> "SignUp",
						'asset' 	=> ASSET,
						'root' 		=> ROOT,
						'error' 	=> 'Invalid password',
						'validate'	=> false,
						'firstname'	=> $firstname,
						'lastname'	=> $lastname,
						'pseudo'	=> $pseudo,
						'mail'		=> $mail
					);
					
					return $data;
				}
			}
			else
			{
				$data = array(
					'title' 	=> "SignUp",
					'asset' 	=> ASSET,
					'root' 		=> ROOT,
					'error' 	=> 'Pseudo déjà utilisé',
					'validate'	=> false,
					'firstname'	=> $firstname,
					'lastname'	=> $lastname,
					'pseudo'	=> $pseudo,
					'mail'		=> $mail
					);
				
				return $data; 
			}
		}
	}
	?>