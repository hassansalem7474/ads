<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    use HasFactory;

    protected $table = 'advertisers';
    protected $fillable = ['name','email','password'];

    
    public function ads()
    {
        return $this->hasMany(Ad::class , 'advertiser_id','id');
    }
}