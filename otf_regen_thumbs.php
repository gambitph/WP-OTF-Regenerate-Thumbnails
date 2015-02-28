<?php
/*
Plugin Name: OTF Regenerate Thumbnails
Plugin URI: http://github.com
Description: Automatically regenerates your thumbnails on the fly (OTF) after changing the thumbnail sizes or switching themes.
Author: Benjamin Intal - Gambit Technologies Inc
Version: 0.3
Author URI: http://gambit.ph
*/

/**
 * Simple but effectively resizes images on the fly. Doesn't upsize, just downsizes like how WordPress likes it.
 * If the image already exists, it's served. If not, the image is resized to the specified size, saved for
 * future use, then served.
 *
 * @author	Benjamin Intal - Gambit Technologies Inc
 * @see https://wordpress.stackexchange.com/questions/53344/how-to-generate-thumbnails-when-needed-only/124790#124790
 * @see http://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
 */
if ( ! function_exists( 'gambit_otf_regen_thumbs_media_downsize' ) ) {
	
	add_filter( 'image_downsize', 'gambit_otf_regen_thumbs_media_downsize', 10, 3 );
	
	/**
	 * The downsizer. This only does something if the existing image size doesn't exist yet.
	 *
	 * @param	$out boolean false
	 * @param	$id int Attachment ID
	 * @param	$size mixed The size name, or an array containing the width & height
	 * @return	mixed False if the custom downsize failed, or an array of the image if successful
	 */
	function gambit_otf_regen_thumbs_media_downsize( $out, $id, $size ) {

		// Gather all the different image sizes of WP (thumbnail, medium, large) and,
		// all the theme/plugin-introduced sizes.
		global $_gambit_otf_regen_thumbs_all_image_sizes;
		if ( ! isset( $_gambit_otf_regen_thumbs_all_image_sizes ) ) {
			global $_wp_additional_image_sizes;
			
			$_gambit_otf_regen_thumbs_all_image_sizes = array();
			$interimSizes = get_intermediate_image_sizes();
			
			foreach ( $interimSizes as $sizeName ) {
				if ( in_array( $sizeName, array( 'thumbnail', 'medium', 'large' ) ) ) {

					$_gambit_otf_regen_thumbs_all_image_sizes[ $sizeName ]['width'] = get_option( $sizeName . '_size_w' );
					$_gambit_otf_regen_thumbs_all_image_sizes[ $sizeName ]['height'] = get_option( $sizeName . '_size_h' );
					$_gambit_otf_regen_thumbs_all_image_sizes[ $sizeName ]['crop'] = (bool) get_option( $sizeName . '_crop' );

				} elseif ( isset( $_wp_additional_image_sizes[ $sizeName ] ) ) {

					$_gambit_otf_regen_thumbs_all_image_sizes[ $sizeName ] = $_wp_additional_image_sizes[ $sizeName ];
				}
			}
		}
		
		// This now contains all the data that we have for all the image sizes
		$allSizes = $_gambit_otf_regen_thumbs_all_image_sizes;
	
		// If image size exists let WP serve it like normally
		$imagedata = wp_get_attachment_metadata( $id );
	
		// Image attachment doesn't exist
		if ( ! is_array( $imagedata ) ) {
			return false;
		}
		
		// If the size given is a string / a name of a size
		if ( is_string( $size ) ) {
			
			// If WP doesn't know about the image size name, then we can't really do any resizing of our own
			if ( empty( $allSizes[ $size ] ) ) {
				return false;
			}
		
			// If the size has already been previously created, use it
			if ( ! empty( $imagedata['sizes'][ $size ] ) && ! empty( $allSizes[ $size ] ) ) {
			
				// But only if the size remained the same
				if ( $allSizes[ $size ]['width'] == $imagedata['sizes'][ $size ]['width']
				&& $allSizes[ $size ]['height'] == $imagedata['sizes'][ $size ]['height'] ) {
					return false;
				}
			
				// Or if the size is different and we found out before that the size really was different
				if ( ! empty( $imagedata['sizes'][ $size ][ 'width_query' ] )
				&& ! empty( $imagedata['sizes'][ $size ]['height_query'] ) ) {
					if ( $imagedata['sizes'][ $size ]['width_query'] == $allSizes[ $size ]['width']
					&& $imagedata['sizes'][ $size ]['height_query'] == $allSizes[ $size ]['height'] ) {
						return false;
					}
				}
				
			}
			
			// Resize the image
			$resized = image_make_intermediate_size(
				get_attached_file( $id ),
				$allSizes[ $size ]['width'],
				$allSizes[ $size ]['height'],
				$allSizes[ $size ]['crop']
			);
		
			// Resize somehow failed
			if ( ! $resized ) {
				return false;
			}
		
			// Save the new size in WP
			$imagedata['sizes'][ $size ] = $resized;
			
			// Save some additional info so that we'll know next time whether we've resized this before
			$imagedata['sizes'][ $size ]['width_query'] = $allSizes[ $size ]['width'];
			$imagedata['sizes'][ $size ]['height_query'] = $allSizes[ $size ]['height'];
			
			wp_update_attachment_metadata( $id, $imagedata );
		
			// Serve the resized image
			$att_url = wp_get_attachment_url( $id );
			return array( dirname( $att_url ) . '/' . $resized['file'], $resized['width'], $resized['height'], true );
		
		
		// If the size given is a custom array size
		} else if ( is_array( $size ) ) {
			$imagePath = get_attached_file( $id );
	
			// This would be the path of our resized image if the dimensions existed
			$imageExt = pathinfo( $imagePath, PATHINFO_EXTENSION );
			$imagePath = preg_replace( '/^(.*)\.' . $imageExt . '$/', sprintf( '$1-%sx%s.%s', $size[0], $size[1], $imageExt ) , $imagePath );

			$att_url = wp_get_attachment_url( $id );
		
			// If it already exists, serve it
			if ( file_exists( $imagePath ) ) {
				return array( dirname( $att_url ) . '/' . basename( $imagePath ), $size[0], $size[1], true );
			}

			// If not, resize the image...
			$resized = image_make_intermediate_size(
				get_attached_file( $id ),
				$size[0],
				$size[1],
				true
			);
			
			// Get attachment meta so we can add new size
			$imagedata = wp_get_attachment_metadata( $id );

			// Save the new size in WP so that it can also perform actions on it
			$imagedata['sizes'][ $size[0] . 'x' . $size[1] ] = $resized;		   
			wp_update_attachment_metadata( $id, $imagedata );
				
			// Resize somehow failed
			if ( ! $resized ) {
				return false;
			}
		
			// Then serve it
			return array( dirname( $att_url ) . '/' . $resized['file'], $resized['width'], $resized['height'], true );
		}
	
		return false;
	}
}
