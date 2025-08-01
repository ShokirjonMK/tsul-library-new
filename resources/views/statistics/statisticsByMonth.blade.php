@extends('layouts.app')

@section('template_title')
    {{ __('Books Type') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1> {{ __('Books Type') }} buyicha xizmat ko'rsatish</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>ARMda foydalanuvchilarga xizmat ko'rsatish buyicha statistikasi
                </p>
            </div>
 
        </div>

        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">

                    <div class="card-header">
                        <form action="{{ route('admin.statistics-by-month', app()->getLocale()) }}" method="GET"
                            accept-charset="UTF-8" role="search" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group input-daterange">
                                        <input type="text" class="form-control" required readonly id="month" name="month" placeholder="{{ __('Month') }}..." value="{{ $month }}" >
                                        <div class="input-group-addon" style="margin: auto 11px;">{{ __('Month') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>

                                <a href="{{ route('admin.statistics-by-month', app()->getLocale()) }}"
                                    class="btn btn-sm btn-info ">{{ __('Clear') }}</a>

                            </div>
                        </form>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('Title') }}</th>
                                         
                                    </tr>
                                </thead>
                                <tbody>
                                     
                                </tbody>
                            </table>

                        </div>

                        <div class="clear"></div>
                        {{-- @if ($booksTypes->count() > 0)
                            {!! $booksTypes->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .table-condensed thead tr:nth-child(2),
.table-condensed tbody {
  display: none
}
    </style>
@endsection


@push('scripts')
 
    <script>
        $(document).ready(function() {
            $('input[name="month"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="month"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('input[name="month"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
            // $('#month').daterangepicker({
            //     singleDatePicker: true,
            //     showDropdowns: true,
            //           minView: 'months',
            //     maxView: 'years',
            //     minYear: 2023, // optional

            //     locale: {
            //         format: 'MM/YYYY'
            //     }
            // });

            // // Event listener for when the selection changes
            // $('#month').on('apply.daterangepicker', function(ev, picker) {
            //     console.log(ev);
            //     console.log(picker);
            //     $(this).val(picker.startDate.format('MM/YYYY'));
            // });
            // $('#month').daterangepicker({
            //     singleDatePicker: true,
            //     showDropdowns: true,
            //     format: 'MM/YYYY',
            //     minView: 'months',
            //     maxView: 'years',
            //     startDate: moment().startOf('month'), // Optional: set default start date to current month
            //     endDate: moment().endOf('month') // Optional: set default end date to current month
            // });
            // $('#month').on('apply.daterangepicker', function(ev, picker) {
            //     $(this).val(picker.startDate.format('MM/YYYY'));
            // });
            // $('input[id="month"]').daterangepicker({
            // singleDatePicker: true,
            // showDropdowns: true,
            // format: 'YYYY-MM-DD'
            // }).on('hide.daterangepicker', function (ev, picker) {
            // $('.table-condensed tbody tr:nth-child(2) td').click();
            //    console.log(picker.startDate.format('YYYY-MM-DD'));
            // });
        });
    </script>
@endpush
