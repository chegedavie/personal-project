<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceivedMessageRequest;
use App\Mail\NewMessage;
use App\Models\Guest;
use App\Models\ReceivedMessage;
use App\Notifications\ReceivedMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ReceivedMessageController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceivedMessageRequest $request)
    {
        $validated=$request->validated();
        $notifiable=ReceivedMessage::create($validated);

        Notification::route('mail', [$notifiable->email=>($notifiable->firstname)])
            ->notify(new ReceivedMessageNotification($notifiable));
        Mail::to('chegenganga2@gmail.com')->send(new NewMessage($notifiable));
        return $notifiable;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReceivedMessage  $receivedMessage
     * @return \Illuminate\Http\Response
     */
    public function show(ReceivedMessage $receivedMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReceivedMessage  $receivedMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceivedMessage $receivedMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReceivedMessage  $receivedMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceivedMessage $receivedMessage)
    {
        //
    }
}
