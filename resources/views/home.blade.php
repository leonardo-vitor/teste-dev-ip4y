@extends('layout.app')

@section('content')
    <h1 class="mb-5">Registros cadastrados</h1>

    @if($message)
        <div class="alert alert-{{ $message['status'] }} alert-dismissible" role="alert">
            <div>{{ $message['message'] }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($registers->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>E-mail</th>
                    <th>Gênero</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($registers as $register)
                    <tr>
                        <td>{{ $register->document }}</td>
                        <td>{{ $register->name. ' ' . $register->last_name }}</td>
                        <td>{{ $register->birth_date->format('d/m/Y') }}</td>
                        <td>{{ $register->email }}</td>
                        <td>{{ $register->gender->name }}</td>
                        <td>
                            <a href="{{ route('register.edit', ['register' => $register->id]) }}"
                               class="btn btn-info btn-sm">Editar</a>

                            <form action="{{ route('register.destroy', ['register' => $register->id]) }}" method="post"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>

                            <a href="{{ route('register.send', ['register' => $register->id]) }}"
                               class="btn btn-outline-secondary btn-sm">Enviar dados</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $registers->links() }}
    @else
        <div class="alert alert-info" role="alert">
            Não há registros cadastrados no sistema.
        </div>
    @endif
@endsection
