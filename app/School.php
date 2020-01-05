<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class School extends Model
{
    /**
     * @var array
     */
    protected $guarded = ["id"];

    /**
     * Retorna as classes associadas
     * @return HasMany
     */
    public function gradeClasses() {
        return $this->hasMany(GradeClass::class);
    }

    /**
     * Retorna todas as escolas
     * @return Collection
     */
    public static function allSchools() {
        return DB::table('schools')->get();
    }
}
