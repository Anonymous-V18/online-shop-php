<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) { $table->id(); $table->string('name'); $table->string('slug')->unique(); $table->text('description')->nullable(); $table->boolean('is_active')->default(true); $table->timestamps(); });
        Schema::create('brands', function (Blueprint $table) { $table->id(); $table->string('name'); $table->string('slug')->unique(); $table->text('description')->nullable(); $table->boolean('is_active')->default(true); $table->timestamps(); });
        Schema::create('products', function (Blueprint $table) {
            $table->id(); $table->string('name'); $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->decimal('price',12,2); $table->decimal('sale_price',12,2)->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->string('short_description',500)->nullable(); $table->longText('description')->nullable();
            $table->string('thumbnail_path')->nullable(); $table->boolean('is_active')->default(true); $table->timestamps();
        });
        Schema::create('product_images', function (Blueprint $table) { $table->id(); $table->foreignId('product_id')->constrained()->cascadeOnDelete(); $table->string('path'); $table->timestamps(); });
        Schema::create('product_reviews', function (Blueprint $table) { $table->id(); $table->foreignId('product_id')->constrained()->cascadeOnDelete(); $table->foreignId('user_id')->constrained()->cascadeOnDelete(); $table->unsignedTinyInteger('rating'); $table->text('content')->nullable(); $table->timestamps(); });
    }
    public function down(): void { Schema::dropIfExists('product_reviews'); Schema::dropIfExists('product_images'); Schema::dropIfExists('products'); Schema::dropIfExists('brands'); Schema::dropIfExists('categories'); }
};
