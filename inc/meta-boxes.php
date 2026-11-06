<?php
/**
 * Post and product option meta boxes.
 *
 * The meta keys are the ones the theme has always used, so existing values keep working.
 *
 * @package 10011mag
 */

/**
 * Returns the meta box definitions, keyed by meta box ID.
 *
 * @return array
 */
function mag10011_meta_box_definitions() {
	return array(
		'mag10011-post-options'    => array(
			'title'      => __( 'Post Options', '10011mag' ),
			'post_types' => array( 'post' ),
			'fields'     => array(
				'bb_featured'  => array(
					'label'   => __( 'Featured layout', '10011mag' ),
					'type'    => 'select',
					'options' => array(
						'not_featured' => __( 'Not featured', '10011mag' ),
						'featured'     => __( 'Featured', '10011mag' ),
					),
				),
				'bb_sub_title' => array(
					'label' => __( 'Subtitle', '10011mag' ),
					'type'  => 'text',
				),
			),
		),
		'mag10011-product-options' => array(
			'title'      => __( 'Product Options', '10011mag' ),
			'post_types' => array( 'product' ),
			'fields'     => array(
				'product-brand-name' => array(
					'label' => __( 'Brand name', '10011mag' ),
					'type'  => 'text',
				),
				'product-brand-link' => array(
					'label' => __( 'Brand link', '10011mag' ),
					'type'  => 'url',
				),
				'product-buy-link'   => array(
					'label' => __( 'Buy link', '10011mag' ),
					'type'  => 'url',
				),
			),
		),
	);
}

/**
 * Registers the meta boxes.
 */
function mag10011_add_meta_boxes() {
	foreach ( mag10011_meta_box_definitions() as $id => $box ) {
		add_meta_box( $id, $box['title'], 'mag10011_render_meta_box', $box['post_types'], 'normal', 'default', $box );
	}
}
add_action( 'add_meta_boxes', 'mag10011_add_meta_boxes' );

/**
 * Renders a meta box.
 *
 * @param WP_Post $post    Current post.
 * @param array   $metabox Meta box arguments, with the definition in 'args'.
 */
function mag10011_render_meta_box( $post, $metabox ) {
	wp_nonce_field( 'mag10011_save_meta', 'mag10011_meta_nonce' );

	echo '<table class="form-table" role="presentation"><tbody>';

	foreach ( $metabox['args']['fields'] as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		$id    = 'mag10011-' . $key;

		echo '<tr><th scope="row"><label for="' . esc_attr( $id ) . '">' . esc_html( $field['label'] ) . '</label></th><td>';

		if ( 'select' === $field['type'] ) {
			echo '<select id="' . esc_attr( $id ) . '" name="' . esc_attr( $key ) . '">';
			foreach ( $field['options'] as $option_value => $option_label ) {
				echo '<option value="' . esc_attr( $option_value ) . '"' . selected( $value, $option_value, false ) . '>' . esc_html( $option_label ) . '</option>';
			}
			echo '</select>';
		} else {
			echo '<input class="regular-text" type="' . esc_attr( $field['type'] ) . '" id="' . esc_attr( $id ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" />';
		}

		echo '</td></tr>';
	}

	echo '</tbody></table>';
}

/**
 * Saves the meta box values.
 *
 * @param int $post_id Post ID.
 */
function mag10011_save_meta_boxes( $post_id ) {
	if ( ! isset( $_POST['mag10011_meta_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['mag10011_meta_nonce'] ) ), 'mag10011_save_meta' ) ) {
		return;
	}

	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || wp_is_post_revision( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$post_type = get_post_type( $post_id );

	foreach ( mag10011_meta_box_definitions() as $box ) {
		if ( ! in_array( $post_type, $box['post_types'], true ) ) {
			continue;
		}

		foreach ( $box['fields'] as $key => $field ) {
			$raw = isset( $_POST[ $key ] ) && is_string( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Sanitized below by field type.

			if ( 'select' === $field['type'] ) {
				$value = array_key_exists( $raw, $field['options'] ) ? $raw : '';
			} elseif ( 'url' === $field['type'] ) {
				$value = esc_url_raw( $raw );
			} else {
				$value = sanitize_text_field( $raw );
			}

			if ( '' === $value ) {
				delete_post_meta( $post_id, $key );
			} else {
				update_post_meta( $post_id, $key, $value );
			}
		}
	}
}
add_action( 'save_post', 'mag10011_save_meta_boxes' );
