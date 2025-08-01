<?php

namespace App\Http\Controllers;

use App\Models\Udc;
use Illuminate\Http\Request;

/**
 * Class UdcController
 * @package App\Http\Controllers
 */
class UdcController extends Controller
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
        $q = Udc::query();
        $perPage = 20;
        $keyword=trim($request->get('keyword'));

        if (strpos($keyword, '\\') !== FALSE) {
            $keyword=addslashes($keyword);
        }
        if($keyword != null){ 
            $q->Where('udc_number', 'LIKE', "%$keyword%")
            ->orWhere('description', 'LIKE', "%$keyword%")
            ->orWhere('number_of_codes', 'LIKE', "%$keyword%")
            ->orWhere('notes', 'LIKE', "%$keyword%");
           
        }
    //    ->where('parent_id',NULL)
        $udcs = $q->orderBy('id', 'desc')->paginate($perPage);
        // $udcs = Udc::where('parent_id',NULL)->orderBy('id', 'desc')->paginate($perPage);
        if (strpos($keyword, '\\') !== FALSE) {
            $keyword=stripslashes($keyword);
        }
        return view('udc.index', compact('udcs', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * $udcs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $udc = new Udc();
        $udcs = Udc::pluck('udc_number', 'id');


        return view('udc.create', compact('udc', 'udcs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Udc::rules());

        $udc = Udc::create(Udc::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('udcs.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $udc = Udc::find($id);
        
        return view('udc.show', compact('udc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $udc = Udc::find($id);
        $udcs = Udc::pluck('udc_number', 'id');
        return view('udc.edit', compact('udc', 'udcs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Udc $udc
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Udc $udc)
    {

        request()->validate(Udc::rules());

        $udc->update(Udc::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('udcs.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $udc = Udc::find($id)->delete();
        $udc = Udc::find($id);
            
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('udcs.index', app()->getLocale());
    }
}
