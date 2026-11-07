<?php /** Latest stories, archives, and search results. */ get_header(); ?>
<main class="inner-main container" id="main-content">
  <p class="eyebrow">PIN &amp; PLOW PRESS / THE FIGHT CARD</p>
  <h1 class="inner-heading"><?php echo is_search() ? esc_html(sprintf(__('RESULTS FOR: %s', 'pin-and-plow'), get_search_query())) : (is_archive() ? wp_kses_post(get_the_archive_title()) : esc_html__('STORIES FROM THE ROPES.', 'pin-and-plow')); ?></h1>
  <?php if (have_posts()) : ?>
    <div class="archive-grid">
      <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class('archive-card'); ?>>
          <p class="eyebrow"><?php echo esc_html(get_the_date()); ?> / <?php echo esc_html(get_the_author()); ?></p>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 25)); ?></p>
          <a class="read-more" href="<?php the_permalink(); ?>">READ THE STORY ↗</a>
        </article>
      <?php endwhile; ?>
    </div>
    <div class="pagination"><?php the_posts_pagination(array('prev_text' => '← PREVIOUS', 'next_text' => 'NEXT →')); ?></div>
  <?php else : ?>
    <p class="inner-empty"><?php esc_html_e('No stories found yet. The next bell is coming.', 'pin-and-plow'); ?></p>
  <?php endif; ?>
</main>
</div><!-- .site-shell -->
<div class="below-fold">
<?php get_footer(); ?>
