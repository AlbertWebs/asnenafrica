<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@include('partials.seo-meta', [
    'title' => 'Register · Inclusive by Design Masterclass',
    'description' => 'Register your school team for Inclusive by Design — a three-day masterclass in Nairobi (14–16 July 2026) on building future-ready, inclusive classrooms. Hosted by ASNEN and Acorn Special Tutorials.',
    'canonical' => url('/'),
    'robots' => 'index, follow',
])
@include('partials.seo-event-jsonld', [
    'eventDescription' => 'Inclusive by Design: a three-day professional masterclass for school leaders and teachers, 14–16 July 2026 at Maison Ubuntu, Nairobi.',
])
@verbatim
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --ink:        #1c1a17;
    --ink-soft:   #4a4540;
    --paper:      #f7f3ec;
    --paper-warm: #efe7d8;
    --rule:       #c8b89a;
    --accent:     #8a3a1f;       /* burnt sienna, an African earth tone */
    --accent-dk:  #6b2c17;
    --gold:       #b08a3e;
    --moss:       #4a5a32;
    --shadow:     0 1px 2px rgba(28,26,23,.06), 0 8px 24px rgba(28,26,23,.08);
    --shadow-lg:  0 2px 4px rgba(28,26,23,.08), 0 24px 48px rgba(28,26,23,.12);
  }

  * { box-sizing: border-box; }

  html, body {
    margin: 0;
    padding: 0;
    background: var(--paper);
    color: var(--ink);
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
  }

  /* Subtle paper grain */
  body::before {
    content: "";
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 0;
    background-image:
      radial-gradient(circle at 20% 30%, rgba(176,138,62,.04) 0, transparent 50%),
      radial-gradient(circle at 80% 70%, rgba(138,58,31,.04) 0, transparent 50%);
  }

  .page {
    position: relative;
    z-index: 1;
    max-width: 880px;
    margin: 0 auto;
    padding: 56px 32px 80px;
  }

  /* ── Letterhead ───────────────────────────────────────── */
  header.letterhead {
    text-align: center;
    border-bottom: 1px solid var(--rule);
    padding-bottom: 36px;
    margin-bottom: 40px;
  }

  .conveners {
    font-size: 11px;
    letter-spacing: .22em;
    text-transform: uppercase;
    color: var(--ink-soft);
    margin-bottom: 24px;
    font-weight: 500;
  }

  .conveners span {
    display: inline-block;
    margin: 0 4px;
  }

  .ornament {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    margin: 14px 0 20px;
    color: var(--gold);
    font-size: 13px;
  }

  .ornament::before,
  .ornament::after {
    content: "";
    height: 1px;
    width: 60px;
    background: var(--rule);
  }

  h1.title {
    font-family: 'Cormorant Garamond', serif;
    font-weight: 500;
    font-size: 52px;
    line-height: 1.05;
    margin: 0 0 10px;
    color: var(--ink);
    letter-spacing: -.01em;
  }

  .subtitle {
    font-family: 'Cormorant Garamond', serif;
    font-style: italic;
    font-size: 21px;
    color: var(--ink-soft);
    font-weight: 400;
    margin-bottom: 22px;
  }

  .form-label {
    font-size: 11px;
    letter-spacing: .3em;
    text-transform: uppercase;
    color: var(--accent);
    font-weight: 600;
    margin-top: 8px;
  }

  /* ── Preamble ─────────────────────────────────────────── */
  .preamble {
    background: var(--paper-warm);
    border-left: 3px solid var(--accent);
    padding: 22px 26px;
    margin-bottom: 40px;
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px;
    line-height: 1.55;
    color: var(--ink-soft);
    font-style: italic;
  }

  .preamble strong {
    color: var(--ink);
    font-style: normal;
    font-weight: 600;
  }

  /* ── At-a-Glance ──────────────────────────────────────── */
  .glance {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0;
    margin-bottom: 48px;
    border: 1px solid var(--rule);
    background: #fff;
  }

  .glance-item {
    padding: 14px 18px;
    border-bottom: 1px solid var(--rule);
    border-right: 1px solid var(--rule);
  }
  .glance-item:nth-child(2n) { border-right: none; }
  .glance-item:nth-last-child(-n+2) { border-bottom: none; }

  .glance-label {
    font-size: 10px;
    letter-spacing: .2em;
    text-transform: uppercase;
    color: var(--ink-soft);
    margin-bottom: 4px;
    font-weight: 500;
  }

  .glance-value {
    font-size: 14px;
    color: var(--ink);
    font-weight: 500;
  }

  /* ── Form sections ────────────────────────────────────── */
  section.section {
    margin-bottom: 44px;
  }

  .section-head {
    display: flex;
    align-items: baseline;
    gap: 16px;
    margin-bottom: 24px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--rule);
  }

  .section-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 42px;
    font-weight: 500;
    color: var(--gold);
    line-height: 1;
  }

  .section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 26px;
    font-weight: 600;
    color: var(--ink);
    margin: 0;
  }

  .section-sub {
    margin-left: auto;
    font-size: 12px;
    color: var(--ink-soft);
    font-style: italic;
  }

  .field-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px 24px;
  }

  .field-grid.full > .field { grid-column: 1 / -1; }
  .field.full { grid-column: 1 / -1; }

  .field {
    display: flex;
    flex-direction: column;
  }

  label {
    font-size: 12px;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--ink-soft);
    font-weight: 600;
    margin-bottom: 6px;
  }

  label .req { color: var(--accent); margin-left: 3px; }

  input[type="text"],
  input[type="email"],
  input[type="tel"],
  input[type="number"],
  select,
  textarea {
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    color: var(--ink);
    background: #fff;
    border: 1px solid var(--rule);
    border-radius: 2px;
    padding: 11px 14px;
    transition: border-color .15s, box-shadow .15s;
  }

  input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(138,58,31,.12);
  }

  textarea {
    resize: vertical;
    min-height: 80px;
    font-family: 'Inter', sans-serif;
  }

  /* ── Tier selection ───────────────────────────────────── */
  .tiers {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    margin-bottom: 24px;
  }

  .tier {
    position: relative;
    padding: 22px 22px 20px;
    border: 1.5px solid var(--rule);
    background: #fff;
    cursor: pointer;
    transition: all .2s;
  }

  .tier input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
  }

  .tier:hover {
    border-color: var(--gold);
    transform: translateY(-1px);
    box-shadow: var(--shadow);
  }

  .tier.active {
    border-color: var(--accent);
    border-width: 1.5px;
    box-shadow: 0 0 0 3px rgba(138,58,31,.08), var(--shadow);
  }

  .tier-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 4px;
  }

  .tier-price {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px;
    color: var(--accent);
    font-weight: 600;
    margin: 6px 0 8px;
  }

  .tier-price small {
    font-size: 14px;
    color: var(--ink-soft);
    font-weight: 400;
    font-family: 'Inter', sans-serif;
  }

  .tier-note {
    font-size: 12px;
    color: var(--ink-soft);
    line-height: 1.5;
  }

  /* ── Participants ─────────────────────────────────────── */
  .participant {
    background: #fff;
    border: 1px solid var(--rule);
    padding: 22px 22px 14px;
    margin-bottom: 16px;
    position: relative;
  }

  .participant-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px dashed var(--rule);
  }

  .participant-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px;
    font-weight: 600;
    color: var(--accent);
    letter-spacing: .05em;
  }

  .remove-btn {
    background: transparent;
    border: 1px solid var(--rule);
    color: var(--ink-soft);
    font-size: 11px;
    padding: 4px 10px;
    cursor: pointer;
    letter-spacing: .1em;
    text-transform: uppercase;
    transition: all .15s;
    font-family: 'Inter', sans-serif;
  }
  .remove-btn:hover {
    border-color: var(--accent);
    color: var(--accent);
  }

  .add-participant {
    width: 100%;
    background: transparent;
    border: 1.5px dashed var(--rule);
    color: var(--accent);
    padding: 14px;
    font-family: 'Inter', sans-serif;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .15em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .15s;
    margin-top: 4px;
  }
  .add-participant:hover {
    border-color: var(--accent);
    background: rgba(138,58,31,.04);
  }

  /* ── Investment summary ──────────────────────────────── */
  .summary {
    background: var(--ink);
    color: var(--paper);
    padding: 28px 30px;
    margin: 32px 0 12px;
    position: relative;
  }

  .summary::before {
    content: "";
    position: absolute;
    top: -1px; left: 12px; right: 12px;
    height: 1px;
    background: var(--gold);
  }

  .summary-row {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding: 6px 0;
    font-size: 14px;
  }

  .summary-row.total {
    border-top: 1px solid rgba(255,255,255,.2);
    margin-top: 10px;
    padding-top: 14px;
  }

  .summary-row.total .summary-label {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    color: #fff;
    font-weight: 600;
  }

  .summary-row.total .summary-val {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px;
    color: var(--gold);
    font-weight: 700;
  }

  .summary-label {
    color: rgba(247,243,236,.7);
  }

  .summary-val {
    color: var(--paper);
    font-weight: 600;
    font-variant-numeric: tabular-nums;
  }

  .eligibility {
    margin-top: 14px;
    padding: 10px 14px;
    font-size: 12px;
    background: rgba(176,138,62,.15);
    border-left: 2px solid var(--gold);
    color: var(--paper);
    line-height: 1.5;
  }

  /* ── Checkbox list ───────────────────────────────────── */
  .check-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .check-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 14px;
    color: var(--ink-soft);
    line-height: 1.5;
    cursor: pointer;
  }

  .check-row input[type="checkbox"] {
    margin-top: 3px;
    accent-color: var(--accent);
    width: 16px;
    height: 16px;
    cursor: pointer;
  }

  /* ── Submit ──────────────────────────────────────────── */
  .actions {
    display: flex;
    gap: 12px;
    margin-top: 36px;
    align-items: center;
  }

  button.submit {
    background: var(--accent);
    color: var(--paper);
    border: none;
    padding: 16px 38px;
    font-family: 'Inter', sans-serif;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .2em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .2s;
    border-radius: 2px;
  }
  button.submit:hover {
    background: var(--accent-dk);
    transform: translateY(-1px);
    box-shadow: var(--shadow-lg);
  }

  button.secondary {
    background: transparent;
    border: 1px solid var(--rule);
    color: var(--ink-soft);
    padding: 16px 24px;
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: .15em;
    text-transform: uppercase;
    cursor: pointer;
    border-radius: 2px;
    transition: all .15s;
  }
  button.secondary:hover {
    border-color: var(--accent);
    color: var(--accent);
  }

  .help-text {
    font-size: 12px;
    color: var(--ink-soft);
    margin-top: 4px;
    font-style: italic;
  }

  .payment-details {
    display: none;
    margin-top: 16px;
    padding: 18px 22px;
    background: var(--paper-warm);
    border-left: 3px solid var(--gold);
    font-size: 14px;
    line-height: 1.6;
    color: var(--ink-soft);
  }

  .payment-details.show { display: block; }

  .payment-details p {
    margin: 0 0 10px;
  }

  .payment-details p:last-child { margin-bottom: 0; }

  .payment-details strong {
    color: var(--ink);
    font-weight: 600;
  }

  .payment-copy-row {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 10px;
  }

  .payment-copy-row:last-child { margin-bottom: 0; }

  .payment-copy-label {
    font-size: 11px;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--ink-soft);
    font-weight: 600;
    min-width: 120px;
  }

  .payment-copy-value {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    font-weight: 600;
    color: var(--accent);
    font-variant-numeric: tabular-nums;
  }

  .copy-btn {
    background: transparent;
    border: 1px solid var(--rule);
    color: var(--ink-soft);
    font-size: 11px;
    padding: 5px 12px;
    cursor: pointer;
    letter-spacing: .1em;
    text-transform: uppercase;
    transition: all .15s;
    font-family: 'Inter', sans-serif;
    margin-left: auto;
  }

  .copy-btn:hover {
    border-color: var(--accent);
    color: var(--accent);
  }

  .copy-btn.copied {
    border-color: var(--moss);
    color: var(--moss);
  }

  /* ── Footer ──────────────────────────────────────────── */
  footer.foot {
    text-align: center;
    margin-top: 56px;
    padding-top: 28px;
    border-top: 1px solid var(--rule);
    font-size: 12px;
    color: var(--ink-soft);
    line-height: 1.7;
  }

  footer.foot .ubuntu {
    font-family: 'Cormorant Garamond', serif;
    font-style: italic;
    font-size: 17px;
    color: var(--accent);
    margin-bottom: 12px;
  }

  /* ── Responsive ──────────────────────────────────────── */
  @media (max-width: 640px) {
    .page { padding: 32px 18px 56px; }
    h1.title { font-size: 38px; }
    .field-grid, .glance, .tiers { grid-template-columns: 1fr; }
    .glance-item { border-right: none; }
    .section-head { flex-wrap: wrap; }
    .section-sub { margin-left: 0; }
  }

  /* Validation */
  .field.is-invalid input,
  .field.is-invalid select,
  .field.is-invalid textarea {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(138,58,31,.12);
  }

  .field-error {
    font-size: 12px;
    color: var(--accent);
    margin-top: 5px;
    line-height: 1.4;
  }

  .form-alert {
    display: none;
    padding: 14px 18px;
    margin-bottom: 24px;
    font-size: 14px;
    line-height: 1.5;
    border-left: 3px solid var(--accent);
    background: rgba(138,58,31,.08);
    color: var(--ink);
  }

  .form-alert.show { display: block; }
  .form-alert.success {
    border-left-color: var(--moss);
    background: rgba(74,90,50,.12);
  }

  .check-row.is-invalid span {
    color: var(--accent);
  }

  button.submit:disabled {
    opacity: .65;
    cursor: not-allowed;
    transform: none;
  }

  button.submit .spinner {
    display: inline-block;
    width: 14px;
    height: 14px;
    border: 2px solid rgba(247,243,236,.4);
    border-top-color: var(--paper);
    border-radius: 50%;
    animation: spin .7s linear infinite;
    margin-right: 8px;
    vertical-align: -2px;
  }

  @keyframes spin { to { transform: rotate(360deg); } }

  /* Print */
  @media print {
    body { background: white; }
    .actions, .add-participant, .remove-btn { display: none; }
    .page { padding: 20px; }
  }
</style>
</head>
@endverbatim
<body>
<script>window.__REG__ = @json(['csrf' => csrf_token(), 'submitUrl' => route('registrations.store')]); window.__PAYMENT__ = @json($paymentConfig);</script>
@verbatim

<div class="page">

  <!-- Letterhead -->
  <header class="letterhead">
    <div class="conveners">
      <span>Africa Special Needs Education Network</span> · <span>Acorn Special Tutorials</span>
    </div>
    <div class="ornament">❦</div>
    <h1 class="title">Inclusive by Design</h1>
    <div class="subtitle">Building Future-Ready Classrooms for Diverse Learners</div>
    <div class="form-label">Registration · Three-Day Professional Masterclass</div>
  </header>

  <!-- Preamble -->
  <div class="preamble">
    In the spirit of <strong>Ubuntu — “I am because we are”</strong> — we warmly invite your school to journey with us. Kindly complete this form to reserve places for your nominated educators. As cohort numbers are deliberately limited, early registration is encouraged.
  </div>

  <!-- At-a-Glance -->
  <div class="glance">
    <div class="glance-item">
      <div class="glance-label">Dates</div>
      <div class="glance-value">14 – 16 July 2026</div>
    </div>
    <div class="glance-item">
      <div class="glance-label">Daily Hours</div>
      <div class="glance-value">8:30 a.m. – 3:30 p.m.</div>
    </div>
    <div class="glance-item">
      <div class="glance-label">Venue</div>
      <div class="glance-value">Maison Ubuntu Training &amp; Conference Centre, Dagoretti</div>
    </div>
    <div class="glance-item">
      <div class="glance-label">Final Deadline</div>
      <div class="glance-value">Friday, 27 June 2026</div>
    </div>
  </div>

  <div class="form-alert" id="formAlert" role="alert"></div>

  <form id="regForm" novalidate>

    <!-- SECTION 1: School Information -->
    <section class="section">
      <div class="section-head">
        <span class="section-num">I.</span>
        <h2 class="section-title">School Information</h2>
        <span class="section-sub">The institution registering nominees</span>
      </div>

      <div class="field-grid">
        <div class="field full">
          <label>Name of School <span class="req">*</span></label>
          <input type="text" name="school_name" required>
        </div>
        <div class="field">
          <label>School Type <span class="req">*</span></label>
          <select name="school_type" required>
            <option value="">— Select —</option>
            <option>Public Primary</option>
            <option>Public Secondary</option>
            <option>Private Primary</option>
            <option>Private Secondary</option>
            <option>Special Needs School</option>
            <option>International School</option>
            <option>Faith-based / Mission</option>
            <option>Other</option>
          </select>
        </div>
        <div class="field">
          <label>County / Region <span class="req">*</span></label>
          <input type="text" name="county" required>
        </div>
        <div class="field full">
          <label>Postal &amp; Physical Address</label>
          <input type="text" name="address">
        </div>
        <div class="field">
          <label>School Telephone <span class="req">*</span></label>
          <input type="tel" name="school_phone" required placeholder="+254…">
        </div>
        <div class="field">
          <label>Official School Email <span class="req">*</span></label>
          <input type="email" name="school_email" required>
        </div>
      </div>
    </section>

    <!-- SECTION 2: Lead Contact -->
    <section class="section">
      <div class="section-head">
        <span class="section-num">II.</span>
        <h2 class="section-title">Lead Contact</h2>
        <span class="section-sub">Head of School or designated representative</span>
      </div>

      <div class="field-grid">
        <div class="field">
          <label>Full Name <span class="req">*</span></label>
          <input type="text" name="lead_name" required>
        </div>
        <div class="field">
          <label>Role / Title <span class="req">*</span></label>
          <input type="text" name="lead_role" required placeholder="e.g. Head Teacher, Director">
        </div>
        <div class="field">
          <label>Mobile Telephone <span class="req">*</span></label>
          <input type="tel" name="lead_phone" required placeholder="+254…">
        </div>
        <div class="field">
          <label>Email Address <span class="req">*</span></label>
          <input type="email" name="lead_email" required>
        </div>
      </div>
    </section>

    <!-- SECTION 3: Registration Tier -->
    <section class="section">
      <div class="section-head">
        <span class="section-num">III.</span>
        <h2 class="section-title">Registration Tier</h2>
        <span class="section-sub">Auto-selected based on team size</span>
      </div>

      <div class="tiers">
        <label class="tier" data-tier="standard">
          <input type="radio" name="tier" value="standard" checked>
          <div class="tier-name">Standard Registration</div>
          <div class="tier-price">KShs. 25,000 <small>/ participant</small></div>
          <div class="tier-note">Individual or single-school registrations. Closes Friday, 27 June 2026.</div>
        </label>

        <label class="tier" data-tier="earlybird">
          <input type="radio" name="tier" value="earlybird">
          <div class="tier-name">School-Team Early Bird</div>
          <div class="tier-price">KShs. 20,000 <small>/ participant</small></div>
          <div class="tier-note">Teams of three or more from one school. Register by <strong>Friday, 12 June 2026</strong>.</div>
        </label>
      </div>
    </section>

    <!-- SECTION 4: Participants -->
    <section class="section">
      <div class="section-head">
        <span class="section-num">IV.</span>
        <h2 class="section-title">Nominated Participants</h2>
        <span class="section-sub">Add one row per nominee</span>
      </div>

      <div id="participantsList"></div>
      <button type="button" class="add-participant" id="addParticipantBtn">＋  Add another participant</button>
    </section>

    <!-- SECTION 5: Accessibility & Dietary -->
    <section class="section">
      <div class="section-head">
        <span class="section-num">V.</span>
        <h2 class="section-title">Access &amp; Dietary Needs</h2>
        <span class="section-sub">So we may hold every participant well</span>
      </div>

      <div class="field-grid full">
        <div class="field full">
          <label>Accessibility requirements (mobility, sensory, language)</label>
          <textarea name="accessibility" placeholder="e.g. Sign language interpretation, wheelchair access, large print materials…"></textarea>
        </div>
        <div class="field full">
          <label>Dietary requirements</label>
          <textarea name="dietary" placeholder="e.g. Halal, vegetarian, gluten-free, allergies…"></textarea>
        </div>
      </div>
    </section>

    <!-- SECTION 6: Payment & Confirmation -->
    <section class="section">
      <div class="section-head">
        <span class="section-num">VI.</span>
        <h2 class="section-title">Payment &amp; Confirmation</h2>
      </div>

      <div class="field-grid full">
        <div class="field full">
          <label>Preferred Mode of Payment <span class="req">*</span></label>
          <select name="payment_mode" id="paymentMode" required>
            <option value="">— Select —</option>
          </select>
          <div class="help-text">Payments are made to Africa Special Needs Education Network as follows:</div>

          <div id="paymentDetails" class="payment-details">
            <div id="paymentDetailKcb" class="payment-detail-block" hidden>
              <p><strong>KCB Bank Account</strong></p>
              <p>Account name: <strong id="kcbAccountName">—</strong><br>
              Account number: <strong id="kcbAccountNumber">—</strong></p>
            </div>
            <div id="paymentDetailPaybill" class="payment-detail-block" hidden>
              <p><strong>M-Pesa Paybill</strong></p>
              <div class="payment-copy-row">
                <span class="payment-copy-label">Paybill Number</span>
                <span class="payment-copy-value" id="paybillNumberDisplay">—</span>
                <button type="button" class="copy-btn" id="copyPaybillBtn" data-copy="">Copy</button>
              </div>
              <div class="payment-copy-row">
                <span class="payment-copy-label">Account Number</span>
                <span class="payment-copy-value" id="paybillAccountDisplay">—</span>
                <button type="button" class="copy-btn" id="copyPaybillAccountBtn" data-copy="">Copy</button>
              </div>
            </div>
            <div id="paymentDetailCheque" class="payment-detail-block" hidden>
              <p><strong>Cheque</strong></p>
              <p>Cheque payable to <strong id="chequePayeeDisplay">—</strong>.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Investment Summary -->
      <div class="summary">
        <div class="summary-row">
          <span class="summary-label">Number of participants</span>
          <span class="summary-val" id="sumCount">0</span>
        </div>
        <div class="summary-row">
          <span class="summary-label">Rate per participant</span>
          <span class="summary-val" id="sumRate">KShs. 25,000</span>
        </div>
        <div class="summary-row total">
          <span class="summary-label">Total Investment</span>
          <span class="summary-val" id="sumTotal">KShs. 0</span>
        </div>
        <div class="eligibility" id="eligibility">Add three or more participants to qualify for the School-Team Early Bird rate (KShs. 20,000 per participant).</div>
      </div>

      <div class="field full" style="margin-top: 28px;">
        <div class="check-list">
          <label class="check-row">
            <input type="checkbox" name="confirm_authority" required>
            <span>I confirm that I am authorised by my school to register the participants named above and to commit the school to the indicated investment.</span>
          </label>
          <label class="check-row">
            <input type="checkbox" name="confirm_attendance" required>
            <span>I understand that all nominated participants will attend the full three-day Masterclass (14 – 16 July 2026) and that places are allocated on a first-confirmed basis.</span>
          </label>
          <label class="check-row">
            <input type="checkbox" name="consent_comms">
            <span>I consent to receive Masterclass correspondence and ongoing communications from the post-Masterclass professional network of inclusive educators.</span>
          </label>
        </div>
      </div>

      <div class="actions">
        <button type="submit" class="submit" id="submitBtn">Submit Registration</button>
        <button type="button" class="secondary" id="printBtn">Print / Save PDF</button>
      </div>

      <p class="help-text" style="margin-top: 16px;">On submission, your registration is sent securely to the Masterclass Secretariat. We will respond within two working days with confirmation and payment details. You may also print or save this form as a PDF for your records.</p>
    </section>

  </form>

  <!-- Footer -->
  <footer class="foot">
    <div class="ubuntu">“I am because we are.”</div>
    <div>Masterclass Secretariat</div>
    <div>info@asnenafrica.org &nbsp;·&nbsp; info@acorn.co.ke</div>
    <div>+254 703 906 990 &nbsp;·&nbsp; +254 712 652 621</div>
  </footer>

</div>

<script>
(function() {
  const STANDARD_RATE = 25000;
  const EARLYBIRD_RATE = 20000;
  const EARLYBIRD_MIN = 3;

  const list = document.getElementById('participantsList');
  const addBtn = document.getElementById('addParticipantBtn');
  const sumCount = document.getElementById('sumCount');
  const sumRate = document.getElementById('sumRate');
  const sumTotal = document.getElementById('sumTotal');
  const eligibility = document.getElementById('eligibility');
  const tiers = document.querySelectorAll('.tier');
  const tierRadios = document.querySelectorAll('input[name="tier"]');
  const form = document.getElementById('regForm');
  const formAlert = document.getElementById('formAlert');
  const submitBtn = document.getElementById('submitBtn');

  let participantCount = 0;

  const FIELD_LABELS = {
    school_name: 'Name of School',
    school_type: 'School Type',
    county: 'County / Region',
    school_phone: 'School Telephone',
    school_email: 'Official School Email',
    lead_name: 'Lead Contact Name',
    lead_role: 'Lead Contact Role',
    lead_phone: 'Lead Contact Mobile',
    lead_email: 'Lead Contact Email',
    tier: 'Registration Tier',
    payment_mode: 'Preferred Mode of Payment',
    confirm_authority: 'Authorisation confirmation',
    confirm_attendance: 'Attendance confirmation',
  };

  function fmtKsh(n) {
    return 'KShs. ' + n.toLocaleString('en-KE');
  }

  function makeParticipantRow(index) {
    const div = document.createElement('div');
    div.className = 'participant';
    div.dataset.idx = index;
    div.innerHTML = `
      <div class="participant-head">
        <div class="participant-num">Participant ${index}</div>
        <button type="button" class="remove-btn" onclick="removeParticipant(this)">Remove</button>
      </div>
      <div class="field-grid">
        <div class="field">
          <label>Full Name <span class="req">*</span></label>
          <input type="text" name="p_name_${index}" required>
        </div>
        <div class="field">
          <label>Role / Designation <span class="req">*</span></label>
          <select name="p_role_${index}" required>
            <option value="">— Select —</option>
            <option>Head of School</option>
            <option>Deputy Head</option>
            <option>Head of Department</option>
            <option>Special Needs Co-ordinator (SENCO)</option>
            <option>Classroom Teacher</option>
            <option>Curriculum Designer</option>
            <option>Counsellor / Therapist</option>
            <option>Other</option>
          </select>
        </div>
        <div class="field">
          <label>Subject / Grade Taught</label>
          <input type="text" name="p_subject_${index}" placeholder="e.g. Lower Primary, Mathematics">
        </div>
        <div class="field">
          <label>Years of Experience</label>
          <input type="number" name="p_years_${index}" min="0" max="60">
        </div>
        <div class="field">
          <label>Mobile Telephone <span class="req">*</span></label>
          <input type="tel" name="p_phone_${index}" required placeholder="+254…">
        </div>
        <div class="field">
          <label>Email Address <span class="req">*</span></label>
          <input type="email" name="p_email_${index}" required>
        </div>
      </div>
    `;
    list.appendChild(div);
  }

  window.removeParticipant = function(btn) {
    if (participantCount <= 1) {
      alert('At least one participant is required.');
      return;
    }
    btn.closest('.participant').remove();
    renumberParticipants();
    updateSummary();
  };

  function renumberParticipants() {
    const items = list.querySelectorAll('.participant');
    participantCount = items.length;
    items.forEach((el, i) => {
      const newIdx = i + 1;
      el.dataset.idx = newIdx;
      el.querySelector('.participant-num').textContent = 'Participant ' + newIdx;
      // Rename field names for consistent submission
      el.querySelectorAll('[name]').forEach(input => {
        const oldName = input.name;
        const base = oldName.replace(/_\d+$/, '');
        input.name = base + '_' + newIdx;
      });
    });
  }

  function addParticipant() {
    participantCount++;
    makeParticipantRow(participantCount);
    updateSummary();
  }

  function updateSummary() {
    const count = list.querySelectorAll('.participant').length;
    const eligible = count >= EARLYBIRD_MIN;

    // Auto-select appropriate tier based on count
    if (eligible) {
      tierRadios[1].checked = true; // earlybird
    } else {
      tierRadios[0].checked = true; // standard
    }
    syncTierUI();

    const rate = eligible ? EARLYBIRD_RATE : STANDARD_RATE;
    const total = rate * count;

    sumCount.textContent = count;
    sumRate.textContent = fmtKsh(rate);
    sumTotal.textContent = fmtKsh(total);

    if (eligible) {
      eligibility.style.background = 'rgba(74,90,50,.25)';
      eligibility.style.borderLeftColor = '#8aa860';
      eligibility.innerHTML = '✓ This team qualifies for the <strong>School-Team Early Bird</strong> rate. A saving of <strong>' + fmtKsh((STANDARD_RATE - EARLYBIRD_RATE) * count) + '</strong> compared to standard registration.';
    } else {
      const needed = EARLYBIRD_MIN - count;
      eligibility.style.background = 'rgba(176,138,62,.15)';
      eligibility.style.borderLeftColor = 'var(--gold)';
      eligibility.innerHTML = 'Add ' + needed + ' more participant' + (needed === 1 ? '' : 's') + ' to qualify for the <strong>School-Team Early Bird</strong> rate (KShs. 20,000 per participant) — register by Friday, 12 June 2026.';
    }
  }

  function syncTierUI() {
    tiers.forEach(t => {
      const radio = t.querySelector('input[type="radio"]');
      if (radio.checked) t.classList.add('active');
      else t.classList.remove('active');
    });
  }

  tiers.forEach(t => {
    t.addEventListener('click', () => {
      const radio = t.querySelector('input[type="radio"]');
      radio.checked = true;
      syncTierUI();
      updateSummary();
    });
  });

  addBtn.addEventListener('click', addParticipant);

  // Start with one participant
  addParticipant();
  syncTierUI();

  function clearErrors() {
    form.querySelectorAll('.field.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    form.querySelectorAll('.field-error').forEach(el => el.remove());
    form.querySelectorAll('.check-row.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    formAlert.classList.remove('show', 'success');
    formAlert.textContent = '';
  }

  function showFieldError(fieldEl, message) {
    if (!fieldEl) return;
    const wrap = fieldEl.closest('.field') || fieldEl.closest('.check-row');
    if (!wrap) return;
    wrap.classList.add('is-invalid');
    let err = wrap.querySelector('.field-error');
    if (!err) {
      err = document.createElement('div');
      err.className = 'field-error';
      wrap.appendChild(err);
    }
    err.textContent = message;
  }

  function collectParticipants() {
    return Array.from(list.querySelectorAll('.participant')).map((row, i) => {
      const idx = i + 1;
      return {
        name: (row.querySelector('[name="p_name_' + idx + '"]') || {}).value?.trim() || '',
        role: (row.querySelector('[name="p_role_' + idx + '"]') || {}).value || '',
        subject: (row.querySelector('[name="p_subject_' + idx + '"]') || {}).value?.trim() || null,
        years: (() => {
          const v = (row.querySelector('[name="p_years_' + idx + '"]') || {}).value;
          return v === '' || v == null ? null : Number(v);
        })(),
        phone: (row.querySelector('[name="p_phone_' + idx + '"]') || {}).value?.trim() || '',
        email: (row.querySelector('[name="p_email_' + idx + '"]') || {}).value?.trim() || '',
      };
    });
  }

  function buildPayload() {
    const fd = new FormData(form);
    return {
      school_name: fd.get('school_name')?.trim(),
      school_type: fd.get('school_type'),
      county: fd.get('county')?.trim(),
      address: fd.get('address')?.trim() || null,
      school_phone: fd.get('school_phone')?.trim(),
      school_email: fd.get('school_email')?.trim(),
      lead_name: fd.get('lead_name')?.trim(),
      lead_role: fd.get('lead_role')?.trim(),
      lead_phone: fd.get('lead_phone')?.trim(),
      lead_email: fd.get('lead_email')?.trim(),
      tier: fd.get('tier'),
      participants: collectParticipants(),
      accessibility: fd.get('accessibility')?.trim() || null,
      dietary: fd.get('dietary')?.trim() || null,
      payment_mode: fd.get('payment_mode'),
      confirm_authority: !!fd.get('confirm_authority'),
      confirm_attendance: !!fd.get('confirm_attendance'),
      consent_comms: !!fd.get('consent_comms'),
    };
  }

  function validateClient(payload) {
    const errors = {};
    const req = (key, msg) => { if (!payload[key]) errors[key] = msg; };

    req('school_name', 'Please enter the name of your school.');
    req('school_type', 'Please select a school type.');
    req('county', 'Please enter your county or region.');
    req('school_phone', 'Please enter the school telephone number.');
    if (!payload.school_email) errors.school_email = 'Please enter the official school email.';
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(payload.school_email)) errors.school_email = 'Please enter a valid school email.';

    req('lead_name', 'Please enter the lead contact name.');
    req('lead_role', 'Please enter the lead contact role.');
    req('lead_phone', 'Please enter the lead contact mobile number.');
    if (!payload.lead_email) errors.lead_email = 'Please enter the lead contact email.';
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(payload.lead_email)) errors.lead_email = 'Please enter a valid lead contact email.';

    req('payment_mode', 'Please select a preferred payment method.');
    if (!payload.confirm_authority) errors.confirm_authority = 'You must confirm you are authorised to register.';
    if (!payload.confirm_attendance) errors.confirm_attendance = 'You must confirm full three-day attendance.';

    if (!payload.participants.length) {
      errors.participants = 'Please add at least one participant.';
    } else {
      payload.participants.forEach((p, i) => {
        const n = i + 1;
        if (!p.name) errors['participants.' + i + '.name'] = 'Participant ' + n + ': please enter a full name.';
        if (!p.role) errors['participants.' + i + '.role'] = 'Participant ' + n + ': please select a role.';
        if (!p.phone) errors['participants.' + i + '.phone'] = 'Participant ' + n + ': please enter a mobile number.';
        if (!p.email) errors['participants.' + i + '.email'] = 'Participant ' + n + ': please enter an email address.';
        else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(p.email)) errors['participants.' + i + '.email'] = 'Participant ' + n + ': please enter a valid email.';
      });
    }

    return errors;
  }

  function applyErrors(rawErrors) {
    clearErrors();
    const errors = {};
    Object.keys(rawErrors).forEach(k => {
      errors[k] = Array.isArray(rawErrors[k]) ? rawErrors[k][0] : rawErrors[k];
    });
    const keys = Object.keys(errors);
    if (!keys.length) return;

    keys.forEach(key => {
      const msg = errors[key];
      const pMatch = key.match(/^participants\.(\d+)\.(\w+)$/);
      if (pMatch) {
        const row = list.querySelectorAll('.participant')[parseInt(pMatch[1], 10)];
        const idx = parseInt(pMatch[1], 10) + 1;
        const field = row?.querySelector('[name="p_' + pMatch[2] + '_' + idx + '"]');
        showFieldError(field, msg);
        return;
      }
      if (key === 'confirm_authority' || key === 'confirm_attendance') {
        showFieldError(form.querySelector('[name="' + key + '"]'), msg);
        return;
      }
      const input = form.querySelector('[name="' + key + '"]');
      showFieldError(input, msg);
    });

    formAlert.textContent = 'Please correct the highlighted fields before submitting.';
    formAlert.classList.add('show');
    const firstInvalid = form.querySelector('.is-invalid');
    if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }

  function setSubmitting(loading) {
    submitBtn.disabled = loading;
    if (loading) {
      submitBtn.dataset.originalText = submitBtn.textContent;
      submitBtn.innerHTML = '<span class="spinner"></span>Submitting…';
    } else {
      submitBtn.textContent = submitBtn.dataset.originalText || 'Submit Registration';
    }
  }

  // ── Submission (AJAX) ─────────────────────────────────
  form.addEventListener('submit', async function(e) {
    e.preventDefault();
    clearErrors();

    const payload = buildPayload();
    const clientErrors = validateClient(payload);
    if (Object.keys(clientErrors).length) {
      applyErrors(clientErrors);
      return;
    }

    setSubmitting(true);

    try {
      const res = await fetch(window.__REG__.submitUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': window.__REG__.csrf,
          'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify(payload),
      });

      const data = await res.json().catch(() => ({}));

      if (res.status === 422) {
        applyErrors(data.errors || {});
        if (data.message && !Object.keys(data.errors || {}).length) {
          formAlert.textContent = data.message;
          formAlert.classList.add('show');
        }
        return;
      }

      if (!res.ok) {
        formAlert.textContent = data.message || 'Something went wrong. Please try again or contact the Secretariat.';
        formAlert.classList.add('show');
        return;
      }

      window.location.href = data.redirect_url || ('/thank-you/' + encodeURIComponent(data.reference));
    } catch (err) {
      formAlert.textContent = 'Unable to reach the server. Please check your connection and try again.';
      formAlert.classList.add('show');
    } finally {
      setSubmitting(false);
    }
  });

  form.querySelectorAll('input, select, textarea').forEach(el => {
    el.addEventListener('input', () => {
      const wrap = el.closest('.field, .check-row');
      if (wrap?.classList.contains('is-invalid')) {
        wrap.classList.remove('is-invalid');
        wrap.querySelector('.field-error')?.remove();
      }
    });
  });

  const paymentModeSelect = document.getElementById('paymentMode');
  const paymentDetails = document.getElementById('paymentDetails');
  const PAYMENT_BLOCKS = {};

  function initPaymentFromConfig() {
    const p = window.__PAYMENT__;
    if (!p || !p.options) return;

    Object.entries(p.options).forEach(([key, label]) => {
      if (!label) return;
      const opt = document.createElement('option');
      opt.value = label;
      opt.textContent = label;
      paymentModeSelect.appendChild(opt);
      const blockId = key === 'kcb' ? 'paymentDetailKcb' : key === 'paybill' ? 'paymentDetailPaybill' : 'paymentDetailCheque';
      PAYMENT_BLOCKS[label] = blockId;
    });

    if (p.kcb) {
      document.getElementById('kcbAccountName').textContent = p.kcb.name || '—';
      document.getElementById('kcbAccountNumber').textContent = p.kcb.number || '—';
    }
    if (p.paybill) {
      document.getElementById('paybillNumberDisplay').textContent = p.paybill.number || '—';
      document.getElementById('paybillAccountDisplay').textContent = p.paybill.account || '—';
      const copyPaybill = document.getElementById('copyPaybillBtn');
      const copyAccount = document.getElementById('copyPaybillAccountBtn');
      copyPaybill.dataset.copy = p.paybill.number || '';
      copyAccount.dataset.copy = p.paybill.account || '';
    }
    if (p.cheque) {
      document.getElementById('chequePayeeDisplay').textContent = p.cheque.payee || '—';
    }
  }

  initPaymentFromConfig();

  function updatePaymentDetails() {
    const val = paymentModeSelect.value;
    paymentDetails.querySelectorAll('.payment-detail-block').forEach(el => {
      el.hidden = true;
    });
    if (val && PAYMENT_BLOCKS[val]) {
      paymentDetails.classList.add('show');
      document.getElementById(PAYMENT_BLOCKS[val]).hidden = false;
    } else {
      paymentDetails.classList.remove('show');
    }
  }

  async function copyToClipboard(text, btn) {
    try {
      if (navigator.clipboard?.writeText) {
        await navigator.clipboard.writeText(text);
      } else {
        const ta = document.createElement('textarea');
        ta.value = text;
        ta.style.position = 'fixed';
        ta.style.left = '-9999px';
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        document.body.removeChild(ta);
      }
      const original = btn.textContent;
      btn.textContent = 'Copied';
      btn.classList.add('copied');
      setTimeout(() => {
        btn.textContent = original;
        btn.classList.remove('copied');
      }, 2000);
    } catch (err) {
      btn.textContent = 'Failed';
      setTimeout(() => { btn.textContent = 'Copy'; }, 2000);
    }
  }

  paymentModeSelect.addEventListener('change', updatePaymentDetails);
  paymentDetails.querySelectorAll('.copy-btn').forEach(btn => {
    btn.addEventListener('click', () => copyToClipboard(btn.dataset.copy, btn));
  });
  updatePaymentDetails();

  document.getElementById('printBtn').addEventListener('click', () => window.print());

})();
</script>

</body>
</html>

@endverbatim