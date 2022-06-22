<?php

namespace App\Service;

use App\Entity\User;
use App\Lib\UserDBQuery;
use mysqli;

/**
 * Класс содержит методы получения/изменения информации в БД об экскурсиях
 *
 * Методы сервиса названы в соответствие с запросами к БД:
 *
 * SELECT - get,
 * INSERT - create,
 * UPDATE - set,
 * DELETE - delete
 */

class UserService
{

	/**
	 * Создает и возвращает сущность User с параметрами,
	 * полученными из БД
	 *
	 * @param \mysqli_result $userData
	 * @return User
	 */
	public static function parseUserForAdminPage(\mysqli_result $userData) : User
	{
		$user = mysqli_fetch_assoc($userData);

		return
			new User(
				$user['id'],
				$user['login'],
				$user['password'],
				$user['userHash'],
				$user['email'],
				$user['isAdmin'],
				$user['dateCreate'],
				$user['dateUpdate']
			);
	}

	/**
	 * Возвращает сущность User с логином $login
	 *
	 * @param mysqli $db
	 * @param string $login
	 * @return User
	 */
	public static function getUserByLogin(mysqli $db, string $login): User
	{
		$query = UserDBQuery::getUserByLogin();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "s", $login);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseUserForAdminPage($result);
	}

	/**
	 * Возвращает сущность User с соответствующим $id
	 *
	 * @param mysqli $db
	 * @param int $userId
	 * @return User
	 */
	public static function getUserById(mysqli $db, int $userId): User
	{
		$query = UserDBQuery::getUserById();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "i", $userId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		return self::parseUserForAdminPage($result);
	}

	/**
	 * Возвращает сущность User с соответствующим $hash
	 *
	 * @param mysqli $db
	 * @param string $hash
	 * @return User
	 */
	public static function getUserByHash(mysqli $db, string $hash): User
	{
		$query = UserDBQuery::getUserByHash();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "s", $hash);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseUserForAdminPage($result);
	}

	/**
	 * Устанавливает $userHash у пользователя с введенным $id
	 *
	 * @param mysqli $db
	 * @param int $userId
	 * @param string $userHash
	 * @return void
	 */
	public static function setUserHash(mysqli $db, int $userId, string $userHash): void
	{
		$query = UserDBQuery::setUserHash();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "si", $userHash, $userId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Устанавливает $password у пользователя с введенным $id
	 *
	 * @param mysqli $db
	 * @param int $userId
	 * @param string $password
	 * @return void
	 */
	public static function setPassword(mysqli $db, int $userId, string $password): void
	{
		$query = UserDBQuery::setPassword();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "si", $password, $userId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}
}