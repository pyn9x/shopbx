<?php

namespace App\Controller;

use App\Config\Database;
use App\Entity\Excursion;
use App\Entity\Order;
use App\Lib\Render;
use App\Lib\Helper;
use App\Logger\Logger;
use App\Service\ExcursionService;
use App\Service\OrderService;

class OrderController
{
	public static function createOrder()
	{
		session_start();
		$validateData = Helper::validateFields($_POST);
		if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === $validateData['csrf_token'])
		{
			OrderService::createOrder(Database::getDatabase(), $validateData);
			$excursions = ExcursionService::getTopExcursions(Database::getDatabase());
			return Render::render("content-top-excursions", "layout", ['excursions' => $excursions]);
		}
		else
		{
			$excursion = ExcursionService::getExcursionById(Database::getDatabase(), $validateData['product_id']);
			return Render::render("content-more-excursion", "layout", ['excursion' => $excursion]);
		}
	}

	public static function showAdminOrders(): string
	{
		if (UserController::isAuthorized())
		{
			$orders = OrderService::getOrdersForAdminPage(Database::getDatabase());
			$statuses = OrderService::getAllStatuses(Database::getDatabase());
			$content = Render::renderContent("admin-orders", ["orders" => $orders, "statuses" => $statuses]);
			return Render::renderLayout($content,"admin");
		}
		else
		{
			header("Location: " . Helper::getUrl() . "/login");
		}
	}

	public static function editOrder(): string
	{
		$logger = new Logger();
		$logger->info($_POST['id']);
		OrderService::editOrderById(Database::getDatabase(),
			$_POST['idOrder'],
			$_POST['fioOrder'],
			$_POST['emailOrder'],
			$_POST['phoneOrder'],
			$_POST['statusOrder'],
			$_POST['commentOrder']
		);
		$orders = OrderService::getOrdersForAdminPage(Database::getDatabase());
		$statuses = OrderService::getAllStatuses(Database::getDatabase());
		return Render::renderContent("admin-orders", ["orders" => $orders, "statuses" => $statuses]);
	}

	public static function deleteOrder(): string
	{
		$logger = new Logger();
		$logger->info($_POST['id']);
		OrderService::deleteOrderById(Database::getDatabase(), $_POST['idOrder']);
		$orders = OrderService::getOrdersForAdminPage(Database::getDatabase());
		$statuses = OrderService::getAllStatuses(Database::getDatabase());
		return Render::renderContent("admin-orders", ["orders" => $orders, "statuses" => $statuses]);
	}

	public static function findOrdersByClientName(): string
	{
		$logger = new Logger();
		$logger->info($_POST['id']);
		$orders = OrderService::getOrdersByClientName(Database::getDatabase(), $_POST['clientName']);
		$statuses = OrderService::getAllStatuses(Database::getDatabase());
		return Render::renderContent("admin-orders", ["orders" => $orders, "statuses" => $statuses]);
	}
}