<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\About;
use App\Models\Skills;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class HeroController extends Controller
{
    public function index()
    {
        $hero = Hero::all();
        $about = About::first();
        $skill = Skills::first();
        return view('admin.hero.index', compact('hero', 'about', 'skill'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate both image and portfolio_image
            $validated = $request->validate([
                'image' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg,gif,svg',
                    'max:2048',
                    function ($attribute, $value, $fail) {
                        try {
                            [$width, $height] = getimagesize($value);
                            if ($width < 800 || $height < 600) {
                                $fail('The ' . $attribute . ' must be at least 800x600 pixels.');
                            }
                        } catch (\Exception $e) {
                            $fail('Unable to process the image dimensions.');
                            \Log::error('Image dimension check failed: ' . $e->getMessage());
                        }
                    },
                ],
                'portfolio_image' => [
                    'nullable',
                    'image',
                    'mimes:jpeg,png,jpg,gif,svg',
                    'max:2048',
                ],
            ]);

            $data = [];

            // Save main hero image
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images', 'public');
            }

            // Save profile/portfolio image
            if ($request->hasFile('portfolio_image')) {
                $data['portfolio_image'] = $request->file('portfolio_image')->store('images', 'public');
            }

            Hero::create($data);

            return redirect()->route('hero.index')->with('success', 'Hero section created successfully.');
        } catch (ValidationException $e) {
            \Log::info('Validation failed: ' . json_encode($e->errors()));
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Hero store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to create hero section: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, Hero $hero)
    {
        try {
            // Validate both fields
            $validated = $request->validate([
                'image' => [
                    'nullable',
                    'image',
                    'mimes:jpeg,png,jpg,gif,svg',
                    'max:2048',
                    function ($attribute, $value, $fail) {
                        if ($value) {
                            try {
                                [$width, $height] = getimagesize($value);
                                if ($width < 800 || $height < 600) {
                                    $fail('The ' . $attribute . ' must be at least 800x600 pixels.');
                                }
                            } catch (\Exception $e) {
                                $fail('Unable to process the image dimensions.');
                                \Log::error('Image dimension check failed: ' . $e->getMessage());
                            }
                        }
                    },
                ],
                'portfolio_image' => [
                    'nullable',
                    'image',
                    'mimes:jpeg,png,jpg,gif,svg',
                    'max:2048',
                ],
            ]);

            $data = [];

            // Replace hero background image if provided
            if ($request->hasFile('image')) {
                if ($hero->image) {
                    Storage::disk('public')->delete($hero->image);
                }
                $data['image'] = $request->file('image')->store('images', 'public');
            }

            // Replace profile/portfolio image if provided
            if ($request->hasFile('portfolio_image')) {
                if ($hero->portfolio_image) {
                    Storage::disk('public')->delete($hero->portfolio_image);
                }
                $data['portfolio_image'] = $request->file('portfolio_image')->store('images', 'public');
            }

            $hero->update($data);

            return redirect()->route('hero.index')->with('success', 'Hero updated successfully.');
        } catch (ValidationException $e) {
            \Log::info('Validation failed: ' . json_encode($e->errors()));
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Hero update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to update hero section: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Hero $hero)
    {
        try {
            // Delete both images from storage
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }

            if ($hero->portfolio_image) {
                Storage::disk('public')->delete($hero->portfolio_image);
            }

            $hero->delete();

            return redirect()->route('hero.index')->with('success', 'Hero deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Hero delete error: ' . $e->getMessage());
            return redirect()->route('hero.index')
                ->with('error', 'Failed to delete hero: ' . $e->getMessage());
        }
    }

    public function edit(Hero $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }
}
