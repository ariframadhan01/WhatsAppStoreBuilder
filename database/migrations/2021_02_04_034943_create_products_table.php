<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'products', function (Blueprint $table){
            $table->id();
            $table->integer('store_id');
            $table->string('name');
            $table->string('product_categorie')->nullable();
            $table->float('price')->nullable();
            $table->integer('quantity')->default(0)->nullable();
            $table->string('SKU')->nullable();
            $table->string('product_tax')->nullable();
            $table->string('product_display')->default('off');
            $table->string('enable_product_variant')->default('off');
            $table->longText('variants_json')->nullable();
            $table->text('product_images')->nullable();
            $table->string('is_cover')->nullable();
            $table->longText('description')->nullable();
            $table->integer('created_by')->default(0);
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
