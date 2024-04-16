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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('store_email')->unique();
            $table->string('store_phone_no')->nullable();            
            $table->string('store_address')->nullable();            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');     
            $table->enum('isfeatured', ['yes', 'no']);       
            $table->string('store_image_path')->nullable();                        
            $table->string('store_logo')->nullable();                        
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
