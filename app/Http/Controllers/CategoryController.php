<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('category.index', compact('category'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        try {
             $request->validate([
                'nama_category' => 'required|string|max:255',
                'status' => 'required|string|max:255',
          
            ]);

            $data = [
           
                'nama_category' => $request->input('nama_category'),
                'status' => $request->input('status'),
                
            ];

            Category::create($data);

            return redirect('/category')->with('status', 'Data berhasil ditambah.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }


    public function edit($id)
    {
        $category = Category::where('id', $id)->get();

        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_category' => 'required|string|max:255',
                'status' => 'required|string|max:255',
          
            ]);

            $data = [
           
                'nama_category' => $request->input('nama_category'),
                'status' => $request->input('status'),
                
            ];
    
            Category::where('id', $id)->update($data);

            return redirect('/category')->with('status', 'Data berhasil diedit.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function delete($id)
    {
        Category::destroy($id);
        return back();
    }
}
