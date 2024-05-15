<?php
/**
 * Sanitizer
 *
 * @package AMP_WebP_Img_Wrapper
 */

namespace AMP_WebP_Img_Wrapper;

use AMP_Base_Sanitizer;
use DOMElement;
use DOMXPath;

/**
 * Class Sanitizer
 */
class Sanitizer extends AMP_Base_Sanitizer {

	/**
	 * Sanitize.
	 */
	public function sanitize() {
		$xpath = new DOMXPath( $this->dom );

		/**
		 * Element.
		 *
		 * @var DOMElement $amp_img
		 */
		foreach ( $xpath->query( '//amp-img' ) as $amp_img ) {

			$src         = $amp_img->getAttribute( 'src' );
			$webp_src    = $this->rewrite_webp_img_url( $src );
			$srcset      = $amp_img->getAttribute( 'srcset' );
			$webp_srcset = $this->rewrite_webp_img_url( $srcset );

			if ( $src !== $webp_src || $srcset !== $webp_srcset ) {
				$webp_amp_img = $amp_img->cloneNode( false );
				if ( $webp_src ) {
					$webp_amp_img->setAttribute( 'src', $webp_src );
				}
				if ( $webp_srcset ) {
					$webp_amp_img->setAttribute( 'srcset', $webp_srcset );
				}
				$amp_img->parentNode->replaceChild( $webp_amp_img, $amp_img );
				$webp_amp_img->appendChild( $amp_img );
				$amp_img->setAttribute( 'fallback', '' );
			}
		}
	}

	/**
	 * Rewrite non-WebP img URL to be WebP.
	 *
	 * @param string $src Image src for non-WebP image.
	 * @return string WebP image URL.
	 */
	private function rewrite_webp_img_url( $src ) {
		return preg_replace(
			'/(?<=\.)(jpg|jpeg|png|gif)(?=$|\?|,|\s)/',
			'webp',
			(string) $src
		);
	}
}
