<?php
class profile extends Controller {

	function index() {
		Controller::loadClass("user");
		
		$info = log::getUserInfo($_SESSION['id']);

		$notifications = log::getNotifByUserId($_SESSION['id']);			

		$data = array(
				'title' => "Profile",
				'asset' => ASSET,
				'root' 	=> ROOT,
				'online' => true,
				'pseudo'=> $_SESSION['pseudo'],
				'mail' => $info['mail'],
				'firstname' => $info['firstname'],
				'lastname' => $info['lastname'],
				'notifications' => $notifications['row'],
				'friendId' => $notifications['friend_id'],
				'notificationId' => $notifications['id'],
				'avatar' => $info['avatar']
		);

		return $data;
	}

	function newMail() {
		Controller::loadClass("user");
		
		$mail = $_POST['mail'];
		
		log::setNewMail($mail, $_SESSION['pseudo']);
			
		$data = array(
			'title' => 'Profile',
			'asset' => ASSET,
			'root' => ROOT,
			'online' => true,
			'pseudo'=> $_SESSION['pseudo'],
			'mail' => $mail
		);
		
		return $data;
	}

	function newAvatar(){
		Controller::loadClass("user");
		
		if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name']))
		{
			$sizeMax 		= 2097152;
			$validExtension = array('jpg', 'jpeg', 'png');
			$pseudo			= $_SESSION['pseudo'];
		}
		
		if($_FILES['avatar']['size'] <= $sizeMax)
		{
			$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
			
			if(in_array($extensionUpload, $validExtension))
			{
				$asset 			= "templates/asset"; 
				$cheminAvatar 	= "/images/avatars/".$_SESSION['id'].".".$extensionUpload;
				$result 		= move_uploaded_file($_FILES['avatar']['tmp_name'], $asset.$cheminAvatar);
				$avatar 		= $_SESSION['id'].".".$extensionUpload;
				
				if($result)
				{
					log::updateAvatar($_SESSION['pseudo'], $_SESSION['id'], $extensionUpload);
										
					$data = array(
						'title' => 'Add avatar',
						'asset' => ASSET,
						'root' => ROOT,
						'error' => 'Loading the successful avatar' 
					);
					return $data;
				}
				else
				{
					$data = array(
							'title' => 'Add Friend',
							'asset' => ASSET,
							'root' => ROOT, 
							'error' => "Error while uploading the image"
						);
					return $data;		
				}
			}
			else
			{
				$data = array(
							'title' => 'Add Friend',
							'asset' => ASSET,
							'root' => ROOT, 
							'error' => "The format of the image must be jpg, jpeg, png"
						);
				return $data;
			}
		}
		else
		{
			$data = array(
						'title' => 'Add Friend',
						'asset' => ASSET,
						'root' => ROOT, 
						'error' => "The size of the image should not exceed 2Mo"
					);
			return $data;
		}
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
	
	function newPseudo() {
		Controller::loadClass("user");
		$pseudo = $_POST['pseudo'];
		
		log::setNewPseudo($pseudo, $_SESSION['id']);
		$_SESSION['pseudo'] = $pseudo;
			
		$data = array(
			'title' => 'Profile',
			'asset' => ASSET,
			'root' => ROOT,
			'online' => true,
			'pseudo'=> $_SESSION['pseudo']
		);
				
		return $data;
	}
}