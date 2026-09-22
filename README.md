# Any2Convert

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="250" alt="Laravel Logo">
</p>

Any2Convert is a comprehensive, modern, and high-performance web platform offering a suite of 85+ free online conversion, manipulation, and utility tools. Designed with a Privacy-First / Local-First philosophy, the majority of the tools process files directly in the user's browser, ensuring sensitive documents and files never leave their device.

---

 🌟 Key Pillars & Features

*   🔒 Privacy First (On-Device Processing): The core of the platform is designed around user privacy. Most document, image, and text operations occur locally in the client browser using custom UMD scripts and libraries. No files are uploaded to the server for these tools.
*   ⚡ Instant Processing: Localized processing eliminates file upload/download wait times, offering instant operations.
*   🛠️ Extensive Tool Directory: Over 85+ tools categorized across PDF utilities, developer/data tools, image processing, media handling, calculators, writing enhancers, and interactive tests/games.
*   📱 Responsive & Cross-Device: Optimized interface built with Tailwind CSS v4 to render flawlessly across desktops, tablets, and smartphones.
*   📝 Integrated SEO & Blogging: Dynamic topic highlights page, Google Search Console 301 redirects, automated XML sitemap generator, and a built-in blogging platform for search engine visibility.

---

 🚀 Tech Stack

# Backend
*   PHP: `^8.3`
*   Laravel Framework: `^13.7`
*   yt-dlp: Integrated server-side executable for fetching and downloading YouTube media (located in `bin/`).

# Frontend
*   Vite: High-speed asset bundling (`^8.0`)
*   Tailwind CSS: Modern utility-first CSS styling framework (`^4.0.0` with `@tailwindcss/vite` integration)
*   Vanilla JS: High-performance, direct browser scripts to handle complex conversions locally.

---

 📂 Project Structure Overview

Key components of the Any2Convert platform include:

*   `routes/web.php`: Central routing file mapping all tool slugs, blog posts, redirect layouts, and static views.
*   `app/Http/Controllers/HomeController.php`: Core controller managing the homepage tool state, dynamic SEO highlight topics, and blog index/articles.
*   `app/Http/Controllers/ToolController.php`: Renders dynamic tool handlers and processes server-side API operations (e.g., YouTube video downloads).
*   `app/Support/tool_handlers.php`: Contains the structural HTML/JS templates for each of the 85+ tools.
*   `app/Support/tool_slugs.php`: Map lookup configuration translating tool IDs (e.g., `img_to_pdf`) to user-friendly URL slugs (e.g., `image-to-pdf`).
*   `resources/views/home.blade.php`: Main entry layout and user interface housing the tool presentation logic.
*   `bin/`: Storage folder for server-side binaries/executables, including `yt-dlp` for video extraction.

---

 🛠️ Tool Directory

Here is a breakdown of the 85+ conversion and utility tools included in the platform:

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
*   YouTube Video Downloader (Server-side downloads powered by `yt-dlp`)

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

4.  Install FFmpeg (Optional but Recommended for Video Downloader):
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
