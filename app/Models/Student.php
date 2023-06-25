<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'last_name',
        'jenis',
        'nilai'
    ];

    public static function getListStudents() : Array {
        $students = DB::select("SELECT 
        name, 
        last_name,
        SUM(nilai) AS nilai_total
        FROM students
        GROUP BY CONCAT(name, last_name)
        ");

        return $students;
    }
}