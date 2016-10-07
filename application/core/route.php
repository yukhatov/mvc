<?php

class Route
{
	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'feedback';
		$action_name = 'index';
		$routes = array();

		if(isset($_GET['route']))
		{
			$routes = explode('/', $_GET['route']);

			// получаем имя контроллера
			if ( !empty($routes[0]) )
			{	
				$controller_name = $routes[0];
			}
			
			// получаем имя экшена
			if ( !empty($routes[1]) )
			{
				$action_name = $routes[1];
			}
		}

		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		/*echo "Model: $model_name <br>";
		echo "Controller: $controller_name <br>";
		echo "Action: $action_name <br>";*/
		
		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			include "application/models/".$model_file;
		}

		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;

		if(file_exists($controller_path))
		{
			include "application/controllers/".$controller_file;
		}
		else
		{
			Route::ErrorPage404();
		}
		
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			$controller->$action();
		}
		else
		{
			Route::ErrorPage404();
		}
	}

	function ErrorPage404()
	{
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location: index.php?route=404');
    }
    
}
