<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - JobFinder</title>
    <style>
        :root { --primary-color: #2563eb; --primary-hover: #1d4ed8; --bg-light: #f8fafc; --text-dark: #0f172a; --text-gray: #64748b; --border-color: #e2e8f0; --error-color: #ef4444; }
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: var(--bg-light); color: var(--text-dark); margin: 0; padding: 0; line-height: 1.6; display: flex; flex-direction: column; min-height: 100vh; }
        
        header { background-color: white; padding: 1rem 5%; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary-color); text-decoration: none; }
        .nav-links a { margin-left: 1.5rem; font-weight: 500; text-decoration: none; color: inherit; }
        
        .auth-container { max-width: 450px; margin: 4rem auto auto auto; background: white; padding: 2.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid var(--border-color); width: 100%; }
        .auth-title { text-align: center; color: var(--primary-color); margin-bottom: 2rem; font-size: 2rem; }
        
        .form-group { margin-bottom: 1.2rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: bold; font-size: 0.9rem; }
        .form-input { width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; box-sizing: border-box; font-size: 1rem; }
        .form-input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 2px rgba(37,99,235,0.1); }
        .error-text { color: var(--error-color); font-size: 0.85rem; margin-top: 0.3rem; display: block; }
        
        .btn-submit { width: 100%; background: var(--primary-color); color: white; padding: 1rem; border: none; border-radius: 5px; font-size: 1.1rem; cursor: pointer; font-weight: bold; transition: background 0.3s; margin-top: 1rem; }
        .btn-submit:hover { background: var(--primary-hover); }
        
        .auth-links { text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: var(--text-gray); }
        .auth-links a { color: var(--primary-color); text-decoration: none; font-weight: bold; }
        .auth-links a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <header>
        <a href="/" class="logo">JobFinder</a>
        <nav class="nav-links">
            <a href="/">Home</a>
            <a href="{{ route('register') }}">Register</a>
        </nav>
    </header>

    <div class="auth-container">
        <h1 class="auth-title">Welcome Back</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="form-input">
                @error('email') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" required class="form-input">
                @error('password') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" id="remember_me" name="remember" style="cursor: pointer;">
                <label for="remember_me" style="font-size: 0.9rem; color: var(--text-gray); cursor: pointer;">Remember me</label>
            </div>

            <button type="submit" class="btn-submit">Log In</button>
        </form>

        <div class="auth-links">
            Don't have an account? <a href="{{ route('register') }}">Sign up here</a>
        </div>
    </div>

</body>
</html>

