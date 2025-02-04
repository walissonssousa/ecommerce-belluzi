<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\UnitType;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Supplier;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $suppliers = Supplier::all();

        $query = Product::query();

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('brand_id') && $request->brand_id != '') {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->has('supplier_id') && $request->supplier_id != '') {
            $query->where('supplier_id', $request->supplier_id);
        }

        if ($request->has('inventory_id') && $request->inventory_id != '') {
            $inventoryCondition = $request->inventory_id;

            if ($inventoryCondition == 'positivo') {
                $query->whereHas('inventory', function ($q) {
                    $q->where('quantity', '>', 0);
                });
            } elseif ($inventoryCondition == 'negativo') {
                $query->whereHas('inventory', function ($q) {
                    $q->where('quantity', '<', 0);
                });
            } elseif ($inventoryCondition == 'acima_maximo') {
                $query->whereHas('inventory', function ($q) {
                    $q->where('quantity', '>', 'max_quantity');
                });
            } elseif ($inventoryCondition == 'abaixo_minimo') {
                $query->whereHas('inventory', function ($q) {
                    $q->where('quantity', '<', 'min_quantity');
                });
            }
        }

        if ($request->has('dt_inicio') && $request->dt_inicio != '') {
            $query->where('created_at', '>=', $request->dt_inicio);
        }

        if ($request->has('dt_fim') && $request->dt_fim != '') {
            $query->where('created_at', '<=', $request->dt_fim);
        }

        if ($request->has('image_id') && $request->image_id != '') {
            $query->whereHas('images', function ($q) use ($request) {
                $q->where('imageable_type', $request->image_id == 1 ? 'Product' : 'None');
            });
        }

        $sortBy = $request->get('sort_by', 'name');
        $sortDirection = $request->get('sort_direction', 'asc');

        $products = $query->with(['category', 'brand', 'supplier', 'variations', 'images', 'inventory'])
            ->orderBy($sortBy, $sortDirection)
            ->paginate(15);

        if ($request->ajax()) {
            return response()->json([
                'draw' => $request->get('draw'),
                'recordsTotal' => $products->total(),
                'recordsFiltered' => $products->total(),
                'data' => $products->items()
            ]);
        }

        return view('products.index', compact('products', 'categories', 'brands', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $suppliers = Supplier::all();
        $productVariations = ProductVariation::all();
        $unitType = UnitType::all();

        return view('products.create', compact(
          'categories', 
         'brands', 
                    'suppliers',
                    'productVariations',
                    'unitType'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
