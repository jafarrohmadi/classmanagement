<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
                        'teacher_nip' => 'required',
                        'name' => 'required|max:255|string',
                        'gender' => 'required',
                        'experience' => 'required|string',
                        'picture' => 'required|image',
                        'dob' => 'required',
                        'phone' => 'required',
                        'address' => 'required|string',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'teacher_nip' => 'required',
                        'name' => 'required|max:255',
                        'gender' => 'required',
                        'experience' => 'required|string',
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
