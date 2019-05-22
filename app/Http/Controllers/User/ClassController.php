<?php

namespace App\Http\Controllers\User;

use Session;
use App\Models\Teacher;
use App\Models\Students;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;

class ClassController extends Controller
{

    /**
     * Use to show a view of index.
     */
    public function index()
    {
       return view('user.class.index');
    }

    /**
     * Use to show a list of data in index.
     */
    public function data(Request $request)
    {
        $class = Classroom::select(['id','name','room', 'teacher_id', 'date']);

        return Datatables::of($class)
                        ->addColumn('action', function ($data) {
                            return '<a href="class/' . $data->id . '/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> <button type="button" onclick="deleteItem(\'' . url("/user/class", ['id' => $data->id]) . '\');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
                        })
                        ->editColumn('name', function ($model) {
                            return str_limit($model->name, 50);
                        })
                        ->editColumn('teacher_id', function ($model) {
                            $teacher = Teacher::find($model->teacher_id);
                            return $teacher->teacher_nip.' - '.$teacher->name;
                        })
                        ->editColumn('date', function ($model) {
                            return date("m/d/Y", strtotime($model->date));
                        })
                        ->filter(function ($query) use ($request) {
                            if ($request->has('name')) {
                                $query->where('name', 'like', "%{$request->get('name')}%");
                            }
                             if ($request->has('room')) {
                                $query->where('room', 'like', "%{$request->get('room')}%");
                            }

                        })
                        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.class.create');
    }

    /**
     * Store a newly created resource .
     */
    public function store(ClassRequest $request)
    {
        $request->merge(['date' => date("Y-m-d", strtotime($request->get('date')))]);
        $class = new Classroom($request->except('_method', '_token','students'));
        $class->save();

        if($request->students){
            foreach($request->students as $id ) {
                $student = Students::findOrFail($id);
                $student->class_id = $class->id;
                $student->save();   
            }
        }

        Session::flash('flash_message', 'Classroom added!');

        return redirect('user/class');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $class = Classroom::findOrFail($id);


        return view('user.class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, ClassRequest $request)
    {
        $request->merge(['date' => date("Y-m-d", strtotime($request->get('date')))]);
        $class = Classroom::findOrFail($id);
        $class->fill($request->except('_method', '_token','students'));
        $class->save();
        
        $deleteclass = Students::where('class_id', $id)->get();
        if($deleteclass){
            $i = 1;
            foreach ($deleteclass as $delete) {
                $i++;
                $delete.$i = Students::find($delete->id);
                $delete.$i->class_id = null;
                $delete.$i->save();
            }
        }

        if($request->students){
            foreach($request->students as $addstudents ) {
                $student = Students::findOrFail($addstudents);
                $student->class_id = $id;
                $student->save();   
            }
        }
       

        Session::flash('flash_message', 'Classroom updated!');
        return redirect('user/class');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleteclass = Students::where('class_id', $id)->get();
        if($deleteclass){
            $i = 1;
            foreach ($deleteclass as $delete) {
                $i++;
                $delete.$i = Students::find($delete->id);
                $delete.$i->class_id = null;
                $delete.$i->save();
            }

        }

        Classroom::destroy($id);
        Session::flash('flash_message', 'Classroom deleted!');
        return redirect('user/class');
    }

    /**
     * Show the data of teacher.
     */
    public function getTeacher(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = Teacher::select('id','teacher_nip', 'name')
                    ->Where('name', 'like', '%' . $cari . '%')
                    ->orWhere('teacher_nip', 'like', '%' . $cari . '%')
                    ->limit(5)
                    ->get();
            return response()->json($data);
        }
    }
    
    /**
     * Show the data of students.
     */
    public function getStudent(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = Students::select('id','student_nis', 'name')
                    ->Where('name', 'like', '%' . $cari . '%')
                    ->orWhere('student_nis', 'like', '%' . $cari . '%')
                    ->where('class_id','null')
                    ->limit(5)
                    ->get();
            return response()->json($data);
        }
    }

}
