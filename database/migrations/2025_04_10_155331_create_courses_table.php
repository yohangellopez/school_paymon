<?php

use App\Enum\Course\CourseModalityEnum;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('cost', 8, 2);
            $table->integer('duration_hours');
            $table->string('modality')->default(CourseModalityEnum::ONLINE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
