<?php

namespace Modules\ExamOfficer\Http\Controllers\Graduation;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Coodinator\Entities\Session;
use Modules\Coodinator\Entities\Programme;
use App\Http\Controllers\ExamOfficer\ExamOfficerBaseController;

class GraduationController extends ExamOfficerBaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function graduationIndex()
    {
        return view('examofficer::graduation.index',['message'=>'Search Graduated Students','department'=>examOfficer()->department,'route'=>'exam.officer.graduation.search.graduates']);
    }

    public function spillOverIndex()
    {
        return view('examofficer::graduation.index',['message'=>'Search Spill Over Students','department'=>examOfficer()->department,'route'=>'exam.officer.graduation.search.spills']);
    }

    public function withDrawIndex()
    {
        return view('examofficer::graduation.index',['message'=>'Search With Draw Students','department'=>examOfficer()->department,'route'=>'exam.officer.graduation.search.withdraws']);
    }

    
    public function searchGraduateStudents(Request $request)
    {
        $request->validate(['session'=>'required']);
        $session = Session::find($request->session);
        return view('examofficer::graduation.graduates',['programme'=>Programme::find($request->programme),'session'=>$session,'students'=>$session->graduatedStudents(Programme::find($request->programme))]);
    }

    public function searchSpillingStudents(Request $request)
    {
        $request->validate(['session'=>'required']);
        $session = Session::find($request->session);
        return view('examofficer::graduation.spilled',['programme'=>Programme::find($request->programme),'session'=>$session,'students'=>$session->spilledStudents(Programme::find($request->programme))]);
    }

    public function searchWithDrawedStudents(Request $request)
    {
        $request->validate(['session'=>'required']);
        $session = Session::find($request->session);
        return view('examofficer::graduation.withDrawed',['session'=>$session,'students'=>$session->withDrawStudents()]);
    }

}
