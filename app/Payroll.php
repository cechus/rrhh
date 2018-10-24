<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
