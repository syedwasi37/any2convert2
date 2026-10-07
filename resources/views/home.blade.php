<?php
$isAdminUser = false;

$trustHighlights = [
    ['href' => '#tools', 'label' => 'Browse all tools', 'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>'],
    ['href' => '/privacy', 'label' => 'How files are handled', 'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'],
    ['href' => '/contact', 'label' => 'Contact support', 'icon' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--blue)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5 9 9 0 0 1-4-.9L3 21l1.9-5.5a9 9 0 0 1-.9-4A8.5 8.5 0 0 1 12.5 3h.5a8.5 8.5 0 0 1 8 8z"/></svg>'],
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
            ['id' => 'ai_summarizer', 'name' => 'PDF Summary Builder', 'icon' => 'ocr_tool', 'desc' => 'Create a short extractive summary locally in your browser'],
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
            ['id' => 'ai_image_generator', 'name' => 'Prompt Art Maker', 'icon' => 'ai_image_generator', 'desc' => 'Create a procedural illustration locally from prompt keywords'],
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
    'description' => 'Free online tools for PDFs, images, file conversion, calculators, OCR, and everyday tasks. Processing depends on the tool.',
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
    'logo' => $siteUrl . '/any2convertlogo.png',
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
$defaultDescription = 'Free online tools for PDFs, documents, images, and everyday tasks. Most tools are available without an account.';
$seoTitle = $defaultTitle;
$seoDescription = $defaultDescription;
$isToolPage = !empty($initialToolId) && isset($toolNameMap[$initialToolId]);
$currentToolName = $isToolPage ? $toolNameMap[$initialToolId] : '';
$currentToolDescription = $isToolPage ? trim($toolDescriptionMap[$initialToolId] ?? '') : '';
$currentToolCategory = $isToolPage ? ($toolCategoryMap[$initialToolId] ?? 'Online Tools') : '';
if ($isToolPage) {
    $seoTitle = $currentToolName . ' | Any2Convert';
    $seoDescription = $currentToolDescription !== ''
        ? $currentToolDescription . '. Open the tool to see its supported inputs and options.'
        : 'Use the ' . $currentToolName . ' tool on Any2Convert.';
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
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @include('partials.site-theme')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (!auth()->check() || !auth()->user()->hasPremiumFeature('ad_free')): ?>
    <meta name="google-adsense-account" content="ca-pub-4031884874698168">
    <?php endif; ?>
    <?php if (request()->has('topic') || request()->has('noindex')): ?>
    <meta name="robots" content="noindex, follow">
    <?php else: ?>
    <meta name="robots" content="index, follow">
    <?php endif; ?>
    <link rel="canonical" href="<?= $canonicalUrl ?>">
    <link rel="alternate" href="<?= $canonicalUrl ?>" hreflang="en">
    <link rel="alternate" href="<?= $canonicalUrl ?>" hreflang="x-default">
    <title><?= htmlspecialchars($seoTitle, ENT_QUOTES) ?></title>
    <link rel="icon" type="image/png" sizes="32x32" href="<?= asset('favicon-32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= asset('favicon-16.png') ?>">
    <link rel="icon" type="image/x-icon" href="<?= asset('favicon.ico') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= asset('apple-touch-icon.png') ?>">
    <link rel="manifest" href="<?= asset('site.webmanifest') ?>">
    <meta name="msapplication-TileColor" content="#3B82F6">
    <meta name="msapplication-TileImage" content="<?= asset('icon-192.png') ?>">
    <meta name="description" content="<?= htmlspecialchars($seoDescription, ENT_QUOTES) ?>">
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

    @include('partials.tailwind-assets')
    <!-- Google tag -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-GNWNK7QZTD');
    </script>

    @include('partials.defer-external-scripts', ['sources' => array_values(array_filter([
        (empty($initialToolId) && (!auth()->check() || !auth()->user()->hasPremiumFeature('ad_free'))) ? ['src' => 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4031884874698168', 'crossorigin' => 'anonymous'] : null,
        ['src' => 'https://www.googletagmanager.com/gtag/js?id=G-GNWNK7QZTD'],
        ['src' => 'https://www.clarity.ms/tag/xymcprs44h'],
    ]))])
</head>
<body>

@include('partials.site-navbar')


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
            <em>Ready when you are.</em>
            <?php else: ?>
            Tools for files and<br>
            <em>everyday work.</em>
            <?php endif; ?>
        </h1>

        <p class="hero-sub" style="margin:20px auto 36px;">
            <?php if ($isToolPage): ?>
            <?= htmlspecialchars($currentToolDescription !== '' ? $currentToolDescription : 'Use this focused browser-based tool on Any2Convert.', ENT_QUOTES) ?>
            <?php else: ?>
            Convert, edit, and organize files with practical tools. Most are available without an account.
            <?php endif; ?>
        </p>

        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:10px;">
            <?php foreach ($trustHighlights as $highlight): ?>
            <a href="<?= htmlspecialchars($highlight['href'], ENT_QUOTES) ?>" class="stat-item">
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

    <!-- Tool page introduction -->
    <?php if ($isToolPage): ?>
    <section style="margin:0 auto 32px;max-width:760px;text-align:center;">
        <p class="eyebrow"><?= htmlspecialchars($currentToolCategory, ENT_QUOTES) ?></p>
        <h1 class="section-heading" style="margin:0 0 8px;"><?= htmlspecialchars($currentToolName, ENT_QUOTES) ?></h1>
        <p style="font-size:0.95rem;color:var(--text-secondary);max-width:620px;margin:0 auto;line-height:1.6;">
            <?= htmlspecialchars($currentToolDescription, ENT_QUOTES) ?>
        </p>
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
            <?php foreach ($category['tools'] as $tool):
                $iconSvg = $iconSvgs[$tool['icon']] ?? $iconSvgs['pdf_to_word'];
            ?>
            <?php $tool_slug = $tool_slugs[$tool['id']] ?? $tool['id']; ?>
            <a
                href="/<?= htmlspecialchars($tool_slug) ?>"
                class="tool-card"
                data-tool-id="<?= htmlspecialchars($tool['id']) ?>"
                data-tool-name="<?= htmlspecialchars(strtolower($tool['name'])) ?>"
                data-tool-desc="<?= htmlspecialchars(strtolower($tool['desc'])) ?>"
                data-tool-category="<?= htmlspecialchars($catKey) ?>"
                style="text-decoration:none; display:block;"
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
            <div class="section-label" style="justify-content:center;">A straightforward workflow</div>
            <h2 class="section-heading" style="margin-top:8px;">Start with what you need</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
            <?php
            $features = [
                ['href'=>'#tools', 'icon'=>'<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>', 'color'=>'var(--green)', 'bg'=>'rgba(16,185,129,0.1)', 'title'=>'Pick a tool', 'desc'=>'Search by task or browse the categories to find a good place to start.'],
                ['href'=>'/privacy', 'icon'=>'<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>', 'color'=>'var(--accent)', 'bg'=>'rgba(108,99,255,0.1)', 'title'=>'Check how files are handled', 'desc'=>'Processing depends on the tool. Review the details before choosing a file.'],
                ['href'=>'/contact', 'icon'=>'<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5 9 9 0 0 1-4-.9L3 21l1.9-5.5a9 9 0 0 1-.9-4A8.5 8.5 0 0 1 12.5 3h.5a8.5 8.5 0 0 1 8 8z"/></svg>', 'color'=>'var(--blue)', 'bg'=>'rgba(59,130,246,0.1)', 'title'=>'Ask for help', 'desc'=>'Send a question or report a problem to the support team.'],
            ];
            foreach($features as $f):
                $featureHref = $f['href'] ?? '#tools'; ?>
            <a href="<?= htmlspecialchars($featureHref, ENT_QUOTES) ?>" class="detail-card" style="padding:24px;">
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


@include('partials.site-footer')

<!-- ═══════════════════════════════ TOOL MODAL ═══════════════════════════════ -->
<div id="toolModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modalTitle" tabindex="-1" onclick="closeToolModal(event)">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-header">
            <div class="modal-title-group">
                <div id="modalIconWrap" style="width:32px;height:32px;border-radius:8px;background:var(--accent-light);color:var(--accent);display:flex;align-items:center;justify-content:center;flex:0 0 auto;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <h3 id="modalTitle" class="modal-title">Tool</h3>
            </div>
            <a href="/" class="tool-home-link" aria-label="Go back to all tools" title="Back to all tools">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/><path d="M20 12H9"/></svg>
                <span>All tools</span>
            </a>
            <a id="reportToolIssue" href="{{ route('contact.show', ['category' => 'tool']) }}" class="tool-home-link" aria-label="Report an issue with this tool" title="Report an issue">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 9v4m0 4h.01"/><path d="M10.3 3.9 2.5 17.4A2 2 0 0 0 4.2 20h15.6a2 2 0 0 0 1.7-2.6L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
                <span>Report issue</span>
            </a>
            <button type="button" onclick="closeToolModal()" class="modal-close" aria-label="Close tool" title="Close">✕</button>
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
let activeToolRequest = null;
let activeToolRequestId = 0;
let toolModalReturnFocus = null;

function openTool(toolId) {
    if (redirectToToolPage(toolId)) {
        return;
    }
    const modal   = document.getElementById('toolModal');
    const modalBox = modal.querySelector('.modal-box');
    const title   = document.getElementById('modalTitle');
    const content = document.getElementById('modalContent');
    activeToolRequest?.abort();
    const requestId = ++activeToolRequestId;
    activeToolRequest = new AbortController();
    if (!modal.classList.contains('flex')) toolModalReturnFocus = document.activeElement;
    const isEditorTool = toolId === 'edit_pdf' || toolId === 'sign_pdf' || toolId === 'tournament_bracket_generator';
    const isGameTool = toolId === 'memory_match_game';

    if (modalBox) {
        modalBox.classList.toggle('modal-box-editor', isEditorTool);
        modalBox.classList.toggle('modal-box-game', isGameTool);
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
    modal.querySelector('.modal-close')?.focus({ preventScroll: true });
    title.textContent = getToolName(toolId);
    const reportLink = document.getElementById('reportToolIssue');
    const reportUrl = new URL(@json(route('contact.show')), window.location.origin);
    reportUrl.searchParams.set('category', 'tool');
    if (toolSlugMap[toolId]) reportUrl.searchParams.set('tool', toolSlugMap[toolId]);
    if (reportLink) reportLink.href = reportUrl.pathname + reportUrl.search;
    document.body.style.overflow = 'hidden';

    fetch(`{{ route('tools.render') }}?tool=${encodeURIComponent(toolId)}`, { signal: activeToolRequest.signal })
        .then(r => {
            if (!r.ok) throw new Error('The tool could not be loaded. Please try again.');
            return r.text();
        })
        .then(html => {
            if (requestId !== activeToolRequestId || !modal.classList.contains('flex')) return;
            content.innerHTML = html;
            return ensureToolDependencies(toolId).then(() => {
                if (requestId === activeToolRequestId && modal.classList.contains('flex')) executeScripts(content);
            });
        })
        .catch(err => {
            if (err.name === 'AbortError' || requestId !== activeToolRequestId) return;
            content.innerHTML = `
                <div style="padding:32px;text-align:center;">
                    <div style="width:44px;height:44px;border-radius:12px;background:rgba(239,68,68,0.1);color:#F87171;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    </div>
                    <p style="font-size:0.88rem;color:#F87171;margin-bottom:4px;font-weight:600;">Failed to load tool</p>
                    <p style="font-size:0.78rem;color:var(--text-muted);">The tool could not be loaded. Please try again.</p>
                </div>`;
        });
}

function closeToolModal(event) {
    if (event && event.target !== event.currentTarget) return;
    if (window.any2convertInitialTool) {
        const currentUrl = new URL(window.location.href);
        let returnUrl = null;
        if (document.referrer) {
            try {
                const referrerUrl = new URL(document.referrer);
                if (referrerUrl.origin === currentUrl.origin && referrerUrl.href !== currentUrl.href) {
                    returnUrl = referrerUrl.href;
                }
            } catch (_) {
                returnUrl = null;
            }
        }
        window.location.assign(returnUrl || '/');
        return;
    }
    activeToolRequest?.abort();
    activeToolRequest = null;
    activeToolRequestId++;
    document.getElementById('toolModal').classList.remove('flex');
    const modalBox = document.querySelector('#toolModal .modal-box');
    if (modalBox) modalBox.classList.remove('modal-box-editor', 'modal-box-game');
    document.getElementById('modalContent').innerHTML = '';
    document.getElementById('modalContent').style.padding = '24px';
    document.body.style.overflow = '';
    if (toolModalReturnFocus instanceof HTMLElement && toolModalReturnFocus.isConnected) {
        toolModalReturnFocus.focus({ preventScroll: true });
    }
    toolModalReturnFocus = null;
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
        'compare_pdf':'Compare PDF','ai_summarizer':'PDF Summary Builder','pdf_to_pdfa':'PDF to PDF/A',
        'edit_pdf':'Edit PDF','redact_pdf':'Redact PDF','translate_pdf':'Translate PDF','word_to_pdf':'Word to PDF',
        'excel_to_pdf':'Excel to PDF','ppt_to_pdf':'PowerPoint to PDF','html_to_pdf':'HTML to PDF','json_to_csv':'JSON to CSV',
        'csv_to_json':'CSV to JSON','qr_generator':'QR Code Generator','password_gen':'Password Generator',
        'word_counter':'Word Counter','image_compressor':'Image Compressor','bg_remover':'Background Remover',
        'image_to_dxf':'Image to DXF','image_to_svg':'Image to SVG','resize_image':'Resize Image','image_enhancer':'Image Enhancer',
        'image_converter':'Image Converter','heic_converter':'HEIC to JPG PNG PDF','jpg_converter':'JPG to PNG JPEG PDF','webp_converter':'WEBP to PNG JPG JPEG PDF','video_to_audio':'Video to Audio','video_compressor':'Video Compressor','crop_image':'Crop Image','ai_image_generator':'Prompt Art Maker','ocr_tool':'OCR Tool',
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

// Keep keyboard users inside the active tool and return focus to its launcher.
document.addEventListener('keydown', e => {
    const modal = document.getElementById('toolModal');
    if (!modal?.classList.contains('flex')) return;
    if (e.key === 'Escape') {
        e.preventDefault();
        closeToolModal();
        return;
    }
    if (e.key !== 'Tab') return;
    const focusable = Array.from(modal.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'))
        .filter(element => element.getClientRects().length > 0);
    if (!focusable.length) {
        e.preventDefault();
        modal.focus();
        return;
    }
    const first = focusable[0];
    const last = focusable[focusable.length - 1];
    if (e.shiftKey && (document.activeElement === first || document.activeElement === modal)) {
        e.preventDefault();
        last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
        e.preventDefault();
        first.focus();
    }
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
</body>
</html>
