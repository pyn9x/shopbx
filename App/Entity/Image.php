<?php

namespace App\Entity;

class Image
{
	private $id;
	private $path;
	private $main;
	private $imageBindProduct;
	private $dateCreate;
	private $dateUpdate;

	/**
	 * @param int $id
	 * @param string $path
	 * @param bool $main
	 * @param int $imageBindProduct
	 * @param string $dateCreate
	 * @param string $dateUpdate
	 */
	public function __construct($id, $path, $main, $imageBindProduct, $dateCreate, $dateUpdate)
	{
		$this->id = $id;
		$this->path = $path;
		$this->main = $main;
		$this->imageBindProduct = $imageBindProduct;
		$this->dateCreate = $dateCreate;
		$this->dateUpdate = $dateUpdate;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @param string $path
	 */
	public function setPath($path)
	{
		$this->path = $path;
	}

	/**
	 * @return bool
	 */
	public function isMain()
	{
		return $this->main;
	}

	/**
	 * @param bool $main
	 */
	public function setMain($main)
	{
		$this->main = $main;
	}

	/**
	 * @return int
	 */
	public function getImageBindProduct()
	{
		return $this->imageBindProduct;
	}

	/**
	 * @param int $imageBindProduct
	 */
	public function setImageBindProduct($imageBindProduct)
	{
		$this->imageBindProduct = $imageBindProduct;
	}

	/**
	 * @return string
	 */
	public function getDateCreate()
	{
		return $this->dateCreate;
	}

	/**
	 * @param string $dateCreate
	 */
	public function setDateCreate($dateCreate)
	{
		$this->dateCreate = $dateCreate;
	}

	/**
	 * @return string
	 */
	public function getDateUpdate()
	{
		return $this->dateUpdate;
	}

	/**
	 * @param string $dateUpdate
	 */
	public function setDateUpdate($dateUpdate)
	{
		$this->dateUpdate = $dateUpdate;
	}
}