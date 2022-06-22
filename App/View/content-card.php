<?php
/** @var array $excursions */
$helper = App\Lib\Helper::getInstance();
?>

<?php
foreach ($excursions as $excursion): ?>
	<div class="block" style="position: relative;
	display: inline-block;">
	<div style="background-image: url(<?= $excursion->getImageList()?>)" class="bloc-2-box">
		<div class="asd">
			<div class="box-date">
				<p class="box-date-num"><?= $helper::conversionDateToNumber($excursion->getDateTravel()) ?></p>
				<p class="box-date-text"><?= $helper::conversionDateToMonth($excursion->getDateTravel()) ?></p>
			</div>
			<div class="box-h1">
				<p class="box-h1-1"><?= $excursion->getNameCity() ?></p>
				<p class="box-h1-2"><?= $excursion->getNameCountry() ?></p>
			</div>
			<div class="box-bottom">
				<img src="/Resources/Images/солнечно%201.png">
				<p class="box-bottom-weather"><?= $excursion->getDegrees()?>°C</p>
				<p class="box-bottom-many">₽ <?= $excursion->getPrice() ?></p>
			</div>
		</div>
		<div class="overlay">
			<div class="overlay-like">
				<a><img src="/Resources/Images/2961957%201.svg"></a>
			</div>
			<div class="overlay-progress-noa">
				<div class="loc">
					<p class="overlay-progress-text">Интернет</p>
					<div class="progress">
						<div class="progress-value" style="width: <?= $excursion->getInternetRating() * 10 ?>%;"></div>
					</div>
				</div>
				<div class="loc">
					<p class="overlay-progress-text">Развелчения</p>
					<div class="progress">
						<div class="progress-value" style="width: <?= $excursion->getEntertainmentRating() * 10 ?>%;"></div>
					</div>
				</div>
				<div class="loc">
					<p class="overlay-progress-text">Обслуживание</p>
					<div class="progress">
						<div class="progress-value" style="width: <?= $excursion->getServiceRating() * 10 ?>%;"></div>
					</div>
				</div>
				<div class="loc">
					<p class="overlay-progress-text">Оценка</p>
					<div class="progress">
						<div class="progress-value" style="width: <?= $excursion->getRating() * 10 ?>%;"></div>
					</div>
				</div>
			</div>
			<div class="overlay-detailed">
				<a href="excursion/<?=$excursion->getId() ?>">Подробнее<img src="/Resources/Images/2989988%201.svg"></a>
			</div>
		</div>
	</div>
	</div>
<?php
endforeach; ?>

