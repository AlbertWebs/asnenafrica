<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Sign In · ASNEN Masterclass</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root { --ink:#1c1a17; --paper:#f7f3ec; --rule:#c8b89a; --accent:#8a3a1f; --gold:#b08a3e; }
    * { box-sizing: border-box; }
    body {
      margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center;
      font-family: 'Inter', sans-serif; background: var(--paper); color: var(--ink);
      background-image: radial-gradient(circle at 20% 30%, rgba(176,138,62,.08), transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(138,58,31,.06), transparent 50%);
    }
    .login-card {
      width: 100%; max-width: 400px; background: #fff; border: 1px solid var(--rule);
      padding: 40px 36px; box-shadow: 0 8px 32px rgba(28,26,23,.1);
    }
    .login-card::before {
      content: ""; display: block; height: 3px;
      background: linear-gradient(90deg, var(--accent), var(--gold));
      margin: -40px -36px 28px;
    }
    h1 {
      font-family: 'Cormorant Garamond', serif; font-size: 32px; font-weight: 600;
      margin: 0 0 6px; text-align: center;
    }
    .sub { text-align: center; color: #6b6560; font-size: 13px; margin-bottom: 28px; }
    label {
      display: block; font-size: 11px; letter-spacing: .1em; text-transform: uppercase;
      color: #6b6560; font-weight: 600; margin-bottom: 6px;
    }
    input {
      width: 100%; padding: 11px 14px; border: 1px solid var(--rule); border-radius: 3px;
      font-family: inherit; font-size: 15px; margin-bottom: 16px;
    }
    input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(138,58,31,.12); }
    .remember { display: flex; align-items: center; gap: 8px; margin-bottom: 20px; font-size: 13px; }
    .btn {
      width: 100%; padding: 14px; background: var(--accent); color: #fff; border: none;
      font-size: 12px; font-weight: 600; letter-spacing: .15em; text-transform: uppercase;
      cursor: pointer; border-radius: 3px;
    }
    .btn:hover { background: #6b2c17; }
    .alert { padding: 10px 14px; margin-bottom: 16px; font-size: 13px; background: rgba(138,58,31,.08); border-left: 3px solid var(--accent); color: var(--accent); }
    .back { display: block; text-align: center; margin-top: 20px; font-size: 13px; color: #6b6560; }
  </style>
</head>
<body>
  <div class="login-card">
    <h1>Administration</h1>
    <p class="sub">Inclusive by Design Masterclass</p>
    @if(session('error'))
      <div class="alert">{{ session('error') }}</div>
    @endif
    @if(session('success'))
      <div class="alert" style="border-color:#4a5a32;color:#4a5a32;background:rgba(74,90,50,.1)">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.login') }}">
      @csrf
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
      <label class="remember">
        <input type="checkbox" name="remember"> Remember me
      </label>
      <button type="submit" class="btn">Sign in</button>
    </form>
    <a href="{{ url('/') }}" class="back">← Back to registration form</a>
  </div>
</body>
</html>
