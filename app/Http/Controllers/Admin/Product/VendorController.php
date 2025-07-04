<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::latest()->get();
        return view('admin.products.vendors.index')->with(['vendors'=>$vendors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'validityfrom' => 'required',
            'validityto' => 'required',
        ]);

        $data = $request->all();
        Vendor::create($data); 
        return redirect()->route('admin.products.vendors.index')->with('success', 'New Vendor created successfully!');

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return view('admin.products.vendors.edit')->with(['vendor'=>$vendor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Vendor $vendor)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'validityfrom' => 'required',
            'validityto' => 'required',
        ]);
        $data = $request->all();

        $vendor->update($data);
        return redirect()->route('admin.products.vendors.index')->with('success', 'Vendor updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        
        return redirect()->route('admin.products.vendors.index')
                         ->with('success', 'Vendor deleted successfully.');
    }
    public function changeVendorStatus(Request $request)
    { 
        $vendor = Vendor::findOrFail($request->id);
        $vendor->status = $request->status;
        $vendor->save();

        return response()->json(['message' => 'Vendor status updated successfully!']);
    }
}
