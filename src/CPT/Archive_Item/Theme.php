<?php

namespace NCPR\DivinerArchivePlugin\CPT\Archive_Item;

use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\Diviner_Field;
use NCPR\DivinerArchivePlugin\CPT\Diviner_Field\PostMeta as DivinerFieldPostMeta;
use NCPR\DivinerArchivePlugin\CPT\Archive_Item\Post_Meta as Archive_Item_Post_Meta;


/**
 * Class Theme
 *
 * @package Diviner\Post_Types\Archive_Item
 */
class Theme {

	public function hooks() {
		// add_filter( 'embed_oembed_html', [ $this, 'wrap_oembed_html' ], 99, 4 );
		add_filter( 'the_content', [ $this, 'add_fields_to_content' ] );
	}

	/**
	 * Injects the feature archive item media into the content output. Archive items can be either photo,
	 * video, audio, or document
	 *
	 * @param string $content
	 * @return string
	 *
	 */
	static public function add_fields_to_content($content) {
		if (get_post_type() !== Archive_Item::NAME ) {
			return $content;
		}
		// add the main content item

		$type = carbon_get_post_meta( get_the_ID(), Archive_Item_Post_Meta::FIELD_TYPE );
		$show_audio = ( $type === Archive_Item_Post_Meta::FIELD_TYPE_AUDIO || $type === Archive_Item_Post_Meta::FIELD_TYPE_MIXED );
		$show_video = ( $type === Archive_Item_Post_Meta::FIELD_TYPE_VIDEO || $type === Archive_Item_Post_Meta::FIELD_TYPE_MIXED );
		$show_document = ( $type === Archive_Item_Post_Meta::FIELD_TYPE_DOCUMENT || $type === Archive_Item_Post_Meta::FIELD_TYPE_MIXED );
		$show_feature_image = ( $type === Archive_Item_Post_Meta::FIELD_TYPE_PHOTO || $type === Archive_Item_Post_Meta::FIELD_TYPE_MIXED );

		$before = '<div class="diviner__feature-content">';
		if ($show_feature_image) {
			$feature_image = static::render_photo();
			if (!empty($feature_image)) {
				$before .= sprintf(
					'<div class="diviner__content-block diviner__content-block--feature-image">%s</div>',
					$feature_image
				);
			}
		}
		if ($show_audio) {
			$audio_output = '';
			$audio = static::render_audio();
			if (!empty($audio)) {
				$audio_output .= sprintf(
					'<div class="diviner__content-block diviner__content-block--audio">%s</div>',
					$audio
				);
			}
			// oembed audio
			$audio_oembed_output = static::render_oembed_audio();
			if (!empty($audio_oembed_output)) {
				$audio_output .= sprintf(
					'<div class="diviner__content-block diviner__content-block--oembed-audio">%s</div>',
					$audio_oembed_output
				);
			}
			$before .= $audio_output;
		}

		if ($show_video) {
			$video = static::render_oembed_video();
			if (!empty($video)) {
				$before .= sprintf(
					'<div class="diviner__content-block diviner__content-block--video">%s</div>',
					$video
				);
			}
		}

		if ($show_document) {
			$document = static::render_document();
			if (!empty($document)) {
				$before .= sprintf(
					'<div class="diviner__content-block diviner__content-block--document">%s</div>',
					$document
				);
			}
		}

		$before .= '</div>';
		$content = $before . $content;

		// add the fields
		$content .= static::render_meta_fields();
		return $content;
	}

	/**
	 * Prints out the dynamic meta fields related to  a post ide
	 *
	 * @param int | string $post_id
	 * @return string
	 *
	 */
	static public function render_meta_fields($post_id = null) {
		if (!isset($post_id)) {
			$post_id = get_the_ID();
		}
		$active_field_posts_ids = Diviner_Field::get_active_fields();
		$field_output = [];

		foreach($active_field_posts_ids as $active_field_post_id) {
			$field_name = Diviner_Field::get_field_post_meta(
				$active_field_post_id,
				DivinerFieldPostMeta::FIELD_ID
			);
			$field_type = Diviner_Field::get_field_post_meta(
				$active_field_post_id,
				DivinerFieldPostMeta::FIELD_TYPE,
				'carbon_fields_container_field_variables'
			);
			$field_class = Diviner_Field::get_class($field_type);
			if( is_callable( [ $field_class, 'get_value' ] ) ) {
				$field_value = call_user_func( [ $field_class, 'get_value' ], $post_id, $field_name, $active_field_post_id);
			}
			$field_title = get_the_title( $active_field_post_id );
			if (isset($field_value) && !empty($field_value)) {
				$field_output[] = sprintf(
					'<li class="archive-item-meta__item"><label class="archive-item-meta__item-label">%s</label><div class="archive-item-meta__item-value">%s</div></li>',
					$field_title,
					$field_value
				);
			}
		}
		if (count($field_output) == 0) {
			return '';
		} else {
			return sprintf(
				'<div class="diviner__content-block diviner__content-block--fields"><div class="archive-item-meta"><ul class="archive-item-meta__list">%s</ul></div></div>',
				implode( '', $field_output)
			);
		}
	}

	/**
	 * Renders audio oembed with fixed height/width
	 * ToDo use global $wp_embed like with video
	 *
	 * @param int | string $post_id
	 * @return string
	 *
	 */
	static public function render_oembed_audio($post_id = null) {
		if (!isset($post_id)) {
			$post_id = get_the_ID();
		}
		$audio_oembed = carbon_get_post_meta( $post_id, Archive_Item_Post_Meta::FIELD_AUDIO_OEMBED );
		if ( empty($audio_oembed) ) {
			return '';
		}
		$embed = wp_oembed_get(
			$audio_oembed,
			[
				'width' => 700,
				'height' => 81
			]
		);
		if( empty( $embed ) ) {
			return '';
		}
		$output = sprintf(
			'<div class="audio-oembed">%s</div>',
			$embed
		);
		return apply_filters( 'diviner_render_audio_oembed', $output, $audio_oembed );
	}

	/**
	 * Renders audio
	 *
	 * @param int | string $post_id
	 * @return string
	 *
	 */
	static public function render_audio($post_id = null) {
		if (!isset($post_id)) {
			$post_id = get_the_ID();
		}
		$audio = carbon_get_post_meta( $post_id, Archive_Item_Post_Meta::FIELD_AUDIO );
		if ( empty($audio) ) {
			return '';
		}
		$audio_attachment_url = wp_get_attachment_url( $audio );
		$shortcode = sprintf(
			'[audio src="%s"]',
			$audio_attachment_url
		);
		$output = sprintf(
			'<div class="audio-player">%s</div>',
			do_shortcode( $shortcode )
		);
		return apply_filters( 'diviner_render_audio', $output, $audio );
	}

	/**
	 * Renders photo
	 *
	 * @param int | string $post_id
	 * @return string
	 *
	 */
	static public function render_photo($post_id = null) {
		if (!isset($post_id)) {
			$post_id = get_the_ID();
		}

		$thumbnail_id = carbon_get_post_meta( $post_id, Post_Meta::FIELD_PHOTO);

		if ( !isset( $thumbnail_id ) ) {
			return;
		}

		$caption = wp_get_attachment_caption($thumbnail_id);
		$has_caption = !empty($caption);

		$large_image_url = wp_get_attachment_image_src( $thumbnail_id, 'large' );

		// Specifying width of 400 (px) and height of 200 (px).
		$srcset = wp_get_attachment_image_srcset( $thumbnail_id );

		ob_start();
		?>
		<figure>
			<img src="<?php echo $large_image_url[0]; ?>" alt="<?php echo $caption; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" />
			<?php
			if ($has_caption) {
				printf('<figcaption>%s</figcaption>', $caption);
			}
			?>
		</figure>
		<?php
		$output = ob_get_clean();
		$output = sprintf(
			'<div class="diviner__photo">%s</div>',
			$output
		);
		return apply_filters( 'diviner_render_photo', $output, $thumbnail_id );
	}

	/**
	 * Renders oembed video
	 *
	 * @param int | string $post_id
	 * @return string
	 *
	 */
	static public function render_oembed_video($post_id = null) {
		if (!isset($post_id)) {
			$post_id = get_the_ID();
		}
		$video_oembed = carbon_get_post_meta( $post_id, Archive_Item_Post_Meta::FIELD_VIDEO_OEMBED);
		if ( empty($video_oembed) ) {
			return '';
		}
		global $wp_embed;
		$embed = $wp_embed->shortcode( array(), $video_oembed );
		if( empty( $embed ) ) {
			return '';
		}
		$output = sprintf(
			'<div class="video-oembed">%s</div>',
			$embed
		);
		return apply_filters( 'diviner_render_video_oembed', $output, $video_oembed );
	}


	/**
	 * Renders document. Display title in button if there is one... otherwise just download
	 *
	 * @param int | string $post_id
	 * @return string
	 *
	 */
	static public function render_document($post_id = null) {
		if (!isset($post_id)) {
			$post_id = get_the_ID();
		}

		$document = carbon_get_post_meta( $post_id, Archive_Item_Post_Meta::FIELD_DOCUMENT);
		if (empty($document)) {
			return '';
		}
		$document_attachment_url = wp_get_attachment_url( $document );
		$document_attachment_title = get_the_title( (int)$document );
		$download_text = __( 'Download', 'diviner-archive' );
		if (!empty($document_attachment_title )) {
			$download_text = sprintf(
				__( 'Download %s', 'diviner-archive' ),
				$document_attachment_title
			);
		}

		$output = sprintf(
			'<div class="document"><a href="%s" class="btn"><i class="fas fa-download" aria-hidden="true"></i><span>%s</span></a></div>',
			$document_attachment_url,
			$download_text
		);
		return apply_filters( 'diviner_render_document_download', $output, $document );
	}

}
