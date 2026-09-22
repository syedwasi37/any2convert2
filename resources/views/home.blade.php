<?php
$isAdminUser = false;
$dashboardHref = url('/dashboard');

$trustHighlights = [
    ['slug' => 'no-file-uploads', 'label' => 'No file uploads', 'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'],
    ['slug' => 'instant-processing', 'label' => 'Instant processing', 'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>'],
    ['slug' => 'free-forever', 'label' => 'Free forever', 'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--amber)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>'],
    ['slug' => 'works-in-browser', 'label' => 'Runs on your device', 'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>'],
];

// Lookup table for slugs
$tool_slugs = [
    'img_to_pdf' => 'image-to-pdf', 'pdf_to_img' => 'pdf-to-image', 'pdf_to_word' => 'pdf-to-word',
    'pdf_to_ppt' => 'pdf-to-powerpoint', 'pdf_to_excel' => 'pdf-to-excel', 'merge_pdf' => 'merge-pdf',
    'compress_pdf' => 'compress-pdf', 'protect_pdf' => 'protect-pdf', 'word_to_pdf' => 'word-to-pdf',
    'excel_to_pdf' => 'excel-to-pdf', 'ppt_to_pdf' => 'powerpoint-to-pdf', 'html_to_pdf' => 'html-to-pdf',
    'split_pdf' => 'split-pdf', 'remove_pages' => 'remove-pdf-pages', 'extract_pages' => 'extract-pdf-pages',
    'organize_pdf' => 'organize-pdf', 'scan_to_pdf' => 'scan-to-pdf', 'optimize_pdf' => 'optimize-pdf',
    'repair_pdf' => 'repair-pdf', 'ocr_pdf' => 'ocr-pdf', 'rotate_pdf' => 'rotate-pdf',
    'add_page_numbers' => 'add-page-numbers', 'add_watermark' => 'add-watermark', 'unlock_pdf' => 'unlock-pdf',
    'sign_pdf' => 'sign-pdf', 'crop_pdf' => 'crop-pdf', 'compare_pdf' => 'compare-pdf',
    'ai_summarizer' => 'ai-summarizer', 'pdf_to_pdfa' => 'pdf-to-pdfa', 'edit_pdf' => 'edit-pdf',
    'redact_pdf' => 'redact-pdf', 'translate_pdf' => 'translate-pdf',
    'json_to_csv' => 'json-to-csv', 'csv_to_json' => 'csv-to-json', 'qr_generator' => 'qr-code-generator',
    'password_gen' => 'password-generator', 'word_counter' => 'word-counter', 'image_compressor' => 'image-compressor',
    'bg_remover' => 'background-remover', 'image_to_dxf' => 'image-to-dxf', 'image_to_svg' => 'image-to-svg',
    'resize_image' => 'resize-image', 'crop_image' => 'crop-image', 'image_enhancer' => 'image-enhancer', 'image_converter' => 'image-converter', 'heic_converter' => 'heic-to-jpg-png-pdf', 'jpg_converter' => 'jpg-to-png-jpeg-pdf', 'webp_converter' => 'webp-to-png-jpg-jpeg-pdf', 'video_to_audio' => 'video-to-audio', 'video_compressor' => 'video-compressor', 'ai_image_generator' => 'ai-image-generator',
    'ocr_tool' => 'ocr-image-to-text', 'repair_media' => 'repair-corrupt-photos-videos', 'currency_converter' => 'currency-converter', 'length_converter' => 'length-converter',
    'weight_converter' => 'weight-converter', 'temperature_converter' => 'temperature-converter', 'area_converter' => 'area-converter',
    'volume_converter' => 'volume-converter', 'speed_converter' => 'speed-converter', 'time_converter' => 'time-converter',
    'invoice_generator' => 'invoice-generator', 'ats_resume_checker' => 'ats-resume-checker',
    'social_image_resizer' => 'social-image-resizer', 'jwt_decoder' => 'jwt-decoder',
    'bank_statement_to_excel' => 'bank-statement-pdf-to-excel', 'grammar_checker' => 'grammar-checker',
    'paraphrase_tool' => 'paraphrase-tool', 'percentage_calculator' => 'percentage-calculator',
    'youtube_downloader' => 'youtube-video-downloader',
    'loan_calculator' => 'loan-calculator', 'bmi_calculator' => 'bmi-calculator',
    'age_calculator' => 'age-calculator',
    'sensitivity_converter' => 'sensitivity-converter',
    'reaction_time_test' => 'reaction-time-test',
    'cps_test' => 'cps-test',
    'gamer_tag_generator' => 'gamer-tag-generator',
    'clip_to_gif' => 'clip-to-gif',
    'tournament_bracket_generator' => 'tournament-bracket-generator',
    'spin_wheel' => 'spin-the-wheel',
    'random_name_picker' => 'random-name-picker',
    'typing_speed_test' => 'typing-speed-test',
    'meme_caption_generator' => 'meme-caption-generator',
    'truth_or_dare_generator' => 'truth-or-dare-generator',
    'memory_match_game' => 'memory-match-game'
];

// Get all tools from database for dynamic display
$tools = [
    'pdf' => [
        'title' => 'PDF Tools',
        'icon' => '📄',
        'tools' => [
            ['id' => 'img_to_pdf', 'name' => 'Image to PDF', 'icon' => 'img_to_pdf', 'desc' => 'Convert JPG, PNG images to PDF documents', 'long_desc' => 'This tool allows you to convert your images (JPG, PNG, etc.) into a single PDF file. You can upload multiple images and they will be combined into one PDF. This is useful for creating photo albums, portfolios, or for archiving images in a single document.'],
            ['id' => 'split_pdf', 'name' => 'Split PDF', 'icon' => 'merge_pdf', 'desc' => 'Split one PDF into separate ranges'],
            ['id' => 'pdf_to_img', 'name' => 'PDF to Image', 'icon' => 'pdf_to_img', 'desc' => 'Extract images from PDF documents'],
            ['id' => 'pdf_to_word', 'name' => 'PDF to Word', 'icon' => 'pdf_to_word', 'desc' => 'Convert PDF to editable DOCX'],
            ['id' => 'pdf_to_ppt', 'name' => 'PDF to PPT', 'icon' => 'pdf_to_ppt', 'desc' => 'Convert PDF to PowerPoint'],
            ['id' => 'pdf_to_excel', 'name' => 'PDF to Excel', 'icon' => 'pdf_to_excel', 'desc' => 'Extract tables from PDF files to XLSX format'],
            ['id' => 'merge_pdf', 'name' => 'Merge PDF', 'icon' => 'merge_pdf', 'desc' => 'Merge and combine multiple PDF files'],
            ['id' => 'organize_pdf', 'name' => 'Organize PDF', 'icon' => 'merge_pdf', 'desc' => 'Reorder pages into a new PDF'],
            ['id' => 'remove_pages', 'name' => 'Remove Pages', 'icon' => 'merge_pdf', 'desc' => 'Delete unwanted pages quickly'],
            ['id' => 'extract_pages', 'name' => 'Extract Pages', 'icon' => 'merge_pdf', 'desc' => 'Save selected pages as a new PDF'],
            ['id' => 'rotate_pdf', 'name' => 'Rotate PDF', 'icon' => 'merge_pdf', 'desc' => 'Rotate every PDF page in one click'],
            ['id' => 'compress_pdf', 'name' => 'Compress PDF', 'icon' => 'compress_pdf', 'desc' => 'Compress and reduce PDF file sizes'],
            ['id' => 'optimize_pdf', 'name' => 'Optimize PDF', 'icon' => 'compress_pdf', 'desc' => 'Clean and optimize PDF structure'],
            ['id' => 'repair_pdf', 'name' => 'Repair PDF', 'icon' => 'protect_pdf', 'desc' => 'Rebuild PDFs with minor issues'],
            ['id' => 'ocr_pdf', 'name' => 'OCR PDF', 'icon' => 'ocr_tool', 'desc' => 'Extract text from scanned PDFs'],
            ['id' => 'add_page_numbers', 'name' => 'Add Page Numbers', 'icon' => 'pdf_to_word', 'desc' => 'Stamp page numbers on every page'],
            ['id' => 'add_watermark', 'name' => 'Add Watermark', 'icon' => 'protect_pdf', 'desc' => 'Add text watermark to PDF pages'],
            ['id' => 'protect_pdf', 'name' => 'Protect PDF', 'icon' => 'protect_pdf', 'desc' => 'Add password protection to PDF files'],
            ['id' => 'unlock_pdf', 'name' => 'Unlock PDF', 'icon' => 'protect_pdf', 'desc' => 'Create an unlocked copy for viewing'],
            ['id' => 'sign_pdf', 'name' => 'Sign PDF', 'icon' => 'protect_pdf', 'desc' => 'Place a signature image on a PDF'],
            ['id' => 'crop_pdf', 'name' => 'Crop PDF', 'icon' => 'merge_pdf', 'desc' => 'Trim margins from PDF pages'],
            ['id' => 'compare_pdf', 'name' => 'Compare PDF', 'icon' => 'pdf_to_word', 'desc' => 'Compare text differences between PDFs'],
            ['id' => 'ai_summarizer', 'name' => 'AI Summarizer', 'icon' => 'ocr_tool', 'desc' => 'Generate a quick PDF summary'],
            ['id' => 'pdf_to_pdfa', 'name' => 'PDF to PDF/A', 'icon' => 'protect_pdf', 'desc' => 'Create an archival-style export'],
            ['id' => 'edit_pdf', 'name' => 'Edit PDF', 'icon' => 'pdf_to_word', 'desc' => 'Add text and images to a PDF'],
            ['id' => 'redact_pdf', 'name' => 'Redact PDF', 'icon' => 'protect_pdf', 'desc' => 'Burn in keyword redactions'],
            ['id' => 'translate_pdf', 'name' => 'Translate PDF', 'icon' => 'ocr_tool', 'desc' => 'Translate extracted PDF text'],
        ]
    ],
    'convert' => [
        'title' => 'Document Converters',
        'icon' => '🔄',
        'tools' => [
            ['id' => 'word_to_pdf', 'name' => 'Word to PDF', 'icon' => 'word_to_pdf', 'desc' => 'Convert DOC/DOCX documents to PDF'],
            ['id' => 'excel_to_pdf', 'name' => 'Excel to PDF', 'icon' => 'word_to_pdf', 'desc' => 'Convert spreadsheets to PDF'],
            ['id' => 'ppt_to_pdf', 'name' => 'PowerPoint to PDF', 'icon' => 'word_to_pdf', 'desc' => 'Convert PowerPoint slides to PDF format'],
            ['id' => 'html_to_pdf', 'name' => 'HTML to PDF', 'icon' => 'word_to_pdf', 'desc' => 'Turn HTML into a PDF document'],
            ['id' => 'json_to_csv', 'name' => 'JSON to CSV', 'icon' => 'json_to_csv', 'desc' => 'Convert JSON to spreadsheet'],
            ['id' => 'csv_to_json', 'name' => 'CSV to JSON', 'icon' => 'csv_to_json', 'desc' => 'Convert CSV spreadsheet data to JSON format'],
            ['id' => 'image_to_svg', 'name' => 'Image to SVG', 'icon' => 'image_to_svg', 'desc' => 'Trace bitmap artwork into vector SVG'],
        ]
    ],
    'utility' => [
        'title' => 'Utility Tools',
        'icon' => '⚡',
        'tools' => [
            ['id' => 'qr_generator', 'name' => 'QR Generator', 'icon' => 'qr_generator', 'desc' => 'Create QR codes instantly'],
            ['id' => 'password_gen', 'name' => 'Password Generator', 'icon' => 'password_gen', 'desc' => 'Generate secure random passwords'],
            ['id' => 'word_counter', 'name' => 'Word Counter', 'icon' => 'word_counter', 'desc' => 'Count words and characters'],
            ['id' => 'image_compressor', 'name' => 'Image Compressor', 'icon' => 'image_compressor', 'desc' => 'Compress and reduce image file sizes'],
            ['id' => 'resize_image', 'name' => 'Resize Image', 'icon' => 'resize_image', 'desc' => 'Resize and change image dimensions'],
            ['id' => 'crop_image', 'name' => 'Crop Image', 'icon' => 'crop_image', 'desc' => 'Crop screenshots and photos'],
            ['id' => 'image_enhancer', 'name' => 'Image Enhancer', 'icon' => 'image_enhancer', 'desc' => 'Upscale and sharpen blurry images'],
            ['id' => 'image_converter', 'name' => 'Image Converter', 'icon' => 'image_compressor', 'desc' => 'Change JPG, PNG, and WEBP formats'],
            ['id' => 'heic_converter', 'name' => 'HEIC to JPG PNG PDF', 'icon' => 'image_compressor', 'desc' => 'Convert HEIC images to JPG, PNG, or PDF'],
            ['id' => 'jpg_converter', 'name' => 'JPG to PNG JPEG PDF', 'icon' => 'image_compressor', 'desc' => 'Convert JPG images to PNG, JPEG, or PDF'],
            ['id' => 'webp_converter', 'name' => 'WEBP to PNG JPG JPEG PDF', 'icon' => 'image_compressor', 'desc' => 'Convert WEBP images to PNG, JPG, JPEG, or PDF'],
            ['id' => 'video_to_audio', 'name' => 'Video to Audio', 'icon' => 'video_to_audio', 'desc' => 'Convert video to MP3, WAV, AAC, OGG, or FLAC'],
            ['id' => 'video_compressor', 'name' => 'Video Compressor', 'icon' => 'video_compressor', 'desc' => 'Compress video files into smaller MP4 output'],
            ['id' => 'bg_remover', 'name' => 'Background Remover', 'icon' => 'bg_remover', 'desc' => 'Remove backgrounds to create transparent PNGs'],
            ['id' => 'image_to_dxf', 'name' => 'Image to DXF', 'icon' => 'image_to_dxf', 'desc' => 'Trace bitmap images for CAD DXF files'],
            ['id' => 'ai_image_generator', 'name' => 'AI Image Generator', 'icon' => 'ai_image_generator', 'desc' => 'Create images from prompts'],
            ['id' => 'ocr_tool', 'name' => 'OCR Tool', 'icon' => 'ocr_tool', 'desc' => 'Extract text from images'],
            ['id' => 'scan_to_pdf', 'name' => 'Scan to PDF', 'icon' => 'img_to_pdf', 'desc' => 'Convert captured pages into a PDF'],
            ['id' => 'repair_media', 'name' => 'Repair Photos & Videos', 'icon' => 'bg_remover', 'desc' => 'Fix corrupt or unopenable images and videos in bulk'],
        ]
    ],
    'conversion' => [
        'title' => 'Conversion Tools',
        'icon' => 'CONV',
        'tools' => [
            ['id' => 'currency_converter', 'name' => 'Currency Converter', 'icon' => 'currency_converter', 'desc' => 'Live exchange rates with daily updates'],
            ['id' => 'length_converter', 'name' => 'Length Converter', 'icon' => 'length_converter', 'desc' => 'Convert km to millimeter and more'],
            ['id' => 'weight_converter', 'name' => 'Weight Converter', 'icon' => 'weight_converter', 'desc' => 'Convert kg, pounds, grams, and ounces'],
            ['id' => 'temperature_converter', 'name' => 'Temperature Converter', 'icon' => 'temperature_converter', 'desc' => 'Convert Celsius, Fahrenheit, and Kelvin'],
            ['id' => 'area_converter', 'name' => 'Area Converter', 'icon' => 'area_converter', 'desc' => 'Convert square feet, acres, hectares, and more'],
            ['id' => 'volume_converter', 'name' => 'Volume Converter', 'icon' => 'volume_converter', 'desc' => 'Convert liters, gallons, cups, and more'],
            ['id' => 'speed_converter', 'name' => 'Speed Converter', 'icon' => 'speed_converter', 'desc' => 'Convert km/h, mph, knots, and m/s'],
            ['id' => 'time_converter', 'name' => 'Time Converter', 'icon' => 'time_converter', 'desc' => 'Convert seconds, minutes, hours, days, and years'],
        ]
    ],
    'calculator' => [
        'title' => 'Calculator Tools',
        'icon' => 'CALC',
        'tools' => [
            ['id' => 'percentage_calculator', 'name' => 'Percentage Calculator', 'icon' => 'percentage_calculator', 'desc' => 'Find percentages, rates, and quick value ratios'],
            ['id' => 'loan_calculator', 'name' => 'Loan Calculator', 'icon' => 'loan_calculator', 'desc' => 'Calculate EMI, total payment, and total interest'],
            ['id' => 'bmi_calculator', 'name' => 'BMI Calculator', 'icon' => 'bmi_calculator', 'desc' => 'Check body mass index from height and weight'],
            ['id' => 'age_calculator', 'name' => 'Age Calculator', 'icon' => 'age_calculator', 'desc' => 'Calculate age in years and months from birth date'],
        ]
    ],
    'business' => [
        'title' => 'Business Tools',
        'icon' => 'BIZ',
        'tools' => [
            ['id' => 'invoice_generator', 'name' => 'Invoice Generator', 'icon' => 'invoice_generator', 'desc' => 'Create printable invoices with totals and tax'],
            ['id' => 'ats_resume_checker', 'name' => 'ATS Resume Checker', 'icon' => 'ats_resume_checker', 'desc' => 'Compare your resume against a job description'],
            ['id' => 'bank_statement_to_excel', 'name' => 'Bank Statement PDF to Excel', 'icon' => 'bank_statement_to_excel', 'desc' => 'Extract statement rows and export them to XLSX'],
            ['id' => 'social_image_resizer', 'name' => 'Social Image Resizer', 'icon' => 'social_image_resizer', 'desc' => 'Resize creatives for Instagram, YouTube, LinkedIn, and more'],
        ]
    ],
    'writing' => [
        'title' => 'Writing Tools',
        'icon' => 'WRITE',
        'tools' => [
            ['id' => 'grammar_checker', 'name' => 'Grammar Checker', 'icon' => 'grammar_checker', 'desc' => 'Clean spacing, punctuation, and casing issues'],
            ['id' => 'paraphrase_tool', 'name' => 'Paraphrase Tool', 'icon' => 'paraphrase_tool', 'desc' => 'Rewrite wording into a cleaner alternative phrasing'],
        ]
    ],
    'developer' => [
        'title' => 'Developer Tools',
        'icon' => 'DEV',
        'tools' => [
            ['id' => 'jwt_decoder', 'name' => 'JWT Decoder', 'icon' => 'jwt_decoder', 'desc' => 'Decode token headers and payloads locally'],
        ]
    ],
    'gaming' => [
        'title' => 'Gaming Tools',
        'icon' => 'GAME',
        'tools' => [
            ['id' => 'sensitivity_converter', 'name' => 'Sensitivity Converter', 'icon' => 'sensitivity_converter', 'desc' => 'Convert sensitivity between major FPS games'],
            ['id' => 'reaction_time_test', 'name' => 'Reaction Time Test', 'icon' => 'reaction_time_test', 'desc' => 'Measure how quickly you react to a visual signal'],
            ['id' => 'cps_test', 'name' => 'CPS Test', 'icon' => 'cps_test', 'desc' => 'Track clicks per second over a fast 5 second test'],
            ['id' => 'gamer_tag_generator', 'name' => 'Gamer Tag Generator', 'icon' => 'gamer_tag_generator', 'desc' => 'Generate modern usernames for gaming profiles'],
            ['id' => 'clip_to_gif', 'name' => 'Clip to GIF', 'icon' => 'clip_to_gif', 'desc' => 'Turn short gaming clips into shareable GIFs'],
            ['id' => 'tournament_bracket_generator', 'name' => 'Tournament Bracket Generator', 'icon' => 'tournament_bracket_generator', 'desc' => 'Create a simple single-elimination bracket instantly'],
        ]
    ],
    'fun' => [
        'title' => 'Fun Tools',
        'icon' => 'FUN',
        'tools' => [
            ['id' => 'spin_wheel', 'name' => 'Spin the Wheel', 'icon' => 'spin_wheel', 'desc' => 'Spin a colorful random choice wheel for fast decisions'],
            ['id' => 'random_name_picker', 'name' => 'Random Name Picker', 'icon' => 'random_name_picker', 'desc' => 'Pick random names for giveaways, classes, and lobbies'],
            ['id' => 'typing_speed_test', 'name' => 'Typing Speed Test', 'icon' => 'typing_speed_test', 'desc' => 'Measure WPM and typing accuracy in the browser'],
            ['id' => 'meme_caption_generator', 'name' => 'Meme Caption Generator', 'icon' => 'meme_caption_generator', 'desc' => 'Add classic top and bottom meme captions to any image'],
            ['id' => 'truth_or_dare_generator', 'name' => 'Truth or Dare Generator', 'icon' => 'truth_or_dare_generator', 'desc' => 'Generate instant party prompts with one click'],
            ['id' => 'memory_match_game', 'name' => 'Memory Match Game', 'icon' => 'memory_match_game', 'desc' => 'Flip cards, match pairs, and beat your best time'],
        ]
    ]
];

$categoryMeta = [
    'pdf'     => ['label' => 'PDF Tools',            'accent' => 'red',   'hex' => '#EF4444'],
    'convert' => ['label' => 'Document Converters',   'accent' => 'blue',  'hex' => '#3B82F6'],
    'utility' => ['label' => 'Utility Tools',         'accent' => 'violet','hex' => '#8B5CF6'],
    'conversion' => ['label' => 'Conversion Tools',   'accent' => 'green', 'hex' => '#10B981'],
    'calculator' => ['label' => 'Calculator Tools',   'accent' => 'amber', 'hex' => '#F59E0B'],
    'business' => ['label' => 'Business Tools',       'accent' => 'emerald', 'hex' => '#10B981'],
    'writing' => ['label' => 'Writing Tools',         'accent' => 'indigo', 'hex' => '#6366F1'],
    'developer' => ['label' => 'Developer Tools',     'accent' => 'cyan', 'hex' => '#06B6D4'],
    'gaming' => ['label' => 'Gaming Tools',           'accent' => 'pink', 'hex' => '#EC4899'],
    'fun' => ['label' => 'Fun Tools',                 'accent' => 'fuchsia', 'hex' => '#D946EF'],
];

$siteUrl = 'https://any2convert.com';
$toolListSchemaItems = [];
$toolPosition = 1;
foreach ($tools as $category) {
    foreach ($category['tools'] as $tool) {
        if (!isset($tool_slugs[$tool['id']])) {
            continue;
        }
        $toolListSchemaItems[] = [
            '@type' => 'ListItem',
            'position' => $toolPosition++,
            'url' => $siteUrl . '/' . $tool_slugs[$tool['id']],
            'name' => $tool['name'],
        ];
    }
}

$websiteSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => 'Any2Convert',
    'url' => $siteUrl . '/',
    'description' => 'Free online PDF, image, calculator, converter, OCR, and utility tools with privacy-first local processing on your device.',
    'inLanguage' => 'en',
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => $siteUrl . '/?q={search_term_string}',
        'query-input' => 'required name=search_term_string',
    ],
];
$organizationSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Any2Convert',
    'url' => $siteUrl . '/',
    'logo' => $siteUrl . '/mylogo.png',
];
$collectionPageSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => 'Any2Convert Free Online Tools',
    'url' => $siteUrl . '/',
    'description' => 'Browse free online PDF, image, OCR, converter, calculator, business, writing, and utility tools on Any2Convert.',
];
$itemListSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'name' => 'Any2Convert Tool Directory',
    'itemListOrder' => 'https://schema.org/ItemListOrderAscending',
    'numberOfItems' => count($toolListSchemaItems),
    'itemListElement' => $toolListSchemaItems,
];

$toolNameMap = [];
$toolDescriptionMap = [];
$toolCategoryMap = [];
foreach ($tools as $category) {
    foreach ($category['tools'] as $tool) {
        $toolNameMap[$tool['id']] = $tool['name'];
        $toolDescriptionMap[$tool['id']] = $tool['desc'] ?? '';
        $toolCategoryMap[$tool['id']] = $category['title'];
    }
}

$defaultTitle = 'Any2Convert | Free All-in-One PDF & Document Converter Suite';
$defaultDescription = 'Free online PDF, document, image, and utility tools. Process files locally on your device with privacy-focused conversions.';
$defaultKeywords = 'free online tools, file converter, PDF tools, image tools, calculators, converters, generators, utilities';

$seoTitle = $defaultTitle;
$seoDescription = $defaultDescription;
$seoKeywords = $defaultKeywords;
$isToolPage = !empty($initialToolId) && isset($toolNameMap[$initialToolId]);
$currentToolName = $isToolPage ? $toolNameMap[$initialToolId] : '';
$currentToolDescription = $isToolPage ? trim($toolDescriptionMap[$initialToolId] ?? '') : '';
$currentToolCategory = $isToolPage ? ($toolCategoryMap[$initialToolId] ?? 'Online Tools') : '';
$toolPageContent = [];
$toolPageKeywords = [];
if ($isToolPage) {
    $seoTitle = $currentToolName . ' Online Free Tool | Any2Convert';
    $toolDesc = $currentToolDescription;
    $seoDescription = $toolDesc !== ''
        ? rtrim($toolDesc, ". \t\n\r\0\x0B") . '. Free, fast, and privacy-focused online tool.'
        : $currentToolName . ' is a free, fast, and privacy-focused online tool.';

    $toolSlug = strtolower(str_replace(' ', '-', $currentToolName));
    $searchPhrase = 'free online ' . strtolower($currentToolName) . ' tool';
    $useCasePhrase = 'complete this task quickly without extra software';
    $outputPhrase = 'download the finished file or copy the result';

    if (str_starts_with($initialToolId, 'pdf_to_')) {
        $target = str_replace('pdf_to_', '', $initialToolId);
        $searchPhrase = 'online PDF to ' . str_replace('_', ' ', $target) . ' converter';
        $useCasePhrase = 'convert PDF into ' . str_replace('_', ' ', $target) . ' online';
        $outputPhrase = 'receive a converted ' . str_replace('_', ' ', $target) . ' file from your PDF';
    } elseif (str_ends_with($initialToolId, '_to_pdf')) {
        $source = str_replace('_to_pdf', '', $initialToolId);
        $searchPhrase = 'online ' . str_replace('_', ' ', $source) . ' to PDF converter';
        $useCasePhrase = 'turn ' . str_replace('_', ' ', $source) . ' into PDF in seconds';
        $outputPhrase = 'get a clean PDF from your ' . str_replace('_', ' ', $source) . ' content';
    } elseif ($initialToolId === 'merge_pdf') {
        $searchPhrase = 'merge PDF files online';
        $useCasePhrase = 'combine multiple PDF files into one document';
        $outputPhrase = 'download a single merged PDF';
    } elseif ($initialToolId === 'compress_pdf') {
        $searchPhrase = 'compress PDF online';
        $useCasePhrase = 'reduce PDF file size for easier sharing';
        $outputPhrase = 'save a smaller PDF copy';
    } elseif ($initialToolId === 'protect_pdf') {
        $searchPhrase = 'password protect PDF online';
        $useCasePhrase = 'secure a PDF with a password';
        $outputPhrase = 'save an encrypted PDF document';
    } elseif ($initialToolId === 'qr_generator') {
        $searchPhrase = 'free QR code generator online';
        $useCasePhrase = 'create QR codes for links, menus, and contacts';
        $outputPhrase = 'download a ready-to-use QR code image';
    } elseif ($initialToolId === 'password_gen') {
        $searchPhrase = 'secure password generator online';
        $useCasePhrase = 'create strong random passwords for accounts';
        $outputPhrase = 'copy a secure password instantly';
    } elseif ($initialToolId === 'image_compressor') {
        $searchPhrase = 'online image compressor';
        $useCasePhrase = 'reduce photo file sizes without losing quality';
        $outputPhrase = 'download a smaller image file';
    } elseif ($initialToolId === 'resize_image') {
        $searchPhrase = 'resize image online';
        $useCasePhrase = 'change photo dimensions for email, social media, or printing';
        $outputPhrase = 'download a resized image with exact width and height';
    } elseif ($initialToolId === 'image_to_svg') {
        $searchPhrase = 'image to SVG converter online';
        $useCasePhrase = 'trace artwork and convert bitmap images into vector SVG';
        $outputPhrase = 'download a sharp SVG vector file';
    } elseif ($initialToolId === 'image_to_dxf') {
        $searchPhrase = 'image to DXF converter online';
        $useCasePhrase = 'convert artwork into CAD-ready DXF format';
        $outputPhrase = 'download a DXF file for CAD software';
    } elseif ($initialToolId === 'background-remover' || $initialToolId === 'bg_remover') {
        $searchPhrase = 'remove image background online';
        $useCasePhrase = 'create transparent PNGs from photos and logos';
        $outputPhrase = 'download a transparent image';
    } elseif ($initialToolId === 'ocr_tool' || $initialToolId === 'ocr_pdf') {
        $searchPhrase = 'OCR tool online';
        $useCasePhrase = 'extract text from scanned pages and images';
        $outputPhrase = 'copy or download the extracted text';
    } elseif ($initialToolId === 'csv_to_json') {
        $searchPhrase = 'CSV to JSON converter online';
        $useCasePhrase = 'convert spreadsheet data into JSON format';
        $outputPhrase = 'download a clean JSON file';
    } elseif ($initialToolId === 'json_to_csv') {
        $searchPhrase = 'JSON to CSV converter online';
        $useCasePhrase = 'turn structured JSON data into spreadsheet-ready CSV';
        $outputPhrase = 'download a CSV file for Excel or Google Sheets';
    } elseif ($initialToolId === 'word_counter') {
        $searchPhrase = 'online word counter tool';
        $useCasePhrase = 'count words, characters, and paragraphs quickly';
        $outputPhrase = 'copy the word count result';
    } elseif ($initialToolId === 'grammar_checker') {
        $searchPhrase = 'online grammar checker';
        $useCasePhrase = 'correct spelling, punctuation, and sentence structure';
        $outputPhrase = 'copy improved text with better grammar';
    } elseif ($initialToolId === 'paraphrase_tool') {
        $searchPhrase = 'online paraphrase tool';
        $useCasePhrase = 'rewrite text into clearer alternative phrasing';
        $outputPhrase = 'copy the rewritten text';
    } elseif ($initialToolId === 'jwt_decoder') {
        $searchPhrase = 'JWT decoder online';
        $useCasePhrase = 'inspect JSON Web Tokens safely in the browser';
        $outputPhrase = 'copy the token payload and header';
    } elseif ($initialToolId === 'invoice_generator') {
        $searchPhrase = 'invoice generator online';
        $useCasePhrase = 'build printable invoices with totals and tax';
        $outputPhrase = 'download or print the invoice';
    } elseif ($initialToolId === 'loan_calculator') {
        $searchPhrase = 'loan calculator online';
        $useCasePhrase = 'estimate monthly payments, interest, and total cost';
        $outputPhrase = 'see loan payment details instantly';
    }

    if (empty($toolPageKeywords)) {
        $toolPageKeywords = [
            $searchPhrase,
            'free online ' . strtolower($currentToolName),
            'best browser-based ' . strtolower($currentToolName),
            'use ' . strtolower($currentToolName) . ' without installing software',
        ];

        if ($initialToolId === 'pdf_to_word') {
            $toolPageKeywords = array_merge($toolPageKeywords, [
                'free online pdf to word converter',
                'convert pdf to editable word docx online',
                'best pdf to word converter online free',
                'pdf to word docx converter with formatting',
                'convert scanned pdf to editable word document',
                'online pdf to word tool without software download',
                'fast high quality pdf to word conversion',
                'pdf to word document converter for resumes and contracts',
            ]);
        } elseif ($initialToolId === 'word_counter') {
            $toolPageKeywords = array_merge($toolPageKeywords, [
                'word calculator', 'free word counter', 'character counter online', 'kachra text tool',
                'how many words is this', 'count my words online', 'text length calculator', 'word tally',
                'paragraph counter', 'sentence counter', 'letter counter tool', 'words length check',
                'essay word count checker', 'resume word counter', 'tweet character counter', 'twitter word count',
                'instagram caption length checker', 'seo word counter tool', 'blog post word counter',
                'count characters with spaces', 'count characters without spaces', 'word number calculator',
                'reading time calculator text', 'text statistics analyzer', 'alphabets counter', 'how to count text',
                'how long is my essay tool', 'book word counter', 'word limit checker online', 'count letters in a word',
                'text size calculator', 'text character tally', 'copy paste word count', 'paste and count text',
                'safe privacy word counter', 'fastest offline word counter online', 'word counter free no ads',
                'random word counter tool for assignments', 'word length checker for students', 'count space as character',
                'exact word calculator online', 'free tool to count words and characters instantly',
                'how to count words without MS word', 'count characters for sms message', 'sms limit checker',
                'linkedin post character counter', 'facebook post word counter', 'whatsapp status character count',
                'title tag pixel counter', 'meta description length checker', 'keyword density counter',
                'find word count of text', 'count words in a string', 'total words calculator', 'how many characters',
                'count spaces in text', 'word frequency counter online', 'syllable counter tool', 'vowel counter',
                'vowels and consonants counter', 'words per page calculator', 'word calc', 'text characters count',
                'how to check how many words i have typed', 'word count tool for writers', 'author word tracker',
                'novel word count tracker', 'wattpad story word counter', 'academic paper word counter',
                'dissertation word count tool', 'thesis character counter', 'personal statement word limit checker',
                'college essay word counter', 'common app essay word counter', 'uc application word limit checker',
                'count words in copy pasted text', 'online notepad with word count', 'text box word counter',
                'kachra text length checker', 'random text words counter', 'any text word calculator',
                'count words in arabic', 'count words in hindi', 'count words in urdu', 'count words in spanish',
                'multilingual word counter', 'unicode character counter', 'emoji counter in text',
                'special characters counter', 'punctuation marks counter', 'line counter online',
                'count empty lines in text', 'find and replace word counter', 'most repeated words finder',
                'text metrics tool online free', 'word count for translation', 'transcription word counter',
                'subtitles word counter', 'script character counter', 'screenplay word count tool',
                'poetry line counter', 'haiku syllable counter', 'song lyrics word counter',
                'rap lyrics word counter', 'speech word count to time', 'presentation speaking time calculator',
                'voiceover script word counter', 'teleprompter text length calculator', 'youtube description word limit',
                'tiktok caption character limit checker', 'pinterest pin description word count',
                'google ads headline character counter', 'facebook ads text limit checker',
                'amazon product description character count', 'ebay listing word counter',
                'shopify product description word count', 'etsy listing character limit checker',
                'app store description character counter', 'google play store description word count',
                'github readme word counter', 'stackoverflow question character limit',
                'reddit post title character limit', 'discord message character counter',
                'slack message word count', 'whatsapp message character limit', 'telegram message word counter',
                'sms 160 character counter', 'mms text length checker', 'email subject line character counter',
                'newsletter word count tool', 'press release word counter', 'article word count checker',
                'journalism word counter', 'copywriting text length calculator', 'seo copywriting word counter',
                'content writing word count tool', 'freelance writer word counter', 'word count for upwork proposal',
                'fiverr gig description character limit', 'freelancer profile word counter',
                'linkedin summary character limit checker', 'twitter bio character counter',
                'instagram bio word counter', 'tiktok bio character limit', 'facebook bio word count',
                'youtube channel description character limit', 'twitch panel text counter',
                'patreon tier description word count', 'onlyfans bio character limit',
                'gofundme campaign story word counter', 'kickstarter project description word count',
                'indiegogo pitch character limit', 'change.org petition text counter',
                'wikipedia article word count', 'medium post word counter', 'substack newsletter character count',
                'wordpress blog post word count', 'blogger post text length', 'tumblr post word counter',
                'quora answer word count', 'yahoo answers text length', 'forum post character limit',
                'guest post word count requirements', 'submit article word limit',
                'abstract word counter', 'executive summary word count', 'business plan text length calculator',
                'marketing strategy word counter', 'case study word count tool', 'white paper word counter',
                'ebook word count tracker', 'kindle book text length', 'kdp description character limit',
                'smashwords description word count', 'wattpad description character counter',
                'ao3 fic word count', 'fanfiction.net word counter', 'novel writing nano wri mo word count tracker',
                'nanowrimo daily word count calculator', 'sprint word counter', 'writing sprint text length',
                'prompts word counter', 'daily writing habit word tracker', 'words typed today calculator',
                'how many words did i type', 'check my word count right now', 'fast word counter for slow internet',
                'word counter without javascript', 'simple text counter tool', 'basic word calculator',
                'advanced text statistics tool', 'comprehensive word count analyzer', 'detailed character counter',
                'word frequency analyzer free', 'keyword density tool free', 'seo text analyzer online',
                'readability score calculator', 'text complexity analyzer', 'vocabulary richness calculator',
                'lexical density tool', 'unique words counter', 'different words calculator', 'repeated words counter',
                'longest word finder', 'shortest word finder', 'average word length calculator',
                'average sentence length calculator', 'average paragraph length calculator',
                'number of syllables per word calculator', 'polysyllabic words counter',
                'monosyllabic words counter', 'action verbs counter', 'adjectives counter',
                'adverbs counter', 'nouns counter', 'pronouns counter', 'conjunctions counter',
                'prepositions counter', 'interjections counter', 'articles counter', 'determiners counter',
                'passive voice checker text counter', 'active voice text analyzer',
                'transition words counter', 'cliche finder and counter', 'redundant words counter',
                'filler words counter', 'buzzwords counter', 'jargon counter', 'slang counter',
                'profanity counter tool', 'swear words counter', 'curse words counter',
                'positive words counter', 'negative words counter', 'sentiment analyzer text counter',
                'emotional tone analyzer tool', 'formality checker text counter', 'informal text analyzer',
                'academic writing checker word count', 'business writing analyzer text length',
                'creative writing word counter', 'technical writing text analyzer', 'legal document word counter',
                'medical transcription word count', 'medical report character counter',
                'police report word counter', 'incident report text length calculator',
                'insurance claim word counter', 'tax form text limit checker', 'government form character limit',
                'visa application word counter', 'passport application character limit',
                'immigration form text length', 'college application essay word limit',
                'scholarship essay word counter', 'grant proposal word count tool',
                'research paper word counter', 'science fair project word count',
                'book report text length calculator', 'lab report word counter',
                'internship application character limit', 'job application cover letter word count',
                'motivation letter word counter', 'letter of recommendation word limit',
                'reference letter character counter', 'thank you note word count',
                'sympathy card text length', 'birthday wishes character limit',
                'wedding vows word counter', 'eulogy word count to minutes',
                'toast speech text length calculator', 'stand up comedy set word count',
                'podcast script character counter', 'radio ad word count to seconds',
                'tv commercial script length calculator', 'explainer video word counter',
                'whiteboard animation script text length', 'elearning course script word count',
                'training manual word counter', 'employee handbook text length calculator',
                'company policy document word count', 'terms of service word counter',
                'privacy policy text length calculator', 'cookie policy character counter',
                'disclaimer word count tool', 'copyright notice text limit',
                'software license agreement word counter', 'eula text length calculator',
                'nda non disclosure agreement word count', 'contract text length checker',
                'lease agreement word counter', 'rental application character limit',
                'mortgage application text length', 'loan application word counter',
                'credit card application character limit', 'bank account application text length',
                'insurance quote request word counter', 'customer service email character limit',
                'support ticket word count tool', 'live chat message text length',
                'chatbot script word counter', 'ivr prompt text length calculator',
                'voice assistant command character limit', 'alexa skill script word count'
            ]);
        }
    }

    $toolPageContent = [
        'headline' => 'Detailed guidance for ' . $currentToolName,
        'paragraphs' => [
            $currentToolName . ' on Any2Convert is a free online tool that helps you ' . lcfirst($currentToolDescription) . '. It is built for browser-first workflows so you can complete the task without installing extra software or opening multiple apps.',
            'Use this page when you need to ' . $useCasePhrase . '. The tool interface is focused on the job, with just the right options to turn your selected file, image, or data into the output you need.',
            'This page is useful for people searching for ' . $searchPhrase . ' and other related queries. It is designed to answer the key questions around using this tool, while still delivering the fast online tools any2convert.com is known for.',
        ],
    ];
    $seoKeywords = implode(', ', $toolPageKeywords);
}

$canonicalBase = 'https://any2convert.com';
$currentPath = request()->getPathInfo();
if ($currentPath === '/') {
    $canonicalUrl = $canonicalBase;
} else {
    $canonicalUrl = $canonicalBase . rtrim($currentPath, '/');
}

$webAppSchema = null;
if ($isToolPage) {
    $webAppSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebApplication',
        'name' => $currentToolName,
        'url' => $canonicalUrl,
        'description' => $seoDescription,
        'applicationCategory' => 'UtilityApplication',
        'operatingSystem' => 'All',
        'browserRequirements' => 'Requires JavaScript. Requires HTML5.',
        'offers' => [
            '@type' => 'Offer',
            'price' => '0',
            'priceCurrency' => 'USD'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (request()->has('topic') || request()->has('noindex')): ?>
    <meta name="robots" content="noindex, follow">
    <?php else: ?>
    <meta name="robots" content="index, follow">
    <?php endif; ?>
    <link rel="canonical" href="<?= $canonicalUrl ?>">
    <link rel="alternate" href="<?= $canonicalUrl ?>" hreflang="en">
    <link rel="alternate" href="<?= $canonicalUrl ?>" hreflang="x-default">
    <title><?= htmlspecialchars($seoTitle, ENT_QUOTES) ?></title>
    <link rel="icon" type="image/png" href="mylogo.png">
    <meta name="description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($seoKeywords ?? '', ENT_QUOTES) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($seoTitle, ENT_QUOTES) ?>">
    <meta name="twitter:title" content="<?= htmlspecialchars($seoTitle, ENT_QUOTES) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES) ?>">
    <meta property="og:url" content="<?= $canonicalUrl ?>">
    <meta property="og:type" content="<?= $isToolPage ? 'website' : 'website' ?>">
    <meta name="theme-color" content="#3B82F6">

    <!-- Schema.org JSON-LD Structured Data -->
    <script type="application/ld+json">
    <?= json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
    </script>
    <script type="application/ld+json">
    <?= json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
    </script>
    <script type="application/ld+json">
    <?= json_encode($collectionPageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
    </script>
    <script type="application/ld+json">
    <?= json_encode($itemListSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
    </script>
    <?php if ($webAppSchema): ?>
    <script type="application/ld+json">
    <?= json_encode($webAppSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
    </script>
    <?php endif; ?>

    <script>
    tailwind.config = {
        darkMode: 'class'
    };
</script>
<script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Google tag -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GNWNK7QZTD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-GNWNK7QZTD');
    </script>
    <style>
        /* ── LIGHT MODE (default) ── */
        :root {
            --bg-base:        #F8F8FC;
            --bg-surface:     #FFFFFF;
            --bg-card:        #FFFFFF;
            --bg-card-hover:  #F3F3FA;
            --border:         rgba(0,0,0,0.08);
            --border-hover:   rgba(108,99,255,0.35);
            --text-primary:   #111118;
            --text-secondary: #464666;
            --text-muted:     #707096;
            --accent:         #6C63FF;
            --accent-light:   rgba(108,99,255,0.08);
            --accent-glow:    rgba(108,99,255,0.3);
            --red:            #EF4444;
            --blue:           #3B82F6;
            --violet:         #8B5CF6;
            --green:          #10B981;
            --amber:          #F59E0B;
        }

        /* ── DARK MODE ── */
        html.dark {
            --bg-base:        #0A0A0F;
            --bg-surface:     #111118;
            --bg-card:        #16161F;
            --bg-card-hover:  #1C1C28;
            --border:         rgba(255,255,255,0.07);
            --border-hover:   rgba(255,255,255,0.15);
            --text-primary:   #F0F0F8;
            --text-secondary: #8B8BA7;
            --text-muted:     #4A4A62;
            --accent-light:   rgba(108,99,255,0.15);
            --accent-glow:    rgba(108,99,255,0.4);
        }

        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            background-color: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Noise texture overlay ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.35;
        }

        /* ── Hero ambient glow ── */
        .hero-glow {
            position: absolute;
            width: 800px; height: 500px;
            background: radial-gradient(ellipse, rgba(108,99,255,0.18) 0%, transparent 70%);
            top: -120px; left: 50%; transform: translateX(-50%);
            pointer-events: none;
            filter: blur(40px);
        }

        /* ── Navbar ── */
        .navbar {
            background: rgba(248,248,252,0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        html.dark .navbar {
            background: rgba(10,10,15,0.85);
        }

        /* ── Logo ── */
        .logo-text {
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: -0.02em;
            color: var(--text-primary);
        }
        .logo-dot { color: var(--accent); }

        /* ── Nav pill ── */
        .nav-pill {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-secondary);
            border: 1px solid transparent;
            transition: all 0.2s ease;
            cursor: pointer; text-decoration: none;
        }
        .nav-pill:hover { color: var(--text-primary); background: rgba(255,255,255,0.05); border-color: var(--border); }

        /* ── Primary button ── */
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 9px 20px;
            background: var(--accent);
            color: #fff;
            border-radius: 9px;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: -0.01em;
            border: none; cursor: pointer;
            transition: all 0.2s ease;
            position: relative; overflow: hidden;
            box-shadow: 0 0 0 0 var(--accent-glow);
        }
        .btn-primary::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.12) 0%, transparent 100%);
            pointer-events: none;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px var(--accent-glow);
            background: #7B73FF;
        }
        .btn-primary:active { transform: translateY(0); }

        /* ── Ghost button ── */
        .btn-ghost {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 9px 20px;
            background: transparent;
            color: var(--text-secondary);
            border-radius: 9px;
            font-size: 0.875rem;
            font-weight: 500;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-ghost:hover { color: var(--text-primary); border-color: var(--border-hover); background: rgba(255,255,255,0.04); }

        /* ── Hero ── */
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 6px 14px;
            border: 1px solid var(--border);
            border-radius: 100px;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-secondary);
            background: var(--bg-card);
            margin-bottom: 28px;
        }
        .hero-badge span { width: 6px; height: 6px; background: var(--green); border-radius: 50%; display: inline-block; box-shadow: 0 0 8px var(--green); }

        .hero-title {
            font-size: clamp(2.4rem, 5vw, 4rem);
            font-weight: 700;
            letter-spacing: -0.04em;
            line-height: 1.08;
            color: var(--text-primary);
        }
        .hero-title em {
            font-style: normal;
            background: linear-gradient(135deg, #6C63FF 0%, #A78BFA 50%, #818CF8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-sub {
            font-size: 1.05rem;
            color: var(--text-secondary);
            line-height: 1.65;
            font-weight: 400;
            max-width: 520px;
            margin: 0 auto;
        }

        /* ── Stats row ── */
        .stat-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 18px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--bg-card);
            font-size: 0.82rem;
            color: var(--text-secondary);
            white-space: nowrap;
            text-decoration: none;
            transition: transform 0.28s cubic-bezier(.22,1,.36,1), border-color 0.24s ease, background 0.24s ease, box-shadow 0.24s ease, color 0.24s ease;
        }
        .stat-item svg { flex-shrink: 0; }
        .stat-item:hover {
            transform: translateY(-3px);
            border-color: rgba(108,99,255,0.28);
            background: color-mix(in srgb, var(--bg-card) 85%, rgba(108,99,255,0.08));
            color: var(--text-primary);
            box-shadow: 0 18px 32px rgba(15,23,42,0.10);
        }
        .detail-card {
            display: block;
            text-decoration: none;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
            transition: transform 0.3s cubic-bezier(.22,1,.36,1), border-color 0.24s ease, box-shadow 0.28s ease, background 0.24s ease;
            position: relative;
            overflow: hidden;
        }
        .detail-card::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -36px;
            width: 180px;
            height: 120px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(108,99,255,0.14), transparent 68%);
            opacity: 0;
            transform: translateX(-50%) scale(.84);
            transition: opacity 0.28s ease, transform 0.32s cubic-bezier(.22,1,.36,1);
        }
        .detail-card:hover {
            transform: translateY(-5px);
            border-color: rgba(108,99,255,0.28);
            box-shadow: 0 22px 44px rgba(15,23,42,0.12);
        }
        .detail-card:hover::after {
            opacity: 1;
            transform: translateX(-50%) scale(1.03);
        }
        .detail-card > * { position: relative; z-index: 1; }
        .detail-card-arrow {
            position: absolute;
            top: 18px;
            right: 18px;
            color: var(--text-muted);
            opacity: 0;
            transform: translate(-4px, 4px);
            transition: opacity 0.24s ease, transform 0.28s cubic-bezier(.22,1,.36,1), color 0.24s ease;
        }
        .detail-card:hover .detail-card-arrow {
            opacity: 1;
            transform: translate(0, 0);
            color: var(--accent);
        }

        /* ── Section label ── */
        .section-label {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 10px;
        }
        .section-label::before, .section-label::after {
            content: '';
            display: block;
            height: 1px;
            width: 24px;
            background: var(--border);
        }
        .section-heading {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.03em;
            color: var(--text-primary);
        }

        /* ── Tool Card ── */
        .tool-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
            position: relative;
            overflow: hidden;
        }
        .tool-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .tool-card:hover {
            background: var(--bg-card-hover);
            border-color: var(--border-hover);
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.4), 0 0 0 1px rgba(108,99,255,0.1);
        }
        .tool-card:hover::before { opacity: 1; }
        .tool-card:active { transform: translateY(-1px); }
        .hidden-by-filter { display: none !important; }
        .tool-search-wrap {
            margin-bottom: 22px;
            padding: 14px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--bg-card);
        }
        .tool-search-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }
        .tool-search-input {
            width: 100%;
            min-width: 220px;
            flex: 1 1 280px;
            border: 1px solid var(--border);
            background: var(--bg-surface);
            color: var(--text-primary);
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 0.95rem;
        }
        .tool-search-input:focus {
            outline: none;
            border-color: var(--border-hover);
            box-shadow: 0 0 0 3px var(--accent-light);
        }
        .tool-search-clear {
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text-secondary);
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }
        .tool-search-clear:hover,
        .tool-search-clear:focus-visible {
            background: var(--bg-surface);
            border-color: var(--border-hover);
            color: var(--text-primary);
            outline: none;
        }
        .tool-search-clear[hidden] {
            display: none !important;
        }
        .tool-search-meta {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
            font-size: 0.8rem;
            color: var(--text-secondary);
        }
        .tool-search-status strong {
            color: var(--text-primary);
        }
        .tool-filter-chip {
            border: 1px solid var(--border);
            background: var(--bg-surface);
            color: var(--text-secondary);
            border-radius: 999px;
            padding: 7px 12px;
            font-size: 0.78rem;
            font-weight: 600;
            cursor: pointer;
        }
        .tool-filter-chip.active {
            color: #fff;
            border-color: transparent;
            background: var(--accent);
        }
        .tool-filter-chip:focus-visible {
            outline: none;
            border-color: var(--border-hover);
            box-shadow: 0 0 0 3px var(--accent-light);
        }

        /* tool icon container */
        .tool-icon-wrap {
            width: 44px; height: 44px;
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
            position: relative;
            flex-shrink: 0;
        }

        .tool-name {
            font-size: 0.925rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 5px;
            letter-spacing: -0.01em;
        }
        .tool-desc {
            font-size: 0.78rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .tool-arrow {
            position: absolute;
            top: 18px; right: 18px;
            opacity: 0;
            transform: translate(-4px, 4px);
            transition: all 0.2s ease;
            color: var(--text-muted);
        }
        .tool-card:hover .tool-arrow { opacity: 1; transform: translate(0, 0); }

        /* ── Category pill ── */
        .cat-pill {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 6px;
            margin-bottom: 18px;
        }

        /* ── Upload zone ── */
        .upload-zone {
            border: 2px dashed var(--border);
            border-radius: 14px;
            padding: 48px 32px;
            text-align: center;
            transition: all 0.25s ease;
            background: rgba(255,255,255,0.015);
            cursor: pointer;
            position: relative;
        }
        .upload-zone:hover, .upload-zone.dragging {
            border-color: var(--accent);
            background: var(--accent-light);
        }
        .upload-zone-icon {
            width: 56px; height: 56px;
            margin: 0 auto 16px;
            background: rgba(108,99,255,0.12);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
        }

        /* ── Progress bar ── */
        .progress-track {
            height: 4px;
            background: rgba(255,255,255,0.06);
            border-radius: 100px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 100px;
            background: linear-gradient(90deg, var(--accent), #A78BFA);
            transition: width 0.4s ease;
            position: relative;
        }
        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 24px; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5));
            border-radius: 100px;
            animation: shimmer 1.5s infinite;
        }
        @keyframes shimmer { 0%,100%{opacity:0} 50%{opacity:1} }

        /* ── Alert ── */
        .alert {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 14px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            border: 1px solid;
        }
        .alert-success { background: rgba(16,185,129,0.08); border-color: rgba(16,185,129,0.25); color: #34D399; }
        .alert-error   { background: rgba(239,68,68,0.08);  border-color: rgba(239,68,68,0.25);  color: #F87171; }

        /* ── Modal ── */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(8px);
            z-index: 100;
            display: none; align-items: center; justify-content: center;
            padding: 16px;
        }
        .modal-overlay.flex { display: flex; }
        .modal-box {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            max-width: 760px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 32px 80px rgba(0,0,0,0.6);
            animation: modalIn 0.25s cubic-bezier(0.34,1.56,0.64,1);
        }
        .modal-box.modal-box-editor {
            max-width: min(1480px, calc(100vw - 28px));
            height: min(920px, calc(100vh - 28px));
            max-height: calc(100vh - 28px);
            display: grid;
            grid-template-rows: auto minmax(0, 1fr);
            overflow: hidden;
        }
        .modal-box.modal-box-editor .modal-header {
            position: relative;
        }
        .modal-box.modal-box-editor #modalContent {
            min-height: 0;
            overflow: hidden;
        }
        @keyframes modalIn {
            from { opacity:0; transform:scale(0.94) translateY(16px); }
            to   { opacity:1; transform:scale(1) translateY(0); }
        }
        .modal-header {
            position: sticky; top: 0;
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
            padding: 18px 22px;
            display: flex; align-items: center; justify-content: space-between;
            border-radius: 20px 20px 0 0;
        }
        .modal-close {
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
            font-size: 16px; line-height: 1;
        }
        .modal-close:hover { background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.3); color: #F87171; }

        /* ── Spinner ── */
        .spin { animation: spin 1s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Footer ── */
        .footer-link {
            color: var(--text-muted);
            font-size: 0.82rem;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-link:hover { color: var(--text-secondary); }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 100px; }

        /* ── Stagger animation for cards ── */
        .stagger-in { opacity: 0; transform: translateY(16px); }
        .stagger-in.visible {
            animation: fadeUp 0.4s ease forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── Tag / chip ── */
        .chip {
            display: inline-flex; align-items: center;
            padding: 5px 12px;
            border-radius: 100px;
            font-size: 0.78rem;
            font-weight: 500;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .chip:hover { background: var(--accent-light); border-color: rgba(108,99,255,0.35); color: #A78BFA; }

        /* ── Blog card ── */
        .blog-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 24px;
            transition: all 0.25s ease;
            text-decoration: none;
            display: block;
            position: relative;
            overflow: hidden;
        }
        .blog-card::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--accent-light), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .blog-card:hover { border-color: rgba(108,99,255,0.3); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.3); }
        .blog-card:hover::after { opacity: 1; }
        .blog-card > * { position: relative; z-index: 1; }

        /* ── Responsive utilities ── */
        @media (max-width: 640px) {
            .hero-title { font-size: 2rem; }
            .hero-sub { font-size: 0.95rem; }
        }
        @media (max-width: 900px) {
            body::before { display: none; }
            .hero-glow { width: 480px; height: 280px; filter: blur(26px); opacity: 0.75; }
            .tool-card { padding: 16px; }
            .tool-name { font-size: 0.88rem; }
            .tool-desc { font-size: 0.76rem; }
        }

        /* ── Dropdown menu ── */
        .dropdown-menu {
            position: absolute; right: 0; top: calc(100% + 8px);
            min-width: 180px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 6px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.5);
            opacity: 0; visibility: hidden;
            transform: translateY(-6px);
            transition: all 0.2s ease;
            z-index: 200;
        }
        .dropdown-trigger:hover .dropdown-menu,
        .dropdown-trigger:focus-within .dropdown-menu {
            opacity: 1; visibility: visible; transform: translateY(0);
        }
        .dropdown-item {
            display: block;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.84rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.15s;
        }
        .dropdown-item:hover { background: rgba(255,255,255,0.05); color: var(--text-primary); }
        .dropdown-item.danger:hover { background: rgba(239,68,68,0.08); color: #F87171; }

        /* ── Theme toggle button ── */
        #themeToggle:hover {
            background: var(--accent-light) !important;
            border-color: rgba(108,99,255,0.3) !important;
            color: var(--accent) !important;
        }

        /* ── Separator ── */
        hr.sep { border: none; border-top: 1px solid var(--border); margin: 0 12px; }

        body {
            animation: homeFadeIn 0.65s cubic-bezier(.22,1,.36,1);
        }
        @keyframes homeFadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .tool-card {
            transition: transform 0.34s cubic-bezier(.22,1,.36,1), border-color 0.28s ease, box-shadow 0.32s ease, background 0.28s ease;
            will-change: transform;
        }
        .tool-card::before {
            transition: opacity 0.34s ease;
        }
        .tool-card::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -44px;
            width: 220px;
            height: 140px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(108,99,255,0.18), transparent 68%);
            opacity: 0;
            transform: translateX(-50%) scale(.82);
            transition: opacity 0.34s ease, transform 0.38s cubic-bezier(.22,1,.36,1);
        }
        .tool-card:hover {
            transform: translateY(-6px) scale(1.01);
            box-shadow: 0 20px 44px rgba(0,0,0,0.34), 0 0 0 1px rgba(108,99,255,0.12);
        }
        .tool-card:hover::after {
            opacity: 1;
            transform: translateX(-50%) scale(1.05);
        }
        .tool-card:active {
            transform: translateY(-2px) scale(1.005);
        }
        .tool-search-wrap {
            transition: transform 0.28s cubic-bezier(.22,1,.36,1), border-color 0.24s ease, box-shadow 0.28s ease;
        }
        .tool-search-wrap:focus-within {
            transform: translateY(-2px);
            border-color: var(--border-hover);
            box-shadow: 0 16px 34px rgba(15,23,42,0.12);
        }
        .tool-search-input {
            transition: transform 0.24s cubic-bezier(.22,1,.36,1), border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .tool-search-input:focus {
            transform: translateY(-1px);
        }
        .tool-filter-chip {
            transition: transform 0.24s cubic-bezier(.22,1,.36,1), border-color 0.24s ease, background 0.24s ease, color 0.24s ease, box-shadow 0.24s ease;
        }
        .tool-filter-chip:hover {
            transform: translateY(-2px);
            border-color: rgba(108,99,255,0.25);
            box-shadow: 0 12px 22px rgba(15,23,42,0.1);
        }
        .tool-filter-chip.active {
            box-shadow: 0 14px 28px rgba(108,99,255,0.22);
        }
        .tool-arrow {
            transition: opacity 0.24s ease, transform 0.28s cubic-bezier(.22,1,.36,1);
        }
        .upload-zone {
            transition: transform 0.28s cubic-bezier(.22,1,.36,1), border-color 0.25s ease, background 0.25s ease, box-shadow 0.28s ease;
        }
        .upload-zone:hover, .upload-zone.dragging {
            transform: translateY(-3px);
            box-shadow: 0 20px 34px rgba(15,23,42,0.12);
        }
        .stagger-in {
            opacity: 0;
            transform: translateY(18px) scale(.985);
        }
        .stagger-in.visible {
            animation: fadeUp 0.58s cubic-bezier(.22,1,.36,1) forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .chip {
            transition: transform 0.24s cubic-bezier(.22,1,.36,1), border-color 0.24s ease, background 0.24s ease, color 0.24s ease, box-shadow 0.24s ease;
        }
        .chip:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(15,23,42,0.08);
        }
        .blog-card {
            transition: transform 0.34s cubic-bezier(.22,1,.36,1), border-color 0.28s ease, box-shadow 0.32s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px) scale(1.008);
            box-shadow: 0 18px 38px rgba(0,0,0,0.24);
        }
    </style>
    <?php if (isset($websiteSchema)): ?>
    <script type="application/ld+json">
        <?= json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
    </script>
    <?php endif; ?>
    <?php if (isset($organizationSchema)): ?>
    <script type="application/ld+json">
        <?= json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
    </script>
    <?php endif; ?>
    <?php if (!$isToolPage && isset($collectionPageSchema)): ?>
    <script type="application/ld+json">
        <?= json_encode($collectionPageSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
    </script>
    <?php endif; ?>
    <?php if (!$isToolPage && isset($itemListSchema)): ?>
    <script type="application/ld+json">
        <?= json_encode($itemListSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
    </script>
    <?php endif; ?>
    <!-- Microsoft Clarity -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "xymcprs44h");
    </script>
</head>
<body>

<!-- ═══════════════════════════════ NAVBAR ═══════════════════════════════ -->
<nav class="navbar sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-15 py-3">

            <!-- Logo -->
            <a href="{{ route('home') }}" style="text-decoration:none" class="flex items-center gap-2" aria-label="Any2Convert home">
                <div style="width:30px;height:30px;background:white;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                       <img src="{{ asset('any2trans.webp') }}" alt="Any2Convert logo" width="30" height="30">
                </div>
                <span style="font-weight:700;color:var(--text-primary);font-size:0.95rem;">Any2Convert</span>
            </a>

            <!-- Right side -->
            <div class="flex items-center gap-2">
                <a href="/blog" class="nav-pill">Blog</a>

                <!-- Dark / Light mode toggle -->
                <button id="themeToggle" onclick="toggleDarkMode()" title="Toggle dark mode" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:transparent;border:1px solid var(--border);color:var(--text-secondary);cursor:pointer;transition:all 0.2s ease;flex-shrink:0;">
                    <!-- Moon (visible in light mode) -->
                    <svg id="iconMoon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                    <!-- Sun (visible in dark mode) -->
                    <svg id="iconSun" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                        <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                    </svg>
                </button>

                <?php if (isset($_SESSION['user_name'])): ?>
                    <div class="relative dropdown-trigger" style="position:relative">
                        <button class="nav-pill">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <?php echo htmlspecialchars(explode(' ', $_SESSION['user_name'])[0]); ?>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="dropdown-menu">
                            <a href="<?= htmlspecialchars($dashboardHref) ?>" class="dropdown-item">
                                <span style="display:flex;align-items:center;gap:8px;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                                    Dashboard
                                </span>
                            </a>
                            <hr class="sep" style="margin:4px 0">
                            <a href="/logout" class="dropdown-item danger">
                                <span style="display:flex;align-items:center;gap:8px;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                    Logout
                                </span>
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/login" class="nav-pill">Sign in</a>
                    <a href="/register" class="btn-primary" style="text-decoration:none;font-size:0.84rem;padding:8px 18px;">
                        Get started free
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</nav>


<!-- ═══════════════════════════════ HERO ═══════════════════════════════ -->
<header style="position:relative;overflow:hidden;padding:80px 16px 72px;text-align:center;">
    <div class="hero-glow"></div>
    <div style="position:relative;z-index:1;max-width:720px;margin:0 auto;">

        <div class="hero-badge">
            <span></span>
            Local-first processing keeps many file tasks on your device
        </div>

        <h1 class="hero-title">
            <?php if ($isToolPage): ?>
            <?= htmlspecialchars($currentToolName, ENT_QUOTES) ?><br>
            <em>Free online tool.</em>
            <?php else: ?>
            Free Online PDF, Image &<br>
            <em>Utility Tools.</em>
            <?php endif; ?>
        </h1>

        <p class="hero-sub" style="margin:20px auto 36px;">
            <?php if ($isToolPage): ?>
            <?= htmlspecialchars($currentToolDescription !== '' ? $currentToolDescription : 'Use this focused browser-based tool on Any2Convert.', ENT_QUOTES) ?>
            <?php else: ?>
            80+ professional-grade tools for PDF, documents, images, and more. Free forever, no account required.
            <?php endif; ?>
        </p>

        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:10px;">
            <?php foreach ($trustHighlights as $highlight): ?>
            <a href="/highlights/<?= rawurlencode($highlight['slug']) ?>" class="stat-item">
                <?= $highlight['icon'] ?>
                <?= htmlspecialchars($highlight['label']) ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</header>


<!-- ═══════════════════════════════ MAIN ═══════════════════════════════ -->
<main id="tools" style="max-width:1280px;margin:0 auto;padding:0 20px 100px;">
    <div class="tool-search-wrap">
        <div class="tool-search-row">
            <label for="toolSearchInput" class="sr-only">Search tools</label>
            <input id="toolSearchInput" class="tool-search-input" type="search" placeholder="Search tools like compress, OCR, image, calculator..." autocomplete="off" enterkeyhint="search">
            <button id="toolSearchClear" class="tool-search-clear" type="button" hidden>Clear</button>
        </div>
        <div class="tool-search-meta">
            <div id="toolSearchStatus" class="tool-search-status" aria-live="polite">Showing <strong>all tools</strong>.</div>
            <div>Tip: filter by category or type a few letters to narrow the list.</div>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:10px;">
            <button class="tool-filter-chip active" data-tool-filter="all" type="button" aria-pressed="true">All</button>
            <button class="tool-filter-chip" data-tool-filter="pdf" type="button" aria-pressed="false">PDF</button>
            <button class="tool-filter-chip" data-tool-filter="convert" type="button" aria-pressed="false">Converters</button>
            <button class="tool-filter-chip" data-tool-filter="utility" type="button" aria-pressed="false">Utility</button>
            <button class="tool-filter-chip" data-tool-filter="conversion" type="button" aria-pressed="false">Conversion</button>
            <button class="tool-filter-chip" data-tool-filter="calculator" type="button" aria-pressed="false">Calculators</button>
            <button class="tool-filter-chip" data-tool-filter="business" type="button" aria-pressed="false">Business</button>
            <button class="tool-filter-chip" data-tool-filter="writing" type="button" aria-pressed="false">Writing</button>
            <button class="tool-filter-chip" data-tool-filter="developer" type="button" aria-pressed="false">Developer</button>
            <button class="tool-filter-chip" data-tool-filter="gaming" type="button" aria-pressed="false">Gaming</button>
            <button class="tool-filter-chip" data-tool-filter="fun" type="button" aria-pressed="false">Fun</button>
        </div>
    </div>
    <div id="toolNoResults" class="hidden-by-filter" style="margin:12px 0 24px;padding:18px;border:1px dashed var(--border);border-radius:12px;color:var(--text-secondary);text-align:center;">
        No tools matched that search. Try a broader keyword or switch back to All.
    </div>

    <!-- Tool page heading -->
    <?php if ($isToolPage): ?>
    <section style="margin-bottom:32px;text-align:center;">
        <h2 class="section-heading" style="margin-bottom:8px;">Free online <?= htmlspecialchars($currentToolName, ENT_QUOTES) ?> guide</h2>
        <p style="font-size:0.95rem;color:var(--text-secondary);max-width:620px;margin:0 auto;line-height:1.6;">
            <?= htmlspecialchars($currentToolDescription, ENT_QUOTES) ?>
        </p>
    </section>
    <section style="margin:0 auto 56px;max-width:920px;display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;">
        <article class="detail-card" style="padding:24px;">
            <h3 style="margin:0 0 10px;font-size:1.05rem;color:var(--text-primary);">About this <?= htmlspecialchars($currentToolCategory, ENT_QUOTES) ?> tool</h3>
            <p style="margin:0;color:var(--text-secondary);line-height:1.75;font-size:0.92rem;">
                <?= htmlspecialchars($currentToolName, ENT_QUOTES) ?> is built for quick browser-based work on Any2Convert. <?= htmlspecialchars($currentToolDescription, ENT_QUOTES) ?> Use it when you need a focused utility without installing desktop software, creating a complex workflow, or switching between multiple apps for a simple file or data task.
            </p>
        </article>
        <article class="detail-card" style="padding:24px;">
            <h3 style="margin:0 0 10px;font-size:1.05rem;color:var(--text-primary);">How it works</h3>
            <p style="margin:0;color:var(--text-secondary);line-height:1.75;font-size:0.92rem;">
                Open the tool, add the file or text requested by the form, choose the available options, and generate your result. The interface is designed for everyday conversions, edits, checks, and calculations, so you can complete the task from the same page and download or copy the finished output when the tool provides it.
            </p>
        </article>
        <article class="detail-card" style="padding:24px;">
            <h3 style="margin:0 0 10px;font-size:1.05rem;color:var(--text-primary);">Privacy and file handling</h3>
            <p style="margin:0;color:var(--text-secondary);line-height:1.75;font-size:0.92rem;">
                Any2Convert keeps many tasks local in your browser whenever the feature supports it. That means common PDF, image, text, calculator, and converter actions can often run on your own device, reducing unnecessary uploads and helping you work faster with private documents, drafts, screenshots, and utility data.
            </p>
        </article>
    </section>

    <section style="margin-bottom:56px;max-width:920px;margin-left:auto;margin-right:auto;">
        <div style="margin-bottom:28px;">
            <h2 class="section-heading">More about <?= htmlspecialchars($currentToolName, ENT_QUOTES) ?></h2>
            <p style="font-size:0.95rem;color:var(--text-secondary);line-height:1.75;">
                <?= htmlspecialchars($toolPageContent['paragraphs'][0] ?? '', ENT_QUOTES) ?>
            </p>
        </div>
        <div style="display:grid;grid-template-columns:1fr;gap:18px;">
            <div style="padding:24px;border:1px solid rgba(15,23,42,0.08);border-radius:24px;background:var(--bg-surface);">
                <h3 style="margin:0 0 10px;font-size:1rem;color:var(--text-primary);">How to use this tool</h3>
                <p style="margin:0;color:var(--text-secondary);line-height:1.75;font-size:0.92rem;">
                    <?= htmlspecialchars($toolPageContent['paragraphs'][1] ?? '', ENT_QUOTES) ?>
                </p>
            </div>
            <div style="padding:24px;border:1px solid rgba(15,23,42,0.08);border-radius:24px;background:var(--bg-surface);">
                <h3 style="margin:0 0 10px;font-size:1rem;color:var(--text-primary);">When to use it</h3>
                <p style="margin:0;color:var(--text-secondary);line-height:1.75;font-size:0.92rem;">
                    <?= htmlspecialchars($toolPageContent['paragraphs'][2] ?? '', ENT_QUOTES) ?>
                </p>
            </div>
            <div style="padding:24px;border:1px solid rgba(15,23,42,0.08);border-radius:24px;background:var(--bg-surface);">
                <h3 style="margin:0 0 10px;font-size:1rem;color:var(--text-primary);">Common search phrases for this page</h3>
                <ul style="margin:0;padding-left:18px;color:var(--text-secondary);line-height:1.75;font-size:0.92rem;">
                    <?php foreach ($toolPageKeywords as $keyword): ?>
                        <li><?= htmlspecialchars($keyword, ENT_QUOTES) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    $iconSvgs = [
        // PDF
        'img_to_pdf' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>',
        'pdf_to_img' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="10" y1="12" x2="14" y2="12"/><line x1="12" y1="10" x2="12" y2="14"/></svg>',
        'pdf_to_word' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="13" y2="17"/></svg>',
        'pdf_to_ppt' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
        'pdf_to_excel' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/><line x1="12" y1="3" x2="12" y2="21"/></svg>',
        'merge_pdf' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-3"/><rect x="10" y="2" width="12" height="12" rx="2" ry="2"/></svg>',
        'compress_pdf' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 14 10 14 10 20"/><polyline points="20 10 14 10 14 4"/><line x1="10" y1="14" x2="21" y2="3"/><line x1="3" y1="21" x2="14" y2="10"/></svg>',
        'protect_pdf' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
        // Converters
        'word_to_pdf' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>',
        'json_to_csv' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
        'csv_to_json' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>',
        // Utilities
        'qr_generator' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/><rect x="18" y="18" width="3" height="3"/><rect x="14" y="18" width="3" height="3"/><rect x="18" y="14" width="3" height="3"/></svg>',
        'password_gen' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>',
        'word_counter' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="19" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>',
        'image_compressor' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/><line x1="12" y1="12" x2="16" y2="16"/></svg>',
        'image_enhancer' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M4.93 4.93l2.12 2.12M16.95 16.95l2.12 2.12M2 12h3M19 12h3M4.93 19.07l2.12-2.12M16.95 7.05l2.12-2.12"/></svg>',
        'video_to_audio' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/><path d="M5 15v-6"/><path d="M8 13.5a2.5 2.5 0 1 0 0-3"/></svg>',
        'video_compressor' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="15" height="14" rx="2"/><polygon points="22 8 17 12 22 16 22 8"/><path d="M8 9v6"/><path d="M5 12h6"/></svg>',
        'ocr_tool' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>',
        'currency_converter' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M15.5 8.5c-.7-.8-1.8-1.3-3.1-1.3-1.9 0-3.4 1-3.4 2.6 0 3.8 6.9 1.7 6.9 5 0 1.4-1.4 2.5-3.4 2.5-1.4 0-2.8-.5-3.7-1.5"/><path d="M12 5v14"/></svg>',
        'length_converter' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21L21 3"/><path d="M7 17l-1.5 1.5"/><path d="M11 13l-1.5 1.5"/><path d="M15 9l-1.5 1.5"/><path d="M19 5l-1.5 1.5"/></svg>',
        'weight_converter' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 21h12l-1.5-10h-9z"/><path d="M9 8a3 3 0 1 1 6 0"/><path d="M8 11h8"/></svg>',
        'temperature_converter' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 14.76V5a2 2 0 0 0-4 0v9.76a4 4 0 1 0 4 0z"/></svg>',
        'area_converter' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M9 4v16"/><path d="M4 9h16"/></svg>',
        'volume_converter' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3h10"/><path d="M9 3v4l-4 7a5 5 0 0 0 4.4 7h5.2A5 5 0 0 0 19 14l-4-7V3"/></svg>',
        'speed_converter' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13a8 8 0 1 0-16 0"/><path d="M12 13l4-4"/><path d="M12 21v-2"/></svg>',
        'time_converter' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>',
        'invoice_generator' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M14 3v5h5"/><path d="M8 13h8"/><path d="M8 17h5"/></svg>',
        'ats_resume_checker' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="2"/><path d="M8 8h8"/><path d="M8 12h8"/><path d="M8 16h5"/></svg>',
        'social_image_resizer' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M8 8h8v8H8z"/></svg>',
        'jwt_decoder' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M7 9h10"/><path d="M7 13h7"/><path d="M7 17h4"/></svg>',
        'bank_statement_to_excel' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M14 3v5h5"/><path d="M9 14l2 2 4-4"/></svg>',
        'grammar_checker' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19h6"/><path d="M7 5v14"/><path d="M15 5l5 14"/><path d="M13 14h5"/></svg>',
        'paraphrase_tool' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h10"/><path d="M7 12h7"/><path d="M7 17h10"/><path d="M17 10l3 2-3 2"/></svg>',
        'percentage_calculator' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="5" x2="5" y2="19"/><circle cx="6.5" cy="6.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/></svg>',
        'loan_calculator' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M7 10h10"/><path d="M7 14h5"/></svg>',
        'bmi_calculator' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v18"/><path d="M8 7h8"/><path d="M8 12h8"/><path d="M8 17h8"/></svg>',
        'age_calculator' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4"/><path d="M8 3v4"/><path d="M3 10h18"/></svg>',
        'sensitivity_converter' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"/><path d="M8 6h8"/><path d="M8 18h8"/><path d="M10 10h4"/><path d="M10 14h4"/></svg>',
        'reaction_time_test' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>',
        'cps_test' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11V5l12-2v6"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>',
        'gamer_tag_generator' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8h12l2 8H4l2-8Z"/><path d="M9 12h.01"/><path d="M15 12h.01"/><path d="M10 16h4"/></svg>',
        'clip_to_gif' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M8 10h4"/><path d="M8 14h3"/><path d="M15 10v4"/><path d="M19 10h-3v4"/></svg>',
        'tournament_bracket_generator' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h10"/><path d="M7 17h10"/><path d="M7 7v10"/><path d="M17 7v10"/><path d="M12 7v10"/></svg>',
        'spin_wheel' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="13" r="8"/><path d="M12 5v8l5 3"/><path d="M12 2v3"/></svg>',
        'random_name_picker' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20s7-3.5 7-9V5l-7-3-7 3v6c0 5.5 7 9 7 9z"/><path d="M12 10h.01"/></svg>',
        'typing_speed_test' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M7 10h.01"/><path d="M11 10h.01"/><path d="M15 10h.01"/><path d="M7 14h10"/></svg>',
        'meme_caption_generator' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8.5" cy="9.5" r="1.5"/><path d="M21 15l-5-5-8 8"/></svg>',
        'truth_or_dare_generator' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 4v5c0 5-3.5 7.5-7 9-3.5-1.5-7-4-7-9V7l7-4Z"/><path d="M10 10h4"/><path d="M12 8v4"/></svg>',
        'memory_match_game' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="7" height="7" rx="1.5"/><rect x="13" y="4" width="7" height="7" rx="1.5"/><rect x="4" y="13" width="7" height="7" rx="1.5"/><rect x="13" y="13" width="7" height="7" rx="1.5"/></svg>',
        'youtube_downloader' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33 2.78 2.78 0 0 0 1.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>',
    ];

    $catColors = [
        'pdf'     => ['bg'=>'rgba(239,68,68,0.12)',  'color'=>'#F87171', 'label-bg'=>'rgba(239,68,68,0.1)',  'label-color'=>'#F87171'],
        'convert' => ['bg'=>'rgba(59,130,246,0.12)', 'color'=>'#60A5FA', 'label-bg'=>'rgba(59,130,246,0.1)', 'label-color'=>'#60A5FA'],
        'utility' => ['bg'=>'rgba(139,92,246,0.12)', 'color'=>'#A78BFA', 'label-bg'=>'rgba(139,92,246,0.1)','label-color'=>'#A78BFA'],
        'conversion' => ['bg'=>'rgba(16,185,129,0.12)', 'color'=>'#34D399', 'label-bg'=>'rgba(16,185,129,0.1)','label-color'=>'#34D399'],
        'calculator' => ['bg'=>'rgba(245,158,11,0.12)', 'color'=>'#FBBF24', 'label-bg'=>'rgba(245,158,11,0.1)','label-color'=>'#FBBF24'],
        'business' => ['bg'=>'rgba(16,185,129,0.12)', 'color'=>'#34D399', 'label-bg'=>'rgba(16,185,129,0.1)','label-color'=>'#34D399'],
        'writing' => ['bg'=>'rgba(99,102,241,0.12)', 'color'=>'#818CF8', 'label-bg'=>'rgba(99,102,241,0.1)','label-color'=>'#818CF8'],
        'developer' => ['bg'=>'rgba(6,182,212,0.12)', 'color'=>'#22D3EE', 'label-bg'=>'rgba(6,182,212,0.1)','label-color'=>'#22D3EE'],
        'gaming' => ['bg'=>'rgba(236,72,153,0.12)', 'color'=>'#F472B6', 'label-bg'=>'rgba(236,72,153,0.1)','label-color'=>'#F472B6'],
        'fun' => ['bg'=>'rgba(217,70,239,0.12)', 'color'=>'#E879F9', 'label-bg'=>'rgba(217,70,239,0.1)','label-color'=>'#E879F9'],
    ];
    ?>

    <?php
    if (empty($initialToolId)):
    foreach ($tools as $catKey => $category):
        $cc = $catColors[$catKey];
    ?>
    <section id="<?= $catKey === array_key_first($tools) ? 'categories' : 'category-' . htmlspecialchars($catKey) ?>" style="margin-bottom:56px;" class="tool-category-section" data-tool-category="<?= htmlspecialchars($catKey) ?>">

        <!-- Category header -->
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:24px;">
            <span class="cat-pill" style="background:<?= $cc['label-bg'] ?>;color:<?= $cc['label-color'] ?>;">
                <?= $category['title'] ?>
            </span>
            <div style="flex:1;height:1px;background:var(--border);"></div>
            <span style="font-size:0.75rem;color:var(--text-muted);white-space:nowrap;">
                <?= count($category['tools']) ?> tools
            </span>
        </div>

        <!-- Grid -->
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:14px;">
            <?php foreach ($category['tools'] as $i => $tool):
                $iconSvg = $iconSvgs[$tool['icon']] ?? $iconSvgs['pdf_to_word'];
            ?>
            <?php $tool_slug = $tool_slugs[$tool['id']] ?? $tool['id']; ?>
            <a
                href="/<?= htmlspecialchars($tool_slug) ?>"
                class="tool-card stagger-in"
                data-tool-id="<?= htmlspecialchars($tool['id']) ?>"
                data-tool-name="<?= htmlspecialchars(strtolower($tool['name'])) ?>"
                data-tool-desc="<?= htmlspecialchars(strtolower($tool['desc'])) ?>"
                data-tool-category="<?= htmlspecialchars($catKey) ?>"
                style="animation-delay:<?= $i * 40 ?>ms; text-decoration:none; display:block;"
            >
                <!-- Arrow -->
                <div class="tool-arrow">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </div>

                <!-- Icon -->
                <div class="tool-icon-wrap" style="background:<?= $cc['bg'] ?>;color:<?= $cc['color'] ?>;">
                    <?= $iconSvg ?>
                </div>

                <div class="tool-name"><?= htmlspecialchars($tool['name']) ?></div>
                <div class="tool-desc"><?= htmlspecialchars($tool['desc']) ?></div>
            </a>
            <?php endforeach; ?>
        </div>

    </section>
    <?php
    endforeach;
    endif;
    ?>

    <!-- ── Why section ── -->
    <?php if (empty($initialToolId)): ?>
    <section style="margin-bottom:64px;">
        <div style="text-align:center;margin-bottom:40px;">
            <div class="section-label" style="justify-content:center;">Why Any2Convert</div>
            <h2 class="section-heading" style="margin-top:8px;">Built around your privacy</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
            <?php
            $features = [
                ['slug'=>'files-never-leave-your-device', 'icon'=>'<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>', 'color'=>'var(--green)', 'bg'=>'rgba(16,185,129,0.1)', 'title'=>'Files stay on your device', 'desc'=>'Many tools process files locally on your device instead of pushing them through a remote upload flow.'],
                ['slug'=>'instant-results', 'icon'=>'<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>', 'color'=>'var(--accent)', 'bg'=>'rgba(108,99,255,0.1)', 'title'=>'Instant results', 'desc'=>'No server round-trips. Conversions happen in milliseconds, regardless of file size.'],
                ['slug'=>'always-free-no-watermarks', 'icon'=>'<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>', 'color'=>'var(--amber)', 'bg'=>'rgba(245,158,11,0.1)', 'title'=>'Always free, no watermarks', 'desc'=>'No hidden fees, no paywalls, no branding added to your files.'],
                ['slug'=>'works-on-any-device', 'icon'=>'<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>', 'color'=>'var(--blue)', 'bg'=>'rgba(59,130,246,0.1)', 'title'=>'Runs on the device you already have', 'desc'=>'Desktop, tablet, or phone - open the page and get to work without installing anything first.'],
            ];
            foreach($features as $f):
                $featureSlug = $f['slug'] ?? 'works-on-any-device'; ?>
            <a href="/highlights/<?= rawurlencode($featureSlug) ?>" class="detail-card" style="padding:24px;">
                <div style="width:40px;height:40px;border-radius:10px;background:<?= $f['bg'] ?>;color:<?= $f['color'] ?>;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                    <?= $f['icon'] ?>
                </div>
                <div style="font-size:0.9rem;font-weight:600;color:var(--text-primary);margin-bottom:6px;letter-spacing:-0.01em;"><?= $f['title'] ?></div>
                <div style="font-size:0.78rem;color:var(--text-muted);line-height:1.6;"><?= $f['desc'] ?></div>
                <span class="detail-card-arrow">Read more
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </span>
            </a>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── Popular tools ── -->
    <?php if (empty($initialToolId)): ?>
    <section style="margin-bottom:64px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
            <h3 class="section-heading">Popular tools</h3>
        </div>
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
            <?php
            $popular = [
                ['img_to_pdf','Image to PDF'],['pdf_to_word','PDF to Word'],
                ['merge_pdf','Merge PDF'],['compress_pdf','Compress PDF'],
                ['ocr_tool','OCR Tool'],['json_to_csv','JSON to CSV'],
                ['currency_converter','Currency Converter'],['invoice_generator','Invoice Generator'],
                ['grammar_checker','Grammar Checker'],['jwt_decoder','JWT Decoder'],
                ['reaction_time_test','Reaction Time Test'],['gamer_tag_generator','Gamer Tag Generator'],
                ['clip_to_gif','Clip to GIF'],
                ['spin_wheel','Spin the Wheel'],['typing_speed_test','Typing Speed Test'],['memory_match_game','Memory Match Game'],
            ];
            foreach($popular as [$id,$label]): 
                $slug = $tool_slugs[$id] ?? $id;
            ?>
            <a href="/<?= htmlspecialchars($slug) ?>" class="chip"><?= $label ?></a>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── Blog preview ── -->
    <?php if (empty($initialToolId)): ?>
    <section>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
            <h3 class="section-heading">Guides & Tips</h3>
            <a href="/blog" style="text-decoration:none;font-size:0.82rem;color:var(--accent);display:flex;align-items:center;gap:4px;">
                View all
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:16px;">

            <a href="/blog/security-benefits" class="blog-card">
                <div style="width:40px;height:40px;border-radius:10px;background:rgba(239,68,68,0.1);color:#F87171;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div style="font-size:0.9rem;font-weight:600;color:var(--text-primary);margin-bottom:6px;letter-spacing:-0.01em;">Why Image to PDF is More Secure</div>
                <div style="font-size:0.78rem;color:var(--text-muted);line-height:1.6;">Learn how PDF encryption protects your sensitive documents from unauthorized access.</div>
                <div style="margin-top:16px;font-size:0.75rem;color:var(--accent);display:flex;align-items:center;gap:4px;font-weight:500;">
                    Read article
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2 12"/><polyline points="12 5 19 12 12 19"/></svg>
                </div>
            </a>

            <a href="/blog/qr-guide" class="blog-card">
                <div style="width:40px;height:40px;border-radius:10px;background:rgba(139,92,246,0.1);color:#A78BFA;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/></svg>
                </div>
                <div style="font-size:0.9rem;font-weight:600;color:var(--text-primary);margin-bottom:6px;letter-spacing:-0.01em;">Business QR Code Best Practices</div>
                <div style="font-size:0.78rem;color:var(--text-muted);line-height:1.6;">Maximize engagement with high-quality, scannable QR codes built for real-world use.</div>
                <div style="margin-top:16px;font-size:0.75rem;color:var(--accent);display:flex;align-items:center;gap:4px;font-weight:500;">
                    Read article
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </div>
            </a>

        </div>
    </section>
    <?php endif; ?>

</main>


<!-- ═══════════════════════════════ FOOTER ═══════════════════════════════ -->
<footer style="border-top:1px solid var(--border);background:var(--bg-surface);">
    <div style="max-width:1280px;margin:0 auto;padding:48px 20px 32px;">

        <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:40px;margin-bottom:40px;" class="footer-grid">
            <div>
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                    <div style="width:28px;height:28px;background:var(--accent);border-radius:7px;display:flex;align-items:center;justify-content:center;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <span style="font-weight:700;font-size:0.95rem;color:var(--text-primary);">Any2Convert</span>
                </div>
                <p style="font-size:0.8rem;color:var(--text-muted);line-height:1.7;max-width:220px;">Free online tools with local on-device processing, cleaner workflows, and privacy-first defaults.</p>
            </div>

            <div>
                <div style="font-size:0.75rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:14px;">Tools</div>
                <div style="display:flex;flex-direction:column;gap:9px;">
                    <a href="/image-to-pdf" class="footer-link">Image to PDF</a>
                    <a href="/pdf-to-word" class="footer-link">PDF to Word</a>
                    <a href="/merge-pdf" class="footer-link">Merge PDF</a>
                    <a href="/ocr-image-to-text" class="footer-link">OCR Tool</a>
                </div>
            </div>

            <div>
                <div style="font-size:0.75rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:14px;">Company</div>
                <div style="display:flex;flex-direction:column;gap:9px;">
                    <a href="/about" class="footer-link">About</a>
                    <a href="/contact" class="footer-link">Contact</a>
                    <a href="/privacy" class="footer-link">Privacy Policy</a>
                    <a href="/terms" class="footer-link">Terms</a>
                </div>
            </div>

            <div>
                <div style="font-size:0.75rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:14px;">Resources</div>
                <div style="display:flex;flex-direction:column;gap:9px;">
                    <a href="/blog" class="footer-link">Blog</a>
                </div>
            </div>
        </div>

        <div style="border-top:1px solid var(--border);padding-top:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
            <span style="font-size:0.78rem;color:var(--text-muted);">&copy; <?= date('Y') ?> Any2Convert. All rights reserved. Made with love in Karachi, Pakistan.</span>
            <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;color:var(--text-muted);">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Local-first processing on your device
            </div>
        </div>

    </div>
</footer>

<!-- ═══════════════════════════════ TOOL MODAL ═══════════════════════════════ -->
<div id="toolModal" class="modal-overlay" onclick="closeToolModal(event)">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-header">
            <div style="display:flex;align-items:center;gap:10px;">
                <div id="modalIconWrap" style="width:32px;height:32px;border-radius:8px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <h3 id="modalTitle" style="font-size:0.95rem;font-weight:600;color:var(--text-primary);letter-spacing:-0.01em;">Tool</h3>
            </div>
            <button onclick="closeToolModal()" class="modal-close" title="Close">✕</button>
        </div>

        <!-- Upload zone (shown while loading or as UI guide in modal) -->
        <div id="modalContent" style="padding:24px;">
            <div style="text-align:center;padding:40px 0;">
                <div style="display:inline-flex;width:40px;height:40px;border-radius:50%;border:3px solid transparent;border-top-color:var(--accent);animation:spin 0.8s linear infinite;"></div>
                <p style="margin-top:12px;font-size:0.84rem;color:var(--text-muted);">Loading tool…</p>
            </div>
        </div>

    </div>
</div>

<!-- ═══════════════════════════════ SCRIPTS ═══════════════════════════════ -->
<script>
window.any2convertRoutes = {
    pdfService: '{{ route('tools.pdf-service') }}',
    aiImage: '{{ route('tools.ai-image') }}'
};
window.any2convertInitialTool = @json($initialToolId ?? null);
const toolDependencyMap = {
    img_to_pdf: ["https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"],
    protect_pdf: ["https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"],
    repair_media: ["https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"]
};

function loadScriptOnce(src) {
    window.__any2convertLoadedScripts = window.__any2convertLoadedScripts || {};
    if (window.__any2convertLoadedScripts[src]) {
        return window.__any2convertLoadedScripts[src];
    }
    window.__any2convertLoadedScripts[src] = new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.async = false;
        script.dataset.src = src;
        script.onload = () => {
            if (src.includes('/pdf.js/')) {
                window.pdfjsLib && (window.pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js");
            }
            resolve();
        };
        script.onerror = () => reject(new Error('Failed to load required library.'));
        document.body.appendChild(script);
    });
    return window.__any2convertLoadedScripts[src];
}

function ensureToolDependencies(toolId) {
    const dependencies = toolDependencyMap[toolId] || [];
    return Promise.all(dependencies.map(loadScriptOnce));
}

const toolSlugMap = {
    img_to_pdf: 'image-to-pdf',
    pdf_to_img: 'pdf-to-image',
    pdf_to_word: 'pdf-to-word',
    pdf_to_ppt: 'pdf-to-powerpoint',
    pdf_to_excel: 'pdf-to-excel',
    merge_pdf: 'merge-pdf',
    compress_pdf: 'compress-pdf',
    protect_pdf: 'protect-pdf',
    word_to_pdf: 'word-to-pdf',
    excel_to_pdf: 'excel-to-pdf',
    ppt_to_pdf: 'powerpoint-to-pdf',
    html_to_pdf: 'html-to-pdf',
    split_pdf: 'split-pdf',
    remove_pages: 'remove-pdf-pages',
    extract_pages: 'extract-pdf-pages',
    organize_pdf: 'organize-pdf',
    scan_to_pdf: 'scan-to-pdf',
    optimize_pdf: 'optimize-pdf',
    repair_pdf: 'repair-pdf',
    ocr_pdf: 'ocr-pdf',
    rotate_pdf: 'rotate-pdf',
    add_page_numbers: 'add-page-numbers',
    add_watermark: 'add-watermark',
    unlock_pdf: 'unlock-pdf',
    sign_pdf: 'sign-pdf',
    crop_pdf: 'crop-pdf',
    compare_pdf: 'compare-pdf',
    ai_summarizer: 'ai-summarizer',
    pdf_to_pdfa: 'pdf-to-pdfa',
    edit_pdf: 'edit-pdf',
    redact_pdf: 'redact-pdf',
    translate_pdf: 'translate-pdf',
    json_to_csv: 'json-to-csv',
    csv_to_json: 'csv-to-json',
    qr_generator: 'qr-code-generator',
    password_gen: 'password-generator',
    word_counter: 'word-counter',
    image_compressor: 'image-compressor',
    bg_remover: 'background-remover',
    image_to_dxf: 'image-to-dxf',
    image_to_svg: 'image-to-svg',
    resize_image: 'resize-image',
    crop_image: 'crop-image',
    image_enhancer: 'image-enhancer',
    image_converter: 'image-converter',
    heic_converter: 'heic-to-jpg-png-pdf',
    jpg_converter: 'jpg-to-png-jpeg-pdf',
    webp_converter: 'webp-to-png-jpg-jpeg-pdf',
    video_to_audio: 'video-to-audio',
    video_compressor: 'video-compressor',
    ai_image_generator: 'ai-image-generator',
    ocr_tool: 'ocr-image-to-text',
    repair_media: 'repair-corrupt-photos-videos',
    currency_converter: 'currency-converter',
    length_converter: 'length-converter',
    weight_converter: 'weight-converter',
    temperature_converter: 'temperature-converter',
    area_converter: 'area-converter',
    volume_converter: 'volume-converter',
    speed_converter: 'speed-converter',
    time_converter: 'time-converter',
    invoice_generator: 'invoice-generator',
    ats_resume_checker: 'ats-resume-checker',
    social_image_resizer: 'social-image-resizer',
    jwt_decoder: 'jwt-decoder',
    bank_statement_to_excel: 'bank-statement-pdf-to-excel',
    grammar_checker: 'grammar-checker',
    paraphrase_tool: 'paraphrase-tool',
    percentage_calculator: 'percentage-calculator',
    loan_calculator: 'loan-calculator',
    bmi_calculator: 'bmi-calculator',
    age_calculator: 'age-calculator',
    sensitivity_converter: 'sensitivity-converter',
    reaction_time_test: 'reaction-time-test',
    cps_test: 'cps-test',
    gamer_tag_generator: 'gamer-tag-generator',
    clip_to_gif: 'clip-to-gif',
    tournament_bracket_generator: 'tournament-bracket-generator',
    spin_wheel: 'spin-the-wheel',
    random_name_picker: 'random-name-picker',
    typing_speed_test: 'typing-speed-test',
    meme_caption_generator: 'meme-caption-generator',
    truth_or_dare_generator: 'truth-or-dare-generator',
    memory_match_game: 'memory-match-game'
};

function redirectToToolPage(toolId) {
    if (window.any2convertInitialTool === toolId) return false;
    const slug = toolSlugMap[toolId];
    if (!slug) return false;
    window.location.href = `/${encodeURIComponent(slug)}`;
    return true;
}

function isKnownToolId(toolId) {
    return Object.prototype.hasOwnProperty.call(toolSlugMap, toolId);
}

// ── Theme (light default, dark optional, persisted) ──
function toggleDarkMode() {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    document.getElementById('iconMoon').style.display = isDark ? 'none'  : '';
    document.getElementById('iconSun').style.display  = isDark ? ''      : 'none';
}
// Init theme on load
(function(){
    const saved = localStorage.getItem('theme');
    if (saved === 'dark') {
        document.documentElement.classList.add('dark');
        document.getElementById('iconMoon').style.display = 'none';
        document.getElementById('iconSun').style.display  = '';
    }
})();

// ── Stagger animation observer ──
(function(){
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if(e.isIntersecting){
                const delay = e.target.dataset.staggerDelay || '0ms';
                e.target.style.animationDelay = delay;
                e.target.classList.add('visible');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.stagger-in').forEach((el, index) => {
        el.dataset.staggerDelay = `${Math.min(index * 35, 280)}ms`;
        io.observe(el);
    });
})();

// ── Execute scripts in dynamically loaded HTML ──
async function executeScripts(container) {
    document.querySelectorAll('script[data-dynamic-tool-script="1"]').forEach(script => script.remove());
    const scripts = Array.from(container.querySelectorAll('script'));

    for (const oldScript of scripts) {
        const newScript = document.createElement('script');
        newScript.dataset.dynamicToolScript = '1';

        if (oldScript.src) {
            await new Promise((resolve, reject) => {
                newScript.src = oldScript.src;
                newScript.async = false;
                newScript.onload = resolve;
                newScript.onerror = () => reject(new Error(`Failed to load script: ${oldScript.src}`));
                oldScript.parentNode.removeChild(oldScript);
                document.body.appendChild(newScript);
            });
        } else {
            newScript.textContent = oldScript.textContent;
            oldScript.parentNode.removeChild(oldScript);
            document.body.appendChild(newScript);
        }
    }
}

// ── Tool modal ──
function openTool(toolId) {
    if (redirectToToolPage(toolId)) {
        return;
    }
    const modal   = document.getElementById('toolModal');
    const modalBox = modal.querySelector('.modal-box');
    const title   = document.getElementById('modalTitle');
    const content = document.getElementById('modalContent');
    const isEditorTool = toolId === 'edit_pdf' || toolId === 'sign_pdf' || toolId === 'tournament_bracket_generator';

    if (modalBox) {
        modalBox.classList.toggle('modal-box-editor', isEditorTool);
        if (toolId === 'tournament_bracket_generator') {
            modalBox.style.maxWidth = '1280px';
        } else {
            modalBox.style.maxWidth = '';
        }
    }
    content.style.padding = isEditorTool ? '0' : '24px';

    content.innerHTML = `
        <div style="text-align:center;padding:48px 0;">
            <div style="display:inline-flex;width:36px;height:36px;border-radius:50%;border:3px solid transparent;border-top-color:var(--accent);animation:spin 0.8s linear infinite;"></div>
            <p style="margin-top:14px;font-size:0.82rem;color:var(--text-muted);">Loading tool…</p>
        </div>`;

    modal.classList.add('flex');
    title.textContent = getToolName(toolId);
    document.body.style.overflow = 'hidden';

    fetch(`{{ route('tools.render') }}?tool=${encodeURIComponent(toolId)}`)
        .then(r => r.text())
        .then(html => {
            content.innerHTML = html;
            return ensureToolDependencies(toolId).then(() => executeScripts(content));
        })
        .catch(err => {
            content.innerHTML = `
                <div style="padding:32px;text-align:center;">
                    <div style="width:44px;height:44px;border-radius:12px;background:rgba(239,68,68,0.1);color:#F87171;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    </div>
                    <p style="font-size:0.88rem;color:#F87171;margin-bottom:4px;font-weight:600;">Failed to load tool</p>
                    <p style="font-size:0.78rem;color:var(--text-muted);">${err.message}</p>
                </div>`;
        });
}

function closeToolModal(event) {
    if (event && event.target !== event.currentTarget) return;
    document.getElementById('toolModal').classList.remove('flex');
    const modalBox = document.querySelector('#toolModal .modal-box');
    if (modalBox) modalBox.classList.remove('modal-box-editor');
    document.getElementById('modalContent').innerHTML = '';
    document.getElementById('modalContent').style.padding = '24px';
    document.body.style.overflow = '';
}

function getToolName(toolId) {
    const names = {
        'img_to_pdf':'Image to PDF','pdf_to_img':'PDF to Image','pdf_to_word':'PDF to Word',
        'pdf_to_ppt':'PDF to PowerPoint','pdf_to_excel':'PDF to Excel','merge_pdf':'Merge PDF',
        'split_pdf':'Split PDF','remove_pages':'Remove Pages','extract_pages':'Extract Pages',
        'organize_pdf':'Organize PDF','compress_pdf':'Compress PDF','optimize_pdf':'Optimize PDF',
        'repair_pdf':'Repair PDF','ocr_pdf':'OCR PDF','rotate_pdf':'Rotate PDF',
        'add_page_numbers':'Add Page Numbers','add_watermark':'Add Watermark','protect_pdf':'Protect PDF',
        'unlock_pdf':'Unlock PDF','sign_pdf':'Sign PDF','crop_pdf':'Crop PDF',
        'compare_pdf':'Compare PDF','ai_summarizer':'AI Summarizer','pdf_to_pdfa':'PDF to PDF/A',
        'edit_pdf':'Edit PDF','redact_pdf':'Redact PDF','translate_pdf':'Translate PDF','word_to_pdf':'Word to PDF',
        'excel_to_pdf':'Excel to PDF','ppt_to_pdf':'PowerPoint to PDF','html_to_pdf':'HTML to PDF','json_to_csv':'JSON to CSV',
        'csv_to_json':'CSV to JSON','qr_generator':'QR Code Generator','password_gen':'Password Generator',
        'word_counter':'Word Counter','image_compressor':'Image Compressor','bg_remover':'Background Remover',
        'image_to_dxf':'Image to DXF','image_to_svg':'Image to SVG','resize_image':'Resize Image','image_enhancer':'Image Enhancer',
        'image_converter':'Image Converter','heic_converter':'HEIC to JPG PNG PDF','jpg_converter':'JPG to PNG JPEG PDF','webp_converter':'WEBP to PNG JPG JPEG PDF','video_to_audio':'Video to Audio','video_compressor':'Video Compressor','crop_image':'Crop Image','ai_image_generator':'AI Image Generator','ocr_tool':'OCR Tool',
        'scan_to_pdf':'Scan to PDF','repair_media':'Repair Photos & Videos','currency_converter':'Currency Converter','length_converter':'Length Converter',
        'weight_converter':'Weight Converter','temperature_converter':'Temperature Converter','area_converter':'Area Converter',
        'volume_converter':'Volume Converter','speed_converter':'Speed Converter','time_converter':'Time Converter',
        'invoice_generator':'Invoice Generator','ats_resume_checker':'ATS Resume Checker','social_image_resizer':'Social Image Resizer',
        'jwt_decoder':'JWT Decoder','bank_statement_to_excel':'Bank Statement PDF to Excel','grammar_checker':'Grammar Checker',
        'paraphrase_tool':'Paraphrase Tool','percentage_calculator':'Percentage Calculator','loan_calculator':'Loan Calculator',
        'bmi_calculator':'BMI Calculator','age_calculator':'Age Calculator',
        'sensitivity_converter':'Sensitivity Converter','reaction_time_test':'Reaction Time Test','cps_test':'CPS Test',
        'gamer_tag_generator':'Gamer Tag Generator','clip_to_gif':'Clip to GIF','tournament_bracket_generator':'Tournament Bracket Generator',
        'spin_wheel':'Spin the Wheel','random_name_picker':'Random Name Picker','typing_speed_test':'Typing Speed Test',
        'meme_caption_generator':'Meme Caption Generator','truth_or_dare_generator':'Truth or Dare Generator','memory_match_game':'Memory Match Game'
    };
    return names[toolId] || 'Tool';
}

// URL hash routing
if (window.any2convertInitialTool) {
    setTimeout(() => openTool(window.any2convertInitialTool), 100);
} else if (window.location.hash) {
    const toolId = window.location.hash.substring(1);
    setTimeout(() => {
        if (isKnownToolId(toolId) && !redirectToToolPage(toolId)) {
            openTool(toolId);
        }
    }, 100);
}

// ESC to close
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeToolModal();
});

// ── Homepage tool search + filters ──
(function() {
    const searchInput = document.getElementById('toolSearchInput');
    const clearButton = document.getElementById('toolSearchClear');
    const status = document.getElementById('toolSearchStatus');
    const filterButtons = Array.from(document.querySelectorAll('[data-tool-filter]'));
    const cards = Array.from(document.querySelectorAll('.tool-card[data-tool-category]'));
    const sections = Array.from(document.querySelectorAll('.tool-category-section'));
    const noResults = document.getElementById('toolNoResults');
    if (!searchInput || !cards.length) return;
    let activeFilter = 'all';

    function syncUrl(query, filter) {
        const url = new URL(window.location.href);
        if (query) {
            url.searchParams.set('q', query);
        } else {
            url.searchParams.delete('q');
        }
        if (filter && filter !== 'all') {
            url.searchParams.set('category', filter);
        } else {
            url.searchParams.delete('category');
        }
        const next = `${url.pathname}${url.search}${url.hash}`;
        window.history.replaceState({}, '', next);
    }

    function updateStatus(visibleCards, query) {
        if (!status) return;
        const filterLabel = activeFilter === 'all'
            ? 'all categories'
            : `${activeFilter} tools`;
        if (!visibleCards) {
            status.textContent = `Showing 0 tools in ${filterLabel}.`;
            return;
        }
        if (query) {
            status.textContent = `Showing ${visibleCards} tools for "${query}" in ${filterLabel}.`;
            return;
        }
        status.textContent = `Showing ${visibleCards} tools in ${filterLabel}.`;
    }

    function applyToolFilters() {
        const rawQuery = searchInput.value.trim();
        const query = rawQuery.toLowerCase();
        let visibleCards = 0;
        cards.forEach(card => {
            const category = card.dataset.toolCategory || '';
            const text = (card.dataset.toolName + ' ' + card.dataset.toolDesc + ' ' + (card.dataset.toolId || '')).toLowerCase();
            const categoryMatch = activeFilter === 'all' || category === activeFilter;
            const queryMatch = !query || text.includes(query);
            const show = categoryMatch && queryMatch;
            card.classList.toggle('hidden-by-filter', !show);
            if (show) visibleCards++;
        });

        sections.forEach(section => {
            const hasVisible = section.querySelector('.tool-card:not(.hidden-by-filter)');
            section.classList.toggle('hidden-by-filter', !hasVisible);
        });
        noResults.classList.toggle('hidden-by-filter', visibleCards > 0);
        if (clearButton) {
            clearButton.hidden = rawQuery === '';
        }
        updateStatus(visibleCards, rawQuery);
        syncUrl(rawQuery, activeFilter);
    }

    searchInput.addEventListener('input', applyToolFilters);
    if (clearButton) {
        clearButton.addEventListener('click', function() {
            searchInput.value = '';
            applyToolFilters();
            searchInput.focus();
        });
    }
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            activeFilter = btn.dataset.toolFilter || 'all';
            filterButtons.forEach(b => {
                const isActive = b === btn;
                b.classList.toggle('active', isActive);
                b.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });
            applyToolFilters();
        });
    });

    const params = new URLSearchParams(window.location.search);
    const q = params.get('q');
    const category = params.get('category');
    if (q) searchInput.value = q;
    if (category) {
        const matchingButton = filterButtons.find((btn) => btn.dataset.toolFilter === category);
        if (matchingButton) {
            activeFilter = category;
            filterButtons.forEach((btn) => {
                const isActive = btn === matchingButton;
                btn.classList.toggle('active', isActive);
                btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });
        }
    }
    applyToolFilters();
})();
</script>

<!-- Responsive footer grid -->
<style>
@media(max-width:768px){
    .footer-grid { grid-template-columns: 1fr 1fr !important; }
}
@media(max-width:480px){
    .footer-grid { grid-template-columns: 1fr !important; }
}
</style>
<!-- StartupBase Badge (Hidden for Verification) -->
<div style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;">
    <a href="https://startupbase.io/products/any2convert-com?utm_source=startupbase&utm_medium=badge&utm_campaign=featured-badge-dark" target="_blank" rel="noopener noreferrer">
      <img src="https://statics.startupbase.io/site/badges/featured-on-sb-dark.svg" alt="Featured on StartupBase" height="55" style="height:55px;width:auto;" />
    </a>
</div>

<!-- SEO Homepage Keywords -->
<div class="fixed bottom-0 left-0 right-0 p-1 text-[9px] text-gray-400/20 hover:text-gray-400/80 transition-opacity select-none z-[-1] text-justify" aria-hidden="true" style="line-height: 1.2;">
    anyconv, any conversion, any converter, any2convert, any 2 convert, any to convert, free online converter tools anyconv alternative, anyconversion online free without email, any2convert image pdf calculator word ocr tool, best anyconv tools free alternative no signup, fast any2convert utility, any converter no watermark online, any conversion online free tool, any2convert ocr scanner, any2convert generator, anyconvert web tools, any converter fast secure privacy safe local processing.
</div>

</body>
</html>