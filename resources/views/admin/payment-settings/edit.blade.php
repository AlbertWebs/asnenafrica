@extends('admin.layout')

@section('title', 'Payment accounts')
@section('page-title', 'Payment accounts')
@section('page-subtitle', 'KCB, M-Pesa Paybill, and cheque details shown on the public form')

@section('content')
<p style="color:var(--ink-soft);margin:0 0 24px;max-width:640px">
  These values appear on the public registration form and thank-you page. Changes take effect immediately after saving.
</p>

<form method="POST" action="{{ route('admin.payment-settings.update') }}">
  @csrf
  @method('PUT')

  @foreach($settings as $group => $items)
    <div class="card">
      <div class="card-head">
        <h2>
          @if($group === 'options') Registration dropdown labels
          @elseif($group === 'kcb') KCB bank account
          @elseif($group === 'paybill') M-Pesa Paybill
          @elseif($group === 'cheque') Cheque
          @else {{ ucfirst($group) }}
          @endif
        </h2>
      </div>
      <div class="card-body">
        @foreach($items as $setting)
          <div class="form-group">
            <label for="setting_{{ $setting->key }}">{{ $setting->label }}</label>
            <input
              type="text"
              class="form-control"
              id="setting_{{ $setting->key }}"
              name="settings[{{ $setting->key }}]"
              value="{{ old('settings.'.$setting->key, $setting->value) }}"
              required
            >
          </div>
        @endforeach
      </div>
    </div>
  @endforeach

  <button type="submit" class="btn btn-primary">Save payment settings</button>
</form>
@endsection
