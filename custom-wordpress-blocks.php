<?php

/**
 * Plugin Name: Custom WordPress Blocks
 * Plugin URI: https://yourpluginwebsite.com
 * Description: A plugin to create multiple custom Gutenberg blocks using the CustomWordPressBlock class.
 * Version: 1.0.0
 * Author: Davis Vilums
 * Author URI: https://yourwebsite.com
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: custom-wordpress-blocks
 * Domain Path: /languages
 */

require_once plugin_dir_path(__FILE__) . 'includes/custom-wordpress-block-class.php';

new CustomWordPressBlock('block-viens', true);
// new CustomWordPressBlock('block-two');
