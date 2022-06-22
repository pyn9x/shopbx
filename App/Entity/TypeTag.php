<?php

namespace App\Entity;

class TypeTag
{

	private $id;
	private $name;
	private $tagsBelong;
	private $typeTagBindTag;
	private $dateCreate;
	private $dateUpdate;

	/**
	 * @param int $id
	 * @param string $name
	 * @param array $tagsBelong
	 * @param int $typeTagBindTag
	 * @param string $dateCreate
	 * @param string $dateUpdate
	 */
	public function __construct($id, $name, $tagsBelong, $dateCreate, $dateUpdate)
	{
		$this->id = $id;
		$this->name = $name;
		$this->tagsBelong = $tagsBelong;
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
	 * @return array
	 */
	public function getTagsBelong(): array
	{
		return $this->tagsBelong;
	}

	/**
	 * @param array $tagsBelong
	 */
	public function setTagsBelong(array $tagsBelong): void
	{
		$this->tagsBelong = $tagsBelong;
	}

	/**
	 * @return int
	 */
	public function getTypeTagBindTag(): int
	{
		return $this->typeTagBindTag;
	}

	/**
	 * @param int $typeTagBindTag
	 */
	public function setTypeTagBindTag(int $typeTagBindTag): void
	{
		$this->typeTagBindTag = $typeTagBindTag;
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