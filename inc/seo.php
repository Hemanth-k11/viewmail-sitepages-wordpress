<?php
/**
 * Per-page SEO title, description and keywords, plus social tags and schema.
 * Skipped when Rank Math, Yoast or All in One SEO is active.
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

/** True when an SEO plugin handles the head tags. */
function viewmail_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' );
}

/** SEO fields and the post meta keys they are saved under. */
function viewmail_seo_fields() {
	return array(
		'title'       => '_viewmail_seo_title',
		'description' => '_viewmail_seo_description',
		'keywords'    => '_viewmail_seo_keywords',
	);
}

/** One SEO value of a page, or '' if it has none. */
function viewmail_seo_value( $post_id, $field ) {
	$fields = viewmail_seo_fields();
	if ( ! $post_id || ! isset( $fields[ $field ] ) ) {
		return '';
	}
	return trim( (string) get_post_meta( $post_id, $fields[ $field ], true ) );
}

/** Save default SEO text for a built page without overwriting edits. */
function viewmail_seo_seed( $post_id, $seo ) {
	foreach ( viewmail_seo_fields() as $field => $key ) {
		if ( isset( $seo[ $field ] ) && '' === viewmail_seo_value( $post_id, $field ) ) {
			update_post_meta( $post_id, $key, $seo[ $field ] );
		}
	}
}

/** True on a page with its own SEO title when no SEO plugin is active. */
function viewmail_seo_page() {
	return is_singular( 'page' ) && ! viewmail_seo_plugin_active() && '' !== viewmail_seo_value( get_queried_object_id(), 'title' );
}

function viewmail_seo_title( $title ) {
	if ( ! viewmail_seo_page() ) {
		return $title;
	}
	return viewmail_seo_value( get_queried_object_id(), 'title' );
}
add_filter( 'pre_get_document_title', 'viewmail_seo_title', 20 );

/** Image used when the page is shared. */
function viewmail_seo_image() {
	$id = get_queried_object_id();
	if ( $id && has_post_thumbnail( $id ) ) {
		return get_the_post_thumbnail_url( $id, 'full' );
	}
	$logo = viewmail_image_id( 'header-collage' );
	return $logo ? wp_get_attachment_url( $logo ) : VIEWMAIL_URI . '/assets/images/header-collage.jpg';
}

/** Meta tags, Open Graph, Twitter card and JSON-LD in the head. */
function viewmail_seo_head() {
	if ( ! viewmail_seo_page() ) {
		return;
	}
	$id          = get_queried_object_id();
	$title       = viewmail_seo_value( $id, 'title' );
	$description = viewmail_seo_value( $id, 'description' );
	$keywords    = viewmail_seo_value( $id, 'keywords' );
	$url         = get_permalink( $id );
	$image       = viewmail_seo_image();

	if ( $description ) {
		echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	}
	if ( $keywords ) {
		echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '">' . "\n";
	}
	echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
	echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";

	$og = array(
		'og:type'        => 'website',
		'og:site_name'   => get_bloginfo( 'name' ),
		'og:locale'      => 'en_IN',
		'og:title'       => $title,
		'og:description' => $description,
		'og:url'         => $url,
		'og:image'       => $image,
	);
	foreach ( $og as $property => $content ) {
		if ( $content ) {
			echo '<meta property="' . esc_attr( $property ) . '" content="' . esc_attr( $content ) . '">' . "\n";
		}
	}
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $description ) {
		echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
	}
	echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";

	$slug   = get_post_meta( $id, '_viewmail_page', true );
	$schema = '';
	if ( 'services' === $slug ) {
		$schema = viewmail_services_schema( $url, $title, $description );
	} elseif ( 'gallery' === $slug ) {
		$schema = viewmail_gallery_schema( $url, $title, $description );
	}
	if ( $schema ) {
		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'viewmail_seo_head', 2 );

// Avoid a second canonical link.
add_action(
	'wp',
	function () {
		if ( viewmail_seo_page() ) {
			remove_action( 'wp_head', 'rel_canonical' );
		}
	}
);

// "SEO" box under the page editor

function viewmail_seo_add_box() {
	add_meta_box( 'viewmail_seo', __( 'SEO: title, description, keywords', 'viewmail' ), 'viewmail_seo_box', 'page', 'normal', 'default' );
}
add_action( 'add_meta_boxes', 'viewmail_seo_add_box' );

function viewmail_seo_box( $post ) {
	wp_nonce_field( 'viewmail_seo', 'viewmail_seo_nonce' );
	if ( viewmail_seo_plugin_active() ) {
		echo '<p>' . esc_html__( 'An SEO plugin is active, so it controls the search text. Fields below are ignored.', 'viewmail' ) . '</p>';
	}
	$rows = array(
		'title'       => array( __( 'SEO title', 'viewmail' ), 60, __( 'Shown as the blue link in Google. Keep it under 60 characters, main keyword first.', 'viewmail' ) ),
		'description' => array( __( 'Meta description', 'viewmail' ), 155, __( 'The grey text under the link. 120 to 155 characters, with a reason to click.', 'viewmail' ) ),
		'keywords'    => array( __( 'Keywords', 'viewmail' ), 0, __( 'Comma separated. Google ignores this tag, but some directories and other search engines read it.', 'viewmail' ) ),
	);
	foreach ( $rows as $field => $row ) {
		$value = viewmail_seo_value( $post->ID, $field );
		echo '<p><label for="viewmail_seo_' . esc_attr( $field ) . '"><strong>' . esc_html( $row[0] ) . '</strong></label><br>';
		if ( 'description' === $field || 'keywords' === $field ) {
			echo '<textarea class="large-text" rows="3" id="viewmail_seo_' . esc_attr( $field ) . '" name="viewmail_seo_' . esc_attr( $field ) . '" data-max="' . (int) $row[1] . '">' . esc_textarea( $value ) . '</textarea>';
		} else {
			echo '<input type="text" class="large-text" id="viewmail_seo_' . esc_attr( $field ) . '" name="viewmail_seo_' . esc_attr( $field ) . '" value="' . esc_attr( $value ) . '" data-max="' . (int) $row[1] . '">';
		}
		echo '<br><span class="description">' . esc_html( $row[2] );
		if ( $row[1] ) {
			echo ' <span class="viewmail-seo-count" data-for="viewmail_seo_' . esc_attr( $field ) . '"></span>';
		}
		echo '</span></p>';
	}
	?>
	<script>
	( function () {
		document.querySelectorAll( '.viewmail-seo-count' ).forEach( function ( out ) {
			var input = document.getElementById( out.dataset.for );
			var max = parseInt( input.dataset.max, 10 );
			function count() {
				out.textContent = '(' + input.value.length + ' / ' + max + ')';
				out.style.color = input.value.length > max ? '#b32d2e' : '#008a20';
			}
			input.addEventListener( 'input', count );
			count();
		} );
	}() );
	</script>
	<?php
}

function viewmail_seo_save_box( $post_id ) {
	if ( ! isset( $_POST['viewmail_seo_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['viewmail_seo_nonce'] ) ), 'viewmail_seo' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}
	foreach ( viewmail_seo_fields() as $field => $key ) {
		$name = 'viewmail_seo_' . $field;
		if ( isset( $_POST[ $name ] ) ) {
			update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $name ] ) ) );
		}
	}
}
add_action( 'save_post_page', 'viewmail_seo_save_box' );
