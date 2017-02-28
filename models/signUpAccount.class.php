<?php


  class signUpAccount 
  {
    
    public static function insertUser ($pseudo, $firstname, $lastname, $mail, $password) 
    {    		
        $req = DataBase::bdd()->prepare('INSERT INTO users (pseudo, firstname, lastname, password, mail) VALUES (:pseudo, :firstname, :lastname, :password, :mail)');
         
      	$req->bindParam(":pseudo", $pseudo);
        $req->bindParam(":firstname", $firstname);
        $req->bindParam(":lastname", $lastname);
        $req->bindParam(":password", $password);
        $req->bindParam(":mail", $mail);
        $req->execute();
	  }
  }

  ?>
