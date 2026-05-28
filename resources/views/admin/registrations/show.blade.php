@extends('admin.layout')

@section('title', $registration->reference)
@section('page-title', $registration->school_name)
@section('page-subtitle', $registration->reference . ' · ' . $registration->statusLabel())
@section('breadcrumb')
  <a href="{{ route('admin.dashboard') }}">Admin</a>
  <span class="breadcrumb-sep">/</span>
  <a href="{{ route('admin.registrations.index') }}">Registrations</a>
  <span class="breadcrumb-sep">/</span>
  <span>{{ $registration->reference }}</span>
@endsection

@section('content')
<div style="margin-bottom:16px">
  <a href="{{ route('admin.registrations.index') }}" class="link">← All registrations</a>
  ·
  <a href="{{ route('registrations.thank-you', $registration->reference) }}" class="link" target="_blank">Public confirmation</a>
</div>

<div class="grid-2">
  <div class="card">
    <div class="card-head">
      <h2>{{ $registration->reference }}</h2>
      <span class="badge badge-{{ $registration->status }}">{{ $registration->statusLabel() }}</span>
    </div>
    <div class="card-body">
      <div class="detail-grid">
        <div class="detail-item"><div class="k">School</div><div class="v">{{ $registration->school_name }}</div></div>
        <div class="detail-item"><div class="k">Type</div><div class="v">{{ $registration->school_type }}</div></div>
        <div class="detail-item"><div class="k">County</div><div class="v">{{ $registration->county }}</div></div>
        <div class="detail-item"><div class="k">School phone</div><div class="v"><a href="tel:{{ $registration->school_phone }}">{{ $registration->school_phone }}</a></div></div>
        <div class="detail-item"><div class="k">School email</div><div class="v"><a href="mailto:{{ $registration->school_email }}">{{ $registration->school_email }}</a></div></div>
        <div class="detail-item full" style="grid-column:1/-1"><div class="k">Address</div><div class="v">{{ $registration->address ?: '—' }}</div></div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-head"><h2>Lead contact</h2></div>
    <div class="card-body">
      <div class="detail-grid">
        <div class="detail-item"><div class="k">Name</div><div class="v">{{ $registration->lead_name }}</div></div>
        <div class="detail-item"><div class="k">Role</div><div class="v">{{ $registration->lead_role }}</div></div>
        <div class="detail-item"><div class="k">Mobile</div><div class="v"><a href="tel:{{ $registration->lead_phone }}">{{ $registration->lead_phone }}</a></div></div>
        <div class="detail-item"><div class="k">Email</div><div class="v"><a href="mailto:{{ $registration->lead_email }}">{{ $registration->lead_email }}</a></div></div>
      </div>
      <div style="margin-top:16px;display:flex;gap:8px;flex-wrap:wrap">
        <a href="mailto:{{ $registration->lead_email }}?subject=Masterclass%20Registration%20{{ $registration->reference }}" class="btn btn-primary btn-sm">Email lead</a>
        <a href="https://wa.me/{{ preg_replace('/\D/', '', $registration->lead_phone) }}" class="btn btn-secondary btn-sm" target="_blank" rel="noopener">WhatsApp</a>
      </div>
    </div>
  </div>
</div>

<div class="grid-2">
  <div class="card">
    <div class="card-head"><h2>Investment</h2></div>
    <div class="card-body">
      <div class="detail-grid">
        <div class="detail-item"><div class="k">Tier</div><div class="v">{{ $registration->tier === 'earlybird' ? 'School-Team Early Bird' : 'Standard' }}</div></div>
        <div class="detail-item"><div class="k">Participants</div><div class="v">{{ $registration->participant_count }}</div></div>
        <div class="detail-item"><div class="k">Rate each</div><div class="v">KShs. {{ number_format($registration->rate_per_participant) }}</div></div>
        <div class="detail-item"><div class="k">Total</div><div class="v" style="font-family:'Cormorant Garamond',serif;font-size:22px;color:var(--accent)">KShs. {{ number_format($registration->total_amount) }}</div></div>
        <div class="detail-item full" style="grid-column:1/-1"><div class="k">Payment method</div><div class="v">{{ $registration->payment_mode }}</div></div>
        <div class="detail-item"><div class="k">Submitted</div><div class="v">{{ $registration->created_at->format('l, j F Y \a\t g:i a') }}</div></div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-head"><h2>Follow-up</h2></div>
    <div class="card-body">
      <form method="POST" action="{{ route('admin.registrations.update', $registration) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="status">Status</label>
          <select name="status" id="status" class="form-control">
            @foreach($statuses as $key => $label)
              <option value="{{ $key }}" @selected(old('status', $registration->status) === $key)>{{ $label }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group" id="paymentMessageGroup">
          <label for="payment_confirmation_message">Payment confirmation message</label>
          <p style="font-size:12px;color:var(--ink-soft);margin:0 0 8px;line-height:1.4;">
            Sent to the lead contact, school email, and all participant emails when status is set to <strong>Payment received</strong>.
            @if($registration->payment_confirmed_at)
              <br>Last sent {{ $registration->payment_confirmed_at->format('j M Y, g:i a') }}.
            @endif
          </p>
          <textarea name="payment_confirmation_message" id="payment_confirmation_message" class="form-control" rows="6" placeholder="Enter the message applicants will receive…">{{ old('payment_confirmation_message', $registration->payment_confirmation_message ?: $defaultPaymentMessage) }}</textarea>
        </div>
        <div class="form-group">
          <label for="followed_up_at">Last followed up</label>
          <input type="datetime-local" name="followed_up_at" id="followed_up_at" class="form-control"
            value="{{ $registration->followed_up_at?->format('Y-m-d\TH:i') }}">
        </div>
        <div class="form-group">
          <label for="admin_notes">Internal notes</label>
          <textarea name="admin_notes" id="admin_notes" class="form-control" placeholder="Call notes, payment reminders, special arrangements…">{{ old('admin_notes', $registration->admin_notes) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save follow-up</button>
      </form>
    </div>
  </div>
</div>

@if($registration->participants->isNotEmpty())
<div class="card">
  <div class="card-head"><h2>Participants ({{ $registration->participants->count() }})</h2></div>
  <div class="card-body" style="padding:0">
    <table>
      <thead>
        <tr><th>#</th><th>Name</th><th>Role</th><th>Subject</th><th>Phone</th><th>Email</th></tr>
      </thead>
      <tbody>
        @foreach($registration->participants as $p)
          <tr>
            <td>{{ $p->position }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->role }}</td>
            <td>{{ $p->subject ?: '—' }}</td>
            <td><a href="tel:{{ $p->phone }}">{{ $p->phone }}</a></td>
            <td><a href="mailto:{{ $p->email }}">{{ $p->email }}</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif

@if($registration->accessibility || $registration->dietary)
<div class="card">
  <div class="card-head"><h2>Access &amp; dietary</h2></div>
  <div class="card-body">
    @if($registration->accessibility)<p><strong>Accessibility:</strong> {{ $registration->accessibility }}</p>@endif
    @if($registration->dietary)<p><strong>Dietary:</strong> {{ $registration->dietary }}</p>@endif
  </div>
</div>
@endif
@endsection

@push('styles')
<style>
  #paymentMessageGroup.highlight { outline: 2px solid var(--gold); outline-offset: 4px; border-radius: 4px; }
</style>
@endpush

@push('body-scripts')
<script>
(function() {
  const status = document.getElementById('status');
  const group = document.getElementById('paymentMessageGroup');
  function sync() {
    group.classList.toggle('highlight', status.value === 'payment_received');
  }
  status.addEventListener('change', sync);
  sync();
})();
</script>
@endpush
