<?php

use App\Models\User;
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
        Schema::create('favourite_albums', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained('users');
            $table->string('album_mbid')->nullable();
            $table->string('album_name')->nullable();
            $table->string('album_url')->nullable();
            $table->string('artist_name')->nullable();
            $table->string('release_date')->nullable();
            $table->string('number_of_tracks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourite_albums');
    }
};
