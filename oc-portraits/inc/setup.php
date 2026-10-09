<?php
/**
 * Appearance → Site Setup: one-time helper that creates the starter pages
 * from the theme's page patterns, assigns the homepage and blog page,
 * creates the Contact Form 7 inquiry form, and adds draft blog outlines.
 *
 * It never overwrites or deletes existing content: pages whose slug already
 * exists are skipped, and posts are only created as drafts.
 *
 * @package oc-portraits
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Starter pages: slug => settings.
 *
 * @return array
 */
function ocp_setup_pages() {
	return array(
		'home'                 => array(
			'title'    => 'Home',
			'pattern'  => 'page-home',
			'template' => 'page-landing',
			'excerpt'  => 'Family, children’s, motherhood and maternity photography in Orange County by Zharmaine Boatman, based in Cypress. Studio and outdoor sessions.',
		),
		'families'             => array(
			'title'    => 'Family Photography in Orange County',
			'pattern'  => 'page-families',
			'template' => 'page-landing',
			'excerpt'  => 'Studio and outdoor family portraits in Orange County, planned with you and guided gently. Based in Cypress.',
		),
		'children'             => array(
			'title'    => 'Children’s Portraits',
			'pattern'  => 'page-children',
			'template' => 'page-landing',
			'excerpt'  => 'Children’s portraits in Orange County that capture personality, birthdays and milestones, in the studio or outdoors.',
		),
		'motherhood-maternity' => array(
			'title'    => 'Motherhood & Maternity Portraits',
			'pattern'  => 'page-motherhood',
			'template' => 'page-landing',
			'excerpt'  => 'Motherhood and maternity portraits in Orange County, in the studio or outdoors, by Cypress photographer Zharmaine Boatman.',
		),
		'experience-pricing'   => array(
			'title'    => 'Portrait Experience & Pricing',
			'pattern'  => 'page-experience-pricing',
			'template' => 'page-landing',
			'excerpt'  => 'How portrait sessions are planned, photographed and delivered, what each collection includes, and answers to common questions.',
		),
		'blog'                 => array(
			'title'    => 'The Portrait Journal',
			'pattern'  => '',
			'template' => '',
			'excerpt'  => 'Practical notes for planning family, children’s and motherhood portraits in Orange County.',
		),
		'about'                => array(
			'title'    => 'About Zharmaine Boatman',
			'pattern'  => 'page-about',
			'template' => 'page-landing',
			'excerpt'  => 'Meet Zharmaine Boatman, a Cypress-based photographer of families, children and mothers across Orange County.',
		),
		'for-photographers'    => array(
			'title'    => 'For Photographers & Organizations',
			'pattern'  => 'page-for-photographers',
			'template' => 'page-landing',
			'excerpt'  => 'Hire Zharmaine Boatman as an associate or second photographer, or to teach photography workshops for children, teens or adults.',
		),
		'contact'              => array(
			'title'    => 'Contact',
			'pattern'  => 'page-contact',
			'template' => 'page-landing',
			'excerpt'  => 'Send an inquiry for a family, children’s, motherhood or maternity session, associate photography, or a hosted workshop.',
		),
		'privacy'              => array(
			'title'    => 'Privacy Policy',
			'pattern'  => 'page-privacy',
			'template' => '',
			'excerpt'  => 'How Orange County Portraits handles information sent through this website.',
		),
	);
}

/**
 * Draft blog outlines (never published automatically).
 *
 * @return array
 */
function ocp_setup_post_outlines() {
	$families = home_url( '/families/' );
	$children = home_url( '/children/' );
	$pricing  = home_url( '/experience-pricing/' );
	return array(
		array(
			'title'    => 'What to Wear for Family Portraits',
			'category' => 'Session Planning',
			'points'   => array(
				'Coordinate rather than match: two or three colors that sit well together.',
				'Colors and textures that suit both studio backdrops and natural light (use your own examples).',
				'Comfort first for children: clothes they can sit, run and be held in.',
				'Layers and shoes for outdoor sessions.',
			),
			'links'    => '<a href="' . esc_url( $families ) . '">family sessions</a>',
		),
		array(
			'title'    => 'Preparing Children for a Portrait Session',
			'category' => 'Session Planning',
			'points'   => array(
				'Choosing a session time around naps and meals.',
				'What to tell children beforehand (and what not to promise).',
				'Bringing a favorite toy, book or snack.',
				'How parents can help during the session — and when to step back.',
			),
			'links'    => '<a href="' . esc_url( $children ) . '">children’s sessions</a>',
		),
		array(
			'title'    => 'Studio or Outdoors: Choosing Your Portrait Setting',
			'category' => 'Session Planning',
			'points'   => array(
				'What a studio session offers: consistent light, a clean look, no weather to plan around.',
				'What an outdoor session offers: natural light, movement, a sense of place.',
				'Questions to help families decide (children’s ages, the look you want, time of year).',
				'Costs to expect: studio rental, permits, admission or parking, confirmed before booking.',
			),
			'links'    => '<a href="' . esc_url( $pricing ) . '">the experience &amp; pricing</a>',
		),
		array(
			'title'    => 'Choosing a Location for Outdoor Portraits in Orange County',
			'category' => 'Locations',
			'points'   => array(
				'What makes a good portrait location: light, shade, space, and somewhere for children to move.',
				'Types of places to consider (parks, gardens, neighborhoods) — name only places you have photographed.',
				'Timing and crowds.',
				'IMPORTANT: verify current permit, fee and access rules directly with each location before publishing. Do not state permit information from memory.',
			),
			'links'    => '<a href="' . esc_url( $families ) . '">family sessions</a>',
		),
		array(
			'title'    => 'Printing Your Digital Portraits',
			'category' => 'Prints',
			'points'   => array(
				'What “full-resolution JPEG” means — and why it isn’t every photo or RAW files.',
				'Personal printing permission: what it covers.',
				'Choosing print sizes and a print lab (use labs you have actually used).',
				'Backing up your gallery downloads.',
			),
			'links'    => '<a href="' . esc_url( $pricing ) . '">what each collection includes</a>',
		),
	);
}

/**
 * CF7 form template.
 *
 * @return string
 */
function ocp_cf7_form_markup() {
	return <<<'FORM'
<label> Name
    [text* your-name autocomplete:name akismet:author] </label>

<label> Email
    [email* your-email autocomplete:email akismet:author_email] </label>

<label> Inquiry type
    [select* inquiry-type default:get include_blank "Family Session" "Children's Session" "Motherhood or Maternity" "Associate Photography" "Host a Workshop"] </label>

<label> Preferred dates <span class="ocp-field-hint">A few dates or a general time frame.</span>
    [text preferred-dates] </label>

<label> Location or setting <span class="ocp-field-hint">Studio, outdoors, an area you have in mind, or your venue.</span>
    [text location] </label>

<label> Message <span class="ocp-field-hint">Who’s included and what you have in mind. Organizations: add assignment requirements or details about your workshop audience (ages, group size).</span>
    [textarea* your-message x5] </label>

[submit "Send inquiry"]
FORM;
}

/**
 * Create (or find) the inquiry form and place it on the Contact page.
 *
 * @return string Result message.
 */
function ocp_setup_cf7() {
	if ( ! class_exists( 'WPCF7_ContactForm' ) ) {
		return 'Contact Form 7 is not active — install and activate it, then run this step again.';
	}
	$form_id = (int) get_option( 'ocp_cf7_form_id' );
	$form    = $form_id ? wpcf7_contact_form( $form_id ) : null;
	$created = false;

	if ( ! $form ) {
		$form = WPCF7_ContactForm::get_template( array( 'title' => 'Session inquiry' ) );
		$mail = $form->prop( 'mail' );

		$mail['subject']            = '[_site_title] inquiry: [inquiry-type] from [your-name]';
		$mail['body']               = "Name: [your-name]\nEmail: [your-email]\nInquiry type: [inquiry-type]\nPreferred dates: [preferred-dates]\nLocation or setting: [location]\n\nMessage:\n[your-message]\n\n--\nSent from the inquiry form at [_site_url]";
		$mail['additional_headers'] = 'Reply-To: [your-email]';
		$mail['recipient']          = '[_site_admin_email]';

		$messages                     = $form->prop( 'messages' );
		$messages['mail_sent_ok']     = 'Thank you — your inquiry has been sent. I’ll reply by email.';
		$messages['mail_sent_ng']     = 'Sorry, something went wrong and your inquiry wasn’t sent. Please try again in a few minutes.';
		$messages['validation_error'] = 'Please check the highlighted fields and try again.';
		$messages['spam']             = 'Sorry, your inquiry couldn’t be sent. Please try again.';

		$form->set_properties(
			array(
				'form'     => ocp_cf7_form_markup(),
				'mail'     => $mail,
				'mail_2'   => array_merge( $form->prop( 'mail_2' ), array( 'active' => false ) ),
				'messages' => $messages,
			)
		);
		$form->save();
		update_option( 'ocp_cf7_form_id', $form->id(), false );
		$created = true;
	}

	$page = get_page_by_path( 'contact' );
	$note = '';
	if ( $page && false !== strpos( $page->post_content, 'ocp-form-slot' ) ) {
		$shortcode = '<!-- wp:shortcode -->' . "\n" . $form->shortcode() . "\n" . '<!-- /wp:shortcode -->';
		$content   = preg_replace( '#<!-- wp:paragraph \{"className":"ocp-form-slot"\} -->.*?<!-- /wp:paragraph -->#s', $shortcode, $page->post_content, 1 );
		wp_update_post(
			array(
				'ID'           => $page->ID,
				'post_content' => wp_slash( $content ),
			)
		);
		$note = ' and placed on the Contact page';
	}
	return ( $created ? 'Inquiry form created' : 'Inquiry form already exists' ) . $note . '. Set the recipient address under Contact → Session inquiry → Mail.';
}

/**
 * Admin menu.
 */
function ocp_setup_menu() {
	add_theme_page( 'Site Setup', 'Site Setup', 'manage_options', 'ocp-setup', 'ocp_setup_screen' );
}
add_action( 'admin_menu', 'ocp_setup_menu' );

/**
 * Run the selected setup steps.
 *
 * @param array $steps Selected steps.
 * @param string $status Page status for new pages (draft|publish).
 * @return array Messages.
 */
function ocp_run_setup( $steps, $status = 'draft' ) {
	$log      = array();
	$registry = WP_Block_Patterns_Registry::get_instance();

	if ( in_array( 'pages', $steps, true ) ) {
		foreach ( ocp_setup_pages() as $slug => $page ) {
			if ( get_page_by_path( $slug, OBJECT, 'page' ) ) {
				$log[] = "Skipped “{$page['title']}” — /{$slug}/ already exists.";
				continue;
			}
			$content = '';
			if ( $page['pattern'] ) {
				$pattern = $registry->get_registered( 'oc-portraits/' . $page['pattern'] );
				$content = $pattern ? $pattern['content'] : '';
			}
			$id = wp_insert_post(
				array(
					'post_type'    => 'page',
					'post_status'  => 'publish' === $status ? 'publish' : 'draft',
					'post_title'   => $page['title'],
					'post_name'    => $slug,
					'post_content' => wp_slash( $content ),
					'post_excerpt' => $page['excerpt'],
				),
				true
			);
			if ( is_wp_error( $id ) ) {
				$log[] = "Could not create “{$page['title']}”: " . $id->get_error_message();
				continue;
			}
			if ( $page['template'] ) {
				update_post_meta( $id, '_wp_page_template', $page['template'] );
			}
			$log[] = "Created “{$page['title']}” (/{$slug}/) as " . ( 'publish' === $status ? 'published' : 'draft' ) . '.';
		}
	}

	if ( in_array( 'reading', $steps, true ) ) {
		$home = get_page_by_path( 'home' );
		$blog = get_page_by_path( 'blog' );
		if ( $home && $blog && 'publish' === $home->post_status && 'publish' === $blog->post_status ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home->ID );
			update_option( 'page_for_posts', $blog->ID );
			$log[] = 'Homepage set to “Home”; posts page set to “The Portrait Journal” (/blog/).';
		} else {
			$log[] = 'Homepage not changed: publish the Home and Blog pages first.';
		}
		if ( '' === get_option( 'permalink_structure' ) ) {
			update_option( 'permalink_structure', '/%postname%/' );
			$log[] = 'Permalinks set to “Post name”.';
		}
		$privacy = get_page_by_path( 'privacy' );
		if ( $privacy ) {
			update_option( 'wp_page_for_privacy_policy', $privacy->ID );
		}
		flush_rewrite_rules();
		$tagline = get_option( 'blogdescription' );
		if ( '' === $tagline || 'Just another WordPress site' === $tagline ) {
			update_option( 'blogdescription', 'Family, children’s & motherhood photography in Orange County' );
			$log[] = 'Tagline set.';
		}
	}

	if ( in_array( 'form', $steps, true ) ) {
		$log[] = ocp_setup_cf7();
	}

	if ( in_array( 'outlines', $steps, true ) ) {
		foreach ( ocp_setup_post_outlines() as $outline ) {
			$existing = get_posts(
				array(
					'post_type'   => 'post',
					'post_status' => 'any',
					'title'       => $outline['title'],
					'numberposts' => 1,
				)
			);
			if ( $existing ) {
				$log[] = "Skipped draft “{$outline['title']}” — already exists.";
				continue;
			}
			$cat = term_exists( $outline['category'], 'category' );
			if ( ! $cat ) {
				$cat = wp_insert_term( $outline['category'], 'category' );
			}
			$content  = ocp_p( '<strong>[Draft outline — write this article in your own words, add your own photographs, then publish.]</strong>', array( 'class' => 'ocp-note' ) );
			$content .= ocp_p( 'Opening: who this is for and the question it answers.' );
			foreach ( $outline['points'] as $point ) {
				$content .= ocp_heading( esc_html( $point ) ) . ocp_p( '…' );
			}
			$content .= ocp_p( 'Close with a contextual link to ' . $outline['links'] . ', and invite readers to <a href="' . ocp_inquiry_url() . '">plan a session</a>.' );
			wp_insert_post(
				array(
					'post_type'     => 'post',
					'post_status'   => 'draft',
					'post_title'    => $outline['title'],
					'post_content'  => wp_slash( $content ),
					'post_category' => is_array( $cat ) ? array( (int) $cat['term_id'] ) : array(),
				)
			);
			$log[] = "Created draft outline “{$outline['title']}”.";
		}
	}

	return $log;
}

/**
 * Setup screen.
 */
function ocp_setup_screen() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$log = array();
	if ( isset( $_POST['ocp_setup'] ) && check_admin_referer( 'ocp_setup' ) ) {
		$steps  = isset( $_POST['steps'] ) ? array_map( 'sanitize_key', (array) wp_unslash( $_POST['steps'] ) ) : array();
		$status = isset( $_POST['status'] ) && 'publish' === $_POST['status'] ? 'publish' : 'draft';
		$log    = ocp_run_setup( $steps, $status );
	}
	$cf7 = class_exists( 'WPCF7_ContactForm' );
	?>
	<div class="wrap">
		<h1>Orange County Portraits — Site Setup</h1>
		<p>Creates the starter pages from the theme’s patterns. Existing pages and posts are never changed or deleted, so it is safe to run again.</p>
		<?php if ( $log ) : ?>
			<div class="notice notice-success"><ul>
				<?php foreach ( $log as $line ) : ?>
					<li><?php echo esc_html( $line ); ?></li>
				<?php endforeach; ?>
			</ul></div>
		<?php endif; ?>

		<h2>Pages</h2>
		<table class="widefat striped" style="max-width:760px">
			<thead><tr><th>Page</th><th>Address</th><th>Status</th></tr></thead>
			<tbody>
			<?php foreach ( ocp_setup_pages() as $slug => $page ) : ?>
				<?php $existing = get_page_by_path( $slug ); ?>
				<tr>
					<td><?php echo esc_html( $page['title'] ); ?></td>
					<td>/<?php echo esc_html( $slug ); ?>/</td>
					<td><?php echo $existing ? esc_html( get_post_status_object( $existing->post_status )->label ) : '—'; ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<form method="post" style="margin-top:1.5rem">
			<?php wp_nonce_field( 'ocp_setup' ); ?>
			<fieldset>
				<p><label><input type="checkbox" name="steps[]" value="pages" checked> Create missing pages as
					<select name="status" aria-label="Status for new pages">
						<option value="draft">drafts (review first)</option>
						<option value="publish">published</option>
					</select></label></p>
				<p><label><input type="checkbox" name="steps[]" value="reading"> Use “Home” as the homepage and “The Portrait Journal” (/blog/) as the posts page, and switch to post-name permalinks if needed. <em>This changes what visitors see on the homepage.</em></label></p>
				<p><label><input type="checkbox" name="steps[]" value="form" <?php disabled( ! $cf7 ); ?> <?php checked( $cf7 ); ?>> Create the inquiry form and place it on the Contact page <?php echo $cf7 ? '' : '<em>(install and activate Contact Form 7 first)</em>'; ?></label></p>
				<p><label><input type="checkbox" name="steps[]" value="outlines"> Add five <strong>draft</strong> blog outlines (wardrobe, preparing children, studio vs outdoors, locations, printing). They are never published automatically.</label></p>
			</fieldset>
			<p><button type="submit" name="ocp_setup" value="1" class="button button-primary">Run selected steps</button></p>
		</form>
	</div>
	<?php
}
