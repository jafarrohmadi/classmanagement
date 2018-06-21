<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudetsRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'student_nis' => 'required|unique:students',
                        'name' => 'required|max:255',
                        'gender' => 'required',
                        'picture' => 'required|image',
                        'dob' => 'required',
                        'phone' => 'required|unique:students',
                        'address' => 'required|string',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'student_nis' => 'required',
                        'name' => 'required|max:255',
                        'gender' => 'required',
                        'picture'=> 'image',
                        'dob' => 'required',
                        'phone' => 'required',
                        'address' => 'required|string',
                    ];
                }
            default:break;
        }
    }

}
