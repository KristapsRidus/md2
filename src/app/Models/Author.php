<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
	
	public function albums()
	{
		return $this->hasMany(Album::class);
	}
		
	public function zanri()
	{
		return $this->hasMany(Zanrs::class);
	}
}