<?php

namespace WPForms\Pro\Forms\Fields\Phone;

use WPForms\Forms\Fields\Phone\Field as FieldLite;

/**
 * Editing Address field entries.
 *
 * @since 1.6.0
 */
class EntriesEdit extends \WPForms\Pro\Forms\Fields\Base\EntriesEdit {

	/**
	 * Constructor.
	 *
	 * @since 1.6.0
	 */
	public function __construct() {

		parent::__construct( 'phone' );
	}

	/**
	 * Enqueues for the Edit Entry page.
	 *
	 * @since 1.6.0
	 */
	public function enqueues() {

		$min = wpforms_get_min_suffix();

		// International Telephone Input library CSS.
		wp_enqueue_style(
			'wpforms-smart-phone-field',
			WPFORMS_PLUGIN_URL . "assets/pro/css/fields/phone/intl-tel-input{$min}.css",
			[],
			FieldLite::INTL_VERSION
		);

		// Load International Telephone Input library - https://github.com/jackocnr/intl-tel-input.
		wp_enqueue_script(
			'wpforms-smart-phone-field',
			WPFORMS_PLUGIN_URL . 'assets/pro/lib/intl-tel-input/intlTelInputWithUtils.min.js',
			[],
			FieldLite::INTL_VERSION,
			true
		);

		wp_enqueue_script(
			'wpforms-smart-phone-field-core',
			WPFORMS_PLUGIN_URL . "assets/pro/js/frontend/fields/phone{$min}.js",
			[ 'wpforms-smart-phone-field' ],
			WPFORMS_VERSION,
			true
		);

		// Load jQuery input mask library - https://github.com/RobinHerbots/jquery.inputmask.
		wp_enqueue_script(
			'wpforms-maskedinput',
			WPFORMS_PLUGIN_URL . 'assets/lib/jquery.inputmask.min.js',
			[ 'jquery' ],
			'5.0.9',
			true
		);
	}
}
