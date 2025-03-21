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
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'price' => 'required|numeric',
            'image' => 'required|string'
        ]);

        $event->update($request->all());
        return $event;
    }

    // Удалить событие
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}

