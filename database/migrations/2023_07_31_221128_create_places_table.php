<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('street');
            $table->string('city');
            $table->string('country');
            $table->string('postcode');
            $table->unsignedBigInteger('client_user_id');
            $table->text('description')->nullable();
            $table->json('menu')->nullable();
            $table->json('offering')->nullable();
            $table->unsignedInteger('product_limit');
            $table->string('condition')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('client_user_id')->references('id')->on('client_users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
