<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Injured
 */

if ( ! function_exists( 'injured_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function injured_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'injured' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'injured_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function injured_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'injured' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'injured_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function injured_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'injured' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'injured' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'injured' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'injured' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'injured' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'injured' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'injured_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function injured_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

function ja_the_field($name = false, $before = '', $after = '', $sub_field = false, $option = false)
{
  if (!$name) {
    return;
  }

  $output = '';
  if (!$option) {
    if (!$sub_field && get_field($name)) {
      $output = get_field($name, false, false);
    } else if ($sub_field && get_sub_field($name)) {
      $output = get_sub_field($name);
    }
  } else {
    if (!$sub_field && get_field($name, 'option')) {
      $output = get_field($name, 'option');
    } else if ($sub_field && get_sub_field($name)) {
      $output = get_sub_field($name, 'option');
    }
  }

  if (!empty($output)) {
    echo $before . do_shortcode($output) . $after;
  }
}

/**
 * Return or echo attachment
 *
 * @param  integer $attachment_id Attachment ID
 * @param  string  $size         Thumbnail size
 * @param  boolean $classes      Whether to print the image class or return no class , default = no-class
 * @param  boolean $echo         Whether to print the image or return URL, default = false
 * @return Mixed                 Print <img> if $echo = true or return URL
 */
function ja_get_attachment($attachment_id = 0, $size = 'thumbnail', $classes = '', $echo = false)
{

  if (!$attachment_id) {
    return false;
  }

  if (!$echo) {
    return wp_get_attachment_image_url($attachment_id, $size);
  }

  $alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', TRUE);


  echo '<img src="' . wp_get_attachment_image_url($attachment_id, $size) . '" data-src="' . wp_get_attachment_image_url($attachment_id, $size) . '" class="' . $classes . '" alt="' . $alt . '"/>';
}

/**
 * Prints an anchor tag from an array of st-jane Link object
 */
function ja_the_link($link = array(),  $classes = '', $target = '', $before = '', $after = '', $attributes = '')
{

  if (!is_array($link) || !count($link)) {
    return;
  }

  $output = '';

  if (!empty($target)) {
    $link['target'] = $target;
  }

  $output .= '<a href="' . $link['url'] . '" class="' . $classes . '" target="' . $link['target'] . '"' . $attributes . '>' . $link['title'] . '</a>';

  if (!empty($output)) {
    echo $before . $output . $after;
  }
}
