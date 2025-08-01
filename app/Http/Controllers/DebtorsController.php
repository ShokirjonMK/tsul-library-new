<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebtorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        // $departments = Department::orderBy('id', 'desc')->paginate($perPage);

        return view('debtor.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function takegive()
    {
        $perPage = 20;
        // $departments = Department::orderBy('id', 'desc')->paginate($perPage);

        return view('debtor.takegive');
    }

    public function takegiverfid()
    {
        $perPage = 20;
        // $departments = Department::orderBy('id', 'desc')->paginate($perPage);

        return view('debtor.takegiverfid');
    }
}
