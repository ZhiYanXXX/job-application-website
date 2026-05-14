<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }} - easy job</title>
    <style>
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
       
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: var(--bg-light); color: var(--text-dark); line-height: 1.6; }
        a { text-decoration: none; color: inherit; }

        /* Navigation */
        header { background-color: white; padding: 1rem 5%; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; }
        .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary-color); }
        .nav-links { display: flex; align-items: center; }
        .nav-links a { margin-left: 1.5rem; font-weight: 500; cursor: pointer; }
        .fav-badge { background: var(--success-bg); color: var(--success-color); padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; font-weight: bold; margin-left: 5px; }
        .btn-post { background-color: var(--primary-color); color: white; padding: 0.5rem 1rem; border-radius: 5px; transition: background 0.3s; margin-left: 1.5rem; }
        .btn-post:hover { background-color: var(--primary-hover); }
        .btn-logout { background: none; border: none; font-size: 1rem; cursor: pointer; font-weight: 500; color: var(--text-dark); margin-left: 1.5rem; }

        /* Job Details Container */
        .jd-container { max-width: 800px; margin: 3rem auto; background: white; padding: 2.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); box-sizing: border-box; position: relative; }
        .btn-back { color: var(--text-gray); margin-bottom: 2rem; display: inline-block; font-weight: 500; }
        .btn-back:hover { color: var(--text-dark); text-decoration: underline; }
       
        .jd-header { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1.5rem; }
        .jd-logo { width: 100px; height: 100px; object-fit: contain; border-radius: 8px; border: 1px solid var(--border-color); padding: 0.5rem; background: white; }
        .jd-title { font-size: 2.5rem; color: var(--primary-color); margin-bottom: 0.2rem; line-height: 1.2; padding-right: 40px; }
        .jd-company { font-size: 1.2rem; color: var(--text-gray); font-weight: bold; }
       
        .tags { display: flex; gap: 10px; margin-bottom: 2rem; flex-wrap: wrap; }
        .tag { background: var(--bg-light); padding: 0.4rem 0.8rem; border-radius: 4px; font-size: 0.9rem; border: 1px solid var(--border-color); }
        
        /* Render Rich Text properly */
        .jd-description { margin-bottom: 3rem; color: var(--text-dark); }
        .jd-description ul, .jd-description ol { margin-left: 1.5rem; margin-bottom: 1rem; }
        .jd-description p { margin-bottom: 1rem; }
       
        .divider { margin: 3rem 0; border: 0; border-top: 1px solid var(--border-color); }

        /* Save Heart Toggle inside Details */
        .save-btn { position: absolute; top: 2.5rem; right: 2.5rem; background: none; border: none; cursor: pointer; color: #cbd5e1; transition: color 0.3s, transform 0.2s; z-index: 2; padding: 0; outline: none; }
        .save-btn:hover { transform: scale(1.1); color: #94a3b8; }
        .save-btn.saved { color: #ef4444; }
        .save-btn.saved svg { fill: #ef4444; }

        /* Buttons */
        .action-buttons { display: flex; gap: 1rem; margin-top: 2rem; }
        .btn-apply { background: var(--primary-color); color: white; padding: 1rem 2rem; border: none; border-radius: 5px; font-size: 1.1rem; cursor: pointer; font-weight: bold; transition: background 0.3s ease; }
        .btn-apply:hover { background: var(--primary-hover); }
        .btn-share { background: white; color: var(--text-dark); border: 1px solid var(--border-color); padding: 1rem 2rem; border-radius: 5px; font-size: 1.1rem; cursor: pointer; font-weight: bold; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; }
        .btn-share:hover { background: var(--bg-light); border-color: var(--text-gray); }

        .alert-success { background: var(--success-bg); border: 1px solid var(--success-color); color: var(--success-color); padding: 2rem; border-radius: 8px; text-align: center; }
        .alert-success h3 { margin-bottom: 0.5rem; font-size: 1.4rem; }
        .alert-success p { margin-top: 1rem; font-size: 0.95rem; color: var(--success-color); font-weight: 500; }

        /* Apply Modal Overlay */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 37, 55, 0.6); display: none; justify-content: center; align-items: center; z-index: 999; backdrop-filter: blur(4px); }
        .modal-box { background: white; padding: 2.5rem; border-radius: 8px; width: 90%; max-width: 500px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .modal-close { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-gray); }
        .form-group { margin-bottom: 1.2rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        .form-input { width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; font-size: 1rem; box-sizing: border-box; }
        .form-input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 2px rgba(15, 37, 55, 0.1); }

        /* Toasts & Loading */
        #toast-container { position: fixed; bottom: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
        .toast { background: var(--success-bg); color: var(--success-color); padding: 1rem 1.5rem; border-radius: 8px; border: 1px solid var(--success-color); box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 10px; font-weight: bold; font-size: 0.95rem; transform: translateX(120%); animation: slideIn 0.4s forwards cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .toast.fade-out { animation: fadeOut 0.4s forwards ease-in; }
        @keyframes slideIn { to { transform: translateX(0); } }
        @keyframes fadeOut { to { transform: translateX(120%); opacity: 0; } }

        .is-loading { pointer-events: none; opacity: 0.8; position: relative; color: transparent !important; }
        .is-loading::after { content: ""; position: absolute; left: 50%; top: 50%; width: 1.2rem; height: 1.2rem; border: 2px solid var(--primary-color); border-radius: 50%; border-top-color: transparent; transform: translate(-50%, -50%); animation: spin 0.8s linear infinite; }
        .btn-apply.is-loading::after { border-color: white; border-top-color: transparent; }
        @keyframes spin { to { transform: translate(-50%, -50%) rotate(360deg); } }
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
                <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 1.5rem;">
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

    <div class="jd-container">
        <a href="/" class="btn-back">← Back to Job Board</a>
        
        <button class="save-btn" data-job-id="{{ $job->id }}" title="Save for later">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
        </button>

        <div class="jd-header">
            @if($job->company_logo)
                <img src="{{ asset('storage/' . $job->company_logo) }}" alt="{{ $job->company }} Logo" class="jd-logo">
            @else
                <div class="jd-logo" style="display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--text-gray); background: var(--bg-light);">
                    {{ substr($job->company, 0, 1) }}
                </div>
            @endif
            
            <div>
                <h1 class="jd-title">{{ $job->title }}</h1>
                <div class="jd-company">{{ $job->company }}</div>
            </div>
        </div>

        <div class="tags">
            <span class="tag">📍 {{ $job->location }}</span>
            <span class="tag">💼 {{ $job->tags }}</span>
            <span class="tag">💰 {{ $job->salary ?? 'Salary Negotiable' }}</span>
            <span class="tag">🕒 Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</span>
        </div>

        <hr class="divider">

        <h2>Job Description</h2>
        <br>
        <div class="jd-description">
            {!! nl2br($job->description) !!}
        </div>

        @if(session('applied_for_job_' . $job->id))
            <div class="alert-success">
                <h3>Application Submitted!</h3>
                <p>We've sent your profile to <strong>{{ $job->company }}</strong>. They will contact you if your qualifications match their needs.</p>
            </div>
        @else
            <div class="action-buttons">
                <button type="button" class="btn-apply" id="openModalBtn">Apply Now</button>
                <button type="button" class="btn-share" id="shareBtn">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                    Share Job
                </button>
            </div>
        @endif
    </div>

    <div class="modal-overlay" id="applyModal">
        <div class="modal-box">
            <div class="modal-header">
                <h2 style="color: var(--primary-color); margin: 0;">Apply to {{ $job->company }}</h2>
                <button class="modal-close" id="closeModalBtn">&times;</button>
            </div>
            
            <form method="POST" action="{{ route('jobs.apply', $job->id) }}" id="applyForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-input" required value="{{ session('user_name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" required value="{{ session('user_email') }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Resume (PDF, DOCX)</label>
                    <input type="file" name="resume" class="form-input" accept=".pdf,.doc,.docx" required style="padding: 0.5rem; background: var(--bg-light);">
                </div>

                <div class="form-group">
                    <label class="form-label">Cover Letter (Optional)</label>
                    <textarea name="cover_letter" class="form-input" rows="4" placeholder="Briefly explain why you're a great fit..."></textarea>
                </div>
                <button type="submit" class="btn-apply" style="width: 100%;">Submit Application</button>
            </form>
        </div>
    </div>

    <div id="toast-container"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Toast Function
            window.showToast = function(message) {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.innerHTML = `<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg> <span>${message}</span>`;
                container.appendChild(toast);
                setTimeout(() => { toast.classList.add('fade-out'); setTimeout(() => toast.remove(), 400); }, 3000);
            };

            // Display server success messages automatically
            @if(session('success'))
                showToast("{{ session('success') }}");
            @endif

            // Favorites Logic
            let savedJobIds = JSON.parse(localStorage.getItem('easyjob_favorites')) || [];
            const favCounter = document.getElementById('fav-counter');
            if(favCounter) favCounter.innerText = savedJobIds.length;

            const saveBtn = document.querySelector('.save-btn');
            if (saveBtn) {
                const jobId = saveBtn.getAttribute('data-job-id');
                if (savedJobIds.includes(jobId)) saveBtn.classList.add('saved');

                saveBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    saveBtn.classList.toggle('saved');
                    if (saveBtn.classList.contains('saved')) {
                        savedJobIds.push(jobId);
                        showToast('Job saved to your favorites!');
                    } else {
                        savedJobIds = savedJobIds.filter(id => id !== jobId);
                        showToast('Job removed from favorites.');
                    }
                    localStorage.setItem('easyjob_favorites', JSON.stringify(savedJobIds));
                    if(favCounter) favCounter.innerText = savedJobIds.length;
                });
            }

            // Share Button Logic
            const shareBtn = document.getElementById('shareBtn');
            if(shareBtn) {
                shareBtn.addEventListener('click', () => {
                    navigator.clipboard.writeText(window.location.href).then(() => {
                        showToast("Job link copied to clipboard!");
                    });
                });
            }

            // Apply Modal Logic
            const modal = document.getElementById('applyModal');
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const applyForm = document.getElementById('applyForm');

            if(openModalBtn) {
                openModalBtn.addEventListener('click', () => {
                    modal.style.display = 'flex';
                });
            }

            if(closeModalBtn) {
                closeModalBtn.addEventListener('click', () => {
                    modal.style.display = 'none';
                });
            }

            // Close modal if user clicks outside the box
            window.addEventListener('click', (e) => {
                if (e.target === modal) modal.style.display = 'none';
            });

            if(applyForm) {
                applyForm.addEventListener('submit', function() {
                    const submitBtn = applyForm.querySelector('button[type="submit"]');
                    submitBtn.classList.add('is-loading');
                    submitBtn.innerText = 'Sending...';
                });
            }
        });
    </script>
</body>
</html>


