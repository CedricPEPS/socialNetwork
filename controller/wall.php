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

			$listId = log::getListFriend($_SESSION['id']);

			if (count($listId["friend"]) > 0) {
				$i = 0;

				while ($i < count($listId["friend"])) {
					if ($listId["friend"][$i]["friend_id"] == $_SESSION['id']) {
						$list[] = ["list" => log::getUserById($listId["friend"][$i]['user_id'])];;
					} else {
						$list[] = ["list" => log::getUserById($listId["friend"][$i]['friend_id'])];
					}

					if ($pseudo == $list[$i]['list']['pseudo']) {
						$isFriend = "true";
						break;
					} else {
						$isFriend = "false";
					}

					$i++;
				}
			}

			if ($isFriend) {
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
			} else {
				
				$data = array(
					'title' => 'Wall '. $pseudo,
					'asset' => ASSET,
					'root' => ROOT, 
					'online' => true,
					'articles' => $articles,
					'pseudo' => $pseudo
				);
			}
		
			return $data;
		}

	}
