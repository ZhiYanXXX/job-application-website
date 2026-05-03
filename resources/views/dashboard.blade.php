<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - JobFinder</title>
    <style>
        /* Bringing in your JobFinder Styles */
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-light: #f8fafc;
            --text-dark: #0f172a;
            --text-gray: #64748b;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        header {
            background-color: white;
            padding: 1rem 5%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary-color); text-decoration: none; }
        .nav-links a { margin-left: 1.5rem; font-weight: 500; text-decoration: none; color: inherit; }
        
        .btn-post {
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .btn-post:hover { background-color: var(--primary-hover); color: white; }

        .dashboard-container {
            max-width: 1000px;
            margin: 3rem auto;
            padding: 0 5%;
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
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
            @endauth

            <a href="{{ route('jobs.create') }}" class="btn-post" style="margin-left: 1.5rem;">Post a Job</a>
        </nav>
    </header>

<div class="dashboard-container">
        <h1 style="color: var(--primary-color); margin-bottom: 1.5rem;">Welcome back, {{ auth()->user()->name }}!</h1>
        
        @if(session('success'))
            <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 5px; margin-bottom: 1.5rem; border: 1px solid #bbf7d0;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3 style="margin: 0;">Your Job Listings</h3>
                <a href="{{ route('jobs.create') }}" class="btn-post" style="font-size: 0.9rem;">+ Post New Job</a>
            </div>

            @if($jobs->count() > 0)
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--border-color);">
                            <th style="padding: 1rem 0;">Job Title</th>
                            <th>Posted Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 1rem 0; font-weight: bold; color: var(--primary-color);">
                                    <a href="/jobs/{{ $job->id }}">{{ $job->title }}</a>
                                </td>
                                <td style="color: var(--text-gray);">{{ $job->created_at->format('M d, Y') }}</td>
                                <td style="display: flex; gap: 10px; padding: 1rem 0;">
                                    
                                    <a href="{{ route('jobs.edit', $job->id) }}" style="color: #0284c7; font-weight: bold;">Edit</a>
                                    
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: var(--error-color); cursor: pointer; font-weight: bold; font-size: 1rem;">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: var(--text-gray); text-align: center; padding: 2rem 0;">You haven't posted any jobs yet.</p>
            @endif
        </div>
    </div>

</body>
</html>


