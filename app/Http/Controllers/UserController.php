<?php

namespace App\Http\Controllers;

use App\Charts\GenderChart;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Jobs\ProcessImportUsers;
use App\Models\BooksType;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Organization;
use DB;
use Hash;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
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
        
        $data = UserProfile::select('gender_id', \DB::raw("count(gender_id) as count"))->whereNotNull('gender_id')->groupBy('gender_id')
            ->get();
        $chart = new GenderChart;
        // $chart->labels(['Erkak', 'Ayol']);
        // $chart->dataset('My dataset', 'line', $data);
        // dd($data);
        $chart->labels($data->keys());
        $chart->dataset('My dataset', 'pie', [265, 365]);

        // dispatch(new ProcessImportUsers());

        // Excel::queueImport(new UsersImport, 'users.xlsx');
        // Excel::queueImport(new UsersImport, 'users.xlsx');

        $show_accardion = false;

        // $roles = Auth::user()
        //     ->getRoleNames()
        //     ->toArray();
        // if (in_array('SuperAdmin', $roles)) {
        //     $data = User::orderBy('id', 'desc')->paginate(20);
        // }
        // if (in_array('Manager', $roles)) {

        //     $data = User::with('profile')->orderBy('id', 'desc')->paginate(20);
        //     // dd($data);
        //     // dd(Auth::user()->profile);
        // }
        $from = trim($request->get('from'));
        $to = trim($request->get('to'));

        $page = trim($request->get('page'));
        $keyword = trim($request->get('keyword'));
        $inventar_number = trim($request->get('inventar_number'));
        $name = trim($request->get('name'));
        $email = trim($request->get('email'));
        $role_id = trim($request->get('role_id'));
        $organization_id = trim($request->get('organization_id'));
        $branch_id = trim($request->get('branch_id'));
        $department_id = trim($request->get('department_id'));
        $faculty_id = trim($request->get('faculty_id'));
        $chair_id = trim($request->get('chair_id'));
        $group_id = trim($request->get('group_id'));

        $roles = Role::all();

        $organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $branches = Branch::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $departments = Department::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        // $data = User::orderBy('id', 'desc')->paginate(20);
        $q = User::query();


        if (!empty($from) && !empty($to)) {
            // intval(substr('' . trim($request->get('from'))
            $q->orWhereBetween('inventar', [$from, $to]);
            // $q->orWhere(function($query) use ($from, $to){
            //     $query->whereBetween('id', [intval($from),intval($to)])
            //           ->orWhereBetween('id', [intval($from),intval($to)]);
            //   });
            $show_accardion = true;
        }

        if (!empty($from)) {
            $show_accardion = true;

            $q->orWhere('inventar', '=', $from);
        }
        if (!empty($to)) {
            $show_accardion = true;

            $q->orWhere('inventar', '=', $to);
        }

        if ($name != null) {
            $q->orWhere('name', 'LIKE', "%$name%");
        }
        if ($email != null) {
            $q->orWhere('email', 'LIKE', "%$email%");
        }
        if ($inventar_number != null) {
            $q->orWhere('inventar_number', 'LIKE', "%$inventar_number%");
        }

        if (!empty($role_id)) {
            $model_roles = DB::table('model_has_roles')->select('model_id')->where('role_id', $role_id)->get();
            $user_id = [];
            foreach ($model_roles as $k => $v) {
                $user_id[$k] = $v->model_id;
            }
            $users = $q->whereIn('id', $user_id);
        }
        if ($keyword != null) {
            $show_accardion = true;
            $q->where('inventar_number', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%");
        }
        if ($organization_id != null && $organization_id > 0) {
            $show_accardion = true;
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($organization_id) {
                    $query->where('organization_id', '=', $organization_id);
                });
        }

        if ($branch_id != null && $branch_id > 0) {
            $show_accardion = true;
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($branch_id) {
                    $query->where('branch_id', '=', $branch_id);
                });
        }

        if ($department_id != null && $department_id > 0) {
            $show_accardion = true;
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($department_id) {
                    $query->where('department_id', '=', $department_id);
                });
        }
        if ($faculty_id != null && $faculty_id > 0) {
            $show_accardion = true;
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($faculty_id) {
                    $query->where('faculty_id', '=', $faculty_id);
                });
        }
        if ($chair_id != null && $chair_id > 0) {
            $show_accardion = true;
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($chair_id) {
                    $query->where('chair_id', '=', $chair_id);
                });
        }
        if ($group_id != null && $group_id > 0) {
            $show_accardion = true;
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($group_id) {
                    $query->where('group_id', '=', $group_id);
                });
        }


        $data = $q->with('roles')->orderBy('id', 'desc')->paginate(20);


        return view('users.index', compact('chart', 'data', 'name', 'email', 'roles', 'role_id', 'inventar_number', 'show_accardion', 'keyword', 'organizations', 'branches', 'departments', 'department_id', 'organization_id', 'branch_id', 'faculty_id', 'chair_id', 'group_id', 'page', 'from', 'to', 'request'));
    }

    public function export($language, Request $request)
    {
        $file_name = 'user_' . date('Y_m_d_H_i_s') . '.xlsx';

        return Excel::download(new UsersExport($request), $file_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function printinventar($language, $id,  Request $request)
    {
        $from = trim($request->get('from'));
        $to = trim($request->get('to'));
        if (!empty($from) && !empty($to)) {
            // intval(substr('' . trim($request->get('from'))
            $bookInventars = User::whereBetween('inventar_number', [intval($from), intval($to)])
                ->get();
            // $customPaper = array(0,0,720,1440);

            // $pdf = Pdf::loadView('pdf.inventarall', compact('bookInventars'));     
            // return $pdf->download('invoices.pdf');
            return view('pdf.inventaruserall', compact('bookInventars'));
        } else {
            $user = User::find($id);
            if ($user->inventar_number != null) {
                return view('pdf.inventaroneuser', compact('user'));
            } else {
                toast(__('User does not has inventar number'), 'success');

                return redirect()->route('users.index', app()->getLocale())
                    ->with('success', 'User does not has inventar number');
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $user = new User();
        $userRole = null;

        return view('users.create', compact('roles', 'user', 'userRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'inventar_number' => 'required|unique:users,inventar_number',
                'password' => 'required|confirmed',
                'roles' => 'required'
            ],
            [
                'name.required' =>  __('The :attribute field is required.'),
                'password.required' =>  __('The :attribute field is required.'),
                'email.required' =>  __('The :attribute field is required.'),
                'roles.required' =>  __('The :attribute field is required.'),
                'inventar_number.required' =>  __('The :attribute field is required.'),
                'inventar_number.unique' =>  __('The :attribute has already been taken.'),
                'password.confirmed' =>  __('The :attribute confirmation does not match.'),
                'email.unique' =>  __('The :attribute has already been taken.'),
            ],
            [
                'inventar_number' => __('Inventar Number'),
                'name' => __('Name'),
                'email' => __('Email'),
                'password' => __('Password'),
                'roles' => __('Role'),
            ]
        );

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['status'] = $input['status'];

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id, Request $request)
    {
        $user = User::find($id);
        $year = (trim($request->get('year'))) ? trim($request->get('year')) : date('Y');
        if (!is_numeric($year) || $year < 2022) {
            $year = date('Y');
        }
        $months = BooksType::getMonths();
        $years = range(2022, strftime("%Y", time()));
        return view('users.show', compact('user', 'year', 'years', 'months'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function card($language, Request $request)
    {
        $id = trim($request->get('userid'));


        $keyword = trim($request->get('keyword'));
        $inventar_number = trim($request->get('inventar_number'));

        $from = trim($request->get('from'));
        $to = trim($request->get('to'));
        $name = trim($request->get('name'));
        $email = trim($request->get('email'));
        $role_id = trim($request->get('role_id'));
        $organization_id = trim($request->get('organization_id'));
        $branch_id = trim($request->get('branch_id'));
        $department_id = trim($request->get('department_id'));
        $faculty_id = trim($request->get('faculty_id'));
        $chair_id = trim($request->get('chair_id'));
        $group_id = trim($request->get('group_id'));

        // $data = User::orderBy('id', 'desc')->paginate(20);
        $q = User::query();


        if (!empty($from) && !empty($to)) {
            // intval(substr('' . trim($request->get('from'))
            $q->orWhereBetween('inventar', [$from, $to]);
        }

        if (!empty($from)) {

            $q->orWhere('inventar', '=', $from);
        }
        if (!empty($to)) {

            $q->orWhere('inventar', '=', $to);
        }

        if ($name != null) {
            $q->orWhere('name', 'LIKE', "%$name%");
        }
        if ($email != null) {
            $q->orWhere('email', 'LIKE', "%$email%");
        }
        if ($inventar_number != null) {
            $q->orWhere('inventar_number', 'LIKE', "%$inventar_number%");
        }

        if (!empty($role_id)) {
            $model_roles = DB::table('model_has_roles')->select('model_id')->where('role_id', $role_id)->get();
            $user_id = [];
            foreach ($model_roles as $k => $v) {
                $user_id[$k] = $v->model_id;
            }
            $users = $q->whereIn('id', $user_id);
        }
        if ($keyword != null) {
            $show_accardion = true;
            $q->where('inventar_number', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%");
        }
        if ($organization_id != null && $organization_id > 0) {
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($organization_id) {
                    $query->where('organization_id', '=', $organization_id);
                });
        }

        if ($branch_id != null && $branch_id > 0) {
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($branch_id) {
                    $query->where('branch_id', '=', $branch_id);
                });
        }

        if ($department_id != null && $department_id > 0) {
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($department_id) {
                    $query->where('department_id', '=', $department_id);
                });
        }
        if ($faculty_id != null && $faculty_id > 0) {
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($faculty_id) {
                    $query->where('faculty_id', '=', $faculty_id);
                });
        }
        if ($chair_id != null && $chair_id > 0) {
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($chair_id) {
                    $query->where('chair_id', '=', $chair_id);
                });
        }
        if ($group_id != null && $group_id > 0) {
            $q->with('profile')
                ->whereHas('profile', function (Builder $query) use ($group_id) {
                    $query->where('group_id', '=', $group_id);
                });
        }

        if (!empty($id)) {

            // $users = User::take(61)->get();
            // $user = User::find($id);
            $q->orWhere('id', '=', $id);
        }
        $users = $q->orderBy('id', 'desc')->paginate(20);

        //  $pdf = PDF::loadView('pdf.cards', array('users' => $users));

        // return $pdf->download('itsolutionstuff.pdf');

        // $pdf = Pdf::loadView('pdf.cards', compact('users'));

        // return $pdf->download('cards.pdf');

        return view('pdf.cards', array('users' => $users));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'confirmed',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $input['status'] = $input['status'];

        $user = User::find($user->id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->input('roles'));
        toast(__('User updated successfully.'), 'success');

        return redirect()->route('users.index', app()->getLocale())
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($language, $id)
    {
        // User::find($id)->delete();
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        toast(__('User deleted successfully.'), 'success');

        return redirect()->route('users.index', app()->getLocale())
            ->with('success', 'User deleted successfully.');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($language, $id, Request $request)
    {
        $type = $request->input('type');

        // BooksType::find($id)->delete();
        $user = User::find($id);
        if ($type == 'DELETE') {
            User::find($id)->delete();
            UserProfile::where('user_id', '=', $id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();
        } else {
            return view('users.show', compact('user'));
        }
    }
}
