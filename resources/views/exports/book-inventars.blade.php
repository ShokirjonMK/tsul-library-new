<table>
    <thead>
    <tr>
        <th>id</th>
        <th>{{__('Bibliographic record')}}</th>
        <th>{{__('Created At')}}</th>
        <th>{{__('Inventar Numbers')}}</th>
        <th>{{__('Copies')}}</th>
        <th>{{__('Price')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr>
            <td>{{ $loop->iteration }}) </td>
            <td>  {!! \App\Models\Book::GetBibliographicById($book->id) !!}</td>
            <td> 
                @if ($book->created_at != null)
                    {{ \Carbon\Carbon::parse($book->created_at)->format('Y-d-m')}} 
                @endif
            
            </td>
            <td>
                {!! \App\Models\BookInventar::GetInventarsByBookId($book->id) !!}
            </td>
            <td>{!! \App\Models\BookInventar::GetInventarsCountByBookId($book->id) !!}</td>
            <td>{{$book->price}} </td>
        </tr>
    @endforeach
    </tbody>
</table>