<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the search keyword from the request
        $keyword = $request->input('keyword');

        // Start the query for products
        $query = Brand::query();

        // If a keyword is provided, apply the search conditions
        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        // Paginate the results
        $brands = $query->orderBy('name', 'asc')->paginate(10);

        // Return the paginated products as JSON
        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ], [
            'name.required' => 'Brand name must be filled.',
        ]);

        Brand::create($request->all());
        return response()->json([
            'message' => 'Brand successfully added', 
            'data' => [
                'name' => $request->name
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ], [
            'name.required' => 'Brand name must be filled.',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update($request->all());
        return response()->json(['message' => 'Brand successfully updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return response()->json(['message' => 'Brand successfully deleted'], 200);
    }
}

