<?php

namespace App\Http\Controllers;

use App\Models\CoffeeRoom;
use App\Models\Guest;
use App\Models\GuestsCoffeeRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoffeeRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('coffee.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'capacity' => 'required|int',
        ]);

        if (CoffeeRoom::query()->first()) {
            $maxCoffeeRoom = CoffeeRoom::query()->max('capacity');
            if ($validated['capacity'] != $maxCoffeeRoom) {
                return view('fail', [
                    'message' => "A lotação das salas devem ser iguais ({$maxCoffeeRoom})"
                ]);
            }
        }

        if (CoffeeRoom::query()->count() >= 2) {
            return view('fail', [
                'message' => "São permitidas apenas 2 salas"
            ]);
        }


        $coffeeRoom = new CoffeeRoom();
        $coffeeRoom->name = $validated['name'];
        $coffeeRoom->capacity = $validated['capacity'];

        if (!$coffeeRoom->save()) {
            return view('fail', [
                'message' => 'Erro ao cadastrar'
            ]);
        }

        return view('succ', [
            'message' => 'Sala de Café Cadastrada'
        ]);
    }

    /**
     * Show the form for search a resource and search.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $coffeeRoom = CoffeeRoom::all();
        if (!empty($request->search)) {
            $searchKey = filter_var($request->search, FILTER_SANITIZE_STRING);
            $coffeeRoom = CoffeeRoom::query()
                ->where('name', 'LIKE', "%{$searchKey}%")
                ->get();
        }

        return view('coffee.search', [
            'coffeeRooms' => $coffeeRoom
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param CoffeeRoom $coffee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(CoffeeRoom $coffee)
    {
        return view('coffee.show', [
            'coffeeRoom' => $coffee
        ]);
    }

    /**
     * Insert guests to guests_event_rooms table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fill()
    {
        $guests = Guest::query();
        $coffeeRooms = CoffeeRoom::query();

        if ($guests->count() > $coffeeRooms->sum('capacity')) {
            return view('fail', [
                'message' => 'Número de Convidados Excede Capacidade Salas de Café'
            ]);
        }

        GuestsCoffeeRoom::query()->delete();

        // Stage 1
        foreach ($guests->get() as $guest) {
            $eventRoom = DB::table('coffee_rooms')
                ->select(DB::raw('coffee_rooms.*,
                (select count(id) from guests_coffee_rooms where coffee_rooms.id = guests_coffee_rooms.coffee_room) as guests'))
                ->orderBy('guests', 'asc')
                ->first();

            $guestsCoffeeRooms = new GuestsCoffeeRoom();
            $guestsCoffeeRooms->guest = $guest->id;
            $guestsCoffeeRooms->coffee_room = $eventRoom->id;

            $guestsCoffeeRooms->save();
        }

        return view('succ', [
            'message' => 'Preenchido'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CoffeeRoom $coffeRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(CoffeeRoom $coffeRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CoffeeRoom $coffeRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoffeeRoom $coffeRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CoffeeRoom $coffeRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoffeeRoom $coffeRoom)
    {
        //
    }
}
