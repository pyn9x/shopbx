<?php

namespace App\Entity;

class User
{

	private $id;
	private $login;
	private $password;
	private $userHash;
	private $email;
	private $isAdmin;
	private $dateCreate;
	private $dateUpdate;

	/**
	 * @param int $id
	 * @param string $login
	 * @param string $password
	 * @param string $userHash
	 * @param string $email
	 * @param string $isAdmin
	 * @param string $dateCreate
	 * @param string $dateUpdate
	 */

	public function __construct($id, $login, $password, $userHash, $email, $isAdmin, $dateCreate, $dateUpdate)
	{
		$this->id = $id;
		$this->login = $login;
		$this->password = $password;
		$this->userHash = $userHash;
		$this->email = $email;
		$this->isAdmin = $isAdmin;
		$this->dateCreate = $dateCreate;
		$this->dateUpdate = $dateUpdate;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id): void
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getLogin()
	{
		return $this->login;
	}

	/**
	 * @param mixed $login
	 */
	public function setLogin($login): void
	{
		$this->login = $login;
	}

	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword($password): void
	{
		$this->password = $password;
	}

	/**
	 * @return mixed
	 */
	public function getUserHash()
	{
		return $this->userHash;
	}

	/**
	 * @param mixed $userHash
	 */
	public function setUserHash($userHash): void
	{
		$this->userHash = $userHash;
	}

	/**
	 * @return mixed
	 */

	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email): void
	{
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getIsAdmin()
	{
		return $this->isAdmin;
	}

	/**
	 * @param mixed $isAdmin
	 */
	public function setIsAdmin($isAdmin): void
	{
		$this->isAdmin = $isAdmin;
	}

	/**
	 * @return mixed
	 */
	public function getDateCreate()
	{
		return $this->dateCreate;
	}

	/**
	 * @param mixed $dateCreate
	 */
	public function setDateCreate($dateCreate): void
	{
		$this->dateCreate = $dateCreate;
	}

	/**
	 * @return mixed
	 */
	public function getDateUpdate()
	{
		return $this->dateUpdate;
	}

	/**
	 * @param mixed $dateUpdate
	 */
	public function setDateUpdate($dateUpdate): void
	{
		$this->dateUpdate = $dateUpdate;
	}

}