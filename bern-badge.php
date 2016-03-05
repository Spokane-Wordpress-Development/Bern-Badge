<?php

/**
* Plugin Name: Bern Badge
* Plugin URI: https://www.spokanewp.com/portfolio
* Description: Show your support for Bernie Sanders by adding a badge to the top corner of your website.
* Author: Spokane WordPress Development
* Author URI: http://www.spokanewp.com
* Version: 1.1.0
* Text Domain: bern-badge
* Domain Path: /languages
*
* Copyright 2016 Spokane WordPress Development
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License, version 2, as
* published by the Free Software Foundation.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*
*/

namespace BernBadge;

class Badge {

	const VERSION = '1.0.0';
	const VERSION_CSS = '1.0.0';
	const VERSION_JS = '1.0.0';
	const STYLES = 1;

	private $name;
	private $color;
	private $position;
	private $language;
	private $style;

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 *
	 * @return Badge
	 */
	public function setName( $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getColor() {
		return $this->color;
	}

	/**
	 * @param mixed $color
	 *
	 * @return Badge
	 */
	public function setColor( $color ) {
		$this->color = $color;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * @param mixed $position
	 *
	 * @return Badge
	 */
	public function setPosition( $position ) {
		$this->position = $position;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLanguage() {
		return $this->language;
	}

	/**
	 * @param mixed $language
	 *
	 * @return Badge
	 */
	public function setLanguage( $language ) {
		$this->language = $language;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStyle() {
		return $this->style;
	}

	/**
	 * @param mixed $style
	 *
	 * @return Badge
	 */
	public function setStyle( $style ) {
		$this->style = $style;

		return $this;
	}

	public function init()
	{
		$bern_badge = $this->get_bern_badge();

		wp_enqueue_script( 'bern-badge-js', plugin_dir_url( __FILE__ ) . 'bern-badge.js', array( 'jquery' ), (WP_DEBUG) ? time() : self::VERSION_JS, TRUE );
		wp_localize_script( 'bern-badge-js', 'bern_badge', array(
			'class' => $bern_badge->getName(),
			'color' => $bern_badge->getColor(),
			'position' => $bern_badge->getPosition(),
			'admin_bar' => ( is_admin_bar_showing() ) ? 1 : 0
		) );
		wp_enqueue_style( 'bern-badge-css', plugin_dir_url( __FILE__ ) . 'bern-badge.css', array(), (WP_DEBUG) ? time() : self::VERSION_CSS );
	}

	public function admin_init()
	{
		wp_enqueue_script( 'bern-badge-admin-js', plugin_dir_url( __FILE__ ) . 'admin.js', array( 'jquery' ), (WP_DEBUG) ? time() : self::VERSION_JS, TRUE );
		wp_enqueue_style( 'bern-badge-admin-css', plugin_dir_url( __FILE__ ) . 'admin.css', array(), (WP_DEBUG) ? time() : self::VERSION_CSS );
	}

	public function register_settings()
	{
		register_setting( 'bern_badge_settings', 'bern_badge' );
	}

	/**
	 * @param array $links
	 *
	 * @return array
	 */
	public function settings_link( $links )
	{
		$link = '<a href="options-general.php?page=' . plugin_basename( __FILE__ ) . '">' . __( 'Settings', 'bern-badge' ) . '</a>';
		$links[] = $link;
		return $links;
	}

	public function settings_page()
	{
		add_options_page(
			'Bern Badge ' . __( 'Settings', 'bern-badge' ),
			'Bern Badge',
			'manage_options',
			plugin_basename( __FILE__ ),
			array( $this, 'print_settings_page')
		);
	}

	public function print_settings_page()
	{
		include( 'settings.php' );
	}

	/**
	 * @return array
	 */
	public function get_colors()
	{
		return array(
			'B' => __( 'Blue', 'bern-badge' ),
			'R' => __( 'Red', 'bern-badge' )
		);
	}

	/**
	 * @return array
	 */
	public function get_positions()
	{
		return array(
			'L' => __( 'Left', 'bern-badge'),
			'R' => __( 'Right', 'bern-badge' )
		);
	}

	/**
	 * @return array
	 */
	public function get_languages()
	{
		return array(
			'en' => __( 'English', 'bern-badge' )
		);
	}

	/**
	 * @return Badge[]
	 */
	public function get_bern_badges()
	{
		$colors = $this->get_colors();
		$positions = $this->get_positions();
		$languages = $this->get_languages();

		$bern_badges = array();
		for ( $x=1; $x<=self::STYLES; $x++ )
		{
			foreach ( $colors as $ci => $color )
			{
				foreach ( $positions as $pi => $position )
				{
					foreach ( $languages as $abbr => $language )
					{
						$index = $ci . '-' . $pi . '-' . $abbr . '-' . $x;
						$badge = new Badge;
						$badge
							->setName( $index )
							->setColor( $ci )
							->setPosition( $pi )
							->setLanguage( $abbr )
							->setStyle( $x );
						$bern_badges[ $badge->getName() ] = $badge;
					}
				}
			}
		}

		return $bern_badges;
	}

	/**
	 * @return Badge
	 */
	public function get_bern_badge()
	{
		$bern_badges = $this->get_bern_badges();
		$bern_badge = get_option( 'bern_badge', '' );

		if ( array_key_exists( $bern_badge, $bern_badges ) )
		{
			return $bern_badges[ $bern_badge ];
		}
		else
		{
			foreach ( $bern_badges as $bern_badge )
			{
				return $bern_badge;
			}
		}

		/**
		 * This statement will never be reached,
		 * but Storm wanted me to return something
		 * because it doesn't know that $bern_badges cannot be empty
		 */
		return FALSE;
	}
}

$controller = new Badge;

if ( ! is_admin() )
{
	/* enqueue js and css */
	add_action( 'init', array( $controller, 'init' ) );
}
else
{
	/* enqueue js and css */
	add_action( 'init', array( $controller, 'admin_init' ) );

	/* register settings */
	add_action( 'admin_init', array( $controller, 'register_settings' ) );

	/* add the settings page link */
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $controller, 'settings_link' ) );

	/* add the settings page */
	add_action( 'admin_menu', array( $controller, 'settings_page' ) );
}