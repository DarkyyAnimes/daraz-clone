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
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing primary key 'id'
            $table->string('name'); // Adds a string column for the admin's name
            $table->string('password'); // Adds a string column for the admin's password (Note: Consider using encryption for passwords)
            $table->string('email'); // Adds a string column for the admin's email
            $table->enum('role',['admin','super_admin', 'moderator']); // Adds an enumerated column for admin roles with the specified options
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns for tracking record creation and updates
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
