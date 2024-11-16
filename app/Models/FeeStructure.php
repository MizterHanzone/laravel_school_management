<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'class_id',
        'academic_id',
        'fee_id',
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
    ];

    public function Fee()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }

    public function Classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function AcademicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_id');
    }
}