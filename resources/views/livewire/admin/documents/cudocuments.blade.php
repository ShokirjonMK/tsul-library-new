<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body"> 
                    <div class="ec-cat-form">
                        <div class="form-group">
                            {{ Form::label(__('Title')) }} 
                            <input class="form-control" placeholder="{{__('Title')}}" wire:model.defer="title", name="title" type="text" value="{{$title}}">
                            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Number')) }}
                            <input class="form-control" placeholder="{{__('Number')}}" wire:model.defer="number", name="title" type="text" value="{{$number}}">

                            {!! $errors->first('number', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Arrived Date')) }}
                            <input class="form-control" placeholder="{{__('Arrived Date')}}" name="arrived_date" type="date" wire:model.defer="arrived_date" value="{{$arrived_date}}">
                            {!! $errors->first('arrived_date', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Deed Date')) }}
                            <input class="form-control" placeholder="{{__('Deed Date')}}" name="deed_date" type="date" wire:model.defer="deed_date" value="{{$deed_date}}">
                            {!! $errors->first('deed_date', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="where_id">{{ __('Where') }}</label>
                            <select autocomplete="off" id="where_id"  name="where_id" wire:model.defer="where_id" class=" form-select form-control" >
                                <option value="0">{{ __('Choose') }}</option>
                                @foreach ($wheres as $k => $v)
                                    @if ($k==$document->where_id)
                                        <option value="{{ $k }}" selected="selected"  >{{ $v }}</option>
                                    @else
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {!! $errors->first('where_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
    
                        <div class="form-group">
                            <input type="file" wire:model.defer="file" >
                                <div wire:loading wire:target="file">{{ __('Uploading') }}...</div>

                            @if ($document->file)
                                <br>
                                <strong>{{__('Book file')}}:</strong> 
                                <a href="/storage/{{$old_full_text_path}}" target="__blank">{{__('Download')}}</a>
                            @endif

                            {{-- @if ($document->file)
                                <input type="file" name="file" class='form-control'
                                    value="{{ $document->file }}" />
                                <a href="/storage/{{ $document->file }}" target="__blank">{{ __('Download') }}</a>
                            @else
                                <input type="file" name="file" wire:model="file" class='form-control' />
                            @endif --}}
                            {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
    
                        <div class="form-group">
                            {{ Form::label(__('Consignment Note')) }}
                            <input class="form-control" placeholder="{{__('Consignment Note')}}" wire:model.defer="consignment_note", name="consignment_note" type="text" value="{{$consignment_note}}">

                            {!! $errors->first('consignment_note', '<div class="invalid-feedback">:message</div>') !!}
                        </div> 
                        <div class="form-group">
                            {{ Form::label(__('Act Number')) }}
                            <input class="form-control" placeholder="{{__('Act Number')}}" wire:model.defer="act_number", name="act_number" type="text" value="{{$act_number}}">
                            {!! $errors->first('act_number', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('KSU')) }} {{$ksu}}
                            <input class="form-control" placeholder="{{__('KSU')}}" wire:model.defer="ksu", name="ksu" type="text" value="{{$ksu}}">

                            {!! $errors->first('ksu', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Comment')) }}
                            <textarea class="form-control" placeholder="{{__('Comment')}}" name="comment" cols="50" rows="10" wire:model.defer="comment"></textarea>

                            {!! $errors->first('comment', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="box-footer mt20">
                        <button type="button" wire:click.prevent="update()" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    
    
    
    </div>
    
</div>
