<?php

namespace Modules\Coodinator\Http\Controllers\Session;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Coodinator\Entities\Session;
use App\Http\Controllers\Coodinator\CoodinatorBaseController;


class SessionController extends CoodinatorBaseController
{
    

    public function index()
    {
        return view('coodinator::include.session.index');
    }


    public function update(Request $request, $sessionId)

    {
        $request->validate([
            'name'=>'required',
            'start'=>'required',
            'end'=>'required',
        ]);

        $session = Session::find($sessionId);
        $session->update($request->all());

        return back()->withSuccess('Session updated Successfully');
    }

    public function delete($sessionId)
    {
        $session = Session::find($sessionId);

        if(count($session->admissions) == 0){
            $session->delete();
            return back()->withSuccess($session->name.' Session deleted successfully');
        }
        return back()->withWarning('We cant delete this session because student was already registered in');
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function switch(Request $request)
    {
        $request->validate(['name'=>'required']);
        
        foreach (Session::where('status', 1)->get() as $session) {
            $session->update(['status'=>0]);
        }

        $session = Session::find($request->name);
        $session->update(['status'=>1]);

        return back()->withSuccess('Session switched to '.currentSession()->name.' successfully');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        $request->validate(['name'=>'required']);
        if($this->sessionExist($request->name)){
            return back()->withWarning($request->name.' already exist');
        }

        Session::create([
            'name'=>$request->name,
            'start'=>$request->start,
            'end'=>$request->end,
            'status'=>0
        ]);
        return back()->withSuccess($request->name.' session registered successfully');
    }

    public function sessionExist($name)
    {
        $flag = false;
        foreach (Session::where('name', $name)->get() as $session) {
            $flag = true;
        }
        return $flag;
    }

    
}
