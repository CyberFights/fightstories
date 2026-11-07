# Pin & Plow Press

A responsive fiction storefront, available as a standalone **design preview** and an installable **WordPress + WooCommerce theme**. The WordPress theme is the version that supports real customer accounts, payments, and protected PDF downloads.

## WordPress storefront

1. Upload [`wordpress-theme/pin-and-plow.zip`](wordpress-theme/pin-and-plow.zip) under **Appearance → Themes → Add New → Upload Theme** and activate **Pin & Plow Press**. You can also copy `wordpress-theme/pin-and-plow` into `wp-content/themes/`.
2. Install and activate **WooCommerce**. Complete its setup wizard, create/assign the **Shop**, **Cart**, **Checkout**, and **My Account** pages, and configure a payment gateway (for example, Stripe or PayPal). WooCommerce, not this theme, processes payment and grants purchased-file permissions.
3. In **WooCommerce → Settings → Products → Downloadable products**, choose **Force downloads** (or another protected delivery method supported by your host). Do not paste a public Media Library PDF URL into a story or product page; use the product's downloadable file upload so customers receive WooCommerce-protected download links.
4. As the site owner, go to **Products → Add New** for each story. Set its title, description, cover image and price. Choose **Simple product**, check **Virtual** and **Downloadable**, use **Add File** in the *Downloadable files* area to upload the PDF, and publish. The newest published downloadable story appears on the homepage; up to three appear in the fight card, and the shop lists downloadable products.
5. Customers can register on **My Account** or during checkout. The theme turns **guest checkout off** and enables account creation, so each purchase belongs to a customer. Once WooCommerce grants download access after payment, the customer can find the file under **My Account → Downloads**. Test with a payment gateway's sandbox mode before launch.

The default menu points to the real WooCommerce shop and account pages; you can replace it under **Appearance → Menus → Header navigation**. Homepage text and contact email can be edited under **Appearance → Customize → Pin & Plow front page**. Without WooCommerce, visitors see a coming-soon shop rather than a fake checkout, and the owner sees an admin notice.

**Membership here means a registered customer account with access to PDFs they purchased individually.** It does not include recurring subscriptions or access to every story. Those require an additional membership/subscription product and rules.

Fonts and the press badge are bundled locally. WordPress does not require Node or a CDN to serve the theme.

## Standalone design preview

```sh
npm install
npm run dev
```

The Vite version recreates the look and includes a sample story preview. It does **not** collect payments, create accounts, or serve purchased files. `npm run build` builds this preview.

After editing `src/style.css` or the badge, update the theme's shared assets and installable zip with:

```sh
npm run package:wordpress
```

Theme-specific styles are in `wordpress-theme/pin-and-plow/assets/wp.css` and `assets/commerce.css`. The WordPress theme uses templates and WooCommerce APIs rather than embedding the Vite app.
