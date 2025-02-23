<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model{
    use HasFactory;

    protected $table = 'employees'; // Table Name
    protected $primaryKey = 'employee_id'; // Primary Key

    protected $fillable = [
        'employee_fname',
        'employee_lname',
    ];
}