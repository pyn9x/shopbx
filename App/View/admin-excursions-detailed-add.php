<?php

/** @var array $typeTags */

?>


<div style="color: white" class="admin-excursions-detaild">
	<form action="/admin/excursion/create" method="post">
		<div style="display: flex">
			<div class="admin-excursions-detaild-bloc1">
				<h1>Вид карты</h1>
				<div>
					<input style="display: none " type="text" class="input-me form-control" id="inlineFormInputName" name="id" value="">
					<p>Страна</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="country" value="">
					<p>Название города</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="city" value="">
					<p>Температура</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="degrees" value="">
					<p>Цена</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="price" value="">
				</div>
				<div>
					<p>Интернет</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="iRating" value="">
					<p>Развлечения</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="eRating" value="">
					<p>Обслуживание</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="sRating" value="">
				</div>
				<div>
					<div class="form-row">
						<label>Изображения:</label>
						<div class="img-list" id="fileImageList"></div>
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
					<p><select style="width: 250px;height: 100px;margin: 5px;" class="input-me form-control" size="3" multiple  name="select_typeTag_<?=$typeTag->getId()?>[]">
						<option disabled><?=$typeTag->getName()?></option>
						<?php foreach ($typeTag->getTagsBelong() as $tagsBelong): ?>
							<option value="<?=$tagsBelong->getId()?>"><?=$tagsBelong->getName()?></option>
						<?endforeach;?>
					</select></p>
					<?endforeach;?>
					</div>
					<p>Время</p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="duration" value="">
					<p>Размер группы </p>
					<input type="text" class="input-me form-control" id="inlineFormInputName" name="person" value="">
					<p>Описание экскурсии</p>
					<textarea style="width: 400px;height: 130px;" class="form-control" id="exampleFormControlTextarea1" name = 'description'></textarea>
				</div>
			</div>
		</div>
		<div class="admin-excursions-detaild-bloc4">
			<a href="/admin/excursions" class="admin-navbar-list-a">Назад</a>
			<input class="admin-excursions-detaild-bloc4-input admin-input-color-2" type="submit" value="Сохранить">
		</div>
	</form>
</div>
