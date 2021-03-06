<?php

namespace Modules\Coodinator\Http\Controllers\Course;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Coodinator\Entities\Course;
use Modules\Lecturer\Entities\Lecturer;
use Modules\Coodinator\Entities\Programme;
use Modules\Lecturer\Entities\LecturerCourse;
use App\Http\Controllers\Coodinator\CoodinatorBaseController;


class CourseAllocationController extends CoodinatorBaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('coodinator::department.course.courseAllocation.index');
    }

    public function register(Request $request)
    {
        $request->validate(['lecturer'=>'required']);
        
        if($this->courseHasAllocation($request->all())){
            $allocation = $this->getLecturerCourse($request->all());
            if($allocation->lecturer->id != $request->lecturer){
                $allocation->update(['is_active'=>0]);
                $this->createNewAllocation($request->all());
            }else{
                session()->flash('error',['The allocation already exist please choose another lecturer for the re allocation']);
            }
        }else{
            $this->createNewAllocation($request->all());
        }

        if(!session('error')){
            session()->flash('message','The course allocation is updated successfully');
        }

        return back();
    }

    public function searchCourses(Request $request)
    {
        $request->validate(['programme'=>'required']);
        return redirect()->route('coodinator.course.allocation.view',$request->programme);
        
    }
    public function viewCourses($programmeId)
    {
        return view('coodinator::department.course.courseAllocation.register',[
            'route'=>'coodinator.course.allocation.register',
            'programme'=>Programme::find($programmeId)
        ]);
    }
    public function createNewAllocation(array $data)
    {
        LecturerCourse::create([
            'course_id'=> $data['course'],
            'lecturer_id'=>$data['lecturer'],
            'from' => time()
        ]);
    }

    public function getLecturerCourse(array $data)
    {
        return $course_lecturer = LecturerCourse::where(['course_id'=>$data['course'],'is_active'=>1])->first();
    }

    public function courseHasAllocation(array $data)
    {
        if(!Course::find($data['course'])->courseLecturer()){
            return false;
        }

        return true;
    }
    
}
