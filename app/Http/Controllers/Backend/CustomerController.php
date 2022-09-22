<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\backend\CustomerRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=DB::table('users')->paginate('10');
        return  view('backend.customer.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        User::create([
           'name'=> $request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'description'=>$request->description,
            'sex'=>$request->sex,
            'password'=>Hash::make($request->password),
            'email'=>$request->email
        ]);
        return  redirect()->route('list.customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        return view('backend.customer.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $user=User::findOrFail($id);

        $user->update([
            'name'=> $request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'description'=>$request->description,
            'sex'=>$request->sex,
            'email'=>$request->email
        ]);
        return  redirect()->route('list.customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $staff
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $staff)
    {
        try {
            if ($staff->email == "admin@shop.com") {
                return response()->json([
                    'status' => 403,
                    'message' => "Bạn không thể xóa tải khoản mặc định."
                ]);
            }
            if (auth()->user()->id == $staff->id) {
                return response()->json([
                    'status' => 403,
                    'message' => "Bạn không thể xóa chính mình."
                ]);
            }
            $staff->delete();
            return response()->json([
                'status' => 200,
                'message' => "Success!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }
}
