<?php
	include_once('twig/lib/Twig/Autoloader.php');

    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates'); // Dossier contenant les templates

    $twig = new Twig_Environment($loader, array(	//initialisation ou non(false) du cache
      'cache' => false
    ));

	$tpl = $twig->loadTemplate('index.twig');
	
	echo $tpl->render(array(
        'title' => 'Twig example',
		'exemple' => 'test',
		'online' => 1
    ));

	
