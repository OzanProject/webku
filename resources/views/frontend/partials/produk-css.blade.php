<style>
/* ============================================================
   RESET & VARIABLES
   ============================================================ */
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
   HERO SECTION
   ============================================================ */
.pr-hero {
    position: relative;
    background-color: #f8fafc;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
    padding-top: 100px; /* Offset for navbar */
}
.pr-hero-inner {
    max-width: var(--container);
    margin: 0 auto;
    padding: 72px 64px;
    position: relative;
    z-index: 1;
}
.pr-hero-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--orange);
    margin-bottom: 12px;
}
.pr-hero-title {
    font-size: 40px;
    font-weight: 800;
    color: var(--gray-900);
    line-height: 1.15;
    letter-spacing: -0.02em;
    margin-bottom: 16px;
}
.pr-hero-sub {
    font-size: 15px;
    color: var(--gray-500);
    line-height: 1.7;
    max-width: 420px;
    margin-bottom: 32px;
}
.pr-hero-search {
    display: flex;
    gap: 0;
    max-width: 440px;
}
.pr-hero-search input {
    flex: 1;
    padding: 14px 20px;
    border: 1.5px solid var(--orange-border);
    border-right: none;
    border-radius: var(--radius-full) 0 0 var(--radius-full);
    font-size: 14px;
    outline: none;
    background: var(--white);
    color: var(--gray-900);
    transition: var(--transition);
}
.pr-hero-search input:focus { border-color: var(--orange); }
.pr-hero-search input::placeholder { color: var(--gray-400); }
.pr-hero-search button {
    padding: 14px 24px;
    background: var(--orange);
    color: var(--white);
    font-weight: 700;
    font-size: 14px;
    border: none;
    border-radius: 0 var(--radius-full) var(--radius-full) 0;
    cursor: pointer;
    transition: var(--transition);
}
.pr-hero-search button:hover { background: var(--orange-dark); }
.pr-hero-badges {
    display: flex;
    gap: 20px;
    margin-top: 24px;
    flex-wrap: wrap;
}
.pr-hero-badge {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: var(--gray-500);
    font-weight: 500;
}
.pr-hero-badge svg { color: var(--orange); }

/* ============================================================
   CATEGORY TABS
   ============================================================ */
.pr-tabs-wrap {
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-bottom: 1.5px solid rgba(229,231,235,0.7);
    position: sticky;
    top: 64px; /* sticky below navbar */
    z-index: 10;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
}
.pr-tabs-inner {
    max-width: var(--container);
    margin: 0 auto;
    padding: 0 64px;
    display: flex;
    align-items: center;
    gap: 4px;
    overflow-x: auto;
    scrollbar-width: none;
}
.pr-tabs-inner::-webkit-scrollbar { display: none; }
.pr-tab {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 18px 22px;
    font-size: 13px;
    font-weight: 600;
    color: var(--gray-500);
    text-decoration: none;
    border-bottom: 2.5px solid transparent;
    white-space: nowrap;
    transition: color 0.25s ease, border-color 0.25s ease;
    cursor: pointer;
    position: relative;
}
.pr-tab::after {
    content: '';
    position: absolute;
    bottom: -1.5px;
    left: 50%;
    right: 50%;
    height: 2.5px;
    background: var(--orange);
    transition: left 0.25s ease, right 0.25s ease;
    border-radius: 2px 2px 0 0;
}
.pr-tab:hover { color: var(--orange); }
.pr-tab:hover::after { left: 0; right: 0; }
.pr-tab.active { color: var(--orange); border-bottom-color: transparent; }
.pr-tab.active::after { left: 0; right: 0; }
.pr-tab-count {
    font-size: 10px;
    font-weight: 700;
    background: var(--gray-100);
    color: var(--gray-500);
    padding: 2px 7px;
    border-radius: var(--radius-full);
}
.pr-tab.active .pr-tab-count { background: var(--orange-light); color: var(--orange); }

/* ============================================================
   MAIN LAYOUT
   ============================================================ */
.pr-main {
    max-width: var(--container);
    margin: 0 auto;
    padding: 40px 64px;
    display: grid;
    grid-template-columns: 220px 1fr;
    gap: 32px;
    align-items: start;
}

/* ============================================================
   SIDEBAR
   ============================================================ */
.pr-sidebar {
    position: sticky;
    top: 150px;
}
.pr-sidebar-section {
    margin-bottom: 28px;
    background: var(--white);
    border-radius: var(--radius-lg);
    border: 1.5px solid var(--gray-100);
    padding: 18px;
}
.pr-sidebar-title {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--orange);
    margin-bottom: 14px;
}
.pr-sidebar-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 7px 0;
    border-bottom: 1px solid var(--gray-50);
    cursor: pointer;
    transition: background 0.15s ease;
    border-radius: 6px;
}
.pr-sidebar-item:last-child { border-bottom: none; }
.pr-sidebar-item label {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: var(--gray-700);
    cursor: pointer;
    flex: 1;
}
.pr-sidebar-item input[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    width: 16px;
    height: 16px;
    border: 2px solid var(--gray-400);
    border-radius: 50%;
    flex-shrink: 0;
    transition: border-color 0.2s ease, background 0.2s ease;
    position: relative;
    cursor: pointer;
}
.pr-sidebar-item input[type="radio"]:checked {
    border-color: var(--orange);
    background: var(--orange);
    box-shadow: inset 0 0 0 3px var(--white), 0 0 0 2px var(--orange);
}
.pr-sidebar-item input[type="radio"]:hover { border-color: var(--orange); }

/* ============================================================
   PRODUCT AREA
   ============================================================ */
.pr-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    gap: 16px;
    flex-wrap: wrap;
}
.pr-topbar-info { font-size: 13px; color: var(--gray-500); }
.pr-topbar-info strong { color: var(--gray-900); }
.pr-sort {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--gray-500);
}
.pr-sort select {
    padding: 8px 14px;
    border: 1.5px solid var(--gray-200);
    border-radius: var(--radius-md);
    font-size: 13px;
    color: var(--gray-700);
    outline: none;
    cursor: pointer;
    transition: var(--transition);
    background: var(--white);
    min-width: 120px;
}
.pr-sort select:hover { border-color: var(--orange-border); }
.pr-sort select:focus { border-color: var(--orange); }

/* ============================================================
   PRODUCT GRID
   ============================================================ */
.pr-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
.pr-card {
    background: var(--white);
    border: 1.5px solid var(--gray-100);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
    cursor: pointer;
    position: relative;
}
.pr-card:hover {
    border-color: var(--orange-border);
    box-shadow: 0 12px 40px rgba(249,115,22,0.15), 0 2px 8px rgba(0,0,0,0.04);
    transform: translateY(-5px);
}
.pr-card-img {
    position: relative;
    aspect-ratio: 16/9;
    overflow: hidden;
    background: var(--gray-100);
}
.pr-card-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
.pr-card:hover .pr-card-img img { transform: scale(1.08); }
.pr-card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    gap: 8px;
    padding-bottom: 20px;
}
.pr-card:hover .pr-card-overlay { opacity: 1; }
.pr-card-overlay a {
    font-size: 12px;
    font-weight: 700;
    padding: 10px 20px;
    border-radius: var(--radius-full);
    text-decoration: none;
    transition: all 0.2s ease;
    transform: translateY(8px);
}
.pr-card:hover .pr-card-overlay a { transform: translateY(0); transition: transform 0.3s ease 0.05s, background 0.2s ease, color 0.2s ease; }
.pr-card-overlay .btn-detail { background: var(--orange); color: var(--white); }
.pr-card-overlay .btn-detail:hover { background: var(--orange-dark); transform: translateY(-2px) !important; }
.pr-card-cat {
    position: absolute;
    top: 10px; left: 10px;
    background: var(--orange);
    color: var(--white);
    font-size: 10px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: var(--radius-full);
}
.pr-card-body { padding: 20px; }
.pr-card-name {
    font-weight: 700;
    color: var(--gray-900);
    font-size: 15px;
    margin-bottom: 8px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.pr-card-desc {
    color: var(--gray-400);
    font-size: 12px;
    line-height: 1.5;
    margin-bottom: 14px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.pr-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid var(--gray-100);
    margin-top: 4px;
}
.pr-card-price-cta {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 700;
    color: var(--white);
    background: var(--orange);
    padding: 5px 12px;
    border-radius: var(--radius-full);
    text-decoration: none;
    transition: var(--transition);
}
.pr-card-price-cta:hover { background: var(--orange-dark); transform: translateY(-1px); }
.pr-card-cta-mini {
    font-size: 11px;
    font-weight: 700;
    color: var(--orange);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 4px;
    opacity: 0;
    transform: translateX(-4px);
    transition: opacity 0.25s ease, transform 0.25s ease;
}
.pr-card:hover .pr-card-cta-mini { opacity: 1; transform: translateX(0); }

/* ============================================================
   EMPTY STATE
   ============================================================ */
.pr-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
}
.pr-empty-icon {
    width: 64px; height: 64px;
    background: var(--gray-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
}
.pr-empty-title { font-weight: 700; color: var(--gray-900); font-size: 16px; margin-bottom: 8px; }
.pr-empty-sub { color: var(--gray-400); font-size: 13px; }

/* ============================================================
   LOAD MORE / PAGINATION
   ============================================================ */
.pr-pagination {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}

@media (max-width: 1024px) {
    .pr-hero-inner { padding: 0 32px 40px; }
    .pr-tabs-inner { padding: 0 32px; }
    .pr-main { padding: 32px; grid-template-columns: 200px 1fr; }
    .pr-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .pr-hero-inner { padding: 32px 16px; }
    .pr-tabs-inner { padding: 0 16px; }
    .pr-main { padding: 16px; grid-template-columns: 1fr; gap: 16px; }
    .pr-sidebar { position: static; width: 100%; }
    .pr-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
}
@media (max-width: 480px) {
    .pr-grid { grid-template-columns: 1fr; gap: 12px; }
}
</style>
