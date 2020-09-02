<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use App\Requests;

class RequestController extends Controller
{    
    public function indexmakerequest(){
        return view('user.makerequest');
    }

    public function getAllItems(){
        $items = Items::all();
        return response()->json([
            'data' => $items
        ]);
    }

    public function insertRequestedItem(Request $request){
        if($request->ajax()){

            $item_id = $request->item;
            $quantity = $request->quantity;

            for($count = 0;  $count < count($item_id); $count++){
                $data = array(
                    'item_id' => $item_id[$count],
                    'quantity' => $quantity[$count],
                );

                $insert_data[] = $data;
            }

            Requests::insert($insert_data);
            return response()->json([
                'data' => 'There is a request from ajax'
            ]);
        }
    }
}
