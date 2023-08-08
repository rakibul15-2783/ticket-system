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
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subscribed_companies_id')->nullable();
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_logo')->nullable();
            $table->string('header_logo', 100)->nullable();
            $table->string('company_address');
            $table->string('company_phone');
            $table->string('company_timezone');
            $table->integer('status');
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
        Schema::dropIfExists('companies');
    }
};
