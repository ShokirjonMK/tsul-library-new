@extends('layouts.app')

@section('template_title')
    {{ __('User Profile') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('User Profile') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('User Profile') }}
            </p>
        </div>
        <div>
            <a href="{{ route('user-profiles.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('Create') }}  
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    
										<th>Phone Number</th>
										<th>Pnf Code</th>
										<th>Passport Seria Number</th>
										<th>Passport Copy</th>
										<th>Image</th>
										<th>Date Of Birth</th>
										<th>Kursi</th>
										<th>Gender Id</th>
										<th>User Type Id</th>
										<th>User Id</th>
										<th>Branch Id</th>
										<th>Department Id</th>
										<th>Created By</th>
										<th>Updated By</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($userProfiles as $userProfile)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $userProfile->phone_number }}</td>
											<td>{{ $userProfile->pnf_code }}</td>
											<td>{{ $userProfile->passport_seria_number }}</td>
											<td>{{ $userProfile->passport_copy }}</td>
											<td>{{ $userProfile->image }}</td>
											<td>{{ $userProfile->date_of_birth }}</td>
											<td>{{ $userProfile->kursi }}</td>
											<td>{{ $userProfile->gender_id }}</td>
											<td>{{ $userProfile->user_type_id }}</td>
											<td>{{ $userProfile->user_id }}</td>
											<td>{{ $userProfile->branch_id }}</td>
											<td>{{ $userProfile->department_id }}</td>
											<td>{{ $userProfile->created_by }}</td>
											<td>{{ $userProfile->updated_by }}</td>

                                        <td>
                                            <form action="{{ route('user-profiles.destroy',[app()->getLocale(), $userProfile->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('user-profiles.show', [app()->getLocale(), $userProfile->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('user-profiles.edit', [app()->getLocale(), $userProfile->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach                                    
                            </tbody>
                        </table>
                    </div>
                    @if ($userProfiles->count() > 0)
                        {!! $userProfiles->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
