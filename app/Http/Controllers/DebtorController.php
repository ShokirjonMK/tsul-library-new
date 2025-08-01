<?php

namespace App\Http\Controllers;

use App\Exports\ExportDebtors;
use App\Models\Debtor;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class DebtorController
 * @package App\Http\Controllers
 */
class DebtorController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin|Admin|Manager']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language, Request $request)
    {
        $q = Debtor::query();
        $perPage = 20;

        $status = trim($request->get('status'));
        $keyword = trim($request->get('keyword'));
        $barcode = trim($request->get('barcode'));
        $title = trim($request->get('title'));
        if ($status == null) {
            $status = 99;
        }

        if ($status == 99) {
            $q->orderBy('return_time', 'asc')->orderBy('status', 'ASC');
        } elseif ($status == 98) {
            $q->whereNull('returned_time')->where('return_time', '<', date("Y-m-d"))->orderBy('return_time', 'asc');
        } else {
            $q->where('status', '=', $status)->orderBy('return_time', 'asc');
        }

        if ($keyword != null) {

//            $q->whereHas('bookInventar', function ($query) use ($keyword) {
//                if ($keyword) {
//                    $query->where('bar_code', '=', $keyword);
//                }
//            });

            $q->whereHas('reader', function ($query) use ($keyword) {

                if ($keyword) {
                    $query->where('inventar_number', '=', $keyword);
                }
            });

        }
        if ($barcode != null) {

            $q->whereHas('bookInventar', function ($query) use ($barcode) {
                if ($barcode) {
                    $query->where('bar_code', '=', $barcode);
                }
            });
        }

        if ($title != null) {

            $q->whereHas('book', function ($query) use ($title) {
                if ($title) {
                    $query->where('dc_title', 'LIKE', "%$title%")
                        ->orWhere('location_index', 'LIKE', "%$title%")
                        ->orWhere('dc_UDK', 'LIKE', "%$title%")
                        ->orWhere('dc_BBK', 'LIKE', "%$title%")
                        ->orWhere('ISBN', 'LIKE', "%$title%")
                        ->orWhere('extra1', 'LIKE', "%$title%")
                        ->orWhereHas('extraAuthorBooks', function ($query) use ($title) {
                            if ($title) {
                                $query->where('name', 'like', '%' . $title . '%');
                            }
                        });
                }
            });
        }


        $debtors = $q->with(['reader', 'reader.profile'])->distinct()->paginate($perPage, ['reader_id']);



        return view('debtor.index', compact('debtors', 'status', 'keyword', 'barcode', 'title'));
    }

    public function export($language, Request $request)
    {
        $file_name = 'books-debtors_' . date('Y_m_d_H_i_s') . '.xlsx';
        $keyword = trim($request->get('keyword'));
        $status = trim($request->get('status'));
        $barcode = trim($request->get('barcode'));
        $title = trim($request->get('title'));


        return Excel::download(new ExportDebtors($keyword, $status, $barcode, $title), $file_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $debtor = new Debtor();
        return view('debtor.create', compact('debtor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Debtor::rules());

        $debtor = Debtor::create(Debtor::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('debtors.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id, Request $request)
    {
        $status = trim($request->get('status'));
        $perPage = 20;

        $user = User::find($id);
        if ($status == 99) {
            $debtors = Debtor::where('reader_id', $id)->orderBy('return_time', 'asc')->orderBy('status', 'ASC')->paginate($perPage);
        } elseif ($status == 98) {
            $debtors = Debtor::whereNull('returned_time')->where('reader_id', $id)->where('return_time', '<', date("Y-m-d"))->orderBy('return_time', 'desc')->paginate($perPage);
        } else {
            $debtors = Debtor::where('reader_id', $id)->where('status', $status)->orderBy('return_time', 'asc')->paginate($perPage);
        }
        return view('debtor.show', compact('debtors', 'user'))->with('i', (request()->input('page', 1) - 1) * $debtors->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $debtor = Debtor::find($id);

        return view('debtor.edit', compact('debtor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Debtor $debtor
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Debtor $debtor)
    {

        request()->validate(Debtor::rules());

        $debtor->update(Debtor::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('debtors.index', app()->getLocale());
    }

    // /**
    //  * @param int $id
    //  * @return \Illuminate\Http\RedirectResponse
    //  * @throws \Exception
    //  */
    // public function destroy($language, $id)
    // {
    //     $debtor = Debtor::find($id)->delete();
    //     toast(__('Deleted successfully.'), 'info');

    //     return redirect()->route('debtors.index', app()->getLocale());
    // }
}
