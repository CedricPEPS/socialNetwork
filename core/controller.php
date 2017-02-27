<?php

	class Controller {

		public function loadClass ($name) {

			require('models/'.$name.'.class.php');

		}

	}