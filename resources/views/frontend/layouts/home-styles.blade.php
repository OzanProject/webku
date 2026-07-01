/* ============================================================
   HOME PAGE STYLES (home.css)
   Semua style khusus halaman depan (homepage) dipusatkan di sini.
   ============================================================ */

/* ============================================================
   RESET & BASE
   ============================================================ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ============================================================
   CSS VARIABLES
   ============================================================ */
:root {
    --orange:       #f97316;
    --orange-dark:  #ea6d0e;
    --orange-light: #fff7ed;
    --orange-border:#fed7aa;
    --gray-900:     #111827;
    --gray-700:     #374151;
    --gray-500:     #6b7280;
    --gray-400:     #9ca3af;
    --gray-100:     #f3f4f6;
    --gray-50:      #f9fafb;
    --white:        #ffffff;
    --radius-sm:    8px;
    --radius-md:    12px;
    --radius-lg:    16px;
    --radius-xl:    20px;
    --radius-full:  100px;
    --shadow-sm:    0 1px 4px rgba(0,0,0,0.06);
    --shadow-md:    0 4px 16px rgba(0,0,0,0.08);
    --shadow-orange:0 8px 30px rgba(249,115,22,0.2);
    --transition:   all 0.2s ease;
    --container:    1280px;
}

/* ============================================================
   LAYOUT UTILITIES
   ============================================================ */
.hz-container {
    max-width: var(--container);
    margin: 0 auto;
    padding: 0 64px;
}
.hz-section { padding: 48px 0; }
.hz-section-sm { padding: 40px 0; }

.hz-section-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 48px;
    gap: 16px;
}
.hz-section-label {
    color: var(--orange);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    margin-bottom: 8px;
}
.hz-section-title {
    font-size: 30px;
    font-weight: 800;
    color: var(--gray-900);
    line-height: 1.25;
}
.hz-section-title-center {
    text-align: center;
    margin-bottom: 48px;
}
.hz-link-more {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--orange);
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    white-space: nowrap;
    transition: var(--transition);
    flex-shrink: 0;
}
.hz-link-more:hover { gap: 10px; }

/* ============================================================
   HERO SECTION
   ============================================================ */
.hz-hero {
    position: relative;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
}
.hz-hero::before {
    display: block;
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 1) 30%,
        rgba(255, 255, 255, 0.85) 60%,
        rgba(255, 255, 255, 0.4) 100%
    );
    z-index: 0;
}
.hz-hero-inner {
    position: relative;
    z-index: 1;
    max-width: var(--container);
    margin: 0 auto;
    width: 100%;
    padding: 72px 64px;
}
.hz-hero-content { max-width: 520px; }

.hz-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    border-radius: var(--radius-full);
    border: 1.5px solid var(--orange-border);
    background: var(--orange-light);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--orange);
    margin-bottom: 24px;
}
.hz-badge-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--orange);
    animation: blink 2s infinite;
}
@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.3; }
}

.hz-hero-title {
    font-size: 48px;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.025em;
    color: var(--gray-900);
    margin-bottom: 20px;
}
.hz-hero-sub {
    font-size: 15px;
    color: var(--gray-500);
    line-height: 1.75;
    margin-bottom: 36px;
    max-width: 420px;
}

.hz-ctas {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 48px;
}
.hz-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 28px;
    border-radius: var(--radius-full);
    background: var(--orange);
    color: var(--white);
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: var(--transition);
    box-shadow: var(--shadow-orange);
}
.hz-btn-primary:hover { background: var(--orange-dark); transform: translateY(-2px); color: var(--white); }
.hz-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 28px;
    border-radius: var(--radius-full);
    background: transparent;
    color: var(--gray-700);
    font-size: 14px;
    font-weight: 600;
    border: 1.5px solid #d1d5db;
    text-decoration: none;
    transition: var(--transition);
}
.hz-btn-outline:hover { border-color: var(--orange); color: var(--orange); }

.hz-stats {
    display: flex;
    align-items: center;
    gap: 32px;
    padding-top: 32px;
    border-top: 1px solid rgba(0,0,0,0.08);
    flex-wrap: wrap;
}
.hz-stat {
    display: flex;
    align-items: center;
    gap: 10px;
}
.hz-stat-icon {
    width: 40px; height: 40px;
    border-radius: var(--radius-sm);
    background: var(--orange-light);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.hz-stat-num { font-size: 16px; font-weight: 800; color: var(--gray-900); line-height: 1.2; }
.hz-stat-lbl { font-size: 10px; color: var(--gray-400); margin-top: 1px; }

/* ============================================================
   KATEGORI PRODUK
   ============================================================ */
.hz-cat-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 16px;
}
.hz-cat-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 24px 16px;
    border-radius: var(--radius-lg);
    border: 1.5px solid var(--gray-100);
    background: var(--white);
    text-decoration: none;
    transition: var(--transition);
    cursor: pointer;
}
.hz-cat-card:hover {
    border-color: var(--orange-border);
    background: var(--orange-light);
    transform: translateY(-3px);
    box-shadow: var(--shadow-orange);
}
.hz-cat-icon {
    width: 56px; height: 56px;
    border-radius: var(--radius-md);
    background: var(--orange-light);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
    transition: var(--transition);
}
.hz-cat-card:hover .hz-cat-icon { background: var(--orange); }
.hz-cat-card:hover .hz-cat-icon span { color: var(--white); }
.hz-cat-title { font-weight: 700; color: var(--gray-900); font-size: 13px; margin-bottom: 6px; }
.hz-cat-desc { color: var(--gray-400); font-size: 11px; line-height: 1.6; }

/* ============================================================
   PRODUK TERPOPULER
   ============================================================ */
.hz-prod-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
}
.hz-prod-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1.5px solid var(--gray-100);
    transition: all 0.25s ease;
    cursor: pointer;
    display: flex;
    flex-direction: column;
}
.hz-prod-card:hover {
    border-color: var(--orange-border);
    box-shadow: 0 12px 40px rgba(249,115,22,0.15);
    transform: translateY(-4px);
}
.hz-prod-img {
    position: relative;
    aspect-ratio: 16/10;
    overflow: hidden;
    background: var(--gray-100);
}
.hz-prod-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.hz-prod-card:hover .hz-prod-img img { transform: scale(1.06); }
.hz-prod-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.55);
    opacity: 0;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.hz-prod-card:hover .hz-prod-overlay { opacity: 1; }
.hz-prod-overlay a {
    font-size: 11px;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: var(--radius-sm);
    text-decoration: none;
    transition: var(--transition);
}
.hz-prod-overlay .btn-demo { background: rgba(255,255,255,0.95); color: var(--gray-900); }
.hz-prod-overlay .btn-demo:hover { background: var(--orange); color: var(--white); }
.hz-prod-overlay .btn-detail { background: var(--orange); color: var(--white); }
.hz-prod-overlay .btn-detail:hover { background: var(--orange-dark); }
.hz-prod-badge {
    position: absolute;
    top: 10px; left: 10px;
    color: var(--white);
    font-size: 10px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: var(--radius-full);
    letter-spacing: 0.03em;
}
.hz-prod-body {
    padding: 16px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.hz-prod-name {
    font-weight: 700;
    color: var(--gray-900);
    font-size: 13px;
    margin-bottom: 5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.4;
}
.hz-prod-desc {
    color: var(--gray-500);
    font-size: 11px;
    margin-bottom: 10px;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.hz-prod-tags { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 10px; }
.hz-prod-tag {
    font-size: 10px;
    color: var(--gray-500);
    background: var(--gray-100);
    border-radius: var(--radius-full);
    padding: 2px 8px;
}
.hz-prod-footer {
    display: flex;
    align-items: center;
    padding-top: 12px;
    margin-top: auto;
    border-top: 1px solid var(--gray-100);
}
.hz-prod-cta {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    width: 100%;
    padding: 8px 14px;
    border-radius: var(--radius-sm);
    background: var(--orange-light);
    border: 1px solid var(--orange-border);
    color: var(--orange);
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    transition: var(--transition);
}
.hz-prod-cta:hover { background: var(--orange); color: var(--white); border-color: var(--orange); }
.hz-prod-link {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 600;
    color: var(--orange);
    text-decoration: none;
    transition: var(--transition);
    white-space: nowrap;
    flex-shrink: 0;
    margin-left: auto;
}
.hz-prod-link:hover { gap: 7px; }

/* ============================================================
   KENAPA MEMILIH KAMI
   ============================================================ */
.hz-why-wrap {
    background: var(--gray-900);
    border-radius: var(--radius-xl);
    padding: 48px;
    position: relative;
    overflow: hidden;
}
.hz-why-wrap::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 240px; height: 240px;
    background: radial-gradient(circle, rgba(249,115,22,0.15) 0%, transparent 70%);
    pointer-events: none;
}
.hz-why-wrap::after {
    content: '';
    position: absolute;
    bottom: -40px; left: -40px;
    width: 180px; height: 180px;
    background: radial-gradient(circle, rgba(249,115,22,0.08) 0%, transparent 70%);
    pointer-events: none;
}
.hz-why-grid {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    gap: 32px;
    position: relative;
    z-index: 1;
    padding-bottom: 16px;
    -ms-overflow-style: none; scrollbar-width: none;
}
.hz-why-grid::-webkit-scrollbar { display: none; }
.hz-why-item { display: flex; flex-direction: column; gap: 14px; flex: 0 0 85%; max-width: 250px; scroll-snap-align: center; }
.hz-why-icon {
    width: 48px; height: 48px;
    border-radius: var(--radius-md);
    background: rgba(249,115,22,0.15);
    border: 1px solid rgba(249,115,22,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.hz-why-title { font-weight: 700; color: #f9fafb; font-size: 13px; margin-bottom: 4px; }
.hz-why-desc { color: #9ca3af; font-size: 11px; line-height: 1.7; }

/* ============================================================
   PROSES PEMBELIAN
   ============================================================ */
.hz-steps-wrap { position: relative; }
.hz-steps-line {
    position: absolute;
    top: 56px; left: 10%; right: 10%;
    height: 2px;
    border-top: 2px dashed var(--orange-border);
    z-index: 0;
}
.hz-steps-grid {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    gap: 32px;
    position: relative;
    z-index: 1;
    padding-bottom: 16px;
    -ms-overflow-style: none; scrollbar-width: none;
}
.hz-steps-grid::-webkit-scrollbar { display: none; }
.hz-step { display: flex; flex-direction: column; align-items: center; text-align: center; flex: 0 0 85%; max-width: 250px; scroll-snap-align: center; }
.hz-step-icon {
    position: relative;
    width: 64px; height: 64px;
    border-radius: var(--radius-md);
    background: var(--white);
    border: 2px solid var(--orange-border);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-sm);
    margin-bottom: 16px;
    z-index: 2;
}
.hz-step-num {
    position: absolute;
    top: -10px; right: -10px;
    width: 26px; height: 26px;
    background: var(--orange);
    color: var(--white);
    font-size: 12px;
    font-weight: 700;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    border: 3px solid #ffffff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    z-index: 3;
}
.hz-step-title { font-weight: 700; color: var(--gray-900); font-size: 13px; margin-bottom: 6px; }
.hz-step-desc { color: var(--gray-400); font-size: 11px; line-height: 1.6; }

/* ============================================================
   TESTIMONIAL
   ============================================================ */
.hz-testi-card {
    height: 100%;
    background: var(--white);
    border: 1.5px solid var(--gray-100);
    border-radius: var(--radius-lg);
    padding: 28px;
    transition: var(--transition);
    position: relative;
    display: flex;
    flex-direction: column;
}
.hz-testi-card:hover { border-color: var(--orange-border); box-shadow: var(--shadow-md); }
.hz-testi-quote-mark {
    position: absolute;
    top: 20px;
    right: 24px;
    font-size: 64px;
    line-height: 1;
    color: var(--orange-border);
    font-family: Georgia, serif;
    font-weight: 700;
    pointer-events: none;
    user-select: none;
}
.hz-testi-stars { display: flex; gap: 3px; margin-bottom: 14px; }
.hz-testi-msg {
    color: #374151;
    font-size: 13px;
    line-height: 1.75;
    margin-bottom: 20px;
    flex: 1;
    font-style: italic;
}
.hz-testi-product {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 10px;
    font-weight: 600;
    color: var(--orange);
    background: var(--orange-light);
    border: 1px solid var(--orange-border);
    border-radius: var(--radius-full);
    padding: 3px 10px;
    margin-bottom: 16px;
    width: fit-content;
}
.hz-testi-divider { height: 1px; background: var(--gray-100); margin-bottom: 16px; }
.hz-testi-user { display: flex; align-items: center; gap: 12px; }
.hz-testi-avatar {
    width: 40px; height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fb923c, #ea580c);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-weight: 700;
    font-size: 14px;
    flex-shrink: 0;
}
.hz-testi-name { font-weight: 700; color: var(--gray-900); font-size: 13px; }
.hz-testi-meta { display: flex; align-items: center; gap: 6px; }
.hz-testi-role { font-size: 11px; color: var(--gray-400); }
.hz-testi-date { font-size: 10px; color: var(--gray-400); }

.hz-slider::-webkit-scrollbar { display: none; }
.hz-slider { -ms-overflow-style: none; scrollbar-width: none; }

/* ============================================================
   CTA BANNER
   ============================================================ */
.hz-cta-section {
    padding: 80px 0;
    position: relative;
    overflow: hidden;
    background-image: url('https://khalimzone.com/assets/images/cta.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-color: var(--orange);
}
.hz-cta-circle-1 {
    position: absolute; top: 0; right: 0;
    width: 384px; height: 384px;
    background: rgba(255,255,255,0.06);
    border-radius: 50%;
    transform: translate(50%, -50%);
    z-index: 0;
}
.hz-cta-circle-2 {
    position: absolute; bottom: 0; left: 0;
    width: 256px; height: 256px;
    background: rgba(0,0,0,0.06);
    border-radius: 50%;
    transform: translate(-50%, 50%);
    z-index: 0;
}
.hz-cta-inner {
    position: relative;
    z-index: 1;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 32px;
}
.hz-cta-title { font-size: 32px; font-weight: 800; color: var(--white); margin-bottom: 8px; }
.hz-cta-sub { color: #ffedd5; font-size: 16px; }
.hz-btn-wa {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--white);
    color: var(--orange);
    font-weight: 700;
    font-size: 13px;
    padding: 12px 24px;
    border-radius: var(--radius-full);
    text-decoration: none;
    white-space: nowrap;
    box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    transition: var(--transition);
    width: fit-content;
}
.hz-btn-wa:hover {
    background: #fff7ed;
    transform: translateY(-2px);
    color: var(--orange);
}

/* ============================================================
   RESPONSIVE — TABLET (≤1024px)
   ============================================================ */
@media (max-width: 1024px) {
    .hz-container { padding: 0 32px; }
    .hz-hero-inner { padding: 56px 32px; }
    .hz-hero-title { font-size: 38px; }
    .hz-cat-grid { grid-template-columns: repeat(3, 1fr); }
    .hz-prod-grid { grid-template-columns: repeat(3, 1fr); }
    .hz-steps-line { display: none; }
    .hz-section-title { font-size: 26px; }
    .hz-cta-title { font-size: 26px; }
}

/* ============================================================
   RESPONSIVE — MOBILE (≤768px)
   ============================================================ */
@media (max-width: 768px) {
    .hz-container { padding: 0 20px; }
    .hz-section { padding: 32px 0; }
    .hz-section-sm { padding: 24px 0; }
    .hz-hero { min-height: auto; background-position: right center; }
    .hz-hero-inner { padding: 48px 20px 40px; }
    .hz-hero-title { font-size: 30px; }
    .hz-hero-sub { font-size: 14px; }
    .hz-stats { gap: 16px; }
    .hz-stat-num { font-size: 14px; }
    .hz-section-header { flex-direction: column; align-items: flex-start; margin-bottom: 32px; }
    .hz-section-title { font-size: 22px; }
    .hz-cat-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
    .hz-cat-card { padding: 18px 12px; }
    .hz-cat-icon { width: 48px; height: 48px; }
    .hz-prod-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
    .hz-why-wrap { padding: 28px 20px; }
    .hz-cta-inner { flex-direction: column; align-items: flex-start; }
    .hz-cta-title { font-size: 22px; }
    .hz-cta-sub { font-size: 14px; }
    .hz-btn-wa { width: auto; }
}

/* ============================================================
   RESPONSIVE — SMALL MOBILE (≤480px)
   ============================================================ */
@media (max-width: 480px) {
    .hz-hero-title { font-size: 26px; }
    .hz-ctas { flex-direction: column; }
    .hz-btn-primary, .hz-btn-outline { justify-content: center; }
    .hz-cat-grid { grid-template-columns: repeat(2, 1fr); }
    .hz-prod-grid { grid-template-columns: 1fr; }
    .hz-step { align-items: flex-start; text-align: left; flex-direction: row; gap: 16px; flex: 0 0 90%; }
    .hz-why-item { flex: 0 0 90%; }
    .hz-step-icon { flex-shrink: 0; margin-bottom: 0; }
}
