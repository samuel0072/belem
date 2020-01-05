<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Topic extends Model
{
    protected $guarded = ["id"];

    /**
     * Retorna as questoes associadas
     * @return HasMany
     */
    public function questions() {
        return $this->hasMany(Question::class);
    }

    /**
     * Retorn os ids de todos os topics
     * @return array
     */
    public static function allTopics(){
        return [DB::table('topics')->value('id')];
    }
}
