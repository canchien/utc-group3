<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderStatuses;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return view('backend.orders.index');
    }

    public function getData()
    {
        $order = Order::orderBy('created_at', 'desc')->get();
        return Datatables::of($order)->make(true);
    }

    // Lấy chi tiết đặt hàng
    public function getOrderStatuses()
    {
        $order = Order::find(request()->id);
        return Datatables::of($order->orderStatuses)->make(true);
    }

    // lấy 1 chi tiết trạng thái đơn hàng
    public function ajaxDeleteAOrderStatus()
    {
        $orderStatus = OrderStatuses::find(request()->id);
        if ($orderStatus) {
            if ($orderStatus->delete()) {
                $orderStatus->order()->update([
                    'status' => 0,
                ]);
                return response()->json([
                    'status' => 'success',
                ]);
            }
            else {
                return response()->json([
                    'status' => 'failed',
                ]);
            }
        }
        return response()->json([
            'status' => 'notFound',
        ]);
    }

    /**
     * input order id
     * @return a message;
     */
    public function acceptOrder()
    {
        // Lấy ra order có id và có trạng thái chưa đc chấp nhận
        $order = Order::where([
            'id' => request()->id,
            'status' => 0,
        ])
            ->first();
        // Nếu tìm thấy thì thực hiện chấp nhận
        if ($order) {
            // Biến cờ kiểm tra có sp nào hết không
            $flag = 0;
            foreach ($order->products as  $product) {
                // Nếu sản phẩm khách đặt lớn hơn sản phẩm còn trong kho
                if ($product->qty < $product->pivot->productQty) {
                    $flag++;
                    $order->orderStatuses()->create([
                        'status' => 'Từ chối tiếp nhận đơn hàng lý do: sản phẩm ' . $product->name . ' không đáp ứng đủ cho đơn hàng',
                    ]);
                }
            }
            // nếu có sp hết hàng, huỷ đơn hàng
            if ($flag > 0) {
                $order->update([
                    'status' => 5,
                ]);
                return response()->json([
                    'status' => 'qty',
                ]);
            } else {
                // Nếu không thì xoá sản phẩm trong kho theo số lượng của đơn hàng
                foreach ($order->products as  $product) {
                    $product->update([
                        'qty' => $product->qty - $product->pivot->productQty,
                    ]);
                }
                // Cập nhật tình trạng đơn hàng
                $order->update([
                    'status' => 1,
                ]);
                // Cập nhật trạng thái đơn hàng
                $order->orderStatuses()->create([
                    'status' => 'Tiếp nhận đơn hàng',
                ]);
                return response()->json([
                    'status' => 'success',
                ]);
            }
        }
        return response()->json([
            'status' => 'notFound',
        ]);
    }

    /**
     * input order id
     * @return a message;
     */
    public function deniedOrder()
    {
        // Validaet và lấy ra lý do từ chối
        $rules = ['msg' => ['required', 'min:10', 'max:255']];
        $messages = [
            'msg.required' => 'Hãy nhập nội dung :attribute',
            'msg.min' => 'Nội dung :attribute gì mà ngắn thế? ít nhất :min ký tự nha',
            'msg.max' => 'Nội dung :attribute hơi dài quá thì phải',
        ];
        $attrName = [
            'msg' => 'lý do',
        ];
        $validator = Validator::make(request()->all(), $rules, $messages, $attrName);
        // Nếu ko được validate trả về lỗi
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }
        // Tìm order
        $order = Order::where([
            'id' => request()->id,
            'status' => 0,
        ])
            ->first();
        if ($order) {
            // Cập nhật thông tin về trạng thái đơn hàng
            $order->orderStatuses()->create([
                'status' => 'Từ chối tiếp nhận đơn hàng lý do: ' . request()->msg,
            ]);
            // Cập nhật trạng thái
            $order->update([
                'status' => 5,
            ]);
            return response()->json([
                'status' => 'success',
            ]);
        }
        return response()->json([
            'status' => 'notFound',
        ]);
    }

    public function showUpdateOrder(Order $order)
    {
        // lấy ra thông tin các prd đã order:
        $order_id = $order->id;
        $orderProduct = DB::table('order_product')->where('order_id',$order_id)->get();
        return view('backend.orders.update-order-status', compact('order','orderProduct'));
    }

    public function doUpdateOrder()
    {
        $data = request()->validate(
            [
                'msg' => ['required', 'min:10', 'max:255'],
            ],
            [
                'msg.required' => 'Hãy nhập nội dung :attribute',
                'msg.min' => 'Nội dung :attribute gì mà ngắn thế? ít nhất :min ký tự nha',
                'msg.max' => 'Nội dung :attribute hơi dài quá thì phải',
            ],
            [
                'msg' => 'lý do',
            ]
        );
        // lấy ra order
        $order = Order::find(request()->id);
        // Nếu tìm thấy order
        if ($order) {
            if ($order->status == -1 || $order->status == 5 || $order->status == 4) {
                return redirect()->back()->withErrors([
                    'errorMsg' => 'Bạn không thể cập nhật trạng thái cho đơn hàng này nữa.',
                ]);
            } else {
                $order->status = request()->status;
                $order->save();
                // Cập nhật thông tin về trạng thái đơn hàng
                $order->orderStatuses()->create([
                    'status' => $data['msg'],
                ]);
                return redirect('/admin/order/');
            }
        }

        return redirect()->back()->withErrors([
            'errorMsg' => 'Không tìm thấy đơn hàng này',
        ]);
    }
}
