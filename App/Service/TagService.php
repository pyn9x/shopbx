<?php

namespace App\Service;

use App\Entity\Tag;
use App\Entity\TypeTag;
use App\Lib\TagDBQuery;
use mysqli;

/**
 * Класс содержит методы получения/изменения информации в БД об экскурсиях
 *
 * Методы сервиса названы в соответствие с запросами к БД:
 *
 * SELECT - get,
 * INSERT - create,
 * UPDATE - edit,
 * DELETE - delete
 */

class TagService
{
	/**
	 * Получение массива сущностей Tag из БД, имеющих заданный тип $typeTag
	 *
	 * @param mysqli $db
	 * @param int $typeTag
	 * @return array
	 */
	public static function getTagsForAdminPage(mysqli $db, int $typeTag) : array
	{
		$query = TagDBQuery::getTagsForAdminPage();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "i", $typeTag);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$tags = [];
		while ($tag = mysqli_fetch_assoc($result))
		{
			$currentTag = new Tag(
				$tag['tagId'],
				$tag['tagName'],
				$typeTag,
				null,
				null
			);
			$currentTag->setTagBindProduct($tag['tagBindProduct']);
			$tags[] = $currentTag;
		}

		return $tags;
	}

	/**
	 * Получение массива сущностей TypeTag из БД
	 *
	 * @param mysqli $db
	 * @return array
	 */
	public static function getTypeTagsForAdminPage(mysqli $db) : array
	{
		$query = TagDBQuery::getTypeTagsForAdminPage();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$typeTags = [];
		while ($typeTag = mysqli_fetch_assoc($result))
		{
			$currentTypeTags = new TypeTag(
				$typeTag['id'],
				$typeTag['name'],
				null,
				null,
				null
			);
			$currentTypeTags->setTypeTagBindTag($typeTag['typeTagBindTag']);
			$typeTags [] = $currentTypeTags;
		}

		return $typeTags;
	}

	/**
	 * Удаление тэга из БД по $tagId
	 *
	 * @param mysqli $db
	 * @param int $tagId
	 * @return void
	 */
	public static function deleteTag(mysqli $db, int $tagId): void
	{
		$query = TagDBQuery::deleteFromTagTypeTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "i", $tagId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$query = TagDBQuery::deleteTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "i", $tagId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Удаление типа тэга по $typeTagId
	 *
	 * @param mysqli $db
	 * @param int $typeTagId
	 * @return void
	 */
	public static function deleteTypeTag(mysqli $db, int $typeTagId): void
	{
		$query = TagDBQuery::deleteTypeTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "i", $typeTagId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Редактирование названия тэга по $tagId
	 *
	 * @param mysqli $db
	 * @param int $tagId
	 * @param string $tagName
	 * @return void
	 */
	public static function editTag(mysqli $db, int $tagId, string $tagName): void
	{
		$query = TagDBQuery::saveTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "si", $tagName, $tagId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Редактирование названия типа тэга по $typeTagId
	 *
	 * @param mysqli $db
	 * @param int $typeTagId
	 * @param string $typeTagName
	 * @return void
	 */
	public static function editTypeTag(mysqli $db, int $typeTagId, string $typeTagName): void
	{
		$query = TagDBQuery::saveTypeTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "si", $typeTagName, $typeTagId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Добавление нового тэга в БД
	 *
	 * @param mysqli $db
	 * @param string $tagName название нового тэга
	 * @return int
	 */
	public static function addTag(mysqli $db, string $tagName): int
	{
		$query = TagDBQuery::addTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "s", $tagName);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return mysqli_insert_id($db);
	}

	/**
	 * Создает связб между тэгом и его типом
	 *
	 * @param mysqli $db
	 * @param int $typeTagId
	 * @param int $tagId
	 * @return void
	 */
	public static function addTypeTagBelongTag(mysqli $db, int $typeTagId, int $tagId): void
	{
		$query = TagDBQuery::setTypeBelongTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "ii", $tagId, $typeTagId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Создает новый тип тэга
	 *
	 * @param mysqli $db
	 * @param string $typeTagName
	 * @return int
	 */
	public static function addTypeTag(mysqli $db, string $typeTagName): int
	{
		$query = TagDBQuery::addTypeTag();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "s", $typeTagName);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return mysqli_insert_id($db);
	}

	/**
	 * Расформировывает массив тэгов вида [$tag1, ...$tagN]
	 * в массив тэгов и их типов вида
	 * [$tagType1, [$tag11,..., $tagN1], ...,$tagTypeN, [$tag1N,...,$tagNN]]
	 *
	 * @param mysqli $db
	 * @param array $tagList
	 * @return array
	 */
	public static function organizeTagIdList(mysqli $db, array $tagList) : array
	{
		$query = TagDBQuery::organizeTagIdList();

		$tagListString = implode(',', $tagList);
		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, "s", $tagListString);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$tags = [];
		while ($tag = mysqli_fetch_assoc($result))
		{
			$tags[] = $tag['tagList'];
			$tags[] = $tag['tagType'];
		}

		return $tags;
	}
}