<?php

/** @var \BernBadge\Badge[] $bern_badges */
$bern_badges = $this->get_bern_badges();

/** @var \BernBadge\Badge $my_badge */
$my_badge = $this->get_bern_badge();

?>

<div class='wrap'>

	<h2>
		Bern Badge <?php _e( 'Settings', 'bern-badge' ); ?>
	</h2>

	<form method="post" action="<?php echo 'options.php'; /* your move, PhpStorm! */ ?>" autocomplete="off" class="bern-badge-form">

		<?php

		settings_fields( 'bern_badge_settings' );
		do_settings_sections( 'bern_badge_settings' );

		?>

		<input type="hidden" name="bern_badge" id="bern_badge" value="<?php echo esc_attr( $my_badge->getName() ); ?>">

		<label for="bern-badge-color">
			<?php _e( 'Color', 'bern-badge' ); ?>:
		</label>
		<select id="bern-badge-color">
			<?php foreach ( $this->get_colors() as $index => $color ) { ?>
				<option value="<?php echo $index; ?>"<?php if ( $index == $my_badge->getColor() ) { ?> selected<?php } ?>>
					<?php echo $color; ?>
				</option>
			<?php } ?>
		</select>

		<label for="bern-badge-position">
			<?php _e( 'Position', 'bern-badge' ); ?>:
		</label>
		<select id="bern-badge-position">
			<?php foreach ( $this->get_positions() as $index => $position ) { ?>
				<option value="<?php echo $index; ?>"<?php if ( $index == $my_badge->getPosition() ) { ?> selected<?php } ?>>
					<?php echo $position; ?>
				</option>
			<?php } ?>
		</select>

		<label for="bern-badge-language">
			<?php _e( 'Language', 'bern-badge' ); ?>:
		</label>
		<select id="bern-badge-language">
			<?php foreach ( $this->get_languages() as $index => $language ) { ?>
				<option value="<?php echo $index; ?>"<?php if ( $index == $my_badge->getLanguage() ) { ?> selected<?php } ?>>
					<?php echo $language; ?>
				</option>
			<?php } ?>
		</select>

		<label for="bern-badge-style">
			<?php _e( 'Style', 'bern-badge' ); ?>:
		</label>
		<select id="bern-badge-style">
			<?php for ( $x=1; $x<=\BernBadge\Badge::STYLES; $x++ ) { ?>
				<option value="<?php echo $x; ?>"<?php if ( $x == $my_badge->getStyle() ) { ?> selected<?php } ?>>
					<?php echo $x; ?>
				</option>
			<?php } ?>
		</select>

		<label for="bern-badge-language">
			Bern Badge:
		</label>

		<div class="bern-badge" id="my-bern-badge" data-current-class=""></div>

		<?php submit_button(); ?>

	</form>

</div>