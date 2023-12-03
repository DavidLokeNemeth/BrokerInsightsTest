<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('broker_id');
            $table->foreign('broker_id')->references('id')->on('brokers')->onDelete('cascade');
            $table->string('policy_ref');
            $table->integer('coverage_amount');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('activation_date');
            $table->date('renewal_date');
            $table->decimal('policy_cost', 10);
            $table->decimal('policy_fee', 6);
            $table->decimal('admin_fee', 6);
            $table->decimal('commission', 5, 4);
            $table->decimal('tax_fee', 6);
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->string('client_ref');
            $table->unsignedBigInteger('client_type_id');
            $table->foreign('client_type_id')->references('id')->on('client_types')->onDelete('cascade');
            $table->unsignedBigInteger('contact_type_id');
            $table->foreign('contact_type_id')->references('id')->on('contact_types')->onDelete('cascade');
            $table->unsignedBigInteger('policy_type_id');
            $table->foreign('policy_type_id')->references('id')->on('policy_types')->onDelete('cascade');
            $table->unsignedBigInteger('insurer_id');
            $table->foreign('insurer_id')->references('id')->on('insurers')->onDelete('cascade');
            $table->unsignedBigInteger('insurance_id');
            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade');
            $table->string('original_policy_ref');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policies');
    }
};
