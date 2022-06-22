<?php

namespace App\Controller;

use App\Lib\Render;

class MessageController
{
	/**
	 * Выводит на экран сообщение об ошибке 404
	 *
	 * @return string строка с html кодом
	 */
	public static function showErrorPage() :string
	{
		return Render::renderContent('error-404');
	}

	/**
	 * Выводит на экран сообщение о том, что экскурсий с
	 * таким набором тегов не существует
	 *
	 * @return string строка с html кодод
	 */
	public static function excursionNotFoundAction():string
	{

		return Render::renderContent('error-nothing-found');
	}

	/**
	 * Выводит на публичный экран информацию о нашей команде
	 *
	 * @return string строка с html кодом
	 */
	public static function showStaffInformationAction(): string
	{
		return Render::render("about","layout");
	}

	/**
	 * Выводит на публичный экран с общей информацией о сайте
	 *
	 * @return string строка с html кодом
	 */
	public static function showCommonInformationAction(): string
	{
		return Render::render("client","layout");
	}

	/**
	 * Выводит на публичный экран блог с полезной для пользовтеля информацией
	 *
	 * @return string строка с html кодом
	 */
	public static function showBlogAction(): string
	{
		return Render::render("blog", "layout");
	}

}