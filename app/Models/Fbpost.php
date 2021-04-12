<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fbpost extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 's_desc', 'd_desc', 'status'
    ];
	
	
	/*function getComments()
	{
		return $this->hasMany('App\Models\Postcomments','post_id');
	}*/
}