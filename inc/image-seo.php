<?php
/**
 * Alt text, titles, captions and tags for the theme pictures, plus image schema.
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

/** SEO text written by hand. Pictures not listed here fall back to their default description. */
function viewmail_image_overrides() {
	return array(
		'header-collage'        => array(
			'alt'     => 'Infographic: free apps, free email and publicity stunts put business data at risk, so Indian businesses need paid domain email and secure hosting',
			'title'   => 'Business security: why free apps and free email are a risk',
			'caption' => 'Free tools are not free: your data pays the bill. Choose paid, private hosting and domain email.',
			'tags'    => array( 'Business security', 'Domain email', 'Web hosting India' ),
		),
		'google-workspace'      => array(
			'alt'     => 'Google Workspace for business: a super admin controls staff email accounts, files and video calls on your own company domain',
			'title'   => 'Google Workspace for business with your own domain',
			'caption' => 'One super admin controls company email, files and meetings on your own domain.',
			'tags'    => array( 'Google Workspace', 'Business email', 'Domain email' ),
		),
		'wordpress-devlopement' => array(
			'alt'     => 'Friends Web Hosting Google Workspace plan comparison and order page shown on a mobile phone',
			'title'   => 'Friends Web Hosting Google Workspace plans',
			'caption' => 'Compare Google Workspace plans and order a free domain with Friends Web Hosting.',
			'tags'    => array( 'Google Workspace', 'Friends Web Hosting', 'Website development' ),
		),
		'domains'               => array(
			'alt'     => 'Infographic: why businesses need their own domain, website and email identity instead of free classified ads and unverified social media',
			'title'   => 'Own domain, website and email identity for your business',
			'caption' => 'A registered domain, website and email give customers a reason to trust you.',
			'tags'    => array( 'Domain registration', '.in domain', 'Business identity' ),
		),
		'facebook-meta-ads'     => array(
			'alt'     => 'Meta Verified plans and pricing comparison for business: Standard, Plus and Premium',
			'title'   => 'Meta Verified business plans and pricing',
			'caption' => 'Meta Verified plans compared, before you plan Facebook and Instagram ads.',
			'tags'    => array( 'Meta ads', 'Facebook ads', 'Meta Verified' ),
		),
		'google-ads'            => array(
			'alt'     => 'Infographic: social media is exhibition media, so use your own domain with WhatsApp and Google Ads for secure business promotion',
			'title'   => 'Secure business promotion with your domain and Google Ads',
			'caption' => 'Promote through your own domain and paid campaigns, not free public platforms.',
			'tags'    => array( 'Google Ads', 'Digital marketing', 'Business promotion' ),
		),
		'servers-hosting'       => array(
			'alt'     => 'Infographic: internet users are not journalists, so choose professional paid publicity and owned platforms for your business',
			'title'   => 'Professional paid publicity versus free internet habits',
			'caption' => 'Owned, paid platforms protect your brand better than free public posting.',
			'tags'    => array( 'Business publicity', 'Brand security' ),
		),
		'ads'                   => array(
			'alt'     => 'Infographic: risks of free video-call and chat apps, data loss and cyber crime for businesses that rely on free services',
			'title'   => 'Risks of free chat apps and free services for business',
			'caption' => 'Free video and chat apps can leak business data. Use secure, paid, domain-based tools.',
			'tags'    => array( 'Data security', 'Cyber security', 'Business security' ),
		),
		'it'                    => array(
			'alt'     => 'Infographic: IT networks and data centers of Google, Microsoft and Amazon, and why free email identities and free messaging expose business data',
			'title'   => 'IT infrastructure, data centers and your business email identity',
			'caption' => 'Behind every free email sits a data center. Own your domain email instead.',
			'tags'    => array( 'Data centers', 'Business email', 'IT infrastructure' ),
		),
		'media'                 => array(
			'alt'     => 'Infographic: print, TV and social media publicity depend on ads, so small businesses should avoid free publicity stunts and use paid, secure promotion',
			'title'   => 'Paid, secure promotion versus free publicity stunts',
			'caption' => 'Publicity works through ads. Plan paid, measurable campaigns for your brand.',
			'tags'    => array( 'Business publicity', 'Digital advertising', 'Brand security' ),
		),
		'marketing' => array(
			'alt'   => 'Infographic: social media as exhibition media with paid stalls, free chat and video apps, and the risks of free communication for businesses',
			'title' => 'Social media as exhibition media and the risks of free apps',
			'tags'  => array( 'Digital marketing', 'Social media', 'Business security' ),
		),
		'behaves-of-ai' => array(
			'alt'   => 'Infographic: machine learning, AI and the market structure from national headquarters to village markets, and how businesses should plan products and marketing',
			'title' => 'AI, machine learning and market structure for businesses',
			'tags'  => array( 'Artificial intelligence', 'Market analysis', 'Digital marketing' ),
		),
		'businesses-model' => array(
			'alt'   => 'Infographic: preventing theft and fraud in a retail business, with total security and Google Workspace control over business and organization data',
			'title' => 'Preventing theft and fraud with Google Workspace control',
			'tags'  => array( 'Google Workspace', 'Business security', 'Data security' ),
		),
		'campaigns-charges' => array(
			'alt'   => 'Price guide for traditional promotion in India: brochures, wall posters, rickshaw and auto campaigns, flex boards and pamphlets, with rates in rupees',
			'title' => 'Traditional promotion and campaign charges in India',
			'tags'  => array( 'Advertising rates', 'Publicity and promotion', 'Digital advertising' ),
		),
		'publicity' => array(
			'alt'   => 'Infographic on free communication, free publicity stunts and their data and privacy damages for small businesses and organizations',
			'title' => 'Free publicity stunts and their data privacy damages',
			'tags'  => array( 'Business publicity', 'Data security', 'Brand security' ),
		),
		'data-books-damages' => array(
			'alt'   => 'Infographic: data centers, servers and data protection spaces, and how fire, accidents and device damage cause data loss that cannot be recovered',
			'title' => 'Data loss from fire, accidents and device damage',
			'tags'  => array( 'Data security', 'Data centers', 'Web hosting India' ),
		),
		'market-analysis' => array(
			'alt'   => 'Infographic: street vendors, shops and showrooms, rents and footfall, and how e-commerce and market analysis affect small business sales',
			'title' => 'Market analysis for shops, vendors and e-commerce',
			'tags'  => array( 'Market analysis', 'E-commerce', 'Small business' ),
		),
		'social-media' => array(
			'alt'   => 'Infographic: social media is an industrial exhibition media, your email identity is your visa, so use your own website and paid digital marketing',
			'title' => 'Social media exhibition media and your email identity',
			'tags'  => array( 'Social media', 'Domain email', 'Digital marketing' ),
		),
		'social-messages' => array(
			'alt'   => 'Infographic: Facebook, WhatsApp, Instagram and YouTube, AI and cyber threats, with advice not to share personal or business information in chats',
			'title' => 'Social messages: what not to share on WhatsApp and social apps',
			'tags'  => array( 'Cyber security', 'WhatsApp', 'Social media' ),
		),
		'newspapers' => array(
			'alt'   => 'Infographic: newspaper subscription costs and e-papers, and why businesses should use newspaper, magazine and TV advertisements instead of free publicity stunts',
			'title' => 'Newspaper advertising versus free publicity stunts',
			'tags'  => array( 'Newspaper advertising', 'Publicity and promotion', 'Digital advertising' ),
		),
		'logo'                  => array(
			'alt'     => 'Sitepages.in logo: focus your brand',
			'title'   => 'Sitepages.in logo',
			'caption' => 'Sitepages.in: focus your brand.',
			'tags'    => array( 'Sitepages', 'Logo' ),
		),
	);
}

/** Topic tags guessed from the words in a description. */
function viewmail_image_topic_tags( $text ) {
	$map  = array(
		'domain'     => 'Domain registration',
		'google ads' => 'Google Ads',
		'ads'        => 'Digital advertising',
		'workspace'  => 'Google Workspace',
		'email'      => 'Business email',
		'meta'       => 'Meta ads',
		'security'   => 'Business security',
		'data'       => 'Data security',
		'newspaper'  => 'Publicity and promotion',
		'wordpress'  => 'Website development',
		'marketing'  => 'Digital marketing',
		'bharat'     => '.bharat IDN domains',
	);
	$text = strtolower( $text );
	$tags = array();
	foreach ( $map as $needle => $tag ) {
		if ( false !== strpos( $text, $needle ) ) {
			$tags[] = $tag;
		}
	}
	return $tags;
}

/** Alt, title, caption, description and tags of one picture. */
function viewmail_image_seo( $slug ) {
	static $base = null;
	if ( null === $base ) {
		$base = viewmail_all_images( false );
	}
	$over = viewmail_image_overrides();
	$alt  = isset( $over[ $slug ]['alt'] ) ? $over[ $slug ]['alt'] : ( isset( $base[ $slug ] ) ? $base[ $slug ] : $slug );

	$title   = isset( $over[ $slug ]['title'] ) ? $over[ $slug ]['title'] : rtrim( $alt, '.' );
	$caption = isset( $over[ $slug ]['caption'] ) ? $over[ $slug ]['caption'] : '';
	$tags    = array_merge(
		array( 'Friends Web Hosting', 'Sitepages' ),
		isset( $over[ $slug ]['tags'] ) ? $over[ $slug ]['tags'] : viewmail_image_topic_tags( $alt )
	);

	return array(
		'alt'         => $alt,
		'title'       => $title,
		'caption'     => $caption,
		'description' => $alt . '. Published by Friends Web Hosting and Sitepages, hosting, domain, email and digital marketing services in India.',
		'tags'        => array_values( array_unique( $tags ) ),
	);
}

/** Let media items carry tags. */
function viewmail_image_tags_taxonomy() {
	register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init', 'viewmail_image_tags_taxonomy' );

/** Copy the SEO text to the theme's pictures in the Media Library. Safe to run again. */
function viewmail_sync_image_seo() {
	$map = get_option( 'viewmail_images', array() );
	if ( ! is_array( $map ) ) {
		return 0;
	}
	register_taxonomy_for_object_type( 'post_tag', 'attachment' );
	$done = 0;
	foreach ( $map as $slug => $id ) {
		if ( ! get_post( $id ) ) {
			continue;
		}
		$seo = viewmail_image_seo( $slug );
		wp_update_post(
			array(
				'ID'           => $id,
				'post_title'   => $seo['title'],
				'post_excerpt' => $seo['caption'],
				'post_content' => $seo['description'],
			)
		);
		update_post_meta( $id, '_wp_attachment_image_alt', $seo['alt'] );
		wp_set_object_terms( $id, $seo['tags'], 'post_tag', false );
		++$done;
	}
	return $done;
}

/** schema.org ImageObject for one picture. */
function viewmail_image_object( $slug ) {
	$seo = viewmail_image_seo( $slug );
	$id  = viewmail_image_id( $slug );
	$url = $id ? wp_get_attachment_url( $id ) : VIEWMAIL_URI . '/assets/images/' . $slug . '.jpg';
	$node = array(
		'@type'       => 'ImageObject',
		'contentUrl'  => $url,
		'url'         => $url,
		'name'        => $seo['title'],
		'caption'     => $seo['caption'] ? $seo['caption'] : $seo['alt'],
		'description' => $seo['alt'],
		'keywords'    => implode( ', ', $seo['tags'] ),
		'creditText'  => 'Friends Web Hosting',
		'creator'     => array( '@type' => 'Organization', 'name' => 'Friends Web Hosting', 'url' => 'https://friendswebhosting.com' ),
	);
	$meta = $id ? wp_get_attachment_metadata( $id ) : array();
	if ( ! empty( $meta['width'] ) && ! empty( $meta['height'] ) ) {
		$node['width']  = (int) $meta['width'];
		$node['height'] = (int) $meta['height'];
	}
	return $node;
}

/** Gallery page schema. */
function viewmail_gallery_schema( $url, $title, $description ) {
	$images = array();
	foreach ( array_keys( viewmail_gallery_images() ) as $slug ) {
		$images[] = viewmail_image_object( $slug );
	}
	return array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			array(
				'@type'       => 'ImageGallery',
				'@id'         => $url . '#gallery',
				'url'         => $url,
				'name'        => $title,
				'description' => $description,
				'inLanguage'  => 'en-IN',
				'publisher'   => array( '@type' => 'Organization', 'name' => 'Friends Web Hosting', 'url' => 'https://friendswebhosting.com' ),
				'image'       => $images,
			),
			array(
				'@type'           => 'BreadcrumbList',
				'itemListElement' => array(
					array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
					array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Gallery', 'item' => $url ),
				),
			),
		),
	);
}

/** Title, description and keywords of the Gallery page. */
function viewmail_gallery_seo() {
	return array(
		'title'       => 'Business Security & Marketing Infographics | Friends Web Hosting',
		'description' => 'Free infographics on domain email, Google Workspace, Google Ads, Meta Verified and data security for Indian businesses, from Friends Web Hosting.',
		'keywords'    => 'business security infographics, domain email, Google Workspace, Google Ads guide, Meta Verified plans, data security India, digital marketing guides, Friends Web Hosting, Sitepages',
	);
}

/** Load the hero picture first and lazy-load the rest. */
function viewmail_image_attributes( $attr, $attachment ) {
	$slug = get_post_meta( $attachment->ID, '_viewmail_image', true );
	if ( ! $slug ) {
		return $attr;
	}
	$attr['decoding'] = 'async';
	if ( 'header-collage' === $slug ) {
		$attr['loading']       = 'eager';
		$attr['fetchpriority'] = 'high';
	} else {
		$attr['loading'] = 'lazy';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'viewmail_image_attributes', 10, 2 );
