<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('user', 'category')->orderby('name')->get();

        $data = [
            'title' => 'Menus',
            'menus' => $menus,
        ];

        return view('menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderby('name')->get();
        
        $data = [
            'title' => 'Add Menu',
            'categories' => $categories,
        ];

        return view('menu.form', compact('categories'), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'image' => 'required|mimes:jpg,png,jpeg,gif|max:1024',
        ]);

        try {
            $data['user_id'] = auth()->user()->id;

            if($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('img', 'public');
            } else {
                $data['image'] = null;
            }

            Menu::create($data);
            
            Alert::success('Sukses', 'Add data success');
            return redirect('menu');
        
        } catch (\Throwable) {
            Alert::error('Error', 'Add data gagal');
            return redirect('menu');
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::find($id);
        
        $data = [
            'title' => 'Menu Detail',
            'menu' => $menu
        ];

        return view('menu.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::find($id);
        if(!$menu){
            return redirect('menu')->with("errorMessage", 'Menu tidak dapat ditemukan');
        }

        $categories = Category::all();

        $data = [
            'title' => 'Edit Menu',
            'menu' => $menu,
            'categories' => $categories,
        ];

        return view('menu.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif|max:1024',
        ]);


        try {
            $menu = Menu::find($id);

            if($request->hasFile('image')) {
                // cek dulu jika ada gambar maka sebelum di update harus dihapus dulu
                if($menu->image){
                    Storage::delete("public" . $menu->image);
                }

                $data['image'] = $request->file('image')->store('img', 'public');
            } else {
                $data['image'] = $menu->image;
            }

            $menu->update($data);

            Alert::success("Sukses", "Edit data success");
            return redirect('menu');
        } catch (\Throwable $th) {
            Alert::error("Error", $th->getMessage());
            return redirect('menu');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {  
        try{
            $menu = Menu::find($id);

            if($menu->image){
                Storage::delete("public/" .  $menu->image);
            }

            $menu->delete();
            Alert::success("Sukses", "Delete data success");
            return redirect('menu');
   
        } catch(\Throwable $th){
            Alert::error("Error", $th->getMessage());
            return redirect('menu');
        }
    }
}
