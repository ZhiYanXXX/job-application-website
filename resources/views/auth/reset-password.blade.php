<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - easy job</title>
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
        
        .auth-container { max-width: 450px; margin: 4rem auto auto auto; background: white; padding: 2.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid var(--border-color); width: 100%; box-sizing: border-box; }
        .auth-title { text-align: center; color: var(--primary-color); margin-bottom: 1.5rem; font-size: 2rem; }
        
        .form-group { margin-bottom: 1.2rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: bold; font-size: 0.9rem; }
        .form-input { width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; box-sizing: border-box; font-size: 1rem; }
        .form-input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 2px rgba(15, 37, 55, 0.1); }
        .error-text { color: var(--error-color); font-size: 0.85rem; margin-top: 0.3rem; display: block; }
        
        .btn-submit { width: 100%; background: var(--primary-color); color: white; padding: 1rem; border: none; border-radius: 5px; font-size: 1.1rem; cursor: pointer; font-weight: bold; transition: background 0.3s; margin-top: 1rem; }
        .btn-submit:hover { background: var(--primary-hover); }
    </style>
</head>
<body>


    <header>
        <a href="/" class="logo">easy job</a>
        <nav class="nav-links">
            <a href="/">Home</a>
            <a href="{{ route('login') }}">Log In</a>
        </nav>
    </header>


    <div class="auth-container">
        <h1 class="auth-title">Set New Password</h1>


        <form method="POST" action="{{ route('password.store') }}">
            @csrf


            <input type="hidden" name="token" value="{{ $request->route('token') }}">


            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus class="form-input">
                @error('email') <span class="error-text">{{ $message }}</span> @enderror
            </div>


            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <input type="password" id="password" name="password" required class="form-input">
                @error('password') <span class="error-text">{{ $message }}</span> @enderror
            </div>


            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="form-input">
            </div>


            <button type="submit" class="btn-submit">Reset Password</button>
        </form>
    </div>


</body>
</html>



