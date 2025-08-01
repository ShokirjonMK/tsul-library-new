<div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ __('Journal Articles') }}</h1>
                        <hr>
                        <div class="table-responsive">

                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th># ID</th>
                                        <th>{{ __('IsActive') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Published Year') }}</th>
                                        <th>{{ __('Resource language') }}</th>
                                        <th>{{ __('Resource Type') }}</th>
                                        <th>{{ __('Resource Field') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Full Text Path') }}</th>
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

                                            <td>{{ $magazineIssue->publication_year }}</td>
                                            <td>
                                                {!! $magazineIssue->resTypeLang ? $magazineIssue->resTypeLang->title : '' !!}
                                            </td>
                                            <td>
                                                {!! $magazineIssue->resType ? $magazineIssue->resType->title : '' !!}
                                            </td>
                                            <td>
                                                {!! $magazineIssue->resField ? $magazineIssue->resField->title : '' !!}
                                            </td>
                                            <td>
                                                @if ($magazineIssue->image_path)
                                                    <img src="{{ asset('/storage/scientificPublications/photo/' . $magazineIssue->image_path) }}"
                                                        width="100px">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($magazineIssue->file_path)
                                                    <a href="{{ asset('/storage/scientificPublications/full-text/' . $magazineIssue->file_path) }}"
                                                        target="__blank">{{ __('Download') }}</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('journal-articles.show', [app()->getLocale(), $magazineIssue->id]) }}">
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
