<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Receipt;
use App\Models\Menu;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receipts = Receipt::with('user')
        ->where('status', 'entry')
        ->orderby('receipt_date')
        ->get();    

        $data = [
            'title' => 'Receipts',
            'receipts' => $receipts
        ];

        return view('receipt.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Receipt',
        ];

        return view('receipt.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $insertedId = 0;

        try{
            $data['user_id'] = auth()->user()->id;
            $data['receipt_date'] = Carbon::now();

            $result = Receipt::create($data);
            $insertedId = $result->id;
            Alert::success('Sukses', 'Add data success');

        }catch (\Throwable) {
            Alert::success('Error', 'Add data gagal');
            
        } finally{
            // return redirect('receipt');
            return redirect('receipt/'.$insertedId.'/edit');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $receipt = Receipt::find($id);
        
        $data = [
            'title' => 'Receipt Detail',
            'receipt' => $receipt
        ];

        return view('receipt.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $receipt = Receipt::find($id);
        if(!$receipt){
            return redirect('receipt')->with("errorMessage", 'Receipt tidak dapat ditemukan');
        }
        
        $menus = Menu::with('user', 'category')->orderby('name')->get();

        $data = [
            "title" => "Edit Receipt",
            "receipt" => $receipt,
            "menus" =>  $menus,
        ];

        return view('receipt.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'customer_name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        try {
            $data['user_id'] = auth()->user()->id;
            $receipt = Receipt::find($id);

            $receipt->update($data);

            Alert::success('Sukses', 'Edit data success');
            
        } catch (\Throwable $th) {
            Alert::error("Error", $th->getMessage());
            
        } finally{
            return redirect('receipt');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {  
        try{
            $receipt = Receipt::find($id);

            $receipt->delete();

            Alert::success("Sukses", "Delete data success");

        } catch(\Throwable $th){
            Alert::error("Error", $th->getMessage());

        } finally{
            return redirect('receipt');
        }
    }
}
