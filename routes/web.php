<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;

// ==========================================
// 1. SETUP & HELPER FUNCTIONS
// ==========================================
function initFakeDatabase() {
    if (!session()->has('jobs')) {
        session()->put('jobs', [
            1 => [
                'id' => 1, 'title' => 'Freelance Video Editor', 'company' => 'Ipoh Creative Studios',
                'location' => 'Remote / Ipoh', 'tags' => 'Freelance', 'salary' => '20 MYR / hour',
                'description' => 'Looking for a talented video editor to cut and color-grade short-form content for our clients. Must be proficient in Premiere Pro or DaVinci Resolve.',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(1)
            ],
            2 => [
                'id' => 2, 'title' => 'Social Media Assistant', 'company' => 'Perak Digital Hub',
                'location' => 'Greentown Business Centre', 'tags' => 'Part-time', 'salary' => '12 MYR / hour',
                'description' => 'Help us manage TikTok and Instagram accounts for local restaurants. Responsibilities include scheduling posts, engaging with followers, and basic content creation.',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(2)
            ],
            3 => [
                'id' => 3, 'title' => 'Junior Graphic Designer', 'company' => 'Print & Co. Ipoh',
                'location' => 'Medan Istana', 'tags' => 'Full-time', 'salary' => '15 MYR / hour',
                'description' => 'Join our design team to create flyers, banners, and digital assets. Great opportunity for fresh graduates looking to build their portfolio.',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(3)
            ],
            4 => [
                'id' => 4, 'title' => 'Barista', 'company' => 'Artisan Roastery',
                'location' => 'Ipoh Old Town', 'tags' => 'Shift Work', 'salary' => '12 MYR / hour',
                'description' => 'Passionate about coffee? We are looking for an energetic barista to craft specialty beverages and provide excellent customer service.',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(4)
            ],
            5 => [
                'id' => 5, 'title' => 'Service Crew', 'company' => 'Burger King',
                'location' => 'Station 18', 'tags' => 'Full-time', 'salary' => '9 MYR / hour',
                'description' => 'Fast-paced environment! You will be taking orders, preparing food, and ensuring the dining area remains clean and welcoming.',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(5)
            ],
            6 => [
                'id' => 6, 'title' => 'Promoter', 'company' => 'Tech World Malaysia',
                'location' => 'Ipoh Parade', 'tags' => 'Weekend', 'salary' => '10 MYR / hour',
                'description' => 'Weekend promoter needed to showcase the latest smartphone models. High commission rates for every successful sale!',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(6)
            ],
            7 => [
                'id' => 7, 'title' => 'Kitchen Helper', 'company' => 'Restoran Nasi Kandar',
                'location' => 'Meru Raya', 'tags' => 'Shift Work', 'salary' => '10 MYR / hour',
                'description' => 'Assist the head chef with ingredient preparation, washing dishes, and maintaining kitchen hygiene standards.',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(7)
            ],
            8 => [
                'id' => 8, 'title' => 'Administrative Clerk', 'company' => 'Wong & Partners',
                'location' => 'Jalan Sultan Idris Shah', 'tags' => 'Full-time', 'salary' => '10 MYR / hour',
                'description' => 'Handle daily office operations, answer phone calls, organize files, and assist the HR department with basic data entry.',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(8)
            ],
            9 => [
                'id' => 9, 'title' => 'Customer Service Agent', 'company' => 'Maju Telco',
                'location' => 'Bercham, Ipoh', 'tags' => 'Contract', 'salary' => '8 MYR / hour',
                'description' => 'Answer customer inquiries via phone and live chat. Provide troubleshooting support for mobile network issues.',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(9)
            ],
            10 => [
                'id' => 10, 'title' => 'Retail Cashier', 'company' => 'Watsons',
                'location' => 'Aeon Kinta City', 'tags' => 'Full-time', 'salary' => '9 MYR / hour',
                'description' => 'Manage point-of-sale transactions, assist customers with store promotions, and ensure the checkout counter is organized.',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(10)
            ],
            11 => [
                'id' => 11, 'title' => 'Event Coordinator', 'company' => 'Perak Mega Events',
                'location' => 'Tambun', 'tags' => 'Freelance', 'salary' => '12 MYR / hour',
                'description' => 'Help organize and run on-site logistics for corporate events, weddings, and local festivals. Flexible hours required.',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(11)
            ],
            12 => [
                'id' => 12, 'title' => 'Delivery Rider', 'company' => 'Express Logistics',
                'location' => 'Ipoh Area', 'tags' => 'Freelance', 'salary' => '10 MYR / hour',
                'description' => 'Deliver parcels safely and efficiently around the Ipoh area. Must possess a valid B2 motorcycle license and own a vehicle.',
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(12)
            ]
        ]);
    }
}

// Consolidates fetching, searching, sorting, and formatting jobs
function fetchJobs($search = null) {
    initFakeDatabase();
    $jobs = session('jobs', []);

    if ($search) {
        $term = strtolower($search);
        $jobs = array_filter($jobs, fn($job) =>
            str_contains(strtolower($job['title']), $term) ||
            str_contains(strtolower($job['description']), $term) ||
            str_contains(strtolower($job['company']), $term) ||
            str_contains(strtolower($job['tags']), $term) ||
            str_contains(strtolower($job['salary'] ?? ''), $term) // Also search by salary!
        );
    }

    krsort($jobs);
    return collect(array_map(fn($job) => (object) $job, $jobs));
}

// ==========================================
// 2. PUBLIC ROUTES
// ==========================================
Route::get('/', function (Request $request) {
    return view('welcome', ['jobs' => fetchJobs($request->search)]);
});

Route::get('/jobs/{id}', function ($id) {
    initFakeDatabase();
    $jobs = session('jobs', []);
    if (!isset($jobs[$id])) abort(404);
    
    return view('show', ['job' => (object) $jobs[$id]]);
})->whereNumber('id');

// Apply for a job
Route::post('/jobs/{id}/apply', function (Request $request, $id) {
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'resume' => 'required|mimes:pdf,doc,docx|max:2048'
    ]);

    if ($request->hasFile('resume')) {
        $request->file('resume')->store('resumes', 'public');
    }

    session()->put('applied_for_job_' . $id, true);
    return back()->with('success', 'Application & Resume Submitted Successfully!');
})->whereNumber('id')->name('jobs.apply');

// Secret URL to wipe memory and reset jobs
Route::get('/reset-db', function() {
    session()->forget('jobs');
    return redirect('/')->with('success', 'Database completely reset!');
});

// ==========================================
// 3. AUTHENTICATION & GUEST ROUTES
// ==========================================
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', function (Request $request) {
    if ($request->email === 'admin@easyjob.com' && $request->password === 'password123') {
        session(['is_logged_in' => true, 'user_name' => 'Admin User', 'user_id' => 1]);
        return redirect('/dashboard');
    }
    return back()->withErrors(['email' => 'Invalid predefined credentials. Use admin@easyjob.com / password123']);
});

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', function (Request $request) {
    session(['is_logged_in' => true, 'user_name' => $request->name, 'user_id' => 1]);
    return redirect('/dashboard');
});

Route::post('/logout', function () {
    session()->forget(['is_logged_in', 'user_name', 'user_id']);
    return redirect('/');
})->name('logout');

Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    return back()->with('status', 'We have emailed your password reset link! (Note: This is a prototype simulation).');
})->name('password.email');

Route::get('/verify-email', fn() => view('auth.verify-email'))->name('verification.notice');
Route::post('/email/verification-notification', function () {
    session()->put('email_verified', true);
    return redirect('/dashboard')->with('success', 'Your email has been verified!');
})->name('verification.send');


// ==========================================
// 4. PROTECTED ROUTES (Dashboard, CRUD, Profile)
// ==========================================
class MockAuthMiddleware {
    public function handle($request, $next) {
        if (!session('is_logged_in')) {
            return redirect('/login');
        }
        return $next($request);
    }
}

Route::middleware([MockAuthMiddleware::class])->group(function () {
    
    Route::get('/dashboard', fn() => view('dashboard', ['jobs' => fetchJobs()]))->name('dashboard');

    Route::get('/jobs/create', fn() => view('jobs.create'))->name('jobs.create');
    Route::post('/jobs', function (Illuminate\Http\Request $request) {
        $jobs = session('jobs', []);
        $newId = empty($jobs) ? 1 : max(array_keys($jobs)) + 1;
        
        $logoPath = $request->hasFile('company_logo') ? $request->file('company_logo')->store('logos', 'public') : null;

        $jobs[$newId] = [
            'id' => $newId, 'title' => $request->title, 'company' => $request->company,
            'location' => $request->location, 'tags' => $request->tags, 'salary' => $request->salary ?? 'Not specified', 'description' => $request->description,
            'company_logo' => $logoPath, 'user_id' => session('user_id'), 'created_at' => \Illuminate\Support\Carbon::now()
        ];

        session(['jobs' => $jobs]);
        return redirect('/dashboard')->with('success', 'Job posted successfully!');
    })->name('jobs.store');

    Route::get('/jobs/{id}/edit', function ($id) {
        $jobs = session('jobs', []);
        if (!isset($jobs[$id])) abort(404);
        return view('jobs.edit', ['job' => (object) $jobs[$id]]);
    })->name('jobs.edit');

    Route::put('/jobs/{id}', function (Illuminate\Http\Request $request, $id) {
        $jobs = session('jobs', []);
        if (!isset($jobs[$id])) abort(404);

        // Include 'salary' in the fields we update!
        $jobs[$id] = array_merge($jobs[$id], $request->only(['title', 'company', 'location', 'tags', 'salary', 'description']));
        if ($request->hasFile('company_logo')) {
            $jobs[$id]['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        session(['jobs' => $jobs]);
        return redirect('/dashboard')->with('success', 'Job updated successfully!');
    })->name('jobs.update');

    Route::delete('/jobs/{id}', function ($id) {
        $jobs = session('jobs', []);
        if (isset($jobs[$id])) {
            unset($jobs[$id]);
            session(['jobs' => $jobs]);
        }
        return redirect('/dashboard')->with('success', 'Job deleted successfully!');
    })->name('jobs.destroy');

    Route::patch('/profile', function (Illuminate\Http\Request $request) {
        $request->validate(['name' => 'required|string|max:255', 'email' => 'required|email|max:255']);
        session()->put('user_name', $request->name);
        session()->put('user_email', $request->email);
        return back()->with('status', 'profile-updated');
    })->name('profile.update');

    Route::delete('/profile', function () {
        session()->flush();
        return redirect('/')->with('success', 'Your temporary account has been deleted.');
    })->name('profile.destroy');

    Route::put('/password', function (Illuminate\Http\Request $request) {
        $request->validate(['current_password' => 'required', 'password' => 'required|min:8|confirmed']);
        session()->put('user_password', $request->password);
        return back()->with('status', 'password-updated');
    })->name('password.update');

    Route::get('/confirm-password', fn() => view('auth.confirm-password'))->name('password.confirm');
    Route::post('/confirm-password', function (Illuminate\Http\Request $request) {
        if ($request->password === session('user_password', 'password123')) {
            session()->put('auth.password_confirmed_at', time());
            return redirect()->intended('/dashboard')->with('success', 'Password confirmed.');
        }
        return back()->withErrors(['password' => 'The password you entered is incorrect.']);
    });
});

