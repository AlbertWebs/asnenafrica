@extends('admin.layout')

@section('title', 'Dev Tools')
@section('page-title', 'Dev Tools')
@section('page-subtitle', 'Run maintenance commands when terminal access is unavailable.')

@section('breadcrumb')
  <a href="{{ route('admin.dashboard') }}">Admin</a>
  <span class="breadcrumb-sep">/</span>
  <span>Dev Tools</span>
@endsection

@section('content')
  <p style="color:var(--ink-soft);margin:0 0 24px;max-width:640px">
  Use these tools on cPanel or other hosts without SSH. Only run migrate after deploying new database changes.
  </p>

  <div class="card">
    <div class="card-head">
      <h2>Maintenance Commands</h2>
    </div>
    <div class="card-body">
      <div style="display:flex;flex-wrap:wrap;gap:12px">
        <form method="POST" action="{{ route('admin.dev-tools.run') }}">
          @csrf
          <input type="hidden" name="command" value="migrate">
          <button type="submit" class="btn btn-primary" onclick="return confirm('Run php artisan migrate --force?')">
            Run Migrate
          </button>
        </form>

        <form method="POST" action="{{ route('admin.dev-tools.run') }}">
          @csrf
          <input type="hidden" name="command" value="cache_clear">
          <button type="submit" class="btn btn-secondary" onclick="return confirm('Clear config, route, view, and application cache?')">
            Clear Cache
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
