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
                'id' => 1, 'title' => 'Cafe Barista', 'company' => 'OldTown White Coffee', 
                'location' => 'Ipoh Old Town', 'tags' => 'Full-time', 
                'description' => 'Join our flagship cafe! Responsibilities include brewing traditional coffee, handling the cashier, and serving customers with a smile.', 
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(1)
            ],
            2 => [
                'id' => 2, 'title' => 'Hotel Receptionist', 'company' => 'The Banjaran Hotsprings', 
                'location' => 'Tambun, Ipoh', 'tags' => 'Shift Work', 
                'description' => 'Welcoming guests to our luxury resort, managing bookings, and providing excellent hospitality services.', 
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(2)
            ],
            3 => [
                'id' => 3, 'title' => 'Graphic Designer', 'company' => 'Creative Ipoh Hub', 
                'location' => 'Greentown Business Centre', 'tags' => 'Hybrid', 
                'description' => 'Looking for a creative individual to design marketing materials, social media posts, and client branding.', 
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(3)
            ],
            4 => [
                'id' => 4, 'title' => 'Kindergarten Teacher', 'company' => 'Little Star Prep', 
                'location' => 'Bercham, Ipoh', 'tags' => 'Full-time', 
                'description' => 'Passionate about early childhood education? Join us to plan engaging lessons and care for children aged 4-6.', 
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(4)
            ],
            5 => [
                'id' => 5, 'title' => 'Retail Boutique Manager', 'company' => 'Ipoh Parade Fashion', 
                'location' => 'Ipoh Parade', 'tags' => 'Full-time', 
                'description' => 'Manage daily store operations, track inventory, and lead a team of retail assistants to hit sales targets.', 
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(5)
            ],
            6 => [
                'id' => 6, 'title' => 'Data Entry Clerk', 'company' => 'Kinta Tech Solutions', 
                'location' => 'Medan Istana', 'tags' => 'Part-time', 
                'description' => 'Basic computer skills required. You will be transferring physical records into our new digital database system.', 
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(6)
            ],
            7 => [
                'id' => 7, 'title' => 'Production Supervisor', 'company' => 'Perak Manufacturing Sdn Bhd', 
                'location' => 'Menglembu Industrial Area', 'tags' => 'Full-time', 
                'description' => 'Oversee the factory floor, ensure safety standards are met, and manage production schedules.', 
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(7)
            ],
            8 => [
                'id' => 8, 'title' => 'IT Support Executive', 'company' => 'Ipoh IT Services', 
                'location' => 'Station 18', 'tags' => 'Contract', 
                'description' => 'Provide hardware and software support to our corporate clients. Troubleshooting networks and setting up workstations.', 
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(8)
            ],
            9 => [
                'id' => 9, 'title' => 'Account Assistant', 'company' => 'Wong & Partners', 
                'location' => 'Jalan Sultan Idris Shah', 'tags' => 'Full-time', 
                'description' => 'Assist in preparing monthly financial reports, handling invoices, and managing basic bookkeeping tasks.', 
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(9)
            ],
            10 => [
                'id' => 10, 'title' => 'Experienced Babysitter', 'company' => 'Happy Families', 
                'location' => 'Meru Raya', 'tags' => 'Part-time', 
                'description' => 'Looking for a caring and responsible babysitter for weekend care. Must have experience with toddlers.', 
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(10)
            ],
            11 => [
                'id' => 11, 'title' => 'Software Engineer', 'company' => 'Ipoh Tech Hub', 
                'location' => 'Ipoh City Center', 'tags' => 'Full-time', 
                'description' => 'Looking for a skilled PHP/Laravel developer to join our growing tech team in Ipoh. Build amazing web applications!', 
                'company_logo' => null, 'user_id' => 1, 'created_at' => Carbon::now()->subDays(11)
            ],
            12 => [
                'id' => 12, 'title' => 'Pharmacy Assistant', 'company' => 'Klinik & Farmasi Aman', 
                'location' => 'Taiping, Perak', 'tags' => 'Shift Work', 
                'description' => 'Assist pharmacists in dispensing medication, managing inventory, and attending to walk-in customers.', 
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
            str_contains(strtolower($job['description']), $term)
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


Route::post('/jobs/{id}/apply', function (Request $request, $id) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'resume' => 'required|mimes:pdf,doc,docx|max:2048'
    ]);


    $request->file('resume')->store('resumes', 'public');
    session()->put('applied_for_job_' . $id, true);


    return back()->with('success', 'Your application and resume have been submitted successfully!');
})->whereNumber('id');


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


// Password Recovery & Email Verification
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


// A tiny inline middleware class to protect our routes
class MockAuthMiddleware {
    public function handle($request, $next) {
        if (!session('is_logged_in')) {
            return redirect('/login');
        }
        return $next($request);
    }
}


// Group all protected routes using our new inline class
Route::middleware([MockAuthMiddleware::class])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard', ['jobs' => fetchJobs()]))->name('dashboard');


    // Job Management
    Route::get('/jobs/create', fn() => view('jobs.create'))->name('jobs.create');
    Route::post('/jobs', function (Illuminate\Http\Request $request) {
        $jobs = session('jobs', []);
        $newId = empty($jobs) ? 1 : max(array_keys($jobs)) + 1;
        
        $logoPath = $request->hasFile('company_logo') ? $request->file('company_logo')->store('logos', 'public') : null;


        $jobs[$newId] = [
            'id' => $newId, 'title' => $request->title, 'company' => $request->company,
            'location' => $request->location, 'tags' => $request->tags, 'description' => $request->description,
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


        $jobs[$id] = array_merge($jobs[$id], $request->only(['title', 'company', 'location', 'tags', 'description']));
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


    // Profile & Settings
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










