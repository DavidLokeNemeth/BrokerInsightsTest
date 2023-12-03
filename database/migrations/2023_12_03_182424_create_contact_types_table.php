<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_types', function (Blueprint $table) {
            $table->id();
            $table->string('contact_type_name');
        });

        DB::table('contact_types')->insert(
            array(
                [
                    'contact_type_name' => 'New Policy',
                ],
                [
                    'contact_type_name' => 'Policy Renewal',
                ],
                [
                    'contact_type_name' => 'Policy Update',
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_types');
    }
};
