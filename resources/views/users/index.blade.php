@extends('layouts.app')

@section('template_title')
    {{ __('Users') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Users') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Users') }}
            </p>
        </div>
        <div>
            <a href="{{ route('users.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('Create') }}  
            </a>
        </div>
    </div> 
    <div class="row">
        <div class="col-12">
            

        </div>
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-header">
                    <div class="accordion" id="accordionExample" style="width: 100%;">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ __('Advanced search') }}
                                </button>
                            </h2>
                            <div id="collapseOne"
                                class="accordion-collapse collapse  @if ($show_accardion) show @endif"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <form action="{{ route('users.index', app()->getLocale()) }}" method="GET"
                                        accept-charset="UTF-8" role="search">
                                        <div class="row" style="margin-bottom: 20px;">

                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="keyword"
                                                    placeholder="{{ __('Keyword') }}..." value="{{ $keyword }}">
                                            </div>

                                        </div>
                                        <div class="row">
                                            
                                            @php
                                                $row_type="inline";
                                            @endphp
                                            <livewire:admin.depdrops.org-branch-dep :type="$row_type" :organization_id="$organization_id" :branch_id="$branch_id" :department_id="$department_id" :faculty_id="$faculty_id" :chair_id="$chair_id" :group_id="$group_id"/>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="text" class="form-control " name="from" id="from"
                                                        value="{{ $from }}"
                                                        placeholder="{{ __('from') }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="text" class="form-control " name="to" id="to"
                                                        value="{{ $to }}" placeholder="{{ __('to') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>
                                            @if ($from || $to || $keyword || $organization_id || $branch_id || $department_id || $faculty_id || $chair_id || $group_id)
                                                <a class="btn btn-sm btn-primary " target="__blank"
                                                    href="{{ route('users.card', [app()->getLocale(), 'keyword'=>$keyword, 'organization_id'=>$organization_id, 'branch_id'=>$branch_id, 'department_id'=>$department_id, 'faculty_id'=>$faculty_id, 'chair_id'=>$chair_id, 'group_id'=>$group_id, 'page'=>$page, 'from'=>$from, 'to'=>$to]) }}"><i class="mdi mdi-10px mdi-printer"></i> {{ __('Print') }}</a>
                                            @endif
                                            <a href="{{ route('users.index', app()->getLocale()) }}" class="btn btn-sm btn-info float-right">{{ __('Clear') }}</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <br>
                            {!! __('Users :attribute', ['attribute' => $data->total()]) !!}
                            <a href="{{ route('users.export', [app()->getLocale(), 'request' => $request->all()]) }}"
                                class="btn btn-sm btn-success float-right">
                                {{ __('Export to Excel') }}
                            </a> 
                            {{-- , | {!!__("Number of books is :attribute",['attribute' => $books->total() ])!!} --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('IsActive') }}</th> 
                                        <th>{{ __('Bar code') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Roles') }}</th>
                                        <th width="280px">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <form action="{{ route('users.index', app()->getLocale()) }}" method="GET" accept-charset="UTF-8"
                                            role="search">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="inventar_number"
                                                    id="inventar_number" value="{{ $inventar_number }}"
                                                    placeholder="{{ __('Bar code') }}" />
                                            </div> 
                                        </th>
                                        <th>
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="name" id="name"
                                                    value="{{ $name }}"
                                                    placeholder="{{ __('Name') }}" />
                                            </div>
                                        </th>
                                        <th>
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="email" id="email"
                                                    value="{{ $email }}"
                                                    placeholder="{{ __('Email') }}" />
                                            </div>
                                        </th>
                                        <th>
                                            <div class="form-group">
                                                <select name="role_id" class="border shadow p-2 bg-white">
                                                    <option value=''>{{ __('Choose') }}</option>
                                                    @foreach ($roles as $role)
                                                        @if ($role_id == $role->id)
                                                            <option value={{ $role->id }} selected>
                                                                {{ $role->name }}</option>
                                                        @else
                                                            <option value={{ $role->id }}>{{ $role->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </th>
                                        <th width="280px">
                                            <div class="input-group">
                                                <a href="{{ route('users.index', app()->getLocale()) }}"
                                                    class="btn btn-sm btn-info">{{ __('Clear') }}</a>
                                                <button type="submit"
                                                    class="btn btn-sm btn-primary float-right">{{ __('Search') }}</button>
                                            </div>
                                        </th>
                                    </tr>
                                    </form>
                                    @foreach ($data as $key => $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{!! $user->status == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td class="text-center">
                                            
                                            @php
                                                if($user->inventar_number){
                                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($user->inventar_number, $generator::TYPE_CODE_128)) . '">';

                                                }
                                            @endphp
                                            <br>
                                            {{ $user->inventar_number }}
                                        </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $val)
                                                        <label class="badge badge-purple">{{ $val }}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('users.destroy',[app()->getLocale(), $user->id]) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('users.show', [app()->getLocale(), $user->id]) }}"> {{ __('Show') }}</a>
                                                    
                                                    <a class="btn btn-sm btn-success" href="{{ route('users.edit', [app()->getLocale(), $user->id]) }}"> {{ __('Edit') }}</a>

                                                    <a class="btn btn-info"
                                                    href="{{ route('users.card', [app()->getLocale(), 'userid'=>$user->id]) }}"
                                                    target="__blank"><i class="mdi  mdi-account-card-details"></i></a>
                                                    <a href="{{ route('users.inventaroneuser', [app()->getLocale(), $user->id]) }}"
                                                        rel="noopener" target="_blank" class="btn-sm btn btn-success "
                                                        target="__blank"><i class="mdi mdi-18px mdi-printer"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                                </form>
                                                @if (Auth::user()->hasRole('SuperAdmin'))
                                                    <br>
                                                    <form method="POST" action="{{ route('users.delete', [app()->getLocale(), 'id'=>$user->id]) }}">
                                                        @csrf
                                                        <input name="type" type="hidden" value="DELETE">
                                                        <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" >{{ __('Delete from DataBase') }}</button>
                                                    </form>                                                    
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        
                    </div>
                    @if ($data->count() > 0)
                        {!! $data->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection