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
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // Сохраняем файл
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }
    
        Event::create([
            'name' => $request->name,
            'date' => $request->date,
            'price' => $request->price,
            'image' => $imagePath, // Сохраняем путь к файлу
        ]);
    
        return redirect()->back()->with('message', 'Событие создано успешно!');
    }

    // Обновить событие
    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'price' => 'required|numeric',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        $event->update($validatedData);
    
        return redirect()->back()->with('message', 'Событие обновлено успешно!');
    }

    // Удалить событие
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}