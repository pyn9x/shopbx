<?php
/**@var array $orders */
/**@var array $statuses */
$helper = App\Lib\Helper::getInstance();
?>
<div id='order'>
	<div class="bloc2" id="content">
		<form style="margin-right: 40px" class="d-flex" method="post">
			<input class="form-control me-2" id="findName" type="search" placeholder="Search" aria-label="Search" name="search-excursions">
			<a href="javascript:void(0)" onclick="findOrdersByClientName('findName')" class="btn btn-outline-success" type="submit">Поиск</a>
		</form>
		<div class="bloc2-cont">
			<?php
			foreach ($orders

			as $order): ?>
			<div class="block">
				<form method="post">
					<div class="admin-orders">
						<label style="margin-right: 20px" class="admin-orders-text">№<?= $order->getId() ?></label>
						<div class="admin-orders-bloc1">
							<div class="admin-orders-bloc1-form">
								<div class="admin-orders-bloc1-clom1">
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">ФИО</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName_fio_<?= $order->getId() ?>" name="fio" value="<?= $order->getFio() ?> ">
									</div>
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Номер</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName_phone_<?= $order->getId() ?>" name="phone" value="<?= $order->getPhone() ?> ">
									</div>
								</div>
								<div class="admin-orders-bloc1-clom1">
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Почта</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName_email_<?= $order->getId() ?>" name="email" value="<?= $order->getEmail() ?> ">
									</div>
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Статус</p>
										<select class="inpit-me-order form-control va" id="inlineFormInputName_status_<?= $order->getId() ?>" name="status">
											<?php
											foreach ($statuses as $status): ?>
												<option <?= $helper::noRepeatStatus($order->getStatus(),
													$status["name"]) ?>
													value="<?= $status["id"] ?>"><?= $status["name"] ?></option>
											<?php
											endforeach; ?>
										</select>
									</div>
								</div>
								<div class="admin-orders-bloc1-clom1">
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Название.экс</p>
										<input class="inpit-me-order form-control" id="inlineFormInputName_nameExc_<?= $order->getId() ?>" name="nameExcursion" value="<?= $order->getExcursionName() ?> ">
									</div>
									<div style="display: flex;flex-direction: column;align-items: center;">
										<p class="admin-orders-text">Дата Экскурсии</p>
										<input id="inlineFormInputName" class="inpit-me-order form-control" name="date" value="<?= $helper::conversionDate($order->getDateTravel()) ?> " disabled>
									</div>
								</div>

								<div style="display: flex;flex-direction: column;align-items: center;">
									<p class="admin-orders-text">Комментарий</p>
									<input class="inpit-me-order form-control" id="inlineFormInputName_comment_<?= $order->getId() ?>" name="comment" value="<?= $order->getComment() ?> ">

									<p class="admin-orders-text">Дата заказа</p>
									<input style="background-color: white;border: none;border-radius: 0.25rem;color: black;" id="inlineFormInputName" class="inpit-me-order form-control<?=$order->getId() ?>" name="date" value="<?= $helper::conversionDate($order->getDateTravel()) ?> " disabled>
								</div>


								<div class="admin-orders-bloc1-clom2">
									<a href="javascript:void(0)" onclick="saveOrder('<?= $order->getId() ?>','inlineFormInputName_fio_<?= $order->getId() ?>', 'inlineFormInputName_email_<?= $order->getId() ?>', 'inlineFormInputName_phone_<?= $order->getId() ?>','inlineFormInputName_status_<?= $order->getId() ?>', 'inlineFormInputName_comment_<?= $order->getId() ?>')" class="admin-navbar-list-a">save</a>
									<a href="javascript:void(0)" onclick="deleteOrder('<?= $order->getId() ?>')" class="admin-navbar-list-a">delete</a>
								</div>
							</div>
				</form>
			</div>
		</div>
	</div>
	<?php
	endforeach; ?>
</div>
<div class="pagination"></div>
<script type="text/javascript" async src="/Resources/JS/pagination.js"></script>





