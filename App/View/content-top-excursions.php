<?php
/** @var array $excursions */
use App\Lib\Render;
?>



<div class="bloc1">
	<div class="main-bloc">
		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="/Resources/Images/1442912%201.png">
			</div>
			<div class="main-bloc-text">
				<p class="main-bloc-h1">ВОЗМОЖНОСТИ ДЛЯ НАСТРОЙКИ</p>
				<p class="main-bloc-p">Создайте индивидуальную поездку за меньшее время</p>
			</div>
		</div>

		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="/Resources/Images/1442912%201.png">
			</div>
			<div class="main-bloc-text">
				<p class="main-bloc-h1" style="margin-top: 10px">БОЛЬШЕ ОПЫТА</p>
				<p class="main-bloc-p"  style="margin-top: 10px">Раздвиньте свои границы и испытайте приключение</p>
			</div>
		</div>

		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="/Resources/Images/1442912%201.png">
			</div>
			<div class="main-bloc-text" style="width: 260px">
				<p class="main-bloc-h1" style="margin-top: 10px">БОЛЬШЕ УСЛУГ</p>
				<p class="main-bloc-p"  style="margin-top: 10px">Чувствовать себя в безопасности и получать поддержку во время путешествия</p>
			</div>
		</div>

		<div class="main-bloc-fix">
			<div class="main-bloc-img">
				<img src="/Resources/Images/1442912%201.png">
			</div>
			<div class="main-bloc-text" style="width: 240px">
				<p class="main-bloc-h1" style="margin-top: 10px">БОЛЬШЕ ДОВЕРИЯ</p>
				<p class="main-bloc-p"  style="margin-top: 10px">Получите открытую и честную консультацию. Всегда!</p>
			</div>
		</div>
	</div>
</div>
<div class="bloc2">
	<p class="bloc-2-text-top">Топ Экскурсий</p>
	<div class="bloc-2-contener">
		<?= Render:: renderContent("content-card",['excursions'=>$excursions])?>
	</div>
</div>
<div class="bloc3-difference">
	<div style="display: flex;justify-content: flex-end;">
		<img style="" src="/Resources/Images/happy-retired-couple-enjoying-nature-in-the-californian-forest 3.png">
	</div>
	<div class="difference-text">
		<p class="difference-text-main">Что отличает эти поездки от других?</p>
		<p class="difference-text-secondary">Мы считаем, что отпуск должен быть чем-то большим, чем номер в отеле, перелет и прокат автомобиля. Оно должно быть больше, чем сумма его частей. Мы также верим, что вызов может помочь вам расти, а поездка может всколыхнуть душу. Мы создаем путешествия, которые стоит совершить - для путешественника, для принимающей стороны и для всего мира.</p>
	</div>
</div>
<div class="bloc4-map">
	<div class="map-img">
		<img src="/Resources/Images/карта бэг 1.png">
		<div>
			<img class="map-img-secondary-1" src="/Resources/Images/карта2.png">
			<a href="#" class="map-img-a map-position-a-1" data-map="1">3</a>
			<img class="map-img-secondary-2" src="/Resources/Images/карта1.png">
			<a href="#" class="map-img-a map-position-a-2" data-map="2">5</a>
			<img class="map-img-secondary-3" src="/Resources/Images/карта3.png">
			<a href="#" class="map-img-a map-position-a-3" data-map="3">1</a>
			<img class="map-img-secondary-4" src="/Resources/Images/карта4.png">
			<a href="#" class="map-img-a map-position-a-4" data-map="4">4</a>
			<img class="map-img-secondary-5" src="/Resources/Images/карта5.png">
			<a href="#" class="map-img-a map-position-a-5" data-map="5">4</a>
			<img class="map-img-secondary-6" src="/Resources/Images/карта6.png">
			<a href="#" class="map-img-a map-position-a-6" data-map="6">7</a>
		</div>
	</div>
	<div class="bloc4-map-text">
		<p class="map-text-main">КУДА МОЖНО ОТПРАВИТЬСЯ?</p>
		<p class="map-text-secondary">Откройте для себя мир!</p>
		<p class="map-text-secondary-2"> Начать приключение просто — выбери интересное направление и отправь заявку организатору. Цена указана за одного человека. Приятного отдыха и ярких впечатлений!</p>
		<div class="map-text-secondary-a">
			<a>Посмотреть экскурсии</a>
		</div>
	</div>
</div>
<div class="bloc5-landscape">
	<img class="bloc5-sky-1" src="/Resources/Images/sky1.png">
	<img class="bloc5-sky-2" src="/Resources/Images/sky-2.png">
	<img class="bloc5-sky-3" src="/Resources/Images/sky-3.png">
	<div class="bloc5-landscape-img-1"></div>
	<div class="bloc5-landscape-img-2"></div>
	<div class="bloc5-landscape-img-3"></div>
</div>

<script defer src="/Resources/JS/main-card.js"></script>