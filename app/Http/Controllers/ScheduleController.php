<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Ticket;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreScheduleRequest $request)
    {
        $interval = 15;
        $arr_start_time = explode(':', $request->start_time);
        $arr_end_time = explode(':', $request->end_time);
        $start_time_min = $arr_start_time[0] * 60 + $arr_start_time[1];
        $end_time_min = $arr_end_time[0] * 60 + $arr_end_time[1];
        $time = ($end_time_min - $start_time_min);
        $tickets_num = $time / $interval;
        if ($tickets_num < 0) {
            return response()->json(["errors" => ["end_time" => ["Время конца не должно пересекаться с началом."]]]);
        } else if ($time % $interval) {
            return response()->json(["errors" => ["end_time" => ["Время должно быть четным интервалу."]]]);
        }
        
        // $schedule = Schedule::create($request->all());

        // for ($i=0; $i < $tickets_num; $i++) { 
        //     $ticket = new Ticket();
        //     $ticket->doctor_id = $request->doctor_id;
        //     $ticket->schedule_id = $schedule->id;
        //     $ticket->date = $request->date;
        //     $ticket->time = ;
        // }

        $arr = [];

        $time_ticket = $start_time_min;

        for ($i=0; $i < $tickets_num; $i++) { 
            array_push($arr, );

        }
        

        return response()->json([$arr]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
