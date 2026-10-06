# Any2Convert

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="250" alt="Laravel Logo">
</p>

Any2Convert is a web platform offering browser-based conversion, document, image, calculation, writing, and utility tools. Processing depends on the selected feature; review its instructions and the Privacy Policy before using sensitive content.

---

 🌟 Key Pillars & Features

*   🛠️ Tool directory: Utilities for PDF, images, documents, data, calculators, writing, and interactive tasks.
*   📱 Responsive interface: The site is designed for desktop, tablet, and mobile browsers.
*   📝 Help and policies: The site includes contact, privacy, terms, and editorial guide pages.

---

 🚀 Tech Stack

# Backend
*   PHP: `^8.3`
*   Laravel Framework: `^13.7`

# Frontend
*   Vite: High-speed asset bundling (`^8.0`)
*   Tailwind CSS: Modern utility-first CSS styling framework (`^4.0.0` with `@tailwindcss/vite` integration)
*   Vanilla JS: High-performance, direct browser scripts to handle complex conversions locally.

---

 📂 Project Structure Overview

Key components of the Any2Convert platform include:

*   `routes/web.php`: Central routing file mapping all tool slugs, blog posts, redirect layouts, and static views.
*   `app/Http/Controllers/HomeController.php`: Core controller managing the homepage tool state, dynamic SEO highlight topics, and blog index/articles.
*   `app/Http/Controllers/ToolController.php`: Renders dynamic tool handlers.
*   `app/Support/tool_handlers.php`: Contains the structural HTML/JS templates for the tool directory.
*   `app/Support/tool_slugs.php`: Map lookup configuration translating tool IDs (e.g., `img_to_pdf`) to user-friendly URL slugs (e.g., `image-to-pdf`).
*   `resources/views/home.blade.php`: Main entry layout and user interface housing the tool presentation logic.

---

 🛠️ Tool Directory

Here is a breakdown of the conversion and utility tools included in the platform:

# 📄 PDF Utilities
*   Image to PDF / PDF to Image
*   Word to PDF / Excel to PDF / PowerPoint to PDF / HTML to PDF
*   PDF to Word / PDF to Excel / PDF to PowerPoint / PDF to PDF/A
*   Merge PDF / Split PDF / Compress PDF / Optimize PDF
*   Protect PDF (Add Password) / Unlock PDF (Remove Password)
*   Remove Pages / Extract Pages / Organize PDF / Rotate PDF
*   Add Page Numbers / Add Watermark / Crop PDF / Sign PDF
*   Redact PDF (Keyword Eraser) / Translate PDF / Compare PDF
*   OCR PDF (Searchable Documents) / Scan to PDF / Repair PDF
*   Bank Statement PDF to Excel
*   AI PDF Summarizer

# 💻 Developer & Data Tools
*   JSON to CSV / CSV to JSON
*   QR Code Generator
*   Password Generator
*   JWT Decoder

# 🖼️ Image & Graphics Processing
*   Image Compressor / Image Converter
*   Background Remover
*   Resize Image / Crop Image / Image Enhancer
*   Image to SVG / Image to DXF
*   HEIC Converter / JPG Converter / WebP Converter
*   Social Image Resizer (Social media profiles/posts sizing templates)

# 🎬 Audio, Video & Media
*   Video to Audio (MP3 extractor)
*   Video Compressor
*   Clip to GIF
*   AI Image Generator
*   OCR Image to Text
*   Repair Corrupt Photos & Videos

# 🧮 Calculators & Generators
*   Invoice Generator
*   ATS Resume Checker
*   Percentage Calculator / Loan Calculator / BMI Calculator / Age Calculator
*   Gamer Tag Generator / Tournament Bracket Generator

# ✍️ Writing, SEO & Text Tools
*   Word Counter
*   Grammar Checker
*   Paraphrase Tool

# 🎮 Interactive Tests & Fun Utilities
*   Reaction Time Test / CPS Test (Clicks per second)
*   Typing Speed Test
*   Spin the Wheel / Random Name Picker
*   Meme Caption Generator / Truth or Dare Generator / Memory Match Game

---

 ⚡ Setup & Local Installation

# Prerequisites
Make sure your development machine has the following tools installed:
*   PHP `8.3` or higher
*   Composer
*   Node.js & NPM

# Installation Steps

1.  Clone the Repository:
    ```bash
    git clone <repository-url>
    cd any2converts
    ```

2.  Run the Setup Script:
    The project includes a pre-configured installation script in `composer.json` that installs composer packages, creates the `.env` file, generates the application key, runs migrations, installs npm packages, and builds frontend assets.
    ```bash
    composer run setup
    ```

3.  Configure Environment Variables:
    Review `.env` file settings (database configuration, application URL, environment mode).

4.  Configure account sign-in:
    *   Email sign-in codes use the configured Laravel mailer. Set `MAIL_MAILER=smtp`, the SMTP host, port, username, password, and a verified `MAIL_FROM_ADDRESS` in `.env` for real delivery. Codes expire after 10 minutes and are rate-limited.
    *   For Google sign-in, set `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, and `GOOGLE_REDIRECT_URI` in `.env`. The existing client authorizes `https://any2convert.com/backend/google_login.php`; the app keeps that callback path working. If you register a different redirect in Google Cloud, set the matching URI in `GOOGLE_REDIRECT_URI`.
    *   Set `APP_ENV=production` and `APP_DEBUG=false` on the live server. Run `php artisan config:clear` after changing environment values, then `php artisan migrate --force` before deploying. On production, rebuild cached config with `php artisan config:cache` after the values are in place.

5.  Configure contact support and the admin inbox:
    *   Set `CONTACT_EMAIL`, `CONTACT_PHONE`, and `CONTACT_HOURS` in `.env` to the support details that should appear on the Contact page. The form still works if these optional details are blank.
    *   Set a real delivery mailer (`MAIL_MAILER=smtp` and its host, port, credentials, and verified sender) so admin replies can be emailed. The log and array mailers save replies but do not deliver them.
    *   Create your account, run `php artisan migrate --force`, then grant that existing account admin access with `php artisan contact:make-admin you@example.com`. The inbox is available at `/admin/contact`.

6.  Configure admin analytics and user controls:
    *   Run the new migration before opening Analytics or Users in the admin panel. It adds the user block/restriction fields and the `site_analytics_events` table. In phpMyAdmin, check the migration's fields against the existing `users` table before applying equivalent SQL, since older installations may have different column layouts.
    *   Analytics start collecting page views and tool opens once the table exists; historical traffic is not backfilled. Admins can inspect account details and block/unblock or restrict/restore tool access. Admin accounts and the current administrator are protected from these actions.

7.  Install FFmpeg (Optional but Recommended for Video Downloader):
    For tools that require server-side media processing (such as the Youtube video downloader), place the `ffmpeg` executable in the `bin/` directory or make sure it is installed globally in the system environment.

---

 💻 Running Locally

To run the full development server concurrently (handles PHP Artisan Server, Queue Listening, Logging, and Vite hot-reloading in one terminal tab):
```bash
composer run dev
```

Alternatively, run the services individually:

*   Vite Hot-Reload Server:
    ```bash
    npm run dev
    ```
*   Laravel Server:
    ```bash
    php artisan serve
    ```
*   Queue Listener:
    ```bash
    php artisan queue:listen
    ```

---

 🛡️ Security & Privacy Guidelines

For server-side file tasks, files uploaded by users are processed in an isolated temporary directory and automatically destroyed.

*   The temporary directory for server downloads defaults to `public/downloads/` and `public/tmp/`.
*   A periodic cleanup command is recommended in production to wipe files older than 1 hour.
*   Ensure that the user execution process (e.g. `www-data` or `apache`) has read and write access to `storage/`, `bootstrap/cache/`, and the `public/` folder.

---

 📜 License
This project skeleton is built on Laravel and is licensed under the [MIT license](https://opensource.org/licenses/MIT).
