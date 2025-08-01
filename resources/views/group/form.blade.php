<div class="row">

    <div class="col-xl-8 col-lg-12">
        <div class="ec-cat-list card card-default">
            <div class="card-body">
                <div class="profile-content-right profile-right-spacing py-5">
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">
                        <div class="form-group">
                            {{ Form::label('title') }}
                            {{ Form::text('title', $group->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
                            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="ec-cat-list card card-default mb-24px">
            <div class="card-body">
                <div class="ec-cat-form">
                    @php
                        $isActive = 1;
                        if ($group->count() > 0 && isset($group->isActive)) {
                            $isActive = $group->isActive;
                        }
                        
                    @endphp

                    <div class="form-group row">

                        <label for="isActive" class="form-label">{{ __('isActive') }}</label>
                        <select class="form-select" id="isActive" name="isActive">
                            <option value='0' {{ $isActive ? '' : 'selected' }}>{{ __('Passive') }}</option>
                            <option value='1' {{ $isActive ? 'selected' : '' }}>{{ __('Active') }}</option>
                        </select>
                        @error('isActive')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <livewire:admin.references.org-br-dep-fac-chair :org_id="$group->organization_id" :branch_id="$group->branch_id" :faculty_id="$group->faculty_id"  :chair_id="$group->chair_id" />
                    
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
