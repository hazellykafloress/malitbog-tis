<?php

use App\Enums\StatusEnum;
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
    Schema::create('establishments', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->string('name');
      $table->text('description');
      $table->string('address');
      $table->string('geolocation_longitude')->nullable();
      $table->string('geolocation_latitude')->nullable();
      $table->string('mode_of_access');
      $table->string('contact_number');
      $table->unsignedBigInteger('business_type_id');
      $table->string('status')->default(StatusEnum::ACTIVE->value);
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('establishments');
  }
};
