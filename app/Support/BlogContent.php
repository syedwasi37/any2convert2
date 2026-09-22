<?php

namespace App\Support;

class BlogContent
{
    /**
     * Get all blog posts for the listing page.
     */
    public static function getAllPosts(): array
    {
        $slugs = require app_path('Support/tool_slugs.php');
        $tools = self::getToolList();
        $posts = [];

        foreach ($tools as $toolId => $tool) {
            if (!isset($slugs[$toolId])) {
                continue;
            }

            $slug = $slugs[$toolId];
            $category = $tool['category'];
            $gradients = self::getCategoryGradients($category);

            $post = [
                'slug' => $slug,
                'tool_id' => $toolId,
                'title' => self::getBlogTitle($toolId, $tool['name']),
                'excerpt' => $tool['desc'] . '. Learn how to use this free online tool to optimize your workflow with privacy-focused, browser-based processing.',
                'category' => self::getCategoryLabel($category),
                'category_slug' => $category,
                'read_time' => self::calculateReadTime($toolId),
                'date' => self::getPublishDate($toolId),
                'image' => self::getCategoryImage($category),
                'author' => 'Any2Convert Tech Team',
                'gradient_class' => $gradients['gradient'],
                'glow_class' => $gradients['glow'],
                'text_class' => $gradients['text'],
                'icon_svg' => self::getIconSvg($toolId, $category),
            ];
            $posts[] = $post;
        }

        // Add legacy blog posts to the list for backwards compatibility
        $pdfGradients = self::getCategoryGradients('pdf');
        $posts[] = [
            'slug' => 'security-benefits',
            'tool_id' => null,
            'title' => 'Why Image to PDF is More Secure',
            'excerpt' => 'Learn the key PDF security benefits of converting photos to PDF documents, including password protection and formatting preservation.',
            'category' => 'Security',
            'category_slug' => 'pdf',
            'read_time' => '3 min read',
            'date' => 'May 12, 2026',
            'image' => '/images/blog/pdf_blog.jpg',
            'author' => 'Security Analyst',
            'gradient_class' => $pdfGradients['gradient'],
            'glow_class' => $pdfGradients['glow'],
            'text_class' => $pdfGradients['text'],
            'icon_svg' => self::getIconSvg(null, 'pdf'),
        ];

        $bizGradients = self::getCategoryGradients('business');
        $posts[] = [
            'slug' => 'qr-guide',
            'tool_id' => null,
            'title' => 'Business QR Code Best Practices',
            'excerpt' => 'A comprehensive guide on creating clear, scan-friendly QR codes for links, menus, contacts, and marketing campaigns.',
            'category' => 'Business & Marketing',
            'category_slug' => 'business',
            'read_time' => '4 min read',
            'date' => 'June 05, 2026',
            'image' => '/images/blog/utility_blog.jpg',
            'author' => 'Marketing Team',
            'gradient_class' => $bizGradients['gradient'],
            'glow_class' => $bizGradients['glow'],
            'text_class' => $bizGradients['text'],
            'icon_svg' => self::getIconSvg(null, 'business'),
        ];

        return $posts;
    }

    /**
     * Get a specific blog post by slug.
     */
    public static function getPostBySlug(string $slug): ?array
    {
        $posts = self::getAllPosts();
        foreach ($posts as $post) {
            if ($post['slug'] === $slug) {
                // Generate content
                $post['content'] = self::generateContent($post);
                return $post;
            }
        }
        return null;
    }

    /**
     * Calculate static read time based on tool ID.
     */
    private static function calculateReadTime(string $toolId): string
    {
        $len = strlen($toolId);
        $min = 3 + ($len % 3);
        return $min . ' min read';
    }

    /**
     * Generate a deterministic publish date.
     */
    private static function getPublishDate(string $toolId): string
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $charSum = crc32($toolId);
        $day = 1 + ($charSum % 28);
        $month = $months[$charSum % 12];
        $year = 2025 + ($charSum % 2);
        return "$month " . str_pad($day, 2, '0', STR_PAD_LEFT) . ", $year";
    }

    /**
     * Get category image path based on category key.
     */
    public static function getCategoryImage(string $category): string
    {
        switch ($category) {
            case 'pdf':
                return '/images/blog/pdf_blog.jpg';
            case 'convert':
            case 'conversion':
                return '/images/blog/converter_blog.jpg';
            case 'gaming':
            case 'fun':
                return '/images/blog/gaming_blog.jpg';
            default:
                return '/images/blog/utility_blog.jpg';
        }
    }

    private static function getCategoryLabel(string $category): string
    {
        $labels = [
            'pdf' => 'PDF Guide',
            'convert' => 'Document Converter',
            'utility' => 'Utility Tool',
            'conversion' => 'Data Converter',
            'calculator' => 'Calculator Guide',
            'business' => 'Business Utility',
            'writing' => 'Writing Assistant',
            'developer' => 'Developer Utility',
            'gaming' => 'Gaming Tools',
            'fun' => 'Fun & Interactive',
        ];
        return $labels[$category] ?? 'Tutorial';
    }

    private static function getBlogTitle(string $toolId, string $name): string
    {
        $templates = [
            'How to Use %s: A Step-by-Step Browser Guide',
            'The Complete Guide to Free %s Online',
            'Why %s is Essential for Your Digital Workflow',
            'Optimize Your Files: %s Tutorial and Tips',
            'Mastering %s: Online File Processing Simplified',
        ];
        $sum = crc32($toolId);
        $tpl = $templates[$sum % count($templates)];
        return sprintf($tpl, $name);
    }

    /**
     * Get the full list of tools with category metadata.
     */
    private static function getToolList(): array
    {
        return [
            'img_to_pdf' => ['name' => 'Image to PDF', 'desc' => 'Convert JPG, PNG images to PDF documents', 'category' => 'pdf'],
            'split_pdf' => ['name' => 'Split PDF', 'desc' => 'Split one PDF into separate ranges', 'category' => 'pdf'],
            'pdf_to_img' => ['name' => 'PDF to Image', 'desc' => 'Extract images from PDF documents', 'category' => 'pdf'],
            'pdf_to_word' => ['name' => 'PDF to Word', 'desc' => 'Convert PDF to editable DOCX', 'category' => 'pdf'],
            'pdf_to_ppt' => ['name' => 'PDF to PPT', 'desc' => 'Convert PDF to PowerPoint', 'category' => 'pdf'],
            'pdf_to_excel' => ['name' => 'PDF to Excel', 'desc' => 'Extract tables from PDF files to XLSX format', 'category' => 'pdf'],
            'merge_pdf' => ['name' => 'Merge PDF', 'desc' => 'Merge and combine multiple PDF files', 'category' => 'pdf'],
            'organize_pdf' => ['name' => 'Organize PDF', 'desc' => 'Reorder pages into a new PDF', 'category' => 'pdf'],
            'remove_pages' => ['name' => 'Remove Pages', 'desc' => 'Delete unwanted pages quickly', 'category' => 'pdf'],
            'extract_pages' => ['name' => 'Extract Pages', 'desc' => 'Save selected pages as a new PDF', 'category' => 'pdf'],
            'rotate_pdf' => ['name' => 'Rotate PDF', 'desc' => 'Rotate every PDF page in one click', 'category' => 'pdf'],
            'compress_pdf' => ['name' => 'Compress PDF', 'desc' => 'Compress and reduce PDF file sizes', 'category' => 'pdf'],
            'optimize_pdf' => ['name' => 'Optimize PDF', 'desc' => 'Clean and optimize PDF structure', 'category' => 'pdf'],
            'repair_pdf' => ['name' => 'Repair PDF', 'desc' => 'Rebuild PDFs with minor issues', 'category' => 'pdf'],
            'ocr_pdf' => ['name' => 'OCR PDF', 'desc' => 'Extract text from scanned PDFs', 'category' => 'pdf'],
            'add_page_numbers' => ['name' => 'Add Page Numbers', 'desc' => 'Stamp page numbers on every page', 'category' => 'pdf'],
            'add_watermark' => ['name' => 'Add Watermark', 'desc' => 'Add text watermark to PDF pages', 'category' => 'pdf'],
            'protect_pdf' => ['name' => 'Protect PDF', 'desc' => 'Add password protection to PDF files', 'category' => 'pdf'],
            'unlock_pdf' => ['name' => 'Unlock PDF', 'desc' => 'Create an unlocked copy for viewing', 'category' => 'pdf'],
            'sign_pdf' => ['name' => 'Sign PDF', 'desc' => 'Place a signature image on a PDF', 'category' => 'pdf'],
            'crop_pdf' => ['name' => 'Crop PDF', 'desc' => 'Trim margins from PDF pages', 'category' => 'pdf'],
            'compare_pdf' => ['name' => 'Compare PDF', 'desc' => 'Compare text differences between PDFs', 'category' => 'pdf'],
            'ai_summarizer' => ['name' => 'AI Summarizer', 'desc' => 'Generate a quick PDF summary', 'category' => 'pdf'],
            'pdf_to_pdfa' => ['name' => 'PDF to PDF/A', 'desc' => 'Create an archival-style export', 'category' => 'pdf'],
            'edit_pdf' => ['name' => 'Edit PDF', 'desc' => 'Add text and images to a PDF', 'category' => 'pdf'],
            'redact_pdf' => ['name' => 'Redact PDF', 'desc' => 'Burn in keyword redactions', 'category' => 'pdf'],
            'translate_pdf' => ['name' => 'Translate PDF', 'desc' => 'Translate extracted PDF text', 'category' => 'pdf'],
            
            'word_to_pdf' => ['name' => 'Word to PDF', 'desc' => 'Convert DOC/DOCX documents to PDF', 'category' => 'convert'],
            'excel_to_pdf' => ['name' => 'Excel to PDF', 'desc' => 'Convert spreadsheets to PDF', 'category' => 'convert'],
            'ppt_to_pdf' => ['name' => 'PowerPoint to PDF', 'desc' => 'Convert PowerPoint slides to PDF format', 'category' => 'convert'],
            'html_to_pdf' => ['name' => 'HTML to PDF', 'desc' => 'Turn HTML into a PDF document', 'category' => 'convert'],
            'json_to_csv' => ['name' => 'JSON to CSV', 'desc' => 'Convert JSON to spreadsheet', 'category' => 'convert'],
            'csv_to_json' => ['name' => 'CSV to JSON', 'desc' => 'Convert CSV spreadsheet data to JSON format', 'category' => 'convert'],
            'image_to_svg' => ['name' => 'Image to SVG', 'desc' => 'Trace bitmap artwork into vector SVG', 'category' => 'convert'],
            
            'qr_generator' => ['name' => 'QR Generator', 'desc' => 'Create QR codes instantly', 'category' => 'utility'],
            'password_gen' => ['name' => 'Password Generator', 'desc' => 'Generate secure random passwords', 'category' => 'utility'],
            'word_counter' => ['name' => 'Word Counter', 'desc' => 'Count words and characters', 'category' => 'utility'],
            'image_compressor' => ['name' => 'Image Compressor', 'desc' => 'Compress and reduce image file sizes', 'category' => 'utility'],
            'resize_image' => ['name' => 'Resize Image', 'desc' => 'Resize and change image dimensions', 'category' => 'utility'],
            'crop_image' => ['name' => 'Crop Image', 'desc' => 'Crop screenshots and photos', 'category' => 'utility'],
            'image_enhancer' => ['name' => 'Image Enhancer', 'desc' => 'Upscale and sharpen blurry images', 'category' => 'utility'],
            'image_converter' => ['name' => 'Image Converter', 'desc' => 'Change JPG, PNG, and WEBP formats', 'category' => 'utility'],
            'heic_converter' => ['name' => 'HEIC to JPG PNG PDF', 'desc' => 'Convert HEIC images to JPG, PNG, or PDF', 'category' => 'utility'],
            'jpg_converter' => ['name' => 'JPG to PNG JPEG PDF', 'desc' => 'Convert JPG images to PNG, JPEG, or PDF', 'category' => 'utility'],
            'webp_converter' => ['name' => 'WEBP to PNG JPG JPEG PDF', 'desc' => 'Convert WEBP images to PNG, JPG, JPEG, or PDF', 'category' => 'utility'],
            'video_to_audio' => ['name' => 'Video to Audio', 'desc' => 'Convert video to MP3, WAV, AAC, OGG, or FLAC', 'category' => 'utility'],
            'video_compressor' => ['name' => 'Video Compressor', 'desc' => 'Compress video files into smaller MP4 output', 'category' => 'utility'],
            'bg_remover' => ['name' => 'Background Remover', 'desc' => 'Remove backgrounds to create transparent PNGs', 'category' => 'utility'],
            'image_to_dxf' => ['name' => 'Image to DXF', 'desc' => 'Trace bitmap images for CAD DXF files', 'category' => 'utility'],
            'ai_image_generator' => ['name' => 'AI Image Generator', 'desc' => 'Create images from prompts', 'category' => 'utility'],
            'ocr_tool' => ['name' => 'OCR Tool', 'desc' => 'Extract text from images', 'category' => 'utility'],
            'scan_to_pdf' => ['name' => 'Scan to PDF', 'desc' => 'Convert captured pages into a PDF', 'category' => 'utility'],
            'repair_media' => ['name' => 'Repair Photos & Videos', 'desc' => 'Repair corrupt image and video files directly in your browser', 'category' => 'utility'],
            
            'currency_converter' => ['name' => 'Currency Converter', 'desc' => 'Live exchange rates with daily updates', 'category' => 'conversion'],
            'length_converter' => ['name' => 'Length Converter', 'desc' => 'Convert km to millimeter and more', 'category' => 'conversion'],
            'weight_converter' => ['name' => 'Weight Converter', 'desc' => 'Convert kg, pounds, grams, and ounces', 'category' => 'conversion'],
            'temperature_converter' => ['name' => 'Temperature Converter', 'desc' => 'Convert Celsius, Fahrenheit, and Kelvin', 'category' => 'conversion'],
            'area_converter' => ['name' => 'Area Converter', 'desc' => 'Convert square feet, acres, hectares, and more', 'category' => 'conversion'],
            'volume_converter' => ['name' => 'Volume Converter', 'desc' => 'Convert liters, gallons, cups, and more', 'category' => 'conversion'],
            'speed_converter' => ['name' => 'Speed Converter', 'desc' => 'Convert km/h, mph, knots, and m/s', 'category' => 'conversion'],
            'time_converter' => ['name' => 'Time Converter', 'desc' => 'Convert seconds, minutes, hours, days, and years', 'category' => 'conversion'],
            
            'percentage_calculator' => ['name' => 'Percentage Calculator', 'desc' => 'Find percentages, rates, and quick value ratios', 'category' => 'calculator'],
            'loan_calculator' => ['name' => 'Loan Calculator', 'desc' => 'Calculate EMI, total payment, and total interest', 'category' => 'calculator'],
            'bmi_calculator' => ['name' => 'BMI Calculator', 'desc' => 'Check body mass index from height and weight', 'category' => 'calculator'],
            'age_calculator' => ['name' => 'Age Calculator', 'desc' => 'Calculate age in years and months from birth date', 'category' => 'calculator'],
            
            'invoice_generator' => ['name' => 'Invoice Generator', 'desc' => 'Create printable invoices with totals and tax', 'category' => 'business'],
            'ats_resume_checker' => ['name' => 'ATS Resume Checker', 'desc' => 'Compare your resume against a job description', 'category' => 'business'],
            'bank_statement_to_excel' => ['name' => 'Bank Statement PDF to Excel', 'desc' => 'Extract statement rows and export them to XLSX', 'category' => 'business'],
            'social_image_resizer' => ['name' => 'Social Image Resizer', 'desc' => 'Resize creatives for Instagram, YouTube, LinkedIn, and more', 'category' => 'business'],
            
            'grammar_checker' => ['name' => 'Grammar Checker', 'desc' => 'Clean spacing, punctuation, and casing issues', 'category' => 'writing'],
            'paraphrase_tool' => ['name' => 'Paraphrase Tool', 'desc' => 'Rewrite wording into a cleaner alternative phrasing', 'category' => 'writing'],
            
            'jwt_decoder' => ['name' => 'JWT Decoder', 'desc' => 'Decode token headers and payloads locally', 'category' => 'developer'],
            
            'sensitivity_converter' => ['name' => 'Sensitivity Converter', 'desc' => 'Convert sensitivity between major FPS games', 'category' => 'gaming'],
            'reaction_time_test' => ['name' => 'Reaction Time Test', 'desc' => 'Measure how quickly you react to a visual signal', 'category' => 'gaming'],
            'cps_test' => ['name' => 'CPS Test', 'desc' => 'Track clicks per second over a fast 5 second test', 'category' => 'gaming'],
            'gamer_tag_generator' => ['name' => 'Gamer Tag Generator', 'desc' => 'Generate modern usernames for gaming profiles', 'category' => 'gaming'],
            'clip_to_gif' => ['name' => 'Clip to GIF', 'desc' => 'Turn short gaming clips into shareable GIFs', 'category' => 'gaming'],
            'tournament_bracket_generator' => ['name' => 'Tournament Bracket Generator', 'desc' => 'Create a simple single-elimination bracket instantly', 'category' => 'gaming'],
            
            'spin_wheel' => ['name' => 'Spin the Wheel', 'desc' => 'Spin a colorful random choice wheel for fast decisions', 'category' => 'fun'],
            'random_name_picker' => ['name' => 'Random Name Picker', 'desc' => 'Pick random names for giveaways, classes, and lobbies', 'category' => 'fun'],
            'typing_speed_test' => ['name' => 'Typing Speed Test', 'desc' => 'Measure WPM and typing accuracy in the browser', 'category' => 'fun'],
            'meme_caption_generator' => ['name' => 'Meme Caption Generator', 'desc' => 'Add classic top and bottom meme captions to any image', 'category' => 'fun'],
            'truth_or_dare_generator' => ['name' => 'Truth or Dare Generator', 'desc' => 'Generate instant party prompts with one click', 'category' => 'fun'],
            'memory_match_game' => ['name' => 'Memory Match Game', 'desc' => 'Flip cards, match pairs, and beat your best time', 'category' => 'fun'],
        ];
    }

    /**
     * Generate rich WordPress-style HTML content for a specific post.
     */
    private static function generateContent(array $post): string
    {
        $toolId = $post['tool_id'];
        $title = $post['title'];
        $excerpt = $post['excerpt'];

        if ($toolId === null) {
            // Static content for legacy posts
            if ($post['slug'] === 'security-benefits') {
                return '
                <p class="lead">In today\'s digital landscape, document security is more crucial than ever. Many users often share photos (like receipts, IDs, and screenshots) in raw image formats (JPG/PNG), unaware of the security vulnerabilities associated with doing so. Transforming these images into a single, unified PDF document offers critical safety features.</p>
                
                <h2>1. Advanced Password Encryption</h2>
                <p>Unlike raw image formats, PDF files natively support industry-standard encryption algorithms (such as AES-256). By converting your photos into a PDF, you can set an owner password to control who can view, copy, print, or edit your documents, ensuring that sensitive credentials or identity cards don\'t fall into unauthorized hands.</p>
                
                <h2>2. Uniform Formatting & Anti-Tampering</h2>
                <p>When you send raw photos, they can easily be manipulated, cropped, or edited in paint software. A PDF locks the visual elements in place, making it considerably harder for bad actors to alter the content without leaving digital footprint traces. It also guarantees that the layout remains identical across all systems, whether the recipient is opening the document on an iPhone, an Android tablet, or a Windows workstation.</p>
                
                <div class="blog-note">
                    <strong>Pro Tip:</strong> When uploading scanned documents or receipts, always convert them to PDF first, then apply password restrictions.
                </div>

                <h2>3. Removal of Hidden Metadata (EXIF Data)</h2>
                <p>Raw photos captured on smartphones contain extensive EXIF metadata, including the exact GPS coordinates of where the photo was taken, the device model, camera settings, and timestamps. Uploading these images directly online exposes your personal privacy. A PDF conversion strips away this hidden camera metadata, making your files safe for public transmission.</p>
                ';
            }
            if ($post['slug'] === 'qr-guide') {
                return '
                <p class="lead">Quick Response (QR) codes have transitioned from high-tech novelties to everyday essentials for businesses worldwide. From contactless restaurant menus to app downloads and marketing landing pages, a QR code bridges the gap between physical media and digital experiences.</p>
                
                <h2>1. Optimal Contrast and Colors</h2>
                <p>For high scan reliability across older smartphones and budget devices, your QR code must have a high contrast ratio. A dark code on a white or light background is the industry standard. While custom colors are excellent for branding, avoid pastel colors or matching background tones, as this will fail in low-light environments.</p>
                
                <h2>2. Keep URL Slugs Short</h2>
                <p>The complexity of a QR code\'s pixel grid is directly related to the length of the data it contains. A long URL with multiple query parameters results in a dense, complex grid that is difficult for cameras to scan. Use a URL shortener or clean path redirects to keep the grid simple and quick to resolve.</p>
                
                <h2>3. Provide an Explicit Call to Action (CTA)</h2>
                <p>Never print a bare QR code. Users are cautious about scanning random codes due to security concerns. Always border your QR code with a clear action text like "Scan to View Menu" or "Scan for Free Wi-Fi". This establishes trust and increases engagement rates by over 40%.</p>
                ';
            }
        }

        // Bespoke unique content for top tools
        switch ($toolId) {
            case 'img_to_pdf':
                return '
                <p class="lead">Converting images to PDF is one of the most frequent document management tasks. Whether you are compiling receipts, submitting scanned assignments, or sharing design portfolios, combining JPG or PNG images into a single PDF ensures formatting consistency across all devices.</p>
                <h2>Why Convert JPG and PNG Images to PDF?</h2>
                <p>Raw image files can vary dramatically in dimensions, orientation, and resolution. When sending multiple photos via email or chat, recipients must open each file individually. Merging them into a single PDF standardizes page sizes, prevents accidental editing, and reduces overall attachment friction.</p>
                <h2>Key Benefits of Browser-Based Image-to-PDF Conversion</h2>
                <ul>
                    <li><strong>100% On-Device Processing:</strong> Your personal photos and documents never upload to remote servers. All rendering happens inside WebAssembly and browser canvas APIs.</li>
                    <li><strong>Batch Combination:</strong> Select dozens of images at once and arrange them in any order before exporting.</li>
                    <li><strong>No File Size Restrictions:</strong> Since processing utilizes your computer\'s local memory, you aren\'t bound by server upload caps.</li>
                </ul>
                <div class="blog-note">
                    <strong>Privacy First:</strong> Identity cards, medical bills, and financial receipts should never be uploaded to unverified online converters. On Any2Convert, processing stays completely on your local device.
                </div>
                <h2>How to Use Image to PDF on Any2Convert</h2>
                <ol class="blog-steps">
                    <li>Open the <a href="/image-to-pdf">Image to PDF tool</a>.</li>
                    <li>Drag and drop your JPG, PNG, WEBP, or GIF files into the dropzone.</li>
                    <li>Reorder pages using the thumbnail preview cards.</li>
                    <li>Click <strong>Generate PDF</strong> to instantly download the compiled file.</li>
                </ol>
                ';

            case 'pdf_to_word':
                return '
                <p class="lead">Need to modify text inside a read-only PDF? Converting PDF files to editable Word (DOCX) documents allows you to tweak contracts, update resumes, and reuse existing document layouts without starting from scratch.</p>
                <h2>Overcoming the PDF Editing Challenge</h2>
                <p>The PDF format was created to freeze visual layouts, not for editing. Extracting editable text while retaining paragraphs, font styling, and line spacing requires intelligent layout parsing. Any2Convert\'s PDF to Word tool analyzes text structures in your browser and maps them directly into standard Microsoft Word blocks.</p>
                <h2>When Should You Convert PDF to DOCX?</h2>
                <ul>
                    <li>Updating existing resumes or employment cover letters.</li>
                    <li>Modifying terms and conditions in formal business contracts.</li>
                    <li>Extracting study notes and quotes from academic publications.</li>
                </ul>
                ';

            case 'compress_pdf':
                return '
                <p class="lead">Large PDF files can trigger email attachment bounces and slow down website uploads. Compressing your PDF files reduces file size while preserving document clarity and readable typography.</p>
                <h2>How PDF Compression Works</h2>
                <p>PDF documents often accumulate uncompressed embedded streams, high-resolution background assets, and redundant font subsets. Compression optimizes internal stream structures and downsamples high-DPI images to standard web resolution (150 DPI), trimming MBs of unnecessary weight.</p>
                <h2>Benefits of Local Browser PDF Compression</h2>
                <p>Traditional cloud compressors upload your sensitive documents to distant servers. Any2Convert performs all vector stream optimization directly inside your browser sandbox, delivering immediate speed and total privacy.</p>
                ';

            case 'image_compressor':
                return '
                <p class="lead">Website load speeds and storage space heavily depend on image size. Compressing JPG, PNG, and WEBP images cuts file sizes by up to 80% without noticeable visual degradation.</p>
                <h2>Lossy vs Lossless Image Compression</h2>
                <p>Lossless compression strips unnecessary EXIF metadata and optimizes color palettes, while lossy compression selectively removes subtle visual information invisible to the human eye. Any2Convert balances both methods for maximum weight reduction.</p>
                ';

            case 'word_counter':
                return '
                <p class="lead">Accurate word count and character metrics are essential for authors, SEO copywriters, students, and social media managers. Any2Convert\'s Word Counter offers real-time statistics as you type or paste text.</p>
                <h2>Detailed Text Metrics Available</h2>
                <ul>
                    <li>Total Word Count & Character Count (with and without spaces).</li>
                    <li>Sentence & Paragraph Counts.</li>
                    <li>Estimated Reading Time and Speaking Duration.</li>
                </ul>
                ';
        }

        // Category-aware dynamic generator for remaining tools
        $tool = self::getToolList()[$toolId] ?? ['name' => $post['title'], 'category' => 'utility', 'desc' => $excerpt];
        $name = $tool['name'];
        $category = $tool['category'];
        $desc = $tool['desc'];
        
        $categoryLabel = self::getCategoryLabel($category);

        return '
        <p class="lead">The <strong>' . $name . '</strong> utility on Any2Convert provides a streamlined, browser-native solution designed to help you ' . lcfirst($desc) . ' with ease, speed, and privacy.</p>

        <h2>Why Choose Any2Convert\'s ' . $name . '?</h2>
        <p>Unlike conventional web services that upload your assets to third-party cloud infrastructure, Any2Convert prioritizes on-device computation. By leveraging modern web standards, your operations run locally on your device hardware.</p>

        <h2>Quick Usage Guide for ' . $name . '</h2>
        <ol class="blog-steps">
            <li><strong>Navigate to the Tool:</strong> Open the <a href="/' . $post['slug'] . '">Any2Convert ' . $name . '</a> page.</li>
            <li><strong>Input Data or Files:</strong> Upload your source file or type your input directly into the interactive workspace.</li>
            <li><strong>Process & Download:</strong> Click the process action to immediately receive your result without server delay.</li>
        </ol>

        <div class="blog-note">
            <strong>Security Guarantee:</strong> Your data remains inside your browser environment throughout the process.
        </div>
        ';
    }

    public static function getCategoryGradients(string $category): array
    {
        $map = [
            'pdf' => [
                'gradient' => 'from-red-600/10 via-red-500/5 to-transparent',
                'glow' => 'from-red-500 to-orange-500',
                'text' => 'text-red-500'
            ],
            'convert' => [
                'gradient' => 'from-blue-600/10 via-blue-500/5 to-transparent',
                'glow' => 'from-blue-500 to-indigo-500',
                'text' => 'text-blue-500'
            ],
            'utility' => [
                'gradient' => 'from-violet-600/10 via-violet-500/5 to-transparent',
                'glow' => 'from-violet-500 to-fuchsia-500',
                'text' => 'text-violet-500'
            ],
            'conversion' => [
                'gradient' => 'from-emerald-600/10 via-emerald-500/5 to-transparent',
                'glow' => 'from-emerald-500 to-teal-500',
                'text' => 'text-emerald-500'
            ],
            'calculator' => [
                'gradient' => 'from-amber-600/10 via-amber-500/5 to-transparent',
                'glow' => 'from-amber-500 to-yellow-500',
                'text' => 'text-amber-500'
            ],
            'business' => [
                'gradient' => 'from-emerald-600/10 via-emerald-500/5 to-transparent',
                'glow' => 'from-emerald-500 to-teal-500',
                'text' => 'text-emerald-500'
            ],
            'writing' => [
                'gradient' => 'from-indigo-600/10 via-indigo-500/5 to-transparent',
                'glow' => 'from-indigo-500 to-purple-500',
                'text' => 'text-indigo-500'
            ],
            'developer' => [
                'gradient' => 'from-cyan-600/10 via-cyan-500/5 to-transparent',
                'glow' => 'from-cyan-500 to-blue-500',
                'text' => 'text-cyan-500'
            ],
            'gaming' => [
                'gradient' => 'from-pink-600/10 via-pink-500/5 to-transparent',
                'glow' => 'from-pink-500 to-rose-500',
                'text' => 'text-pink-500'
            ],
            'fun' => [
                'gradient' => 'from-fuchsia-600/10 via-fuchsia-500/5 to-transparent',
                'glow' => 'from-fuchsia-500 to-pink-500',
                'text' => 'text-fuchsia-500'
            ]
        ];

        return $map[$category] ?? [
            'gradient' => 'from-gray-600/10 via-gray-500/5 to-transparent',
            'glow' => 'from-gray-500 to-slate-500',
            'text' => 'text-gray-500'
        ];
    }

    public static function getIconSvg(?string $toolId, string $category): string
    {
        if ($toolId === null) {
            if ($category === 'pdf') {
                return '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>';
            }
            return '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/></svg>';
        }

        $iconMap = [
            'img_to_pdf' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>',
            'pdf_to_img' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="10" y1="12" x2="14" y2="12"/><line x1="12" y1="10" x2="12" y2="14"/></svg>',
            'pdf_to_word' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="13" y2="17"/></svg>',
            'pdf_to_ppt' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
            'pdf_to_excel' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/><line x1="12" y1="3" x2="12" y2="21"/></svg>',
            'merge_pdf' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-3"/><rect x="10" y="2" width="12" height="12" rx="2" ry="2"/></svg>',
            'compress_pdf' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 14 10 14 10 20"/><polyline points="20 10 14 10 14 4"/><line x1="10" y1="14" x2="21" y2="3"/><line x1="3" y1="21" x2="14" y2="10"/></svg>',
            'protect_pdf' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
            
            'word_to_pdf' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>',
            'excel_to_pdf' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/><line x1="12" y1="3" x2="12" y2="21"/></svg>',
            'ppt_to_pdf' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
            'html_to_pdf' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
            'json_to_csv' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
            'csv_to_json' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>',
            'image_to_svg' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
            
            'qr_generator' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/><rect x="18" y="18" width="3" height="3"/><rect x="14" y="18" width="3" height="3"/><rect x="18" y="14" width="3" height="3"/></svg>',
            'password_gen' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>',
            'word_counter' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="19" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>',
            'image_compressor' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/><line x1="12" y1="12" x2="16" y2="16"/></svg>',
            'invoice_generator' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M14 3v5h5"/><path d="M8 13h8"/><path d="M8 17h5"/></svg>',
            'ats_resume_checker' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="2"/><path d="M8 8h8"/><path d="M8 12h8"/><path d="M8 16h5"/></svg>',
            'grammar_checker' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19h6"/><path d="M7 5v14"/><path d="M15 5l5 14"/><path d="M13 14h5"/></svg>',
            'paraphrase_tool' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h10"/><path d="M7 12h7"/><path d="M7 17h10"/><path d="M17 10l3 2-3 2"/></svg>',
            'jwt_decoder' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M7 9h10"/><path d="M7 13h7"/><path d="M7 17h4"/></svg>',
            'youtube_downloader' => '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33 2.78 2.78 0 0 0 1.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>'
        ];

        if (isset($iconMap[$toolId])) {
            return $iconMap[$toolId];
        }

        switch ($category) {
            case 'pdf':
                return '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>';
            case 'convert':
            case 'conversion':
                return '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/></svg>';
            case 'calculator':
                return '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="9" y1="22" x2="9" y2="16"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="16" y1="22" x2="16" y2="16"/><line x1="9" y1="16" x2="16" y2="16"/><circle cx="7.5" cy="10.5" r="1"/><circle cx="12" cy="10.5" r="1"/><circle cx="16.5" cy="10.5" r="1"/></svg>';
            case 'gaming':
            case 'fun':
                return '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"/><path d="M12 12h.01"/><path d="M15 10v4"/><path d="M17 12h2"/><path d="M6 12h4"/><path d="M8 10v4"/></svg>';
            default:
                return '<svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>';
        }
    }
}
