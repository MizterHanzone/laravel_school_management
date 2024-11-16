<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'status',
    ];
    public function assignSubjects()
    {
        return $this->hasMany(AssignSubjectToClass::class);
    }
}
