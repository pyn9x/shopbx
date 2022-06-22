<?php /** @var array $typeTags */ ?>
<div id="tagsList">
<div class="bloc2">
	<div class="bloc2-cont">
		<?php
		$counter = 1;
		?>
		<?php foreach ($typeTags as $typeTag):?>
			<div style="padding: 3px 0; display: flex; align-items: center;">
				<p class="accordion-item-bloc2-text-help">№<?=$counter?></p>
				<div id="accordionPanelsStayOpenExample">
					<div style="border: none" class="accordion-item">
						<form style="background-color: #6e6e6e; " method="post">
							<div class="accordion-item-bloc1">
								<div style="    background-color: #6e6e6e" class="accordion-item-bloc2">
									<p class="accordion-item-bloc2-text">Тип</p>
									<input class="inpit-me-order form-control" id="typeTagName_<?=$typeTag->getId()?>" value="<?=$typeTag->getName()?> " disabled>
									<a style="margin-left: 10px" href="javascript:void(0)" onclick="typeTagEditAjax('<?=$typeTag->getId()?>','typeTagName_<?=$typeTag->getId()?>','typeTagNameLink_<?=$typeTag->getId()?>')" class="admin-navbar-list-a" id="typeTagNameLink_<?=$typeTag->getId()?>">Изменить</a>
									<? if ($typeTag->getTypeTagBindTag()==0){?>
										<a style="margin-left: 10px" href="javascript:void(0)" onclick="typeTagDeleteAjax('<?=$typeTag->getId()?>')" class="admin-navbar-list-a ">Удалить</a>
									<?} else {?>
										<a style="margin-left: 10px" href="javascript:void(0)" onclick="alert('Удалить нельзя! У данного типа есть тэги');" class="admin-navbar-list-a ">Удалить</a>
									<? } ?>
								</div>
								<button style="border: none;    background-color: #6e6e6e;" class="bitawe collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?=$counter?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?=$counter?>">+</button>
							</div>
							<div id="panelsStayOpen-collapse<?=$counter?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading<?=$counter?>">
								<?php
								foreach ($typeTag->getTagsBelong() as $tagsBelong):
									?>
									<div  style="margin-top:10px;    background-color: #6e6e6e;display: flex; align-items: center;justify-content: center;"  class="accordion-item-bloc3">
										<p style="margin-right: 56px;" class="accordion-item-bloc2-text">Значение</p>
										<input style="max-width: 300px;" class="inpit-me-order form-control" id="tagName_<?=$tagsBelong->getId()?>" value="<?=$tagsBelong->getName()?> " disabled>
										<a style="margin-left: 10px" href="javascript:void(0)" onclick="tagEditAjax('<?=$tagsBelong->getId()?>','tagName_<?=$tagsBelong->getId()?>','tagNameLink_<?=$tagsBelong->getId()?>')" class="admin-navbar-list-a" id="tagNameLink_<?=$tagsBelong->getId()?>">Изменить</a>
										<? if ($tagsBelong->getTagBindProduct()==0){?>
											<a style="margin-left: 10px" href="javascript:void(0)" onclick="tagDeleteAjax('<?=$tagsBelong->getId()?>')" class="admin-navbar-list-a ">Удалить</a>
										<?} else {?>
											<a style="margin-left: 10px" href="javascript:void(0)" onclick="alert('Удалить нельзя! Тэг привязан к эскурсиям');" class="admin-navbar-list-a ">Удалить</a>
										<? } ?>
									</div>
								<?php endforeach;?>
								<div  style="margin-top:10px;    background-color: #6e6e6e;display: flex; align-items: center;justify-content: center;"  class="accordion-item-bloc3">
									<p style="margin-right: 56px;" class="accordion-item-bloc2-text">Значение</p>
									<input style="max-width: 500px;" class="inpit-me-order form-control" id="typeTag_<?=$typeTag->getId()?>_TagCreate" value="">
									<a style="margin-left: 10px" href="javascript:void(0)" onclick="tagCreateAjax('<?=$typeTag->getId()?>','typeTag_<?=$typeTag->getId()?>_TagCreate')" class="admin-navbar-list-a ">Создать</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php $counter = $counter+1;
		endforeach;?>
		<div style="padding: 3px 0; display: flex; align-items: center;">
			<p class="accordion-item-bloc2-text-help">№<?=$counter?></p>
			<div id="accordionPanelsStayOpenExample">
				<div style="border: none" class="accordion-item">
					<form style="    background-color: #6e6e6e; " method="post">
						<div class="accordion-item-bloc1">
							<div style="    background-color: #6e6e6e" class="accordion-item-bloc2">
								<p class="accordion-item-bloc2-text">Тип</p>
								<input class="inpit-me-order form-control" id="typeTagCreate" value="">
								<a href="javascript:void(0)" onclick="typeTagCreateAjax('typeTagCreate')" class="admin-navbar-list-a" id="typeTagNameLinkCreate">Создать</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>