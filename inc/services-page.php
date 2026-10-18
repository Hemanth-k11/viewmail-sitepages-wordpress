<?php
/**
 * Services page: layout, copy, FAQ and schema.
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

/** Title, description and keywords of the Services page. */
function viewmail_services_seo() {
	$c = viewmail_contact();
	return array(
		'title'       => 'Web Hosting & Domain Services in India | Friends Web Hosting',
		'description' => 'cPanel web hosting, .in & .bharat domains, Google Workspace, business email, WordPress websites and Google Ads in India. Call ' . $c['phone_text'] . '.',
		'keywords'    => 'web hosting India, cPanel hosting, domain registration India, .in domain, .bharat domain, IDN domains, Nixi domains, Google Workspace India, business email hosting, domain email, WordPress website development, Google Ads management, digital marketing services India, Friends Web Hosting, Sitepages',
	);
}

/** Services shown as cards and listed in the schema. */
function viewmail_services_list() {
	$c = viewmail_contact();
	return array(
		array(
			'icon'  => 'fas fa-server',
			'title' => 'cPanel Web Hosting &amp; Servers',
			'text'  => 'Fast, secure <strong>cPanel web hosting</strong> and enterprise-grade dedicated servers from <a href="https://friendswebhosting.in" target="_blank" rel="noopener">friendswebhosting.in</a>, set up for business websites, shops and web apps, with 24/7 local support.',
			'name'  => 'cPanel Web Hosting and Servers',
			'color' => '#4285F4',
			'cta'   => 'Ask about hosting',
			'url'   => 'https://friendswebhosting.com',
		),
		array(
			'icon'  => 'fas fa-globe',
			'title' => 'Domain Registration: .in &amp; .bharat',
			'text'  => '<a href="' . esc_url( $c['domains'] ) . '" target="_blank" rel="noopener">Register</a> <strong>.in, .co.in, .ai.in</strong> and <strong>.bharat IDN</strong> domains in Hindi, Telugu, Kannada, Malayalam and more, so customers can find you in their own language.',
			'name'  => 'Domain Registration in India (.in and .bharat IDN)',
			'color' => '#28A745',
			'cta'   => 'Search a domain',
			'url'   => $c['domains'],
		),
		array(
			'icon'  => 'fas fa-envelope-open-text',
			'title' => 'Google Workspace &amp; Business Email',
			'text'  => 'Your own <strong>domain email</strong> and paid <strong>Google Workspace</strong> with free domain and DNS setup. Look professional and keep your data private and recoverable.',
			'name'  => 'Google Workspace and Business Email Hosting',
			'color' => '#E67E22',
			'cta'   => 'Get business email',
			'url'   => 'https://wa.me/' . $c['whatsapp'] . '?text=' . rawurlencode( 'Hi, I want business email / Google Workspace for my domain.' ),
		),
		array(
			'icon'  => 'fab fa-wordpress',
			'title' => 'WordPress Website Development',
			'text'  => 'A fast, mobile-friendly <strong>WordPress CMS website</strong> that you can edit yourself, with free SSL, free DNS and free SEO setup so it is ready to be found on Google.',
			'name'  => 'WordPress Website Development',
			'color' => '#0A2351',
			'cta'   => 'Start my website',
			'url'   => 'https://wa.me/' . $c['whatsapp'] . '?text=' . rawurlencode( 'Hi, I want a WordPress business website.' ),
		),
		array(
			'icon'  => 'fas fa-bullhorn',
			'title' => 'Google, Microsoft &amp; Meta Ads',
			'text'  => 'Managed <strong>Google Ads</strong>, Microsoft Ads and Meta ads with expert bidding, targeted by city or pincode. Start from <strong>₹20 a day</strong> and see real calls, not just views.',
			'name'  => 'Google Ads, Microsoft Ads and Meta Ads Management',
			'color' => '#EA4335',
			'cta'   => 'Plan my ads',
			'url'   => home_url( '/' ),
		),
		array(
			'icon'  => 'fas fa-user-shield',
			'title' => 'Admin, Security &amp; Email Marketing',
			'text'  => 'Dedicated managers for <strong>server and website administration</strong>, web design on a work-per-hour basis and professional email outreach that protects your brand and your data.',
			'name'  => 'Server and Website Administration, Email Marketing',
			'color' => '#FFB400',
			'cta'   => 'Talk to a manager',
			'url'   => 'tel:' . $c['phone_main'],
		),
	);
}

/** Pictures in the guides section. */
function viewmail_services_images() {
	return array( 'google-workspace', 'wordpress-devlopement', 'domains' );
}

/** FAQ questions, also used for the FAQPage schema. */
function viewmail_services_faqs() {
	$c = viewmail_contact();
	return array(
		array(
			'q' => 'Which web hosting plan is right for a small business in India?',
			'a' => 'The Business Website plan at ₹6000 a year is built for most small businesses. It includes a WordPress CMS website, 1 GB of space, a free SSL certificate and free SEO and DNS setup. Larger sites and web apps can move to a dedicated server from friendswebhosting.in.',
		),
		array(
			'q' => 'How much does a business email with my own domain cost?',
			'a' => 'Business Email starts at ₹111 a month. It includes 5 GB of secured space, web mail with Gmail support and a free domain, so you can use name@yourcompany.in instead of a free Gmail or Yahoo address.',
		),
		array(
			'q' => 'Why should a business avoid free email and free messaging apps?',
			'a' => 'Free services come with no service level agreement, little admin control and no legal recourse if your data leaks. A paid domain email gives you encryption, ownership, recovery and a professional identity that customers and officials trust.',
		),
		array(
			'q' => 'What is a .bharat (IDN) domain and who needs one?',
			'a' => 'A .bharat domain is the Indian local-language domain, available in scripts such as Hindi (.भारत), Telugu (.భారత్), Kannada (.ಭಾರತ) and Malayalam (.ഭാരതം). It suits government bodies, schools, shops and brands that serve customers who search in their own language.',
		),
		array(
			'q' => 'How much does Google Workspace cost?',
			'a' => 'Google Workspace starts at ₹300 per month with a free domain and DNS setup and the Business Basic starter plan. You get professional email, storage and collaboration tools on your own domain.',
		),
		array(
			'q' => 'How much do Google Ads cost, and when do I pay?',
			'a' => 'Our ad management starts from ₹20 a day. With Google Ads you only pay when someone clicks your ad, and the price per click depends on your industry. Use the free bidding calculator on our home page to estimate how many visitors your budget can bring.',
		),
		array(
			'q' => 'Do you set up SEO for my new website?',
			'a' => 'Yes. The Business Website plan includes free SEO and DNS setup: page titles, descriptions, sitemap basics and search engine friendly structure, so Google can understand and list your pages.',
		),
		array(
			'q' => 'How do I contact Friends Web Hosting for support?',
			'a' => 'Call or WhatsApp ' . $c['phone_text'] . ' or email ' . $c['email'] . '. Our local team replies in plain language and helps you choose only what your business needs.',
		),
	);
}

function viewmail_services_schema( $url, $title, $description ) {
	$c       = viewmail_contact();
	$org_id  = 'https://friendswebhosting.com/#organization';
	$site    = home_url( '/' );
	$prices  = array(
		'Google Workspace and Business Email Hosting' => array( '300', 'Google Workspace, per month' ),
		'WordPress Website Development'               => array( '6000', 'Business Website, per year' ),
	);
	$items   = array();
	foreach ( viewmail_services_list() as $i => $service ) {
		$node = array(
			'@type'       => 'Service',
			'name'        => $service['name'],
			'description' => wp_strip_all_tags( html_entity_decode( $service['text'] ) ),
			'serviceType' => $service['name'],
			'provider'    => array( '@id' => $org_id ),
			'areaServed'  => array( '@type' => 'Country', 'name' => 'India' ),
		);
		if ( isset( $prices[ $service['name'] ] ) ) {
			$node['offers'] = array(
				'@type'         => 'Offer',
				'price'         => $prices[ $service['name'] ][0],
				'priceCurrency' => 'INR',
				'description'   => $prices[ $service['name'] ][1],
			);
		}
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $i + 1,
			'item'     => $node,
		);
	}

	$faqs = array();
	foreach ( viewmail_services_faqs() as $faq ) {
		$faqs[] = array(
			'@type'          => 'Question',
			'name'           => $faq['q'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $faq['a'],
			),
		);
	}

	return array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			array(
				'@type'        => 'Organization',
				'@id'          => $org_id,
				'name'         => 'Friends Web Hosting',
				'alternateName' => 'Sitepages',
				'url'          => 'https://friendswebhosting.com',
				'logo'         => VIEWMAIL_URI . '/assets/images/logo.jpg',
				'email'        => $c['email'],
				'telephone'    => $c['phone_main'],
				'areaServed'   => 'IN',
				'contactPoint' => array(
					'@type'             => 'ContactPoint',
					'telephone'         => $c['phone_main'],
					'contactType'       => 'sales',
					'areaServed'        => 'IN',
					'availableLanguage' => array( 'English', 'Hindi', 'Telugu' ),
				),
			),
			array(
				'@type'       => 'WebPage',
				'@id'         => $url . '#webpage',
				'url'         => $url,
				'name'        => $title,
				'description' => $description,
				'inLanguage'  => 'en-IN',
				'isPartOf'    => array( '@type' => 'WebSite', 'name' => get_bloginfo( 'name' ), 'url' => $site ),
				'about'       => array( '@id' => $org_id ),
				'primaryImageOfPage' => viewmail_image_object( 'header-collage' ),
				'image'       => array_map( 'viewmail_image_object', viewmail_services_images() ),
				'breadcrumb'  => array( '@id' => $url . '#breadcrumb' ),
			),
			array(
				'@type'           => 'BreadcrumbList',
				'@id'             => $url . '#breadcrumb',
				'itemListElement' => array(
					array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site ),
					array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $url ),
				),
			),
			array(
				'@type'           => 'ItemList',
				'name'            => 'Friends Web Hosting services',
				'itemListElement' => $items,
			),
			array(
				'@type'      => 'FAQPage',
				'mainEntity' => $faqs,
			),
		),
	);
}

/** FAQ as <details> accordions (no JavaScript). */
function viewmail_services_faq_html() {
	$html = '<div class="vm-faq">';
	foreach ( viewmail_services_faqs() as $i => $faq ) {
		$html .= '<details' . ( 0 === $i ? ' open' : '' ) . '><summary>' . esc_html( $faq['q'] ) . '</summary><p>' . esc_html( $faq['a'] ) . '</p></details>';
	}
	return $html . '</div>';
}

// Page design

function viewmail_services_data() {
	$c = viewmail_contact();
	$d = array();
	$wa = function ( $text ) use ( $c ) {
		return 'https://wa.me/' . $c['whatsapp'] . '?text=' . rawurlencode( $text );
	};

	// 1. Hero.
	$d[] = viewmail_el_container(
		array(
			'content_width'         => 'full',
			'background_background' => 'gradient',
			'background_color'      => '#0A2351',
			'background_color_b'    => '#1A4FA3',
			'background_gradient_angle' => viewmail_el_px( 135, 'deg' ),
			'padding'               => viewmail_el_box( 80, 25, 90, 25 ),
			'padding_tablet'        => viewmail_el_box( 64, 30, 70, 30 ),
			'padding_mobile'        => viewmail_el_box( 44, 16, 48, 16 ),
			'flex_align_items'      => 'center',
			'flex_gap'              => viewmail_el_gap( 18 ),
			'css_classes'           => 'vm-svc-hero',
		),
		array(
			viewmail_el_heading(
				'FRIENDS WEB HOSTING × SITEPAGES',
				'p',
				13,
				array(
					'align'                       => 'center',
					'title_color'                 => '#FFB400',
					'typography_letter_spacing'   => viewmail_el_px( 2 ),
					'typography_font_size_mobile' => viewmail_el_px( 11 ),
				)
			),
			viewmail_el_heading(
				'Web Hosting, Domains &amp; Digital Services Built for Indian Businesses',
				'h1',
				48,
				array(
					'align'                       => 'center',
					'title_color'                 => '#FFFFFF',
					'typography_font_size_tablet' => viewmail_el_px( 38 ),
					'typography_font_size_mobile' => viewmail_el_px( 28 ),
					'typography_line_height'      => viewmail_el_px( 1.15, 'em' ),
					'_css_classes'                => 'vm-svc-hero__title',
				)
			),
			viewmail_el_text(
				'<p>Stop renting a free identity. Own your <strong>domain</strong>, your <strong>email</strong>, your <strong>website</strong> and your <strong>advertising</strong> with paid, professional and private infrastructure, backed by a local team that answers the phone.</p>',
				array(
					'align'                       => 'center',
					'text_color'                  => '#DCE7FB',
					'typography_font_size'        => viewmail_el_px( 18 ),
					'typography_font_size_mobile' => viewmail_el_px( 16 ),
					'_css_classes'                => 'vm-svc-hero__lead',
				)
			),
			viewmail_el_row(
				array(
					viewmail_el_button( 'Get a Free Consultation', 'tel:' . $c['phone_main'], array( '#FFB400', '#0A2351', '#E6A200' ), array( 'text_padding' => viewmail_el_box( 16, 34, 16, 34 ), 'typography_font_size' => viewmail_el_px( 16 ) ) ),
					viewmail_el_button( 'Chat on WhatsApp', $wa( 'Hi, I would like to know about your hosting and domain services.' ), array( '#25D366', '#FFFFFF', '#1EBE5A' ), array( 'text_padding' => viewmail_el_box( 16, 34, 16, 34 ), 'typography_font_size' => viewmail_el_px( 16 ) ) ),
				),
				16,
				array( 'flex_gap' => viewmail_el_gap( 16 ), 'css_classes' => 'vm-svc-hero__buttons' )
			),
			viewmail_el_widget(
				'html',
				array(
					'html' => '<ul class="vm-chips"><li>24/7 local support</li><li>Free SSL &amp; DNS setup</li><li>.in &amp; .bharat IDN domains</li><li>Plans from ₹111/month</li></ul>',
				)
			),
		)
	);

	// 2. Starting prices.
	$stat = function ( $number, $label ) {
		return viewmail_el_container(
			array_merge(
				viewmail_el_width( 4, 20, 2 ),
				array(
					'background_background' => 'classic',
					'background_color'      => '#FFFFFF',
					'border_radius'         => viewmail_el_box( 14 ),
					'padding'               => viewmail_el_box( 22, 14, 22, 14 ),
					'flex_align_items'      => 'center',
					'flex_gap'              => viewmail_el_gap( 2 ),
					'box_shadow_box_shadow_type' => 'yes',
					'box_shadow_box_shadow' => viewmail_el_shadow( 'rgba(10,35,81,0.08)', 8, 24 ),
					'css_classes'           => 'vm-stat',
				)
			),
			array(
				viewmail_el_heading( $number, 'p', 32, array( 'align' => 'center', 'title_color' => '#1A73E8', 'typography_font_size_mobile' => viewmail_el_px( 26 ) ) ),
				viewmail_el_text( '<p>' . $label . '</p>', array( 'align' => 'center', 'text_color' => '#475569', 'typography_font_size' => viewmail_el_px( 14 ) ) ),
			)
		);
	};
	$d[] = viewmail_el_section(
		array( 'padding' => viewmail_el_box( 0, 25, 10, 25 ), 'margin' => viewmail_el_box( -34, 0, 0, 0 ), 'margin_mobile' => viewmail_el_box( -24, 0, 0, 0 ), 'css_classes' => 'vm-stats' ),
		array(
			viewmail_el_row(
				array(
					$stat( '₹20/day', 'Google &amp; Meta ads from' ),
					$stat( '₹111/mo', 'Business email from' ),
					$stat( '₹300/mo', 'Google Workspace from' ),
					$stat( '24/7', 'Local call &amp; WhatsApp support' ),
				),
				20
			),
		)
	);

	// 3. Services.
	$cards = array();
	foreach ( viewmail_services_list() as $service ) {
		$cards[] = viewmail_el_container(
			array_merge(
				viewmail_el_width( 3, 24, 2 ),
				array(
					'background_background' => 'classic',
					'background_color'      => '#FFFFFF',
					'border_radius'         => viewmail_el_box( 18 ),
					'border_border'         => 'solid',
					'border_width'          => viewmail_el_box( 0, 0, 6, 0 ),
					'border_color'          => $service['color'],
					'box_shadow_box_shadow_type' => 'yes',
					'box_shadow_box_shadow' => viewmail_el_shadow( 'rgba(0,0,0,0.06)', 8, 24 ),
					'padding'               => viewmail_el_box( 30, 26, 28, 26 ),
					'padding_mobile'        => viewmail_el_box( 24, 20, 22, 20 ),
					'flex_gap'              => viewmail_el_gap( 10 ),
					'flex_justify_content'  => 'space-between',
					'css_classes'           => 'vm-hover-up vm-svc-card',
				)
			),
			array(
				viewmail_el_icon_box(
					$service['icon'],
					$service['title'],
					$service['text'],
					$service['color'],
					'#0A2351',
					array(
						'position'           => 'top',
						'icon_size'          => viewmail_el_px( 34 ),
						'icon_space'         => viewmail_el_px( 14 ),
						'title_size'         => 'h3',
						'title_typography_font_size' => viewmail_el_px( 21 ),
						'description_color'  => '#475569',
					)
				),
				viewmail_el_button(
					$service['cta'] . ' →',
					$service['url'],
					array( 'rgba(0,0,0,0)', $service['color'] === '#FFB400' ? '#8A6100' : $service['color'], 'rgba(0,0,0,0.04)' ),
					array(
						'align'          => 'left',
						'text_padding'   => viewmail_el_box( 8, 0, 8, 0 ),
						'border_radius'  => viewmail_el_box( 0 ),
						'hover_animation' => '',
						'_css_classes'   => 'vm-svc-link',
					)
				),
			)
		);
	}
	$d[] = viewmail_el_section(
		array( 'padding' => viewmail_el_box( 40, 25, 30, 25 ), 'flex_gap' => viewmail_el_gap( 30 ) ),
		array(
			viewmail_el_container(
				array( 'flex_gap' => viewmail_el_gap( 10 ) ),
				array(
					viewmail_el_title( 'Everything Your Business Needs Online, Under One Roof', 'h2', 36 ),
					viewmail_el_text( '<p>From the domain name to the first customer call, <a href="https://friendswebhosting.com" target="_blank" rel="noopener"><strong>Friends Web Hosting</strong></a> and <a href="https://sitepages.in" target="_blank" rel="noopener"><strong>Sitepages</strong></a> look after the full stack: hosting, domains, email, website and advertising.</p>', array( 'align' => 'center', 'text_color' => '#475569', 'typography_font_size' => viewmail_el_px( 17 ) ) ),
				)
			),
			viewmail_el_row( $cards, 24, array( 'flex_justify_content' => 'flex-start' ) ),
		)
	);

	// 4. Plans.
	$plan = function ( $title, $price, $per, $items, $from, $to, $ask ) use ( $wa ) {
		return viewmail_el_container(
			array_merge(
				viewmail_el_width( 3, 30, 1 ),
				array(
					'background_background'     => 'gradient',
					'background_color'          => $from,
					'background_color_b'        => $to,
					'background_gradient_angle' => viewmail_el_px( 135, 'deg' ),
					'border_radius'             => viewmail_el_box( 14 ),
					'padding'                   => viewmail_el_box( 40, 28, 40, 28 ),
					'padding_mobile'            => viewmail_el_box( 32, 22, 32, 22 ),
					'flex_align_items'          => 'center',
					'flex_gap'                  => viewmail_el_gap( 6 ),
					'css_classes'               => 'vm-offer',
				)
			),
			array(
				viewmail_el_heading( $title, 'h3', 24, array( 'align' => 'center', 'title_color' => '#FFFFFF', 'typography_font_weight' => '700' ) ),
				viewmail_el_heading( $price . ' <span>' . $per . '</span>', 'p', 35, array( 'align' => 'center', 'title_color' => '#FFFFFF', '_css_classes' => 'vm-price' ) ),
				viewmail_el_text( '<ul><li>' . implode( '</li><li>', $items ) . '</li></ul>', array( 'text_color' => '#FFFFFF', '_css_classes' => 'vm-offer-list', '_element_width' => 'initial', '_element_custom_width' => viewmail_el_px( 100, '%' ) ) ),
				viewmail_el_button( 'Order on WhatsApp', $wa( $ask ), array( '#FFFFFF', '#333333', '#F8F8F8' ), array( 'align' => 'center' ) ),
			)
		);
	};
	$d[] = viewmail_el_section(
		array(
			'background_background' => 'classic',
			'background_color'      => '#FFFFFF',
			'padding'               => viewmail_el_box( 50, 25, 56, 25 ),
			'flex_gap'              => viewmail_el_gap( 30 ),
		),
		array(
			viewmail_el_container(
				array( 'flex_gap' => viewmail_el_gap( 10 ) ),
				array(
					viewmail_el_title( 'Simple, Honest Pricing for Hosting, Email &amp; Websites', 'h2', 36 ),
					viewmail_el_text( '<p>No hidden add-ons. Pick a plan, tell us your business name, and we set everything up for you.</p>', array( 'align' => 'center', 'text_color' => '#475569', 'typography_font_size' => viewmail_el_px( 17 ) ) ),
				)
			),
			viewmail_el_row(
				array(
					$plan( 'Google Workspace', '₹300/-', 'per month', array( 'Free domain &amp; DNS', 'Free cloud hosting', 'Business basic starter' ), '#3498DB', '#2980B9', 'Hi, I want the Google Workspace plan.' ),
					$plan( 'Business Website', '₹6000/-', 'year', array( 'WordPress CMS website', '1 GB space + free SSL', 'Free SEO &amp; DNS setup' ), '#E67E22', '#D35400', 'Hi, I want the Business Website plan.' ),
					$plan( 'Business Email', '₹111/-', 'per month', array( '5 GB secured space', 'Web mail via Gmail support', 'Free domain included' ), '#27AE60', '#1E8449', 'Hi, I want the Business Email plan.' ),
				),
				30
			),
		)
	);

	// 5. Why choose us.
	$why = function ( $icon, $title, $text, $color ) {
		return viewmail_el_container(
			array_merge(
				viewmail_el_width( 4, 24, 2 ),
				array(
					'flex_gap'    => viewmail_el_gap( 6 ),
					'css_classes' => 'vm-why',
				)
			),
			array(
				viewmail_el_icon_box( $icon, $title, $text, $color, '#0A2351', array( 'position' => 'top', 'text_align' => 'center', 'icon_size' => viewmail_el_px( 30 ), 'title_size' => 'h3', 'description_color' => '#475569' ) ),
			)
		);
	};
	$d[] = viewmail_el_section(
		array( 'padding' => viewmail_el_box( 56, 25, 50, 25 ), 'flex_gap' => viewmail_el_gap( 30 ) ),
		array(
			viewmail_el_title( 'Why Businesses Choose Friends Web Hosting &amp; Sitepages', 'h2', 36 ),
			viewmail_el_row(
				array(
					$why( 'fas fa-lock', 'Secure by design', 'Paid, private infrastructure with SSL, proper DNS and admin control, not borrowed free tools.', '#0A2351' ),
					$why( 'fas fa-headset', 'Real local support', 'Call or WhatsApp a person who understands Indian businesses and replies in plain language.', '#28A745' ),
					$why( 'fas fa-rupee-sign', 'Transparent pricing', 'Prices in rupees, stated up front. Try our free ad budget and bidding calculators before you spend.', '#E67E22' ),
					$why( 'fas fa-chart-line', 'SEO-ready from day one', 'Titles, descriptions, speed and structure are set up so Google can find and list your pages.', '#4285F4' ),
				),
				24
			),
			viewmail_el_text(
				'<p>Want to see how far a small ad budget goes? Try the free <a href="' . esc_url( home_url( '/' ) ) . '">Google Ads preview and bidding calculator</a> on our home page, or browse our <a href="' . esc_url( home_url( '/gallery/' ) ) . '">gallery of business security guides</a>.</p>',
				array( 'align' => 'center', 'text_color' => '#475569', '_css_classes' => 'vm-inline-links' )
			),
		)
	);

	// 6. How it works.
	$step = function ( $n, $title, $text ) {
		return viewmail_el_container(
			array_merge(
				viewmail_el_width( 4, 24, 2 ),
				array(
					'background_background' => 'classic',
					'background_color'      => 'rgba(255,255,255,0.08)',
					'border_radius'         => viewmail_el_box( 16 ),
					'border_border'         => 'solid',
					'border_width'          => viewmail_el_box( 1 ),
					'border_color'          => 'rgba(255,255,255,0.18)',
					'padding'               => viewmail_el_box( 28, 24, 28, 24 ),
					'padding_mobile'        => viewmail_el_box( 22, 18, 22, 18 ),
					'flex_gap'              => viewmail_el_gap( 8 ),
				)
			),
			array(
				viewmail_el_heading( (string) $n, 'span', 18, array( 'title_color' => '#0A2351', 'typography_font_weight' => '800', 'typography_font_size_mobile' => viewmail_el_px( 16 ), '_css_classes' => 'vm-step__num', '_element_width' => 'auto' ) ),
				viewmail_el_heading( $title, 'h3', 20, array( 'title_color' => '#FFFFFF' ) ),
				viewmail_el_text( '<p>' . $text . '</p>', array( 'text_color' => '#CBD8F2' ) ),
			)
		);
	};
	$d[] = viewmail_el_container(
		array(
			'background_background' => 'classic',
			'background_color'      => '#0A2351',
		),
		array(
			viewmail_el_section(
				array( 'padding' => viewmail_el_box( 56, 25, 60, 25 ), 'flex_gap' => viewmail_el_gap( 30 ) ),
				array(
					viewmail_el_title( 'Go Live in 4 Simple Steps', 'h2', 36 ),
					viewmail_el_row(
						array(
							$step( 1, 'Tell us your business', 'Call or WhatsApp us your name, trade and what you want to achieve.' ),
							$step( 2, 'Pick your plan', 'We recommend only what you need: domain, email, hosting, website or ads.' ),
							$step( 3, 'We set it all up', 'Domain, DNS, SSL, mailboxes and website are configured for you.' ),
							$step( 4, 'Grow with support', 'Track calls and visitors, and call us any time you need help.' ),
						),
						24
					),
				)
			),
		)
	);

	// 7. Local language domains.
	$domains = array();
	foreach ( array( '.in', '.co.in', '.ai.in', '.5g.in', '.भारत', '.భారత్', '.ಭಾರತ', '.ഭാരതം' ) as $name ) {
		$domains[] = viewmail_el_heading(
			$name,
			'div',
			16,
			array(
				'align'                       => 'center',
				'typography_font_weight'      => '700',
				'typography_font_size_mobile' => viewmail_el_px( 14 ),
				'_css_classes'                => 'vm-idn',
				'_element_width'              => 'initial',
				'_element_custom_width'       => viewmail_el_px( 130 ),
			)
		);
	}
	$d[] = viewmail_el_section(
		array( 'padding' => viewmail_el_box( 50, 25, 20, 25 ), 'flex_gap' => viewmail_el_gap( 18 ) ),
		array(
			viewmail_el_title( 'Register Your .in and .bharat Domain in Your Own Language', 'h2', 32 ),
			viewmail_el_text( '<p>A domain in Hindi, Telugu, Kannada or Malayalam helps customers type and remember your brand. Pair it with a matching <strong>.in</strong> address and your business is covered in both scripts.</p>', array( 'align' => 'center', 'text_color' => '#475569', 'typography_font_size' => viewmail_el_px( 17 ) ) ),
			viewmail_el_row( $domains, 15 ),
			viewmail_el_button( 'Search Your Domain Name', $c['domains'], array( '#0A2351', '#FFFFFF', '#143A7B' ), array( 'align' => 'center', 'border_radius' => viewmail_el_box( 50 ), 'text_padding' => viewmail_el_box( 16, 38, 16, 38 ) ) ),
		)
	);

	// 8. Guides with pictures and captions.
	$figures = array();
	foreach ( viewmail_services_images() as $slug ) {
		$seo       = viewmail_image_seo( $slug );
		$figures[] = viewmail_el_container(
			array_merge(
				viewmail_el_width( 3, 24, 3 ),
				array( 'css_classes' => 'vm-lift vm-figure' )
			),
			array(
				viewmail_el_image(
					$slug,
					$seo['alt'],
					array(
						'image_size'      => 'large',
						'caption_source'  => 'custom',
						'caption'         => $seo['caption'],
						'link_to'         => 'file',
						'open_lightbox'   => 'yes',
					)
				),
			)
		);
	}
	$d[] = viewmail_el_section(
		array(
			'background_background' => 'classic',
			'background_color'      => '#FFFFFF',
			'padding'               => viewmail_el_box( 50, 25, 56, 25 ),
			'flex_gap'              => viewmail_el_gap( 26 ),
		),
		array(
			viewmail_el_title( 'Guides: How Domain Email, Google Workspace and Hosting Protect Your Business', 'h2', 32 ),
			viewmail_el_text( '<p>Tap a picture to enlarge it. These guides explain why paid, private infrastructure from <strong>Friends Web Hosting</strong> beats free tools.</p>', array( 'align' => 'center', 'text_color' => '#475569', 'typography_font_size' => viewmail_el_px( 17 ) ) ),
			viewmail_el_row( $figures, 24, array( 'flex_align_items' => 'flex-start' ) ),
		)
	);

	// 9. FAQ.
	$d[] = viewmail_el_section(
		array(
			'boxed_width'    => viewmail_el_px( 900 ),
			'padding'        => viewmail_el_box( 50, 25, 50, 25 ),
			'flex_gap'       => viewmail_el_gap( 24 ),
		),
		array(
			viewmail_el_title( 'Frequently Asked Questions', 'h2', 34 ),
			viewmail_el_widget( 'html', array( 'html' => viewmail_services_faq_html() ) ),
		)
	);

	// 10. Call to action.
	$d[] = viewmail_el_section(
		array( 'padding' => viewmail_el_box( 10, 25, 60, 25 ), '_element_id' => 'contact' ),
		array(
			viewmail_el_container(
				array(
					'background_background'     => 'gradient',
					'background_color'          => '#1A73E8',
					'background_color_b'        => '#0D47A1',
					'background_gradient_angle' => viewmail_el_px( 135, 'deg' ),
					'border_radius'             => viewmail_el_box( 24 ),
					'padding'                   => viewmail_el_box( 56, 28, 56, 28 ),
					'padding_mobile'            => viewmail_el_box( 36, 18, 38, 18 ),
					'flex_align_items'          => 'center',
					'flex_gap'                  => viewmail_el_gap( 18 ),
					'css_classes'               => 'vm-svc-cta',
				),
				array(
					viewmail_el_heading( 'Ready to Own Your Digital Identity?', 'h2', 34, array( 'align' => 'center', 'title_color' => '#FFFFFF' ) ),
					viewmail_el_text( '<p>Talk to the <a href="https://friendswebhosting.com" target="_blank" rel="noopener"><strong>Friends Web Hosting</strong></a> team today. Your first consultation is free, and we will tell you honestly what your business does and does not need.</p>', array( 'align' => 'center', 'text_color' => '#E3EDFF', 'typography_font_size' => viewmail_el_px( 17 ) ) ),
					viewmail_el_row(
						array(
							viewmail_el_button( 'Call ' . $c['phone_text'], 'tel:' . $c['phone_main'], array( '#FFB400', '#000000', '#E6A200' ), array( 'text_padding' => viewmail_el_box( 16, 34, 16, 34 ), 'typography_font_size' => viewmail_el_px( 16 ) ) ),
							viewmail_el_button( 'WhatsApp Us', $wa( 'Hi, I would like a free consultation.' ), array( '#25D366', '#FFFFFF', '#1EBE5A' ), array( 'text_padding' => viewmail_el_box( 16, 34, 16, 34 ), 'typography_font_size' => viewmail_el_px( 16 ) ) ),
							viewmail_el_button( 'Email Sales', 'mailto:' . $c['email'], array( '#FFFFFF', '#0A2351', '#F1F5F9' ), array( 'text_padding' => viewmail_el_box( 16, 34, 16, 34 ), 'typography_font_size' => viewmail_el_px( 16 ) ) ),
						),
						14,
						array( 'flex_gap' => viewmail_el_gap( 14 ) )
					),
					viewmail_el_text(
						'<p>Also visit <a href="https://friendswebhosting.com" target="_blank" rel="noopener">friendswebhosting.com</a> and <a href="https://sitepages.in" target="_blank" rel="noopener">sitepages.in</a></p>',
						array( 'align' => 'center', 'text_color' => '#FFFFFF', '_css_classes' => 'vm-cta-info' )
					),
				)
			),
		)
	);

	return $d;
}
