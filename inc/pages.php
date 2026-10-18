<?php
/**
 * Elementor designs: Home, Gallery, the header and the footer.
 *
 * @package Viewmail
 */

defined( 'ABSPATH' ) || exit;

/** Contact details used in the designs. Change them later in Elementor. */
function viewmail_contact() {
	return array(
		'phone'      => '9966222314',
		'phone_main' => '+919533394712',
		'phone_text' => '+91 95333 94712',
		'whatsapp'   => '919533394712',
		'email'      => 'sales@friendswebhosting.com',
		'domains'    => 'https://friendswebhosting.in/domain-registration/index.php?search=domain',
		'youtube'    => 'https://youtube.com',
	);
}

/** Pictures in the gallery, in order. */
function viewmail_gallery_images() {
	return array(
		'facebook-meta-ads'                      => 'Meta ads',
		'servers-hosting'                        => 'Servers and hosting',
		'wordpress-devlopement'                  => 'WordPress development',
		'dont-live-like-innocent'                => 'Do not live like an innocent business',
		'digital-marketing-analysis'             => 'Digital marketing analysis',
		'secure-dark-web'                        => 'Secure your data from the dark web',
		'marketing'                              => 'Marketing',
		'behaves-of-ai'                          => 'Behaviour of AI',
		'digital-secure-india'                   => 'Digital and secure India',
		'businesses-model'                       => 'Business model',
		'ads'                                    => 'Ads',
		'google-workspace'                       => 'Google Workspace',
		'campaigns-charges'                      => 'Campaign charges',
		'don-t-use-free-services'                => 'Do not use free services',
		'google-workspace-education'             => 'Google Workspace education',
		'it'                                     => 'IT',
		'google-ads'                             => 'Google Ads',
		'publicity'                              => 'Publicity',
		'data-books-damages'                     => 'Data book damages',
		'market-analysis'                        => 'Market analysis',
		'social-media'                           => 'Social media',
		'domains'                                => 'Domains',
		'media'                                  => 'Media',
		'vote-for-currency-member-ship-identity' => 'Vote for currency membership identity',
		'social-messages'                        => 'Social messages',
		'newspapers'                             => 'Newspapers',
	);
}

/** Every picture the theme brings, with its description (alt text). */
function viewmail_all_images( $seo = true ) {
	$images = array_merge(
		array(
			'header-collage'       => 'Business security: free apps, free email and publicity stunts',
			'country-code-domains' => '.in and .bharat IDN local language domains',
			'youtube-social-media' => 'Social media is a global exhibition media',
			'meta-verified-plans'  => 'META business verified plans',
			'promotion'            => 'Publicity and promotion costs',
			'newspaper-ads'        => 'Newspaper classified ads pricing',
			'website'              => 'Speed Post tariff for documents',
			'whatsapp-ads'         => 'Google Ads account overview',
			'logo'                 => 'viewmail.sitepages.in logo',
		),
		viewmail_gallery_images()
	);
	if ( $seo ) {
		foreach ( viewmail_image_overrides() as $slug => $over ) {
			if ( isset( $images[ $slug ] ) && ! empty( $over['alt'] ) ) {
				$images[ $slug ] = $over['alt'];
			}
		}
	}
	return $images;
}

/** Attachment ID of a theme picture (after setup imported it). */
function viewmail_image_id( $slug ) {
	$map = get_option( 'viewmail_images', array() );
	return isset( $map[ $slug ] ) && get_post( $map[ $slug ] ) ? (int) $map[ $slug ] : 0;
}

// Shared pieces

/** Centered section title like "Reliable Web Hosting & Domains in India". */
function viewmail_el_title( $text, $tag = 'h2', $size = 35 ) {
	return viewmail_el_heading( $text, $tag, $size, array( 'align' => 'center' ) );
}

/** Three pictures side by side that lift on hover. */
function viewmail_el_picture_row( $slugs ) {
	$all   = viewmail_all_images();
	$cards = array();
	foreach ( $slugs as $slug ) {
		$cards[] = viewmail_el_container(
			array_merge(
				viewmail_el_width( 3, 24, 3 ),
				array( 'css_classes' => 'vm-lift' )
			),
			array( viewmail_el_image( $slug, isset( $all[ $slug ] ) ? $all[ $slug ] : '' ) )
		);
	}
	return viewmail_el_row( $cards, 24, array( 'flex_align_items' => 'flex-start' ) );
}

/** A note box with a coloured edge. */
function viewmail_el_note( $children, $bg, $css, $extra = array() ) {
	return viewmail_el_container(
		array_merge(
			array(
				'background_background' => 'classic',
				'background_color'      => $bg,
				'padding'               => viewmail_el_box( 25, 40, 25, 40 ),
				'padding_mobile'        => viewmail_el_box( 20 ),
				'border_radius'         => viewmail_el_box( 8 ),
				'box_shadow_box_shadow_type' => 'yes',
				'box_shadow_box_shadow' => viewmail_el_shadow( 'rgba(0,0,0,0.05)', 2, 10 ),
				'flex_gap'              => viewmail_el_gap( 10 ),
				'css_classes'           => $css,
			),
			$extra
		),
		$children
	);
}

// Home

function viewmail_home_data() {
	$c = viewmail_contact();
	$d = array();

	// 1. Top picture, full width.
	$d[] = viewmail_el_container(
		array(
			'padding'     => viewmail_el_box( 0 ),
			'css_classes' => 'vm-hero',
		),
		array( viewmail_el_image( 'header-collage', viewmail_all_images()['header-collage'], array( 'width' => viewmail_el_px( 100, '%' ) ) ) )
	);

	// 2. The letter.
	$d[] = viewmail_el_section(
		array(
			'background_background' => 'classic',
			'background_color'      => '#FFFFFF',
			'flex_gap'              => viewmail_el_gap( 14 ),
			'padding'               => viewmail_el_box( 40, 25, 40, 25 ),
		),
		array(
			viewmail_el_heading( 'URGENT', 'h6', 13, array( 'title_color' => '#C62828', 'typography_letter_spacing' => viewmail_el_px( 1.5 ), 'typography_font_size_mobile' => viewmail_el_px( 12 ) ) ),
			viewmail_el_heading( 'The Hidden Risks of "Free" Digital Identities – Securing Our Professional Integrity', 'h1', 32 ),
			viewmail_el_text( '<p><strong>Dear Leaders, Officials, and Partners,</strong></p>', array( 'text_color' => '#1E293B' ) ),
			viewmail_el_text(
				'<p>In our rush toward "digitalization," we have reached a dangerous crossroads. It is time to distinguish between true digital infrastructure and public exhibition media. Using free email identities, free messaging apps, and social media stunts for professional operations is not innovation—it is a significant security liability. We must address the "Free Trap" before it compromises our institutional integrity.</p>',
				array( '_css_classes' => 'vm-intro', 'typography_font_style' => 'italic' )
			),
			viewmail_el_heading( '1. The "Free" Identity Crisis', 'h2', 22, array( '_margin' => viewmail_el_box( 14, 0, 0, 0 ) ) ),
			viewmail_el_text( '<p>Using a free email provider (e.g., @gmail.com, @yahoo.com) for official business signals a lack of professional permanency. More importantly, it lacks the encryption, administrative control, and legal protections of a paid, enterprise-grade domain. A free identity is a borrowed identity.</p>' ),
			viewmail_el_heading( '2. The Danger of Public Communication Tools', 'h2', 22, array( '_margin' => viewmail_el_box( 14, 0, 0, 0 ) ) ),
			viewmail_el_text(
				'<h3>Free Messaging Apps:</h3><p>Conducting official business on free WhatsApp or similar apps blends personal data with sensitive institutional information. This creates a "shadow IT" environment where data can be leaked, harvested, or lost without any recovery path.</p>'
				. '<h3>Video Calls &amp; Publicity Stunts:</h3><p>Relying on free, public video platforms for sensitive meetings exposes you to data mining and "Global Theatre" vulnerabilities. What happens in the "Public Drama Theatre" of social media stays in the data centers of third parties forever.</p>',
				array( '_css_classes' => 'vm-letter-text' )
			),
			viewmail_el_heading( '3. The Price of "Free" is Your Data', 'h2', 22, array( '_margin' => viewmail_el_box( 14, 0, 0, 0 ) ) ),
			viewmail_el_text(
				'<p>If you are not paying for the product, you (and your data) are the product. Free tools often come with:</p><ul>'
				. '<li><strong>Zero Accountability:</strong> No Service Level Agreements (SLA) or legal recourse if data is breached.</li>'
				. '<li><strong>Security Gaps:</strong> High vulnerability to phishing, spoofing, and identity theft.</li>'
				. '<li><strong>Reputational Damage:</strong> Corporate, educational, and government sectors lose credibility when they rely on "stunt-based" publicity rather than secure, owned platforms.</li></ul>',
				array( '_css_classes' => 'vm-letter-text' )
			),
			viewmail_el_container(
				array(
					'background_background' => 'classic',
					'background_color'      => '#111827',
					'padding'               => viewmail_el_box( 28, 32, 28, 32 ),
					'padding_mobile'        => viewmail_el_box( 22 ),
					'border_radius'         => viewmail_el_box( 6 ),
					'margin'                => viewmail_el_box( 20, 0, 20, 0 ),
					'flex_gap'              => viewmail_el_gap( 8 ),
				),
				array(
					viewmail_el_heading( 'The Step for Safety: Investment in Sovereignty', 'h2', 22, array( 'title_color' => '#FFFFFF' ) ),
					viewmail_el_text(
						'<p>To protect our future, we must move toward Paid, Professional, and Private ecosystems. Purchasing licensed software, dedicated servers, and encrypted communication suites is not an "expense"—it is an insurance policy for your data and your reputation.</p><p><strong>True digitalization requires ownership, not just participation.</strong></p>',
						array( 'text_color' => '#E2E8F0', '_css_classes' => 'vm-on-dark' )
					),
				)
			),
			viewmail_el_text( '<p><strong>Sincerely,<br>SITEPAGES TEAM</strong></p>', array( 'text_color' => '#1E293B' ) ),
		)
	);

	// 3. Price cards.
	$offer = function ( $title, $price, $per, $items, $from, $to ) use ( $c ) {
		return viewmail_el_container(
			array_merge(
				viewmail_el_width( 3, 30, 1 ),
				array(
					'background_background'  => 'gradient',
					'background_color'       => $from,
					'background_color_b'     => $to,
					'background_gradient_angle' => viewmail_el_px( 135, 'deg' ),
					'border_radius'          => viewmail_el_box( 12 ),
					'padding'                => viewmail_el_box( 45, 30, 45, 30 ),
					'flex_align_items'       => 'center',
					'flex_gap'               => viewmail_el_gap( 6 ),
					'css_classes'            => 'vm-offer',
				)
			),
			array(
				viewmail_el_heading( $title, 'h2', 26, array( 'align' => 'center', 'title_color' => '#FFFFFF', 'typography_font_weight' => '700' ) ),
				viewmail_el_heading( $price . ' <span>' . $per . '</span>', 'p', 35, array( 'align' => 'center', 'title_color' => '#FFFFFF', '_css_classes' => 'vm-price' ) ),
				viewmail_el_text( '<ul><li>' . implode( '</li><li>', $items ) . '</li></ul>', array( 'text_color' => '#FFFFFF', '_css_classes' => 'vm-offer-list', '_element_width' => 'initial', '_element_custom_width' => viewmail_el_px( 100, '%' ) ) ),
				viewmail_el_button( 'Call Now', 'tel:' . $c['phone'], array( '#FFFFFF', '#333333', '#F8F8F8' ), array( 'align' => 'center' ) ),
			)
		);
	};
	$d[] = viewmail_el_section(
		array( 'padding' => viewmail_el_box( 40, 25, 50, 25 ), 'flex_gap' => viewmail_el_gap( 30 ) ),
		array(
			viewmail_el_title( 'Reliable Web Hosting & Domains in India', 'h2', 35 ),
			viewmail_el_row(
				array(
					$offer( 'Google Workspace', '₹300/-', 'per month', array( 'Free domain &amp; DNS', 'Free cloud hosting', 'Business basic starter' ), '#3498DB', '#2980B9' ),
					$offer( 'Business Website', '₹ 6000/-', 'year', array( 'WordPress CMS website', '1 GB Space + Free SSL', 'Free SEO &amp; DNS Setup' ), '#E67E22', '#D35400' ),
					$offer( 'Business Email', '₹111/-', 'per month', array( '5 GB Secured Space', 'Web mail via Gmail support', 'Free Domain Included' ), '#27AE60', '#1E8449' ),
				),
				30
			),
		)
	);

	// 4. Digital growth.
	$growth = function ( $title, $text, $edge, $badge = '' ) {
		$kids = array();
		if ( $badge ) {
			$kids[] = viewmail_el_heading( $badge, 'span', 14, array( 'align' => 'center', 'title_color' => '#FFFFFF', 'typography_font_weight' => '700', 'typography_font_size_mobile' => viewmail_el_px( 13 ), '_css_classes' => 'vm-badge', '_element_width' => 'auto' ) );
		}
		$kids[] = viewmail_el_heading( $title, 'h3', 22, array( 'align' => 'center' ) );
		$kids[] = viewmail_el_text( '<p>' . $text . '</p>', array( 'align' => 'center', 'text_color' => '#666666' ) );
		return viewmail_el_container(
			array_merge(
				viewmail_el_width( 4, 25 ),
				array(
					'background_background' => 'classic',
					'background_color'      => '#F8F9FA',
					'border_radius'         => viewmail_el_box( 12 ),
					'border_border'         => 'solid',
					'border_width'          => viewmail_el_box( 0, 0, 6, 0 ),
					'border_color'          => $edge,
					'padding'               => viewmail_el_box( 40, 25, 40, 25 ),
					'flex_align_items'      => 'center',
					'flex_gap'              => viewmail_el_gap( 12 ),
					'css_classes'           => 'vm-hover-up',
				)
			),
			$kids
		);
	};
	$d[] = viewmail_el_section(
		array(
			'background_background'      => 'classic',
			'background_color'           => '#FFFFFF',
			'box_shadow_box_shadow_type' => 'yes',
			'box_shadow_box_shadow'      => viewmail_el_shadow( 'rgba(0,0,0,0.05)', 10, 30 ),
			'padding'                    => viewmail_el_box( 50, 25, 50, 25 ),
			'flex_gap'                   => viewmail_el_gap( 30 ),
		),
		array(
			viewmail_el_container(
				array( 'flex_gap' => viewmail_el_gap( 8 ) ),
				array(
					viewmail_el_title( 'Professional Digital Growth & Infrastructure', 'h2', 35 ),
					viewmail_el_text( '<p>Expert solutions for manufacturers and small to mid-sized industries.</p>', array( 'align' => 'center', 'text_color' => '#555555', 'typography_font_size' => viewmail_el_px( 17 ) ) ),
				)
			),
			viewmail_el_row(
				array(
					$growth( 'Google &amp; Microsoft Ads', 'Targeted display and text ads with expert bidding strategies to grow your publicity.', '#0A2351', 'Starts ₹20/Day' ),
					$growth( 'Servers &amp; Domains', 'Secure domain sales and enterprise-grade servers via <strong>friendswebhosting.in</strong>.', '#FFB400' ),
					$growth( 'Admin Services', 'Dedicated managers for server/website administration and web design on a work/hour basis.', '#0A2351' ),
					$growth( 'Email Marketing', 'Professional outreach and Google Workspace (Paid) solutions to keep your data secure.', '#FFB400' ),
				)
			),
			viewmail_el_container(
				array(
					'background_background' => 'classic',
					'background_color'      => '#FFF5F5',
					'border_border'         => 'solid',
					'border_width'          => viewmail_el_box( 0, 0, 0, 5 ),
					'border_color'          => '#E53E3E',
					'border_radius'         => viewmail_el_box( 6 ),
					'padding'               => viewmail_el_box( 20 ),
				),
				array( viewmail_el_text( '<p><strong>⚠ Risk Warning:</strong> Using "free" publicity stunts, social media spam, or unverified tools can damage your business. Machine learning analysis and cyber-threats can cause data loss and economic damage. Use professional paid campaigns for secure growth.</p>', array( 'text_color' => '#333333' ) ) )
			),
			viewmail_el_container(
				array(
					'background_background' => 'classic',
					'background_color'      => '#0A2351',
					'border_radius'         => viewmail_el_box( 15 ),
					'padding'               => viewmail_el_box( 50, 20, 50, 20 ),
					'flex_align_items'      => 'center',
					'flex_gap'              => viewmail_el_gap( 28 ),
				),
				array(
					viewmail_el_heading( 'Ready for a Free Consultation?', 'h3', 28, array( 'align' => 'center', 'title_color' => '#FFFFFF', 'typography_font_weight' => '700' ) ),
					viewmail_el_row(
						array(
							viewmail_el_button( 'Visit friendswebhosting.com', 'https://friendswebhosting.com', array( '#FFB400', '#000000', '#E6A200' ), array( 'text_padding' => viewmail_el_box( 16, 35, 16, 35 ), 'typography_font_size' => viewmail_el_px( 17 ) ) ),
							viewmail_el_button( 'Visit sitepages.in', 'https://sitepages.in', array( '#FFFFFF', '#0A2351', '#F1F5F9' ), array( 'text_padding' => viewmail_el_box( 16, 35, 16, 35 ), 'typography_font_size' => viewmail_el_px( 17 ) ) ),
						),
						25
					),
					viewmail_el_text(
						'<p>Call/WhatsApp: <a href="tel:' . $c['phone_main'] . '"><strong>' . $c['phone_text'] . '</strong></a> | <a class="vm-wa-link" href="https://wa.me/' . $c['whatsapp'] . '"><strong>Chat</strong></a> | Email: <a href="mailto:' . $c['email'] . '"><strong>' . $c['email'] . '</strong></a></p>',
						array( 'align' => 'center', 'text_color' => '#FFFFFF', '_css_classes' => 'vm-cta-info' )
					),
				)
			),
		)
	);

	// 5. Local language domains.
	$domains = array();
	foreach ( array( '.in', '.ai.in', '.भारत', '.భారత్', '.com.in', '.5g.in', '.ಭಾರತ', '.ഭാരതം' ) as $name ) {
		$domains[] = viewmail_el_heading(
			$name,
			'div',
			14,
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
		array( 'padding' => viewmail_el_box( 10, 25, 30, 25 ) ),
		array(
			viewmail_el_container(
				array(
					'background_background' => 'classic',
					'background_color'      => '#FFFFFF',
					'border_border'         => 'solid',
					'border_width'          => viewmail_el_box( 1 ),
					'border_color'          => '#E1E8ED',
					'border_radius'         => viewmail_el_box( 20 ),
					'padding'               => viewmail_el_box( 30 ),
					'padding_mobile'        => viewmail_el_box( 18 ),
					'flex_align_items'      => 'center',
					'flex_gap'              => viewmail_el_gap( 25 ),
				),
				array(
					viewmail_el_heading( '.in .bharat (IDN) Local Language Domains', 'h3', 18, array( 'align' => 'center', 'typography_font_weight' => '700' ) ),
					viewmail_el_row( $domains, 15 ),
					viewmail_el_image( 'country-code-domains', 'Country Code Domains Reference', array( '_css_classes' => 'vm-rounded-shadow' ) ),
				)
			),
		)
	);

	// 6. Notes.
	$d[] = viewmail_el_section(
		array( 'padding' => viewmail_el_box( 10, 25, 40, 25 ), 'flex_gap' => viewmail_el_gap( 25 ) ),
		array(
			viewmail_el_note(
				array( viewmail_el_icon_box( 'fas fa-user-tie', 'Professional Requirement Note', '<strong>Note:</strong> business person, shop/industry/company founders, managing directors, CEO, govt departments officials, professionals,.. Should need to use personal /business/ family purpose domain mail, other secured software products use in paid base.', '#003366', '#003366' ) ),
				'#F0F7FF',
				'vm-note vm-note--blue'
			),
			viewmail_el_note(
				array(
					viewmail_el_icon_box( 'fab fa-youtube', 'Digital Technology Education', 'For better knowledge, digital technology education visit our YouTube channel; observe smart mobile features, Useful videos in the ‘youtube’', '#333333', '#333333', array( 'position' => 'top', 'text_align' => 'center', 'icon_space' => viewmail_el_px( 6 ) ) ),
					viewmail_el_button(
						'Subscribe & Learn',
						$c['youtube'],
						array( '#FF0000', '#FFFFFF', '#CC0000' ),
						array(
							'align'           => 'center',
							'align_mobile'    => 'justify',
							'border_radius'   => viewmail_el_box( 50 ),
							'text_padding'    => viewmail_el_box( 14, 35, 14, 35 ),
							'typography_font_size' => viewmail_el_px( 17 ),
							'selected_icon'   => array( 'value' => 'fab fa-youtube', 'library' => 'fa-brands' ),
							'icon_indent'     => viewmail_el_px( 8 ),
						)
					),
				),
				'#FFFFFF',
				'vm-note vm-note--dashed',
				array( 'flex_align_items' => 'center', 'flex_gap' => viewmail_el_gap( 16 ) )
			),
			viewmail_el_note(
				array(
					viewmail_el_icon_box( 'fas fa-envelope-open-text', 'Important: Inbox Delivery', '<strong>Note:</strong> In case you are receiving our e-mail in your Junk-mail/Spam, mark this e-mail as <strong>Not Junk/Spam</strong> or add it to your Safe Sender’s list, and again once give star mark to our mail in your mail box. Remember sometimes our services, concepts are all favour to you, for your brand image, data security, cyber security, good products promotes and sales.', '#D4A017', '#D4A017' ),
					viewmail_el_heading( 'Subscribe or love and refer to others about our brand.', 'p', 17, array( 'title_color' => '#138808', 'typography_font_weight' => '700', '_margin' => viewmail_el_box( 0, 0, 0, 32 ), '_margin_mobile' => viewmail_el_box( 0 ) ) ),
				),
				'#FFFBEF',
				'vm-note vm-note--gold'
			),
			viewmail_el_icon_box(
				'fas fa-exclamation-triangle',
				'',
				'As per public data you/your organization is open source, nowadays cyber security threats, data loss, Some economical growth damages happening to the <span class="vm-bharat">Bharat</span> via fraud services, frauds information, through Internet Technology. Serve to the “BHARAT” be a good person/organization.',
				'#DC3545',
				'#333333',
				array( 'title_bottom_space' => viewmail_el_px( 0 ) )
			),
		)
	);

	// 7. Logical reasoning pictures.
	$d[] = viewmail_el_section(
		array(
			'background_background' => 'classic',
			'background_color'      => '#FFFFFF',
			'flex_gap'              => viewmail_el_gap( 30 ),
		),
		array(
			viewmail_el_title( 'Logical Reasoning & Quantitative Aptitude', 'h2', 35 ),
			viewmail_el_picture_row( array( 'youtube-social-media', 'meta-verified-plans', 'dont-live-like-innocent' ) ),
		)
	);

	// 8. Google Ads business portal.
	$d[] = viewmail_el_container(
		array(
			'content_width'         => 'boxed',
			'boxed_width'           => viewmail_el_px( 1400 ),
			'background_background' => 'gradient',
			'background_color'      => '#1A73E8',
			'background_color_b'    => '#0D47A1',
			'background_gradient_angle' => viewmail_el_px( 135, 'deg' ),
			'border_radius'         => viewmail_el_box( 0, 0, 24, 24 ),
			'padding'               => viewmail_el_box( 30, 20, 26, 20 ),
			'flex_align_items'      => 'center',
			'flex_gap'              => viewmail_el_gap( 6 ),
		),
		array(
			viewmail_el_heading( 'Google Ads Business Portal', 'h2', 35, array( 'align' => 'center', 'title_color' => '#FFFFFF' ) ),
			viewmail_el_text( '<p>Simple Knowledge • Real Pricing • Live Preview</p>', array( 'align' => 'center', 'text_color' => '#FFFFFF' ) ),
			viewmail_el_widget(
				'divider',
				array(
					'style'  => 'solid',
					'weight' => viewmail_el_px( 5 ),
					'color'  => '#FBBC05',
					'width'  => viewmail_el_px( 60 ),
					'align'  => 'center',
					'gap'    => viewmail_el_px( 4 ),
					'_css_classes' => 'vm-accent-line',
				)
			),
		)
	);

	$peach = function ( $title, $text, $color ) {
		return viewmail_el_container(
			array_merge(
				viewmail_el_width( 3, 20 ),
				array(
					'background_background' => 'classic',
					'background_color'      => '#FFFFFF',
					'border_radius'         => viewmail_el_box( 18 ),
					'border_border'         => 'solid',
					'border_width'          => viewmail_el_box( 0, 0, 6, 0 ),
					'border_color'          => $color,
					'box_shadow_box_shadow_type' => 'yes',
					'box_shadow_box_shadow' => viewmail_el_shadow( 'rgba(0,0,0,0.05)', 4, 15 ),
					'padding'               => viewmail_el_box( 25 ),
					'flex_gap'              => viewmail_el_gap( 8 ),
					'css_classes'           => 'vm-hover-up',
				)
			),
			array(
				viewmail_el_heading( $title, 'h3', 20, array( 'title_color' => $color ) ),
				viewmail_el_text( '<p>' . $text . '</p>' ),
			)
		);
	};
	$d[] = viewmail_el_section(
		array( 'padding' => viewmail_el_box( 30, 25, 30, 25 ), 'flex_gap' => viewmail_el_gap( 30 ) ),
		array(
			viewmail_el_heading( '1. Brief Knowledge: How it Works', 'h2', 17, array( 'align' => 'center', 'title_color' => '#1A73E8', 'typography_font_weight' => '700', 'typography_font_size_mobile' => viewmail_el_px( 16 ), '_css_classes' => 'vm-pill' ) ),
			viewmail_el_row(
				array(
					$peach( 'What are you buying?', 'You aren\'t buying a "spot." You are buying <b>Genuine Visitors</b>. Google only charges you when a customer actually clicks your ad.', '#0D47A1' ),
					$peach( 'Where do ads show?', 'On Google Search, YouTube, and Gmail. We target people specifically in your city or pincode area.', '#EA4335' ),
					$peach( 'Why is it better?', 'Unlike newspapers, you can track exactly how many people saw your ad and how many <b>called you</b>.', '#2A7445' ),
				),
				20
			),
			viewmail_el_widget(
				'viewmail-ad-studio',
				array(
					'title'      => '2. Create Your Ad Preview',
					'badge'      => 'Professional Configurator',
					'goals'      => "Increase Website Visits\nMaximize Direct Sales\nBoost Inbound Calls",
					'budget'     => 1000,
					'multiplier' => 50,
				)
			),
			viewmail_el_widget(
				'viewmail-bid-calculator',
				array(
					'title'  => '3. Bidding: Money vs. Visitors',
					'intro'  => 'Google Ads works on an <b>Auction System</b>. Depending on your business, the original price per click (CPC) changes.',
					'budget' => 500,
					'types'  => array(
						array( '_id' => viewmail_el_id(), 'label' => 'Local Shop / General (₹12 per click)', 'cpc' => 12, 'default' => '' ),
						array( '_id' => viewmail_el_id(), 'label' => 'Professional Services (₹25 per click)', 'cpc' => 25, 'default' => 'yes' ),
						array( '_id' => viewmail_el_id(), 'label' => 'Real Estate / Finance (₹60 per click)', 'cpc' => 60, 'default' => '' ),
					),
				)
			),
			viewmail_el_button(
				'Contact Us & Make your Promotion Live',
				'tel:+91' . $c['phone'],
				array( '#1A73E8', '#FFFFFF', '#1557B0' ),
				array(
					'align'          => 'center',
					'border_radius'  => viewmail_el_box( 50 ),
					'text_padding'   => viewmail_el_box( 18, 40, 18, 40 ),
					'_css_classes'   => 'vm-wide-button',
				)
			),
		)
	);

	// 9. Web app demos.
	$d[] = viewmail_el_section(
		array( 'padding' => viewmail_el_box( 20, 25, 30, 25 ), 'flex_gap' => viewmail_el_gap( 10 ) ),
		array(
			viewmail_el_title( 'Demo views check web app scripts for website', 'h2', 32 ),
			viewmail_el_widget(
				'viewmail-demo-explorer',
				array(
					'label'       => 'Explore Web App Demos',
					'placeholder' => 'Type to search...',
					'demos'       => viewmail_default_demos(),
				)
			),
			viewmail_el_container(
				array(
					'background_background'      => 'classic',
					'background_color'           => '#FFFFFF',
					'border_border'              => 'solid',
					'border_width'               => viewmail_el_box( 5, 0, 0, 0 ),
					'border_color'               => '#E74C3C',
					'border_radius'              => viewmail_el_box( 15 ),
					'box_shadow_box_shadow_type' => 'yes',
					'box_shadow_box_shadow'      => viewmail_el_shadow( 'rgba(0,0,0,0.05)', 5, 20 ),
					'padding'                    => viewmail_el_box( 40 ),
					'padding_mobile'             => viewmail_el_box( 24 ),
					'margin'                     => viewmail_el_box( 20, 0, 0, 0 ),
				),
				array( viewmail_el_icon_box( 'fas fa-shield-alt', 'Data Protection Strategy', 'Avoid leaking business info via free chat apps. We recommend utilizing <strong>Google Ads</strong> for a controlled, professional publicity campaign that offers better data security and analysis tools.', '#0A2351', '#0A2351' ) )
			),
		)
	);

	// 10. Why pay for physical services.
	$d[] = viewmail_el_section(
		array(
			'background_background' => 'classic',
			'background_color'      => '#FFFFFF',
			'flex_gap'              => viewmail_el_gap( 30 ),
		),
		array(
			viewmail_el_title( 'Why Pay for Physical Services but Risk Your Digital Data for Free?', 'h2', 35 ),
			viewmail_el_picture_row( array( 'don-t-use-free-services', 'campaigns-charges', 'promotion' ) ),
		)
	);

	// 11. Global strategy.
	$d[] = viewmail_el_section(
		array( 'padding' => viewmail_el_box( 30, 25, 30, 25 ) ),
		array(
			viewmail_el_container(
				array(
					'background_background'      => 'classic',
					'background_color'           => '#FFFFFF',
					'border_border'              => 'solid',
					'border_width'               => viewmail_el_box( 0, 0, 0, 6 ),
					'border_color'               => '#3498DB',
					'border_radius'              => viewmail_el_box( 15 ),
					'box_shadow_box_shadow_type' => 'yes',
					'box_shadow_box_shadow'      => viewmail_el_shadow( 'rgba(0,0,0,0.05)', 4, 15 ),
					'padding'                    => viewmail_el_box( 40 ),
					'padding_mobile'             => viewmail_el_box( 24 ),
				),
				array( viewmail_el_icon_box( 'fas fa-globe', 'Global Business Strategy', 'For manufacturers and exporters: use social media as a Global Industrial Exhibition with your domain brand, and utilize Paid Digital Marketing for secure growth.', '#0A2351', '#0A2351' ) )
			),
		)
	);

	// 12. Premium solutions.
	$d[] = viewmail_el_section(
		array(
			'background_background' => 'classic',
			'background_color'      => '#FFFFFF',
			'flex_gap'              => viewmail_el_gap( 30 ),
		),
		array(
			viewmail_el_title( 'Premium Business Solutions: Workspace, Web, and Secured Email', 'h2', 35 ),
			viewmail_el_picture_row( array( 'newspaper-ads', 'website', 'whatsapp-ads' ) ),
		)
	);

	return $d;
}

// Gallery

function viewmail_gallery_data() {
	$gallery = array();
	foreach ( viewmail_gallery_images() as $slug => $alt ) {
		$id = viewmail_image_id( $slug );
		if ( $id ) {
			$gallery[] = array(
				'id'  => $id,
				'url' => wp_get_attachment_url( $id ),
			);
		}
	}
	return array(
		viewmail_el_section(
			array( 'padding' => viewmail_el_box( 40, 30, 50, 30 ), 'padding_mobile' => viewmail_el_box( 30, 16, 40, 16 ) ),
			array(
				viewmail_el_widget(
					'image-gallery',
					array(
						'wp_gallery'      => $gallery,
						'thumbnail_size'  => 'large',
						'gallery_columns' => '2',
						'gallery_columns_mobile' => '1',
						'gallery_link'    => 'file',
						'open_lightbox'   => 'yes',
						'image_spacing'   => 'custom',
						'image_spacing_custom' => viewmail_el_px( 30 ),
						'image_border_radius' => viewmail_el_box( 20 ),
						'_css_classes'    => 'vm-gallery',
					)
				),
			)
		),
	);
}

// Header and footer (Elementor Header & Footer Builder templates)

function viewmail_header_data( $menu_slug ) {
	return array(
		viewmail_el_container(
			array(
				'flex_direction'        => 'row',
				'flex_justify_content'  => 'space-between',
				'flex_align_items'      => 'center',
				'flex_wrap'             => 'nowrap',
				'background_background' => 'classic',
				'background_color'      => 'rgba(255,255,255,0.92)',
				'border_border'         => 'solid',
				'border_width'          => viewmail_el_box( 0, 0, 1, 0 ),
				'border_color'          => '#E2E8F0',
				'padding'               => viewmail_el_box( 15, 110, 15, 110 ),
				'padding_tablet'        => viewmail_el_box( 15, 30, 15, 30 ),
				'padding_mobile'        => viewmail_el_box( 12, 16, 12, 16 ),
				'css_classes'           => 'vm-header',
			),
			array(
				viewmail_el_container(
					array(
						'width'        => array( 'unit' => 'custom', 'size' => 'auto' ),
						'width_mobile' => array( 'unit' => 'custom', 'size' => 'auto' ),
						'_flex_size'   => 'none',
						'flex_gap'     => viewmail_el_gap( 0 ),
						'css_classes'  => 'vm-brand',
					),
					array(
						viewmail_el_heading(
							'viewmail.sitepages.in',
							'div',
							24,
							array(
								'link'                        => array( 'url' => home_url( '/' ), 'is_external' => '', 'nofollow' => '' ),
								'title_color'                 => '#4285F4',
								'typography_font_size_mobile' => viewmail_el_px( 18 ),
							)
						),
						viewmail_el_heading(
							'digital intelligence',
							'div',
							11,
							array(
								'title_color'                 => '#64748B',
								'typography_font_weight'      => '600',
								'typography_font_size_mobile' => viewmail_el_px( 11 ),
							)
						),
					)
				),
				viewmail_el_widget(
					'navigation-menu',
					array(
						'menu'                          => $menu_slug,
						'layout'                        => 'horizontal',
						'navmenu_align'                 => 'right',
						'pointer'                       => 'none',
						'dropdown'                      => 'tablet',
						'resp_align'                    => 'center',
						'full_width_dropdown'           => 'yes',
						'menu_typography_typography'    => 'custom',
						'menu_typography_font_family'   => 'Plus Jakarta Sans',
						'menu_typography_font_weight'   => '700',
						'menu_typography_font_size'     => viewmail_el_px( 13.6 ),
						'menu_typography_text_transform' => 'uppercase',
						'color_menu_item'               => '#0F172A',
						'color_menu_item_hover'         => '#4285F4',
						'color_menu_item_active'        => '#FFFFFF',
						'bg_color_menu_item_active'     => '#4285F4',
						'color_dropdown_item'           => '#0F172A',
						'background_color_dropdown_item' => '#FFFFFF',
						'toggle_color'                  => '#0F172A',
						'padding_horizontal_menu_item'  => viewmail_el_px( 16 ),
						'padding_vertical_menu_item'    => viewmail_el_px( 8 ),
						'menu_space_between'            => viewmail_el_px( 10 ),
						'_css_classes'                  => 'vm-menu',
						'_flex_size'                    => 'grow',
					)
				),
			)
		),
	);
}

function viewmail_footer_data() {
	$c    = viewmail_contact();
	$link = function ( $text, $url ) {
		$external = 0 === strpos( $url, 'http' ) && false === strpos( $url, home_url() );
		return '<a href="' . esc_url( $url ) . '"' . ( $external ? ' target="_blank" rel="noopener"' : '' ) . '>' . $text . '</a>';
	};
	$list = function ( $items ) {
		return '<ul><li>' . implode( '</li><li>', $items ) . '</li></ul>';
	};
	$col = function ( $title, $html ) {
		return viewmail_el_container(
			array_merge(
				viewmail_el_width( 4, 30, 2 ),
				array( 'flex_gap' => viewmail_el_gap( 8 ), 'css_classes' => 'vm-footer__col' )
			),
			array(
				viewmail_el_heading( $title, 'h4', 16, array( 'title_color' => '#FFFFFF', 'typography_font_weight' => '700' ) ),
				viewmail_el_text( $html, array( 'text_color' => '#94A3B8', 'typography_font_size' => viewmail_el_px( 14 ) ) ),
			)
		);
	};
	return array(
		viewmail_el_container(
			array(
				'background_background' => 'classic',
				'background_color'      => '#0F172A',
				'css_classes'           => 'vm-footer',
			),
			array(
				viewmail_el_section(
					array( 'padding' => viewmail_el_box( 50, 25, 30, 25 ), 'flex_gap' => viewmail_el_gap( 30 ) ),
					array(
						viewmail_el_row(
							array(
								$col(
									'Friends Web Hosting',
									'<p>Secure, paid and private digital infrastructure for Indian businesses: ' . $link( 'web hosting', 'https://friendswebhosting.com' ) . ', domains, email and websites.</p><p>' . $link( 'friendswebhosting.com', 'https://friendswebhosting.com' ) . '</p>'
								),
								$col(
									'Hosting &amp; Domains',
									$list(
										array(
											$link( 'cPanel web hosting in India', 'https://friendswebhosting.com' ),
											$link( 'Dedicated servers', 'https://friendswebhosting.in' ),
											$link( '.in &amp; .bharat domain registration', $c['domains'] ),
											$link( 'Search a domain name', $c['domains'] ),
										)
									)
								),
								$col(
									'Our Services',
									$list(
										array(
											$link( 'All services', home_url( '/services/' ) ),
											$link( 'Google Workspace &amp; business email', home_url( '/services/' ) ),
											$link( 'WordPress website development', home_url( '/services/' ) ),
											$link( 'Google Ads bidding calculator', home_url( '/' ) ),
										)
									)
								),
								$col(
									'Contact',
									'<p>' . $link( $c['phone_text'], 'tel:' . $c['phone_main'] ) . '<br>' . $link( $c['email'], 'mailto:' . $c['email'] ) . '</p><p>' . $link( 'Chat on WhatsApp', 'https://wa.me/' . $c['whatsapp'] ) . ' | ' . $link( 'sitepages.in', 'https://sitepages.in' ) . '</p>'
								),
							),
							30,
							array( 'flex_justify_content' => 'flex-start' )
						),
						viewmail_el_text(
							'<p>© ' . gmdate( 'Y' ) . ' <strong>viewmail.sitepages.in</strong> · Hosting and domains by ' . $link( 'Friends Web Hosting', 'https://friendswebhosting.com' ) . '</p>',
							array( 'align' => 'center', 'text_color' => '#94A3B8', '_css_classes' => 'vm-footer__copy' )
						),
					)
				),
			)
		),
	);
}
