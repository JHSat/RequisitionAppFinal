<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use App\User;
use App\Department;
use App\Requests;
use App\Storage;
use Auth;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\Datatables\Datatables;

class RequestController extends Controller
{    
    public function indexmakerequest(){
        $date = date('Y-m-d');
        return view('user.makerequest')->with('date', $date);
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
            $date = date('Y-m-d H:i:s');
            $status = 'O';
            $req = new Requests([
                'req_id' => $req_id,
                'transac_code' => $transac_code,
                'requestee' => $requestee,
                'requestedDate' => $date,
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
                    'success' => 'Requisition form sent!'
                ]);
            }
        }
    }
    public function sampleindex(){
        $date = date('Y-m-d');
        return view('user.sample')->with('date', $date);
    }
    public function select2Item(Request $request){
        $code = $request->code;
        if($code == 2){
            $html = "
            <div class='row py-2'>
                <div class='col'>
                    <select class='selItem form-control' name='item[]'></select>
                </div>
                <div class='col'>
                    <input type='number' name='quantity[]' class='form-control' placeholder='quantity'/>
                </div>
                <button class='delete btn btn-danger'> - </button>
            </div>
            ";
            return response()->json($html);
        }
        else{
            $search = $request->search;
            if ($search == '') {
                $items = Items::orderby('unit', 'asc')->select('item_id','unit')->get();
            } else {
                $items = Items::orderby('unit', 'asc')->select('item_id','unit')->where('unit', 'like', '%'.$search.'%')->get();
            }
            $response = array();
            foreach ($items as $item) {
                $response[] = array(
                    'id' => $item->item_id,
                    'text' => $item->unit
                );
            }
            return response()->json($response);
        }
    }
    public function requestIndex($id){
        $req = Requests::find($id);
        if(Auth::user()->id == $req->requestee){
            $request = Requests::find($id);
            $user = User::where('id', '=', $request->requestee)->first();
            $sql = "SELECT * FROM storage JOIN items on storage.item_id = items.item_id WHERE transac_code = '".$request->transac_code."'";
            $data_items = DB::select($sql);
            return view('user.request')->with('request', $request)->with('user', $user)->with('data_items', $data_items);
        }
        else{
            return redirect()->back();
        }
    }
    public function deleteRequest(Request $request, $id){
        $reqDel = Requests::find($id);
        if (Auth::user()->id == $reqDel->requestee) {
            $itemDel = Storage::where('transac_code', '=', $reqDel->transac_code);
            $itemDel->delete();
            $reqDel->delete();
            return response()->json([
                'success' => 'Request deleted successfully!'
            ]);
        } else {
            return redirect()->back();
        }
    }
    public function editRequest($id){
        $req = Requests::find($id);
        return view('user.editrequest')->with('req', $req);

    }
    public function getEditItems($id){
        $req_id = Requests::find($id);
        $sql = "SELECT * FROM storage 
                join items on storage.item_id = items.item_id 
                WHERE transac_code = '".$req_id->transac_code."'";
        $data = DB::select($sql);
        return Datatables::of($data)
        ->addColumn('action', function($row){
            $btn = '<a href="javascript:void(0)" data-id="'.$row->item_id.'" class="btnRemoveItem btn btn-danger btn-sm">Remove item</a>';
            return $btn;
        })
        ->make(true);
    }
    public function removeItem(Request $request){
        DB::delete("DELETE FROM storage 
                    WHERE item_id = '".$request->item_id."'
                    AND transac_code = '".$request->transac_code."'");
        return response()->json([
            'success' => 'Item removed successfully'
        ]);
    }
    public function updateRequestItem(Request $request){
        if($request->ajax()){
            $item_id = $request->item;
            $quantity = $request->quantity;
            $transac_code = $request->transac_code;
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
                'success' => 'Edited successfully'
            ]);
        }
    }
    public function requestAdminIndex(){
        $id = Auth::user()->department;
        $dept_name = Department::where('id', '=', $id)->first();
        return view('admin.requests')->with('dept_name', $dept_name);
    }
    public function viewRequestAdmin($id){
        $req = Requests::find($id);
        $user = User::where('id', '=', $req->requestee)->first();
        $items = DB::select("SELECT * FROM storage 
                            join items on storage.item_id = items.item_id
                            where storage.transac_code = '".$req->transac_code."'");
        $author = User::where('id', '=', $req->authorizedBy)->first();
        $confirmer = User::where('id', '=', $req->confirmedBy)->first();
        return view('admin.view_request')
                ->with('req', $req)
                ->with('user', $user)
                ->with('items', $items)
                ->with('author', $author)
                ->with('confirmer', $confirmer);
    }
    public function authorizeRequest($id){
        $req = Requests::find($id);
        $req->status = 'A';
        $req->authorizedBy = Auth::user()->id;
        $req->authorizedDate = date('Y-m-d H:i:s');
        $req->save();
        $dd = date('Y-m-d H:i:s');
        return response()->json([
            'success' => 'authorized successfully!',
            'req_id' => $req->req_id,
            'authorizedBy' => Auth::user()->name,
            'authDate' => $dd
        ]);
    }
    public function confirmRequest($id){
        $req = Requests::find($id);
        $req->status = 'C';
        $req->confirmedBy = Auth::user()->id;
        $req->confirmedDate = date('Y-m-d H:i:s');
        $req->processedDate = date('Y-m-d H:i:s');
        $req->save();
        return response()->json([
            'success' => 'Request confirmed!',
            'confirmedBy' => Auth::user()->name,
            'confirmedDate' => date('Y-m-d H:i:s'),
            'processedDate' => date('Y-m-d H:i:s')
        ]);
    }
}





