<?php
/** @var string $content */

use App\Lib\Helper;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=0.8, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Title</title>
	<link rel="stylesheet" type="text/css" href="/Resources/CSS/Reset.css">
	<link rel="stylesheet" type="text/css" href="/Resources/CSS/style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script type="text/javascript" defer src="/Resources/JS/script.js"></script>
</head>
<body style="overflow-x:hidden;">

	<div class="header">
		<div class="menu">
			<div class="bloc-logo">
				<a href="/"><img class="header-logo" src="/Resources/Images/logo_template14%201.png"></a>
			</div>
			<div class="bloc-menu">
				<a href="/allExcursions/" class="menu-button">Экскурсии</a>
				<a href="/client" class="menu-button">Клиентам</a>
				<a href="/blog" class="menu-button">Блог</a>
				<a href="/about" class="menu-button">О нас</a>
			</div>
			<div class="exit-log">
				<a href='<?= Helper::getUrl() ?>/login' class="exit-button"><img src="/Resources/Images/1.png"> Личный кабинет</a>
			</div>
		</div>
	</div>


	<div class="mobile-nav-button-block">
		<div class="mobile-nav-button">
			<div class="mobile-nav-button__line"></div>
			<div class="mobile-nav-button__line"></div>
			<div class="mobile-nav-button__line"></div>
		</div>

		<nav class="mobile-menu">
			<ul class="mobile-menu-bloc2">
				<li><a href="/" class="pading-5">Главная</a></li>
				<li><a href="/allExcursions/" class="pading-1">Экскурсии</a></li>
				<li><a href="/client" class="pading-2">Клиентам</a></li>
				<li><a href="/blog" class="pading-3">Блог</a></li>
				<li><a href="/about" class="pading-4"> О нас</a></li>
			</ul>
		</nav>
		<div class="mobile-menu-2">
			<div class="mobile-menu-2-none none-1">
				<div style="background-image: url('/Resources/Images/23232 1.png')" class="bloc1-menu">
					<div class="bloc1-menu-2-margin">
						<div class="bloc1-menu-2-img">
							<img src="/Resources/Images/55 1.png">
						</div>
						<div>
							<p class="bloc1-menu-2-text-h2">ЭКСКУРСИИ</p>
							<p class="bloc1-menu-2-text-h1">Самые лучшие в своем деле</p>
							<p class="bloc1-menu-2-text-p">Мы находим лучших гидов и совместно придумываем экскурсии. В результате вы встречаетесь с журналистами, историками, архитекторами и другими интересными людьми, которые умеют увлечь своими знаниями.</p>
							<div>
								<img style="width: 600px;" src="/Resources/Images/image 13 (4).png"><br/>
								<img style="width: 350px;" src="/Resources/Images/fb508b897d5f093653566c717cd9af55.png">
								<img src="/Resources/Images/image 16 (1).png">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mobile-menu-2-none none-2">
				<div style="background-image: url('/Resources/Images/111.jpg')" class="bloc1-menu">
					<div class="bloc1-menu-2-margin">
						<div class="bloc1-menu-2-img">
							<img src="/Resources/Images/55 1.png">
						</div>
						<div>
							<p class="bloc3-menu-2-text-h2">КЛИЕНТАМ</p>
							<p class="bloc3-menu-2-text-p1">Каждый авторская экскурсия – это уникальная программа, подготовленная командой наших агентов с назначенным руководителем и организатором. Выбрав любую из представленных на сайте, вы поймете, что такого больше нет нигде. Отзывы многочисленных клиентов, уже успевших насладиться поездкой с нами, свидетельствуют об этом.</p>
							<p class="bloc3-menu-2-text-h1">КАКИЕ СТРАНЫ МЫ ПРЕДЛАГАЕМ</p>
							<p class="bloc3-menu-2-text-p2">Абсолютно все. В ассортименте привычная для туристов Европа и страны ближнего зарубежья, показанные с новой стороны, экзотический Восток, а также Океания, удаленные острова и многое другое. Вы можете отправиться в Японию, чтобы воочию увидеть цветение сакуры или принять участие в карнавале, посвященному Дню мертвых в Мексике, пройти по пути Святого Иакова в Испании или достичь последнего рубежа Аляски, провести лучшие 12 дней на Шри-Ланке или отправиться в большое путешествие по Африке. </p>
						</div>
					</div>
				</div>
			</div>
			<div class="mobile-menu-2-none none-3">
				<div style="background-image: url('/Resources/Images/3333.jpg') " class="bloc1-menu">
					<div class="bloc1-menu-2-margin">
						<div class="bloc1-menu-2-img">
							<img src="/Resources/Images/55 1.png">
						</div>
						<div>
							<p class="bloc4-menu-2-text-h2">БЛОГ</p>
							<p class="bloc4-menu-2-text-h1">яркие эмоции</p>
							<p style="width: 450px" class="bloc4-menu-2-text-p1">Найдите вдохновение для своей следующей поездки и получите советы от путешественников, которые бывали там раньше.</p>
						</div>
						<div class="bloc4-menu-2-card-content">
							<div class="bloc4-menu-2-card-1">
								<div style="margin: 5px;text-align: center;">
									<p class="bloc4-menu-2-text-h1">КРАСИВЫЕ ВИДЫ...</p>
									<p style="color: white" class="bloc4-menu-2-text-p1">Узнай, какие места стоит посетить ради красивого вида</p>
								</div>
							</div>
							<div class="bloc4-menu-2-card-2">
								<div style="margin: 5px;text-align: center;">
									<p class="bloc4-menu-2-text-h1">Что взять в дорогу</p>
									<p style="color: white" class="bloc4-menu-2-text-p1">Что можно брать, а чего категорически нельзя</p>
								</div>
							</div>
							<div class="bloc4-menu-2-card-3">
								<div style="margin: 5px;text-align: center;">
									<p class="bloc4-menu-2-text-h1">Лучшие завтраки</p>
									<p style="color: white" class="bloc4-menu-2-text-p1">Места, в которых делают самые вкусные завтраки</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mobile-menu-2-none none-4">
				<div style="background-image: url('/Resources/Images/111.jpg')" class="bloc1-menu">
					<div class="bloc1-menu-2-margin">
						<div class="bloc1-menu-2-img">
							<img src="/Resources/Images/55 1.png">
						</div>
						<div>
							<p class="bloc1-menu-2-text-h2">О НАС</p>
							<p class="bloc1-menu-2-text-h1">ПУТЕШЕСТВУЙ ПО ВСЕМУ МИРУ!</p>
							<p class="bloc1-menu-2-text-p">Коллектив компании Excurs против однообразного отдыха и похожих как близнецы туров. Своим клиентам мы предлагаем исключительно эксклюзивные путешествия в самые разные точки земного шара.</p>
							<p class="bloc1-menu-2-text-p">Авторские туры рассчитаны на тех, кто знает толк в поездках. Они также привлекают людей, застрявших в поисках неизведанного, манящего и удивительно прекрасного.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="none-5">
				<div style="background-image: url('/Resources/Images/111 1.png')" class="bloc1-menu">
					<div class="bloc1-menu-2-margin">
						<div class="bloc1-menu-2-img">
							<img src="/Resources/Images/55 1.png">
						</div>
						<div>
							<p class="bloc1-menu-2-text-h2">ГЛАВНАЯ</p>
							<p class="bloc1-menu-2-text-h1">Экскурсии, которые стоит посетить</p>
							<p class="bloc1-menu-2-text-p">Программы авторских экскурсий рассчитаны и на любителей активного отдыха, и на созерцателей природы или архитектуры. Вы сами выбираете дату и место, в предложениях указана стоимость на одного человека.</p>
							<div style="display: flex;margin-left: -30px;">
								<div class="bloc5-menu-navbar-2-img-text">
									<img src="/Resources/Images/870092.png">
									<p style="width: 50px;">Полет всей группой</p>
								</div>
								<div class="bloc5-menu-navbar-2-img-text">
									<img src="/Resources/Images/531897.png">
									<p style="width: 60px">Позаботимся о вашем багаже</p>
								</div>
								<div class="bloc5-menu-navbar-2-img-text">
									<img src="/Resources/Images/3127176.png">
									<p style="width: 70px;">Получение билетов за 24 часа</p>
								</div>
								<div class="bloc5-menu-navbar-2-img-text">
									<img src="/Resources/Images/854996.png">
									<p style="width: 50px;">Все маршруты продуманы</p>
								</div>
								<div class="bloc5-menu-navbar-2-img-text">
									<img src="/Resources/Images/6889720.png">
									<p style="width: 50px;">Оставим яркие эмоции</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div id="page-content">
			<?= $content ?>
		</div>
	</div>


	<div class="footer">
		<div class="footer-bloc1">
			<img class="footer-logo" src="/Resources/Images/logo2_template14%201.png">
			<div class="footer-bloc1-text">
				<p class="footer-text">Свяжитесь с нами</p>
				<p class="footer-text">Положение о конфиденциальности</p>
			</div>
		</div>
		<div class="footer-bloc2">
			<p class="footer-text-2">Следите за нами</p>
			<a><img src="/Resources/Images/вк.png"></a>
			<a><img src="/Resources/Images/инста.png"></a>
			<a><img src="/Resources/Images/твитер.png"></a>
			<a><img src="/Resources/Images/фейсбук.png"></a>
			<a><img src="/Resources/Images/4846401.png"></a>
		</div>
		<div class="footer-bloc3">
			<p class="footer-text-3">© 2022</p>
		</div>
	</div>

	<div class="progress-wrap">
		<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
			<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
		</svg>
	</div>
</body>
</html>