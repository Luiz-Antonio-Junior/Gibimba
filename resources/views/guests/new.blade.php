@extends('_template')


@section('content')
    <div class="min-w-screen min-h-screen flex items-center justify-center px-5 py-5 flex-wrap bg-gradient-to-t from-blue-200 to-indigo-900">
        <div>
            <h1 class="w-full text-5xl text-gray-100 font-bold mb-5">Cadastrar Convidado</h1>
            <form class="my-4" action="{{route('guests.store')}}" method="post">
                @csrf
                <input name="name" type="text"
                       class="rounded-l-lg rounded-r-lg p-4 border-t mr-0 border-b border-l border-r text-white border-gray-900 bg-gray-900"
                       placeholder="Nome do Convidado"/>
                <input name="last_name" type="text"
                       class="rounded-l-lg rounded-r-lg p-4 border-t mr-0 border-b border-l border-r text-white border-gray-900 bg-gray-900"
                       placeholder="Sobrenome"/>
                <button
                    class="px-8 rounded-r-lg rounded-l-lg bg-indigo-600  text-gray-100 font-bold p-4 uppercase border-indigo-600 border-t border-b border-r">
                    Registrar
                </button>
            </form>
        </div>
    </div>
@endsection
