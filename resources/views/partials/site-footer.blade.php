<!-- ═══════════════════════════════ FOOTER ═══════════════════════════════ -->
<footer class="site-footer" style="border-top:1px solid var(--border);background:var(--bg-surface);">
    <div style="max-width:1280px;margin:0 auto;padding:48px 20px 32px;">

        <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:40px;margin-bottom:40px;" class="footer-grid">
            <div>
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                    <div style="width:28px;height:28px;background:var(--accent);border-radius:7px;display:flex;align-items:center;justify-content:center;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <span style="font-weight:700;font-size:0.95rem;color:var(--text-primary);">Any2Convert</span>
                </div>
                <p style="font-size:0.8rem;color:var(--text-muted);line-height:1.7;max-width:220px;">Practical online tools for files, documents, and everyday tasks.</p>
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
                    <a href="{{ route('contact.show', ['category' => 'tool']) }}" class="footer-link">Report a tool issue</a>
                    <a href="/privacy" class="footer-link">Privacy Policy</a>
                    <a href="/terms" class="footer-link">Terms</a>
                    @if (auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('admin.contact.index') }}" class="footer-link">Admin inbox</a>
                    @endif
                </div>
            </div>

            <div>
                <div style="font-size:0.75rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:14px;">Resources</div>
                <div style="display:flex;flex-direction:column;gap:9px;">
                    <a href="/blog" class="footer-link">Blog</a>
                    <a href="{{ route('community.index') }}" class="footer-link">Community feedback</a>
                </div>
            </div>
        </div>

        <div style="border-top:1px solid var(--border);padding-top:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
            <span style="font-size:0.78rem;color:var(--text-muted);">&copy; <?= date('Y') ?> Any2Convert. All rights reserved. Made with love in Karachi, Pakistan.</span>
            <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;color:var(--text-muted);">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Processing depends on the tool: in your browser or on our server
            </div>
        </div>

    </div>
</footer>
