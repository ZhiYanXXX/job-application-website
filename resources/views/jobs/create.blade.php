<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job - easy job</title>
    <style>
        /* Base Styles & Variables */
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-light: #f8fafc;
            --text-dark: #0f172a;
            --text-gray: #64748b;
            --border-color: #e2e8f0;
            --error-color: #ef4444;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: var(--bg-light); color: var(--text-dark); line-height: 1.6; }
        a { text-decoration: none; color: inherit; }


        /* Navigation */
        header { background-color: white; padding: 1rem 5%; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary-color); }
        .nav-links { display: flex; align-items: center; }
        .nav-links a { margin-left: 1.5rem; font-weight: 500; }
        
        .btn-logout { background: none; border: none; font-size: 1rem; cursor: pointer; font-weight: 500; color: var(--text-dark); margin-left: 1.5rem; }


        /* Form Container */
        .container { max-width: 800px; margin: 3rem auto; background: white; padding: 2.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid var(--border-color); }
        
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: bold; margin-bottom: 0.5rem; }
        .form-input { width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; font-size: 1rem; }
        .form-input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 2px rgba(37,99,235,0.1); }
        .error-text { color: var(--error-color); font-size: 0.85rem; display: block; margin-top: 0.3rem; }
        
        /* Form Buttons */
        .btn-submit { background: var(--primary-color); color: white; padding: 1rem 2rem; border: none; border-radius: 5px; cursor: pointer; font-size: 1.1rem; font-weight: bold; transition: background 0.3s; }
        .btn-submit:hover { background: var(--primary-hover); }
        .btn-cancel { margin-left: 1.5rem; color: var(--text-gray); font-weight: 500; }
        .btn-cancel:hover { color: var(--text-dark); }
    </style>
</head>
<body>


    <header>
        <a href="/" class="logo">easy job</a>
        <nav class="nav-links">
            <a href="/">Home</a>
            <a href="#">Find Jobs</a>
            
            @if(session('is_logged_in'))
                <a href="{{ url('/dashboard') }}" style="color: var(--primary-color); font-weight: bold;">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}">Log in</a>
                <a href="{{ route('register') }}">Register</a>
            @endif
        </nav>
    </header>


    <div class="container">
        <h1 style="color: var(--primary-color); margin-bottom: 2rem;">Post a New Job</h1>
        
        <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-input" required autofocus>
                @error('title') <span class="error-text">{{ $message }}</span> @enderror
            </div>


            <div class="form-group">
                <label class="form-label">Company Name</label>
                <input type="text" name="company" value="{{ old('company') }}" class="form-input" required>
            </div>


            <div class="form-group">
                <label class="form-label">Location (e.g., Remote, Kuala Lumpur)</label>
                <input type="text" name="location" value="{{ old('location', 'Cheras, Selangor') }}" class="form-input" required>
            </div>


            <div class="form-group">
                <label class="form-label">Tags (Comma separated, e.g., Full-time, Senior)</label>
                <input type="text" name="tags" value="{{ old('tags') }}" class="form-input" required>
            </div>


            <div class="form-group">
                <label class="form-label">Company Logo (Optional)</label>
                <input type="file" name="company_logo" accept="image/*" class="form-input" style="background: var(--bg-light);">
            </div>


            <div class="form-group">
                <label class="form-label">Job Description</label>
                <textarea name="description" rows="8" class="form-input" required>{{ old('description') }}</textarea>
            </div>


            <div style="display: flex; align-items: center; margin-top: 2rem;">
                <button type="submit" class="btn-submit">Publish Job</button>
                <a href="/dashboard" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>


</body>
</html>



