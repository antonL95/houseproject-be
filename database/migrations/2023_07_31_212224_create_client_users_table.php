<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('var_number')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('postcode')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('apple_id')->nullable();
            $table->string('profile_image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('client_user_password_reset_tokens', static function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::table('users', static function (Blueprint $table) {
            $table->dropColumn(['name']);
            $table->string('first_name')->nullable()->after('email');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone')->nullable()->after('last_name');
            $table->string('prefered_city')->nullable()->after('phone');
            $table->string('password')->nullable()->change();
            $table->string('google_id')->nullable()->after('password');
            $table->string('facebook_id')->nullable()->after('google_id');
            $table->string('apple_id')->nullable()->after('facebook_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_users');
        Schema::dropIfExists('client_user_password_reset_tokens');

        Schema::table('users', static function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $table->dropColumn([
                'name',
                'first_name',
                'last_name',
                'phone',
                'prefered_city',
                'password',
                'google_id',
                'facebook_id',
                'apple_id',
            ]);
        });
    }
};
