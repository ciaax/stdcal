<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->validate([
        //   'nilai'=> 'required|integer|max:100'
        //]);

        Student::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student->name  $first
     * @param  \App\Models\Student->last_name  $last
     * @return \Illuminate\Http\Response
     */
    public function show($first, $last)
    {

        $quiz = Student::where(["name"=>$first, "last_name"=>$last,"jenis"=>"kuis"])->first()??json_decode(json_encode(["nilai"=>0]));
        $assignment = Student::where(["name"=>$first, "last_name"=>$last, "jenis"=>"tugas"])->first()??json_decode(json_encode(["nilai"=>0]));
        $attendance = Student::where(["name"=>$first, "last_name"=>$last, "jenis"=>"absensi"])->first()??json_decode(json_encode(["nilai"=>0]));
        $practice = Student::where(["name"=>$first, "last_name"=>$last, "jenis"=>"praktek"])->first()??json_decode(json_encode(["nilai"=>0]));
        $uas = Student::where(["name"=>$first, "last_name"=>$last, "jenis"=>"uas"])->first()??json_decode(json_encode(["nilai"=>0]));
        
        $nilaiArr = [(int)$quiz->nilai, (int)$assignment->nilai, (int)$attendance->nilai, (int)$practice->nilai, (int)$uas->nilai];

        $divider =  count(array_filter($nilaiArr, function($number) {
            return $number > 0;
        }));
        

        $totalScore = array_sum($nilaiArr) / $divider;
        $grade = '';

        if ($totalScore <= 65) {
            $grade = 'D';
        } elseif ($totalScore <= 75) {
            $grade = 'C';
        } elseif ($totalScore <= 85) {
            $grade = 'B';
        } else {
            $grade = 'A';
        }
        $keys = ["Quis", "Tugas", "Absensi", "Praktik", "UAS"];
        $nilais = [];
        $grades = [];

        foreach($nilaiArr as  $idx => $number) {
            $nilais[$keys[$idx]] = $number;
            if ($number <= 65) {
                $grade = 'D';
            } elseif ($number <= 75) {
                $grade = 'C';
            } elseif ($number <= 85) {
                $grade = 'B';
            } else {
                $grade = 'A';
            }
            array_push($grades, $grade);
            
        }
        $grades = array_count_values($grades);
        // dd( $grades);
        $nilaisString = "<br/>";
        foreach($nilais as $key=>$nilai) {
            $nilaisString = $nilaisString.($key==$keys[0]?"":"<br/>").$key." = ".$nilai;
        }

       

        return view('graph', compact('totalScore', 'grade', 'grades', 'first', 'last', 'nilaiArr', 'nilaisString', 'keys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function list() : View {
        $students = Student::getListStudents();
        
        return view('display', [
            'students'  => $students
        ]);
    }
}