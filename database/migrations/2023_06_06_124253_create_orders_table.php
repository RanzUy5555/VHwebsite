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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_variety_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('qty');
            $table->foreignId('payment_method_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('transaction_no');
            $table->string('reference_no')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('municipality_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('contact')->nullable();
            $table->string('note')->nullable();
            $table->integer('status')->default(0);
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('orders');
    }
};