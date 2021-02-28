@extends('_template')


@section('content')
    <div class="min-w-screen min-h-screen flex items-center justify-center px-5 py-5 flex-wrap bg-gradient-to-t from-blue-200 to-indigo-900">

        <!-- component -->
        <style>
            .top-100 {
                top: 100%
            }

            .bottom-100 {
                bottom: 100%
            }

            .max-h-select {
                max-height: 300px;
            }
        </style>
        <div class="flex flex-col items-center w-full">
            <div class="w-full md:w-1/2 flex flex-col items-center h-64">
                <div class="w-full px-4">
                    <div class="flex flex-col items-center relative">
                        <div class="w-full">
                            <h1 class="w-full text-5xl text-gray-100 font-bold mb-5">Pesquisar Sala de Café</h1>
                            <div>
                                <form class="my-2 p-1 bg-gray-900 flex border border-gray-900 rounded" method="get" action="{{route('coffee.search')}}">
                                    <input name="search" placeholder="Pesquisar Sala de Café"
                                           class="p-1 px-2 appearance-none outline-none w-full text-gray-300 bg-gray-900">
                                    <div
                                        class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200">
                                        <button type="submit"
                                                class="cursor-pointer w-6 h-6 text-gray-300 outline-none focus:outline-none">
                                            Ir
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div
                            class="absolute shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
                            <div class="flex flex-col w-full">
                                @foreach($coffeeRooms as $coffeeRoom)
                                    <a href="{{route('coffee.show', $coffeeRoom->id)}}"
                                        class="cursor-pointer w-full border-gray-900 bg-gray-900  border-b hover:bg-gray-800">
                                        <div
                                            class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                            <div class="w-6 flex flex-col items-center">
                                            </div>
                                            <div class="w-full items-center flex">
                                                <div class="mx-2 -mt-1 text-gray-300 ">{{$coffeeRoom->name}} ___ {{$coffeeRoom->capacity}}</div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
