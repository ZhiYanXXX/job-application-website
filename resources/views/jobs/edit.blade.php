<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job - easy job</title>
    <style>
        /* Base Styles & Variables - Corporate Trust Palette */
        :root {
            --primary-color: #0f2537; /* Very Dark Corporate Navy */
            --primary-hover: #08141e; /* Almost Black Navy */
            --success-color: #0d9488; /* Professional Teal */
            --success-bg: #ccfbf1;    /* Soft Teal wash */
            --bg-light: #f8fafc;      
            --text-dark: #334155;    
            --text-gray: #64748b;
            --border-color: #e2e8f0;
            --error-color: #ef4444;   /* Added missing error color */
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        
        /* Updated body to push footer to the bottom */
        body { background-color: var(--bg-light); color: var(--text-dark); line-height: 1.6; display: flex; flex-direction: column; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }


        /* Navigation */
        header { background-color: white; padding: 1rem 5%; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary-color); }
        .nav-links { display: flex; align-items: center; }
        .nav-links a { margin-left: 1.5rem; font-weight: 500; }
        
        .btn-post { background-color: var(--primary-color); color: white; padding: 0.5rem 1rem; border-radius: 5px; transition: background 0.3s; margin-left: 1.5rem; }
        .btn-post:hover { background-color: var(--primary-hover); }
        .btn-logout { background: none; border: none; font-size: 1rem; cursor: pointer; font-weight: 500; color: var(--text-dark); margin-left: 1.5rem; }


        /* Form Container */
        .container { max-width: 800px; margin: 3rem auto; background: white; padding: 2.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid var(--border-color); width: 100%; box-sizing: border-box; }
        
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: bold; margin-bottom: 0.5rem; }
        .form-input { width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; font-size: 1rem; box-sizing: border-box; }
        
        /* Updated focus shadow to match dark navy */
        .form-input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 2px rgba(15, 37, 55, 0.1); }
        .error-text { color: var(--error-color); font-size: 0.85rem; display: block; margin-top: 0.3rem; }
        
        /* Form Buttons */
        .btn-submit { background: var(--primary-color); color: white; padding: 1rem 2rem; border: none; border-radius: 5px; cursor: pointer; font-size: 1.1rem; font-weight: bold; transition: background 0.3s; }
        .btn-submit:hover { background: var(--primary-hover); }
        .btn-cancel { margin-left: 1.5rem; color: var(--text-gray); font-weight: 500; }
        .btn-cancel:hover { color: var(--text-dark); text-decoration: underline; }


        /* Footer */
        footer { background: var(--text-dark); text-align: center; padding: 2rem; color: white; margin-top: auto; }
    </style>
</head>
<body>


    <header>
        <a href="/" class="logo">easy job</a>
        <nav class="nav-links">
            <a href="/">Home</a>
            <a href="/#jobs-section">Find Jobs</a>
            
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


            <a href="{{ route('jobs.create') }}" class="btn-post">Post a Job</a>
        </nav>
    </header>


    <div class="container">
        <h1 style="color: var(--primary-color); margin-bottom: 2rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">Edit Job: {{ $job->title }}</h1>
        
        <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" value="{{ old('title', $job->title) }}" class="form-input" required>
                @error('title') <span class="error-text">{{ $message }}</span> @enderror
            </div>


            <div class="form-group">
                <label class="form-label">Company Name</label>
                <input type="text" name="company" value="{{ old('company', $job->company) }}" class="form-input" required>
            </div>


            <div class="form-group">
                <label class="form-label">Location</label>
                <input type="text" name="location" value="{{ old('location', $job->location) }}" class="form-input" required>
            </div>


            <div class="form-group">
                <label class="form-label">Tags</label>
                <input type="text" name="tags" value="{{ old('tags', $job->tags) }}" class="form-input" required>
            </div>


            <div class="form-group">
                <label class="form-label">Update Company Logo</label>
                @if($job->company_logo)
                    <p style="font-size: 0.85rem; color: var(--text-gray); margin-bottom: 0.5rem;">Current logo is uploaded. Upload a new one to replace it.</p>
                @endif
                <input type="file" name="company_logo" accept="image/*" class="form-input" style="background: var(--bg-light); padding: 0.5rem;">
            </div>


            <div class="form-group">
                <label class="form-label">Job Description</label>
                <textarea name="description" rows="8" class="form-input" required>{{ old('description', $job->description) }}</textarea>
            </div>


            <div style="display: flex; align-items: center; margin-top: 2.5rem;">
                <button type="submit" class="btn-submit">Update Job</button>
                <a href="{{ url('/dashboard') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>


    <footer>
        <p>&copy; {{ date('Y') }} easy job. All rights reserved.</p>
    </footer>


</body>
</html>



