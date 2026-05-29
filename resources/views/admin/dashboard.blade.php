@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of registrations, revenue, and follow-ups')

@section('content')
<div class="stats">
  <div class="stat-card">
    <div class="label">Registrations</div>
    <div class="value">{{ number_format($stats['registrations']) }}</div>
  </div>
  <div class="stat-card">
    <div class="label">Participants</div>
    <div class="value gold">{{ number_format($stats['participants']) }}</div>
  </div>
  <div class="stat-card">
    <div class="label">Total investment</div>
    <div class="value accent">KShs. {{ number_format($stats['revenue']) }}</div>
  </div>
  <div class="stat-card">
    <div class="label">Pending follow-up</div>
    <div class="value">{{ number_format($stats['pending']) }}</div>
  </div>
  <div class="stat-card">
    <div class="label">Confirmed</div>
    <div class="value" style="color:var(--moss)">{{ number_format($stats['confirmed']) }}</div>
  </div>
</div>

<div class="grid-2">
  <div class="card">
    <div class="card-head"><h2>Registrations (last 14 days)</h2></div>
    <div class="card-body">
      @if($daily->isEmpty())
        <p style="color:var(--ink-soft);margin:0">No registrations yet.</p>
      @else
        <div class="chart-bars">
          @foreach($daily as $day => $total)
            <div class="chart-bar-wrap">
              <div class="chart-bar" style="height: {{ round(($total / $maxDaily) * 100) }}%"></div>
              <span class="chart-bar-label">{{ \Carbon\Carbon::parse($day)->format('d M') }}</span>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>

  <div class="card">
    <div class="card-head"><h2>By status</h2></div>
    <div class="card-body">
      <ul class="breakdown-list">
        @foreach(\App\Models\Registration::STATUSES as $key => $label)
          <li>
            <span>{{ $label }}</span>
            <strong>{{ $byStatus[$key] ?? 0 }}</strong>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>

<div class="grid-2">
  <div class="card">
    <div class="card-head"><h2>By tier</h2></div>
    <div class="card-body">
      <ul class="breakdown-list">
        <li><span>Standard</span><strong>{{ $byTier['standard'] ?? 0 }}</strong></li>
        <li><span>School-Team Early Bird</span><strong>{{ $byTier['earlybird'] ?? 0 }}</strong></li>
      </ul>
    </div>
  </div>

  <div class="card">
    <div class="card-head"><h2>Payment methods</h2></div>
    <div class="card-body">
      <ul class="breakdown-list">
        @forelse($byPayment as $mode => $total)
          <li><span>{{ Str::limit($mode, 40) }}</span><strong>{{ $total }}</strong></li>
        @empty
          <li><span>—</span><strong>0</strong></li>
        @endforelse
      </ul>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-head">
    <h2>Recent registrations</h2>
    <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary btn-sm">View all</a>
  </div>
  <div class="card-body" style="padding:0">
    <table>
      <thead>
        <tr>
          <th>Reference</th>
          <th>School</th>
          <th>Lead</th>
          <th>Total</th>
          <th>Status</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recent as $reg)
          <tr>
            <td><a class="link" href="{{ route('admin.registrations.show', $reg) }}">{{ $reg->reference }}</a></td>
            <td>{{ Str::limit($reg->school_name, 28) }}</td>
            <td>{{ $reg->lead_name }}</td>
            <td>KShs. {{ number_format($reg->total_amount) }}</td>
            <td><span class="badge badge-{{ $reg->status }}">{{ $reg->statusLabel() }}</span></td>
            <td>{{ $reg->created_at->format('d M Y') }}</td>
          </tr>
        @empty
          <tr><td colspan="6" style="text-align:center;color:var(--ink-soft)">No registrations yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<section class="danger-zone" aria-labelledby="danger-zone-title">
  <div class="danger-zone-head">
    <div>
      <h2 id="danger-zone-title">Danger zone</h2>
      <p>Permanently delete registrations identified as test data (sample references, demo schools, example.com emails). Real <code>IBD-</code> registrations are not affected unless they match test patterns.</p>
    </div>
    @if($testDataCount > 0)
      <span class="badge badge-cancelled">{{ $testDataCount }} test {{ Str::plural('record', $testDataCount) }}</span>
    @endif
  </div>
  <div class="danger-zone-body">
    @if($testDataCount === 0)
      <p style="margin:0 0 20px;color:var(--ink-soft)">No test registrations matched the sample/demo patterns. Use <strong>Purge all registrations</strong> below to delete every registration.</p>
    @else
      <p style="margin:0 0 12px;font-size:13px;color:var(--ink-soft)">
        <strong>{{ $testDataCount }}</strong> registration(s) will be deleted, including all linked participants. This cannot be undone.
      </p>
      @if($testDataPreview->isNotEmpty())
        <ul class="danger-zone-list">
          @foreach($testDataPreview as $test)
            <li>
              <span><strong>{{ $test->reference }}</strong> — {{ Str::limit($test->school_name, 36) }}</span>
              <span style="color:var(--ink-soft);white-space:nowrap">{{ $test->created_at->format('d M Y') }}</span>
            </li>
          @endforeach
          @if($testDataCount > $testDataPreview->count())
            <li style="border:none;padding-top:4px;color:var(--ink-soft)">…and {{ $testDataCount - $testDataPreview->count() }} more</li>
          @endif
        </ul>
      @endif
      <form method="POST" action="{{ route('admin.test-data.purge') }}" id="purgeTestDataForm" onsubmit="return confirm('Delete {{ $testDataCount }} test registration(s)? This cannot be undone.');">
        @csrf
        @method('DELETE')
        <label class="danger-confirm-label" for="purgeConfirmation">Type <strong>PURGE TEST DATA</strong> to enable</label>
        <input
          type="text"
          id="purgeConfirmation"
          name="confirmation"
          class="danger-confirm-input"
          autocomplete="off"
          spellcheck="false"
          placeholder="PURGE TEST DATA"
          value="{{ old('confirmation') }}"
          aria-describedby="purgeHelp"
        >
        <p id="purgeHelp" style="margin:0 0 16px;font-size:12px;color:var(--ink-soft)">Matches: SAMPLE/TEST/DEMO references, demo school names, @example.com emails.</p>
        @error('confirmation')
          <p style="margin:0 0 12px;font-size:13px;color:var(--danger)">{{ $message }}</p>
        @enderror
        <button type="submit" class="btn btn-danger" id="purgeTestDataBtn" disabled>Purge test data</button>
      </form>
      <script>
        (function () {
          const input = document.getElementById('purgeConfirmation');
          const btn = document.getElementById('purgeTestDataBtn');
          const phrase = 'PURGE TEST DATA';
          function sync() {
            btn.disabled = input.value.trim() !== phrase;
          }
          input.addEventListener('input', sync);
          sync();
        })();
      </script>
    @endif

    @if($stats['registrations'] > 0)
      <hr style="border:none;border-top:1px solid rgba(139,58,50,.25);margin:28px 0">
      <h3 style="margin:0 0 8px;font-family:'Cormorant Garamond',serif;font-size:20px;color:var(--danger)">Purge all registrations</h3>
      <p style="margin:0 0 12px;font-size:13px;color:var(--ink-soft)">
        Permanently delete <strong>all {{ number_format($stats['registrations']) }} registration(s)</strong>, every participant, and all sent-email logs. Real production data will be removed. This cannot be undone.
      </p>
      <form method="POST" action="{{ route('admin.registrations.purge-all') }}" onsubmit="return confirm('Delete ALL {{ $stats['registrations'] }} registration(s)? This cannot be undone.');">
        @csrf
        @method('DELETE')
        <label class="danger-confirm-label" for="purgeAllConfirmation">Type <strong>PURGE ALL DATA</strong> to enable</label>
        <input
          type="text"
          id="purgeAllConfirmation"
          name="confirmation"
          class="danger-confirm-input"
          autocomplete="off"
          spellcheck="false"
          placeholder="PURGE ALL DATA"
          value="{{ old('confirmation') }}"
        >
        @error('confirmation')
          <p style="margin:0 0 12px;font-size:13px;color:var(--danger)">{{ $message }}</p>
        @enderror
        <button type="submit" class="btn btn-danger" id="purgeAllBtn" disabled>Purge all registrations</button>
      </form>
      <script>
        (function () {
          const input = document.getElementById('purgeAllConfirmation');
          const btn = document.getElementById('purgeAllBtn');
          if (!input || !btn) return;
          const phrase = 'PURGE ALL DATA';
          function sync() {
            btn.disabled = input.value.trim() !== phrase;
          }
          input.addEventListener('input', sync);
          sync();
        })();
      </script>
    @endif
  </div>
</section>
@endsection
