<?php

namespace App\Http\Controllers;

use App\Models\ReceiptDetail;
use App\Models\Category;
use App\Models\Receipt;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;


class ReceiptDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receiptDetails = ReceiptDetail::with('user', 'category')
        ->orderby('name')->get();

        $data = [
            'title' => 'ReceiptDetails',
            'receiptDetails' => $receiptDetails,
        ];

        return view('receiptDetail.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderby('name')->get();
        
        $data = [
            'title' => 'Add ReceiptDetail',
            'categories' => $categories,
        ];

        return view('receiptDetail.form', compact('categories'), $data);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $data = $request->validate([
                'receipt_id' => 'required',
                'menu_id' => 'required',
                'amount' => 'required|integer',
        ]);

        try {
            $menu = Menu::find($data['menu_id']);
            $data['user_id'] = auth()->user()->id;
            $data['price'] = $menu->price;

            ReceiptDetail::create($data);

            Alert::success('Sukses', 'Add data sukses');
            
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());

        } finally{
            return redirect('receipt/'.$data['receipt_id'].'/edit');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $receiptDetail = ReceiptDetail::find($id);
        
        $data = [
            'title' => 'ReceiptDetail Detail',
            'receiptDetail' => $receiptDetail
        ];

        return view('receiptDetail.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $receiptDetail = ReceiptDetail::find($id);
        if(!$receiptDetail){
            return redirect('receiptDetail')->with("errorMessage", 'ReceiptDetail tidak dapat ditemukan');
        }

        $categories = Category::all();

        $data = [
            'title' => 'Edit ReceiptDetail',
            'receiptDetail' => $receiptDetail,
            'categories' => $categories,
        ];

        return view('receiptDetail.form', $data);
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
        ]);


        try {
            $receiptDetail = ReceiptDetail::find($id);

            $receiptDetail->update($data);

            Alert::success("Sukses", "Edit data success");
            
        } catch (\Throwable $th) {
            Alert::error("Error", $th->getMessage());
            
        } finally {
            return redirect('receiptDetail');

        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {  
        try{
            $receiptDetail = ReceiptDetail::find($id);
            // dd($receiptDetail);
            $receiptDetail->delete();
            Alert::success("Sukses", "Delete data success");
   
        } catch(\Throwable $th){
            Alert::error("Error", $th->getMessage());

        } finally{
            return redirect()->back();
        }
    }
}
