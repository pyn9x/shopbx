<?php
/** @var string $excursion */
$helper=App\Lib\Helper::getInstance();
?>


<div class="detailed-page"></div>
<div class="detailed-page-bloc-card">
	<img class="img-bloc-card" src="/Resources/Images/прага%202.png">
	<div class="bloc-card-center">
		<div>
			<img src="<?= $excursion->getImageList() ?>">
		</div>
		<div class="bloc-card-center-text-block">
			<p class="detailed-page-text-1">Экскурсия</p>
			<p class="detailed-page-text-2">“<?= $excursion->getNameCity() ?>”</p>
			<p class="detailed-page-text-3"><?=$excursion->getFullDescription() ?></p>
			<p class="detailed-page-text-4">Что вас ожидает</p>
			<?php
			foreach ($excursion->getTagList() as $tag):
			?>
			<p class="detailed-page-text-5">
				<img style="padding-right: 15px" src="/Resources/Images/image%201.png">	<?=$tag	?>
			</p>
			<?php
			endforeach;
			?>
			<p class="detailed-page-text-5">
				<img style="padding-right: 15px" src="/Resources/Images/image%202.png"><?=$excursion->getDuration()?> суток</p>
			<p class="detailed-page-text-5">
				<img style="padding-right: 15px" src="/Resources/Images/image%203.png">Размер группы до <?=$excursion->getCountPersons()?> человек
			</p>
			<p class="detailed-page-text-7">Вы увидите</p>
			<div class="detailed-page-text-bloc-8">
				<div>
					<?php
					foreach ($excursion->getAttractionList() as $attraction):
					?>
					<p class="detailed-page-text-9">
						<img style="padding-right: 15px" src="/Resources/Images/image%205.png"><?= $attraction ?></p>
					<?php
					endforeach;
					?>
				</div>
			</div>
			<div>
				<button id="pay" class="detailed-page-button">Заказать  экскурсию</button>
			</div>
		</div>
	</div>
</div>

<div class="detailed-page-bloc-img">
	<div class="page-bloc-img">
		<img src="/Resources/Images/прага-1 1.png">
		<img src="/Resources/Images/image 6.png">
	</div>
</div>


<div class="detailed-page-bloc-pop-up" id="pay-45">
	<div class="dm-table">
		<div class="dm-cell">
			<div class="bloc-dm-modal">
				<div class="modal-header-detailed-page">
					<button class="close-detailed-page" id="pil2">X</button>
				</div>
				<div class="detailed-page-bloc-pop-up-cont">
					<form action="/createOrder" method="post">
						<input class="form-application-input" style="display: none" type="hidden" name="product_id" value="<?=$excursion->getId()?>">
						<input class="form-application-input" style="display: none" type="hidden" name="status_id" value="1">
						<input class="form-application-input" style="display: none" type="hidden" name="csrf_token" value="<?=$helper::generateFormCsrfToken()?>">
						<p class="form-application-text">Выберите дату экскурсии</p>
						<select class="form-application-input" name="dateTravel">
							<?foreach ($excursion->getAllPossibleDatesTravel() as $dateTravel):?>
							<option  id="dateTravel" value="<?=$dateTravel?>">
								<?=
									$helper->conversionDateToNumber($dateTravel) . " " .
									$helper->conversionDateToMonth($dateTravel)
								?></option>
							<?endforeach;?>
						</select>
						<p class="form-application-text">Укажите ваше имя</p>
						<input class="form-application-input" type="text" name="name" autocomplete="off" required="required" placeholder="     Имя...">
						<p class="form-application-text">Укажите ваш телефон</p>
						<input class="form-application-input" type="tel" name="telephone" autocomplete="off"  pattern="\+7[0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}" required placeholder="     +79118550378">
						<p class="form-application-text">Укажите ваш email</p>
						<input class="form-application-input" type="text" name="email" autocomplete="off" placeholder="     Email...">
						<p class="form-application-text">Укажите ваш комментарий</p>
						<input class="form-application-input" type="text" name="comment" autocomplete="off" required="required" placeholder="     Комментарий...">
						<div style="text-align: center; padding-top: 40px">
							<input  class="form-application-input-submit" type="submit" value="Отправить" id="pay-12">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="detailed-page-bloc-2-pop-up" id="pay-46">
	<div class="dm-table">
		<div class="dm-cell">
			<div class="bloc-dm-modal-bloc2">
				<div style="display: flex; align-items: center; flex-direction: column;padding: 30px;">
					<h1 style="margin-top: 30px;">Заказ отправлен</h1>
					<p style="margin-top: 50px;width: 218px;text-align: center;">Спасибо за ваш запрос наши менеджеры в ближайшее время свяжутся с вами</p>
					<button onclick="window.location.href = '/';"  class="form-application-input-submit" style="margin-top: 30px;" id="confirmation-button">на главную</button>
				</div>
			</div>
		</div>
	</div>
</div>

