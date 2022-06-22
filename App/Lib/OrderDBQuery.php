<?php

namespace App\Lib;

class OrderDBQuery
{
	public static function findOrderByClientName() : string
	{
		return
			self::getOrdersForAdminPage() .
			"where up_order.FIO like (?)";
	}

	public static function deleteOrderById() : string
	{
		return "
			delete from up_order
			where up_order.ID = ?
		";
	}

	public static function getOrdersForAdminPage() : string
	{
		return "
			select
				up_order.ID as 'id',
				up_order.FIO as 'fio',
				up_order.EMAIL as 'email',
				up_order.PHONE as 'phone',
				up_order.DATE_ORDER as 'orderDate',
				up_order.COMMENT as 'comment',
				up_order.STATUS_ID as 'statusId',
				up_status_order.NAME as 'status',
			   (
					select concat(up_product.NAME_CITY, ', ',
								  up_product.NAME_COUNTRY)
					from up_product
					left join up_product_date
					on up_product.ID = up_product_date.PRODUCT_ID
					where up_product_date.DATE_ID = up_order.DATE_ID
				) as 'excursionName',
				up_date.DATE_TRAVEL as 'dateTravel'
			from up_order
			left join up_status_order on up_status_order.ID = up_order.STATUS_ID
			left join up_date on up_order.DATE_ID = up_date.ID
		";
	}

	public static function editOrder() : string
	{
		return "
			update up_order
			set
				up_order.FIO = ?,
				up_order.EMAIL = ?,
				up_order.PHONE = ?,
			    up_order.COMMENT = ?,
				up_order.STATUS_ID = ?
			where up_order.ID = ?
		";
	}

	public static function createOrder(): string
	{
		return "
			insert into up_order
			(
			 FIO,
			 EMAIL,
			 PHONE,
			 DATE_ORDER,
			 COMMENT,
			 STATUS_ID,
			 DATE_ID,
			 DATE_CREATE,
			 DATE_UPDATE
			 )
			values
			(
			?,
			?,
			?,
			?,
			?,
			?,
			(
				select 
				       up_date.ID
				from up_date
				where up_date.DATE_TRAVEL = ?
			),
			CURRENT_TIMESTAMP,
			CURRENT_TIMESTAMP
			)
		";
	}

	public static function getAllStatuses() : string
	{
		return "
			select
				ID as 'id',
				NAME as 'name'
			from up_status_order
		";
	}
}