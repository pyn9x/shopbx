<?php

namespace App\Controller;

use App\Service\UserService;
use App\Config\Database;
use App\Lib\Helper;
use App\Service\ExcursionService;
use App\Lib\Render;

class UserController
{

	public static function loginUser(): string
	{
		return Render::renderContent("login", []);
	}

	public static function logOutUser(): string
	{
		session_start();
		$_SESSION = [];
		session_destroy();
		$excursions = ExcursionService::getTopExcursions(Database::getDatabase());
		return Render::render("content-top-excursions", "layout", ['excursions' => $excursions]);
	}

	public static function adminPanel(): string
	{
		if (self::isAuthorized() === true)
		{
			return Render::renderContent("admin", []);
		}
		else
		{
			return Render::renderContent("login", []);
		}
	}

	public static function isAuthorized(): bool
	{
		session_start();
		if (!isset($_SESSION['userHash']))
		{
			return false;
		}
		else
		{
			$user = UserService::getUserByHash(Database::getDatabase(), $_SESSION['userHash']);
			if ($_SESSION['userHash'] === $user->getUserHash())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	public static function Authorized(): string
	{
		$validateLogin = $_POST['login'];
		$validatePassword = $_POST['password'];

		$validateLogin = mysqli_real_escape_string(Database::getDatabase(), $validateLogin);

		$user = UserService::getUserByLogin(Database::getDatabase(), $validateLogin);
		if (!isset($user))
		{
			return Render::renderContent('login');
		}
		else
		{
			$isCorrectPassword = password_verify($validatePassword, $user->getPassword());
			if (!$isCorrectPassword)
			{
				return Render::renderContent('login');
			}
			else
			{
				$userHash = Helper::generateUserHash();
				UserService::setUserHash(Database::getDatabase(), $user->getId(), $userHash);
				Helper::setAuthorized($user->getId(), $userHash);
				return ExcursionController::showAdminExcursionList();
			}
		}
	}

	public static function showUserAction()
	{
		if (!self::isAuthorized())
		{
			header("Location: " . Helper::getUrl() . "/login");
		}
		else
		{
			$content = Render::renderContent("admin-user-change");
			return Render::renderLayout($content,"admin");
		}
	}

	public static function changeUserPasswordAction()
	{
		if (!self::isAuthorized())
		{
			header("Location: " . Helper::getUrl() . "/login");
		}
		else
		{
			$csrf_token = $_POST['csrf_token'];
			$currentPassword = $_POST['currentPassword'];
			$newPassword = $_POST['newPassword'];
			$repeatNewPassword = $_POST['repeatNewPassword'];
			session_start();
			if (!Helper::getCsrfToken() === $csrf_token)
			{
				return "csrf_token не совпадает";
			}
			$user = UserService::getUserById(Database::getDatabase(), Helper::getCurrentUserId());
			$isCorrectPassword = password_verify($currentPassword, $user->getPassword());
			if (!($isCorrectPassword))
			{
				return "Текущий пароль не верный";
			}
			if (!($newPassword===$repeatNewPassword))
			{
				return "Введеные пароли не совпадают";
			}
			UserService::setPassword(Database::getDatabase(), Helper::getCurrentUserId(),  Helper::getPasswordHash($newPassword));
			return "Пароль успешно сохранен";
		}
	}

}