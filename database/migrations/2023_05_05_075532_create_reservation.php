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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date_reservation');
            $table->time('heure_reservation');
            $table->integer('type_paiement');
            $table->string('status');
            $table->double('totalht')->default(0.0);
            $table->double('total')->default(0.0);
            $table->double('totaltva')->default(0.0);
            $table->foreignId('user_id')->nullable(true)->constrained();
            $table->foreignId('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
