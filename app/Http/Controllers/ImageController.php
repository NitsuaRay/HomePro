<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function updateImage(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('photo')->store('user_images', 'public');

        if ($oldPhoto = $request->user()->photo) {
            Storage::disk('public')->delete($oldPhoto);
        }
        auth()->user()->update([
            'photo' => $path,
        ]);
        return Redirect::route('profile.edit')->with('success', 'Profile Image updated successfully');
    }

    public function generateImage()
    {
        // Delete old photo
        if ($oldPhoto = auth()->user()->photo) {
            Storage::disk('public')->delete($oldPhoto);
        }

        // Generate new image logic (assuming it's the same as before)
        $result = OpenAI::images()->create([
            'prompt' => 'generate cute image',
            'n' => 1,
            'size' => '256x256',
        ]);

        $contents = file_get_contents($result->data[0]->url);

        $filename = Str::random(25);
        Storage::disk('public')->put("user_images/$filename.jpg", $contents);

        // Update user's photo
        auth()->user()->update(['photo' => "user_images/$filename.jpg"]);

        return redirect()->route('profile.edit')->with('success', 'Profile Image generated successfully');
    }
}
