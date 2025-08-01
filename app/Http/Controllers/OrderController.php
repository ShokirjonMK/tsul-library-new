<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin|Admin|Manager']);

        // $this->middleware('permission:list|create|edit|delete|user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:create|user-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit|user-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete|user-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);
        //  $this->middleware('permission:list|create|edit|delete', ['only' => ['index', 'store']]);
        //  $this->middleware('permission:create', ['only' => ['create', 'store']]);
        //  $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        //  $this->middleware('permission:delete', ['only' => ['destroy']]);
        //  $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language, Request $request)
    {
        $perPage = 20;
        $q = Order::query();

        $order_number = trim($request->get('order_number'));
        $status = trim($request->get('status'));
        $order_date = trim($request->get('order_date'));

        if ($order_number != null && $order_number > 0) {
            $q->orWhere('order_number', '=', $order_number);
        }
        if ($status != null) {
            $q->orWhere('status', '=', $status);
        }
        if ($status != null) {
            $q->orWhere('order_date', '=', $order_date);
        } else {
            $q->where('status', '>', 0);
        }

        $orders = $q->with(['reader', 'reader.profile'])->orderBy('created_at', 'desc')->paginate($perPage);

        return view('order.index', compact('orders', 'order_number', 'status', 'order_date'))
            ->with('i', (request()->input('page', 1) - 1) * $orders->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = new Order();
        return view('order.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Order::rules());

        $order = Order::create(Order::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('orders.index', app()->getLocale());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        request()->validate(
            [
                'detail_id' => 'required',
                'status' => 'required',
            ],
            [
                'detail_id.required' =>  __('The :attribute field is required.'),
                'status.required' =>  __('The :attribute field is required.'),
            ],
            [

                'detail_id' => __('Order'),
                'status' => __('Status'),
            ]
        );

        $orderDetailId = $request->input('detail_id');
        $status = $request->input('status');
        $type = $request->input('type');
        if($type=='detail'){
            $orderDetailModel=OrderDetail::find($orderDetailId);
            $orderDetailModel->status=$status;
            $orderDetailModel->save();    
        }
        if($type=='detail'){
            $orderModel=Order::find($orderDetailId);
             
            $orderModel->status=$status;
            $orderModel->save();    
        }


        toast(__('Created successfully.'), 'success');

        return redirect()->back();
                // return redirect()->route('orders.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $order = Order::find($id);

        if ($order != null && $order->status == Order::$SENT) {
            $order = Order::ChangeStatus($id, Order::$ACCEPTED);
        }

        if ($order == null) {
            abort(404);
        }

        return view('order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $order = Order::find($id);

        return view('order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Order $order)
    {

        request()->validate(Order::rules());

        $order->update(Order::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('orders.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {

        // $order = Order::find($id)->delete();
        // $order = Order::find($id);
        Order::ChangeStatus($id, Order::$DELETED);

        // $order->status=Order::$DELETED;
        // if($order->orderDetails != null && $order->orderDetails->count()>0){
        //     foreach($order->orderDetails as $k=>$v){
        //         $detail=OrderDetail::find($v->id);
        //         $detail->status=Order::$DELETED;
        //         $detail->save();
        //     }
        // }
        // $order->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('orders.index', app()->getLocale());
    }
}
