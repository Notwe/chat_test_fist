<div class='background_blure'>
</div>

<form method=post class="register_form">
	<a href="?page=index"></a>
	<h2>Введите ваши данные</h2>
	<input type=text size="30" name=login_reg placeholder="Имя" value="<?php echo @$_POST['login_reg']; ?>"><br><br>
	<input type=password size="30" name=pass_reg placeholder="Пароль"><br><br>
	<input type=password size="30" name=pass2_reg placeholder="Подтвердите пароль"><br><br>
	<input type=submit size="30" name=reg value="Зарегистрироваться">
	<ul>
		<?php
		   foreach($error_messages as $error_message) { ?>
		<li>Ошибка!<br><?=$error_message;?></li>
		<?php
		   }
		?>
	</ul>
</form>