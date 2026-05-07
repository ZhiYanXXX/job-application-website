<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - easy job</title>
    <style>
        /* Base Styles & Variables - Corporate Trust Palette */
        :root { 
            --primary-color: #0f2537; 
            --primary-hover: #08141e; 
            --success-color: #0d9488; 
            --success-bg: #ccfbf1; 
            --bg-light: #f8fafc; 
            --text-dark: #334155; 
            --text-gray: #64748b; 
            --border-color: #e2e8f0; 
            --error-color: #ef4444; 
        }


        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: var(--bg-light); color: var(--text-dark); margin: 0; padding: 0; line-height: 1.6; display: flex; flex-direction: column; min-height: 100vh; }
        
        header { background-color: white; padding: 1rem 5%; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary-color); text-decoration: none; }
        .nav-links a { margin-left: 1.5rem; font-weight: 500; text-decoration: none; color: inherit; }
        
        .auth-container { max-width: 500px; margin: 4rem auto auto auto; background: white; padding: 2.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid var(--border-color); width: 100%; text-align: center; box-sizing: border-box; }
        .auth-title { color: var(--primary-color); margin-bottom: 1rem; font-size: 1.8rem; }
        .auth-description { color: var(--text-gray); font-size: 0.95rem; margin-bottom: 2rem; }
        
        .btn-submit { width: 100%; background: var(--primary-color); color: white; padding: 1rem; border: none; border-radius: 5px; font-size: 1.1rem; cursor: pointer; font-weight: bold; transition: background 0.3s; margin-bottom: 1rem; }
        .btn-submit:hover { background: var(--primary-hover); }
        
        .btn-logout { background: none; border: none; color: var(--text-gray); text-decoration: underline; cursor: pointer; font-size: 0.9rem; padding: 0.5rem; }
        .btn-logout:hover { color: var(--text-dark); }


        /* Prototype Notice Box - Updated to match new palette */
        .prototype-notice { background: var(--success-bg); color: var(--success-color); padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; font-size: 0.85rem; text-align: center; border: 1px solid var(--success-color); }
    </style>
</head>
<body>


    <header>
        <a href="/" class="logo">easy job</a>
        <nav class="nav-links">
            <a href="/">Home</a>
        </nav>
    </header>


    <div class="auth-container">
        <h1 class="auth-title">Verify Your Email</h1>
        
        <p class="auth-description">
            Thanks for signing up! Before getting started, you normally need to verify your email address.
        </p>


        <div class="prototype-notice">
            <strong>Prototype Demo:</strong><br> Since this is a test environment, clicking the button below will simulate a successful email verification and take you to your dashboard.
        </div>


        @if (session('status') == 'verification-link-sent')
            <div style="background: var(--success-bg); color: var(--success-color); padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid var(--success-color); font-size: 0.9rem;">
                A new verification link has been sent to the email address you provided.
            </div>
        @endif


        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-submit">Simulate Email Verification</button>
        </form>


        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Log Out</button>
        </form>
    </div>


</body>
</html>



