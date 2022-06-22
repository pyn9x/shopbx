<?php
$helper=App\Lib\Helper::getInstance();
?>

<div class="bloc2">
	<div class="bloc2-cont">
		<div style="padding: 3px 0; display: flex; align-items: center;">
			<div id="accordionPanelsStayOpenExample">
				<div style="border: none" class="accordion-item">
					<form style="background-color: #6e6e6e; " method="post">
						<div class="accordion-item-bloc1">
							<div style="    background-color: #6e6e6e" class="accordion-item-bloc2">
								<p class="accordion-item-bloc2-text">Текущий пароль</p>
								<input type="password" class="inpit-me-order form-control" id="currentPassword" value="" required placeholder="Введите текущий пароль">
								<input class="form-application-input" style="display: none" type="hidden" id="csrf_token" name="csrf_token" value="<?=$helper::generateFormCsrfToken()?>">
							</div>
						</div>
						<div class="accordion-item-bloc1">
							<div style="    background-color: #6e6e6e" class="accordion-item-bloc2">
								<p class="accordion-item-bloc2-text">Новый пароль</p>
								<input type="password" class="inpit-me-order form-control" id="newPassword" required placeholder="Введите новый пароль" value="">
							</div>
						</div>
						<div class="accordion-item-bloc1">
							<div style="    background-color: #6e6e6e" class="accordion-item-bloc2">
								<p class="accordion-item-bloc2-text">Повторите новый пароль</p>
								<input type="password" class="inpit-me-order form-control" id="repeatNewPassword" required placeholder="Повторите новый пароль" value="">
							</div>
						</div>
						<div class="accordion-item-bloc1">
							<div style="    background-color: #6e6e6e" class="accordion-item-bloc2">
								<a style="margin-left: 10px" href="javascript:void(0)" class="admin-navbar-list-a" id="userChangePassword">Сохранить</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
