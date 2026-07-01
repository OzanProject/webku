/* ============================================================
   RESET & VARIABLES — selaras dengan blog & home
   ============================================================ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --orange:        #f97316;
    --orange-dark:   #ea6d0e;
    --orange-light:  #fff7ed;
    --orange-border: #fed7aa;
    --gray-900:      #111827;
    --gray-700:      #374151;
    --gray-500:      #6b7280;
    --gray-400:      #9ca3af;
    --gray-100:      #f3f4f6;
    --gray-50:       #f9fafb;
    --white:         #ffffff;
    --radius-sm:     8px;
    --radius-md:     12px;
    --radius-lg:     16px;
    --radius-xl:     20px;
    --radius-full:   100px;
    --shadow-sm:     0 1px 4px rgba(0,0,0,0.06);
    --shadow-md:     0 4px 16px rgba(0,0,0,0.08);
    --shadow-orange: 0 8px 30px rgba(249,115,22,0.2);
    --transition:    all 0.2s ease;
    --container:     1280px;
}

/* ============================================================
   HERO — identik dengan blog
   ============================================================ */
.pf-hero {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    overflow: hidden;
}
.pf-hero-inner {
    max-width: var(--container);
    margin: 0 auto;
    padding: 120px 64px 140px;
    position: relative;
    z-index: 1;
}
.pf-hero-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--orange);
    margin-bottom: 12px;
}
.pf-hero-title {
    font-size: 40px;
    font-weight: 800;
    color: var(--gray-900);
    line-height: 1.15;
    letter-spacing: -0.02em;
    margin-bottom: 16px;
}
.pf-hero-sub {
    font-size: 15px;
    color: var(--gray-500);
    line-height: 1.7;
    max-width: 460px;
    margin-bottom: 32px;
}
.pf-hero-stats {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
}
.pf-hero-stat {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: var(--gray-500);
    font-weight: 500;
}
.pf-hero-stat svg { color: var(--orange); }

/* ============================================================
   CATEGORY TABS — identik dengan blog
   ============================================================ */
.pf-tabs-wrap {
    background: var(--white);
    border-bottom: 1.5px solid var(--gray-100);
    position: sticky;
    top: 64px;
    z-index: 100;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
@media (max-width: 768px) {
    .pf-tabs-wrap { top: 60px; }
}
.pf-tabs-inner {
    max-width: var(--container);
    margin: 0 auto;
    padding: 0 64px;
    display: flex;
    align-items: center;
    gap: 2px;
    overflow-x: auto;
    scrollbar-width: none;
}
.pf-tabs-inner::-webkit-scrollbar { display: none; }
.pf-tab {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 15px 18px;
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-500);
    text-decoration: none;
    border-bottom: 2.5px solid transparent;
    white-space: nowrap;
    transition: var(--transition);
}
.pf-tab:hover { color: var(--gray-900); }
.pf-tab.active { color: var(--orange); border-bottom-color: var(--orange); }
.pf-tab-count {
    font-size: 10px;
    font-weight: 700;
    background: var(--gray-100);
    color: var(--gray-500);
    padding: 2px 7px;
    border-radius: var(--radius-full);
}
.pf-tab.active .pf-tab-count { background: var(--orange-light); color: var(--orange); }

/* ============================================================
   MAIN SECTION
   ============================================================ */
.pf-main {
    max-width: var(--container);
    margin: 0 auto;
    padding: 52px 64px;
}

/* Topbar info */
.pf-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 32px;
    gap: 12px;
    flex-wrap: wrap;
}
.pf-topbar-info {
    font-size: 13px;
    color: var(--gray-500);
}
.pf-topbar-info strong { color: var(--gray-900); font-weight: 700; }

/* ============================================================
   PORTFOLIO GRID
   ============================================================ */
.pf-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.pf-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.04);
    box-shadow: var(--shadow-sm);
    transition: all 0.25s ease;
    display: flex;
    flex-direction: column;
}
.pf-card:hover {
    border-color: var(--orange-border);
    box-shadow: 0 8px 28px rgba(0,0,0,0.1);
    transform: translateY(-4px);
}

/* Image area */
.pf-card-img {
    position: relative;
    aspect-ratio: 16/10;
    overflow: hidden;
    background: var(--gray-100);
}
.pf-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.45s ease;
}
.pf-card:hover .pf-card-img img { transform: scale(1.07); }

/* Category badge */
.pf-card-cat {
    position: absolute;
    top: 10px;
    left: 10px;
    background: var(--orange);
    color: var(--white);
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    padding: 3px 10px;
    border-radius: var(--radius-full);
    box-shadow: 0 2px 8px rgba(249,115,22,0.35);
    z-index: 1;
}

/* Hover overlay */
.pf-card-overlay {
    position: absolute;
    inset: 0;
    background: rgba(17,24,39,0.6);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.pf-card:hover .pf-card-overlay { opacity: 1; }
.pf-overlay-btn {
    font-size: 12px;
    font-weight: 700;
    padding: 9px 18px;
    border-radius: var(--radius-sm);
    text-decoration: none;
    transition: var(--transition);
    white-space: nowrap;
}
.pf-overlay-btn.primary {
    background: var(--orange);
    color: var(--white);
}
.pf-overlay-btn.primary:hover { background: var(--orange-dark); }
.pf-overlay-btn.secondary {
    background: var(--white);
    color: var(--gray-900);
}
.pf-overlay-btn.secondary:hover { background: var(--orange); color: var(--white); }

/* Card body */
.pf-card-body {
    padding: 18px 20px 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.pf-card-title {
    font-size: 14.5px;
    font-weight: 700;
    color: var(--gray-900);
    line-height: 1.4;
    margin-bottom: 8px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    transition: color 0.2s ease;
}
.pf-card:hover .pf-card-title { color: var(--orange); }
.pf-card-desc {
    font-size: 12.5px;
    color: var(--gray-500);
    line-height: 1.65;
    margin-bottom: 14px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Tech tags */
.pf-card-tags {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin-bottom: 14px;
}
.pf-card-tag {
    font-size: 10px;
    color: var(--gray-500);
    background: var(--gray-100);
    border-radius: var(--radius-full);
    padding: 3px 10px;
    font-weight: 500;
}

/* Card footer */
.pf-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 12px;
    border-top: 1px solid var(--gray-100);
    gap: 8px;
}
.pf-card-meta {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    color: var(--gray-400);
}
.pf-card-link {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 700;
    color: var(--orange);
    text-decoration: none;
    transition: gap 0.2s ease;
}
.pf-card:hover .pf-card-link { gap: 7px; }

/* ============================================================
   EMPTY STATE
   ============================================================ */
.pf-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 24px;
}
.pf-empty-icon {
    width: 72px;
    height: 72px;
    background: var(--gray-100);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}
.pf-empty-title { font-size: 16px; font-weight: 700; color: var(--gray-700); margin-bottom: 8px; }
.pf-empty-sub   { font-size: 13px; color: var(--gray-400); }

/* ============================================================
   CTA BOTTOM — selaras dengan blog
   ============================================================ */
.pf-cta {
    background: linear-gradient(135deg, #ea580c 0%, var(--orange) 50%, #fb923c 100%);
    padding: 64px 0;
    position: relative;
    overflow: hidden;
}
.pf-cta::before {
    content: '';
    position: absolute;
    top: -60px; right: 10%;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: rgba(255,255,255,0.06);
    pointer-events: none;
}
.pf-cta::after {
    content: '';
    position: absolute;
    bottom: -80px; left: 5%;
    width: 280px; height: 280px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    pointer-events: none;
}
.pf-cta-inner {
    max-width: var(--container);
    margin: 0 auto;
    padding: 0 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
    flex-wrap: wrap;
    position: relative;
    z-index: 1;
}
.pf-cta-label {
    font-size: 10px;
    font-weight: 800;
    color: rgba(255,255,255,0.7);
    text-transform: uppercase;
    letter-spacing: 0.12em;
    margin-bottom: 6px;
}
.pf-cta-title {
    font-size: 28px;
    font-weight: 800;
    color: var(--white);
    margin-bottom: 8px;
    line-height: 1.2;
    letter-spacing: -0.01em;
}
.pf-cta-sub {
    font-size: 14px;
    color: rgba(255,255,255,0.8);
    line-height: 1.65;
    max-width: 440px;
}
.pf-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 30px;
    background: var(--white);
    color: var(--orange);
    border-radius: var(--radius-full);
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
    transition: all 0.25s ease;
    box-shadow: 0 4px 24px rgba(0,0,0,0.18);
}
.pf-cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 36px rgba(0,0,0,0.22);
    color: var(--orange);
}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 1024px) {
    .pf-hero-inner, .pf-main, .pf-cta-inner { padding-left: 32px; padding-right: 32px; }
    .pf-tabs-inner { padding: 0 32px; }
    .pf-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    .pf-hero-inner { padding: 40px 20px; }
    .pf-hero-title { font-size: 28px; }
    .pf-main { padding: 28px 20px; }
    .pf-tabs-inner { padding: 0 20px; }
    .pf-grid { grid-template-columns: 1fr; }
    .pf-cta-inner { padding: 0 20px; flex-direction: column; text-align: center; }
    .pf-cta-sub { max-width: 100%; }
    .pf-cta-title { font-size: 22px; }
}
