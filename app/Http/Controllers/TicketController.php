<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function myticket(Ticket $ticket)
    {
        if ($ticket->user_id != Auth::user()->id && Auth::user()->role != 'admin') {
            return response()->json(['error' => ['code' => 403, 'message' => 'Доступ запрещен']], 403);
        }
        return response()->json(['ticket' => Ticket::where('id', $ticket->id)->with('user', 'schedule.doctor.spec')->get()]);
    }

    public function mytickets(User $user)
    {
        if ($user->id != Auth::user()->id && Auth::user()->role != 'admin') {
            return response()->json(['error' => ['code' => 403, 'message' => 'Доступ запрещен']], 403);
        }

        return response()->json(['tickets' => Ticket::where('user_id', $user->id)->with('schedule.doctor.spec')->get()]);
    }

    public function cancel(Ticket $ticket)
    {
        if ($ticket->user_id != Auth::user()->id && Auth::user()->role != 'admin') {
            return response()->json(['error' => ['code' => 403, 'message' => 'Доступ запрещен']], 403);
        }

        $ticketDateTime = Carbon::parse($ticket->date . ' ' . $ticket->time);
        if ($ticketDateTime->isPast()) {
            return response()->json(['errors' => ['message' => ['Нельзя отменить прошедший приём.']]], 422);
        }

        $ticket->user_id = null;
        $ticket->save();
        return response()->json(["ticket" => $ticket]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Schedule $schedule)
    {
        return response()->json(['tickets' => Ticket::where('schedule_id', $schedule->id)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        if (Auth::user()->role == 'user' && Auth::id() != $request->user_id) {
            return response()->json(['error' => ['code' => 403, 'message' => 'Доступ запрещен']], 403);
        }

        $user = User::find($request->user_id);
        if ($user->role != 'user') {
            return response()->json(['errors' => ['user_id' => ['Записать на прием можно только пациента.']]], 422);
        }

        if ($ticket->user_id) {
            return response()->json(['errors' => ['user_id' => ['Талон занят.']]], 422);
        }

        $ticket->user_id = $request->user_id;
        $ticket->save();
        return response()->json(["ticket" => $ticket]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
