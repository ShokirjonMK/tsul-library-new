<div>
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
            @include('livewire.admin.books.partials.update-book-acts')
        @else
            @include('livewire.admin.books.partials.create-book-acts')
        @endif
        <table class="table table-striped" style="margin-top:20px;">
            <tr>
                <td>NO</td>
                <td>{{ __('Where') }}</td>
                <td>{{ __('Arrived Year') }}</td>
                <td>{{ __('Summarka Raqam') }}</td>
                <td>{{ __('Price') }} ({{ __('Contract price') }}) </td>
                <td></td>
            </tr>
 
            @foreach ($book_acts as $row)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $row->wheres->title }}</td>
                    <td>{{ $row->arrived_year }}</td>
                    <td>{{ $row->summarka_raqam }}</td>
                    <td>{{ $row->price }}</td>
                    <td>
                        <button wire:click="edit({{ $row->id }})"
                            class="btn btn-sm btn-outline-danger py-0">{{ __('Edit') }}</button> 
                            @if (in_array('SuperAdmin', $this->roles))
                                |
                                <button wire:click="destroy({{ $row->id }})"
                                    class="btn btn-sm btn-outline-danger py-0">{{ __('Delete') }}</button>
                            @endif
                
                            

                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    @if ($book_acts->count()==0)
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <ul style="list-style-type:none;">
                <li>{{__("Please enter the summarca information so that the data is displayed correctly")}}!!!</li>
            </ul>
        </div>
    @endif
    <hr> 
    <livewire:admin.books.add-book-data :book_id="$book->id" />
</div>
