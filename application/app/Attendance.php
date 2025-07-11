<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
}

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance'; // or 'attendances' if that's your table name

    protected $fillable = [
        'idno',
        'reference',
        'date',
        'employee',
        'timein',
        'timeout',
        'totalhours',
        'comment',
        'status_timein',
        'status_timeout',
    ];
}