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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->index();
            $table->longText('description')->nullable();
            $table->tinyInteger('is_special')->default(0)->index();
            $table->tinyInteger('is_urgent')->default(0)->index();
            $table->decimal('budget',15);
            $table->string('organizer_name',50);
            $table->string('organizer_position',50);
            $table->string('organizer_company_name',100);
            $table->tinyInteger('status')->default(1)->index();
            $table->foreignId('project_type_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
