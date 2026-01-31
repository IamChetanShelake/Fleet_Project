<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login • Peak Logistics</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        :root{--glass-bg:rgba(255,255,255,.12);--glass-brd:rgba(255,255,255,.35);--white:255,255,255;--fg:#0b1324;--muted:#cad3df;--primary:#0ea5e9;--primary2:#22c1c3}
        *{box-sizing:border-box}
        body{margin:0;min-height:100vh;background:#000;color:#fff;font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,'Helvetica Neue',Arial,'Noto Sans','Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';}
        .login-wrap{position:relative;min-height:100vh;display:flex;align-items:stretch;}
        .bg-img{position:absolute;inset:0;background:url('/images/gabriel-santos-GBVDilE8yvI-unsplash.jpg') center/cover no-repeat;}
        .bg-overlay{position:absolute;inset:0;background:linear-gradient(90deg, rgba(0,0,0,.55) 0%, rgba(0,0,0,.35) 40%, rgba(0,0,0,.25) 60%, rgba(0,0,0,.35) 100%);}
        .content{position:relative;z-index:2;display:grid;grid-template-columns: 1.2fr 0.8fr;gap:28px;width:100%;padding:28px;}
        @media (max-width: 1024px){.content{grid-template-columns:1fr;gap:18px;padding:18px}}
        .left{padding:24px 24px 24px 24px;display:flex;flex-direction:column;justify-content:flex-start}
        .brand{font-family:'Poppins', sans-serif;font-weight:600;letter-spacing:.2px;font-size:32px;margin:6px 0 30px 6px;color:#dfe8f3}
        .panel{backdrop-filter: blur(16px);background: linear-gradient(180deg, rgba(30,155,233,.75) 0%, rgba(34,193,195,.65) 100%);border:1px solid var(--glass-brd);box-shadow: 0 20px 60px rgba(0,0,0,.35);border-radius:24px;min-height:78vh;display:flex;flex-direction:column;justify-content:space-between;padding:28px;position:relative}
        @media (max-width: 1024px){.panel{min-height:auto}}
        .panel::before{content:"";position:absolute;inset:0;border-radius:24px;padding:1px;background:linear-gradient(180deg, rgba(255,255,255,.35), rgba(255,255,255,.05));-webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;mask-composite:exclude}
        .roles{color:#e6f0fb;padding-left:6px}
        .roles h3{font-family:'Poppins',sans-serif;margin:0 0 12px;font-size:34px;font-weight:700}
        .role-list{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:10px}
        .role-list li{opacity:.75}
        .role-list li.active{opacity:1;font-weight:700}
        .login-card{position:relative;backdrop-filter: blur(20px);background: rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.25);border-radius:28px;padding:38px 30px 28px;max-width:520px;margin-left:auto}
        @media (max-width: 1024px){.login-card{max-width:unset;margin:0}}
        .login-title{font-size:14px;letter-spacing:.12em;color:#e6f0fb;text-transform:uppercase;margin:0}
        .login-sub{font-size:26px;font-weight:700;margin:6px 0 28px}
        .field{display:flex;align-items:center;gap:10px;background:rgba(255,255,255,.08);border:1px dashed rgba(255,255,255,.25);border-radius:12px;padding:12px 14px;color:#e9f1fb}
        .field input{flex:1;border:none;outline:none;background:transparent;color:#fff;padding:10px;font-size:15px}
        .field + .field{margin-top:14px}
        .actions{display:flex;align-items:center;justify-content:space-between;margin-top:22px}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;border:none;border-radius:999px;background:#fff;color:#0b1324;padding:12px 20px;font-weight:700;cursor:pointer;box-shadow:0 10px 24px rgba(0,0,0,.25)}
        .btn:hover{transform:translateY(-1px)}
        .small{font-size:13px;color:#d9e3ef}
        .link{color:#fff;font-weight:700;text-decoration:none}
        .divider{height:1px;background:rgba(255,255,255,.15);margin:20px 0}
        .close{position:absolute;right:18px;top:18px;height:38px;width:38px;border-radius:999px;border:1px solid rgba(255,255,255,.35);display:grid;place-items:center;color:#fff;background:rgba(255,255,255,.08)}
        .close:hover{background:rgba(255,255,255,.18)}
        .right{display:flex;align-items:center}
        .truck-shadow{border-radius:24px;overflow:hidden;}
    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="bg-img"></div>
        <div class="bg-overlay"></div>
        <div class="content">
            <div class="left">
                <div class="brand">Peak Logistics</div>
                <div class="roles">
                    <h3>Role</h3>
                    <ul class="role-list">
                        <li class="active">Super Admin</li>
                        <li>Admin</li>
                        <li>Supervisor</li>
                        <li>Account Staff</li>
                        <li>Country Finance Head</li>
                    </ul>
                </div>
            </div>

            <div class="right">
                <div class="panel">
                    <a href="/" class="close" aria-label="Close">✕</a>

                    <div class="login-card">
                        <p class="login-title">Existing Member</p>
                        <h2 class="login-sub">Welcome Back!</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="field">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 7C4 5.343 5.343 4 7 4h10c1.657 0 3 1.343 3 3v10c0 1.657-1.343 3-3 3H7c-1.657 0-3-1.343-3-3V7Z" stroke="rgba(255,255,255,.8)" stroke-width="1.5"/><path d="M7 9l5 4 5-4" stroke="rgba(255,255,255,.8)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <input id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                            </div>
                            @error('email')
                                <div class="small" style="color:#ffd1d1;margin-top:6px">{{ $message }}</div>
                            @enderror

                            <div class="field">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="10" width="18" height="10" rx="2" stroke="rgba(255,255,255,.8)" stroke-width="1.5"/><path d="M8 10V8a4 4 0 1 1 8 0v2" stroke="rgba(255,255,255,.8)" stroke-width="1.5" stroke-linecap="round"/></svg>
                                <input id="password" name="password" type="password" placeholder="Enter Password" required>
                            </div>
                            @error('password')
                                <div class="small" style="color:#ffd1d1;margin-top:6px">{{ $message }}</div>
                            @enderror

                            <div class="actions">
                                <div class="small">
                                    @if (Route::has('register'))
                                        Don't have account? <a class="link" href="{{ route('register') }}">Register Now</a>
                                    @endif
                                </div>
                                <button type="submit" class="btn">
                                    Continue
                                    <span aria-hidden>→</span>
                                </button>
                            </div>
                        </form>
                        <div class="divider"></div>
                        <div class="small">By continuing, you agree to our Terms and Privacy Policy.</div>
                    </div>

                    <div class="truck-shadow" aria-hidden="true"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
