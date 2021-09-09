<?php

use Illuminate\Database\Schema\Blueprint;
use App\Migration\Migration;

class MyFirstMigration extends Migration {
    public function up()
    {
        $this->schema->create('products', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->decimal('price', 8, 8);
        });
    }

    public function down()
    {
        $this->schema->drop('products');
    }
}
