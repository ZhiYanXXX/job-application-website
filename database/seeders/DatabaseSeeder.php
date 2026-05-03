<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobListing;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        JobListing::create([
            'title' => 'Experienced Babysitter',
            'company' => 'Happy Families Care',
            'location' => 'Kuala Lumpur',
            'tags' => 'Part-time',
            'description' => 'Looking for a caring and responsible babysitter to look after two toddlers. Must have experience with kids and basic first aid knowledge.'
        ]);

        JobListing::create([
            'title' => 'Starbucks Barista',
            'company' => 'Starbucks',
            'location' => 'Cheras',
            'tags' => 'Full-time',
            'description' => 'Join our fast-paced coffee shop! You will be brewing coffee, managing the cash register, and providing excellent customer service. No prior experience required, training provided.'
        ]);

        JobListing::create([
            'title' => 'Mathematics Tutor',
            'company' => 'EduCenter Academy',
            'location' => 'Remote',
            'tags' => 'Contract',
            'description' => 'We need an energetic tutor to teach high school mathematics online. Must be familiar with the syllabus and have a stable internet connection.'
        ]);
    }
}


