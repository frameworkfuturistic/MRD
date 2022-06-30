<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpdPrescription extends Model
{
    use HasFactory;

    protected $primaryKey = 'RegistrationID';
    protected $fillable=[
        'RegistrationID',
        'Complaints',
        'Examinations',
        'Investigations',
        'Diagnosis',
        'Medicines',
        'Others',
        'History'
    ];
    public $timestamps = false;
}
