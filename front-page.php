<?php
/**
 * The template for displaying the front page
 * 
 * @package Injured
 */

get_header();
?>

<main>
    <section class="hero">
      <?php ja_get_attachment(get_field('hero_background_image'), 'full', 'hero-bg', true); ?>
  
      <div class="container">
       <div class="hero-content">
          <?php
            ja_the_field('hero_title', '<h1>', '</h1>'); 
            ja_the_field('hero_description', '<p>', '</p>');

            $hero_cta = get_field('hero_cta');
            if ($hero_cta) {
              echo '<a href="' . esc_url($hero_cta['url']) . '" class="hero-btn" target="' . esc_attr($hero_cta['target']) . '">' . esc_html($hero_cta['title']) . '<span class="arrow">&#10095;</span></a>';
            }
          ?>
        </div>
      </div>
      <?php
        $hero_image = get_field('hero_image');
        if ($hero_image) {
          echo '<img src="' . esc_url($hero_image['url']) . '" alt="' . esc_attr($hero_image['alt']) . '" class="hero-ian" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="500">';
        }
      ?>
    </section>
  
    <section class="img-w-text">
      <div class="container">
        <div class="img-w-text-content">
          <?php
            ja_the_field('testimonial_subtitle', '<h4>', '</h4>');
            ja_the_field('testimonial_title', '<h2>', '</h2>');

            $testimonial_video = get_field('testimonial_video');
          ?>

          <?php if ($testimonial_video) :?>
          <div class="img-w-text-img img-w-text-img-mobile">
            <?php
              echo '<iframe width="100%" height="100%" src="' . esc_url($testimonial_video) . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
            ?>
          </div>
          <?php endif; ?>
          <?php ja_the_field('testimonial_description', '<p>', '</p>'); ?>
          <?php
            $testimonial_cta = get_field('testimonial_cta');
            if ($testimonial_cta) {
              echo '<a href="' . esc_url($testimonial_cta['url']) . '" class="contact-btn img-w-text-btn" target="' . esc_attr($testimonial_cta['target']) . '">' . esc_html($testimonial_cta['title']) . ' <span class="arrow">&#10095;</span></a>';
            }
          ?>
        </div>
            
        <?php if ($testimonial_video) :?>
        <div class="img-w-text-img img-w-text-img-desktop">
          <?php
            echo '<iframe width="100%" height="100%" src="' . esc_url($testimonial_video) . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
          ?>
        </div>
        <?php endif; ?>
      </div>
    </section>
  
    <section class="stats">
      <div class="container">
        <div class="left-column">
            <?php
              ja_the_field('stats_subtitle', '<div class="subtitle">', '</div>');
              ja_the_field('stats_title', '<h1 class="main-title">', '</h1>');
              echo '<div class="paragraph">' . get_field('stats_description') . '</div>';

              if (have_rows('features')) :
                echo '<div class="features">';
                  while (have_rows('features')) : the_row();
                    echo '<div class="feature-item">';
                    echo '<div class="checkmark">✓</div>';
                    echo '<div class="feature-text">' . get_sub_field('feature') . '</div>';
                    echo '</div>';
                  endwhile;
                echo '</div>';
              endif;

              $stats_cta = get_field('stats_cta');
              if ($stats_cta) {
                echo '<a href="' . esc_url($stats_cta['url']) . '" class="contact-btn for-desktop" target="' . esc_attr($stats_cta['target']) . '">' . esc_html($stats_cta['title']) . ' <span class="arrow">&#10095;</span></a>';
              }
            ?>
        </div>
        
        <div class="right-column">
          <div class="result-items">
            <?php
              if (have_rows('results')) :
                while (have_rows('results')) : the_row();
                  $price = get_sub_field('price');
                  $price_digits = str_replace(['$', ',', ' '], '', $price);
                  echo '<div class="result-item">';
                    echo '<div class="price" data-value="' . $price_digits . '">' . $price . '</div>';
                    echo '<div class="description">' . get_sub_field('description') . '</div>';
                  echo '</div>';
                endwhile;
              endif;
            ?>
          </div>

          <?php
            if ($stats_cta) {
              echo '<a href="' . esc_url($stats_cta['url']) . '" class="contact-btn for-mobile" target="' . esc_attr($stats_cta['target']) . '">' . esc_html($stats_cta['title']) . ' <span class="arrow">&#10095;</span></a>';
            }

            ja_the_field('stats_disclaimer', '<div class="disclaimer">', '</div>');
          ?>
        </div>
      </div>
    </section>
  
    <section id="contact" class="contact" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
      <div class="contact-container">
        <?php
          ja_the_field('contact_subtitle', '<div class="contact-subtitle">', '</div>');
          ja_the_field('contact_title', '<h1 class="contact-title">', '</h1>');
          ja_the_field('contact_description', '<p class="contact-description">', '</p>');
        ?>
  
        <form class="contact-form">
            <div class="contact-form-group">
                <input type="text" class="contact-input" placeholder="First Name:" required>
            </div>
  
            <div class="contact-form-group">
                <input type="text" class="contact-input" placeholder="Last Name:" required>
            </div>
  
            <div class="contact-form-group">
                <input type="text" class="contact-input" placeholder="Case Type" required>
            </div>
  
            <div class="contact-form-group">
                <input type="text" class="contact-input" placeholder="Injury Date:" required>
            </div>
  
            <div class="contact-form-group">
                <input type="tel" class="contact-input" placeholder="Phone:" required>
            </div>
  
            <div class="contact-form-group">
                <input type="email" class="contact-input" placeholder="E-mail:" required>
            </div>
  
            <div class="contact-form-group full-width">
                <input type="text" class="contact-input" placeholder="State Accident Occurred in?" required>
            </div>
  
            <div class="contact-form-group"></div>
            <div class="contact-form-group">
                <button type="submit" class="contact-submit">SUBMIT</button>
            </div>
        </form>
    </div>
    </section>
  </main>

<?php
get_footer();
