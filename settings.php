<?php

/** @var \BernBadge\Badge[] $bern_badges */
$bern_badges = $this->get_bern_badges();

/** @var \BernBadge\BAdge $badge */
$badge = $this->get_bern_badge();

?>

<div class='wrap'>

	<h2>
		Bern Badge <?php _e( 'Settings', 'bern-badge' ); ?>
	</h2>

	<form method="post" action="options.php" autocomplete="off">

		<?php

		settings_fields( 'bern_badge_settings' );
		do_settings_sections( 'bern_badge_settings' );

		?>

	</form>

</div>