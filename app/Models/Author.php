<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = 'authors';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function books(){
        return $this->hasMany(Book::class);
    }
    public $fillable = ['name','link','description'];
}
