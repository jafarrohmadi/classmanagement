<?php

namespace App\Http\Controllers\User;

use Session;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;

class TeacherController extends Controller
{

    /**
     * Use to show a view of index.
     */
    public function index()
    {
       return view('user.teacher.index');
    }
    
    /**
     * Use to show a list of data in index.
     */
    public function data(Request $request)
    {
        $teacher = Teacher::select(['id','teacher_nip', 'name', 'gender', 'phone']);

        return Datatables::of($teacher)
                        ->addColumn('action', function ($data) {
                            return '<a href="teacher/' . $data->id . '/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> <button type="button" onclick="deleteItem(\'' . url("/user/teacher", ['id' => $data->id]) . '\');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
                        })
                        ->editColumn('name', function ($model) {
                            return str_limit($model->name, 50);
                        })
                        ->filter(function ($query) use ($request) {
                            if ($request->has('teacher_nip')) {
                                $query->where('teacher_nip', 'like', "%{$request->get('teacher_nip')}%");
                            }
                            if ($request->has('name')) {
                                $query->where('name', 'like', "%{$request->get('name')}%");
                            }

                        })
                        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nip= Teacher::generateTeacherNip();
        return view('user.teacher.create', compact('nip'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
      
        $request->merge(['dob' => date("Y-m-d", strtotime($request->get('dob')))]);
        $teacher = new Teacher($request->except('_method', '_token'));
        if ($request->hasFile('picture')) {
            $teacher->upload($request->file('picture'));
        }
        $teacher->save();
       
        Session::flash('flash_message', 'Teacher added!');

        return redirect('user/teacher');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);


        return view('user.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, TeacherRequest $request)
    {
        $teacher = Teacher::findOrFail($id);
        $request->merge(['dob' => date("Y-m-d", strtotime($request->get('dob')))]);
        $teacher->fill($request->except('_method', '_token'));
        if ($request->hasFile('picture')) {
            $teacher->upload($request->file('picture'));
        }
        $teacher->save();

        Session::flash('flash_message', 'Teacher updated!');

        return redirect('user/teacher');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Teacher::destroy($id);

        Session::flash('flash_message', 'Teacher deleted!');

        return redirect('user/teacher');
    }

}
