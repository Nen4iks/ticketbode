<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

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

    // Получить одно событие по ID
    public function show(Event $event)
    {
        return $event;
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

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Event updated successfully'
        ]);
    }

    // Удалить событие
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}