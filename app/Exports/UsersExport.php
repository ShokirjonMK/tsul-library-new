<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection, WithMapping, WithHeadings
{

    use Exportable;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // $this->request->get('request')['role_id']

        $from = null;
        $to = null;
        $keyword = null;
        $inventar_number = null;
        $name = null;
        $email = null;
        $role_id = null;
        $organization_id = null;
        $branch_id = null;
        $department_id = null;
        $faculty_id = null;
        $chair_id = null;
        $group_id = null;
        $request = $this->request->get('request');
        if($request != null){
            if (array_key_exists('from', $request)) {
                $from = $request['from'];
            }
            if (array_key_exists('to', $request)) {
                $to = $request['to'];
            }
            if (array_key_exists('keyword', $request)) {
                $keyword = $request['keyword'];
            }
            if (array_key_exists('inventar_number', $request)) {
                $inventar_number = $request['inventar_number'];
            }
            if (array_key_exists('name', $request)) {
                $name = $request['name'];
            }
            if (array_key_exists('email', $request)) {
                $email = $request['email'];
            }
            
            if (array_key_exists('role_id', $request)) {
                $role_id = $request['role_id'];
            }

            if (array_key_exists('organization_id', $request)) {
                $organization_id = $request['organization_id'];
            }
            if (array_key_exists('branch_id', $request)) {
                $branch_id = $request['branch_id'];
            }
            if (array_key_exists('department_id', $request)) {
                $department_id = $request['department_id'];
            }
            if (array_key_exists('faculty_id', $request)) {
                $faculty_id = $request['faculty_id'];
            }
            if (array_key_exists('chair_id', $request)) {
                $chair_id = $request['chair_id'];
            }
            if (array_key_exists('group_id', $request)) {
                $group_id = $request['group_id'];
            }
 
        }


        $q = User::query();


        if (!empty($from) && !empty($to)) {
            $q->orWhereBetween('inventar', [$from, $to]);
            // $q->orWhere(function($query) use ($from, $to){
            //     $query->whereBetween('id', [intval($from),intval($to)])
            //           ->orWhereBetween('id', [intval($from),intval($to)]);
            //   });
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

        return $q->with('roles')->orderBy('id', 'desc')->get();
    }
    public function map($user): array
    {
        $role=null;
        if(!empty($user->getRoleNames())){
            foreach($user->getRoleNames() as $val){
                $role .= $val.', ';                
            }
        }


        return [
            $user->id,
            $user->name,
            $user->email,
            rtrim($role, ', '),
            $user->inventar_number,
            $user->profile->phone_number,
            $user->profile->date_of_birth,
            $user->profile->pnf_code,
            $user->profile->passport_seria_number,
            $user->profile->kursi,
            $user->profile->gender_id ? $user->profile->referenceGender->title : '',
            $user->profile->user_type_id ? $user->profile->userType->title : '',
            $user->profile->organization_id ? $user->profile->organization->title : '',
            $user->profile->branch_id ? $user->profile->branch->title : '',
            $user->profile->department_id ? $user->profile->department->title : '',
            $user->profile->faculty_id ? $user->profile->faculty->title : '',
            $user->profile->chair_id ? $user->profile->chair->title : '',
            $user->profile->group_id ? $user->profile->group->title : '',
            $user->profile->address,

        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Id',
            __('Name'),
            __('Email'),
            __('Roles'),
            __('Bar code'),
            __('Phone Number'),
            __('Date Of Birth'),
            __('PIN'),
            __('Passport series and number'),
            __('Course'),
            __('Reference Gender'),
            __('User Type'),
            __('Organization'),
            __('Branch'),
            __('Department'),
            __('Faculty'),
            __('Chair'),
            __('Group') ,
            __('Address')
        ];
    }
}
