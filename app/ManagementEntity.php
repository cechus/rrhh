<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagementEntity extends Model
{
    protected $table = 'management_entities';

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
