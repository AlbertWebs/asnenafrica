@extends('admin.layout')

@section('title', 'Registrations')
@section('page-title', 'Registrations')
@section('page-subtitle', 'Search, filter, and manage all masterclass applications')

@section('content')
<div class="card">
  <div class="card-head">
    <h2>All applications</h2>
    <form class="filters" method="GET" action="{{ route('admin.registrations.index') }}">
      <input type="search" name="q" value="{{ request('q') }}" placeholder="Search school, reference, email…">
      <select name="status">
        <option value="">All statuses</option>
        @foreach($statuses as $key => $label)
          <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
        @endforeach
      </select>
      <select name="tier">
        <option value="">All tiers</option>
        <option value="standard" @selected(request('tier') === 'standard')>Standard</option>
        <option value="earlybird" @selected(request('tier') === 'earlybird')>Early Bird</option>
      </select>
      <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
      @if(request()->hasAny(['q','status','tier']))
        <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary btn-sm">Clear</a>
      @endif
    </form>
  </div>
  <div class="card-body" style="padding:0">
    <table>
      <thead>
        <tr>
          <th>Reference</th>
          <th>School</th>
          <th>County</th>
          <th>Participants</th>
          <th>Investment</th>
          <th>Payment</th>
          <th>Status</th>
          <th>Submitted</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($registrations as $reg)
          <tr>
            <td><strong>{{ $reg->reference }}</strong></td>
            <td>{{ Str::limit($reg->school_name, 24) }}</td>
            <td>{{ $reg->county }}</td>
            <td>{{ $reg->participant_count }}</td>
            <td>KShs. {{ number_format($reg->total_amount) }}</td>
            <td>{{ Str::limit($reg->payment_mode, 22) }}</td>
            <td><span class="badge badge-{{ $reg->status }}">{{ $reg->statusLabel() }}</span></td>
            <td>{{ $reg->created_at->format('d M Y H:i') }}</td>
            <td><a class="link" href="{{ route('admin.registrations.show', $reg) }}">View</a></td>
          </tr>
        @empty
          <tr><td colspan="9" style="text-align:center;padding:32px;color:var(--ink-soft)">No registrations match your filters.</td></tr>
        @endforelse
      </tbody>
    </table>
    @if($registrations->hasPages())
      <div style="padding:16px 20px">{{ $registrations->links() }}</div>
    @endif
  </div>
</div>
@endsection
