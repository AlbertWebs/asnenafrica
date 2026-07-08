<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@include('partials.seo-meta', [
    'title' => 'Register · Inclusive by Design Masterclass',
    'description' => 'Register for Inclusive by Design — a three-day masterclass in Nairobi (4–6 August 2026) on building future-ready, inclusive classrooms. Hosted by ASNEN and Acorn Special Tutorials.',
    'canonical' => url('/'),
    'robots' => 'index, follow',
])
@include('partials.seo-event-jsonld', [
    'eventDescription' => 'Inclusive by Design: a three-day professional masterclass for educators, 4–6 August 2026 at Acorn Special Tutorials.',
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
  }

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

  .conveners span { display: inline-block; margin: 0 4px; }

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
  .glance-item.full { grid-column: 1 / -1; border-right: none; border-bottom: none; }

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

  section.section { margin-bottom: 44px; }

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

  .field { display: flex; flex-direction: column; }

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

  .tiers {
    display: grid;
    grid-template-columns: 1fr;
    gap: 18px;
    margin-bottom: 24px;
  }

  .tier {
    position: relative;
    padding: 22px 22px 20px;
    border: 1.5px solid var(--accent);
    background: #fff;
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

  .summary {
    background: var(--paper-warm);
    color: var(--ink);
    padding: 28px 30px;
    margin: 32px 0 12px;
    border: 1px solid var(--rule);
    position: relative;
  }

  .summary::before {
    content: "";
    position: absolute;
    top: -1px; left: 12px; right: 12px;
    height: 2px;
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
    border-top: 1px solid var(--rule);
    margin-top: 10px;
    padding-top: 14px;
  }

  .summary-row.total .summary-label {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    color: var(--ink);
    font-weight: 600;
  }

  .summary-row.total .summary-val {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px;
    color: var(--accent);
    font-weight: 700;
  }

  .summary-label { color: var(--ink-soft); }

  .summary-val {
    color: var(--ink);
    font-weight: 600;
    font-variant-numeric: tabular-nums;
  }

  .eligibility {
    margin-top: 14px;
    padding: 10px 14px;
    font-size: 12px;
    background: rgba(176,138,62,.15);
    border-left: 2px solid var(--gold);
    color: var(--ink-soft);
    line-height: 1.5;
  }

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

  .check-row.is-invalid span { color: var(--accent); }

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

  @media (max-width: 640px) {
    .page { padding: 32px 18px 56px; }
    h1.title { font-size: 38px; }
    .field-grid, .glance, .tiers { grid-template-columns: 1fr; }
    .glance-item { border-right: none; }
    .section-head { flex-wrap: wrap; }
    .section-sub { margin-left: 0; }
  }

  @media print {
    body { background: white; }
    .actions { display: none; }
    .page { padding: 20px; }
  }
</style>
</head>
@endverbatim
<body>
<script>window.__REG__ = @json(['csrf' => csrf_token(), 'submitUrl' => route('registrations.store')]); window.__PAYMENT__ = @json($paymentConfig);</script>
@verbatim

<div class="page">

  <header class="letterhead">
    <div class="conveners">
      <span>Africa Special Needs Education Network</span> · <span>Acorn Special Tutorials</span>
    </div>
    <div class="ornament">❦</div>
    <h1 class="title">Inclusive by Design</h1>
    <div class="subtitle">Building Future-Ready Classrooms for Diverse Learners</div>
    <div class="form-label">Registration · Three-Day Professional Masterclass</div>
  </header>

  <div class="preamble">
    In the spirit of <strong>Ubuntu — “I am because we are”</strong> — we warmly invite you to journey with us. Kindly complete this form to register your own place on the Masterclass. As cohort numbers are deliberately limited, early registration is encouraged.
  </div>

  <div class="glance">
    <div class="glance-item">
      <div class="glance-label">Dates</div>
      <div class="glance-value">4 – 6 August 2026</div>
    </div>
    <div class="glance-item">
      <div class="glance-label">Daily Hours</div>
      <div class="glance-value">8:30 a.m. – 3:30 p.m.</div>
    </div>
    <div class="glance-item full">
      <div class="glance-label">Venue</div>
      <div class="glance-value"><a href="https://maps.app.goo.gl/58124JYojX2AT6kj6" target="_blank" rel="noopener" style="color:inherit;text-decoration:underline">Acorn Special Tutorials</a></div>
    </div>
  </div>

  <div class="form-alert" id="formAlert" role="alert"></div>

  <form id="regForm" novalidate>

    <section class="section">
      <div class="section-head">
        <span class="section-num">I.</span>
        <h2 class="section-title">Your Details</h2>
        <span class="section-sub">Participant / educator registering</span>
      </div>

      <div class="field-grid">
        <div class="field">
          <label>Full Name <span class="req">*</span></label>
          <input type="text" name="p_name" required>
        </div>
        <div class="field">
          <label>Role / Designation <span class="req">*</span></label>
          <select name="p_role" required>
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
          <input type="text" name="p_subject" placeholder="e.g. Lower Primary, Mathematics">
        </div>
        <div class="field">
          <label>Years of Experience</label>
          <input type="number" name="p_years" min="0" max="60">
        </div>
        <div class="field">
          <label>Mobile Telephone <span class="req">*</span></label>
          <input type="tel" name="p_phone" required placeholder="+254…">
        </div>
        <div class="field">
          <label>Email Address <span class="req">*</span></label>
          <input type="email" name="p_email" required>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="section-head">
        <span class="section-num">II.</span>
        <h2 class="section-title">Your Institution</h2>
        <span class="section-sub">Where you currently teach or work</span>
      </div>

      <div class="field-grid">
        <div class="field full">
          <label>Name of School / Institution <span class="req">*</span></label>
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
      </div>
    </section>

    <section class="section">
      <div class="section-head">
        <span class="section-num">III.</span>
        <h2 class="section-title">Registration Fee</h2>
      </div>

      <div class="tiers">
        <div class="tier">
          <div class="tier-name">Registration Fee</div>
          <div class="tier-price">KShs. 15,000 <small>/ participant</small></div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="section-head">
        <span class="section-num">IV.</span>
        <h2 class="section-title">Access &amp; Dietary Needs</h2>
        <span class="section-sub">So we may host you well</span>
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

    <section class="section">
      <div class="section-head">
        <span class="section-num">V.</span>
        <h2 class="section-title">Payment &amp; Confirmation</h2>
      </div>

      <div class="field-grid full">
        <div class="field full">
          <label>Preferred Mode of Payment <span class="req">*</span></label>
          <select name="payment_mode" id="paymentMode" required>
            <option value="">— Select —</option>
          </select>
          <div class="help-text" id="paymentHelpText">Payment details — Co-operative Bank, Paybill No. 400200, Account No. 01103095242001.</div>
        </div>
      </div>

      <div class="summary">
        <div class="summary-row total">
          <span class="summary-label">Registration Fee Due</span>
          <span class="summary-val" id="sumTotal">KShs. 15,000</span>
        </div>
        <div class="eligibility" id="eligibility">Registration fee is KShs. 15,000 per participant.</div>
      </div>

      <div class="field full" style="margin-top: 28px;">
        <div class="check-list">
          <label class="check-row">
            <input type="checkbox" name="confirm_attendance" required>
            <span>I understand that I will attend the full three-day Masterclass (4 – 6 August 2026) and that places are allocated on a first-confirmed basis.</span>
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

  <footer class="foot">
    <div class="ubuntu">“I am because we are.”</div>
    <div>Masterclass Secretariat</div>
    <div>info@asnenafrica.org &nbsp;·&nbsp; info@acorn.co.ke</div>
    <div>+254 703 906 990 &nbsp;·&nbsp; +254 712 652 621</div>
  </footer>

</div>

<script>
(function() {
  const STANDARD_RATE = 15000;
  const form = document.getElementById('regForm');
  const formAlert = document.getElementById('formAlert');
  const submitBtn = document.getElementById('submitBtn');
  const paymentModeSelect = document.getElementById('paymentMode');
  const paymentHelpText = document.getElementById('paymentHelpText');

  function fmtKsh(n) {
    return 'KShs. ' + n.toLocaleString('en-KE');
  }

  function initPaymentFromConfig() {
    const p = window.__PAYMENT__;
    if (!p || !p.options) return;

    Object.entries(p.options).forEach(([, label]) => {
      if (!label) return;
      const opt = document.createElement('option');
      opt.value = label;
      opt.textContent = label;
      paymentModeSelect.appendChild(opt);
    });
  }

  function updatePaymentHelp() {
    const p = window.__PAYMENT__;
    const mode = paymentModeSelect.value;
    if (!mode || !p) {
      paymentHelpText.textContent = 'Payment details — Co-operative Bank, Paybill No. 400200, Account No. 01103095242001.';
      return;
    }

    const bank = p.bank || {};
    const paybill = p.paybill || {};
    const cheque = p.cheque || {};

    if (p.options.paybill && mode === p.options.paybill) {
      paymentHelpText.textContent = 'M-Pesa Paybill No. ' + (paybill.number || '400200') + ', Account No. ' + (paybill.account || '01103095242001') + '.';
    } else if (p.options.kcb && mode === p.options.kcb) {
      paymentHelpText.textContent = (bank.name || 'Co-operative Bank') + ', Account No. ' + (bank.account_number || '01103095242001') + (bank.account_name ? ' (' + bank.account_name + ')' : '') + '.';
    } else if (p.options.cheque && mode === p.options.cheque) {
      paymentHelpText.textContent = 'Cheque written in favour of ' + (cheque.payee || 'ASNEN') + '.';
    } else if (p.options.cash && mode === p.options.cash) {
      paymentHelpText.textContent = 'Cash payment on the first day is available by prior arrangement with the Secretariat.';
    } else {
      paymentHelpText.textContent = (bank.name || 'Co-operative Bank') + ', Paybill No. ' + (paybill.number || '400200') + ', Account No. ' + (paybill.account || '01103095242001') + '.';
    }
  }

  initPaymentFromConfig();
  paymentModeSelect.addEventListener('change', updatePaymentHelp);
  updatePaymentHelp();

  function clearErrors() {
    form.querySelectorAll('.field.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    form.querySelectorAll('.field-error').forEach(el => el.remove());
    form.querySelectorAll('.check-row.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    formAlert.classList.remove('show');
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

  function buildPayload() {
    const fd = new FormData(form);
    const years = fd.get('p_years');
    return {
      p_name: fd.get('p_name')?.trim(),
      p_role: fd.get('p_role'),
      p_subject: fd.get('p_subject')?.trim() || null,
      p_years: years === '' || years == null ? null : Number(years),
      p_phone: fd.get('p_phone')?.trim(),
      p_email: fd.get('p_email')?.trim(),
      school_name: fd.get('school_name')?.trim(),
      school_type: fd.get('school_type'),
      county: fd.get('county')?.trim(),
      address: fd.get('address')?.trim() || null,
      tier: 'standard',
      accessibility: fd.get('accessibility')?.trim() || null,
      dietary: fd.get('dietary')?.trim() || null,
      payment_mode: fd.get('payment_mode'),
      confirm_attendance: !!fd.get('confirm_attendance'),
      consent_comms: !!fd.get('consent_comms'),
    };
  }

  function validateClient(payload) {
    const errors = {};
    const req = (key, msg) => { if (!payload[key]) errors[key] = msg; };

    req('p_name', 'Please enter your full name.');
    req('p_role', 'Please select your role or designation.');
    req('p_phone', 'Please enter your mobile telephone number.');
    if (!payload.p_email) errors.p_email = 'Please enter your email address.';
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(payload.p_email)) errors.p_email = 'Please enter a valid email address.';

    req('school_name', 'Please enter the name of your school or institution.');
    req('school_type', 'Please select a school type.');
    req('county', 'Please enter your county or region.');
    req('payment_mode', 'Please select a preferred payment method.');
    if (!payload.confirm_attendance) errors.confirm_attendance = 'You must confirm full three-day attendance.';

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
      if (key === 'confirm_attendance') {
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

  document.getElementById('printBtn').addEventListener('click', () => window.print());
})();
</script>

</body>
</html>

@endverbatim
