<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GradeClass extends Model
{
    protected $guarded =["id"];

    /**
     * Retorna a escola associada com a classe
     * @return BelongsTo
     *
     * */
    public function school() {
        return $this->belongsTo(School::class);
    }

    /**
     * Retorna os alunos da classe
     * @return HasMany
     */
    public function schoolMembers() {
        return $this->hasMany(SchoolMember::class);
    }

    /**
     * Retorna os testes da classe
     * @return HasMany
     */
    public function tests() {
        return $this->hasMany(Test::class);
    }
}
