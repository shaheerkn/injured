<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Injured
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'injured' ); ?></a>

	<header id="masthead" class="site-header">
		<?php
			$phone_number = get_field('phone_number', 'option');
			$phone_number_link = str_replace(['(', ')', '-', ' '], '', $phone_number);
		?>
		<a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/main-logo.svg" alt="logo"></a>
		<?php if ( $phone_number ) : ?>
			<a href="#contact" class="contact-btn"><?php echo $phone_number; ?></a>
		<?php endif; ?>
		<a href="tel:+<?php echo $phone_number_link; ?>" class="hero-call-mobile">Call <span><?php echo $phone_number; ?></span></a>
	</header><!-- #masthead -->
