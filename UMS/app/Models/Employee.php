<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{  protected $table = 'employees';
    use HasFactory;

    protected $fillable=[
                            'id',
                            'rank',
                            'serno',
                            'name',
                            'dob',
                            'image',
                            'gender',
                            'squadron',
                            'position',
                            'email',
                            'address',
                            'teleno',
                            ];
}
