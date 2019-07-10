<?php if ( $model->errors ) { ?>
	<ul>
		<?php foreach ( $model->errors as $key => $errors ) { ?>
			<?php foreach ( $errors as $error ) { ?>
				<li><?= $error?></li>
			<?php } ?>
		<?php } ?>
	</ul>
<?php } ?>