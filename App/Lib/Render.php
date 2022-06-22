<?php

namespace App\Lib;

class Render
{
	/**
	 * Буферизирует вывод
	 *
	 * @param string $viewName имя php файла с html кодом
	 * @param array $parameters [optional] <p>
	 * нужен в том случае, если для буферизации требуется
	 * какая-либо переменная/массив.
	 * @return string|null возвращает html код в виде строки
	 */
	public static function renderContent(string $viewName, array $parameters = []): ?string
	{
		extract($parameters, EXTR_OVERWRITE);
		ob_start();
		require(__DIR__ . "/../View/{$viewName}.php");
		return ob_get_clean();
	}

	/**
	 * Буферизирует вывод вместе с заготовленным layout
	 * @param string $content строка с html кодом (контентом)
	 * @param array $templateData [optional] <p>
	 * нужен в том случае, если для буферизации требуется
	 * какая-либо переменная/массив.
	 * @return string возвращает html код в виде строки
	 */
	public static function renderLayout(string $content,string $layoutName, array $templateData = []): string
	{
		$data = array_merge($templateData, [
			'content' => $content,
		]);
		return self::renderContent($layoutName, $data);
	}

	/**
	 * Буферизация контентной части и layout
	 * @param string $viewName имя php файла с html кодом, где находится контентная часть*
	 * @param string $layoutName имя php файла с html кодом, где находится layout*
	 * @param array $parameters [optional]<p>
	 * нужен в том случае, если для буферизации требуется
	 * какая-либо переменная/массив.
	 * @return string возвращает html код в виде строки
	 */
	public  static  function  render(string $viewName, string  $layoutName, array $parameters = []) : string
		{
			$content = self::renderContent($viewName, $parameters);
			return self::renderLayout($content,$layoutName);
		}
}