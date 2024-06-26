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
        Schema::create('kuesioner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('identity_id')->nullable(false);
            $table->integer('alumni_status')->nullable(false);
            $table->string('university_payment_source')->nullable();
            $table->integer('lecture_method')->nullable(false)->default(0);
            $table->integer('demo_method')->nullable(false)->default(0);
            $table->integer('project_method')->nullable(false)->default(0);
            $table->integer('internship_method')->nullable(false)->default(0);
            $table->integer('practical_method')->nullable(false)->default(0);
            $table->integer('field_method')->nullable(false)->default(0);
            $table->integer('discussion_method')->nullable(false)->default(0);

            $table->foreign('identity_id')->references('id')->on('kuesioner_identitas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuesioner');
    }
};
