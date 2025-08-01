<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

/**
 * Class OrderDetailController
 * @package App\Http\Controllers
 */
class OrderDetailController extends Controller
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
    public function index()
    {
        $perPage = 20;
        $orderDetails = OrderDetail::orderBy('id', 'desc')->paginate($perPage);

        return view('order-detail.index', compact('orderDetails'))
            ->with('i', (request()->input('page', 1) - 1) * $orderDetails->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orderDetail = new OrderDetail();
        return view('order-detail.create', compact('orderDetail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(OrderDetail::rules());

        $orderDetail = OrderDetail::create(OrderDetail::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('order-details.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $orderDetail = OrderDetail::find($id);

        return view('order-detail.show', compact('orderDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $orderDetail = OrderDetail::find($id);

        return view('order-detail.edit', compact('orderDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  OrderDetail $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, OrderDetail $orderDetail)
    {

        request()->validate(OrderDetail::rules());

        $orderDetail->update(OrderDetail::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('order-details.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $orderDetail = OrderDetail::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('order-details.index', app()->getLocale());
    }
}
