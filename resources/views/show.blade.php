<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }} - JobFinder</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-light: #f8fafc;
            --text-dark: #0f172a;
            --text-gray: #64748b;
            --border-color: #e2e8f0;
            --error-color: #ef4444;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Navigation Styles Brought Over From Homepage */
        header {
            background-color: white;
            padding: 1rem 5%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            text-decoration: none;
        }

        .nav-links a { margin-left: 1.5rem; font-weight: 500; text-decoration: none; color: inherit; }
        
        .btn-post {
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        .btn-post:hover { background-color: var(--primary-hover); color: white; }

        .jd-container {
            max-width: 800px;
            margin: 3rem auto;
            background: white;
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .jd-title { font-size: 2.5rem; color: var(--primary-color); margin-bottom: 0.5rem; }
        .jd-company { font-size: 1.2rem; color: var(--text-gray); font-weight: bold; margin-bottom: 1.5rem; }
        
        .tags { display: flex; gap: 10px; margin-bottom: 2rem; }
        .tag { background: var(--bg-light); padding: 0.4rem 0.8rem; border-radius: 4px; font-size: 0.9rem; border: 1px solid var(--border-color); }
        
        .jd-description { margin-bottom: 3rem; white-space: pre-wrap; }
        
        .btn-apply {
            background: var(--primary-color);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s ease;
        }
        
        .btn-apply:hover { background: var(--primary-hover); }
        
        .btn-apply:disabled {
            background: var(--text-gray);
            cursor: not-allowed;
        }

        .btn-back { color: var(--text-gray); text-decoration: none; margin-bottom: 2rem; display: inline-block; }
        
        /* Form Styles */
        .form-group { margin-bottom: 1.2rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        .form-input { width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; box-sizing: border-box; }
        .form-input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 2px rgba(37,99,235,0.1); }
        .error-text { color: var(--error-color); font-size: 0.85rem; margin-top: 0.3rem; display: block; }
    </style>
</head>
<body>

    <header>
        <a href="/" class="logo">JobFinder</a>
        <nav class="nav-links" style="display: flex; align-items: center;">
            <a href="/">Home</a>
            <a href="#">Find Jobs</a>
            
            @auth
                <a href="{{ url('/dashboard') }}" style="margin-left: 1.5rem; font-weight: bold; color: var(--primary-color);">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 1.5rem;">
                    @csrf
                    <button type="submit" style="background: none; border: none; font-size: 1rem; cursor: pointer; font-weight: 500; color: var(--text-dark);">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" style="margin-left: 1.5rem;">Log in</a>
                <a href="{{ route('register') }}" style="margin-left: 1.5rem;">Register</a>
            @endauth

            <a href="{{ route('jobs.create') }}" class="btn-post" style="margin-left: 1.5rem;">Post a Job</a>
        </nav>
    </header>

    <div class="jd-container">
        <a href="/" class="btn-back">← Back to Search</a>
        @if($job->company_logo)
    <img src="{{ asset('storage/' . $job->company_logo) }}" alt="{{ $job->company }} Logo" style="max-width: 150px; border-radius: 8px; margin-bottom: 1rem; border: 1px solid var(--border-color);">
@endif
        <h1 class="jd-title">{{ $job->title }}</h1>
        <div class="jd-company">{{ $job->company }}</div>
        
        <div class="tags">
            <span class="tag">📍 {{ $job->location }}</span>
            <span class="tag">💼 {{ $job->tags }}</span>
        </div>

        <h3>Job Description</h3>
        <p class="jd-description">{{ $job->description }}</p>

        <hr style="margin: 3rem 0; border: 0; border-top: 1px solid var(--border-color);">

        @if(session('applied_for_job_' . $job->id))
            
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 2rem; border-radius: 8px; text-align: center;">
                <h3 style="margin-bottom: 0.5rem;">🎉 Application Submitted!</h3>
                <p>You have successfully applied for the <strong>{{ $job->title }}</strong> position.</p>
                <p style="margin-top: 1rem; font-size: 0.9rem; color: #15803d;">We have sent your resume to the employer. Good luck!</p>
            </div>

        @else

            <h3>Apply for this Position</h3>

            <form id="applyForm" action="/jobs/{{ $job->id }}/apply" method="POST" enctype="multipart/form-data" autocomplete="off" style="display: flex; flex-direction: column; max-width: 500px;">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required class="form-input">
                    @error('name')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required class="form-input">
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="resume" class="form-label">Resume (PDF or Word, max 2MB)</label>
                    <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required class="form-input" style="background: var(--bg-light);">
                    @error('resume')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-apply" style="margin-top: 1rem;" onclick="this.disabled=true; this.innerHTML='Submitting...'; this.form.submit();">Submit Application</button>
            </form>

        @endif

    </div>

    <script>
        window.addEventListener('pageshow', function(event) {
            const form = document.getElementById('applyForm');
            if (event.persisted && form) {
                form.reset();
            }
        });
    </script>
</body>
</html>


