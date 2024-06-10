<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('addusers')->onDelete('cascade');
                $table->text('address')->nullable();
                $table->text('qualifications')->nullable();
                $table->string('employee_code')->nullable();
                $table->string('academic_documents')->nullable();
                $table->string('identification_documents')->nullable();
                $table->string('offer_letter')->nullable();
                $table->string('joining_letter')->nullable();
                $table->string('contract')->nullable();
                $table->timestamps();
            });
    
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
};
