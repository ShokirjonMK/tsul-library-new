@extends('layouts.app')

@section('template_title')
    {{ __('Cart') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Cart') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Cart') }}
                </p>
            </div>
            <div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-body">

                        @if ($carts != null && count($carts) > 0)
                            <div class="table-responsive">

                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>{{ __('Bibliographic record') }}</th>

                                            <th>{{ __('Book face image') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $k => $book)
                                            <tr data-id="{{ $k }}">
                                                <td>{{ $k }}</td>
                                                <td>
                                                    {!! \App\Models\Book::GetBibliographicById($k) !!}
                                                </td>
                                                <td>
                                                    @if ($book['image'])
                                                        <img src="/storage/{{ $book['image'] }}" width="100px">
                                                    @else
                                                        <img src="/book_no_photo.jpg" width="100px">
                                                    @endif
                                                </td>
                                                <td class="actions" data-th="">
                                                    <button class="btn btn-danger btn-sm remove-from-cart">{{ __('Delete') }}</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td>
                                                {!!__("You are ordering :attribute books",['attribute' => count($carts) ])!!}
                                            </td>
                                            <td> 
                                                <a href="{{ route('order', app()->getLocale()) }}" class="btn btn-block btn-success">{{__('Ordering')}}</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h1>{{ __('Cart is empty') }}</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".remove-from-cart").click(function(e) {
                e.preventDefault();

                var ele = $(this);

                if (confirm('{{ __('Are you sure want to remove?') }}')) {
                    $.ajax({
                        url: '{{ route('remove.from.cart', app()->getLocale()) }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr("data-id")
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endpush
