<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    // 1. Show the "Post a Job" form
    public function create()
    {
        return view('jobs.create');
    }

    // 2. Save the new job to the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'company' => 'required|max:255',
            'location' => 'required|max:255',
            'tags' => 'required|max:255',
            'description' => 'required',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Link the job to the currently logged-in user
        $validated['user_id'] = auth()->id();

        // Handle the image upload
        if ($request->hasFile('company_logo')) {
            $validated['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        JobListing::create($validated);

        return redirect('/dashboard')->with('success', 'Job posted successfully!');
    }

    // 3. Show the "Edit Job" form
    public function edit($id)
    {
        $job = JobListing::findOrFail($id);
        
        // Security: Prevent users from editing jobs they didn't create
        if ($job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized Action.');
        }

        return view('jobs.edit', ['job' => $job]);
    }

    // 4. Update the job in the database
    public function update(Request $request, $id)
    {
        $job = JobListing::findOrFail($id);

        if ($job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized Action.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'company' => 'required|max:255',
            'location' => 'required|max:255',
            'tags' => 'required|max:255',
            'description' => 'required',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('company_logo')) {
            // Delete the old logo if a new one is uploaded
            if ($job->company_logo) {
                Storage::disk('public')->delete($job->company_logo);
            }
            $validated['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        $job->update($validated);

        return redirect('/dashboard')->with('success', 'Job updated successfully!');
    }

    // 5. Delete the job
    public function destroy($id)
    {
        $job = JobListing::findOrFail($id);

        if ($job->user_id !== auth()->id()) {
            abort(403, 'Unauthorized Action.');
        }

        // Delete the logo file from the server to save space
        if ($job->company_logo) {
            Storage::disk('public')->delete($job->company_logo);
        }

        $job->delete();

        return redirect('/dashboard')->with('success', 'Job deleted successfully!');
    }
}


