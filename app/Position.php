<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function charge()
    {
        return $this->belongsTo(Charge::class);
    }

    public function position_group()
    {
        return $this->belongsTo(PositionGroup::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
