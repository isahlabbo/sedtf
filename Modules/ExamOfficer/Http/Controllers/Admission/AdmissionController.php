<?php

namespace Modules\ExamOfficer\Http\Controllers\Admission;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Modules\Coodinator\Entities\Admission;
use Modules\Coodinator\Entities\Programme;
use Modules\Coodinator\Http\Requests\AdmissionFormRequest;
use App\Http\Controllers\ExamOfficer\ExamOfficerBaseController;

class AdmissionController extends ExamOfficerBaseController
{
   /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('examofficer::admission.index',['route'=>[
            'revoke'=>'exam.officer.student.admission.revoke',
            'delete'=>'exam.officer.student.admission.delete',
            'edit'=>'exam.officer.student.biodata.edit',

        ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function generateNumberIndex()
    {
        return view('examofficer::admission.create',['route'=>'exam.officer.student.admission.generate.number']);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function generateNumber(Request $request)
    {

        $request->validate([
            'programme'=>'required',
        ]);
        
        $admissionNo = Programme::find($request->programme)->generateAdmissionNo($request->schedule);

        return redirect()->route('exam.officer.student.admission.register.generated.number.index',[str_replace('/','-',$admissionNo),$request->schedule])->withSuccess($admissionNo.' Generated');
    }

    public function generatedNumberRegistration()
    {       
        return view('examofficer::.admission.register',[
            'admissionNo'=>str_replace('-','/',request()->route('admissionNo')),
            'route'=>'exam.officer.student.admission.register.generated.number'
        ]);
    }

    public function registerGeneratedNumber(AdmissionFormRequest $request)
    {
        $student = Programme::where('code',substr($request->admissionNo, 0, 3))->first()->registerNewStudent($request->all());
        return redirect()->route('exam.officer.student.view.biodata',[$student->id])->withSuccess($student->admission->admission_no.' was registered successfully for '.$student->admission->programme->name.' Batch '.$student->batch().' '.$student->admission->year);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function revokeAdmission($admission_id)
    {
        Admission::find($admission_id)->revokeThisAdmission();

        return redirect()->route('exam.officer.student.admission.index')->withSuccess('Student account revoked successfully');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($admission_id)
    {
        return view('examofficer::admission.edit',['admission'=>Admission::find($admission_id)]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $admission_id)
    {
        Admission::find($admission_id)->updateThisAdmission($request->all());

        return back()->withSuccess('Admission updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($admission_id)
    {
        
        $admission = Admission::find($admission_id);
        $admission->reservedThisAdmissionNo();
        $admission->student->studentAccount->delete();
        $admission->student->delete();
        $admission->delete();

        return redirect()->route('exam.officer.student.admission.index')->flash('message','Admission deleted successfully');
    }
}
