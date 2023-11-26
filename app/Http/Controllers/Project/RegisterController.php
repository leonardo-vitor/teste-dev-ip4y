<?php

namespace App\Http\Controllers\Project;

use App\Enums\RegisterGender;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('home', [
            'registers' => Register::query()->paginate(5),
            'message' => $request->session()->get('register')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('register', [
            'message' => $request->session()->get('register'),
            'genders' => RegisterGender::cases()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegisterRequest $request)
    {
        $register = new Register();
        $register->document = $request->document;
        $register->name = $request->name;
        $register->last_name = $request->last_name;
        $register->birth_date = $request->birth_date;
        $register->email = $request->email;
        $register->gender = $request->gender;

        if (!$register->save()) {
            $request->session()->flash('register', ['status' => 'warning', 'message' => 'Não foi possível finalizar sua requisição.']);
            return back()->withInput();
        }

        $request->session()->flash('register', ['status' => 'success', 'message' => 'Cadastro realizado com sucesso']);
        return redirect()->route('register.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $registerId)
    {
        $register = Register::query()->find($registerId);

        if (!$register) {
            $request->session()->flash('register', ['status' => 'danger', 'message' => 'Não foi possível encontrar o registro selecionado.']);
            return redirect()->route('register.list');
        }

        return view('edit-register', [
            'message' => $request->session()->get('register'),
            'register' => $register,
            'genders' => RegisterGender::cases()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRegisterRequest $request, int $registerId)
    {
        $register = Register::query()->find($registerId);

        if (!$register) {
            $request->session()->flash('register', ['status' => 'danger', 'message' => 'Não foi possível encontrar o registro selecionado.']);
            return redirect()->route('register.list');
        }

        $register->document = $request->document;
        $register->name = $request->name;
        $register->last_name = $request->last_name;
        $register->birth_date = $request->birth_date;
        $register->email = $request->email;
        $register->gender = $request->gender;

        if (!$register->save()) {
            $request->session()->flash('register', ['status' => 'warning', 'message' => 'Não foi possível atualizar os dados.']);
            return back()->withInput();
        }

        $request->session()->flash('register', ['status' => 'success', 'message' => 'Dados atualizados com sucesso.']);
        return redirect()->route('register.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $registerId)
    {
        $register = Register::query()->find($registerId);

        if (!$register) {
            $request->session()->flash('register', ['status' => 'danger', 'message' => 'Não foi possível encontrar o registro selecionado.']);
            return redirect()->route('register.list');
        }

        if (!Register::destroy($registerId)) {
            $request->session()->flash('register', ['status' => 'danger', 'message' => 'Não foi possível excluir o registro selecionado.']);
            return redirect()->route('register.list');
        }

        $request->session()->flash('register', ['status' => 'success', 'message' => 'Registro excluído com sucesso.']);
        return redirect()->route('register.list');
    }

    public function sendData(Request $request, ?int $registerId = null)
    {
        $columns = ['document', 'name', 'last_name', 'birth_date', 'email', 'gender'];

        if ($registerId) {
            $registers = Register::query()->find($registerId, $columns);
        } else {
            $registers = Register::all($columns);
        }

        if (!$registers) {
            $request->session()->flash('register', ['status' => 'danger', 'message' => 'Não foi possível encontrar o(s) registro(s) selecionado(s).']);
            return redirect()->route('register.list');
        }

        $apiURL = 'https://api-teste.ip4y.com.br/cadastro';
        $postData = $registers->toJson();

        $response = Http::withHeaders(['Accept' => 'application/json'])->post($apiURL, $postData);

        if ($response->status() != 200) {
            $request->session()->flash('register', ['status' => 'warning', 'message' => 'Não foi possível enviar os dados do(s) registro(s) selecionado(s).']);
            return redirect()->route('register.list');
        }

        $request->session()->flash('register', ['status' => 'success', 'message' => 'Os dados do(s) registro(s) selecionado(s) foram enviados com sucesso.']);
        return redirect()->route('register.list');
    }
}
