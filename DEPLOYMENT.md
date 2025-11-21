# Deployment Instructions for Shared Hosting

## Structure
Your app uses this structure:
```
lydweb/
├── public/          ← Document root (point your domain here)
│   ├── index.php   ← Main entry point
│   └── .htaccess   ← URL rewriting rules
├── app/            ← Application code
├── views/          ← Templates
├── assets/         ← CSS, JS, images
├── products.json   ← Data file
├── config.php      ← Configuration
└── router.php      ← Dev server helper (not used in production)
```

## Deployment Steps

### Option 1: Set Document Root to `public/` (Recommended)
1. Upload all files to your hosting (e.g., `/home/username/lydweb/`)
2. In cPanel or hosting control panel, set your domain's **document root** to:
   ```
   /home/username/lydweb/public
   ```
3. Done! Your site will be accessible at `https://yourdomain.com`

### Option 2: Upload Everything to public_html
If you can't change document root:
1. Upload the contents of `public/` folder to `public_html/`
2. Upload all other folders (`app/`, `views/`, `assets/`, etc.) to `public_html/`
3. Edit `public_html/index.php` and update the path on line 3:
   ```php
   require_once __DIR__ . '/app/bootstrap.php';  // Remove '../'
   ```

### Important Files to Check
- **config.php**: Update `SECRET_TOKEN` and admin credentials
- **products.json**: Ensure file permissions allow PHP to read/write (chmod 644 or 664)
- **.htaccess**: Already created in `public/` folder

### URL Structure
After deployment, your URLs will work like:
- `https://yourdomain.com/` → Home
- `https://yourdomain.com/menu` → Menu page
- `https://yourdomain.com/gallery` → Gallery
- `https://yourdomain.com/product/1` → Product detail
- `https://yourdomain.com/order` → Cart/Order
- `https://yourdomain.com/admin` → Admin panel

### Troubleshooting
**If you see 404 errors:**
- Check that `.htaccess` exists in the document root
- Verify `mod_rewrite` is enabled on your host
- Check file permissions (folders: 755, files: 644)

**If styles/images don't load:**
- Check that `assets/` folder is accessible
- Verify the `url()` helper function in `app/bootstrap.php` has correct base path

### Testing Locally
Development server (what you're using now):
```bash
php -S 0.0.0.0:9999 router.php
```

The `router.php` file is only for local development - it won't be used on shared hosting.
