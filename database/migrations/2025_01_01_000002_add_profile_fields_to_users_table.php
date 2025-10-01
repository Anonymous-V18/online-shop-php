<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Thông tin profile/role
            $table->string('phone')->nullable()->after('email');
            $table->string('role')->default('user')->after('password');
            $table->string('avatar_path')->nullable()->after('role');
            $table->string('address_line')->nullable()->after('avatar_path');

            // Khóa ngoại địa chỉ (province/district/ward) — cần bảng địa chỉ tồn tại trước
            $table->foreignId('province_id')->nullable()->after('avatar_path')->constrained()->nullOnDelete();
            $table->foreignId('district_id')->nullable()->after('province_id')->constrained()->nullOnDelete();
            $table->foreignId('ward_id')->nullable()->after('district_id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('ward_id');
            $table->dropConstrainedForeignId('district_id');
            $table->dropConstrainedForeignId('province_id');
            $table->dropColumn(['phone','role','avatar_path','address_line']);
        });
    }
};
