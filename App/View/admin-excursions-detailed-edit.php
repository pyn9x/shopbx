<?php
/** @var \App\Entity\Excursion $excursion */
/** @var array $typeTags */
$helper = App\Lib\Helper::getInstance();
var_dump($excursion->getImageList());
?>
<div style="color: white" class="admin-excursions-detaild">
	<form action="/admin/excursions/saved" method="post">
		<div style="display: flex">
			<div class="admin-excursions-detaild-bloc1">
				<h1>Вид карты</h1>
				<div>
					<input style="display: none " type="text" class="input-me form-control" id="inlineFormInputName" name="id" value="<?= $excursion->getId() ?>">
					<p>страна</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="country" value="<?= $excursion->getNameCountry();?>">
					<p>Название города</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="city" value="<?= $excursion->getNameCity();?>">
					<p>температура</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="degrees" value="<?= $excursion->getDegrees();?>">
					<p>цена</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="price" value="<?= $excursion->getPrice();?>">
				</div>
				<div>
					<p>Интернет</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="iRating" value="<?= $excursion->getInternetRating();?>">
					<p>Развлечения</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="eRating" value="<?= $excursion->getEntertainmentRating();?>">
					<p>Обслуживание</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="sRating" value="<?= $excursion->getServiceRating();?>">
					<input style="display: none" type="text" disabled class="input-me form-control" id="inlineFormInputName" name="Rating" value="<?=$helper::calculationRating($excursion->getInternetRating(),$excursion->getEntertainmentRating(),$excursion->getServiceRating());?>">
				</div>
				<div>
					<div class="form-row">
						<label>Изображения:</label>
						<?if (!$excursion->getImageList()) {?>
							<div class="img-list" id="fileImageList"></div>
						<? } else {?>
							<div class="img-list" id="fileImageList">
								<div class='img-item' id='imageFile'>
									<?
									$tmpFolder= "/Upload/Images/Temp/";
									$info = pathinfo($_SERVER['DOCUMENT_ROOT'].$tmpFolder.$excursion->getImageList());
									$thumb = $helper->createPreaviewImage($excursion->getImageList(),$tmpFolder.$info['filename']."-thumb.".$info['extension']);
									?>
									<img src="<?=$thumb?>">
									<input name='imageFileOriginal' type='hidden' value='old'>
									<input name='imageFilePreview' type='hidden' value='<?=$thumb?>'>
								</div>
							</div>
						<? } ?>
						<input id="fileImage" type="file" name="file[]" accept=".jpg,.jpeg,.png,.gif">
					</div>
				</div>
			</div>
			<div class="admin-excursions-detaild-bloc3">
				<h1>Детальная страница</h1>
				<div style="display: flex; align-items: center;justify-content: center;flex-direction: column;">
					<p>Теги</p>
					<div style="display: flex;  flex-wrap: wrap; align-items: center;justify-content: center;">
					<?php foreach ($typeTags as $typeTag):?>
						<p><select style="width: 250px;height: 100px;margin: 5px;" size="3" class="input-me form-control" multiple  name="select_typeTag_<?=$typeTag->getId()?>[]">
								<option disabled><?=$typeTag->getName()?></option>
								<?php foreach ($typeTag->getTagsBelong() as $tagsBelong): ?>
								<? if (in_array($tagsBelong->getName(),$excursion->getTagList())){?>
										<option selected value="<?=$tagsBelong->getId()?>"><?=$tagsBelong->getName()?></option>
									<?} else {?>
										<option value="<?=$tagsBelong->getId()?>"><?=$tagsBelong->getName()?></option>
									<? }?>
								<?endforeach;?>
							</select></p>
					<?endforeach;?>
					</div>
					<p>Время</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="duration" value="<?= $excursion->getDuration();?>">
					<p>Размер группы </p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="person" value="<?= $excursion->getCountPersons();?>">
					<p>Описание экскурсии</p>
					<textarea style="width: 400px;height: 130px;" class="form-control" id="exampleFormControlTextarea1" name = 'description'><?= $excursion->getFullDescription();?></textarea>
				</div>
			</div>
		</div>
		<div class="admin-excursions-detaild-bloc4">
			<a href="/admin/excursions" class="admin-navbar-list-a">Назад</a>
			<input class="admin-excursions-detaild-bloc4-input admin-input-color-2" type="submit" value="Сохранить">
			<input class="admin-excursions-detaild-bloc4-input admin-input-color-3" type="submit" value="Удалить">
		</div>
	</form>
</div>
