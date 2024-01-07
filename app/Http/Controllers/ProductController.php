<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        // $users = \App\Models\User::paginate(10);
        $products = DB::table('products')
            ->when($request->input('product_name'), function ($query, $name) {
                return $query->where('product_name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('pages.products.create');
    }

    public function store(StoreUserRequest $request)
    {
        return view('pages.products.create');
    }

    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('pages.products.edit', compact('product'));
    }

    public function update()
    {

    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product successfully deleted');
    }

}
