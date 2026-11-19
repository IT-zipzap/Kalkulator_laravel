<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIPZAP - Kalkulator Harga Produk Konveksi</title>
    
    <!-- Google Fonts: Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ── RESET & DESIGN TOKENS (UI-STYLING / SHADCN-INSPIRED) ── */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg-canvas: #F8FAFC;
            --surface: #FFFFFF;
            --surface-subtle: #F8FAFC;
            --surface-muted: #F1F5F9;
            --surface-hover: #F8FAFC;
            --border: #E2E8F0;
            --border-hover: #CBD5E1;
            --border-focus: #0F766E;

            /* Slate Neutral Base */
            --primary: #0F172A;
            --primary-hover: #1E293B;
            --primary-soft: #F1F5F9;

            /* Emerald Accent */
            --accent: #0F766E;
            --accent-hover: #115E59;
            --accent-soft: #F0FDF4;
            --accent-border: #BBF7D0;
            --accent-text: #166534;

            /* Text Colors */
            --text-heading: #0F172A;
            --text-body: #334155;
            --text-muted: #64748B;
            --text-subtle: #94A3B8;

            /* Radius Tokens */
            --radius-lg: 12px;
            --radius-md: 8px;
            --radius-sm: 6px;

            /* Elevation */
            --shadow-card: 0 1px 3px 0 rgba(15, 23, 42, 0.04), 0 4px 12px -2px rgba(15, 23, 42, 0.03);
            
            --font-sans: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            --font-mono: 'JetBrains Mono', ui-monospace, SFMono-Regular, monospace;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--bg-canvas);
            color: var(--text-body);
            line-height: 1.5;
            padding: 24px 20px 48px;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        .tabular-nums {
            font-variant-numeric: tabular-nums;
            font-family: var(--font-mono);
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
        }

        /* ── HEADER ── */
        .app-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 16px;
        }

        .brand-cluster {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-badge {
            background: var(--primary);
            color: #FFFFFF;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.05em;
            padding: 5px 12px;
            border-radius: var(--radius-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .brand-title-wrap h1 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-heading);
            letter-spacing: -0.015em;
        }

        .brand-title-wrap p {
            font-size: 13px;
            color: var(--text-muted);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ── ASYMMETRIC 2-COLUMN GRID ── */
        .layout-grid {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 24px;
            align-items: start;
        }

        @media (max-width: 980px) {
            .layout-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── CARD SURFACES ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .card:last-child {
            margin-bottom: 0;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #FFFFFF;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-number {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            background: var(--surface-muted);
            border: 1px solid var(--border);
            width: 22px;
            height: 22px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-mono);
        }

        .card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-heading);
        }

        .card-badge-status {
            font-size: 11px;
            font-weight: 600;
            font-family: var(--font-mono);
            padding: 3px 8px;
            border-radius: 999px;
            background: var(--surface-muted);
            color: var(--text-muted);
            border: 1px solid var(--border);
        }

        .card-badge-status.active {
            background: var(--accent-soft);
            color: var(--accent-text);
            border-color: var(--accent-border);
        }

        .card-body {
            padding: 20px;
        }

        /* ── FORM CONTROLS ── */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-heading);
            margin-bottom: 6px;
        }

        .form-label .sub-price {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--accent);
            font-weight: 600;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 10px 12px;
            font-size: 13px;
            font-family: var(--font-sans);
            color: var(--text-heading);
            background-color: #FFFFFF;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .form-input::placeholder {
            color: var(--text-subtle);
        }

        .form-input:focus, .form-select:focus {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.12);
        }

        .form-select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748B'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px 16px;
            padding-right: 36px;
        }

        /* ── RECEIPT BREAKDOWN (CARD 2) ── */
        .receipt-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .receipt-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12.5px;
        }

        .receipt-label {
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .receipt-chip {
            background: var(--surface-muted);
            border: 1px solid var(--border);
            color: var(--text-heading);
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
        }

        .receipt-val {
            font-weight: 600;
            color: var(--text-heading);
        }

        .receipt-divider {
            border: none;
            border-top: 1px dashed var(--border);
            margin: 6px 0;
        }

        .receipt-summary-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 6px;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-heading);
        }

        .receipt-summary-row .price {
            color: var(--accent);
            font-size: 14px;
        }

        
        .table-wrap {
            overflow-x: auto;
            position: relative;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            text-align: left;
        }

        .order-table thead th {
            padding: 12px 18px;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border-bottom: 1.5px solid var(--border);
            background: #FAFAFA;
            white-space: nowrap;
        }

        .order-table tbody td {
            padding: 12px 18px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            white-space: nowrap;
            transition: background-color 0.15s ease, border-color 0.15s ease;
        }

        .order-table tbody tr {
            transition: all 0.15s ease;
        }

        .order-table tbody tr:hover td {
            background-color: #F8FAFC;
        }

        /* Active row state when quantity > 0 */
        .order-table tbody tr.row-active td {
            background-color: #F0FDF4;
        }

        .order-table tbody tr.row-active td:first-child {
            box-shadow: inset 3px 0 0 var(--accent);
        }

        .size-chip {
            width: 34px;
            height: 34px;
            border-radius: var(--radius-sm);
            background: #FFFFFF;
            border: 1.5px solid var(--border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 13px;
            color: var(--text-heading);
            font-family: var(--font-mono);
            transition: all 0.15s ease;
        }

        .order-table tbody tr.row-active .size-chip {
            background: var(--accent);
            color: #FFFFFF;
            border-color: var(--accent);
        }

        .extra-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-family: var(--font-mono);
            padding: 2px 8px;
            border-radius: 999px;
            font-weight: 600;
        }

        .extra-badge.zero {
            background: transparent;
            color: var(--text-subtle);
            border: 1px solid transparent;
        }

        .extra-badge.premium {
            background: var(--surface-muted);
            color: var(--text-body);
            border: 1px solid var(--border);
        }

        .order-table tbody tr.row-active .extra-badge.premium {
            background: #DCFCE7;
            color: #15803D;
            border-color: #86EFAC;
        }

        .col-unit-price {
            font-weight: 600;
            color: var(--text-muted);
            font-size: 12.5px;
        }

        .col-unit-price small {
            font-size: 10px;
            color: var(--text-subtle);
            margin-left: 2px;
        }

        .stepper-control {
            display: inline-flex;
            align-items: center;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            background: #FFFFFF;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .stepper-control:focus-within {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15);
        }

        .stepper-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: #FFFFFF;
            color: var(--text-body);
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            user-select: none;
            transition: background 0.12s ease, color 0.12s ease;
        }

        .stepper-btn:hover {
            background: var(--surface-muted);
            color: var(--text-heading);
        }

        .stepper-btn:active {
            background: #E2E8F0;
        }

        .stepper-input {
            width: 48px;
            height: 32px;
            border: none;
            border-left: 1px solid var(--border);
            border-right: 1px solid var(--border);
            text-align: center;
            font-weight: 700;
            font-size: 13.5px;
            color: var(--text-heading);
            outline: none;
            background: #FFFFFF;
            -moz-appearance: textfield;
        }

        .stepper-input::-webkit-outer-spin-button,
        .stepper-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* 5. Subtotal Cell */
        .col-subtotal {
            text-align: right;
            font-weight: 700;
            font-size: 13px;
            color: var(--text-subtle);
            transition: color 0.15s ease;
        }

        .order-table tbody tr.row-active .col-subtotal {
            color: var(--text-heading);
            font-size: 13.5px;
        }

        /* ── TABLE FOOTER SUMMARY ROW (TFOOT) ── */
        .order-table tfoot td {
            background: #FAFAFA;
            padding: 14px 18px;
            border-top: 1.5px solid var(--border);
            font-size: 12.5px;
        }

        .tfoot-label {
            font-weight: 700;
            color: var(--text-heading);
            letter-spacing: 0.02em;
        }

        .tfoot-qty {
            text-align: center;
            font-weight: 800;
            color: var(--text-heading);
            font-size: 13.5px;
        }

        .tfoot-subtotal {
            text-align: right;
            font-weight: 800;
            color: var(--accent);
            font-size: 14px;
        }

        .footer-action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            gap: 16px;
            flex-wrap: wrap;
        }

        .summary-figures {
            display: flex;
            align-items: baseline;
            gap: 28px;
            flex-wrap: wrap;
        }

        .figure-item {
            display: flex;
            flex-direction: column;
        }

        .figure-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            margin-bottom: 2px;
        }

        .figure-val {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-heading);
            line-height: 1.2;
        }

        .figure-val.accent {
            color: var(--accent);
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 18px;
            font-size: 13px;
            font-weight: 600;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: background 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
            text-decoration: none;
            border: 1px solid transparent;
        }

        .btn:focus-visible {
            outline: 2px solid var(--border-focus);
            outline-offset: 2px;
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-muted);
            border-color: var(--border);
        }

        .btn-ghost:hover {
            background: var(--surface-muted);
            color: var(--text-heading);
            border-color: var(--border-hover);
        }

        .btn-primary {
            background: var(--accent);
            color: #FFFFFF;
            box-shadow: 0 1px 2px rgba(15, 118, 110, 0.2);
        }

        .btn-primary:hover {
            background: var(--accent-hover);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        #panelHasil {
            display: none;
            margin-top: 24px;
            border: 1px solid var(--accent-border);
            background: #FFFFFF;
        }

        #panelHasil.active {
            display: block;
        }

        .receipt-header-banner {
            background: var(--accent-soft);
            padding: 14px 20px;
            border-bottom: 1px solid var(--accent-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .receipt-header-banner h3 {
            font-size: 14px;
            font-weight: 700;
            color: var(--accent-text);
        }

        .meta-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            background: var(--surface-muted);
        }

        @media (max-width: 680px) {
            .meta-grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .meta-cell-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .meta-cell-val {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-heading);
            margin-top: 2px;
        }

        .toast-popup {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: var(--primary);
            color: #FFFFFF;
            padding: 12px 18px;
            border-radius: var(--radius-md);
            font-size: 13px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.25s ease;
            z-index: 1000;
        }

        .toast-popup.visible {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- ── HEADER BAR ── -->
    <header class="app-header">
        <div class="brand-cluster">
            <span class="brand-badge">ZIPZAP</span>
            <div class="brand-title-wrap">
                <h1>Kalkulator Harga Konveksi</h1>
                <p>Perhitungan Akurat Harga Kaos, Polo & Kemeja Custom</p>
            </div>
        </div>
        <div class="header-actions">
            <button type="button" class="btn btn-ghost" onclick="resetForm()">Reset Input</button>
        </div>
    </header>

    <div class="layout-grid">

        <aside class="left-column">
            
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <span class="card-number">1</span>
                        <h2 class="card-title">Spesifikasi Pesanan</h2>
                    </div>
                </div>
                <div class="card-body">
                    <form id="orderSpecForm" onsubmit="event.preventDefault();">
                        
                        <div class="form-group">
                            <label class="form-label" for="namaPemesan">Nama Pemesan / Instansi</label>
                            <input type="text" id="namaPemesan" class="form-input" placeholder="Masukkan nama pemesan..." oninput="hitung()">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="produk">
                                <span>Jenis Produk</span>
                                <span class="sub-price tabular-nums" id="lblHargaProduk">Rp 70.000</span>
                            </label>
                            <select id="produk" class="form-select" onchange="hitung()">
                                <option value="kaos" data-price="70000" selected>Kaos Custom (Rp 70.000 / pcs)</option>
                                <option value="polo" data-price="110000">Polo Shirt (Rp 110.000 / pcs)</option>
                                <option value="kemeja" data-price="150000">Kemeja Seragam (Rp 150.000 / pcs)</option>
                            </select>
                        </div>

                        <!-- 2. Model Lengan -->
                        <div class="form-group">
                            <label class="form-label" for="lengan">
                                <span>Model Lengan</span>
                                <span class="sub-price tabular-nums" id="lblHargaLengan">+Rp 0</span>
                            </label>
                            <select id="lengan" class="form-select" onchange="hitung()">
                                <option value="pendek" data-extra="0" selected>Lengan Pendek (+Rp 0)</option>
                                <option value="panjang" data-extra="10000">Lengan Panjang (+Rp 10.000)</option>
                            </select>
                        </div>

                        <!-- 3. Warna Kain -->
                        <div class="form-group">
                            <label class="form-label" for="warna">
                                <span>Warna Kain</span>
                                <span class="sub-price tabular-nums" id="lblHargaWarna">+Rp 0</span>
                            </label>
                            <select id="warna" class="form-select" onchange="hitung()">
                                <option value="putih" data-extra="0" selected>Putih (Standar)</option>
                                <option value="hitam" data-extra="5000">Hitam (+Rp 5.000)</option>
                                <option value="navy" data-extra="5000">Navy / Dongker (+Rp 5.000)</option>
                                <option value="merah" data-extra="0">Merah (Standar)</option>
                                <option value="biru" data-extra="0">Biru (Standar)</option>
                            </select>
                        </div>

                        <!-- 4. Menggunakan Saku -->
                        <div class="form-group">
                            <label class="form-label" for="saku">
                                <span>Penggunaan Saku</span>
                                <span class="sub-price tabular-nums" id="lblHargaSaku">+Rp 0</span>
                            </label>
                            <select id="saku" class="form-select" onchange="hitung()">
                                <option value="tanpa" data-extra="0" selected>Tanpa Saku (+Rp 0)</option>
                                <option value="ada" data-extra="5000">Ada Saku Dada (+Rp 5.000)</option>
                            </select>
                        </div>

                    </form>
                </div>
            </div>

            <!-- CARD 2: DETAIL HARGA DASAR S–L (RECEIPT STYLE) -->
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <span class="card-number">2</span>
                        <h2 class="card-title">Komponen Harga Dasar (S–L)</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="receipt-list">
                        <div class="receipt-row">
                            <span class="receipt-label">Harga Produk <span class="receipt-chip" id="recProdukName">Kaos</span></span>
                            <span class="receipt-val tabular-nums" id="recProdukPrice">Rp 70.000</span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Lengan <span class="receipt-chip" id="recLenganName">Pendek</span></span>
                            <span class="receipt-val tabular-nums" id="recLenganPrice">+Rp 0</span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Warna <span class="receipt-chip" id="recWarnaName">Putih</span></span>
                            <span class="receipt-val tabular-nums" id="recWarnaPrice">+Rp 0</span>
                        </div>
                        <div class="receipt-row">
                            <span class="receipt-label">Saku <span class="receipt-chip" id="recSakuName">Tanpa</span></span>
                            <span class="receipt-val tabular-nums" id="recSakuPrice">+Rp 0</span>
                        </div>
                        
                        <hr class="receipt-divider">

                        <div class="receipt-summary-row">
                            <span>Harga Dasar Variasi:</span>
                            <span class="price tabular-nums" id="recBaseUnitPrice">Rp 70.000 / pcs</span>
                        </div>
                    </div>
                </div>
            </div>

        </aside>

        
        <main class="right-column">
            
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <span class="card-number">3</span>
                        <h2 class="card-title">Rincian Kuantitas per Ukuran</h2>
                        <span class="card-badge-status" id="badgeItemCount">0 Ukuran Terisi</span>
                    </div>
                    <div style="display:flex; gap:6px;">
                        <button type="button" class="btn btn-ghost" style="padding:4px 10px; font-size:11px;" onclick="isiContohCepat()">Contoh Cepat</button>
                        <button type="button" class="btn btn-ghost" style="padding:4px 10px; font-size:11px;" onclick="resetUkuran()">Nolkan</button>
                    </div>
                </div>

                <div class="table-wrap">
                    <table class="order-table" id="tabelSize">
                        <thead>
                            <tr>
                                <th style="width: 70px;">Ukuran</th>
                                <th>Variasi Tambahan</th>
                                <th>Harga Satuan</th>
                                <th style="text-align: center; width: 160px;">Kuantitas (Pcs)</th>
                                <th style="text-align: right; width: 150px;">Subtotal per Size</th>
                            </tr>
                        </thead>
                        <tbody id="tabelSizeBody">
                            <!-- Injected by JavaScript -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="tfoot-label">
                                    Total Akumulasi Ukuran
                                </td>
                                <td class="tfoot-qty tabular-nums" id="tfootTotalQty">
                                    0 Pcs
                                </td>
                                <td class="tfoot-subtotal tabular-nums" id="tfootTotalSubtotal">
                                    Rp 0
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- INTEGRATED SUMMARY STRIP & FOOTER ACTIONS -->
            <div class="footer-action-bar">
                <div class="summary-figures">
                    <div class="figure-item">
                        <span class="figure-label">Total Kuantitas</span>
                        <span class="figure-val tabular-nums" id="totQty">0 Pcs</span>
                    </div>
                    <div class="figure-item">
                        <span class="figure-label">Total Harga Transaksi</span>
                        <span class="figure-val accent tabular-nums" id="totHarga">Rp 0</span>
                    </div>
                </div>

                <div class="action-buttons">
                    <button type="button" class="btn btn-ghost" onclick="resetForm()">
                        Reset Pesanan
                    </button>
                    <button type="button" class="btn btn-primary" id="btnSimpan" onclick="simpanData()">
                        Simpan Pesanan
                    </button>
                </div>
            </div>

            <!-- CARD RECEIPT: PANEL HASIL SIMPAN PESANAN (#panelHasil) -->
            <div class="card" id="panelHasil">
                <div class="receipt-header-banner">
                    <h3>Bukti Transaksi Pesanan Tersimpan</h3>
                    <span class="tabular-nums" id="resOrderNumber" style="font-weight:700; font-size:12px; color:var(--accent-text);">#ORD-001</span>
                </div>

                <div class="meta-grid-4">git
                    <div>
                        <div class="meta-cell-label">Nama Pemesan</div>
                        <div class="meta-cell-val" id="resCustomerName">-</div>
                    </div>
                    <div>
                        <div class="meta-cell-label">Produk</div>
                        <div class="meta-cell-val" id="resProductName">-</div>
                    </div>
                    <div>
                        <div class="meta-cell-label">Total Unit</div>
                        <div class="meta-cell-val tabular-nums" id="resTotalQty">0 Pcs</div>
                    </div>
                    <div>
                        <div class="meta-cell-label">Total Biaya</div>
                        <div class="meta-cell-val tabular-nums" style="color:var(--accent);" id="resTotalPrice">Rp 0</div>
                    </div>
                </div>

                <div class="table-wrap">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Item Spesifikasi</th>
                                <th>Detail Ukuran Terisi</th>
                                <th style="text-align: right;">Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="resSpecSummary">-</td>
                                <td id="resSizeBreakdown">-</td>
                                <td style="text-align: right; font-weight:700;" class="tabular-nums" id="resGrandTotalText">Rp 0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<!-- Toast Alert -->
<div class="toast-popup" id="toast" role="status" aria-live="polite">Pesanan berhasil disimpan!</div>

<script>
    // ════════════════════════════════════════
    //  DATA SIZE & PRICING
    // ════════════════════════════════════════
    const SIZES = [
        { code: 'S',   extra: 0,     label: 'Standar (+0)' },
        { code: 'M',   extra: 0,     label: 'Standar (+0)' },
        { code: 'L',   extra: 0,     label: 'Standar (+0)' },
        { code: 'XL',  extra: 3000,  label: '+Rp 3.000' },
        { code: '2XL', extra: 6000,  label: '+Rp 6.000' },
        { code: '3XL', extra: 9000,  label: '+Rp 9.000' },
        { code: '4XL', extra: 12000, label: '+Rp 12.000' },
        { code: '5XL', extra: 15000, label: '+Rp 15.000' }
    ];

    let sizeQuantities = {
        'S': 0, 'M': 0, 'L': 0, 'XL': 0,
        '2XL': 0, '3XL': 0, '4XL': 0, '5XL': 0
    };

    // ── RENDER TABEL SIZE (UI-STYLING UPGRADE) ──
    function renderSizeTable() {
        const tbody = document.getElementById('tabelSizeBody');
        tbody.innerHTML = SIZES.map(s => {
            const qty = sizeQuantities[s.code] || 0;
            const extraTag = s.extra === 0 
                ? `<span class="extra-badge zero">Standar</span>`
                : `<span class="extra-badge premium">+Rp ${formatRupiah(s.extra)}</span>`;

            return `
                <tr id="row-${s.code}" class="${qty > 0 ? 'row-active' : ''}">
                    <td><div class="size-chip">${s.code}</div></td>
                    <td>${extraTag}</td>
                    <td class="col-unit-price tabular-nums" id="unitPrice-${s.code}">Rp 0 <small>/ pcs</small></td>
                    <td style="text-align:center;">
                        <div class="stepper-control">
                            <button type="button" class="stepper-btn" aria-label="Kurangi kuantitas ${s.code}" onclick="stepQty('${s.code}', -1)">−</button>
                            <input type="number" min="0" class="stepper-input tabular-nums" aria-label="Jumlah kuantitas ${s.code}" id="inputQty-${s.code}" value="${qty}" oninput="manualQty('${s.code}', this.value)">
                            <button type="button" class="stepper-btn" aria-label="Tambah kuantitas ${s.code}" onclick="stepQty('${s.code}', 1)">+</button>
                        </div>
                    </td>
                    <td class="col-subtotal tabular-nums" id="subtotal-${s.code}">Rp 0</td>
                </tr>
            `;
        }).join('');
    }

    // ── STEPPER CONTROLS ──
    function stepQty(code, delta) {
        sizeQuantities[code] = Math.max(0, (sizeQuantities[code] || 0) + delta);
        document.getElementById(`inputQty-${code}`).value = sizeQuantities[code];
        toggleRowHighlight(code);
        hitung();
    }

    function manualQty(code, val) {
        sizeQuantities[code] = Math.max(0, parseInt(val) || 0);
        toggleRowHighlight(code);
        hitung();
    }

    function toggleRowHighlight(code) {
        const row = document.getElementById(`row-${code}`);
        if (sizeQuantities[code] > 0) {
            row.classList.add('row-active');
        } else {
            row.classList.remove('row-active');
        }
    }

    // ── FUNGSI HITUNG UTAMA (REAL-TIME) ──
    function hitung() {
        const prodSelect = document.getElementById('produk');
        const prodOpt = prodSelect.options[prodSelect.selectedIndex];
        const baseProductPrice = parseInt(prodOpt.getAttribute('data-price') || 70000);
        const prodText = prodSelect.value === 'kaos' ? 'Kaos' : prodSelect.value === 'polo' ? 'Polo' : 'Kemeja';

        const sleeveSelect = document.getElementById('lengan');
        const sleeveOpt = sleeveSelect.options[sleeveSelect.selectedIndex];
        const extraLengan = parseInt(sleeveOpt.getAttribute('data-extra') || 0);
        const sleeveText = sleeveSelect.value === 'pendek' ? 'Pendek' : 'Panjang';

        const colorSelect = document.getElementById('warna');
        const colorOpt = colorSelect.options[colorSelect.selectedIndex];
        const extraWarna = parseInt(colorOpt.getAttribute('data-extra') || 0);
        const colorText = colorOpt.text.split(' ')[0];

        const pocketSelect = document.getElementById('saku');
        const pocketOpt = pocketSelect.options[pocketSelect.selectedIndex];
        const extraSaku = parseInt(pocketOpt.getAttribute('data-extra') || 0);
        const pocketText = pocketSelect.value === 'tanpa' ? 'Tanpa' : 'Ada';

        // Update Label Tambahan di Form
        document.getElementById('lblHargaProduk').textContent = `Rp ${formatRupiah(baseProductPrice)}`;
        document.getElementById('lblHargaLengan').textContent = extraLengan > 0 ? `+Rp ${formatRupiah(extraLengan)}` : '+Rp 0';
        document.getElementById('lblHargaWarna').textContent = extraWarna > 0 ? `+Rp ${formatRupiah(extraWarna)}` : '+Rp 0';
        document.getElementById('lblHargaSaku').textContent = extraSaku > 0 ? `+Rp ${formatRupiah(extraSaku)}` : '+Rp 0';

        // Update Card 2 (Receipt Detail Harga Dasar)
        document.getElementById('recProdukName').textContent = prodText;
        document.getElementById('recProdukPrice').textContent = `Rp ${formatRupiah(baseProductPrice)}`;
        document.getElementById('recLenganName').textContent = sleeveText;
        document.getElementById('recLenganPrice').textContent = extraLengan > 0 ? `+Rp ${formatRupiah(extraLengan)}` : '+Rp 0';
        document.getElementById('recWarnaName').textContent = colorText;
        document.getElementById('recWarnaPrice').textContent = extraWarna > 0 ? `+Rp ${formatRupiah(extraWarna)}` : '+Rp 0';
        document.getElementById('recSakuName').textContent = pocketText;
        document.getElementById('recSakuPrice').textContent = extraSaku > 0 ? `+Rp ${formatRupiah(extraSaku)}` : '+Rp 0';

        const baseUnitStandard = baseProductPrice + extraLengan + extraWarna + extraSaku;
        document.getElementById('recBaseUnitPrice').textContent = `Rp ${formatRupiah(baseUnitStandard)} / pcs`;

        // Update Baris Tabel Ukuran & Hitung Grand Total
        let totalPcs = 0;
        let totalBiaya = 0;
        let activeSizesCount = 0;

        SIZES.forEach(s => {
            const qty = sizeQuantities[s.code] || 0;
            const unitPrice = baseUnitStandard + s.extra;
            const subtotal = qty * unitPrice;

            totalPcs += qty;
            totalBiaya += subtotal;
            if (qty > 0) activeSizesCount++;

            const unitEl = document.getElementById(`unitPrice-${s.code}`);
            const subEl = document.getElementById(`subtotal-${s.code}`);
            if (unitEl) unitEl.innerHTML = `Rp ${formatRupiah(unitPrice)} <small>/ pcs</small>`;
            if (subEl) subEl.textContent = `Rp ${formatRupiah(subtotal)}`;
        });

        // Update Badge Status di Header Tabel
        const badgeCount = document.getElementById('badgeItemCount');
        if (badgeCount) {
            badgeCount.textContent = `${activeSizesCount} Ukuran Terisi`;
            badgeCount.classList.toggle('active', activeSizesCount > 0);
        }

        // Update Footer Tabel (tfoot)
        const tfootQty = document.getElementById('tfootTotalQty');
        const tfootSub = document.getElementById('tfootTotalSubtotal');
        if (tfootQty) tfootQty.textContent = `${totalPcs} Pcs`;
        if (tfootSub) tfootSub.textContent = `Rp ${formatRupiah(totalBiaya)}`;

        // Update Total Summary Strip
        document.getElementById('totQty').textContent = `${totalPcs} Pcs`;
        document.getElementById('totHarga').textContent = `Rp ${formatRupiah(totalBiaya)}`;
    }

    // ── QUICK ACTIONS ──
    function isiContohCepat() {
        sizeQuantities = {
            'S': 3, 'M': 10, 'L': 12, 'XL': 5,
            '2XL': 2, '3XL': 0, '4XL': 0, '5XL': 0
        };
        SIZES.forEach(s => {
            const inp = document.getElementById(`inputQty-${s.code}`);
            if (inp) inp.value = sizeQuantities[s.code];
            toggleRowHighlight(s.code);
        });
        hitung();
    }

    function resetUkuran() {
        SIZES.forEach(s => {
            sizeQuantities[s.code] = 0;
            const inp = document.getElementById(`inputQty-${s.code}`);
            if (inp) inp.value = 0;
            toggleRowHighlight(s.code);
        });
        hitung();
    }

    // ── RESET FORM ──
    function resetForm() {
        document.getElementById('namaPemesan').value = '';
        document.getElementById('produk').value = 'kaos';
        document.getElementById('lengan').value = 'pendek';
        document.getElementById('warna').value = 'putih';
        document.getElementById('saku').value = 'tanpa';
        resetUkuran();
        document.getElementById('panelHasil').classList.remove('active');
        showToast('Form pesanan berhasil direset.');
    }

    // ── SIMPAN DATA (GOOGLE SCRIPT / LOCAL FALLBACK) ──
    function simpanData() {
        let totalPcs = 0;
        SIZES.forEach(s => totalPcs += (sizeQuantities[s.code] || 0));

        if (totalPcs === 0) {
            alert('Silakan masukkan jumlah kuantitas minimal 1 pcs pada tabel ukuran.');
            return;
        }

        const nama = document.getElementById('namaPemesan').value.trim() || 'Pelanggan Umum';
        const prod = document.getElementById('produk').options[document.getElementById('produk').selectedIndex].text;
        const totalHargaText = document.getElementById('totHarga').textContent;

        const btn = document.getElementById('btnSimpan');
        btn.disabled = true;
        btn.textContent = 'Menyimpan...';

        // Kumpulkan Rincian Ukuran
        const breakdownArray = [];
        SIZES.forEach(s => {
            if (sizeQuantities[s.code] > 0) {
                breakdownArray.push(`${s.code}: ${sizeQuantities[s.code]} pcs`);
            }
        });
        const breakdownStr = breakdownArray.join(', ');

        const payload = {
            namaPemesan: nama,
            produk: prod,
            totalQty: totalPcs,
            totalHarga: totalHargaText,
            breakdown: breakdownStr,
            timestamp: new Date().toISOString()
        };

        // Integration handler: Google Apps Script atau Fallback
        if (typeof google !== 'undefined' && google.script && google.script.run) {
            google.script.run
                .withSuccessHandler(() => {
                    handleSaveSuccess(payload);
                    btn.disabled = false;
                    btn.textContent = 'Simpan Pesanan';
                })
                .withFailureHandler(err => {
                    alert('Gagal menyimpan ke Google Sheet: ' + err);
                    btn.disabled = false;
                    btn.textContent = 'Simpan Pesanan';
                })
                .simpanPesananGoogleSheet(payload);
        } else {
            // Local fallback simulation
            setTimeout(() => {
                handleSaveSuccess(payload);
                btn.disabled = false;
                btn.textContent = 'Simpan Pesanan';
            }, 300);
        }
    }

    function handleSaveSuccess(data) {
        const panel = document.getElementById('panelHasil');
        panel.classList.add('active');

        document.getElementById('resOrderNumber').textContent = '#ORD-' + Date.now().toString().slice(-6);
        document.getElementById('resCustomerName').textContent = data.namaPemesan;
        document.getElementById('resProductName').textContent = data.produk.split('(')[0];
        document.getElementById('resTotalQty').textContent = `${data.totalQty} Pcs`;
        document.getElementById('resTotalPrice').textContent = data.totalHarga;
        document.getElementById('resSpecSummary').textContent = `${data.produk.split('(')[0]} (${document.getElementById('lengan').value}, ${document.getElementById('warna').value})`;
        document.getElementById('resSizeBreakdown').textContent = data.breakdown;
        document.getElementById('resGrandTotalText').textContent = data.totalHarga;

        panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        showToast('Pesanan berhasil disimpan & invoice dicatat!');
    }

    // ── HELPERS ──
    function formatRupiah(num) {
        return (num || 0).toLocaleString('id-ID');
    }

    function showToast(msg) {
        const t = document.getElementById('toast');
        t.textContent = msg;
        t.classList.add('visible');
        setTimeout(() => t.classList.remove('visible'), 3000);
    }

    // ── INIT ──
    renderSizeTable();
    hitung();
</script>
</body>
</html>
