<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')
                ->constrained('profiles')
                ->onDelete('cascade');
            $table->boolean('primary')->default(0);
            $table->string('address_1');
            $table->string('address_2');
            $table->string('state', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('city', 100);
            $table->string('country');
            $table->string('zip', 10);
            $table->softDeletes();
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
        Schema::dropIfExists('profile_shipping_addresses');
    }
}
