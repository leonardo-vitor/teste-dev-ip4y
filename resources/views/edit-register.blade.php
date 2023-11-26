@extends('layout.app')

@section('content')
    <h1 class="mb-5 text-center">
        Editar o registro: <small class="fst-italic">{{$register->name . ' ' . $register->last_name}}</small>
    </h1>

    @php
        //    dump(old());
    @endphp

    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-6 col-xl-5 px-4 p-md-0">
            @if($message)
                <div class="alert alert-{{ $message['status'] }} alert-dismissible" role="alert">
                    <div>{{ $message['message'] }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('register.update', ['register' => $register->id]) }}" method="post" class="row">
                @csrf
                @method('PUT')

                <div class="mb-3 col-12 col-md-5 col-lg-4">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" id="name"
                           value="{{ old('name') ?? $register->name }}">

                    @error('name')
                    <div class="form-text text-danger">
                        @foreach($errors->get('name') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                    @enderror
                </div>

                <div class="mb-3 col-12 col-md-7 col-lg-8">
                    <label for="last_name" class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" name="last_name" id="last_name"
                           value="{{ old('last_name') ?? $register->last_name }}">

                    @error('last_name')
                    <div class="form-text text-danger">
                        @foreach($errors->get('last_name') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                    @enderror
                </div>

                <div class="mb-3 col-12 col-lg-6">
                    <label for="document" class="form-label">CPF</label>
                    <input type="text" class="form-control mask-cpf" name="document" id="document"
                           value="{{ old('document') ?? $register->document }}">

                    @error('document')
                    <div class="form-text text-danger">
                        @foreach($errors->get('document') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                    @enderror
                </div>

                <div class="mb-3 col-12 col-lg-6">
                    <label for="birth_date" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" name="birth_date" id="birth_date"
                           max="{{ now()->toDateString() }}"
                           value="{{ old('birth_date') ?? $register->birth_date->format('Y-m-d') }}">

                    @error('birth_date')
                    <div class="form-text text-danger">
                        @foreach($errors->get('birth_date') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                    @enderror
                </div>

                <div class="mb-3 col-12 col-md-6 col-lg-7">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email"
                           value="{{ old('email') ?? $register->email }}">

                    @error('email')
                    <div class="form-text text-danger">
                        @foreach($errors->get('email') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                    @enderror
                </div>

                @php $genderValue = old('gender') ?? $register->gender->value @endphp

                <div class="mb-4 col-12 col-md-6 col-lg-5">
                    <label for="gender" class="form-label">Gênero</label>
                    <select class="form-select" name="gender" id="gender">
                        <option value="">Selecione um gênero</option>
                        @foreach($genders as $gender)

                            @php dump($gender->value == $genderValue) @endphp

                            <option value="{{ $gender->value }}" @selected($gender->value == $genderValue)>
                                {{ $gender->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('gender')
                    <div class="form-text text-danger">
                        @foreach($errors->get('gender') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                    @enderror
                </div>

                <div class="mb-3 col-12">
                    <button type="submit" class="btn btn-primary">
                        Atualizar
                    </button>

                    <a href="{{ route('register.list') }}" class="btn btn-outline-secondary">
                        Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
