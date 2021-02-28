<?php

namespace App\Http\Controllers;

use App\Models\EventRoom;
use App\Models\Guest;
use App\Models\GuestsEventRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventRoomController extends Controller
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
        return view('event.new');
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

        if (EventRoom::query()->first()) {
            $maxEventRoom = EventRoom::query()->max('capacity');
            if ($validated['capacity'] != $maxEventRoom) {
                return view('fail', [
                    'message' => "A lotação das salas devem ser iguais ({$maxEventRoom})"
                ]);
            }
        }

        $eventRoom = new EventRoom();
        $eventRoom->name = $validated['name'];
        $eventRoom->capacity = $validated['capacity'];

        if (!$eventRoom->save()) {
            return view('fail', [
                'message' => 'Erro ao cadastrar'
            ]);
        }

        return view('succ', [
            'message' => 'Sala de Evento Cadastrada'
        ]);
    }

    /**
     * Show the form for search a resource and search.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $eventRooms = EventRoom::all();
        if (!empty($request->search)) {
            $searchKey = filter_var($request->search, FILTER_SANITIZE_STRING);
            $eventRooms = EventRoom::query()
                ->where('name', 'LIKE', "%{$searchKey}%")
                ->get();
        }

        return view('event.search', [
            'eventRooms' => $eventRooms
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
        $eventRooms = EventRoom::query();

        if ($guests->count() > $eventRooms->sum('capacity')) {
            return view('fail', [
                'message' => 'Número de Convidados Excede Capacidade Salas de Evento'
            ]);
        }

        GuestsEventRoom::query()->delete();

        // Stage 1
        foreach ($guests->get() as $guest) {
            $eventRoom = DB::table('event_rooms')
                ->select(DB::raw('event_rooms.*,
                (select count(id) from guests_event_rooms where event_rooms.id = guests_event_rooms.event_room) as guests'))
                ->orderBy('guests', 'asc')
                ->first();

            $guestsEventRooms = new GuestsEventRoom();
            $guestsEventRooms->guest = $guest->id;
            $guestsEventRooms->event_room = $eventRoom->id;
            $guestsEventRooms->stage = 1;

            $guestsEventRooms->save();
        }

        // Stage 2
        $guestsEventRooms = GuestsEventRoom::query();
        $counter = 0;
        foreach ($guestsEventRooms->orderBy('event_room', 'ASC')->get() as $guestEvent) {
            ($counter === 0 ? $counter = 1 : $counter = 0);
            $takeNext = EventRoom::query()->where('id', '>', $guestEvent->event_room)->first();
            $takeNext = (isset($takeNext->id) ? $takeNext->id : EventRoom::query()->min('id'));

            $guestsEventRooms = new GuestsEventRoom();
            $guestsEventRooms->guest = $guestEvent->guest;
            $guestsEventRooms->event_room = ($counter ? $takeNext : $guestEvent->event_room);
            $guestsEventRooms->stage = 2;

            $guestsEventRooms->save();
        }

        return view('succ', [
            'message' => 'Preenchido'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\EventRoom $eventRoom
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(EventRoom $event)
    {
        return view('event.show', [
            'eventRoom' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EventRoom $eventRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(EventRoom $eventRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EventRoom $eventRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventRoom $eventRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EventRoom $eventRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventRoom $eventRoom)
    {
        //
    }
}
