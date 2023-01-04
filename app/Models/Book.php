<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function category(){
        return $this->beLongsTo(Category::class);
    }
    public function publisher(){
        return $this->beLongsTo(Publisher::class);
    }
    public function user(){
        return $this->beLongsTo(User::class);
    }
    public function authors(){
        return $this->hasMany(Author::class);
    }

    // public function isAuthorSelected($book_id, $author_id){
    //     BookAuthor::where('book_id', $book_id)->where('author_id',$author_id);
        
    // }
    public $fillable = ['title','slug','category_id','publisher_id','public_year','description','status','image','user_id', 'total_like', 'total_view','file'];
}
