<?php

use App\Http\Controllers\ProfileController;
use App\Models\JobListing;
use App\Models\JobApplication; // Added this so the Apply route works!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; // Only need this once
use App\Http\Controllers\JobController;

// 1. The Home Page & Search Logic
Route::get('/', function (Request $request) {
    $query = JobListing::query();
   
    // If the user typed something in the search bar, filter the results
    if ($request->has('search')) {
        $searchTerm = $request->search;
        $query->where('title', 'LIKE', "%{$searchTerm}%")
              ->orWhere('description', 'LIKE', "%{$searchTerm}%");
    }
   
    $jobs = $query->latest()->get();
    return view('welcome', ['jobs' => $jobs]);
});

// 2. The Job Details (JD) Page Route
Route::get('/jobs/{id}', function ($id) {
    $job = JobListing::findOrFail($id);
    return view('show', ['job' => $job]);
})->whereNumber('id');

// 3. The Submit Application Route
Route::post('/jobs/{id}/apply', function (Request $request, $id) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'resume' => 'required|mimes:pdf,doc,docx|max:2048'
    ]);

    $path = $request->file('resume')->store('resumes', 'public');

    JobApplication::create([
        'job_listing_id' => $id,
        'name' => $request->name,
        'email' => $request->email,
        'resume_path' => $path
    ]);

    // Add a session flag remembering they applied
    session()->put('applied_for_job_' . $id, true);

    return back()->with('success', 'Your application and resume have been submitted successfully!');
});

// --- BREEZE AUTHENTICATION ROUTES BELOW ---

Route::get('/dashboard', function () {
    // Fetch only the jobs created by the logged-in user
    $jobs = App\Models\JobListing::where('user_id', auth()->id())->latest()->get();
    
    return view('dashboard', ['jobs' => $jobs]);
})->middleware(['auth'])->name('dashboard');




Route::middleware('auth')->group(function () {
        // Job Management Routes
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


