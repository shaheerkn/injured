<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Injured
 */

?>

	<footer>
		<div class="container footer-content">
      <div class="footer-section">
        <div class="logo-container">
          <?php
            $footer_column_1 = get_field('footer_column_1', 'option');
            $logo = $footer_column_1['footer_logo'];
            if ( $logo ) :
              ja_get_attachment($logo, 'full', 'footer-logo', true);
            endif;

            $footer_text = $footer_column_1['footer_text'];
            if ( $footer_text ) :
          ?>
          <p class="footer-text">
              <?php echo $footer_text; ?>
            </p>
          <?php endif; ?>
        </div>
      </div>

      <div class="footer-section">
        <h3 class="section-title">Contact Info</h3>
        <div class="contact-info">
          <?php
            $footer_column_2 = get_field('footer_column_2', 'option');
            $address = $footer_column_2['address'];
            $email = $footer_column_2['email'];
            $phone = $footer_column_2['phone_number'];
            $phone_link = str_replace(['(', ')', '-', ' '], '', $phone);
            if ( $address ) :
              echo $address . '<p>&nbsp;</p>';
            endif;

            if ( $email ) :
              echo '<p><a href="mailto:' . $email . '">' . $email . '</a></p><p>&nbsp;</p>';
            endif;

            if ( $phone ) :
              echo '<p><a href="tel:+' .$phone_link . '">' . $phone . '</a></p>';
            endif;
          ?>
        </div>
      </div>

      <div class="footer-section" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="500">
        <h3 class="section-title">Stay Connected</h3>
        <div class="social-icons">
          <?php
            $footer_column_3 = get_field('footer_column_3', 'option');
            $social_icons = $footer_column_3['social_icons'];
            if ( $social_icons ) :
              foreach ( $social_icons as $social_icon ) :
                $social_link_url = $social_icon['link'];
                $social_link_icon = $social_icon['icon'];
                if ( $social_link_url && $social_link_icon ) :
                ?>
                  <a href="<?php echo $social_link_url; ?>" class="social-icon" aria-label="<?php echo $social_link_icon; ?>">
                    <?php ja_get_attachment($social_link_icon, 'full', 'social-icon', true); ?>
                  </a>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <?php 
          echo '<p>Copyright &copy; ' . date('Y') . ' InjuredNow</p>';
          ja_the_link(get_field('privacy_policy_link', 'option'), '', '', '<p>', '</p>');
        ?>
      </div>
    </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
