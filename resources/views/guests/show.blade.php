@extends('_template')


@section('content')
    <div
        class="min-w-screen min-h-screen flex items-center justify-center px-5 py-5 flex-wrap bg-gradient-to-t from-blue-200 to-indigo-900">
        <div>
            <!-- component -->
            <div class="rounded rounded-t-lg overflow-hidden shadow-lg bg-gray-900 max-w-xs my-3 p-5">
                <div class="text-center px-3 pb-6 pt-2">
                    <h1 class="text-gray-200 text-4xl bold font-sans">{{$guest->name}}  {{$guest->last_name}}</h1>
                </div>
                <div class="flex justify-center pb-3 text-white">
                    <div class="text-center mr-3 border-r pr-3">
                        <h2>Primeira Etapa:</h2>
                        <hr>
                        <span>{{(!empty($guest->eventRooms()->where('stage', 1)->first()->name)? $guest->eventRooms()->where('stage', 1)->first()->name: 'Desconhecido')}}</span>
                    </div>
                    <div class="text-center">
                        <h2>Segunda Etapa:</h2>
                        <hr>
                        <span>{{(!empty($guest->eventRooms()->where('stage', 2)->first()->name) ? $guest->eventRooms()->where('stage', 2)->first()->name : 'Desconhecido')}}</span>
                    </div>
                </div>
                <div class="text-center text-white">
                    <h2 class="">Lugar do Café</h2>
                    <p>{{(!empty($guest->coffeeRooms()->first()) ? $guest->coffeeRooms()->first()->name : 'Desconhecido')}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
