@extends('layouts.app')

@section('title', 'Dashboard — Connectbook')

@push('styles')
<style>
  .dashboard-wrap { max-width: 680px; margin: 60px auto; padding: 0 16px; }
  .card { background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,.1), 0 8px 16px rgba(0,0,0,.1); padding: 32px; }
  .card h1 { font-size: 24px; font-weight: 700; color: #1c1e21; margin-bottom: 8px; }
  .card p  { font-size: 16px; color: #65676b; margin-bottom: 24px; }
  .email-badge { display: inline-block; background: #e7f3ff; color: #1877f2; border-radius: 6px; padding: 4px 10px; font-size: 14px; font-weight: 600; margin-bottom: 24px; }
  .btn-logout { padding: 10px 24px; background: #e4e6eb; border: none; border-radius: 6px; font-size: 15px; font-weight: 600; color: #1c1e21; cursor: pointer; font-family: inherit; transition: background .15s; }
  .btn-logout:hover { background: #d8dadf; }
</style>
@endpush

@section('content')
<div class="dashboard-wrap">
  <div class="card">
    <h1>You're logged in 🎉</h1>
    <p>Welcome to Connectbook. This is your dashboard.</p>
    <div class="email-badge">{{ Auth::user()->email }}</div>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn-logout" type="submit">Log out</button>
    </form>
  </div>
</div>
@endsection
