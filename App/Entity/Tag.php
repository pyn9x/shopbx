<?php

namespace App\Entity;

class Tag
{

	private $id;
	private $name;
	private $typeTag;
	private $tagBindProduct;
	private $dateCreate;
	private $dateUpdate;

	/**
	 * @param int $id
	 * @param string $name
	 * @param int $typeTag
	 * @param int $tagBindProduct
	 * @param string $dateCreate
	 * @param string $dateUpdate
	 */
	public function __construct($id, $name, $typeTag, $dateCreate, $dateUpdate)
	{
		$this->id = $id;
		$this->name = $name;
		$this->typeTag = $typeTag;
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
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}

	/**
	 * @return int
	 */
	public function getTypeTag(): int
	{
		return $this->typeTag;
	}

	/**
	 * @param int $typeTag
	 */
	public function setTypeTag(int $typeTag): void
	{
		$this->typeTag = $typeTag;
	}

	/**
	 * @return int
	 */
	public function getTagBindProduct(): int
	{
		return $this->tagBindProduct;
	}

	/**
	 * @param int $tagBindProduct
	 */
	public function setTagBindProduct(int $tagBindProduct): void
	{
		$this->tagBindProduct = $tagBindProduct;
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