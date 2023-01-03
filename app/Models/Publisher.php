<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
    protected $table = 'publishers';
    protected $primaryKey = 'id';
    public $timestamps = false;
    //protected $dateFormat= 'h:m:s';
    // public function category(){
    //     return $this->beLongsTo(Category::class);
    // }
    // public function chapters(){
    //     return $this->hasMany(Chapter::class);
    // }
    public $fillable = ['name','link','address','outlet','description'];
}
