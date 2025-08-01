<div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ __('Magazine Issue') }}</h1>
                        <hr>
                        <div class="table-responsive">

                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th># ID</th>
                                        <th>{{ __('IsActive') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Published Year') }}</th>
                                        <th>{{ __('fourth_number') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Full Text Path') }}</th>
                                        <th>{{ __('Betlar Soni') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($magazineIssues as $magazineIssue)
                                        <tr>
                                            <td>{{ $magazineIssue->id }}</td>
                                            <td>{!! $magazineIssue->isActive == 1
                                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{{ $magazineIssue->title }}</td>

                                            <td>{{ $magazineIssue->published_year }}</td>
                                            <td>{{ $magazineIssue->fourth_number }}</td>

                                            <td>
                                                @if ($magazineIssue->image_path)
                                                    <img src="{{ asset('/storage/magazineIssues/photo/' . $magazineIssue->image_path) }}"
                                                        width="100px">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($magazineIssue->full_text_path)
                                                    <a href="{{ asset('/storage/magazineIssues/full-text/' . $magazineIssue->full_text_path) }}"
                                                        target="__blank">{{ __('Download') }}</a>
                                                @endif
                                            </td>


                                            <td>{{ $magazineIssue->betlar_soni }}</td>
                                            <td>{{ $magazineIssue->price }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('magazine-issues.show', [app()->getLocale(), $magazineIssue->id]) }}">
                                                    {{ __('Show') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($magazineIssues->count() > 0)
                            {!! $magazineIssues->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                        {{-- @if ($magazineIssues->count() > 0)
                            {!! $magazineIssues->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
