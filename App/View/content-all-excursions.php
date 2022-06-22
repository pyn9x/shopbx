<?php
/** @var array $excursions **/
/** @var array $tagList **/
/** @var string $content */
use App\Lib\Render;
?>


<div class="bloc1-all-main-excurs">
	<div class="main-bloc">
	</div>
</div>
<div class="bloc2">
	<form class="bloc-2-contener-poisk" method="post">
		<input id="search" class="form-control-poisk" type="search" placeholder="Search" aria-label="Search" name="search-excursions" value="">
		<a id="findExcursionsBySearch" href="javascript:void(0)"  class="btn-outline-posik">Поиск</a>
	</form>

	</div>
	<div class="bloc-2-contener-tegi-list">
		<?php foreach ($tagList as $tagType ):?>
		<div class="checkselect">
			<?php foreach ($tagType->getTagsBelong() as $tag ):?>
				<label><input  class="custom-checkbox"  type="checkbox" name="brands[]" value="<?= $tag->getId()?>"> <?= $tag->getName()?></label>
			<?php endforeach?>
		</div>
		<?php endforeach?>

		<button class="glow-button" onclick="sort()"> Показать </button>
	</div>
	<div class="bloc-2-contener-tags-renting">
		<div class="form_radio_btn">
			<input id="radio-2" type="radio" onclick="updateOrderType(1)" name="radio" value="2">
			<label for="radio-2">Сначала дешевые</label>
		</div>

		<div class="form_radio_btn">
			<input id="radio-3" type="radio" onclick="updateOrderType(2)" name="radio" value="3">
			<label for="radio-3">Сначала дорогие</label>
		</div>

		<div class="form_radio_btn">
			<input id="radio-4" type="radio" onclick="updateOrderType(3)" name="radio" value="4" >
			<label for="radio-4">С высоким рейтингом</label>
		</div>

		<button class="btn-delete-all-filters" onclick="resetOrderType()">Сброс</button>
	</div>


	<div class="bloc-2-contener">
		<div class="content" id ="content"> <?= $content ?></div>
		<div style="display: flex;justify-content: space-between;">
		</div>
	</div>
	<div class="pagination">

</div>
<script>
	let cords = ['scrollX','scrollY'];
	// Перед закрытием записываем в локалсторадж window.scrollX и window.scrollY как scrollX и scrollY
	window.addEventListener('unload', e => cords.forEach(cord => localStorage[cord] = window[cord]));
	// Прокручиваем страницу к scrollX и scrollY из localStorage (либо 0,0 если там еще ничего нет)
	window.scroll(...cords.map(cord => localStorage[cord]));</script>

	<script type="text/javascript" defer src="/Resources/JS/pagination.js"></script>
	<script type="text/javascript" defer src="/Resources/JS/sort.js"></script>


