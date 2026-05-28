<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@include('partials.seo-meta', [
    'title' => 'Registration confirmed',
    'description' => 'Your Inclusive by Design masterclass registration has been received. Save your reference and complete payment to secure your team\'s place.',
    'canonical' => route('registrations.thank-you', $registration->reference),
    'robots' => 'noindex, nofollow',
])
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

  .success-seal {
    width: 72px;
    height: 72px;
    margin: 0 auto 28px;
    border: 2px solid var(--gold);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    box-shadow: var(--shadow);
    animation: sealPop .7s cubic-bezier(.34, 1.4, .64, 1) .1s both;
  }

  @keyframes sealPop {
    from { opacity: 0; transform: scale(.5); }
    to   { opacity: 1; transform: scale(1); }
  }

  .success-seal svg {
    width: 36px;
    height: 36px;
    stroke: var(--moss);
    stroke-width: 2.5;
    fill: none;
    stroke-linecap: round;
    stroke-linejoin: round;
  }

  .success-seal .check {
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: drawCheck .5s ease-out .5s forwards;
  }

  @keyframes drawCheck {
    to { stroke-dashoffset: 0; }
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
    padding: 32px 28px 28px;
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

  .ref-actions {
    margin-top: 18px;
  }

  .copy-btn {
    background: transparent;
    border: 1px solid rgba(247,243,236,.35);
    color: rgba(247,243,236,.9);
    font-size: 11px;
    padding: 8px 16px;
    cursor: pointer;
    letter-spacing: .12em;
    text-transform: uppercase;
    font-family: 'Inter', sans-serif;
    transition: all .15s;
  }

  .copy-btn:hover {
    border-color: var(--gold);
    color: var(--gold);
  }

  .copy-btn.copied {
    border-color: #8aa860;
    color: #b8d4a0;
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
    margin-bottom: 28px;
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

  .participants-card {
    border: 1px solid var(--rule);
    background: #fff;
    padding: 20px 22px;
    margin-bottom: 28px;
    animation: heroIn .9s ease-out .52s both;
  }

  .participants-card h3 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    font-weight: 600;
    margin: 0 0 14px;
    color: var(--ink);
    padding-bottom: 10px;
    border-bottom: 1px dashed var(--rule);
  }

  .participant-list {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .participant-list li {
    display: flex;
    align-items: baseline;
    gap: 12px;
    padding: 8px 0;
    border-bottom: 1px solid rgba(200,184,154,.35);
    font-size: 14px;
  }

  .participant-list li:last-child { border-bottom: none; }

  .participant-list .num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 16px;
    font-weight: 600;
    color: var(--accent);
    min-width: 1.5em;
  }

  .participant-list .role {
    font-size: 12px;
    color: var(--ink-soft);
    margin-left: auto;
    text-align: right;
  }

  .payment-reminder {
    background: var(--paper-warm);
    border-left: 3px solid var(--gold);
    padding: 18px 22px;
    margin-bottom: 28px;
    animation: heroIn .9s ease-out .54s both;
  }

  .payment-reminder h3 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    font-weight: 600;
    margin: 0 0 12px;
    color: var(--ink);
  }

  .payment-reminder p {
    margin: 0 0 12px;
    font-size: 14px;
    color: var(--ink-soft);
  }

  .payment-copy-row {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 8px;
  }

  .payment-copy-row:last-child { margin-bottom: 0; }

  .payment-copy-label {
    font-size: 11px;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--ink-soft);
    font-weight: 600;
    min-width: 110px;
  }

  .payment-copy-value {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    font-weight: 600;
    color: var(--accent);
    font-variant-numeric: tabular-nums;
  }

  .payment-copy-row .copy-btn {
    border-color: var(--rule);
    color: var(--ink-soft);
    margin-left: auto;
  }

  .payment-copy-row .copy-btn:hover {
    border-color: var(--accent);
    color: var(--accent);
  }

  .dates-card {
    background: var(--paper-warm);
    border: 1px solid var(--rule);
    padding: 20px 22px;
    margin-bottom: 36px;
    text-align: center;
    animation: heroIn .9s ease-out .58s both;
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

  .next-steps {
    margin-bottom: 40px;
    animation: heroIn .9s ease-out .6s both;
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
    .participant-list .role { display: block; margin-left: 2em; text-align: left; margin-top: 2px; }
  }

  @media print {
    @page {
      size: A4 portrait;
      margin: 8mm 10mm;
    }

    html, body {
      font-size: 9.5pt;
      line-height: 1.3;
      background: #fff !important;
      min-height: 0;
    }

    body::before { display: none; }

    .page {
      max-width: none;
      width: 100%;
      padding: 0;
      margin: 0;
      animation: none;
    }

    .success-seal {
      width: 32px;
      height: 32px;
      margin: 0 auto 6px;
      box-shadow: none;
      animation: none;
      border-width: 1.5px;
    }

    .success-seal svg { width: 16px; height: 16px; }
    .success-seal .check { stroke-dashoffset: 0; animation: none; }

    header.letterhead {
      padding-bottom: 8px;
      margin-bottom: 8px;
    }

    .conveners { font-size: 7pt; letter-spacing: .18em; margin-bottom: 4px; }
    .ornament { margin: 2px 0 4px; font-size: 11px; }
    .ornament::before, .ornament::after { width: 28px; }

    .hero-title {
      font-size: 20pt;
      margin-bottom: 2px;
    }

    .hero-lead { font-size: 10.5pt; }

    .ubuntu-banner {
      margin: 6px 0 8px;
      padding: 6px 10px;
    }

    .ubuntu-banner q { font-size: 11pt; }

    .ref-card {
      padding: 10px 14px 8px;
      margin-bottom: 8px;
      box-shadow: none;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .ref-label { font-size: 7pt; margin-bottom: 4px; }
    .ref-value { font-size: 18pt; letter-spacing: .08em; }
    .ref-actions { display: none; }
    .ref-hint { font-size: 7.5pt; margin-top: 6px; }

    .summary {
      margin-bottom: 6px;
    }

    .summary-item { padding: 5px 8px; }
    .summary-label { font-size: 7pt; margin-bottom: 2px; }
    .summary-value { font-size: 9pt; }
    .summary-value.emphasis { font-size: 13pt; }

    .participants-card {
      padding: 6px 10px;
      margin-bottom: 6px;
    }

    .participants-card h3 {
      font-size: 11pt;
      margin-bottom: 4px;
      padding-bottom: 4px;
    }

    .participant-list {
      columns: 2;
      column-gap: 12px;
    }

    .participant-list li {
      padding: 2px 0;
      font-size: 8.5pt;
      break-inside: avoid;
    }

    .participant-list .num { font-size: 9pt; }

    .payment-reminder {
      padding: 6px 10px;
      margin-bottom: 6px;
    }

    .payment-reminder h3 {
      font-size: 11pt;
      margin-bottom: 3px;
    }

    .payment-reminder p {
      font-size: 8.5pt;
      margin-bottom: 3px;
    }

    .payment-copy-row {
      margin-bottom: 2px;
      gap: 8px;
    }

    .payment-copy-label { font-size: 7pt; min-width: auto; }
    .payment-copy-value { font-size: 11pt; }

    .dates-card {
      padding: 6px 10px;
      margin-bottom: 6px;
    }

    .dates-card .label { font-size: 7pt; margin-bottom: 3px; }
    .dates-card .dates { font-size: 12pt; }
    .dates-card .venue { font-size: 8.5pt; margin-top: 2px; }

    .next-steps {
      margin-bottom: 6px;
    }

    .next-steps h2 {
      font-size: 12pt;
      margin-bottom: 4px;
      padding-bottom: 3px;
    }

    .timeline::before { display: none; }

    .timeline li {
      padding: 0 0 3px 20px;
      position: relative;
    }

    .timeline-num {
      position: absolute;
      left: 0;
      top: 0;
      width: 14px;
      height: 14px;
      font-size: 7pt;
    }

    .timeline-title {
      font-size: 8pt;
      margin-bottom: 1px;
    }

    .timeline-desc {
      font-size: 7.5pt;
      line-height: 1.25;
    }

    footer.foot {
      padding-top: 6px;
      font-size: 7.5pt;
      line-height: 1.35;
    }

    footer.foot .ubuntu {
      font-size: 10pt;
      margin-bottom: 2px;
    }

    .actions,
    .copy-btn { display: none !important; }
  }
</style>
</head>
<body>

<div class="page">

  <div class="success-seal" aria-hidden="true">
    <svg viewBox="0 0 24 24"><path class="check" d="M5 13l4 4L19 7"/></svg>
  </div>

  <header class="letterhead">
    <div class="conveners">
      <span>Africa Special Needs Education Network</span> · <span>Acorn Special Tutorials</span>
    </div>
    <div class="ornament">❦</div>
    <h1 class="hero-title">Thank you</h1>
    <p class="hero-lead">{{ $registration->lead_name }}, your place on the journey is reserved.</p>
  </header>

  <div class="ubuntu-banner">
    <q>I am because we are</q> — {{ $registration->school_name }} joins a community building classrooms where every learner belongs.
  </div>

  <div class="ref-card">
    <div class="ref-label">Your registration reference</div>
    <p class="ref-value" id="refValue">{{ $registration->reference }}</p>
    <div class="ref-actions">
      <button type="button" class="copy-btn" id="copyRefBtn" data-copy="{{ $registration->reference }}">Copy reference</button>
    </div>
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

  @if($registration->participants->isNotEmpty())
  <div class="participants-card">
    <h3>Nominated participants</h3>
    <ul class="participant-list">
      @foreach($registration->participants as $participant)
      <li>
        <span class="num">{{ $participant->position }}.</span>
        <span class="name">{{ $participant->name }}</span>
        <span class="role">{{ $participant->role }}</span>
      </li>
      @endforeach
    </ul>
  </div>
  @endif

  @if($isPaybill)
  <div class="payment-reminder">
    <h3>M-Pesa Paybill details</h3>
    <p>Use these details when completing your payment of <strong>KShs. {{ number_format($registration->total_amount) }}</strong>:</p>
    <div class="payment-copy-row">
      <span class="payment-copy-label">Paybill</span>
      <span class="payment-copy-value">{{ $paymentDetails['paybill_number'] }}</span>
      <button type="button" class="copy-btn" data-copy="{{ $paymentDetails['paybill_number'] }}">Copy</button>
    </div>
    <div class="payment-copy-row">
      <span class="payment-copy-label">Account</span>
      <span class="payment-copy-value">{{ $paymentDetails['paybill_account'] }}</span>
      <button type="button" class="copy-btn" data-copy="{{ $paymentDetails['paybill_account'] }}">Copy</button>
    </div>
  </div>
  @elseif(str_contains($registration->payment_mode, 'KCB'))
  <div class="payment-reminder">
    <h3>Bank transfer details</h3>
    <p>Transfer <strong>KShs. {{ number_format($registration->total_amount) }}</strong> to:</p>
    <p><strong>{{ $paymentDetails['kcb_name'] }}</strong><br>KCB Account <strong>{{ $paymentDetails['kcb_number'] }}</strong></p>
  </div>
  @endif

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
        <p class="timeline-desc">The Masterclass Secretariat will email <strong>{{ $registration->lead_email }}</strong> with official confirmation and payment instructions.</p>
      </li>
      <li>
        <span class="timeline-num">2</span>
        <div class="timeline-title">Complete your payment</div>
        <p class="timeline-desc">Settle the total of <strong>KShs. {{ number_format($registration->total_amount) }}</strong> using your chosen method. Places are confirmed on a first-paid basis.</p>
      </li>
      <li>
        <span class="timeline-num">3</span>
        <div class="timeline-title">Prepare your team for July</div>
        <p class="timeline-desc">All {{ $registration->participant_count }} nominated participant{{ $registration->participant_count === 1 ? '' : 's' }} should plan to attend the full three days. We will share logistics closer to the date.</p>
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

<script>
(function() {
  async function copyText(text, btn) {
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
    } catch (e) {
      btn.textContent = 'Failed';
      setTimeout(() => { btn.textContent = btn.dataset.copy ? 'Copy' : 'Copy reference'; }, 2000);
    }
  }

  document.querySelectorAll('.copy-btn').forEach(btn => {
    btn.addEventListener('click', () => copyText(btn.dataset.copy, btn));
  });
})();
</script>

</body>
</html>
