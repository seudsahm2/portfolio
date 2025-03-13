<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolioItems = PortfolioItem::all();
        return view('admin.portfolio.index', compact('portfolioItems'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url',
            'category' => 'required|string|max:255',
            'details_url' => 'nullable|url',
        ]);

        PortfolioItem::create($request->all());

        return redirect()->route('portfolio.index')->with('success', 'Portfolio item created successfully.');
    }

    public function edit(PortfolioItem $portfolioItem)
    {
        return view('admin.portfolio.edit', compact('portfolioItem'));
    }

    public function update(Request $request, PortfolioItem $portfolioItem)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url',
            'category' => 'required|string|max:255',
            'details_url' => 'nullable|url',
        ]);

        $portfolioItem->update($request->all());

        return redirect()->route('portfolio.index')->with('success', 'Portfolio item updated successfully.');
    }

    public function destroy(PortfolioItem $portfolioItem)
    {
        $portfolioItem->delete();

        return redirect()->route('portfolio.index')->with('success', 'Portfolio item deleted successfully.');
    }
}