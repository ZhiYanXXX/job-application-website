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
    Schema::table('job_listings', function (Blueprint $table) {
        // Links the job to the user. 'nullable' prevents errors with your existing dummy data.
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        $table->string('company_logo')->nullable();
    });
}

public function down()
{
    Schema::table('job_listings', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn(['user_id', 'company_logo']);
    });
}
};
