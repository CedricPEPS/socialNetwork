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
}