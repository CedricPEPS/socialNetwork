<?php

	class wall extends Controller {

		function index() {

			header('Location: friend');
		}

		function profile() {
			require('core/utils.php');
			
			Controller::loadClass('user');
			Controller::loadClass('articles');

			$params = explode('/', $_GET['p']);
			$pseudo = $params[2];

			$user = log::getUserByPseudo($pseudo);

			$articles = articles::getArticles($user["id"]);

			$i = 0;

			while ($i < count($articles) && $articles != false) {

				$articles[$i]['date'] = time_elapsed_string($articles[$i]['date']);

				$i++;
			}

			$data = array(
				'title' => 'Wall '. $pseudo,
				'asset' => ASSET,
				'root' => ROOT, 
				'online' => true,
				'articles' => $articles,
				'pseudo' => $pseudo
			);
		
			return $data;
		}

	}