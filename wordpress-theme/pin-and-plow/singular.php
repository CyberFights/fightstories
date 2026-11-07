<?php /** Individual posts and pages. */ get_header(); ?>
<main class="inner-main container" id="main-content">
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('single-story'); ?>>
      <a class="back-link" href="<?php echo esc_url(is_page() ? home_url('/') : pin_plow_section_url('stories')); ?>">← BACK TO THE FIGHT CARD</a>
      <p class="eyebrow"><?php if (is_single()) : ?><?php echo esc_html(get_the_date()); ?> / <?php echo esc_html(get_the_author()); ?><?php else : ?>PIN &amp; PLOW PRESS<?php endif; ?></p>
      <h1 class="inner-heading"><?php the_title(); ?></h1>
      <?php if (has_post_thumbnail()) : ?><div class="story-image"><?php the_post_thumbnail('large'); ?></div><?php endif; ?>
      <div class="article-content"><?php the_content(); wp_link_pages(); ?></div>
      <?php if (is_single()) : ?><div class="story-end">END OF THE ROUND <span aria-hidden="true">↘</span></div><?php endif; ?>
    </article>
    <?php if (comments_open() || get_comments_number()) : comments_template(); endif; ?>
  <?php endwhile; ?>
</main>
</div><!-- .site-shell -->
<div class="below-fold">
<?php get_footer(); ?>
