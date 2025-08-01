<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;


/**
 * Class Group
 *
 * @property $id
 * @property $code
 * @property $isActive
 * @property $organization_id
 * @property $branch_id
 * @property $department_id
 * @property $faculty_id
 * @property $chair_id
 * @property $title
 * @property $slug
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Branch $branch
 * @property Chair $chair
 * @property Department $department
 * @property Faculty $faculty
 * @property Organization $organization
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Group extends Model
{
    use Sluggable;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'isActive', 'organization_id', 'branch_id', 'department_id', 'faculty_id', 'chair_id', 'title', 'slug', 'created_by', 'updated_by'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function branch()
    {
        return $this->hasOne('App\Models\Branch', 'id', 'branch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chair()
    {
        return $this->hasOne('App\Models\Chair', 'id', 'chair_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profiles()
    {
        return $this->hasMany('App\Models\UserProfile', 'group_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function faculty()
    {
        return $this->hasOne('App\Models\Faculty', 'id', 'faculty_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function updatedBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('isActive', 1);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
            if (Auth::user()) {
                $user = Auth::user()->profile;
                if ($user != null) {
                    $model->organization_id = $user->organization_id;
                    $model->branch_id = $user->branch_id;
                }
            }else{
                $model->organization_id = 1;
                $model->branch_id = 1;
            }
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }
    public static function GetData(Request $request)
    {
        $data = [];
        // foreach (config('app.locales') as $k => $locale) {
        //     $type = new self();
        //     foreach ($type->translatedAttributes as $key => $val) {
        //         $data[$k][$val] = $request->input($val . '_' . $k);
        //     }
        // }
        $data['title'] = $request->input('title');
        $data['organization_id'] = $request->input('organization_id');
        $data['branch_id'] = $request->input('branch_id');
        $data['department_id'] = $request->input('department_id');
        $data['faculty_id'] = $request->input('faculty_id');
        $data['chair_id'] = $request->input('chair_id');
        $data['isActive'] = $request->input('isActive');
        $data['code'] = $request->input('code');

        return $data;
    }

    public static function rules()
    {
        $rules = [
            'organization_id' => 'required',
            'branch_id' => 'required',
            'faculty_id' => 'required',
            'chair_id' => 'required',
            'title' => 'required',
        ];

        return $rules;
    }

    public static function createOrUpdateByHemisCode($data, $specialty, $department)
    {

        $checkExist = self::where('code', $data['id'])->first();
        $faculty = Faculty::createOrUpdateByHemisCode($department);
        $faculty_id = null;
        if ($faculty != null && $faculty) {
            $faculty_id = $faculty->id;
        }

        $chair = Chair::createOrUpdateByHemisCode($specialty, $department);
        $chair_id = null;
        if ($chair != null && $chair) {
            $chair_id = $chair->id;
        }


        if ($checkExist != null) {
            $newData = [
                'code' => $data['id'],
                'faculty_id' => $faculty_id,
                'chair_id' => $chair_id,
                'title' => $data['name']
            ];
            $checkExist->update($newData);
            return $checkExist;
        } else {
            $newData = [
                'isActive' => true,
                'faculty_id' => $faculty_id,
                'chair_id' => $chair_id,
                'code' => $data['id'],
                'title' => $data['name']
            ];
           $model  = Group::create($newData);
           return $model;
        }
    }
}
