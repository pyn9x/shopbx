<?php

namespace App\Lib;

use App\Config\Database;
use App\Config\Settings;
use App\Controller\MainController;
use App\Controller\MessageController;
use App\Database\Migration;
use App\Exception\NoConnectionToDataBaseException;
use App\Exception\PathNotFoundEcxeption;
use Exception;
use App\Logger\Logger;

class Application
{
	/**
	 * @throws Exception
	 */
	public static function run(): ?Response
	{
		$settings = Settings::getInstance();
		$database = Database::getInstance();
		$logger = new Logger();



		try
		{
			$database->connect();
			$logger->info('Подключение к серверу прошло успешно');
		}
		catch (NoConnectionToDataBaseException $exception)
		{
			#Починить
			$logger->error('Не удалось подключиться к серверу',[ 'exception' => $exception->getMessage() ]);
			return Response::error(404,"not found");

		}

		if ($settings->isDev())
		{
			$migration = new Migration(Database::getDatabase());
			$migration->up();
		}


		try
		{
			$route =  Router::route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
		}
		catch (PathNotFoundEcxeption $e)
		{
			MessageController::showErrorPage();

			return Response::text(MessageController::showErrorPage());
		}



		return $route;
	}
}