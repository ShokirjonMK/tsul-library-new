@foreach ($subcategories as $subcategory)
    <tr data-id="{{ $subcategory->id }}" data-parent="{{ $dataParent }}" data-level="{{ $dataLevel + 1 }}">
        <td></td>
        <td data-column="name">{{ $subcategory->udc_number }}</td>
        <td>{{ $subcategory->description }}</td>
        <td>{{ $subcategory->number_of_codes }}</td>
        <td>{{ $subcategory->notes }}</td>
        <td> 
            {!! $subcategory->parent ? $subcategory->parent->udc_number : '' !!}
        </td>
        <td>
            @if ($show)
            <form action="{{ route('udcs.destroy', [app()->getLocale(), $subcategory->id]) }}" method="POST">
                <a class="btn btn-sm btn-primary "
                    href="{{ route('udcs.show', [app()->getLocale(), $subcategory->id]) }}"> {{ __('Show') }}</a>
                <a class="btn btn-sm btn-success"
                    href="{{ route('udcs.edit', [app()->getLocale(), $subcategory->id]) }}"> {{ __('Edit') }}</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
            </form>               
            @endif
 
        </td>
    </tr>
    @if (count($subcategory->subcategory))
        @include('layouts.partials.subCategoryView', [
            'subcategories' => $subcategory->subcategory,
            'dataParent' => $subcategory->id,
            'dataLevel' => $dataLevel,
        ])
    @endif
@endforeach
