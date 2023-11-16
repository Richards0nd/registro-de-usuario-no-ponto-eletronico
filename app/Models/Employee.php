<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	use HasFactory;

	protected $fillable = [
		'email',
		'phone',
		'knowledges',
		'status',
		'validated_in'
	];

	protected $dates = ['validated_in'];
}
