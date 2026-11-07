  <footer class="site-footer" id="contact">
    <div class="container footer-inner">
      <div>
        <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('Back to home', 'pin-and-plow'); ?>"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/press-badge.png'); ?>" alt="Pin &amp; Plow Press" width="66" height="62" /></a>
        <p>FICTION FOR AFTER THE BELL.</p>
      </div>
      <div class="footer-links">
        <?php if (is_user_logged_in() && pin_plow_has_woocommerce()) : ?><a href="<?php echo esc_url(pin_plow_downloads_url()); ?>">MY DOWNLOADS ↗</a><?php endif; ?>
        <?php $contact_email = get_theme_mod('pin_plow_email', 'hello@pinandplow.press'); ?>
        <?php if ($contact_email) : ?><a href="<?php echo esc_url('mailto:' . sanitize_email($contact_email)); ?>">CONTACT ↗</a><?php endif; ?>
        <a href="#top">BACK TO TOP ↑</a>
      </div>
      <small>© <?php echo esc_html(wp_date('Y')); ?> PIN &amp; PLOW PRESS</small>
    </div>
  </footer>
</div><!-- .below-fold -->
<?php wp_footer(); ?>
</body>
</html>
