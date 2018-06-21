<?php

namespace App\Http\Controllers\User;

use Session;
use App\Models\Students;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudetsRequest;

class StudentsController extends Controller
{

    /**
     * Use to show a view of index.
     */
    public function index()
    {
       return view('user.students.index');
    }
    /**
     * Use to show a list of data in index.
     */
    public function data(Request $request)
    {
        $students = Students::select(['id','student_nis', 'name', 'gender', 'phone']);

        return Datatables::of($students)
                        ->addColumn('action', function ($data) {
                            return '<a href="students/' . $data->id . '/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> <button type="button" onclick="deleteItem(\'' . url("/user/students", ['id' => $data->id]) . '\');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
                        })
                        ->editColumn('name', function ($model) {
                            return str_limit($model->name, 50);
                        })
                        ->filter(function ($query) use ($request) {
                            if ($request->has('students_nis')) {
                                $query->where('students_nis', 'like', "%{$request->get('students_nis')}%");
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
        $nis= Students::generateStudentNis();
        return view('user.students.create', compact('nis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudetsRequest $request)
    {
      
        $request->merge(['dob' => date("Y-m-d", strtotime($request->get('dob')))]);
        $students = new Students($request->except('_method', '_token'));
        if ($request->hasFile('picture')) {
            $students->upload($request->file('picture'));
        }
        $students->save();
        Session::flash('flash_message', 'Students added!');
        return redirect('user/students');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $students = Students::findOrFail($id);
        return view('user.students.edit', compact('students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, StudetsRequest $request)
    {
        $students = Students::findOrFail($id);
        $request->merge(['dob' => date("Y-m-d", strtotime($request->get('dob')))]);
        $students->fill($request->except('_method', '_token'));
        if ($request->hasFile('picture')) {
            $students->upload($request->file('picture'));
        }
        $students->save();
       

        Session::flash('flash_message', 'Students updated!');

        return redirect('user/students');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Students::destroy($id);
        Session::flash('flash_message', 'Students deleted!');
        return redirect('user/students');
    }

}
