<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
    protected $table = 'insurance_companies';

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
