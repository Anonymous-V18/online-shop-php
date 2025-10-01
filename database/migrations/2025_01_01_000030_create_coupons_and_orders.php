<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id(); $table->string('code')->unique(); $table->enum('discount_type',['percent','fixed']); $table->decimal('value',12,2);
            $table->unsignedInteger('max_uses')->nullable(); $table->unsignedInteger('used_count')->default(0);
            $table->decimal('min_order_value',12,2)->nullable(); $table->timestamp('starts_at')->nullable(); $table->timestamp('ends_at')->nullable();
            $table->boolean('is_active')->default(true); $table->timestamps();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); $table->foreignId('user_id')->constrained()->cascadeOnDelete(); $table->string('code')->unique();
            $table->enum('status',['pending','confirmed','processing','shipped','delivered','cancelled'])->default('pending');
            $table->decimal('subtotal',12,2); $table->decimal('discount_total',12,2)->default(0); $table->decimal('grand_total',12,2);
            $table->string('coupon_code')->nullable();
            $table->string('receiver_name'); $table->string('receiver_phone');
            $table->foreignId('province_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('district_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('ward_id')->nullable()->constrained()->nullOnDelete();
            $table->string('address_line');
            $table->string('payment_method'); $table->timestamp('paid_at')->nullable(); $table->timestamps();
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); $table->foreignId('order_id')->constrained()->cascadeOnDelete(); $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name'); $table->decimal('price',12,2); $table->unsignedInteger('qty'); $table->decimal('total',12,2); $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('order_items'); Schema::dropIfExists('orders'); Schema::dropIfExists('coupons'); }
};
