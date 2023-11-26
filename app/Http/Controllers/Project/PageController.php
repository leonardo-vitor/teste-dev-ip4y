<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function home()
    {
        return view('home', ['registers' => []]);
    }

    public function register()
    {

    }

    public function newRegister(StoreRegisterRequest $request)
    {
        /*$validated = $request->validate([
            'name' => 'required',
            'last_name' => ['required'],
            'document' => ['required', Rule::unique('registers', 'document')],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'email' => ['required', 'email'],
            'gender' => ['required']
        ], [
            'document.required' => 'O campo CPF é obrigatório.',
            'document.unique' => 'O CPF informado já está cadastrado'
        ]);*/

        /*$validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => ['required'],
            'document' => ['required', Rule::unique('registers', 'document')],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'email' => ['required', 'email'],
            'gender' => ['required']
        ], [
            'document.required' => 'O campo CPF é obrigatório.',
            'document.unique' => 'O CPF informado já está cadastrado'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }*/

        dump($request->all());
    }
}
