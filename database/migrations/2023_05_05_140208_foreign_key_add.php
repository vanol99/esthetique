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
        Schema::table('conges', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs');
        });
        Schema::table('soins', function (Blueprint $table) {
            $table->foreign('soin_type_id')->references('id')->on('soin_types');
        });
        Schema::table('commandes', function (Blueprint $table) {
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs');
        });
        Schema::table('planings', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('reservations', function (Blueprint $table) {
           // $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('soin_id')->references('id')->on('soins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
