<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use App\Requests;
use App\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;


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

    public function insertRequest(Request $request){
        if($request->ajax()){
            $con1 = [
                'table' => 'requests',
                'length' => 8,
                'field' => 'req_id',
                'prefix' => 'REQ'
            ];
            $con2 = [
                'table' => 'requests',
                'length' => 8,
                'field' => 'transac_code',
                'prefix' => 'TN'
            ];

            $req_id = IdGenerator::generate($con1);
            $transac_code = IdGenerator::generate($con2);
            $requestee = $request->requestee;
            $date = date('Y-m-d');
            $status = 'O';

            $req = new Requests([
                'req_id' => $req_id,
                'transac_code' => $transac_code,
                'requestee' => $requestee,
                'processed_date' => $date,
                'status' => $status
            ]);

            if($req->save()){

                $item_id = $request->item;
                $quantity = $request->quantity;
                
                for($count = 0;  $count < count($item_id); $count++){
                    $data = array(
                        'item_id' => $item_id[$count],
                        'transac_code' => $transac_code,
                        'quantity' => $quantity[$count],
                    );
                    $insert_data[] = $data;
                }

                Storage::insert($insert_data);
                return response()->json([
                    'data' => 'success'
                ]);
            }
        }
    }

    // public function insertRequestedItem(Request $request){
    //     if($request->ajax()){

    //         $item_id = $request->item;
    //         $quantity = $request->quantity;

    //         for($count = 0;  $count < count($item_id); $count++){
    //             $data = array(
    //                 'item_id' => $item_id[$count],
    //                 'quantity' => $quantity[$count],
    //             );

    //             $insert_data[] = $data;
    //         }

    //         Requests::insert($insert_data);
    //         return response()->json([
    //             'data' => 'There is a request from ajax'
    //         ]);
    //     }
    // }
}
