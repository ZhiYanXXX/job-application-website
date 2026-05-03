<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobFinder - Find Your Dream Job</title>
    <style>
        /* Base Styles */
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --success-color: #166534;
            --success-bg: #dcfce7;
            --bg-light: #f8fafc;
            --text-dark: #0f172a;
            --text-gray: #64748b;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        a { 
            text-decoration: none; 
            color: inherit; 
        }

        /* Navigation */
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
        }
        
        .nav-links a { 
            margin-left: 1.5rem; 
            font-weight: 500; 
        }
        
        .btn-post {
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        .btn-post:hover { 
            background-color: var(--primary-hover); 
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 5rem 5%;
            background: linear-gradient(rgba(37, 99, 235, 0.05), rgba(37, 99, 235, 0.1));
        }

        .hero h1 { 
            font-size: 3rem; 
            margin-bottom: 1rem; 
        }
        
        .hero p { 
            font-size: 1.2rem; 
            color: var(--text-gray); 
            margin-bottom: 2.5rem; 
        }

        /* Search Box */
        .search-box {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            display: flex;
            max-width: 800px;
            margin: 0 auto;
            gap: 10px;
        }

        .search-box input {
            flex: 1;
            padding: 0.8rem;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 1rem;
        }

        .search-box button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: bold;
        }
        
        .search-box button:hover { 
            background-color: var(--primary-hover); 
        }

        /* Job Listings Section */
        .featured-jobs { 
            padding: 4rem 5%; 
            max-width: 1200px; 
            margin: 0 auto; 
            min-height: 50vh; 
        }
        
        .section-title { 
            text-align: center; 
            margin-bottom: 3rem; 
            font-size: 2rem; 
        }

        .job-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        /* Job Card Styles */
        .job-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }

        /* Visual indicator for jobs already applied to */
        .card-applied { 
            border-color: var(--success-bg); 
            background-color: #f8fafc; 
        }

        .applied-badge {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: var(--success-bg);
            color: var(--success-color);
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .job-title { 
            font-size: 1.25rem; 
            font-weight: bold; 
            margin-bottom: 0.5rem; 
            color: var(--primary-color); 
            padding-right: 80px; 
        }
        
        .company-name { 
            color: var(--text-gray); 
            margin-bottom: 1rem; 
            font-weight: 500; 
        }
        
        .job-tags { 
            display: flex; 
            gap: 10px; 
            margin-bottom: 1rem; 
            flex-wrap: wrap; 
        }
        
        .tag {
            background: var(--bg-light);
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            font-size: 0.85rem;
            color: var(--text-gray);
            border: 1px solid var(--border-color);
        }

        .job-desc { 
            color: var(--text-gray); 
            margin-bottom: 1.5rem; 
            font-size: 0.9rem; 
            flex-grow: 1; 
        }

        /* Buttons */
        .apply-btn {
            display: inline-block;
            width: 100%;
            text-align: center;
            padding: 0.8rem;
            background: white;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s;
            margin-top: auto;
        }

        .apply-btn:hover { 
            background: var(--primary-color); 
            color: white; 
        }

        .btn-secondary { 
            border-color: var(--text-gray); 
            color: var(--text-gray); 
        }
        
        .btn-secondary:hover { 
            background: var(--text-gray); 
            color: white; 
        }

        /* Empty State */
        .empty-state { 
            text-align: center; 
            grid-column: 1 / -1; 
            padding: 3rem; 
            background: white; 
            border-radius: 8px; 
            border: 1px dashed var(--border-color); 
        }
        
        .empty-state h3 { 
            margin-bottom: 0.5rem; 
            color: var(--text-dark); 
        }
        
        .empty-state p { 
            color: var(--text-gray); 
            margin-bottom: 1.5rem; 
        }

        /* Footer */
        footer { 
            background: white; 
            text-align: center; 
            padding: 2rem; 
            border-top: 1px solid var(--border-color); 
            color: var(--text-gray); 
        }

        @media (max-width: 768px) {
            .search-box { flex-direction: column; }
            .hero h1 { font-size: 2rem; }
            .nav-links { display: none; }
        }
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

    <section class="hero">
        <h1>Find the job that fits your life</h1>
        <p>Search thousands of jobs from top companies and startups.</p>
        
        <form action="/" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Search babysitter, barista, tutor..." value="{{ request('search') }}">
            <button type="submit">Search Jobs</button>
        </form>
    </section>

    <section class="featured-jobs">
        
        @if(request('search'))
            <h2 class="section-title">Search Results for "{{ request('search') }}"</h2>
        @else
            <h2 class="section-title">Latest Opportunities</h2>
        @endif
        
        <div class="job-grid">
            
            @forelse($jobs as $job)
                
                <div class="job-card {{ session('applied_for_job_' . $job->id) ? 'card-applied' : '' }}">
                    
                    @if(session('applied_for_job_' . $job->id))
                        <div class="applied-badge">✓ Applied</div>
                    @endif

                    <div class="job-title">{{ $job->title }}</div>
                    <div class="company-name">{{ $job->company }}</div>
                    
                    <div class="job-tags">
                        <span class="tag">📍 {{ $job->location }}</span>
                        <span class="tag">💼 {{ $job->tags }}</span>
                    </div>
                    
                    <p class="job-desc">{{ Str::limit($job->description, 100) }}</p>
                    
                    @if(session('applied_for_job_' . $job->id))
                        <a href="/jobs/{{ $job->id }}" class="apply-btn btn-secondary">Review Details</a>
                    @else
                        <a href="/jobs/{{ $job->id }}" class="apply-btn">View Details</a>
                    @endif
                </div>

            @empty
                
                <div class="empty-state">
                    <h3>No jobs found</h3>
                    <p>We couldn't find any jobs matching your search criteria.</p>
                    <a href="/" class="btn-post" style="display: inline-block;">Clear Search</a>
                </div>

            @endforelse

        </div>
    </section>

    <footer>
        <p>&copy; {{ date('Y') }} JobFinder. All rights reserved. Built with Laravel.</p>
    </footer>

</body>
</html>


