<?php

namespace App\Service;

use App\Config\Settings;
use App\Entity\Excursion;
use App\Lib\Helper;
use App\Logger\Logger;
use mysqli;
use App\Lib\ExcursionDBQuery;

/**
 * Класс содержит методы получения/изменения информации в БД об экскурсиях
 *
 * Методы сервиса названы в соответствие с запросами к БД:
 *
 * SELECT - get,
 * INSERT - add / create,
 * UPDATE - edit,
 * DELETE - delete
 */

class ExcursionService
{
	/**
	 * Метод формирует массив экскурсий по данным, полученным
	 * из БД, для вывода на главную страницу публичной части
	 *
	 * @param \mysqli_result $excursionsFromDB массив экскурсий из БД
	 * @return array
	 */
	private static function parseExcursionsForPublicPage(\mysqli_result $excursionsFromDB) : array
	{
		$excursions = [];

		while ($excursion = mysqli_fetch_assoc($excursionsFromDB))
		{
			$excursions[] = new Excursion(
				$excursion['id'],
				Helper::replacementNullValueMysql($excursion['nameCity']),
				Helper::replacementNullValueMysql($excursion['nameCountry']),
				Helper::replacementNullValueMysql($excursion['dateTravel']),
				Helper::replacementNullValueMysql($excursion['price']),
				'',
				Helper::replacementNullValueMysql($excursion['internetRating']),
				Helper::replacementNullValueMysql($excursion['entertainmentRating']),
				Helper::replacementNullValueMysql($excursion['serviceRating']),
				Helper::replacementNullValueMysql($excursion['rating']),
				Helper::replacementNullValueMysql($excursion['degrees']),
				Helper::replacementNullValueMysql($excursion['active']),
				Helper::replacementNullValueMysql($excursion['imageList']),
				'',
				''
			);
		}

		return $excursions;
	}

	/**
	 * Метод формирует массив экскурсий по данным, полученным
	 * из БД, для вывода на главную страницу админской части
	 *
	 * @param mysqli $db
	 * @param \mysqli_result $excursionsFromDB массив экскурсий из БД
	 * @return array
	 */
	private static function parseExcursionsForAdminHomePage(mysqli $db,\mysqli_result $excursionsFromDB) : array
	{
		$excursions = [];

		while ($excursion = mysqli_fetch_assoc($excursionsFromDB))
		{
			$excursions[] = new Excursion(
				$excursion['id'],
				$excursion['nameCity'],
				'',
				'',
				$excursion['price'],
				'',
				0,
				0,
				0,
				0,
				0,
				1,
				0,
				'',
				''
			);
			$excursions[count($excursions)-1]->
			setExcursionOccupancyByDateTravel(self::getExcursionDatesOccupancyListById($db, $excursion['id']));
			$excursions[count($excursions)-1]->setCountPersons($excursion['countPersons']);
		}

		return $excursions;
	}

	/**
	 * Метод формирует массив экскурсий по данным, полученным
	 * из БД, для вывода на детальную страницу публичной части
	 *
	 * @param \mysqli_result $excursionFromDB массив полей экскурсии из БД
	 * @return Excursion
	 */
	private static function parseExcursionsForDetailedPage(\mysqli_result $excursionFromDB) : Excursion
	{
		$excursion = mysqli_fetch_assoc($excursionFromDB);

		$result_excursion = new Excursion(
			$excursion['id'],
			Helper::replacementNullValueMysql($excursion['nameCity']),
			Helper::replacementNullValueMysql($excursion['nameCountry']),
			Helper::replacementNullValueMysql($excursion['dateTravel']),
			Helper::replacementNullValueMysql($excursion['price']),
			Helper::replacementNullValueMysql($excursion['full_description']),
			0,
			0,
			0,
			Helper::replacementNullValueMysql($excursion['rating']),
			0,
			Helper::replacementNullValueMysql($excursion['active']),
			Helper::replacementNullValueMysql($excursion['imageList']),
			'',
			''
		);

		$result_excursion->setTagList(explode(',', $excursion['tagList']));
		$result_excursion->setDuration($excursion['duration']);
		$result_excursion->setCountPersons($excursion['countPersons']);
		$result_excursion->setAllPossibleDatesTravel(explode(',', $excursion['allPossibleDatesTravel']));
		$result_excursion->setAttractionList(explode(',', $excursion['attractionList']));

		return $result_excursion;
	}

	/**
	 * Метод возвращает массив из сущностей Excursion, состоящий из
	 * первых 8 экскурсий, отсортированных по параметру rating
	 *
	 * @param mysqli $db
	 * @return array
	 */
	public static function getTopExcursions(mysqli $db): array
	{
		$query = ExcursionDBQuery::getTopExcursionsQuery();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForPublicPage($result);
	}

	/**
	 * Метод возвращает массив из сущностей Excursion для главной страницы публичной части
	 *
	 * @param mysqli $db
	 * @return array
	 */
	public static function getExcursionsForPublicPage(mysqli $db): array
	{
		$query = ExcursionDBQuery::getExcursionsForPublicPage();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForPublicPage($result);
	}

	/**
	 * Метод возвращает Excursion с соответствующим id
	 *
	 * @param mysqli $db
	 * @param int $id id нужной экскурсии
	 * @return Excursion
	 */
	public static function getExcursionById(mysqli $db, int $id) : Excursion
	{
		$query = ExcursionDBQuery::getExcursionByIdQuery();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ii", $id, $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForDetailedPage($result);
	}

	/**
	 * Метод возвращает массив из сущностей Excursion для главной страницы админской части
	 *
	 * @param mysqli $db
	 * @return array
	 */
	public static function getExcursionsForAdminHomePage(mysqli $db) : array
	{
		$query = ExcursionDBQuery::getExcursionsForAdminPage();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForAdminHomePage($db, $result);
	}

	/**
	 * Метод возвращает Excursion для детальной страницы публичной части
	 *
	 * @param mysqli $db
	 * @param int $id id нужной экскурсии
	 * @return Excursion
	 */
	public static function getExcursionForAdminDetailedPage(mysqli $db, int $id) : Excursion
	{
		$query = ExcursionDBQuery::getExcursionForAdminDetailedPage();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i", $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$excursion = mysqli_fetch_assoc($result);

		$result_excursion = new Excursion(
			$excursion['id'],
			$excursion['nameCity'],
			$excursion['nameCountry'],
			'',
			$excursion['price'],
			$excursion['fullDescription'],
			$excursion['internetRating'],
			$excursion['entertainmentRating'],
			$excursion['serviceRating'],
			$excursion['rating'],
			$excursion['degrees'],
			$excursion['active'],
			$excursion['imageList'],
			'',
			''
		);

		$result_excursion->setDuration($excursion['duration']);
		$result_excursion->setCountPersons($excursion['countPersons']);
		$result_excursion->setTagList(explode(',', $excursion['tagList']));

		return $result_excursion;
	}

	/**
	 * Метод возвращает массив Excursion для главной страницы админской части,
	 * содержащих в nameCity или nameCountry введенную пользоваетелем строку
	 *
	 * @param mysqli $db
	 * @param string $name поисковая строка
	 * @return array
	 */
	public static function getExcursionsForAdminPageByName(mysqli $db, string $name) : array
	{
		$query = ExcursionDBQuery::findExcursionByNameForAdminPage();

		$name = mysqli_real_escape_string($db, $name);
		$name = "%" . $name . "%";
		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ss", $name, $name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		return self::parseExcursionsForAdminHomePage($db, $result);
	}

	/**
	 * Метод возвращает массив Excursion для главной страницы публичной части,
	 * содержащих в nameCity или nameCountry введенную пользоваетелем строку
	 *
	 * @param mysqli $db
	 * @param string $name поисковая строка
	 * @return array
	 */
	public static function getExcursionsForPublicPageByName(mysqli $db, string $name) : array
	{
		$query = ExcursionDBQuery::findExcursionByNameForPublicPage();

		$name = mysqli_real_escape_string($db, $name);
		$name = "%" . $name . "%";
		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ss", $name, $name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		return self::parseExcursionsForPublicPage($result);
	}

	/**
	 * Метод возвращает массив из сущностей Excursion для главной
	 * страницы публичной части, отсортированных по sortType
	 *
	 * @param mysqli $db
	 * @param array $excursions экскурсии, которые необходимо отсортировать
	 * @param int $sortType соответсвует параметрам [order_types_excursions] в config.ini
	 * @return array
	 */
	public static function getExcursionsForPublicPageSortedByType(mysqli $db, array $excursions, int $sortType) : array
	{
		$settings = Settings::getInstance();
		$sortTypes = $settings->getSortTypes();

		$idList = [];
		foreach($excursions as $excursion)
		{
			$idList[] = $excursion->getId();
		}

		$idList = implode(',', $idList);

		$query = "";
		switch ($sortType)
		{
		case $sortTypes['order_excursions_by_price_asc']:
			$query = ExcursionDBQuery::sortExcursionsByPriceAscQuery();
			break;
		case $sortTypes['order_excursions_by_price_desc']:
			$query = ExcursionDBQuery::sortExcursionsByPriceDescQuery();
			break;
		case $sortTypes['order_excursions_by_rating_desc']:
			$query = ExcursionDBQuery::sortExcursionsByRatingDescQuery();
			break;
		}

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "s", $idList);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForPublicPage($result);
	}

	/**
	 * Метод возвращает массив из сущностей Excursion для главной
	 * страницы публичной части, имеющих тэги из массива $tagList
	 *
	 * @param mysqli $db
	 * @param array $tagList массив id тэгов, среди которых будет осуществляться поис
	 * @return array
	 */
	public static function getExcursionsByTag(mysqli $db, array $tagList) : array
	{
		$tags = TagService::organizeTagIdList($db, $tagList);
		$tagsCount = count($tags) / 2;

		$query = ExcursionDBQuery::getExcursionsByTagFullQuery($tagsCount);

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, str_repeat("si", $tagsCount), ...$tags);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseExcursionsForPublicPage($result);
	}

	/**
	 * Возвращает массив заполненности экскурсий по датам в формате
	 * 'id' => id даты
	 * 'dateTravel' => дата в строковом формате
	 * 'orderedExcursionsCount' => число заказанных экскурсий в статусе "В работе"
	 *
	 * @param mysqli $db
	 * @param int $id id экскурсии
	 * @return array
	 */
	private static function getExcursionDatesOccupancyListById(mysqli $db, int $excursionId) : array
	{
		$query = ExcursionDBQuery::getExcursionCompletionByDateById();
		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i",$excursionId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$occupancyList = [];
		while ($occupancy = mysqli_fetch_assoc($result))
		{
			$occupancyList[] =[
				'id' => $occupancy['id'],
				'dateTravel' => $occupancy['dateTravel'],
				'orderedExcursionsCount' => $occupancy['orderedExcursionsCount']
			];
		}

		return $occupancyList;
	}

	/**
	 * Записывает Excursion в БД
	 *
	 * @param mysqli $db
	 * @param Excursion $excursion
	 * @return int
	 */
	public static function createExcursion(mysqli $db, Excursion $excursion) : int
	{
		$query = ExcursionDBQuery::addNewExcursion();

		$nameCity = $excursion->getNameCity();
		$nameCountry =$excursion->getNameCountry();
		$duration = $excursion->getDuration();
		$countPerson = $excursion->getCountPersons();
		$price = $excursion->getPrice();
		$fullDescription = $excursion->getFullDescription();
		$internetRating = $excursion->getInternetRating();
		$entertainmentRating = $excursion->getEntertainmentRating();
		$serviceRating = $excursion->getServiceRating();
		$rating = $excursion->getRating();
		$degree = $excursion->getDegrees();
		$active = $excursion->getActive();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ssiiisddddii",
									$nameCity,
									$nameCountry,
									$duration,
									$countPerson,
									$price,
									$fullDescription,
									$internetRating,
									$entertainmentRating,
									$serviceRating,
									$rating,
									$degree,
									$active
		);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return mysqli_insert_id($db);
	}

	/**
	 * Привязывает тэги к Excursion в БД
	 *
	 * @param mysqli $db
	 * @param Excursion $excursion
	 * @return void
	 */
	public static function createProductBelongTags(mysqli $db, Excursion $excursion): void
	{
		foreach ($excursion->getTagList() as $tag)
		{
			$query = ExcursionDBQuery::addProductBelongTags();

			$stmt = mysqli_prepare($db, $query);
			$id = $excursion->getId();
			mysqli_stmt_bind_param($stmt, "ii", $id, $tag);

			$result = mysqli_stmt_execute($stmt);

			if (!$result)
			{
				trigger_error(mysqli_error($db), E_USER_ERROR);
			}
		}
	}

	/**
	 * Перезаписывает Excursion в БД с новыми полями
	 *
	 * @param mysqli $db
	 * @param Excursion $excursion
	 * @return void
	 */
	public static function editExcursionById(mysqli $db, Excursion $excursion) : void
	{
		$query = ExcursionDBQuery::updateExcursionById();

		$nameCity = $excursion->getNameCity();
		$nameCountry =$excursion->getNameCountry();
		$price = $excursion->getPrice();
		$duration = $excursion->getDuration();
		$id = $excursion->getId();
		$countPerson = $excursion->getCountPersons();
		$fullDescription = mysqli_real_escape_string($db, $excursion->getFullDescription());
		$internetRating = $excursion->getInternetRating();
		$entertainmentRating = $excursion->getEntertainmentRating();
		$serviceRating = $excursion->getServiceRating();
		$rating = $excursion->getRating();
		$degree = $excursion->getDegrees();
		$active = $excursion->getActive();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ssiddddiisiii",
								$nameCity,
								$nameCountry,
								$price,
								$internetRating,
								$entertainmentRating,
								$serviceRating,
								$rating,
								$degree,
								$active,
								$fullDescription,
								$duration,
								$countPerson,
								$id
		);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Удаляет Excursion из БД по id
	 *
	 * @param mysqli $db
	 * @param int $id id экскурсии
	 * @return void
	 */
	public static function deleteExcursionById(mysqli $db, int $id) : void
	{
		$query = ExcursionDBQuery::deleteExcursionById();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i",$id);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Привязывает новую дату к экскурсии по excursionId
	 *
	 * @param mysqli $db
	 * @param int $excursionId
	 * @param string $date
	 * @return void
	 */
	public static function addDateToExcursionById(mysqli $db, int $excursionId, string $date) : void
	{
		self::createNewDate($db, $date);
		self::createNewDateRelation($db, $excursionId);

	}

	/**
	 * Записывает новую дату в БД
	 *
	 * @param mysqli $db
	 * @param string $date
	 * @return void
	 */
	private static function createNewDate(mysqli $db, string $date) : void
	{
		$query = ExcursionDBQuery::addNewDate();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"s",$date);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Добавляет связь экскурсии, имеющей id, и ПОСЛЕДНЕЙ ЗАПИСАННОЙ датой
	 *
	 * @param mysqli $db
	 * @param int $id id экскурсии
	 * @return void
	 */
	private static function createNewDateRelation(mysqli $db, int $id) : void
	{
		$query = ExcursionDBQuery::addNewDateRelations();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i",$id);
		$result = mysqli_stmt_execute($stmt);
		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Удаляет ВСЕ тэги, привязанные к Excursion
	 *
	 * @param mysqli $db
	 * @param Excursion $excursion
	 * @return void
	 */
	public static function deleteProductBelongTags(mysqli $db, Excursion $excursion): void
	{
		$query = ExcursionDBQuery::deleteProductBelongTags();

		$stmt = mysqli_prepare($db, $query);
		$id = $excursion->getId();
		mysqli_stmt_bind_param($stmt,"i",$id);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Удаляет связь даты с экскурсией и саму дату из БД
	 *
	 * @param mysqli $db
	 * @param int $dateId
	 * @return void
	 */
	public static function deleteDateById(mysqli $db, int $dateId) : void
	{
		$query = ExcursionDBQuery::deleteDateById();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"ii",$dateId, $dateId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

}