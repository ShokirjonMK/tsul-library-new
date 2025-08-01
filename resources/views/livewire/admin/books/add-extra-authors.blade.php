<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="col-md-12">
        @if (count($errors) > 0) 
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <ul style="list-style-type:none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($updateMode)
            @include('livewire.admin.books.partials.author.update-book-author')
        @else
            @include('livewire.admin.books.partials.author.create-book-author')
        @endif

        
        <div class="col-12 col-sm-12 col-lg-12">

            @if ($extraAuthors->count() > 0)
                <div class="table-responsive">
    
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th>No </th>
                                <th>{{ __('Extra Author') }}</th>
                                <th>{{ __('Author') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($extraAuthors as $k => $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>{!! $item->extra_author_id ? $item->extraAuthor->title : '' !!}</td>
                                    <td>
                                        {{ $item->name }}
                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-success" wire:click="edit({{ $item->id }})"> {{ __('Edit') }}</button>
                                            <button class="btn btn-danger btn-sm" wire:click="destroy({{ $item->id }})">{{ __('Delete') }}</button> 
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <br>
                <hr>
            @endif
        </div>

    </div>
</div>
