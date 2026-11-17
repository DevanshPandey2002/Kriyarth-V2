KRIYARTH V2 – WordPress theme
=============================
INSTALL
1. WordPress admin > Appearance > Themes > Add New > Upload Theme > choose kriyarth-v2.zip > Install > Activate.
2. On activation the theme creates: 4 starter projects (your current ones), 4 areas, and Home / About / Contact pages, and sets Home as the front page.
3. Appearance > Customize > "Kriyarth details": contact email, social links, footer tagline, and up to 8 photos for the "Field notes" mosaic.
4. Appearance > Customize > Site Identity: upload your logo (PNG/SVG). Without one, the theme shows क्रियार्थ as a wordmark.
5. Projects (left menu): edit each project, add a featured image (it replaces the line artwork), set status, year, tools.
6. Menus (optional): Appearance > Menus > assign to "Primary menu". Enable "CSS classes" in Screen Options, then add
   is-rust to a link for the orange accent, and is-leaf for the green accent. Without a menu, a default one is used.
7. Settings > Permalinks > Save (once), so /work/ and /area/ URLs work.

NOTES
- Contact and newsletter forms email the address in step 3. Install an SMTP plugin (e.g. WP Mail SMTP) so mail is delivered reliably.
  To use Mailchimp/MailPoet instead, replace the form in footer.php with that plugin's shortcode.
- Fonts (Outfit, Playfair Display, Caveat, Kalam) load from Google Fonts.
- The Field Diary board is an SVG in template-parts/diary-board.php. Its notes are placeholder sketches; edit the text there.
