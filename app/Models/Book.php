<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        "title", 
        "author", 
        "isbn", 
        "NP", 
        "status",
        "publish_date", 
        "genre_id", 
        "collection_id"
    ] ;

    public function collection(){
        return $this->belongsTo(Collection::class) ;
    } 

    public function genre(){
        return $this->belongsTo(Genre::class) ;
    }

}
