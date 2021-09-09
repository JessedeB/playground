<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
use App\Migration\Migration;

class thisIsATestingMigration extends Migration {
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->decimal('price', 8, 8);
        });
    }

    public function down()
    {

    }
}
