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
@endsection
