<?php

namespace App\Lib;

use App\Config\Database;
use App\Config\Settings;
use App\Service\ExcursionService;

class Helper
{
	private static $instance;

	public static function getInstance(): Helper
	{
		if (self::$instance)
		{
			return self::$instance;
		}

		self::$instance = new self();

		return self::$instance;
	}

	public static function conversionDateToNumber($date)
	{
		$date = date_create($date);
		return date_format($date, 'd');
	}

	public static function conversionDateToMonth($date)
	{
		$date = date_create($date);
		return date_format($date, 'M');
	}

	public static function conversionDateToTime($date): string
	{
		$date = date_create($date);
		$hours = date_format($date, 'H');
		$minutes = date_format($date, 'i');
		return "{$hours}ч:{$minutes}мин";
	}

	public static function conversionDate($date): string
	{
		$date = date_create($date);
		return date_format($date, "j, F, Y, H:i ");
	}

	public static function conversionCelsiusToFahrenheit($celsius)
	{
		return ($celsius * 9 / 5) + 32;
	}

	public static function priceInUsd($priceInRub)
	{
		static $rates;

		if ($rates === null)
		{
			$rates = json_decode(file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js'));
		}
		$data = $priceInRub / $rates->Valute->USD->Value;
		return round($data, 2);
	}

	public static function generateFormCsrfToken()
	{
		session_start();
		return $_SESSION['csrf_token'] = substr(str_shuffle('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'), 0,
			10);
	}
	public static function getCsrfToken(): string
	{
		return $_SESSION['csrf_token'];
	}

	public static function generateUserHash(int $length = 6): string
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";

		$userHash = "";

		$clen = strlen($chars) - 1;
		while (strlen($userHash) < $length)
		{
			$userHash .= $chars[mt_rand(0, $clen)];
		}

		return $userHash;
	}

	public static function getPasswordHash(string $password): string
	{
		$passwordHash = password_hash($password, PASSWORD_DEFAULT);
		return $passwordHash;
	}

	public static function setAuthorized(string $id, string $userHash): void
	{
		session_start();
		$_SESSION['userId'] = $id;
		$_SESSION['userHash'] = $userHash;
	}

	public static function getCurrentUserId(): int
	{
		session_start();
		return $_SESSION['userId'];
	}

	public static function validateFields(array $data): array
	{
		$validateData = [];
		foreach ($data as $key => $value)
		{
			$currentItem = $value;
			$currentItem = trim($currentItem);
			$currentItem = stripslashes($currentItem);
			$currentItem = strip_tags($currentItem);
			$currentItem = htmlspecialchars($currentItem);
			$currentItem = mysqli_real_escape_string(Database::getDatabase(), $currentItem);
			$validateData[$key] = $currentItem;
		}
		return $validateData;
	}

	public static function noRepeatStatus(string $statusFromOrder, string $allStatus): ?string
	{
		if ($statusFromOrder === $allStatus)
		{
			return "selected";
		}
		return null;
	}

	public static function getUrl(): string
	{
		return ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
	}

	public static function replacementNullValueMysql($valueMysql)
	{
		return ($valueMysql==NULL) ? '' : $valueMysql;
	}

	public static function calculationRating(float $internetRating, float $entertainmentRating, float $serviceRating): float
	{
		return round(($internetRating+$entertainmentRating+$serviceRating)/3, 1, PHP_ROUND_HALF_EVEN);
	}

	public static function createPreaviewImage(string $src, string $thumb): string
	{
		$srcNew = $_SERVER['DOCUMENT_ROOT'].$src;
		$thumbNew = $_SERVER['DOCUMENT_ROOT'].$thumb;
		$info = getimagesize($srcNew);
		switch ($info[2]) {
			case 1:
				$im = imageCreateFromGif($srcNew);
				imageSaveAlpha($im, true);
				break;
			case 2:
				$im = imageCreateFromJpeg($srcNew);
				break;
			case 3:
				$im = imageCreateFromPng($srcNew);
				imageSaveAlpha($im, true);
				break;
		}
		$width  = $info[0];
		$height = $info[1];
		$h = 100;
		$w = ($h > $height) ? $width : ceil($h / ($height / $width));
		$tw = ceil($h / ($height / $width));
		$th = ceil($w / ($width / $height));
		$new_im = imageCreateTrueColor($w, $h);

		if ($w >= $width && $h >= $height) {
			$xy = array(ceil(($w - $width) / 2), ceil(($h - $height) / 2), $width, $height);
		} elseif ($w >= $width) {
			$xy = array(ceil(($w - $tw) / 2), 0, ceil($h / ($height / $width)), $h);
		} elseif ($h >= $height) {
			$xy = array(0, ceil(($h - $th) / 2), $w, ceil($w / ($width / $height)));
		} elseif ($tw < $w) {
			$xy = array(ceil(($w - $tw) / 2), ceil(($h - $h) / 2), $tw, $h);
		} else {
			$xy = array(0, ceil(($h - $th) / 2), $w, $th);
		}
		imageCopyResampled($new_im, $im, $xy[0], $xy[1], 0, 0, $xy[2], $xy[3], $width, $height);
		switch ($info[2]) {
			case 1: imageGif($new_im, $thumbNew); break;
			case 2: imageJpeg($new_im, $thumbNew, 100); break;
			case 3: imagePng($new_im, $thumbNew); break;
		}
		imagedestroy($im);
		imagedestroy($new_im);
		return $thumb;
	}
}