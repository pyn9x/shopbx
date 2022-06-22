<?php

namespace App\Entity;

class Order
{
	private $id;
	private $fio;
	private $email;
	private $phone;
	private $dateOrder;
	private $comment;
	private $statusId;
	private $dateId;
	private $dateCreate;
	private $dateUpdate;
	private $status;
	private $excursionName;
	private $dateTravel;

	/**
	 * @return string
	 */
	public function getDateTravel(): string
	{
		return $this->dateTravel;
	}

	/**
	 * @param string $dateTravel
	 */
	public function setDateTravel(string $dateTravel): void
	{
		$this->dateTravel = $dateTravel;
	}

	/**
	 * @return string
	 */
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * @param string $status
	 */
	public function setStatus(string $status): void
	{
		$this->status = $status;
	}

	/**
	 * @return string
	 */
	public function getExcursionName(): string
	{
		return $this->excursionName;
	}

	/**
	 * @param string $excursionName
	 */
	public function setExcursionName(string $excursionName): void
	{
		$this->excursionName = $excursionName;
	}

	/**
	 * @param int $id
	 * @param string $fio
	 * @param string $email
	 * @param string $phone
	 * @param string $dateOrder
	 * @param string $comment
	 * @param int $statusId
	 * @param int $productId
	 * @param string $dateCreate
	 * @param string $dateUpdate
	 */

	public function __construct(
		int $id,
		string $fio, string $email, string $phone,
		string $dateOrder, string $comment,
		int $statusId, int $dateId,
		string $dateCreate, string $dateUpdate
	)
	{
		$this->id = $id;
		$this->fio = $fio;
		$this->email = $email;
		$this->phone = $phone;
		$this->dateOrder = $dateOrder;
		$this->comment = $comment;
		$this->statusId = $statusId;
		$this->dateId = $dateId;
		$this->dateCreate = $dateCreate;
		$this->dateUpdate = $dateUpdate;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id): void
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getFio(): string
	{
		return $this->fio;
	}

	/**
	 * @param string $fio
	 */
	public function setFio(string $fio): void
	{
		$this->fio = $fio;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getPhone(): string
	{
		return $this->phone;
	}

	/**
	 * @param string $phone
	 */
	public function setPhone(string $phone): void
	{
		$this->phone = $phone;
	}

	/**
	 * @return string
	 */
	public function getDateOrder(): string
	{
		return $this->dateOrder;
	}

	/**
	 * @param string $dateOrder
	 */
	public function setDateOrder(string $dateOrder): void
	{
		$this->dateOrder = $dateOrder;
	}

	/**
	 * @return string
	 */
	public function getComment(): string
	{
		return $this->comment;
	}

	/**
	 * @param string $comment
	 */
	public function setComment(string $comment): void
	{
		$this->comment = $comment;
	}

	/**
	 * @return int
	 */
	public function getStatusId(): int
	{
		return $this->statusId;
	}

	/**
	 * @param int $statusId
	 */
	public function setStatusId(int $statusId): void
	{
		$this->statusId = $statusId;
	}

	/**
	 * @return int
	 */
	public function getDatetId(): int
	{
		return $this->dateId;
	}

	/**
	 * @param int $dateId
	 */
	public function setProductId(int $dateId): void
	{
		$this->dateId = $dateId;
	}

	/**
	 * @return string
	 */
	public function getDateCreate(): string
	{
		return $this->dateCreate;
	}

	/**
	 * @param string $dateCreate
	 */
	public function setDateCreate(string $dateCreate): void
	{
		$this->dateCreate = $dateCreate;
	}

	/**
	 * @return string
	 */
	public function getDateUpdate(): string
	{
		return $this->dateUpdate;
	}

	/**
	 * @param string $dateUpdate
	 */
	public function setDateUpdate(string $dateUpdate): void
	{
		$this->dateUpdate = $dateUpdate;
	}
}