<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Получить все события
    public function index()
    {
        return Event::all();
    }

    // Создать новое событие
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'price' => 'required|numeric',
            'image' => 'required|string'
        ]);

        return Event::create($request->all());
    }

    // Обновить событие
    public function update(Request $request, Event $event)
{
    // Add detailed logging or debugging
    \Log::info('Update Request Data:', $request->all());

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'date' => 'required|date',
        'price' => 'required|numeric',
        'image' => 'required|string'
    ]);

    \Log::info('Validated Data:', $validatedData);

    $updateResult = $event->update($validatedData);
    
    \Log::info('Update Result:', ['result' => $updateResult, 'event' => $event]);

    return response()->json([
        'success' => true,
        'message' => 'Event updated successfully',
        'event' => $event
    ]);
}

    // Удалить событие
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}