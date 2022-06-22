<?php

namespace App\Controller;

use App\Config\Database;
use App\Lib\Helper;
use App\Service\TagService;
use App\Lib\Render;

class TagController
{
	public static function showAdminTagsPrepare(): string
	{
		$typeTags = self::getAllTagsAction();
		$content = Render::renderContent("admin-tags-list", ["typeTags" => $typeTags]);
		return $content;
	}

	public static function getAllTagsAction(): array
	{
		$typeTags = TagService::getTypeTagsForAdminPage(Database::getDatabase());
		foreach ($typeTags as $typeTag)
		{
			$tagsBelong = TagService::getTagsForAdminPage(Database::getDatabase(), $typeTag->getId());
			$typeTag->setTagsBelong($tagsBelong);
		}
		return $typeTags;
	}

	public static function showAdminTags(): string
	{
		if (!UserController::isAuthorized())
		{
			header("Location: " . Helper::getUrl() . "/login");
		}
		else
		{
			return Render::renderLayout(TagController::showAdminTagsPrepare(),"admin");
		}
	}

	public static function deleteTag(int $id): string
	{
		if (!UserController::isAuthorized())
		{
			header("Location: " . Helper::getUrl() . "/login");
		}
		else
		{
			$deleteTag = TagService::deleteTag(Database::getDatabase(), $id);
			return TagController::showAdminTagsPrepare();
		}
	}

	public static function deleteTypeTag(int $id): string
	{
		if (!UserController::isAuthorized())
		{
			header("Location: " . Helper::getUrl() . "/login");
		}
		else
		{
			$deleteTypeTag = TagService::deleteTypeTag(Database::getDatabase(), $id);
			return TagController::showAdminTagsPrepare();
		}
	}

	public static function saveTag(): string
	{
		if (!UserController::isAuthorized())
		{
			header("Location: " . Helper::getUrl() . "/login");
		}
		else
		{
			$tagId = $_POST['tagId'];
			$tagName = $_POST['tagName'];
			$saveTag = TagService::editTag(Database::getDatabase(), $tagId, $tagName);
			return TagController::showAdminTagsPrepare();
		}
	}

	public static function saveTypeTag(): string
	{
		if (!UserController::isAuthorized())
		{
			header("Location: " . Helper::getUrl() . "/login");
		}
		else
		{
			$typeTagId = $_POST['typeTagId'];
			$typeTagName = $_POST['typeTagName'];
			$saveTypeTag = TagService::editTypeTag(Database::getDatabase(), $typeTagId, $typeTagName);
			return TagController::showAdminTagsPrepare();
		}
	}

	public static function addTag(): string
	{
		if (!UserController::isAuthorized())
		{
			header("Location: " . Helper::getUrl() . "/login");
		}
		else
		{
			$typeTagId = $_POST['typeTagId'];
			$tagName = $_POST['tagName'];
			$tagId = TagService::addTag(Database::getDatabase(), $tagName);
			$setTypeTagBelongTag = TagService::addTypeTagBelongTag(Database::getDatabase(), $typeTagId, $tagId);
			return TagController::showAdminTagsPrepare();
		}
	}

	public static function addTypeTag(): string
	{
		if (!UserController::isAuthorized())
		{
			header("Location: " . Helper::getUrl() . "/login");
		}
		else
		{
			$typeTagName = $_POST['typeTagName'];
			$typeTagId = TagService::addTypeTag(Database::getDatabase(), $typeTagName);
			return TagController::showAdminTagsPrepare();
		}
	}

}