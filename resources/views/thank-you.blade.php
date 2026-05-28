<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thank You · Inclusive by Design Masterclass</title>
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
    --accent:     #8a3a1f;
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
    min-height: 100vh;
  }

  body::before {
    content: "";
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 0;
    background-image:
      radial-gradient(circle at 20% 20%, rgba(176,138,62,.06) 0, transparent 45%),
      radial-gradient(circle at 85% 80%, rgba(138,58,31,.05) 0, transparent 50%);
  }

  .page {
    position: relative;
    z-index: 1;
    max-width: 720px;
    margin: 0 auto;
    padding: 48px 28px 72px;
    animation: pageIn .8s ease-out both;
  }

  @keyframes pageIn {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  header.letterhead {
    text-align: center;
    border-bottom: 1px solid var(--rule);
    padding-bottom: 28px;
    margin-bottom: 36px;
  }

  .conveners {
    font-size: 11px;
    letter-spacing: .22em;
    text-transform: uppercase;
    color: var(--ink-soft);
    margin-bottom: 20px;
    font-weight: 500;
  }

  .ornament {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    margin: 12px 0 18px;
    color: var(--gold);
    font-size: 13px;
    animation: ornamentIn 1s ease-out .3s both;
  }

  @keyframes ornamentIn {
    from { opacity: 0; transform: scale(.85); }
    to   { opacity: 1; transform: scale(1); }
  }

  .ornament::before,
  .ornament::after {
    content: "";
    height: 1px;
    width: 48px;
    background: var(--rule);
  }

  .hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-weight: 500;
    font-size: clamp(42px, 8vw, 56px);
    line-height: 1.05;
    margin: 0 0 12px;
    color: var(--ink);
    letter-spacing: -.02em;
    animation: heroIn .9s ease-out .15s both;
  }

  @keyframes heroIn {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .hero-lead {
    font-family: 'Cormorant Garamond', serif;
    font-style: italic;
    font-size: 20px;
    color: var(--ink-soft);
    margin: 0;
    animation: heroIn .9s ease-out .25s both;
  }

  .ubuntu-banner {
    text-align: center;
    margin: 32px 0 36px;
    padding: 20px 24px;
    background: var(--paper-warm);
    border-left: 3px solid var(--accent);
    animation: heroIn .9s ease-out .35s both;
  }

  .ubuntu-banner q {
    font-family: 'Cormorant Garamond', serif;
    font-size: 22px;
    font-style: italic;
    color: var(--accent);
    quotes: "\201C" "\201D";
  }

  .ref-card {
    text-align: center;
    background: var(--ink);
    color: var(--paper);
    padding: 32px 28px;
    margin-bottom: 32px;
    position: relative;
    box-shadow: var(--shadow-lg);
    animation: heroIn .9s ease-out .4s both;
  }

  .ref-card::before {
    content: "";
    position: absolute;
    top: 0; left: 16px; right: 16px;
    height: 3px;
    background: var(--gold);
  }

  .ref-label {
    font-size: 10px;
    letter-spacing: .28em;
    text-transform: uppercase;
    color: rgba(247,243,236,.65);
    margin-bottom: 10px;
  }

  .ref-value {
    font-family: 'Cormorant Garamond', serif;
    font-size: 36px;
    font-weight: 600;
    color: var(--gold);
    letter-spacing: .12em;
    margin: 0;
  }

  .ref-hint {
    font-size: 13px;
    color: rgba(247,243,236,.75);
    margin: 14px 0 0;
    font-style: italic;
  }

  .summary {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    border: 1px solid var(--rule);
    background: #fff;
    margin-bottom: 36px;
    animation: heroIn .9s ease-out .5s both;
  }

  .summary-item {
    padding: 14px 18px;
    border-bottom: 1px solid var(--rule);
    border-right: 1px solid var(--rule);
  }

  .summary-item:nth-child(2n) { border-right: none; }
  .summary-item:nth-last-child(-n+2) { border-bottom: none; }
  .summary-item.full { grid-column: 1 / -1; border-right: none; }

  .summary-label {
    font-size: 10px;
    letter-spacing: .2em;
    text-transform: uppercase;
    color: var(--ink-soft);
    margin-bottom: 4px;
    font-weight: 500;
  }

  .summary-value {
    font-size: 14px;
    color: var(--ink);
    font-weight: 500;
  }

  .summary-value.emphasis {
    font-family: 'Cormorant Garamond', serif;
    font-size: 22px;
    color: var(--accent);
    font-weight: 600;
  }

  .next-steps {
    margin-bottom: 40px;
    animation: heroIn .9s ease-out .55s both;
  }

  .next-steps h2 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 26px;
    font-weight: 600;
    margin: 0 0 20px;
    color: var(--ink);
    padding-bottom: 10px;
    border-bottom: 1px solid var(--rule);
  }

  .timeline {
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
  }

  .timeline::before {
    content: "";
    position: absolute;
    left: 15px;
    top: 8px;
    bottom: 8px;
    width: 1px;
    background: var(--rule);
  }

  .timeline li {
    position: relative;
    padding: 0 0 24px 44px;
  }

  .timeline li:last-child { padding-bottom: 0; }

  .timeline-num {
    position: absolute;
    left: 0;
    top: 0;
    width: 32px;
    height: 32px;
    border: 1px solid var(--gold);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Cormorant Garamond', serif;
    font-size: 16px;
    font-weight: 600;
    color: var(--gold);
    background: var(--paper);
  }

  .timeline-title {
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 4px;
  }

  .timeline-desc {
    font-size: 14px;
    color: var(--ink-soft);
    margin: 0;
  }

  .dates-card {
    background: var(--paper-warm);
    border: 1px solid var(--rule);
    padding: 20px 22px;
    margin-bottom: 36px;
    text-align: center;
    animation: heroIn .9s ease-out .6s both;
  }

  .dates-card .label {
    font-size: 10px;
    letter-spacing: .22em;
    text-transform: uppercase;
    color: var(--ink-soft);
    margin-bottom: 8px;
  }

  .dates-card .dates {
    font-family: 'Cormorant Garamond', serif;
    font-size: 24px;
    font-weight: 600;
    color: var(--ink);
  }

  .dates-card .venue {
    font-size: 14px;
    color: var(--ink-soft);
    margin-top: 6px;
  }

  .actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
    margin-bottom: 48px;
    animation: heroIn .9s ease-out .65s both;
  }

  .btn {
    display: inline-block;
    padding: 14px 28px;
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .18em;
    text-transform: uppercase;
    text-decoration: none;
    border-radius: 2px;
    cursor: pointer;
    transition: all .2s;
    border: none;
  }

  .btn-primary {
    background: var(--accent);
    color: var(--paper);
  }

  .btn-primary:hover {
    background: var(--accent-dk);
    transform: translateY(-1px);
    box-shadow: var(--shadow-lg);
  }

  .btn-secondary {
    background: transparent;
    border: 1px solid var(--rule);
    color: var(--ink-soft);
  }

  .btn-secondary:hover {
    border-color: var(--accent);
    color: var(--accent);
  }

  footer.foot {
    text-align: center;
    padding-top: 28px;
    border-top: 1px solid var(--rule);
    font-size: 12px;
    color: var(--ink-soft);
    line-height: 1.8;
  }

  footer.foot .ubuntu {
    font-family: 'Cormorant Garamond', serif;
    font-style: italic;
    font-size: 17px;
    color: var(--accent);
    margin-bottom: 10px;
  }

  @media (max-width: 520px) {
    .page { padding: 32px 18px 56px; }
    .summary { grid-template-columns: 1fr; }
    .summary-item { border-right: none !important; }
    .summary-item:nth-last-child(-n+2) { border-bottom: 1px solid var(--rule); }
    .summary-item:last-child { border-bottom: none; }
  }

  @media print {
    body { background: white; }
    .actions { display: none; }
    .page { padding: 20px; animation: none; }
  }
</style>
</head>
<body>

<div class="page">

  <header class="letterhead">
    <div class="conveners">
      <span>Africa Special Needs Education Network</span> · <span>Acorn Special Tutorials</span>
    </div>
    <div class="ornament">❦</div>
    <h1 class="hero-title">Thank you</h1>
    <p class="hero-lead">Your place on the journey is reserved.</p>
  </header>

  <div class="ubuntu-banner">
    <q>I am because we are</q> — your school joins a community building classrooms where every learner belongs.
  </div>

  <div class="ref-card">
    <div class="ref-label">Your registration reference</div>
    <p class="ref-value">{{ $registration->reference }}</p>
    <p class="ref-hint">Please quote this number in all correspondence with the Secretariat.</p>
  </div>

  <div class="summary">
    <div class="summary-item full">
      <div class="summary-label">School</div>
      <div class="summary-value">{{ $registration->school_name }}</div>
    </div>
    <div class="summary-item">
      <div class="summary-label">Participants</div>
      <div class="summary-value">{{ $registration->participant_count }}</div>
    </div>
    <div class="summary-item">
      <div class="summary-label">Registration tier</div>
      <div class="summary-value">{{ $tierLabel }}</div>
    </div>
    <div class="summary-item full">
      <div class="summary-label">Total investment</div>
      <div class="summary-value emphasis">KShs. {{ number_format($registration->total_amount) }}</div>
    </div>
    <div class="summary-item full">
      <div class="summary-label">Payment method</div>
      <div class="summary-value">{{ $registration->payment_mode }}</div>
    </div>
  </div>

  <div class="dates-card">
    <div class="label">Masterclass dates</div>
    <div class="dates">14 – 16 July 2026</div>
    <div class="venue">Maison Ubuntu Training &amp; Conference Centre, Dagoretti · 8:30 a.m. – 3:30 p.m.</div>
  </div>

  <section class="next-steps">
    <h2>What happens next</h2>
    <ol class="timeline">
      <li>
        <span class="timeline-num">1</span>
        <div class="timeline-title">Confirmation within two working days</div>
        <p class="timeline-desc">The Masterclass Secretariat will email <strong>{{ $registration->lead_email }}</strong> with official confirmation and any payment instructions not already on your form.</p>
      </li>
      <li>
        <span class="timeline-num">2</span>
        <div class="timeline-title">Complete your payment</div>
        <p class="timeline-desc">Settle the total of <strong>KShs. {{ number_format($registration->total_amount) }}</strong> using your chosen method. Places are confirmed on a first-paid basis.</p>
      </li>
      <li>
        <span class="timeline-num">3</span>
        <div class="timeline-title">Prepare your team for July</div>
        <p class="timeline-desc">Nominated participants should plan to attend all three days. We will share any pre-reading or logistics closer to the date.</p>
      </li>
    </ol>
  </section>

  <div class="actions">
    <button type="button" class="btn btn-secondary" onclick="window.print()">Print confirmation</button>
    <a href="{{ url('/') }}" class="btn btn-primary">Return to home</a>
  </div>

  <footer class="foot">
    <div class="ubuntu">“I am because we are.”</div>
    <div>Masterclass Secretariat</div>
    <div>info@asnenafrica.org · info@acorn.co.ke</div>
    <div>+254 703 906 990 · +254 712 652 621</div>
  </footer>

</div>

</body>
</html>
