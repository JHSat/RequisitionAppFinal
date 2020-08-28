<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class ItemController extends Controller
{
    public function showItems(){
        // $item = Items::all();
        // if(session('success_message')){
        //     toast(session('success_message'),'success')->position('top')->width('450px');
        // }

        // $sql = "SELECT * FROM items";
        // $polist = DB::connection('mysql')->select($sql);
        // dd($polist);
        // $sql = "SELECT * FROM transaction join addeditems.transac_code = transaction.transac_code WHERE transac_id=".$id
        
        return view('admin.itemlist');
    }

    public function getItems(){
        $data = Items::all();
        return Datatables::of($data)
        ->addColumn('action', function($row){
            $btn = '<a href="javascript:void(0)" data-id="'.$row->item_id.'" class="btnViewItemDetails btn btn-info btn-sm">View</a> ';
            $btn = $btn.'<a href="javascript:void(0)" data-id="'.$row->item_id.'" class="btnEditItem text btn btn-primary btn-sm">Edit</a> ';
            $btn = $btn.'<a href="javascript:void(0)" data-id="'.$row->item_id.'" class="btnDeleteItem btn btn-danger btn-sm">Delete</a> ';
            return $btn;
        })
        ->make(true);
    }

    public function getItemDetails($id){
        $data = Items::find($id);
        return response()->json($data);
    }

    public function insertItem(Request $request){

        if($request->ajax()){
            $config = [
                'table' => 'items',
                'length' => 6,
                'prefix' => 'ITM'
            ];
    
            $item_id = IdGenerator::generate($config);
    
            $config2 = [
                'table' => 'items',
                'length' => 7,
                'prefix' => 'ITCD'
            ];
    
            $itemCode = IdGenerator::generate($config2);
    
            $item = new Item([
                'item_id' => $item_id,
                'itemCode' => $itemCode,
                'description' => $request->get('description'),
                'unit' => $request->get('unit')
            ]); 

            $item->save();
    
            return response()->json([
                'success' => $item
            ]);
        }

        //THIS IS THE PART I LEFT :(


        // $this->validate($request, [
        //     'unit' => 'required',
        //     'itemCode' => 'required',
        //     'description' => 'required'
        // ]);

        // $item = new Items([
        //     'itemCode' => $request->get('itemCode'),
        //     'description' => $request->get('description'),
        //     'unit' => $request->get('unit')
        // ]);
        

        // $item->save();
        // return redirect()->route('admin.itemlist')->withSuccessMessage('Item added successfully!');
    }
    

    public function deleteItem($id){
        $item = Items::find($id)->delete();
    
        return response()->json([
            'success' => 'Deleted!'
        ]);
    }

    public function editItem($item_id){
        $item = Items::find($item_id);
        return view('admin.edit_item')->with('item', $item);
    }

    public function updateItem(Request $request, $id){

        $this->validate($request, [
            'unit' => 'required',
            'itemCode' => 'required',
            'description' => 'required'
        ]);

        $item = Items::find($id);
        $item->unit = $request->input('unit');
        $item->itemCode = $request->input('itemCode');
        $item->description = $request->input('description');
        
        $item->save();
        return redirect()->route('admin.itemlist')->withSuccessMessage('Item updated successfully!');
    }
}
