<?php

/**
 * Remove Query Strings - Admin Form class
 *
 * @package Remove Query Strings
 * @subpackage Remove Query Strings Admin
 */
class RMQRST_Admin_Form {



	/**
	 * Main admin form
	 */
	public static function show() {

		// Dependencies
		require_once(RMQRST_PATH.'/core/data.php');

		// Check form submit
		if (isset($_POST['rmqrst-nonce'])) {

			// Check valid nonce
			if (!wp_verify_nonce($_POST['rmqrst-nonce'], RMQRST_FILE)) {
				$error = 'Invalid security code, please try to submit the form again.';

			// Valid
			} else {

				// Save data
				RMQRST_Core_Data::set_args($_POST['rmqrst-args']);

				// Done
				$success = true;
			}
		}

		?><div class="wrap">

			<h1>Remove Query Strings</h1>

			<?php if (isset($success)) : ?><div class="notice notice-success"><p>Data saved successfully.</p></div><?php endif; ?>

			<form method="post">

				<input type="hidden" name="rmqrst-nonce" value="<?php echo wp_create_nonce(RMQRST_FILE); ?>" />

				<p>Add here the URL args you want to disable (one arg per each line):</p>
				<p><textarea name="rmqrst-args" class="regular-text" rows="10" style="width: 400px;"><?php echo esc_html(implode("\n", RMQRST_Core_Data::get_args(false))); ?></textarea></p>

				<p><input type="submit" class="button button-primary" value="<?php esc_attr_e('Save'); ?>" /></p>

			</form>

		</div><?php
	}



}
