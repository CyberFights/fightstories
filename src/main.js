import '@fontsource/anton/400.css';
import '@fontsource/dm-sans/400.css';
import '@fontsource/dm-sans/500.css';
import '@fontsource/dm-sans/600.css';
import '@fontsource/ibm-plex-mono/400.css';
import './style.css';

const arrow = '<span aria-hidden="true" class="arrow-icon">↗</span>';

const app = document.querySelector('#app');
app.innerHTML = `
  <div class="site-shell" id="top">
    <header class="site-header">
      <div class="header-inner container">
        <a class="brand" href="#top" aria-label="Pin and Plow Press, back to top">
          <img src="/press-badge.png" alt="Pin & Plow Press" width="75" height="70" />
          <span class="brand-tagline">FICTION FOR AFTER<br />THE BELL.</span>
        </a>
        <button class="menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="main-nav"><span></span><span></span></button>
        <nav class="main-nav" id="main-nav" aria-label="Main navigation">
          <a href="#shop">SHOP</a>
          <a href="#membership">MEMBERSHIP</a>
          <a href="#about">ABOUT</a>
          <a href="#contact">CONTACT</a>
          <a class="nav-cta" href="#membership">GET IN THE CORNER</a>
        </nav>
      </div>
    </header>

    <main class="hero">
      <div class="hero-inner container">
        <div class="hero-copy">
          <h1 class="hero-title" aria-label="Some matches don't end when the referee calls it.">
            <span>SOME</span>
            <span>MATCHES</span>
            <span>DON'T END</span>
            <span class="red-word">WHEN</span>
            <span>THE REFEREE</span>
            <span>CALLS IT.</span>
          </h1>
          <p class="hero-description">Short, hard-hitting stories from the ropes, the locker room,<br class="desktop-break" /> and the long walk home.</p>
          <div class="hero-actions">
            <a class="button button-red" href="#stories">FIND YOUR NEXT BOUT ${arrow}</a>
            <a class="button button-outline" href="#membership">GET IN THE CORNER</a>
          </div>
        </div>
        <div class="hero-feature">
          <button class="feature-card" type="button" data-open-story aria-label="Read Third Round, featured fiction">
            <span class="feature-eyebrow">TONIGHT ONLY / PRIVATE CARD</span>
            <span class="feature-body">
              <span class="feature-title">THIRD<br />ROUND</span>
              <span class="feature-subtitle">SOUTHPAW / 03 ROUNDS / WELTER</span>
            </span>
            <span class="feature-footer"><span>Featured fiction</span><span class="feature-arrow" aria-hidden="true">↘</span></span>
          </button>
        </div>
      </div>
    </main>
  </div>

  <div class="below-fold">
    <section class="section stories-section container" id="stories" aria-labelledby="stories-heading">
      <div class="section-heading"><div><p class="eyebrow">THE FIGHT CARD / 001</p><h2 id="stories-heading">STORIES WITH<br />SOMETHING TO PROVE.</h2></div><p>Short fiction in downloadable PDF editions. Members purchase stories in the WordPress shop and find their files in My Downloads.</p></div>
      <div class="story-grid">
        <button class="story-tile story-tile-red" data-open-story type="button"><span class="eyebrow">01 / PDF STORY PREVIEW</span><span class="story-tile-title">THIRD<br />ROUND</span><span class="story-tile-bottom">A fighter knows when the bell is a beginning. <span aria-hidden="true">↗</span></span></button>
        <article class="story-tile story-tile-dark"><span class="eyebrow">02 / FROM THE LOCKER ROOM</span><h3>THE LONG<br />WALK HOME</h3><p>Some victories are too heavy to carry alone.</p><span class="story-tile-bottom">COMING SOON <span aria-hidden="true">↗</span></span></article>
        <article class="story-tile story-tile-dark"><span class="eyebrow">03 / AFTER THE BELL</span><h3>STANDING<br />EIGHT</h3><p>The count goes on, even after you get up.</p><span class="story-tile-bottom">COMING SOON <span aria-hidden="true">↗</span></span></article>
      </div>
    </section>

    <section class="section shop-section" id="shop" aria-labelledby="shop-heading"><div class="container split-section"><div><p class="eyebrow">WORDS YOU CAN HOLD / THE SHOP</p><h2 id="shop-heading">GOOD STORIES.<br /><em>NO SOFT</em> PUNCHES.</h2></div><div class="section-side"><p>Individual story PDFs are sold through the WordPress storefront. Purchases and protected downloads are tied to your member account.</p><a class="button button-red" href="#membership">HOW MEMBERSHIP WORKS ${arrow}</a></div></div></section>

    <section class="section membership-section container" id="membership" aria-labelledby="membership-heading"><div class="membership-panel"><div><p class="eyebrow">THE CORNER / MEMBERSHIP</p><h2 id="membership-heading">BE IN OUR<br /><em>CORNER.</em></h2><p>One account for your purchases and your downloads. Your stories are waiting whenever you are.</p></div><div class="membership-actions"><p class="eyebrow">YOUR OWN CORNER / YOUR OWN STORIES</p><p>This page is a visual preview. Account creation, secure checkout, and purchased PDF downloads work in the WordPress theme when WooCommerce is installed.</p><a class="button button-red" href="#stories">PREVIEW A STORY ${arrow}</a></div></div></section>

    <section class="section info-section container" id="about" aria-labelledby="about-heading"><div><p class="eyebrow">ABOUT THE PRESS</p><h2 id="about-heading">FICTION FOR<br />AFTER THE BELL.</h2></div><p>Pin & Plow Press makes room for the stories behind the fight: the work, the waiting, and everything that follows the final bell. Short fiction with a long reach.</p></section>

    <footer class="site-footer" id="contact"><div class="container footer-inner"><div><img src="/press-badge.png" alt="Pin & Plow Press" width="66" height="62" /><p>FICTION FOR AFTER THE BELL.</p></div><div class="footer-links"><a href="mailto:hello@pinandplow.press">CONTACT ↗</a><a href="#top">BACK TO TOP ↑</a></div><small>© ${new Date().getFullYear()} PIN & PLOW PRESS</small></div></footer>
  </div>

  <dialog class="story-dialog" id="story-dialog" aria-labelledby="dialog-title">
    <div class="dialog-inner"><button type="button" class="dialog-close" aria-label="Close story">CLOSE <span aria-hidden="true">×</span></button><p class="eyebrow">PIN & PLOW PRESS / FEATURED FICTION</p><h2 id="dialog-title">THIRD<br />ROUND</h2><p class="dialog-deck">The bell doesn't always tell you when it's over.</p><div class="story-text"><p>By the third round, the room had gone quiet in that peculiar way a crowded room can. Every eye was on the ropes. Every breath seemed to wait for his.</p><p>In his corner, he could hear the water bottle crackle in his trainer's hand. He could hear somebody call his name from the back row. He could hear the bell before it rang.</p><p>He got up anyway.</p></div><p class="dialog-note">MORE FROM THE FIGHT CARD COMING SOON.</p></div>
  </dialog>
`;

const menuToggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('.main-nav');
menuToggle.addEventListener('click', () => {
  const isOpen = nav.classList.toggle('is-open');
  menuToggle.setAttribute('aria-expanded', String(isOpen));
  menuToggle.setAttribute('aria-label', isOpen ? 'Close navigation' : 'Open navigation');
});
nav.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
  nav.classList.remove('is-open');
  menuToggle.setAttribute('aria-expanded', 'false');
  menuToggle.setAttribute('aria-label', 'Open navigation');
}));

const dialog = document.querySelector('#story-dialog');
document.querySelectorAll('[data-open-story]').forEach(button => button.addEventListener('click', () => dialog.showModal()));
document.querySelector('.dialog-close').addEventListener('click', () => dialog.close());
dialog.addEventListener('click', event => { if (event.target === dialog) dialog.close(); });

