<?php

    class DataBase {

        public static function bdd() {
            $host   = "localhost";
            $base   = "socialNetwork";
            $login  = "root";
            $pass   = "online";

            try {
                $bdd = new PDO('mysql:host='. $host .';dbname='. $base, $login, $pass);
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                die('Erreur : '. $e->getMessage());
            }

            return $bdd;
        }
    }