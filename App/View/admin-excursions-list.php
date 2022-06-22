<?php /** @var array $excursions */ ?>

<div class="bloc2" id="content">
	<form style="margin-right: 40px" class="d-flex" action="/admin/excursion/found" method="post">
		<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search-excursions">
		<button class="btn btn-outline-success" type="submit">Поиск</button>
	</form>
	<div class="bloc2-cont">
<?php
$counter = 1;

foreach ($excursions as $excursion):
?>
<div class="block">
<div style="padding: 3px 0; display: flex; align-items: center; ">
	<p class="accordion-item-bloc2-text-help">№<?=$counter?></p>
	<div id="accordionPanelsStayOpenExample">
		<div style="border: none; background-color: #6e6e6e; " class="accordion-item">
				<div  class="accordion-item-bloc1">
					<div style="    background-color: #6e6e6e" class="accordion-item-bloc2">
						<p class="accordion-item-bloc2-text">Название</p>
						<p class="inpit-me-order form-control"><?= $excursion->getNameCity() ?></p>
						<p class="accordion-item-bloc2-text">Стоимость</p>
						<p class="inpit-me-order form-control"><?= $excursion->getPrice() ?></p>
						<p class="accordion-item-bloc2-text">Количество</p>
						<p class="inpit-me-order form-control"><?= $excursion->getCountPersons() ?></p>
						<a style="margin-left: 10px;" href="/admin/detailed?id=<?=$excursion->getId();?>" class="admin-navbar-list-a">Изменить</a>
					</div>
					<button style="border: none;    background-color: #6e6e6e;" class="bitawe collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?=$counter?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?=$counter?>">+</button>
				</div>
				<div id="panelsStayOpen-collapse<?=$counter?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading<?=$counter?>">
					<?php
					foreach ($excursion->getExcursionOccupancyByDateTravel() as $datesPeople):
					?>
					<div  style="margin-top:10px;    background-color: #6e6e6e;display: flex;align-items: center;"  class="accordion-item-bloc3" id="divDateTravel_<?=$datesPeople['id']?>">
						<p style="margin-right: 46px;margin-left: 31px;" class="accordion-item-bloc2-text">Дата</p>
						<p style="max-width: 212px;" class="inpit-me-order form-control"><?= $datesPeople['dateTravel'] ?></p>
						<p style="margin-right: 33px;" class="accordion-item-bloc2-text">Набрано</p>
						<p style="max-width: 212px;" class="inpit-me-order form-control"><?= $datesPeople['orderedExcursionsCount'] ?> / <?= $excursion->getCountPersons()?> </p>
						<? if($datesPeople['orderedExcursionsCount']>0) {?>
							<input style="margin-left: 20px; width: 40px;background-color: #939393;border: none" type="submit" value="-" onclick="alert('Дату удалить нельзя. Есть заказы!')">
						<? } else {?>
							<input style="margin-left: 20px; width: 40px;background-color: #939393;border: none" type="submit" value="-" onclick="dateDeleteAjax('<?=$datesPeople['id']?>','divDateTravel_<?=$datesPeople['id']?>')">
						<? } ?>
					</div>
					<?php endforeach;?>
					<form style="display: flex;align-items: center;justify-content: center;padding: 20px;" action="/admin/excursions/addDate" method="post">
						<input type="hidden" value="<?= $excursion->getId()?>" name="id">
						<input style="max-width: 50px;margin-right: 10px; background-color: #939393" class="button-add-date inpit-me-order form-control" type="submit" value="Добавить дату">
						<input style="max-width: 300px" class="inpit-me-order form-control"  type="datetime-local" name="date">
					</form>
				</div>
		</div>
	</div>
</div>
</div>
	<?php $counter = $counter+1;
endforeach;?>
		<div  class="accordion-item-bloc1">
			<div class="accordion-item-bloc2">
				<a style="" href="/admin/excursion/add" class="admin-navbar-list-a">Создать</a>
			</div>
		</div>
</div>
	<div class="pagination"></div>
</div>

<script type="text/javascript" async src="/Resources/JS/pagination.js"></script>
