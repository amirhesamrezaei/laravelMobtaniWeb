<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // هر کامنت متعلق به یک پست است
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            // می‌توانیم نویسنده کامنت را هم ذخیره کنیم (اختیاری)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
