  
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>{{__('Title')}}:</strong>
                                    {{ $document->title }}
                                </div>
                                <div class="form-group">
                                    <strong>{{__('Number')}}:</strong>
                                    {{ $document->number }}
                                </div>
                                <div class="form-group">
                                    <strong>{{__('Arrived Date')}}:</strong>
                                    {{ $document->arrived_date }}
                                </div>
                                
                                <div class="form-group">
                                    <strong>{{__('File')}}:</strong> 
                                    @if ($document->file)
                                        <a href="/storage/{{$document->file}}" target="__blank">{{__('Download')}}</a>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <strong>{{__('Consignment Note')}}:</strong>
                                    {{ $document->consignment_note }}
                                </div>
                                <div class="form-group">
                                    <strong>{{__('Act Number')}}:</strong>
                                    {{ $document->act_number }}
                                </div>
                                <div class="form-group">
                                    <strong>{{__('KSU')}}:</strong>
                                    {{ $document->ksu }}
                                </div>
                                <div class="form-group">
                                    <strong>{{__('Where')}}:</strong>
                                    {!! $document->where_id ? $document->where->title : '' !!}
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                            
                                <div class="form-group">
                                    <strong>{{ __('Organization') }}:</strong>
                                    {!! $document->organization_id ? $document->organization->title : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Branch') }}:</strong>
                                    {!! $document->branch_id ? $document->branch->title : '' !!}
                                </div>
                                {{-- <div class="form-group">
                                    <strong>Deportmetn Id:</strong>
                                    {{ $document->deportmetn_id }}
                                </div> --}}
                                <div class="form-group">
                                    <strong>{{__('Deed Date')}}:</strong>
                                    {{ $document->deed_date }}
                                </div>
                                {{-- <div class="form-group">
                                    <strong>{{__('Comment')}}:</strong>
                                    {{ $document->comment }}
                                </div>
                                 --}}
                                
                                <div class="form-group">
                                    <strong>{{ __('Created By') }}:</strong>
                                    {!! $document->created_by ? $document->createdBy->name : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Updated By') }}:</strong>
                                    {!! $document->updated_by ? $document->updatedBy->name : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Created At') }}:</strong>
                                    {{ $document->created_at  }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Updated At') }}:</strong>
                                    {{ $document->updated_at  }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Export to Word') }}:</strong>
                                    <a class="btn btn-sm btn-primary " href="{{ route('documents.word', [app()->getLocale(), $document->id]) }}"><i class="mdi  mdi-file-word"></i> {{ __('Download') }}</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>