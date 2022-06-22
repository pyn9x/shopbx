<?php

namespace App\Service;

use App\Entity\Order;
use App\Lib\OrderDBQuery;
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

class OrderService
{

	/**
	 * Создание заказа. $orderData содержит поля:
	 * - ['name'],
	 * - ['email'],
	 * - ['telephone'],
	 * - ['date'],
	 * - ['comment'],
	 * - ['status_id'],
	 * - ['dateTravel']
	 *
	 * @param mysqli $db
	 * @param array $orderData
	 * @return void
	 */
	public static function createOrder(mysqli $db, array $orderData): void
	{
		$createDateOrder = new \DateTime('now');
		$orderData['date'] = $createDateOrder->format("Y-m-d H:i:s");

		$query = OrderDBQuery::createOrder();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"sssssis",
								$orderData['name'],
								$orderData['email'],
								$orderData['telephone'],
								$orderData['date'],
								$orderData['comment'],
								$orderData['status_id'],
								$orderData['dateTravel']
		);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Формирует массив сущностей Order, содержащий информацию из БД
	 *
	 * @param \mysqli_result $dataFromDB
	 * @return array
	 */
	public static function parseOrdersForAdminPage(\mysqli_result $dataFromDB) : array
	{
		$orders = [];

		while($order = mysqli_fetch_assoc($dataFromDB))
		{
			$orders[] = new Order(
				$order['id'],
				$order['fio'],
				$order['email'],
				$order['phone'],
				$order['orderDate'],
				$order['comment'],
				$order['statusId'],
				0,
				'',
				''
			);
			$orders[count($orders)-1]->setStatus($order['status']);
			$orders[count($orders)-1]->setExcursionName($order['excursionName']);
			$orders[count($orders)-1]->setDateTravel($order['dateTravel']);
		}

		return $orders;
	}

	/**
	 * Возвращает массив сущностей Order, содержащих в поле fio $clientName
	 *
	 * @param mysqli $db
	 * @param string $clientName фрагмент для поиска
	 * @return array
	 */
	public static function getOrdersByClientName(mysqli $db, string $clientName) : array
	{
		$query = OrderDBQuery::findOrderByClientName();

		$searchString = mysqli_real_escape_string($db, $clientName);

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"s",$searchString);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseOrdersForAdminPage($result);
	}

	/**
	 * Возвращает массив сущностей Order для админской части
	 *
	 * @param mysqli $db
	 * @return array
	 */
	public static function getOrdersForAdminPage(mysqli $db) : array
	{
		$query = OrderDBQuery::getOrdersForAdminPage();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		return self::parseOrdersForAdminPage($result);
	}

	/**
	 * Перезаписывает данные о заказе, имеющем $id, в БД.
	 * ВНИМАНИЕ: все поля должны быть заполнены!
	 *
	 * @param mysqli $db
	 * @param int $id
	 * @param string $fio
	 * @param string $email
	 * @param string $phone
	 * @param int $status
	 * @param string $comment
	 * @return void
	 */
	public static function editOrderById(mysqli $db,
			int $id, string $fio, string $email, string $phone, int $status, string $comment) : void
	{
		$query = OrderDBQuery::editOrder();

		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"sssssi", $fio, $email, $phone, $comment, $status, $id);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Удаляет заказ из БД по его $id
	 *
	 * @param mysqli $db
	 * @param int $orderId
	 * @return void
	 */
	public static function deleteOrderById(mysqli $db, int $orderId) : void
	{
		$query = OrderDBQuery::deleteOrderById();
		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt,"i",$orderId);
		$result = mysqli_stmt_execute($stmt);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}
	}

	/**
	 * Получает массив всех имеющихся в БД статусов
	 * заказов в формате: ['id', 'name']
	 *
	 * @param mysqli $db
	 * @return array
	 */
	public static function getAllStatuses(mysqli $db) : array
	{
		$query = OrderDBQuery::getAllStatuses();

		$result = mysqli_query($db, $query);

		if (!$result)
		{
			trigger_error(mysqli_error($db), E_USER_ERROR);
		}

		$statuses = [];

		while ($status = mysqli_fetch_assoc($result))
		{
			$statuses[] = [
				'id' => $status['id'],
				'name' => $status['name']
			];
		}

		return $statuses;
	}


}