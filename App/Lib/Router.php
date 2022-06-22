<?php

namespace App\Lib;

use App\Exception\PathNotFoundEcxeption;

class Router
{
	protected static $routes = [];

	/**
	 * Adds new route to the router.
	 *
	 * @param string $method HTTP request method (GET|POST|PUT|DELETE).
	 * @param string $urlTemplate URL template with parameters placeholders, like (/user/:user_id).
	 * @param callable $callback Handler for this route.
	 * @return void
	 */
	public static function add(string $method, string $urlTemplate, callable $callback)
	{
		static::$routes[] = [
			'method' => $method,
			'urlTemplate' => $urlTemplate,
			'urlRegex' => static::makeRegexFromUrl($urlTemplate),
			'callback' => $callback,
		];
	}

	/**
	 * @throws \Exception
	 */
	public static function route(string $method, string $url): ?Response
	{

		foreach (static::$routes as $route)
		{
			$matches = [];
			if ($method === $route['method'] && preg_match($route['urlRegex'], $url, $matches))
			{
				return self::routeResponseAdapter(['callback' => $route['callback'], 'params' => $matches]);

			}
		}

		throw new PathNotFoundEcxeption();
	}

	private static function routeResponseAdapter(array $callback): ?Response
	{
		if ($callback === null)
		{
			return Response::error(404, "Not Found");
		}

		$params = $callback['params'];

		if (is_array($callback['callback']))
		{
			$callbackReflection = new \ReflectionMethod($callback['callback'][0], $callback['callback'][1]);
		}
		elseif (is_string($callback['callback']) || is_callable($callback['callback']))
		{
			$callbackReflection = new \ReflectionFunction($callback['callback']);
		}

		$args = [];
		foreach ($callbackReflection->getParameters() as $parameter)
		{
			if (isset($params[$parameter->getName()]))
			{
				$args[] = $params[$parameter->getName()];
			}
			else
			{
				if (!$parameter->isDefaultValueAvailable())
				{
					throw new \Exception("No value for parameter $" . $parameter->getName());
				}
			}
		}

		try
		{
			$result = call_user_func_array($callback['callback'], $args);
		}
		catch (Exception $e)
		{
			// TODO: журналируем и выводим исключение
			return null;
		}
		if ($result instanceof Response)
		{
			return $result;
		}
		if (is_array($result))
		{
			return Response::json($result);
		}
		if (is_string($result))
		{
			return Response::text($result);
		}

		return Response::error('404', 'Not Found');
	}


	/**
	 * @param string $urlTemplate
	 * @return string
	 */
	public static function makeRegexFromUrl(string $urlTemplate): string
	{
		return "#^"
			. preg_replace('/\\\:([\w_]+)/', '(?<$1>[a-zA-Z0-9\-\_]+)', preg_quote($urlTemplate))
			. "$#D";
	}
}