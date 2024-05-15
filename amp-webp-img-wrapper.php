<?php
/**
 * AMP WebP Img Wrapper
 *
 * @package   AMP_WebP_Img_Wrapper
 * @author    Weston Ruter, Google
 * @link      https://gist.github.com/westonruter/332abdb2adefc6b204ad6fcc1beecedf
 * @license   GPL-2.0-or-later
 * @copyright 2019 Google Inc.
 *
 * @wordpress-plugin
 * Plugin Name: AMP WebP Img Wrapper
 * Plugin URI: https://gist.github.com/westonruter/332abdb2adefc6b204ad6fcc1beecedf
 * Description: Wrap all generated amp-img elements with another amp-img that points to a WebP.
 * Version: 0.1
 * Author: Weston Ruter, Google
 * Author URI: https://weston.ruter.net/
 * License: GNU General Public License v2 (or later)
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Gist Plugin URI: https://gist.github.com/westonruter/332abdb2adefc6b204ad6fcc1beecedf
 */

namespace AMP_WebP_Img_Wrapper;

/**
 * Filter sanitizers.
 *
 * @param array $sanitizers Sanitizers.
 * @return array Sanitizers.
 */
function filter_sanitizers( $sanitizers ) {
	require_once __DIR__ . '/class-sanitizer.php';

	return array_merge(
		$sanitizers,
		[
			__NAMESPACE__ . '\Sanitizer' => [],
		]
	);
}
add_filter( 'amp_content_sanitizers', __NAMESPACE__ . '\filter_sanitizers' );
