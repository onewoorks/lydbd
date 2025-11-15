# Lightweight Bakery Site

This is a minimal PHP site to show daily-available bakery items (bread & cookies) without a database.

Features
- Products stored in `products.json`.
- Public `index.php` shows only items where `available: true`.
- `admin.php` provides toggle links that update `products.json` using a secret token. Those toggle links can be shared via WhatsApp/Telegram so someone can toggle availability daily.

Setup
1. Put this project in a PHP-capable hosting environment or run locally with PHP built-in server:

```bash
php -S localhost:8000 -t /path/to/lydweb
```

2. Edit `config.php` and set `SECRET_TOKEN` to a random strong value.
3. Upload product images into `assets/` and update `products.json` image paths.

How to use
- Visit `/` to see available products.
- Visit `/admin.php` to get toggle links. Each link is like `/toggle.php?id=product-id&token=YOUR_SECRET`. Share that full link (including token) via WhatsApp/Telegram to allow quick toggling. The toggle flips availability.

Security notes
- The current admin toggle is protected only by a token in the URL. Do not share it publicly. For production, consider adding authentication or restricting by IP.
- Ensure `products.json` is writable by the webserver user.

Next steps (optional)
- Add basic login/auth for the admin area.
- Add an order form or integrate a payment gateway.
- Sanitize and rate-limit toggle endpoint.
