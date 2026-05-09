<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - easy job</title>
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

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Navigation */
        header { background-color: white; padding: 1rem 5%; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; }
        .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary-color); text-decoration: none; }
        .nav-links { display: flex; align-items: center; }
        .nav-links a { margin-left: 1.5rem; font-weight: 500; text-decoration: none; color: inherit; }
        
        /* Favorites Badge */
        .fav-badge { background: var(--success-bg); color: var(--success-color); padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; font-weight: bold; margin-left: 5px; transition: all 0.3s; }

        /* Buttons */
        .btn-post { background-color: var(--primary-color); color: white; padding: 0.5rem 1rem; border-radius: 5px; border: none; cursor: pointer; font-size: 1rem; transition: background 0.3s; text-decoration: none; }
        .btn-post:hover { background-color: var(--primary-hover); }
        .btn-danger { background: var(--error-color); color: white; padding: 0.8rem 1.5rem; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: background 0.3s; }
        .btn-danger:hover { background: #b91c1c; }
        .btn-logout { background: none; border: none; font-size: 1rem; cursor: pointer; font-weight: 500; color: var(--text-dark); }

        /* Layout & Cards */
        .dashboard-container { max-width: 1000px; margin: 3rem auto; padding: 0 5%; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid var(--border-color); margin-bottom: 2rem; }
        .card-danger { border-color: #fca5a5; }
        
        .card-header { margin-bottom: 1.5rem; }
        .card-header h2 { color: var(--primary-color); margin-bottom: 0.5rem; font-size: 1.25rem; }
        .card-danger .card-header h2 { color: var(--error-color); }
        .card-header p { color: var(--text-gray); font-size: 0.9rem; margin: 0; }

        /* Forms & Alerts */
        .form-group { margin-bottom: 1.2rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: bold; font-size: 0.9rem; }
        .form-input { width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; box-sizing: border-box; font-size: 1rem; }
        .form-input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 2px rgba(15, 37, 55, 0.1); }
        .error-text { color: var(--error-color); font-size: 0.85rem; margin-top: 0.3rem; display: block; }
        
        /* Tables */
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { padding: 1rem 0; border-bottom: 2px solid var(--border-color); }
        td { padding: 1rem 0; border-bottom: 1px solid var(--border-color); }
        .job-title-link { font-weight: bold; color: var(--primary-color); text-decoration: none; }
        .action-link { color: var(--success-color); font-weight: bold; text-decoration: none; }
        .action-delete { background: none; border: none; color: var(--error-color); cursor: pointer; font-weight: bold; font-size: 1rem; padding: 0; }
        .action-delete:hover { text-decoration: underline; }

        /* Button Loading State */
        .is-loading { pointer-events: none; opacity: 0.8; position: relative; color: transparent !important; }
        .is-loading::after { content: ""; position: absolute; left: 50%; top: 50%; width: 1.2rem; height: 1.2rem; border: 2px solid white; border-radius: 50%; border-top-color: transparent; transform: translate(-50%, -50%); animation: spin 0.8s linear infinite; }
        @keyframes spin { to { transform: translate(-50%, -50%) rotate(360deg); } }

        /* Slide-in Toast Notifications */
        #toast-container { position: fixed; bottom: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
        .toast { background: var(--success-bg); color: var(--success-color); padding: 1rem 1.5rem; border-radius: 8px; border: 1px solid var(--success-color); box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 10px; font-weight: bold; font-size: 0.95rem; transform: translateX(120%); animation: slideIn 0.4s forwards cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .toast.fade-out { animation: fadeOut 0.4s forwards ease-in; }
        @keyframes slideIn { to { transform: translateX(0); } }
        @keyframes fadeOut { to { transform: translateX(120%); opacity: 0; } }

        footer { background: var(--text-dark); text-align: center; padding: 2rem; color: white; margin-top: 2rem; }
    </style>
</head>
<body>

    <header>
        <a href="/" class="logo">easy job</a>
        <nav class="nav-links">
            <a href="/">Home</a>
            <a href="/#jobs-section">Find Jobs</a>
            
            <a href="/#jobs-section">Favorites <span class="fav-badge" id="fav-counter">0</span></a>

            @if(session('is_logged_in'))
                <a href="{{ url('/dashboard') }}" style="margin-left: 1.5rem; font-weight: bold; color: var(--primary-color);">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 1.5rem;" class="loading-form">
                    @csrf
                    <button type="submit" class="btn-logout">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" style="margin-left: 1.5rem;">Log in</a>
                <a href="{{ route('register') }}" style="margin-left: 1.5rem;">Register</a>
            @endif

            <a href="{{ route('jobs.create') }}" class="btn-post" style="margin-left: 1.5rem;">Post a Job</a>
        </nav>
    </header>

    <div class="dashboard-container">
        
        <h1 style="color: var(--primary-color); margin-bottom: 1.5rem;">Welcome back, {{ session('user_name') }}!</h1>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h3 style="margin: 0;">Your Job Listings</h3>
                <a href="{{ route('jobs.create') }}" class="btn-post" style="font-size: 0.9rem; text-decoration: none;">+ Post New Job</a>
            </div>

            @if($jobs->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Posted Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td>
                                    <a href="/jobs/{{ $job->id }}" class="job-title-link">{{ $job->title }}</a>
                                </td>
                                <td style="color: var(--text-gray);">{{ \Carbon\Carbon::parse($job->created_at)->format('M d, Y') }}</td>
                                <td style="display: flex; gap: 15px;">
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="action-link apply-action-btn">Edit</a>
                                    
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');" class="loading-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-delete">Delete</button>
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

        <div class="card">
            <div class="card-header">
                <h2>Profile Information</h2>
                <p>
                    Update your account's profile name and email address. <br>
                    <em>(Note: Changes are only saved for this active session).</em>
                </p>
            </div>

            <form method="post" action="{{ route('profile.update') }}" style="max-width: 500px;" class="loading-form">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', session('user_name')) }}" required autofocus>
                    @error('name') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email', session('user_email', 'admin@easyjob.com')) }}" required>
                    @error('email') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1.5rem;">
                    <button type="submit" class="btn-post">Save Changes</button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Update Password</h2>
                <p>
                    Ensure your account is using a long, random password to stay secure. <br>
                    <em>(Note: Since this is a prototype, your new password is only saved temporarily).</em>
                </p>
            </div>

            <form method="post" action="{{ route('password.update') }}" style="max-width: 500px;" class="loading-form">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="form-input" required>
                    @error('current_password') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                    @error('password') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                </div>

                <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1.5rem;">
                    <button type="submit" class="btn-post">Save Password</button>
                </div>
            </form>
        </div>

        <div class="card card-danger">
            <div class="card-header">
                <h2>Delete Account</h2>
                <p>Once your account is deleted, your active session will end and all temporary jobs you posted will be cleared.</p>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you absolutely sure you want to delete your account? All temporary data will be lost.');" class="loading-form">
                @csrf
                @method('delete')
                <button type="submit" class="btn-danger">Delete Account</button>
            </form>
        </div>

    </div>

    <footer>
        <p>&copy; {{ date('Y') }} easy job. All rights reserved.</p>
    </footer>

    <div id="toast-container"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // 1. Toast Notification Logic
            window.showToast = function(message) {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.innerHTML = `<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg> <span>${message}</span>`;
                
                container.appendChild(toast);

                setTimeout(() => {
                    toast.classList.add('fade-out');
                    setTimeout(() => toast.remove(), 400);
                }, 3000);
            };

            // Trigger Toasts based on Laravel Session Statuses
            @if(session('success')) 
                showToast("{{ session('success') }}"); 
            @endif

            @if(session('status') === 'profile-updated') 
                showToast("Profile successfully updated!"); 
            @endif

            @if(session('status') === 'password-updated') 
                showToast("Password successfully changed!"); 
            @endif

            // 2. Read LocalStorage to keep the Favorites badge accurate
            let savedJobIds = JSON.parse(localStorage.getItem('easyjob_favorites')) || [];
            const favCounter = document.getElementById('fav-counter');
            if(favCounter) favCounter.innerText = savedJobIds.length;

            // 3. Button Loading States
            const forms = document.querySelectorAll('.loading-form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if(submitBtn) submitBtn.classList.add('is-loading');
                });
            });

            const actionBtns = document.querySelectorAll('.apply-action-btn');
            actionBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    this.classList.add('is-loading');
                    setTimeout(() => { this.classList.remove('is-loading'); }, 1500); 
                });
            });
            
        });
    </script>
</body>
</html>


