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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('old_id')->nullable();
            $table->integer('company_id')->nullable()->index('company_id');
            $table->string('name')->nullable()->index('name');
            $table->string('slug')->nullable();
            $table->string('username')->nullable();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('public_ip', 200)->nullable();
            $table->string('photo')->nullable();
            $table->tinyInteger('role')->default(1)->comment('1 for user, 2 for admin, 3 for NE, 4 for HR');
            $table->boolean('report_permission')->default(true);
            $table->smallInteger('status')->default(1);
            $table->rememberToken();
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
            $table->integer('modified_by_user_type')->nullable();
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
        Schema::dropIfExists('users');
    }
};
