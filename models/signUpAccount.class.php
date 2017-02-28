<?php


  class signUpAccount 
  {
    

    // public function __construct()
    // {
    //     $this->firstname    = $firstname;
    //     $this->lastname     = $lastname;
    //     $this->pseudo       = $pseudo;
    //     $this->mail         = $mail;
    //     $this->password     = $password;
    // }


    public static function insertUser ($pseudo, $firstname, $lastname, $mail, $password) 
    {
        // $this->firstname    = $firstname;
        // $this->lastname     = $lastname;
        // $this->pseudo       = $pseudo;
        // $this->mail         = $mail;
        // $this->password     = $password;

    	  var_dump($pseudo);         		
      	
        $req = DataBase::bdd()->prepare('INSERT INTO users (pseudo, firstname, lastname, password, mail) VALUES (:pseudo, :firstname, :lastname, :password, :mail)');
         
        var_dump($pseudo);
      	$req->bindParam(":pseudo", $pseudo);
        $req->bindParam(":firstname", $firstname);
        $req->bindParam(":lastname", $lastname);
        $req->bindParam(":password", $password);
        $req->bindParam(":mail", $mail);
        var_dump($req);
        $req->execute();
        // (array(
        //       'pseudo'=>$pseudo,
        //       'firstname'=>$firstname,
        //       'lastname'=>$lastname,
        //       'password'=>$password,
        //       'mail'=>$mail
        //   ));

	  }
  }

  ?>