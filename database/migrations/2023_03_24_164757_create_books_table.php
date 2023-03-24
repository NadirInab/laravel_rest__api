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
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements("id") ;
            $table->string("title") ;
            $table->string("author") ;
            $table->integer("isbn")->unique() ;
            $table->integer("NP") ;
            $table->string("status" );
            $table->date("publish_date") ;
            $table->unsignedBigInteger("genre_id") ;
            $table->unsignedBigInteger("collection_id") ;
            $table->foreign("genre_id")->references("id")->on("genres")->onDelete("cascade");
            $table->foreign("collection_id")->references("id")->on("collections")->onDelete("cascade") ;
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
        Schema::dropIfExists('books');
    }
};
