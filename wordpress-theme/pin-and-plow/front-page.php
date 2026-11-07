<?php
/** Front page: members can browse purchasable, downloadable PDF stories. */
get_header();
$products = pin_plow_pdf_products(3);
$featured = $products ? $products[0] : null;
$intro = get_theme_mod('pin_plow_intro', 'Short, hard-hitting stories from the ropes, the locker room, and the long walk home.');
?>
  <main class="hero">
    <div class="hero-inner container">
      <div class="hero-copy">
        <h1 class="hero-title" aria-label="Some matches don't end when the referee calls it.">
          <span>SOME</span><span>MATCHES</span><span>DON'T END</span><span class="red-word">WHEN</span><span>THE REFEREE</span><span>CALLS IT.</span>
        </h1>
        <p class="hero-description">
          <?php if ($intro === 'Short, hard-hitting stories from the ropes, the locker room, and the long walk home.') : ?>
            Short, hard-hitting stories from the ropes, the locker room,<br class="desktop-break" /> and the long walk home.
          <?php else : ?>
            <?php echo esc_html($intro); ?>
          <?php endif; ?>
        </p>
        <div class="hero-actions">
          <a class="button button-red" href="#stories">FIND YOUR NEXT BOUT <span aria-hidden="true" class="arrow-icon">↗</span></a>
          <a class="button button-outline" href="<?php echo esc_url(is_user_logged_in() ? pin_plow_downloads_url() : pin_plow_account_url()); ?>"><?php echo pin_plow_has_woocommerce() && is_user_logged_in() ? 'MY DOWNLOADS' : 'GET IN THE CORNER'; ?></a>
        </div>
      </div>
      <div class="hero-feature">
        <a class="feature-card" href="<?php echo esc_url($featured ? get_permalink($featured->get_id()) : pin_plow_section_url('shop')); ?>" aria-label="<?php echo esc_attr($featured ? sprintf(__('View %s PDF story', 'pin-and-plow'), $featured->get_name()) : __('Browse the PDF story shop', 'pin-and-plow')); ?>">
          <span class="feature-eyebrow">TONIGHT ONLY / PRIVATE CARD</span>
          <span class="feature-body">
            <span class="feature-title<?php echo $featured ? ' is-dynamic' : ''; ?>"><?php echo $featured ? pin_plow_card_title($featured->get_name()) : 'THIRD<br />ROUND'; ?></span>
            <span class="feature-subtitle"><?php echo $featured ? 'DIGITAL EDITION / PDF STORY' : 'SOUTHPAW / 03 ROUNDS / WELTER'; ?></span>
          </span>
          <span class="feature-footer"><span><?php echo $featured ? 'Featured PDF · ' : 'PDF stories coming soon'; ?><?php if ($featured) : echo wp_kses_post($featured->get_price_html()); endif; ?></span><span class="feature-arrow" aria-hidden="true">↘</span></span>
        </a>
      </div>
    </div>
  </main>
</div><!-- .site-shell -->

<div class="below-fold">
  <section class="section stories-section container" id="stories" aria-labelledby="stories-heading">
    <div class="section-heading"><div><p class="eyebrow">THE FIGHT CARD / DIGITAL STORIES</p><h2 id="stories-heading">STORIES WITH<br />SOMETHING TO PROVE.</h2></div><p>Choose a story, purchase your PDF, and find it in your corner whenever you want to read it again.</p></div>
    <?php if ($products) : ?>
      <div class="story-grid">
        <?php foreach ($products as $index => $product) : ?>
          <a class="story-tile <?php echo $index === 0 ? 'story-tile-red' : 'story-tile-dark'; ?>" href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
            <span class="eyebrow"><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?> / DOWNLOADABLE PDF</span>
            <span class="story-tile-title"><?php echo esc_html($product->get_name()); ?></span>
            <span class="story-tile-bottom"><span class="product-tile-price"><?php echo wp_kses_post($product->get_price_html()); ?></span><span>VIEW STORY ↗</span></span>
          </a>
        <?php endforeach; ?>
      </div>
      <a class="button button-outline story-shop-link" href="<?php echo esc_url(pin_plow_shop_url()); ?>">VIEW ALL PDF STORIES <span aria-hidden="true" class="arrow-icon">↗</span></a>
    <?php else : ?>
      <div class="empty-card"><span class="eyebrow">THE NEXT CARD IS COMING</span><p>Downloadable stories will appear here as soon as the press puts them on the card.</p></div>
    <?php endif; ?>
  </section>

  <section class="section shop-section" id="shop" aria-labelledby="shop-heading"><div class="container split-section"><div><p class="eyebrow">WORDS YOU CAN HOLD / THE SHOP</p><h2 id="shop-heading">GOOD STORIES.<br /><em>NO SOFT</em> PUNCHES.</h2></div><div class="section-side"><p>Buy individual story PDFs. Once your purchase is complete, download them from your member account any time.</p><?php if (pin_plow_has_woocommerce()) : ?><a class="button button-red" href="<?php echo esc_url(pin_plow_shop_url()); ?>">SHOP PDF STORIES <span aria-hidden="true" class="arrow-icon">↗</span></a><?php endif; ?></div></div></section>

  <section class="section membership-section container" id="membership" aria-labelledby="membership-heading"><div class="membership-panel"><div><p class="eyebrow">THE CORNER / MEMBERSHIP</p><h2 id="membership-heading">BE IN OUR<br /><em>CORNER.</em></h2><p>One account for your purchases and your downloads. Your stories are waiting whenever you are.</p></div>
    <div class="membership-actions">
      <p class="eyebrow"><?php echo is_user_logged_in() ? 'WELCOME BACK / YOUR LIBRARY' : 'YOUR OWN CORNER / YOUR OWN STORIES'; ?></p>
      <p><?php echo pin_plow_has_woocommerce() ? (is_user_logged_in() ? 'Your purchased PDFs are ready in My Downloads.' : 'Create a free account when you check out, or join now to keep your library in one place.') : 'The members’ shop is being prepared. Check back soon for PDF stories.'; ?></p>
      <?php if (pin_plow_has_woocommerce()) : ?>
        <a class="button button-red" href="<?php echo esc_url(is_user_logged_in() ? pin_plow_downloads_url() : pin_plow_account_url()); ?>"><?php echo is_user_logged_in() ? 'MY DOWNLOADS' : 'CREATE YOUR ACCOUNT'; ?> <span aria-hidden="true" class="arrow-icon">↗</span></a>
        <?php if (is_user_logged_in()) : ?><a class="membership-secondary" href="<?php echo esc_url(pin_plow_account_url()); ?>">ACCOUNT DETAILS ↗</a><?php endif; ?>
      <?php endif; ?>
    </div>
  </div></section>

  <section class="section info-section container" id="about" aria-labelledby="about-heading"><div><p class="eyebrow">ABOUT THE PRESS</p><h2 id="about-heading">FICTION FOR<br />AFTER THE BELL.</h2></div><p><?php echo esc_html(get_theme_mod('pin_plow_about', 'Pin & Plow Press makes room for the stories behind the fight: the work, the waiting, and everything that follows the final bell. Short fiction with a long reach.')); ?></p></section>
<?php get_footer(); ?>
