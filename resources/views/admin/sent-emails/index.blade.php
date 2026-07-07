@extends('admin.layout')

@section('title', 'Sent Emails')
@section('page-title', 'Sent Emails')
@section('page-subtitle', 'Track every email attempt, delivery status, and failure reason.')

@section('breadcrumb')
  <a href="{{ route('admin.dashboard') }}">Admin</a>
  <span class="breadcrumb-sep">/</span>
  <span>Sent Emails</span>
@endsection

@section('content')
  <div class="card">
    <div class="card-head">
      <h2>Email Delivery Log</h2>
    </div>
    <div class="card-body" style="padding:0">
      <table>
        <thead>
          <tr>
            <th>Type</th>
            <th>Registration</th>
            <th>Recipients</th>
            <th>Status</th>
            <th>Sent At</th>
            <th>Failure Reason</th>
          </tr>
        </thead>
        <tbody>
          @forelse($emails as $email)
            <tr>
              <td>{{ str_replace('_', ' ', ucfirst($email->type)) }}</td>
              <td>
                @if($email->registration)
                  <a href="{{ route('admin.registrations.show', $email->registration_id) }}" class="link">
                    {{ $email->registration->reference }}
                  </a>
                @else
                  <span style="color:var(--ink-soft)">—</span>
                @endif
              </td>
              <td style="max-width:260px;word-break:break-word">{{ $email->recipients }}</td>
              <td>
                @if($email->status === \App\Models\SentEmail::STATUS_SUCCESS)
                  <span class="badge" style="background:rgba(74,90,50,.2);color:var(--moss)">Success</span>
                @else
                  <span class="badge" style="background:rgba(139,58,50,.15);color:var(--danger)">Failed</span>
                @endif
              </td>
              <td>{{ optional($email->sent_at)->format('d M Y, H:i') ?? '—' }}</td>
              <td style="max-width:320px;word-break:break-word">{{ $email->failure_reason ?: '—' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align:center;color:var(--ink-soft);padding:20px">
                No email activity recorded yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
      <div style="padding:16px 20px">
        {{ $emails->links() }}
      </div>
    </div>
  </div>
@endsection
