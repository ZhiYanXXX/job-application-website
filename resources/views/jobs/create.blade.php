<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job - easy job</title>
    
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

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
        body { background-color: var(--bg-light); color: var(--text-dark); line-height: 1.6; display: flex; flex-direction: column; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }

        header { background-color: white; padding: 1rem 5%; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; }
        .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary-color); }
        .nav-links { display: flex; align-items: center; }
        .nav-links a { margin-left: 1.5rem; font-weight: 500; }
        .fav-badge { background: var(--success-bg); color: var(--success-color); padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; font-weight: bold; margin-left: 5px; }
        .btn-logout { background: none; border: none; font-size: 1rem; cursor: pointer; font-weight: 500; color: var(--text-dark); margin-left: 1.5rem; }

        .container { max-width: 800px; margin: 3rem auto; background: white; padding: 2.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid var(--border-color); width: 100%; box-sizing: border-box; }
        
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: bold; margin-bottom: 0.5rem; }
        .form-input { width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; font-size: 1rem; box-sizing: border-box; }
        .form-input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 2px rgba(15, 37, 55, 0.1); }
        
        /* Quill Editor Adjustments */
        #editor-container { height: 250px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; font-family: 'Segoe UI', sans-serif; font-size: 1rem; }
        .ql-toolbar { border-top-left-radius: 5px; border-top-right-radius: 5px; background: var(--bg-light); border-color: var(--border-color) !important; }
        .ql-container { border-color: var(--border-color) !important; }

        .btn-submit { background: var(--primary-color); color: white; padding: 1rem 2rem; border: none; border-radius: 5px; cursor: pointer; font-size: 1.1rem; font-weight: bold; transition: background 0.3s; }
        .btn-submit:hover { background: var(--primary-hover); }
        .btn-cancel { margin-left: 1.5rem; color: var(--text-gray); font-weight: 500; }
        .btn-cancel:hover { color: var(--text-dark); text-decoration: underline; }

        .is-loading { pointer-events: none; opacity: 0.8; position: relative; color: transparent !important; }
        .is-loading::after { content: ""; position: absolute; left: 50%; top: 50%; width: 1.2rem; height: 1.2rem; border: 2px solid white; border-radius: 50%; border-top-color: transparent; transform: translate(-50%, -50%); animation: spin 0.8s linear infinite; }
        @keyframes spin { to { transform: translate(-50%, -50%) rotate(360deg); } }

        footer { background: var(--text-dark); text-align: center; padding: 2rem; color: white; margin-top: auto; }
    </style>
</head>
<body>

    <header>
        <a href="/" class="logo">easy job</a>
        <nav class="nav-links">
            <a href="/">Home</a>
            <a href="/#jobs-section">Favorites <span class="fav-badge" id="fav-counter">0</span></a>
            <a href="{{ url('/dashboard') }}" style="color: var(--primary-color); font-weight: bold; margin-left: 1.5rem;">Dashboard</a>
            
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">Log Out</button>
            </form>
        </nav>
    </header>

    <div class="container">
        <h1 style="color: var(--primary-color); margin-bottom: 2rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">Post a New Job</h1>

        <form method="POST" action="{{ route('jobs.store') }}" enctype="multipart/form-data" id="jobForm">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" id="title" name="title" class="form-input" required placeholder="e.g. Senior Software Engineer">
            </div>

            <div class="form-group">
                <label for="company" class="form-label">Company Name</label>
                <input type="text" id="company" name="company" class="form-input" required placeholder="e.g. Kinta Tech Solutions">
            </div>

            <div class="form-group">
                <label for="location" class="form-label">Location</label>
                <input type="text" id="location" name="location" class="form-input" required placeholder="e.g. Ipoh, Perak">
            </div>

            <div class="form-group">
                <label for="tags" class="form-label">Job Type (Tags)</label>
                <input type="text" id="tags" name="tags" class="form-input" required placeholder="e.g. Full-time, Hybrid, Contract">
            </div>
            <div class="form-group">
                <label for="salary" class="form-label">Salary</label>
                <input type="text" id="salary" name="salary" class="form-input" placeholder="e.g. 15 MYR / hour or RM 3000 / month">
            </div>
            <div class="form-group">
                <label for="company_logo" class="form-label">Company Logo (Optional)</label>
                <input type="file" id="company_logo" name="company_logo" class="form-input" accept="image/*" style="padding: 0.5rem; background: var(--bg-light);">
            </div>

            <div class="form-group">
                <label class="form-label">Job Description</label>
                <div id="editor-container"></div>
                <input type="hidden" id="description" name="description" required>
            </div>

            <div style="margin-top: 2.5rem; display: flex; align-items: center;">
                <button type="submit" class="btn-submit">Publish Job</button>
                <a href="{{ url('/dashboard') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} easy job. All rights reserved.</p>
    </footer>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // Sync Favorites Counter
            let savedJobIds = JSON.parse(localStorage.getItem('easyjob_favorites')) || [];
            const favCounter = document.getElementById('fav-counter');
            if(favCounter) favCounter.innerText = savedJobIds.length;

            // Initialize Quill Editor
            var quill = new Quill('#editor-container', {
                theme: 'snow',
                placeholder: 'Describe the responsibilities, requirements, and benefits...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link']
                    ]
                }
            });

            // Before the form submits, copy the Rich Text HTML into the hidden input
            const form = document.getElementById('jobForm');
            form.addEventListener('submit', function(e) {
                const hiddenInput = document.getElementById('description');
                hiddenInput.value = quill.root.innerHTML;
                
                // Add loading spinner to button
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.classList.add('is-loading');
            });

        });
    </script>
</body>
</html>


