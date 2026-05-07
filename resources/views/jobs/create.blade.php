<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job - easy job</title>
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
            --error-color: #ef4444;   /* Added error color for validation messages */
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: var(--bg-light); color: var(--text-dark); line-height: 1.6; display: flex; flex-direction: column; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }


        /* Navigation */
        header { background-color: white; padding: 1rem 5%; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary-color); }
        .nav-links { display: flex; align-items: center; }
        .nav-links a { margin-left: 1.5rem; font-weight: 500; }
        
        .btn-logout { background: none; border: none; font-size: 1rem; cursor: pointer; font-weight: 500; color: var(--text-dark); margin-left: 1.5rem; }


        /* Form Container */
        .container { max-width: 800px; margin: 3rem auto; background: white; padding: 2.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid var(--border-color); width: 100%; box-sizing: border-box; }
        
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: bold; margin-bottom: 0.5rem; }
        .form-input { width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; font-size: 1rem; box-sizing: border-box; }
        
        /* Updated focus shadow to match your dark navy instead of the old royal blue */
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
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">Log Out</button>
            </form>
        </nav>
    </header>


    <div class="container">
        <h1 style="color: var(--primary-color); margin-bottom: 2rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">Post a New Job</h1>


        <form method="POST" action="{{ route('jobs.store') }}" enctype="multipart/form-data">
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
                <label for="company_logo" class="form-label">Company Logo (Optional)</label>
                <input type="file" id="company_logo" name="company_logo" class="form-input" accept="image/*" style="padding: 0.5rem;">
            </div>


            <div class="form-group">
                <label for="description" class="form-label">Job Description</label>
                <textarea id="description" name="description" class="form-input" rows="8" required placeholder="Describe the responsibilities, requirements, and benefits associated with this role..."></textarea>
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


</body>
</html>



