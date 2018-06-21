<?php

namespace App\Http\Controllers\User;

use PDF;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    
    /**
     * Use to show a view of index.
     */
    public function index()
    {
        return view('user.home.index');
    }

    /**
     * Use to generate a pdf file with data class, students, name.
     */
    public function generatePDF()
    {
    	$allclass = Classroom::all();
		view()->share('allclass',$allclass);
        
        $pdf = PDF::loadView('pdf.classallpdf');
        return $pdf->download('pdf.pdf');
    }

    /**
     * Use to get data class.
     */
    public function getClass(Request $request)
    {
    	if ($request->has('q')) {
            $cari = $request->q;
            $data = Classroom::join('teachers', 'class.teacher_id', '=', 'teachers.id')
                    ->select('class.id','class.name','teachers.name as nameteacher', 'from_hour', 'to_hour', 'date')
                    ->Where('class.name', 'like', '%' . $cari . '%')
                    ->orWhere('teachers.name', 'like', '%' . $cari . '%')
                    ->limit(5)
                    ->get();
            return response()->json($data);
        }

    }
}
