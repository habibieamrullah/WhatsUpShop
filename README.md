# WhatsUpShop

> A lightweight, simplified online store CMS built with PHP and MySQL, featuring a WhatsApp-based checkout system.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D7.0-777BB4.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.x%2B-4479A1.svg)](https://www.mysql.com/)

---

## Table of Contents

- [About](#about)
- [Features](#features)
- [Recent Improvements](#recent-improvements)
- [Screenshots](#screenshots)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Project Structure](#project-structure)
- [Database Schema](#database-schema)
- [Usage](#usage)
- [Localization](#localization)
- [Security Notes](#security-notes)
- [Roadmap](#roadmap)
- [Contributing](#contributing)
- [License](#license)
- [Credits & Support](#credits--support)

---

## About

**WhatsUpShop** is a lightweight and simple Content Management System (CMS) that lets you publish products with pictures, descriptions, pricing, quantity, and custom options. It ships with an easy-to-use shopping cart, an "Add to Cart" button, and a **WhatsApp checkout** system that sends the seller a complete order notification with all the details needed.

You can fully customize your online shop from the Admin panel — change theme colors, logo, currency symbol, language, and more.

> **Note:** This is an improved version of [WhatsUpOnlineStore](https://github.com/habibieamrullah/WhatsUpOnlineStore). The key improvement is that database credentials are now separated into a dedicated [`dbcon.php`](dbcon.php) file (previously they lived inside [`config.php`](config.php)).

### Watch the Setup Tutorial

[![Setup Tutorial](https://img.youtube.com/vi/NRy8SnLLpe4/0.jpg)](https://youtu.be/NRy8SnLLpe4)

---

## Features

### Storefront
- **Product catalog** with grid layout and responsive design
- **Recent products slider** (powered by [Slick](https://kenwheeler.github.io/slick/))
- **Category filtering** and **live quick search** (with "no results" feedback)
- **Product detail page** with multiple images, gallery viewer, and related products
- **Product options/variants** (e.g., size, color) with per-option pricing
- **Shopping cart** persisted in `localStorage`, with a modern flex-based line layout
- **WhatsApp checkout** — generates a formatted order message and opens WhatsApp
- **Toast notifications** for add-to-cart, clear-cart, order, and validation feedback
- **Empty states** for an empty catalog, empty cart, and empty search results
- **Social share buttons** (Facebook, Twitter, Email, and more)
- **Facebook comments** integration (optional)
- **View counter** per product (IP-based, avoids duplicate counts)
- **Multi-language UI** (English / Indonesian)

### Admin Panel
- **Secure login** with session-based authentication and a redesigned login screen
- **Dashboard** with stat cards (products, categories, orders), quick actions, and a recent-products list
- **Modular section views** — each admin page lives in its own file under [`admin_sections/`](admin_sections/)
- **Active sidebar highlighting** so the current section is always visible
- **Add / Edit / Delete products** with rich text editor ([TinyMCE](https://www.tinytext.com/))
- **Image picker** and multi-image management with a responsive picture grid
- **Category management** with inline rename and delete
- **Order messages** viewer (orders submitted via checkout are stored) with per-order and bulk delete
- **Settings page** — website title, colors, logo, currency, language, and feature toggles
- **AJAX upload** with progress bar
- **Mobile-friendly** layout with an off-canvas sidebar and backdrop

---

## Recent Improvements

The following enhancements were recently added to improve usability, feedback, and the overall look and feel:

### Admin Panel Refactor
- **Split the monolithic admin panel into modular sections** under [`admin_sections/`](admin_sections/) — [`home.php`](admin_sections/home.php), [`newpost.php`](admin_sections/newpost.php), [`editpost.php`](admin_sections/editpost.php), [`pictures.php`](admin_sections/pictures.php), [`categories.php`](admin_sections/categories.php), [`orders.php`](admin_sections/orders.php), and [`settings.php`](admin_sections/settings.php). Each section is included by [`admin.php`](admin.php), keeping the codebase easier to maintain.
- **Redesigned dashboard** with **stat cards** (published posts, categories, orders), a **Quick Actions** grid, and a **Recently Published** list with thumbnails.
- **Active menu highlighting** — the sidebar now marks the current section using an `.active` state.
- **Improved login screen** with icons, field labels, autofocus, and a localized error message.
- **Mobile off-canvas sidebar** with a clickable backdrop to dismiss the menu.

### Storefront UX
- **Toast notifications** replace `alert()` and `console.log()` for add-to-cart, clear-cart, order submission, and validation errors. Implemented via the new [`showToast()`](somefunctions.js:14) helper.
- **Cart UI overhaul** — cart lines now use a clean flex layout with product image, title, quantity input, line total, and a remove button.
- **Empty states** — friendly placeholders are shown when there are no products, an empty cart, or no search matches.
- **Clear-cart confirmation** — the cart can no longer be cleared accidentally, and clearing an empty cart is a no-op.
- **Cart button pulse animation** whenever the item count changes.
- **Order validation** — checkout now warns when the cart is empty before opening WhatsApp.

### Styling & Animations
- **Product cards lift on hover** with a subtle image zoom.
- **Header entrance animation**, smooth scrolling, and visible focus outlines for accessibility.
- **Consistent button transitions** and active-press feedback across the storefront and admin.
- **New admin component styles** — cards, stat grids, quick actions, toggles, picture grid, order list, and progress bars.
- **Responsive admin adjustments** for screens under `800px`.

### JavaScript Helpers
- [`showToast(message, type, duration)`](somefunctions.js:14) — display success/error/info toasts.
- [`debounce(fn, wait)`](somefunctions.js:48) — delay a function until input settles.
- [`formatMoney(value, decimals)`](somefunctions.js:59) — format numbers with thousands separators and fixed decimals.

### Localization
- Added new English/Indonesian strings for the dashboard, quick actions, login errors, and checkout feedback in [`uilang.php`](uilang.php).

---

## Screenshots

> Add your own screenshots here to showcase the storefront and admin panel.

| Storefront | Product Page | Admin Panel |
|:---:|:---:|:---:|
| _screenshot_ | _screenshot_ | _screenshot_ |

---

## Requirements

| Requirement | Version |
|---|---|
| PHP | 7.0 or higher (7.4+ recommended) |
| MySQL / MariaDB | 5.6 or higher |
| Web Server | Apache, Nginx, or any PHP-capable server |
| PHP Extensions | `mysqli`, `gd` (for thumbnail generation), `json` |

---

## Installation

### 1. Clone or download the project

```bash
git clone https://github.com/habibieamrullah/WhatsUpShop.git
```

Or download the ZIP and extract it into your web server's document root.

### 2. Create a MySQL database

Create an empty database for the shop, for example:

```sql
CREATE DATABASE mydatabase CHARACTER SET utf8 COLLATE utf8_general_ci;
```

> Tables are created automatically on first run — no manual import required.

### 3. Configure database credentials

Edit [`dbcon.php`](dbcon.php) and set your connection details:

```php
<?php
$host = "localhost";
$tableprefix = "whatastore_"; // Change if needed; use underscores, no spaces
$databasename = "mydatabase";
$dbuser = "root";
$dbpassword = "";
```

### 4. Set admin credentials

Edit [`config.php`](config.php) and change the default admin login:

```php
define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD_HASH", password_hash("admin", PASSWORD_DEFAULT));
```

> **Important:** Change the default username and password before going live.

### 5. Ensure the `pictures` folder is writable

The application automatically creates a `pictures/` directory for uploads. Make sure the web server has write permission to the project root (or create the folder manually and set permissions to `755`).

### 6. Open the site

Navigate to your installation in a browser:

```
http://your-domain.com/
```

The database tables and default configuration will be created automatically. Then access the admin panel at:

```
http://your-domain.com/admin.php
```

---

## Configuration

Most settings are managed from the **Admin Panel → Settings** page. The defaults are defined in [`config.php`](config.php):

| Setting | Description | Default |
|---|---|---|
| `websitetitle` | Store name shown in the header and title | `Toko Online WA` |
| `maincolor` | Primary theme color | `#f28433` |
| `secondcolor` | Secondary theme color | `#ffb98a` |
| `about` | Short description shown under the title | _simple text_ |
| `language` | UI language (`en` / `id`) | `id` |
| `logo` | Logo filename inside `pictures/` | _(empty)_ |
| `adminwhatsapp` | WhatsApp number that receives orders | `6287880334339` |
| `currencysymbol` | Currency symbol used for prices | `$` |
| `enablerecentpostsliders` | Show the recent products slider | `true` |
| `enablefacebookcomment` | Enable Facebook comments on product pages | `true` |
| `enablepublishdate` | Show publish date on product cards | `true` |
| `sharebuttonsoption` | Array of enabled share buttons | `[]` |
| `thumbnailmode` | `0` = center-filled, `1` = stretched | `0` |
| `disabledecimals` | Hide decimals in prices | `0` |

---

## Project Structure

```
WhatsUpShop/
├── admin.php                 # Admin panel entry point (login + routing)
├── admin_sections/           # Admin panel section views (included by admin.php)
│   ├── home.php              #   Dashboard: stats, quick actions, recent products
│   ├── newpost.php           #   Add a new product
│   ├── editpost.php          #   Edit an existing product
│   ├── pictures.php          #   Upload / manage images
│   ├── categories.php        #   Add / rename / delete categories
│   ├── orders.php            #   View / delete order messages
│   └── settings.php          #   Site settings (title, colors, logo, toggles)
├── config.php                # Core config, DB connection, table creation, defaults
├── dbcon.php                 # Database credentials (edit this!)
├── functions.php             # Helper functions (categories, text, share buttons)
├── uilang.php                # UI translation strings (EN / ID)
├── index.php                 # Storefront (home, product page, cart, checkout)
├── style.php                 # Dynamic CSS generated from theme settings
├── somefunctions.js          # Frontend JS helpers (tSep, showToast, debounce, formatMoney)
├── postupload.php            # Handles new product upload
├── postupdate.php            # Handles product updates
├── imagepicker.php           # Image picker UI for the admin
├── thumbnailgenerator.php    # GD-based thumbnail generation
├── ordernotes.php            # Stores order messages from checkout
├── viewcounter.php           # IP-based product view counter
├── jquery.min.js             # jQuery library
├── jquery.form.js            # jQuery Form plugin (AJAX uploads)
├── jscolor.js                # Color picker for the admin
├── sharingbuttons.css        # Social share button styles
├── assets/                   # Bootstrap, Font Awesome, fonts
├── images/                   # Default images and logo
├── pictures/                 # Uploaded product images (auto-created)
├── slick/                    # Slick carousel library
└── tinymce/                  # TinyMCE rich text editor
```

---

## Database Schema

Tables are created automatically using the prefix defined in [`dbcon.php`](dbcon.php) (default: `whatastore_`).

### `{prefix}config`
Stores the site configuration as JSON.

| Column | Type | Notes |
|---|---|---|
| `id` | INT UNSIGNED | Primary key, auto-increment |
| `config` | VARCHAR(150) | Config key (e.g., `cfg`) |
| `value` | TEXT | JSON-encoded configuration |

### `{prefix}posts`
Stores products.

| Column | Type | Notes |
|---|---|---|
| `id` | INT UNSIGNED | Primary key |
| `postid` | VARCHAR(70) | Public product identifier (indexed) |
| `catid` | INT | Category ID (indexed) |
| `normalprice` | FLOAT | Regular price |
| `discountprice` | FLOAT | Discounted price (`0` = none) |
| `title` | VARCHAR(300) | Product title |
| `time` | DATETIME | Publish time |
| `options` | VARCHAR(200) | JSON product options/variants |
| `picture` | VARCHAR(300) | Main image filename |
| `moreimages` | TEXT | Comma-separated additional images |
| `content` | TEXT | Product description (HTML) |

### `{prefix}categories`

| Column | Type | Notes |
|---|---|---|
| `id` | INT UNSIGNED | Primary key |
| `category` | VARCHAR(50) | Category name |

### `{prefix}messages`

| Column | Type | Notes |
|---|---|---|
| `id` | INT UNSIGNED | Primary key |
| `date` | DATETIME | Message date |
| `message` | TEXT | Order message content |

---

## Usage

### Managing products
1. Log in at `admin.php`.
2. Go to **Add Product** to create a new item — set title, content, category, prices, options, and images.
3. Use **Pictures** to manage uploaded images and **Categories** to organize products.
4. Edit or delete existing products from the dashboard.

### Processing orders
1. Customers browse the storefront, add products to the cart, and fill in their contact details.
2. Clicking **Order on WhatsApp** opens WhatsApp with a pre-filled order message sent to the admin number.
3. The order is also stored in the `{prefix}messages` table and viewable under **Admin → Orders**.

---

## Localization

The UI supports multiple languages via [`uilang.php`](uilang.php). To add a new language:

1. Create a new translation function (e.g., `translateEs()`) following the pattern of `translateId()`.
2. Add the language code to the `uilang()` dispatcher.
3. Select the language from **Admin → Settings**.

---

## Security Notes

This project is intended for small shops and educational use. Before deploying to production, consider the following hardening steps:

- **Change default admin credentials** in [`config.php`](config.php).
- **Move credentials out of version control** — consider using environment variables or a `.env.php` file excluded from Git.
- **Use prepared statements** for all database queries (some legacy queries still use `mysqli_real_escape_string`).
- **Serve over HTTPS** to protect session cookies and order data.
- **Restrict file uploads** — validate MIME types, not just extensions.
- **Keep dependencies updated** (jQuery, TinyMCE, Slick, Bootstrap, Font Awesome).
- **Disable error display** in production (`display_errors = Off`).

---

## Roadmap

- [x] Modularize the admin panel into section views
- [x] Add toast notifications and empty states for better feedback
- [x] Redesign the admin dashboard with stats and quick actions
- [ ] Migrate all queries to prepared statements
- [ ] Add CSRF protection to admin forms
- [ ] Add product stock/inventory tracking
- [ ] Add order status management
- [ ] Add more languages
- [ ] Add REST API for headless usage

---

## Contributing

Contributions are welcome! To contribute:

1. Fork the repository.
2. Create a feature branch: `git checkout -b feature/my-feature`.
3. Commit your changes: `git commit -m "Add my feature"`.
4. Push to the branch: `git push origin feature/my-feature`.
5. Open a Pull Request.

Please keep code style consistent with the existing codebase and test your changes before submitting.

---

## License

This project is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for details.

Copyright (c) 2020 Habibie

---

## Credits & Support

**Developed by Habibie**

- Email: habibieamrullah@gmail.com
- WhatsApp: [6287880334339](https://wa.me/6287880334339)
- Website: [https://webappdev.my.id](https://webappdev.my.id)
- YouTube: [Setup tutorial](https://youtu.be/NRy8SnLLpe4)

If you find this project useful, please consider:

- ⭐ Starring the repository
- 👍 Liking and subscribing on YouTube
- 💰 Donating via [PayPal](https://paypal.me/habibieamrullah)

Thank you for your support!
