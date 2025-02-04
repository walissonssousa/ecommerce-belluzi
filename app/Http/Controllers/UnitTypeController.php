<?php

namespace App\Http\Controllers;

use App\Models\UnitType;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $unitTypes = UnitType::query()
            ->when($request->input('name'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->input('name') . '%');
            })
            ->paginate(10);

        return view('products.unitTypes.index', compact('unitTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        UnitType::create($validated);

        return redirect()->route('unit-types.index')->with('success', 'Tipo de unidade criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitType $unitType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $unitType->update($validated);

        return redirect()->route('unit-types.index')->with('success', 'Tipo de unidade atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitType $unitType)
    {
        $unitType->delete();

        return redirect()->route('unit-types.index')->with('success', 'Tipo de unidade excluído com sucesso!');
    }
}
