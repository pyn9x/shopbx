<?php

namespace App\Lib;

class UserDBQuery
{
	public static function getUserByLogin() : string
	{
		return "
			SELECT
				ID as 'id',
				LOGIN as 'login',
				PASSWORD as 'password',
				USER_HASH as 'userHash',
				EMAIL as 'email',
				ISADMIN as 'isAdmin',
				DATE_CREATE as 'dateCreate',
				DATE_UPDATE as 'dateUpdate'
			FROM up_user WHERE LOGIN = ?
			LIMIT 1
		";
	}

	public static function getUserById() : string
	{
		return "
			SELECT
				ID as 'id',
				LOGIN as 'login',
				PASSWORD as 'password',
				USER_HASH as 'userHash',
				EMAIL as 'email',
				ISADMIN as 'isAdmin',
				DATE_CREATE as 'dateCreate',
				DATE_UPDATE as 'dateUpdate'
			FROM up_user WHERE ID = ? 
			LIMIT 1
		";
	}

	public static function getUserByHash() : string
	{
		return "
			SELECT
				ID as 'id',
				LOGIN as 'login',
				PASSWORD as 'password',
				USER_HASH as 'userHash',
				EMAIL as 'email',
				ISADMIN as 'isAdmin',
				DATE_CREATE as 'dateCreate',
				DATE_UPDATE as 'dateUpdate'
			FROM up_user WHERE USER_HASH = ?
			LIMIT 1
		";
	}

	public static function setUserHash() : string
	{
		return "
			UPDATE up_user 
			SET 
				USER_HASH = ? 
			WHERE ID = ?;
		";
	}

	public static function setPassword() : string
	{
		return "
			UPDATE up_user 
			SET 
				PASSWORD = ?
			WHERE ID = ?;
		";
	}
}