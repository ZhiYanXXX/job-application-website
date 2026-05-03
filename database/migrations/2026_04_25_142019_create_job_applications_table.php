<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('job_applications', function (Blueprint $table) {
        $table->id();
        // This links the application to a specific job
        $table->foreignId('job_listing_id')->constrained()->onDelete('cascade'); 
        $table->string('name');
        $table->string('email');
        $table->string('resume_path'); // Stores the location of the uploaded file
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
