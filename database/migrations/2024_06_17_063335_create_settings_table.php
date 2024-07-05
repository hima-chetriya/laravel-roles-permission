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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("footer_title1_en");
            $table->string("footer_title1_fr");

            $table->string("footer_title2_en");
            $table->string("footer_title2_fr");

            $table->string("footer_address_en");
            $table->string("footer_address_fr");

            $table->text("footer_content_en");
            $table->text("footer_content_fr");

            $table->string("footer_number1");
            $table->string("footer_number2");

            $table->string("footer_link1");
            $table->string("footer_link2");

            $table->string("header_logo");
            $table->string("footer_logo");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
