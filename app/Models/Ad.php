<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $table = 'ads';
    protected $fillable = ['type','title','description','start_date','category_id','advertiser_id'];


    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id','id');
    }
    
    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class , 'advertiser_id','id');
    }  
    
    public function tags()
    {
        return $this->hasMany(Tag::class , 'ad_id','id');
    }

    
}