<?php
class ajax extends Controller{
	function validate () 
		{
		
			$pseudo = $_REQUEST['pseudo'];
			
			$query  = DataBase::bdd()->query("SELECT * FROM users WHERE pseudo ='{$pseudo}'");
			$fetch  = $query->fetch();
			$row    = $query->rowCount();
			
			if ($row == 0) 
			{
				$data = array(
					'validate'	=> true
				);
				return $data;
			
			}
			else
			{
				$data = array(
					'validate'	=>  false
				);
				return $data;
			}
		}
}