<?php
class profile extends Controller {

	function index() {

		$data = array(
				'title' => "Profile",
				'asset' => ASSET,
				'root' 	=> ROOT,
				'online' => true,
				'online' => true,
				'pseudo'=> $_SESSION['pseudo']
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
				'pseudo'=> $_SESSION['pseudo']
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
			var_dump($_FILES['avatar']);
			$extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
			

			if(in_array($extensionUpload, $validExtension))
			{
				$asset 			= "templates/asset"; 
				$cheminAvatar 	= "/images/avatars/".$_SESSION['id'].".".$extensionUpload;
				$result 		= move_uploaded_file($_FILES['avatar']['tmp_name'], $asset.$cheminAvatar);
				$avatar 		= $_SESSION['id'].".".$extensionUpload;
				
				if($result)
				{
					$updateAvatar = DataBase::bdd()->prepare("UPDATE users SET photo = '{$avatar}' WHERE pseudo = '{$pseudo}'");
					$updateAvatar->execute(array(
						'avatar' 	=> $_SESSION['id'].".".$extensionUpload,
						'id'		=> $_SESSION['id']
						));
										
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
}
