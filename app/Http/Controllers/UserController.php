<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }
    public function show(){
        $data = Post::all();
        $html = '';
        if (count($data) > 0) {
            $number = 1;
            $html.='
                <div class="card-header">
                    <h4 class="text-center">ข้อมูลสินค้า</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table w-100" id="show_table">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อสินค้า</th>
                                <th>คำอธิบายสินค้า</th>
                                <th class="text-end">จำนวนสินค้า</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>';

                        foreach ($data as $key => $value) {
                            $html.='
                            <tr>
                                <td>'.$number++.'</td>
                                <td>'.$value->name.'</td>
                                <td>'.$value->description.'</td>
                                <td class="text-end">'.$value->quantity.'</td>
                                <td class="text-center">
                                    <div class="btn-group shadow" role="group">
                                        <button type="button" class="btn btn-warning btn-sm" data-id='.$value->id.'>Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm delete" data-id='.$value->id.' data-id2='.$value->name.'>Del</button>
                                    </div>
                                </td>
                            </tr>
                            ';
                        }

            $html.='
                        </tbody>
                    </table>
                </div>
            ';
        }else{
            $html.='
            <div class="alert alert-danger text-center mb-0" role="alert">
                ไม่มีข้อมูลในระบบ
            </div>
            ';
        }

        return response()->json(['data'=>$html]);
    }
    public function insert(Request $request){
        $post = new Post();
        // $post->user_id = auth()->user()->id;
        // $post->name = $request->name;
        // $post->description = $request->description;
        // $post->quantity = $request->quantity;
        // $post->save();


        $post->insert([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);

        return response()->json(['insert_success'=> "บันทึกข้อมูลสำเร็จ"]);
    }


    public function delete(Request $request){
        $post = new Post();
        $post->find($request->id)->delete();
        return response()->json(['delete_success'=>"ลบข้อมูลสำเร็จ"]);
    }
}
