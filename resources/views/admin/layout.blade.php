<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>@yield('title', 'Admin') · ASNEN Masterclass</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --ink: #1c1a17;
      --ink-soft: #6b6560;
      --paper: #f7f3ec;
      --paper-warm: #efe7d8;
      --sidebar: #1c1a17;
      --sidebar-text: #e8e4dc;
      --rule: #d4c4a8;
      --accent: #8a3a1f;
      --gold: #b08a3e;
      --moss: #4a5a32;
      --success: #3d6b45;
      --warning: #9a7b2e;
      --danger: #8b3a32;
      --shadow: 0 1px 3px rgba(28,26,23,.08);
    }
    * { box-sizing: border-box; }
    html {
      height: 100%;
      overflow: hidden;
    }
    body {
      margin: 0;
      height: 100%;
      overflow: hidden;
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      color: var(--ink);
      background: var(--paper);
      line-height: 1.5;
    }
    .admin-shell {
      display: flex;
      height: 100vh;
      height: 100dvh;
      overflow: hidden;
    }
    .sidebar-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(28,26,23,.45);
      z-index: 40;
      opacity: 0;
      transition: opacity .25s;
      pointer-events: none;
    }
    .sidebar-overlay.show { opacity: 1; pointer-events: auto; }
    .sidebar {
      width: 272px;
      height: 100vh;
      height: 100dvh;
      background: linear-gradient(180deg, #221f1b 0%, #1c1a17 48%, #181614 100%);
      color: var(--sidebar-text);
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      position: relative;
      z-index: 50;
      border-right: 1px solid rgba(255,255,255,.06);
      overflow: hidden;
    }
    .sidebar-inner {
      display: flex;
      flex-direction: column;
      flex: 1;
      min-height: 0;
      height: 100%;
      padding: 24px 16px 20px;
      overflow-y: auto;
      overflow-x: hidden;
      overscroll-behavior: contain;
      scrollbar-width: thin;
      scrollbar-color: rgba(176,138,62,.45) transparent;
    }
    .sidebar-inner::-webkit-scrollbar { width: 6px; }
    .sidebar-inner::-webkit-scrollbar-thumb {
      background: rgba(176,138,62,.4);
      border-radius: 3px;
    }
    .sidebar-brand {
      padding: 8px 12px 24px;
      border-bottom: 1px solid rgba(255,255,255,.08);
      margin-bottom: 20px;
    }
    .brand-mark {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      color: inherit;
    }
    .brand-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      background: linear-gradient(135deg, var(--accent), var(--gold));
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Cormorant Garamond', serif;
      font-size: 18px;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
      box-shadow: 0 4px 12px rgba(138,58,31,.35);
    }
    .brand-text { min-width: 0; }
    .brand {
      font-family: 'Cormorant Garamond', serif;
      font-size: 20px;
      font-weight: 600;
      color: #fff;
      margin: 0;
      line-height: 1.15;
      letter-spacing: .01em;
    }
    .brand-sub {
      font-size: 10px;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: rgba(232,228,220,.55);
      margin: 4px 0 0;
    }
    .nav-section {
      margin-bottom: 20px;
    }
    .nav-section-label {
      font-size: 10px;
      letter-spacing: .16em;
      text-transform: uppercase;
      color: rgba(232,228,220,.4);
      padding: 0 12px 8px;
      font-weight: 600;
    }
    .nav { list-style: none; margin: 0; padding: 0; }
    .nav a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 11px 12px;
      color: rgba(232,228,220,.82);
      text-decoration: none;
      border-radius: 8px;
      margin-bottom: 2px;
      font-size: 13px;
      font-weight: 500;
      transition: background .15s, color .15s, transform .15s;
      position: relative;
    }
    .nav a:hover {
      background: rgba(255,255,255,.06);
      color: #fff;
    }
    .nav a.active {
      background: rgba(176,138,62,.2);
      color: #fff;
      box-shadow: inset 3px 0 0 var(--gold);
    }
    .nav a.external { color: rgba(232,228,220,.65); }
    .nav a.external:hover { color: #fff; }
    .nav-icon {
      width: 20px;
      height: 20px;
      flex-shrink: 0;
      opacity: .85;
    }
    .nav a.active .nav-icon { opacity: 1; }
    .nav-label { flex: 1; min-width: 0; }
    .nav-badge {
      font-size: 10px;
      font-weight: 700;
      padding: 2px 8px;
      border-radius: 999px;
      background: var(--accent);
      color: #fff;
      letter-spacing: .02em;
    }
    .nav-external {
      width: 14px;
      height: 14px;
      opacity: .5;
    }
    .sidebar-spacer { flex: 1; }
    .sidebar-user {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 12px;
      border-radius: 10px;
      background: rgba(255,255,255,.04);
      border: 1px solid rgba(255,255,255,.08);
      margin-bottom: 12px;
    }
    .user-avatar {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: rgba(176,138,62,.25);
      border: 1px solid rgba(176,138,62,.4);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      font-weight: 700;
      color: var(--gold);
      flex-shrink: 0;
    }
    .user-meta { min-width: 0; flex: 1; }
    .user-name {
      font-size: 13px;
      font-weight: 600;
      color: #fff;
      margin: 0;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .user-email {
      font-size: 11px;
      color: rgba(232,228,220,.5);
      margin: 2px 0 0;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .sidebar-footer {
      font-size: 10px;
      letter-spacing: .08em;
      color: rgba(232,228,220,.35);
      text-align: center;
      padding: 4px 8px 0;
    }
    .sidebar-signout {
      background: rgba(255,255,255,.04);
      border-color: rgba(255,255,255,.12);
      color: rgba(232,228,220,.85);
    }
    .sidebar-signout:hover {
      background: rgba(138,58,31,.25);
      border-color: rgba(176,138,62,.4);
      color: #fff;
    }
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
      min-width: 0;
      min-height: 0;
      height: 100vh;
      height: 100dvh;
      overflow: hidden;
    }
    .topbar {
      background: rgba(255,255,255,.92);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid var(--rule);
      padding: 0 28px;
      min-height: 68px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      z-index: 30;
      box-shadow: 0 1px 0 rgba(28,26,23,.04);
    }
    .topbar-left {
      display: flex;
      align-items: center;
      gap: 16px;
      min-width: 0;
      flex: 1;
    }
    .menu-toggle {
      display: none;
      width: 40px;
      height: 40px;
      border: 1px solid var(--rule);
      border-radius: 8px;
      background: #fff;
      cursor: pointer;
      align-items: center;
      justify-content: center;
      padding: 0;
      color: var(--ink);
      flex-shrink: 0;
    }
    .menu-toggle svg { width: 20px; height: 20px; }
    .page-heading { min-width: 0; }
    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 12px;
      color: var(--ink-soft);
      margin-bottom: 4px;
      flex-wrap: wrap;
    }
    .breadcrumb a {
      color: var(--ink-soft);
      text-decoration: none;
      transition: color .15s;
    }
    .breadcrumb a:hover { color: var(--accent); }
    .breadcrumb-sep { opacity: .4; user-select: none; }
    .topbar h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(22px, 3vw, 30px);
      font-weight: 600;
      margin: 0;
      line-height: 1.15;
      color: var(--ink);
    }
    .page-subtitle {
      font-size: 13px;
      color: var(--ink-soft);
      margin: 4px 0 0;
    }
    .topbar-right {
      display: flex;
      align-items: center;
      gap: 12px;
      flex-shrink: 0;
    }
    .topbar-actions {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .user-chip {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 6px 6px 6px 12px;
      border: 1px solid var(--rule);
      border-radius: 999px;
      background: var(--paper-warm);
    }
    .user-chip-avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: var(--accent);
      color: #fff;
      font-size: 12px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .user-chip-email {
      font-size: 12px;
      font-weight: 500;
      color: var(--ink);
      max-width: 160px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    @media (max-width: 1024px) {
      .user-chip-email { display: none; }
    }
    .content {
      flex: 1;
      min-height: 0;
      padding: 28px;
      overflow-y: auto;
      overflow-x: hidden;
      overscroll-behavior: contain;
      scrollbar-width: thin;
      scrollbar-color: rgba(138,58,31,.35) var(--paper-warm);
    }
    .content::-webkit-scrollbar { width: 8px; }
    .content::-webkit-scrollbar-thumb {
      background: rgba(138,58,31,.3);
      border-radius: 4px;
    }
    .content::-webkit-scrollbar-track {
      background: var(--paper-warm);
    }
    .alert {
      padding: 12px 16px;
      margin-bottom: 20px;
      border-radius: 4px;
      font-size: 14px;
      border-left: 3px solid;
    }
    .alert-success { background: rgba(74,90,50,.1); border-color: var(--moss); color: var(--moss); }
    .alert-error { background: rgba(138,58,31,.08); border-color: var(--accent); color: var(--accent); }
    .stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 16px;
      margin-bottom: 28px;
    }
    .stat-card {
      background: #fff;
      border: 1px solid var(--rule);
      padding: 20px;
      border-radius: 4px;
      box-shadow: var(--shadow);
    }
    .stat-card .label {
      font-size: 10px;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: var(--ink-soft);
      margin-bottom: 8px;
    }
    .stat-card .value {
      font-family: 'Cormorant Garamond', serif;
      font-size: 32px;
      font-weight: 600;
      color: var(--ink);
      line-height: 1;
    }
    .stat-card .value.accent { color: var(--accent); }
    .stat-card .value.gold { color: var(--gold); }
    .card {
      background: #fff;
      border: 1px solid var(--rule);
      border-radius: 4px;
      box-shadow: var(--shadow);
      margin-bottom: 24px;
    }
    .card-head {
      padding: 16px 20px;
      border-bottom: 1px solid var(--rule);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
    }
    .card-head h2 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 20px;
      font-weight: 600;
      margin: 0;
    }
    .card-body { padding: 20px; }
    table { width: 100%; border-collapse: collapse; font-size: 13px; }
    th, td { padding: 12px 14px; text-align: left; border-bottom: 1px solid var(--rule); }
    th {
      font-size: 10px;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: var(--ink-soft);
      font-weight: 600;
      background: var(--paper-warm);
    }
    tr:hover td { background: rgba(247,243,236,.5); }
    a.link { color: var(--accent); text-decoration: none; font-weight: 500; }
    a.link:hover { text-decoration: underline; }
    .badge {
      display: inline-block;
      padding: 3px 10px;
      border-radius: 2px;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: .04em;
      text-transform: uppercase;
    }
    .badge-pending { background: rgba(176,138,62,.2); color: #7a5e24; }
    .badge-contacted { background: rgba(58,90,120,.15); color: #2d4a62; }
    .badge-payment_received { background: rgba(74,90,50,.2); color: var(--moss); }
    .badge-confirmed { background: rgba(74,90,50,.35); color: #2d4a32; }
    .badge-cancelled { background: rgba(139,58,50,.15); color: var(--danger); }
    .btn {
      display: inline-block;
      padding: 10px 18px;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: .1em;
      text-transform: uppercase;
      text-decoration: none;
      border-radius: 3px;
      border: none;
      cursor: pointer;
      font-family: inherit;
      transition: all .15s;
    }
    .btn-primary { background: var(--accent); color: #fff; }
    .btn-primary:hover { background: #6b2c17; }
    .btn-secondary { background: transparent; border: 1px solid var(--rule); color: var(--ink-soft); }
    .btn-secondary:hover { border-color: var(--accent); color: var(--accent); }
    .btn-sm { padding: 6px 12px; font-size: 10px; }
    .btn-danger {
      background: var(--danger);
      border: 1px solid #6f2f28;
      color: #fff;
    }
    .btn-danger:hover:not(:disabled) { background: #6f2f28; }
    .btn-danger:disabled {
      opacity: 0.45;
      cursor: not-allowed;
    }
    .danger-zone {
      border: 1px solid rgba(139,58,50,.35);
      background: linear-gradient(180deg, rgba(139,58,50,.06), rgba(139,58,50,.02));
      border-radius: 12px;
      overflow: hidden;
    }
    .danger-zone-head {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 16px;
      padding: 20px 24px;
      border-bottom: 1px solid rgba(139,58,50,.2);
      background: rgba(139,58,50,.08);
    }
    .danger-zone-head h2 {
      margin: 0 0 6px;
      font-family: 'Cormorant Garamond', serif;
      font-size: 22px;
      font-weight: 600;
      color: var(--danger);
    }
    .danger-zone-head p {
      margin: 0;
      font-size: 13px;
      color: var(--ink-soft);
      max-width: 52ch;
    }
    .danger-zone-body { padding: 24px; }
    .danger-zone-list {
      margin: 0 0 20px;
      padding: 0;
      list-style: none;
      font-size: 13px;
    }
    .danger-zone-list li {
      display: flex;
      justify-content: space-between;
      gap: 12px;
      padding: 8px 0;
      border-bottom: 1px solid var(--rule);
    }
    .danger-zone-list li:last-child { border-bottom: none; }
    .danger-confirm-label {
      display: block;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      color: var(--danger);
      margin-bottom: 8px;
    }
    .danger-confirm-input {
      width: 100%;
      max-width: 320px;
      padding: 10px 12px;
      border: 1px solid rgba(139,58,50,.4);
      border-radius: 8px;
      font-family: inherit;
      font-size: 14px;
      margin-bottom: 16px;
    }
    .danger-confirm-input:focus {
      outline: none;
      border-color: var(--danger);
      box-shadow: 0 0 0 3px rgba(139,58,50,.15);
    }
    .filters { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
    .filters input, .filters select, .form-control {
      padding: 9px 12px;
      border: 1px solid var(--rule);
      border-radius: 3px;
      font-family: inherit;
      font-size: 13px;
      background: #fff;
    }
    .filters input { min-width: 220px; }
    .form-group { margin-bottom: 18px; }
    .form-group label {
      display: block;
      font-size: 11px;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--ink-soft);
      font-weight: 600;
      margin-bottom: 6px;
    }
    .form-control { width: 100%; }
    textarea.form-control { min-height: 120px; resize: vertical; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    .chart-bars { display: flex; align-items: flex-end; gap: 6px; height: 120px; padding-top: 8px; }
    .chart-bar-wrap { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 6px; }
    .chart-bar {
      width: 100%;
      max-width: 36px;
      background: linear-gradient(to top, var(--accent), var(--gold));
      border-radius: 3px 3px 0 0;
      min-height: 4px;
    }
    .chart-bar-label { font-size: 9px; color: var(--ink-soft); transform: rotate(-45deg); white-space: nowrap; }
    .breakdown-list { list-style: none; margin: 0; padding: 0; }
    .breakdown-list li {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px solid var(--rule);
      font-size: 13px;
    }
    .breakdown-list li:last-child { border-bottom: none; }
    .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px 24px; }
    .detail-item .k { font-size: 10px; text-transform: uppercase; letter-spacing: .12em; color: var(--ink-soft); }
    .detail-item .v { font-weight: 500; margin-top: 4px; }
    .pagination { display: flex; gap: 6px; margin-top: 20px; flex-wrap: wrap; }
    .pagination a, .pagination span {
      padding: 8px 12px;
      border: 1px solid var(--rule);
      text-decoration: none;
      color: var(--ink);
      font-size: 13px;
      border-radius: 3px;
    }
    .pagination span.current { background: var(--accent); color: #fff; border-color: var(--accent); }
    nav[role="navigation"] { display: flex; gap: 6px; flex-wrap: wrap; align-items: center; }
    nav[role="navigation"] a, nav[role="navigation"] span {
      padding: 8px 12px; border: 1px solid var(--rule); text-decoration: none;
      color: var(--ink); font-size: 13px; border-radius: 3px;
    }
    nav[role="navigation"] span[aria-current="page"] span {
      background: var(--accent); color: #fff; border-color: var(--accent);
      padding: 8px 12px; border-radius: 3px; display: inline-block;
    }
    @media (max-width: 900px) {
      .menu-toggle { display: flex; }
      .sidebar-overlay { display: block; }
      .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        transform: translateX(-100%);
        transition: transform .28s cubic-bezier(.4, 0, .2, 1);
        box-shadow: 8px 0 32px rgba(0,0,0,.2);
      }
      .sidebar.open { transform: translateX(0); }
      .sidebar,
      .main {
        height: 100vh;
        height: 100dvh;
      }
      .topbar { padding: 0 16px; }
      .content { padding: 20px 16px; }
      .grid-2, .detail-grid { grid-template-columns: 1fr; }
    }
  </style>
  @stack('styles')
</head>
@php
  $user = auth()->user();
  $initials = collect(explode(' ', $user->name))->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('');
  $pendingCount = $pendingRegistrationsCount ?? 0;
@endphp
<body>
<div class="sidebar-overlay" id="sidebarOverlay" aria-hidden="true"></div>
<div class="admin-shell">
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-inner">
      <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-mark">
          <span class="brand-icon">Ib</span>
          <span class="brand-text">
            <p class="brand">Inclusive by Design</p>
            <p class="brand-sub">Masterclass Admin</p>
          </span>
        </a>
      </div>

      <div class="nav-section">
        <div class="nav-section-label">Overview</div>
        <ul class="nav">
          <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
              <span class="nav-label">Dashboard</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="nav-section">
        <div class="nav-section-label">Manage</div>
        <ul class="nav">
          <li>
            <a href="{{ route('admin.registrations.index') }}" class="{{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}">
              <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h6"/></svg>
              <span class="nav-label">Registrations</span>
              @if($pendingCount > 0)
                <span class="nav-badge">{{ $pendingCount > 99 ? '99+' : $pendingCount }}</span>
              @endif
            </a>
          </li>
          <li>
            <a href="{{ route('admin.payment-settings.edit') }}" class="{{ request()->routeIs('admin.payment-settings.*') ? 'active' : '' }}">
              <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
              <span class="nav-label">Payment accounts</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.sent-emails.index') }}" class="{{ request()->routeIs('admin.sent-emails.*') ? 'active' : '' }}">
              <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M4 6h16a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2Z"/><path d="m22 8-10 6L2 8"/></svg>
              <span class="nav-label">Sent emails</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.dev-tools.index') }}" class="{{ request()->routeIs('admin.dev-tools.*') ? 'active' : '' }}">
              <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6-7.8 7.8-1.6-1.6a1 1 0 0 0-1.4 0l-2 2a1 1 0 0 0 0 1.4l2.8 2.8a1 1 0 0 0 1.4 0l2-2a1 1 0 0 0 0-1.4l-1.6-1.6 7.8-7.8 1.6 1.6a1 1 0 0 0 1.4 0l2-2a1 1 0 0 0 0-1.4l-2.8-2.8a1 1 0 0 0-1.4 0l-2 2z"/></svg>
              <span class="nav-label">Dev tools</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="nav-section">
        <div class="nav-section-label">Public</div>
        <ul class="nav">
          <li>
            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="external">
              <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
              <span class="nav-label">Registration form</span>
              <svg class="nav-external" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 17L17 7M17 7h-8M17 7v8"/></svg>
            </a>
          </li>
        </ul>
      </div>

      <div class="sidebar-spacer"></div>

      <div class="sidebar-user">
        <div class="user-avatar" aria-hidden="true">{{ $initials }}</div>
        <div class="user-meta">
          <p class="user-name">{{ $user->name }}</p>
          <p class="user-email">{{ $user->email }}</p>
        </div>
      </div>

      <form method="POST" action="{{ route('admin.logout') }}" style="margin:0 0 8px">
        @csrf
        <button type="submit" class="btn btn-secondary" style="width:100%;justify-content:center;display:flex;gap:8px;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);color:rgba(232,228,220,.8)">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          Sign out
        </button>
      </form>

      <div class="sidebar-footer">ASNEN · Acorn Special Tutorials</div>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="topbar-left">
        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Open navigation">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <div class="page-heading">
          @hasSection('breadcrumb')
            <nav class="breadcrumb" aria-label="Breadcrumb">@yield('breadcrumb')</nav>
          @else
            <nav class="breadcrumb" aria-label="Breadcrumb">
              <a href="{{ route('admin.dashboard') }}">Admin</a>
              <span class="breadcrumb-sep">/</span>
              <span>@yield('page-title', 'Dashboard')</span>
            </nav>
          @endif
          <h1>@yield('page-title', 'Dashboard')</h1>
          @hasSection('page-subtitle')
            <p class="page-subtitle">@yield('page-subtitle')</p>
          @endif
        </div>
      </div>
      <div class="topbar-right">
        <div class="topbar-actions">
          <a href="{{ route('admin.registrations.index', ['status' => 'pending']) }}" class="btn btn-secondary btn-sm">Pending @if($pendingCount > 0)({{ $pendingCount }})@endif</a>
        </div>
        <div class="user-chip" title="{{ $user->email }}">
          <span class="user-chip-email">{{ $user->email }}</span>
          <span class="user-chip-avatar">{{ $initials }}</span>
        </div>
      </div>
    </header>
    <main class="content">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
      @endif
      @yield('content')
    </main>
  </div>
</div>
@stack('body-scripts')
<script>
(function() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebarOverlay');
  const toggle = document.getElementById('menuToggle');
  if (!sidebar || !toggle) return;

  function openMenu() {
    sidebar.classList.add('open');
    overlay.classList.add('show');
    document.body.style.overflow = 'hidden';
  }
  function closeMenu() {
    sidebar.classList.remove('open');
    overlay.classList.remove('show');
    document.body.style.overflow = '';
  }

  toggle.addEventListener('click', () => {
    sidebar.classList.contains('open') ? closeMenu() : openMenu();
  });
  overlay.addEventListener('click', closeMenu);
  sidebar.querySelectorAll('.nav a').forEach(a => a.addEventListener('click', () => {
    if (window.innerWidth <= 900) closeMenu();
  }));
  window.addEventListener('resize', () => { if (window.innerWidth > 900) closeMenu(); });
})();
</script>
</body>
</html>
