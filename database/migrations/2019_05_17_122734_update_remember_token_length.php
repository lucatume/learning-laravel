<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRememberTokenLength extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table( 'users', static function ( Blueprint $table ) {
            $table->string( 'remember_token', 200 )->change();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table( 'users', static function ( Blueprint $table ) {
            $table->string( 'remember_token', 100 )->change();
        } );
    }
}
