<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::with('user')->get()->map(fn($place) => [
            'id' => $place->id,
            'name' => $place->name,
            'description' => $place->description,
            'picture' => $place->picture ? asset('storage/' . $place->picture) : null,
            'user' => [
            'id' => $place->user->id,
            'name' => $place->user->name,
            ],
            'liked' => $place->likes->contains('user_id', auth()->id()),
            'totalLikes' => $place->likes->count(),

        ]);
        return Inertia::render('Places/Index',[
            'places' => $places,
            'can' => [
                'delete' => false
            ]
        ]);
    }
    public function create()
    {
        return Inertia::render('Places/Create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:755'],
            'picture' => ['required', 'image', 'max:2048'],
        ]);

        // Handle file upload
        if ($request->hasFile('picture')) {
            $filePath = $request->file('picture')->store('uploads', 'public'); // Stores the file in the 'storage/app/public/uploads' directory
            $validated['picture'] = $filePath;
        }

        // Save the data
        Place::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'picture' => $validated['picture'],
            'user_id' => Auth::user()->id,
        ]);

           return to_route('place.index');
    }
    public function show(Request $request, $id)
    {
        $place = Place::select('id','user_id', 'name', 'description', 'picture')->findOrFail($id);
        $pictureUrl = $place->picture ? asset('storage/' . $place->picture) : null;
        // dd($place);
        return Inertia::render('Places/Show',[
            'place' => $place,
            'pictureUrl' => $pictureUrl,
            'can' => [
                'delete' => Auth::user()->can('delete', $place),
                'edit' => Auth::user()->can('edit', $place)
            ]
        ]);
    }
    public function edit(Place $place)
    {

        //$place = Place::select('id','user_id', 'name', 'description', 'picture')->findOrFail($id);

        $pictureUrl = $place->picture ? asset('storage/' . $place->picture) : null;

        $safePlace = [
            'id' => $place->id,
            'user_id' => $place->user_id,
            'name' => $place->name,
            'description' => $place->description,
            'picture' => $place->picture,
        ];
        return Inertia::render('Places/Edit',[
            'place' => $safePlace,
            'pictureUrl' => $pictureUrl
        ]);
    }
    public function update(Request $request, $id)
    {
         // Fetch the place instance
        $place = Place::findOrFail($id);

        // dd($request->all());

        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:755'],
            'picture' => ['nullable','image', 'max:2048'],
        ]);

         // Handle file upload if picture is provided
            if ($request->hasFile('picture')) {
                if ($place->picture && Storage::disk('public')->exists($place->picture)) {
                    Storage::disk('public')->delete($place->picture);
                }

                // Store the new picture
                $filePath = $request->file('picture')->store('uploads', 'public');
                $validated['picture'] = $filePath;
            } else {
                // If no picture is uploaded, retain the old picture
                $validated['picture'] = $place->picture;
            }

        // Save the data
        $place->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'picture' => $validated['picture'],
            'user_id' => Auth::user()->id
        ]);

           return to_route('place.index');
    }

    public function destroy(Request $request,Place $place)
    {

        // Find the place by ID
        //$place = Place::findOrFail($id);
        // Check if there is an associated picture and delete it from storage
        if ($place->picture && Storage::disk('public')->exists($place->picture)) {
            Storage::disk('public')->delete($place->picture);
        }
        // Delete the place from the database
        $place->delete();

        return to_route('place.index');
    }

    public function toggleLike(Request $request, $id)
    {

        $user = $request->user();
        $place = Place::findOrFail($id);

        // Check if the user has already liked the place
        $like = $place->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete(); // Unlike
            // return response()->json([
            //     'liked' => false,
            //     'totalLikes' => $place->likes()->count(),
            // ]);
            return to_route('place.index');
        } else {
            $place->likes()->create(['user_id' => $user->id]); // Like
            // return response()->json([
            //     'liked' => true,
            //     'totalLikes' => $place->likes()->count(),
            // ]);
            return to_route('place.index');
        }
    }

}
