@extends('_template')

@section('content')
    <!-- component -->
    <main class="grid place-items-center min-h-screen bg-gradient-to-t from-blue-200 to-indigo-900 p-5">
        <div>

            <div class="mb-5 pb-5">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-200 mb-5">Convidado</h1>
                <section class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="{{route('guests.create')}}"
                       class="bg-gray-900 hover:bg-gray-800 transition delay-50 duration-200 ease-in-out shadow-lg rounded p-3">
                        <div class="p-5">
                            <h3 class="text-white text-lg">Novo</h3>
                            <p class="text-gray-400">Cadastrar novo convidado</p>
                        </div>
                    </a>
                    <a href="{{route('guests.search')}}"
                       class="bg-gray-900 hover:bg-gray-800 transition delay-50 duration-200 ease-in-out shadow-lg rounded p-3">

                        <div class="p-5">
                            <h3 class="text-white text-lg">Pesquisar</h3>
                            <p class="text-gray-400">Pesquisar convidado cadastrado</p>
                        </div>
                    </a>
                </section>
            </div>

            <div class="mt-5 pt-5">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-200 mb-5">Salas de Evento</h1>
                <section class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <a href="{{route('event.create')}}"
                       class="bg-gray-900 hover:bg-gray-800 transition delay-50 duration-200 ease-in-out shadow-lg rounded p-3">
                        <div class="p-5">
                            <h3 class="text-white text-lg">Nova</h3>
                            <p class="text-gray-400">Cadastrar nova sala de evento</p>
                        </div>
                    </a>
                    <a href="{{route('event.search')}}"
                       class="bg-gray-900 hover:bg-gray-800 transition delay-50 duration-200 ease-in-out shadow-lg rounded p-3">

                        <div class="p-5">
                            <h3 class="text-white text-lg">Pesquisar</h3>
                            <p class="text-gray-400">Pesquisar sala de evento</p>
                        </div>
                    </a>
                    <a href="{{route('event.fill')}}"
                       class="bg-gray-900 hover:bg-gray-800 transition delay-50 duration-200 ease-in-out shadow-lg rounded p-3">

                        <div class="p-5">
                            <h3 class="text-white text-lg">Preencher</h3>
                            <p class="text-gray-400">Preencher salas de eventos</p>
                        </div>
                    </a>
                </section>
            </div>

            <div class="mt-5 pt-5">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-200 mb-5">Salas de Café</h1>
                <section class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <a href="{{route('coffee.create')}}"
                       class="bg-gray-900 hover:bg-gray-800 transition delay-50 duration-200 ease-in-out shadow-lg rounded p-3">
                        <div class="p-5">
                            <h3 class="text-white text-lg">Nova</h3>
                            <p class="text-gray-400">Cadastrar nova sala de café</p>
                        </div>
                    </a>
                    <a href="{{route('coffee.search')}}"
                       class="bg-gray-900 hover:bg-gray-800 transition delay-50 duration-200 ease-in-out shadow-lg rounded p-3">

                        <div class="p-5">
                            <h3 class="text-white text-lg">Pesquisar</h3>
                            <p class="text-gray-400">Pesquisar sala de café</p>
                        </div>
                    </a>
                    <a href="{{route('coffee.fill')}}"
                       class="bg-gray-900 hover:bg-gray-800 transition delay-50 duration-200 ease-in-out shadow-lg rounded p-3">

                        <div class="p-5">
                            <h3 class="text-white text-lg">Preencher</h3>
                            <p class="text-gray-400">Preencher salas de café</p>
                        </div>
                    </a>
                </section>
            </div>

        </div>
    </main>
@endsection
