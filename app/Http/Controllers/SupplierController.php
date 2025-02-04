<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:fisica,juridica',
            'cpf' => 'nullable|cpf', // validação de CPF se necessário
            'cnpj' => 'nullable|cnpj', // validação de CNPJ se necessário
            'full_name' => 'required|string|max:255',
            'fantasy_name' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'registration_code' => 'required|string|max:255',
            'state_registration' => 'nullable|string|max:255',
            'municipal_registration' => 'nullable|string|max:255',
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Fornecedor cadastrado com sucesso!');
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
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:fisica,juridica',
            'cpf' => 'nullable|cpf',
            'cnpj' => 'nullable|cnpj',
            'full_name' => 'required|string|max:255',
            'fantasy_name' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'registration_code' => 'required|string|max:255',
            'state_registration' => 'nullable|string|max:255',
            'municipal_registration' => 'nullable|string|max:255',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Supplier::destroy($id);
        return redirect()->route('suppliers.index')->with('success', 'Fornecedor excluído com sucesso!');
    }
}
