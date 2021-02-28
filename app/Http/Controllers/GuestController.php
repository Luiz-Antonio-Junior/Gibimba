<?php

namespace App\Http\Controllers;

use App\Models\EventRoom;
use App\Models\Guest;
use App\Models\GuestsEventRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
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
        return view('guests.new');
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
            'last_name' => 'required|max:255',
        ]);

        $guest = new Guest();
        $guest->name = $validated['name'];
        $guest->last_name = $validated['last_name'];

        if (!$guest->save()) {
            return view('fail', [
                'message' => 'Erro ao cadastrar'
            ]);
        }

        return view('succ', [
            'message' => 'Convidado Cadastrado'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Guest $guest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Guest $guest)
    {
        return view('guests.show', [
            'guest' => $guest
        ]);
    }

    /**
     * Show the form for search a resource and search.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $guests = Guest::all();
        if (!empty($request->search)) {
            $searchKey = filter_var($request->search, FILTER_SANITIZE_STRING);
            $guests = Guest::query()
                ->where('name', 'LIKE', "%{$searchKey}%")
                ->orWhere('last_name', 'LIKE', "%{$searchKey}%")
                ->get();
        }

        return view('guests.search', [
            'guests' => $guests
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Guest $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Guest $guest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guest $guest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Guest $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        //
    }

    private function storeGuestsEventRoom(Guest $guest)
    {
        $eventRooms = EventRoom::all();
        if (!empty($eventRooms->first())) {
            $eventRoom = DB::table('event_rooms')
                ->select(DB::raw('event_rooms.*,
                (select count(id) from guests_event_rooms where event_rooms.id = guests_event_rooms.event_room) as guests'))
                ->orderBy('guests', 'asc')
                ->first();

            if (!($eventRoom->guests >= $eventRoom->capacity)) {

                $guestEventRoom = new GuestsEventRoom();
                $guestEventRoom->guest = $guest->id;
                $guestEventRoom->event_room = $eventRoom->id;
                $guestEventRoom->stage = 1;

                if (!$guestEventRoom->save()) {
                    return false;
                }
            } else {
                return false;
            }
        }
        return true;
    }
}
