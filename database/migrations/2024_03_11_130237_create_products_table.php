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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_description');
            $table->enum('product_instock', ['yes', 'no'])->nullable();
            $table->enum('product_delivery', ['yes', 'no'])->nullable();
            $table->enum('product_onsale', ['yes', 'no'])->nullable();
            $table->enum('product_warranty', ['yes', 'no'])->nullable();
            $table->string('product_banner');
            $table->decimal('product_original_price', 10, 2);
            $table->decimal('product_selling_price', 10, 2);
            $table->enum('product_featured', ['yes', 'no'])->nullable();
            $table->enum('product_status', ['active', 'inactive'])->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('seller_id');

            $table->foreign('seller_id')
                ->references('id')
                ->on('sellers')
                ->onDelete('cascade');;
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
               
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {        
        Schema::dropIfExists('products');
    }
};
