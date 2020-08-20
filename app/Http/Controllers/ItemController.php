<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;

class ItemController extends Controller
{
    public function showItems(){
        $item = Items::all();
        if(session('success_message')){
            toast(session('success_message'),'success')->position('top')->width('450px');
        }
        return view('admin.itemlist')->with('item', $item);
    }

    public function insertItem(Request $request){
        $this->validate($request, [
            'unit' => 'required',
            'itemCode' => 'required',
            'description' => 'required'
        ]);

        $item = new Items([
            'itemCode' => $request->get('itemCode'),
            'description' => $request->get('description'),
            'unit' => $request->get('unit')
        ]);
        
        $item->save();
        return redirect()->route('admin.itemlist')->withSuccessMessage('Item added successfully!');
    }
    

    public function deleteItem($item_id){
        $item = Items::find($item_id);
        $item->delete();
        return redirect()->route('admin.itemlist')->withSuccessMessage('Item deleted successfully!');
    }
}
