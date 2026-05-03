<body>
    <div class="container">
        <h1 style="color: var(--primary-color);">Edit Job: {{ $job->title }}</h1>
        
        <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="form-group">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" value="{{ old('title', $job->title) }}" class="form-input" required>
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
                    <p style="font-size: 0.8rem; margin-bottom: 0.5rem;">Current logo uploaded. Upload a new one to replace it.</p>
                @endif
                <input type="file" name="company_logo" accept="image/*" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Job Description</label>
                <textarea name="description" rows="8" class="form-input" required>{{ old('description', $job->description) }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Update Job</button>
            <a href="/dashboard" style="margin-left: 1rem; color: #64748b;">Cancel</a>
        </form>
    </div>
</body>
</html>


