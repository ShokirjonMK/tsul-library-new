<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserProfileController
 * @package App\Http\Controllers
 */
class UserProfileController extends Controller
{
        /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin|Admin|Manager|Accountant|Reader']);
        
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
        $userProfiles = UserProfile::orderBy('id', 'desc')->paginate($perPage);

        return view('user-profile.index', compact('userProfiles'))
            ->with('i', (request()->input('page', 1) - 1) * $userProfiles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userProfile = new UserProfile();
        return view('user-profile.create', compact('userProfile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(UserProfile::rules());

        $userProfile = UserProfile::create(UserProfile::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('user-profiles.index', app()->getLocale());
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function userProfile($language)
    {
        $user = Auth::user();
        $userProfile = $user->profile;
        return view('user-profile.my', compact('userProfile', 'user'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $userProfile = UserProfile::find($id);

        return view('user-profile.show', compact('userProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $userProfile = UserProfile::find($id);

        return view('user-profile.edit', compact('userProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  UserProfile $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, UserProfile $userProfile)
    {

        request()->validate(UserProfile::rules());

        $userProfile->update(UserProfile::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('user-profiles.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $userProfile = UserProfile::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('user-profiles.index', app()->getLocale());
    }
}
