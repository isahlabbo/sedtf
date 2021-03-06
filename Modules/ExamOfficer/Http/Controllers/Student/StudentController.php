<?php

namespace Modules\ExamOfficer\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Student\Entities\Student;
use App\Http\Controllers\ExamOfficer\ExamOfficerBaseController;


class StudentController extends ExamOfficerBaseController
{
    public function viewBiodata($studentID)
    {
        return view('examofficer::student.biodata',['student'=>Student::find($studentID)]);
    }

    public function editBiodata($studentID)
    {
        return view('examofficer::student.edit',[
            'student'=>Student::find($studentID)
        ]);
    }

    public function updateBiodata(Request $request)
    {
        $admission = Admission::find($request->admission_id)->updateThisAdmission($request->all());
        return back();
    }

    public function student()
    {
        return view('examofficer::student.index',['route'=>'exam.officer.student.student.search']);
    }

    public function searchStudent(Request $request)
    {
        $students = null;
        if($request->admission_no){
            $students = [$this->getThisStudent($request->admission_no)];
            if(empty($students)){
                session()->flash('error','Invalid admission number');
                return back();
            }
        }else{
            $request->validate(['session'=>'required','state'=>'required']);
            $state = State::find($request->state);
            $session = Session::find($request->session);
            if($state){
                $students = $state->students($session);
            }else{
                $students = [];
                foreach(State::all() as $state){
                    if($state->catchment == 0){
                        $students = array_merge($students,$state->students($session));
                    }
                }
            }
        }
        
        session(['students'=>$students]);
        return redirect()->route('exam.officer.student.student.available',[
            'state'=>strtolower(str_replace(' ','-',$state->name ?? 'state')),'session'=>strtolower(str_replace('/','-',$session->name ?? currentSession()->name))]);
    }
    public function getThisStudent($admission_no)
    {
        $student = null;
        foreach(Admission::where('admission_no',$admission_no)->get() as $admission){
            $student = $admission->student;
        }
        return $student;
    }
    public function availableStudent()
    {
        session()->flash('message',count(session('students')).' students foud from the search');
        return view('coodinator::student.student',['students'=>session('students')]);
        
    }
}
