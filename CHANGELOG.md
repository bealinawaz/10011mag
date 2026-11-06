# Changelog

## 2.0.0 - 2026-11-07

### Security
- Replaced the theme options framework (`components.php`, `metaboxes.php`) with `inc/meta-boxes.php`. Saving now checks a nonce and `edit_post`, and sanitises each field by type. Values were previously saved raw. Existing meta keys are unchanged.
- Escaped all output in templates and template tags. The post subtitle could previously print stored HTML or script.
- Registered the theme's meta keys with sanitising and an `edit_post` check, so values saved through the Custom Fields panel are sanitised too.
- Removed the Font Awesome 5.5.0 stylesheet loaded from a CDN on every page. No theme file uses it.

### Fixed
- Category and tag links pointed at unrelated posts (`get_the_permalink()` was given a term ID).
- Author links contained HTML inside `href`.
- `datetime` attributes now use ISO 8601 dates, and the "updated" date shows the last-modified date.
- Fatal error on PHP 8 when a post has no categories.
- JavaScript TypeError on scroll on pages without the fixed widget area (search, category, 404). The sticky widget area works as before.
- PHP warning for an undefined variable in `header.php`.
- Empty logo `<img>` when no custom logo was set.
- Duplicate `id="main"` on gift guide archives.
- Gift guide cards showed a hard-coded price ($65) and a link to another site from a demo. They now show the product's WooCommerce price and link to the product.
- PHP warnings when a featured image file or attachment metadata is missing.
- Paginated posts (`<!--nextpage-->`) had no page links.

### Changed
- Removed 141 WooCommerce template overrides. They were unmodified copies of WooCommerce 3.4/3.5 templates, so WooCommerce now uses its current templates.
- One text domain (`10011mag`) and one prefix (`mag10011_`) throughout. A new `languages/10011mag.pot` replaces Resonar's translation files.
- Fonts are self-hosted in `/fonts/` instead of loading from Google Fonts.
- Inline CSS and JS printed in `header.php` and `wp_head` moved into enqueued `css/overrides.css` and `js/fixed-nav.js`. Assets are versioned with the theme version.
- Added `wp_body_open()`, `responsive-embeds`, `customize-selective-refresh-widgets` and HTML5 `script`/`style`/`navigation-widgets` support.
- The `resonar-large` image size is now `mag10011-large`. Regenerate thumbnails on existing sites.
- `screenshot.png` (556 KB) replaced by `screenshot.jpg` (78 KB).
- When no custom logo is set, the header shows the site title as a link instead of an empty image.
- Requires WordPress 6.5 and PHP 7.4. Tested up to WordPress 7.1.
- Credited Resonar by Automattic, which this theme is based on.

### Removed
- Code for WordPress older than 4.1, the unused `inc/jetpack-fonts.php`, Jetpack's retired Site Logo support (core custom logo is used), and commented-out legacy templates.

## 1.0 - 2023-06-21
- Initial version.
