<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Subject
 * @package App
 */
class Subject extends Model
{
	public function topics() {
		return $this->hasMany(Topic::class);
	}
}
