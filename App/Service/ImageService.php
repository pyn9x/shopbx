<?php

namespace App\Service;

use App\Entity\Image;
use App\Lib\DBQuery;
use mysqli;

class ImageService
{
	public static function getImageBindExcusionById(mysqli $db, int $excursionId): array
	{
		$query = "select
    				ui.ID as imageId,
    				ui.PATH as imagePath,
    				ui.MAIN as imageMain,
    				ui.DATE_CREATE as dateCreate,
    				ui.DATE_UPDATE as dateUpdate
					from up_image as ui
         				inner join up_product_image upi on ui.ID = upi.IMAGE_ID
					WHERE upi.PRODUCT_ID={$excursionId};";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$imageList = [];

		while ($image = mysqli_fetch_assoc($result))
		{
			$currentImage = new Image(
				$image['imageId'],
				$image['imagePath'],
				$image['imageMain'],
				$excursionId,
				$image['dateCreate'],
				$image['dateUpdate']
			);
			$imageList[] = $currentImage;
		}

		return $imageList;
	}

	public static function deleteImageById(mysqli $db, int $imageId): void
	{
		$query = "DELETE FROM up_product_image WHERE IMAGE_ID={$imageId}";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$query = "DELETE FROM up_image WHERE ID={$imageId}";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	public static function addImage(mysqli $db, string $pathFileOriginal, int $isMain): int
	{
		$query = "insert into `up_image`(`PATH`, `MAIN`, `DATE_CREATE`, `DATE_UPDATE`) VALUES ('".$pathFileOriginal."','".$isMain."',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return mysqli_insert_id($db);
	}

	public static function setImageBindExcusionById(mysqli $db, $excursionId, $imageId): void
	{
		$query = "insert into `up_product_image`(`PRODUCT_ID`, `IMAGE_ID`) VALUES ('".$excursionId."','".$imageId."')";

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}
}