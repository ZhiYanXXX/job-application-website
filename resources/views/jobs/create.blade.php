<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post a Job - JobFinder</title>
    <style>
        :root { --primary-color: #2563eb; --bg-light: #f8fafc; --text-dark: #0f172a; --border-color: #e2e8f0; --error-color: #ef4444; }
        body { font-family: 'Segoe UI', sans-serif; background-color: var(--bg-light); color: var(--text-dark); margin: 0; }
        .container { max-width: 800px; margin: 3rem auto; background: white; padding: 2.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: bold; margin-bottom: 0.5rem; }
        .form-input { width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; }
        .btn-submit { background: var(--primary-color); color: white; padding: 1rem 2rem; border: none; border-radius: 5px; cursor: pointer; font-size: 1.1rem; }
        .error-text { color: var(--error-color); font-size: 0.85rem; }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="color: var(--primary-color);">Post a New Job</h1>
        
        <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-input" required>
                @error('title') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Company Name</label>
                <input type="text" name="company" value="{{ old('company') }}" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Location (e.g., Remote, Kuala Lumpur)</label>
                <input type="text" name="location" value="{{ old('location') }}" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Tags (Comma separated, e.g., Full-time, Senior)</label>
                <input type="text" name="tags" value="{{ old('tags') }}" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Company Logo (Optional)</label>
                <input type="file" name="company_logo" accept="image/*" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Job Description</label>
                <textarea name="description" rows="8" class="form-input" required>{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Publish Job</button>
            <a href="/dashboard" style="margin-left: 1rem; color: #64748b;">Cancel</a>
        </form>
    </div>
</body>
</html>


