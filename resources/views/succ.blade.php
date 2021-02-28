@extends('_template')


@section('content')
    <!-- component -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

    <div class="min-w-screen min-h-screen bg-green-500 flex items-center justify-center px-5 py-5">
        <div class="w-full mx-auto rounded-3xl shadow-lg bg-white px-10 pt-16 pb-10 text-gray-600"
             style="max-width: 350px" x-data="app()">
            <div class="flex flex-wrap justify-center">
                <h1 class="text-center text-4xl mb-8">{{$message? $message : 'Erro'}}</h1>
                <a href="{{url()->previous()}}"
                   class="w-full px-8 rounded-r-lg rounded-l-lg bg-green-400 text-white text-center font-bold p-4 uppercase border-green-500 border-t border-b border-r">
                    Voltar
                </a>
            </div>
        </div>
    </div>

@endsection
