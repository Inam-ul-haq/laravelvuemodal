<?php



namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
class Post extends Model
{
    protected $fillable = ['title','description'];


    public function categories()
    {
      return $this->belongsToMany(Category::class);
    }  
    // 'App\Category'

}