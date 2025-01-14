<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Voeg verjaardag toe
            $table->date('birthday')->nullable();
            
            // Voeg profielfoto pad toe
            $table->string('profile_photo')->nullable();
            
            // Voeg bio toe
            $table->text('bio')->nullable();
            
            // Voeg admin status toe
            $table->boolean('is_admin')->default(false);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birthday');
            $table->dropColumn('profile_photo');
            $table->dropColumn('bio');
            $table->dropColumn('is_admin');
        });
    }
};