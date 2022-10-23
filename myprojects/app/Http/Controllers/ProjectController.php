<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects=auth()->user()->projects;
        return view('projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
أولًا يتم التحقق من البيانات من خلال التابع validate 
بعد التحقق من البيانات وإن كانت جميعها صحيح، يتم إسنادها إلى المتغير data
بعد ذلك قمنا بإضافة معرف المستخدم user_id إلى المصفوفة data أيضًا حتى يتم تخزينه في العمود user_id
في النهاية قمنا بتمرير كل المصفوفة إلى Create ليتم حفظ البيانات في قاعدة البيانات
بعد إتمام جميع الخطوات السابقة بنجاح يتم إعادة توجيه المستخدم إلى صفحة projects
        */
        $data =request()->validate([
            'title'=>'required',
            'description'=>'required'
        ]);
        $data['user_id'] = auth()->id();
        project::create($data);
        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(project $project)
    {
       return view('projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {
        return view('projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {
        $data = request()->validate([
            'title'=>'sometimes|required',
            'description'=>'sometimes|required',
            'status' => 'sometimes|required'
        ]);

        $project->update($data);
        return redirect('/projects/' . $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(project $project)
    {
        $project->delete();
        return redirect('/projects');
    }
}
