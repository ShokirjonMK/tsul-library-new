<?php

namespace App\Exports;

use App\Models\Book;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Illuminate\Support\Facades\Auth;


class ExportBooks implements FromCollection, WithMapping, WithHeadings
{

    use Exportable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $request = $this->request['request'];
        $q = Book::query();

        $organization_id = trim(isset($request['organization_id']) ? $request['organization_id'] : "");
        $dc_date = trim(isset($request['dc_date']) ? $request['dc_date'] : "");
        $book_bookType_id = trim(isset($request['book_type_id']) ? $request['book_type_id'] : "");
        $book_bookLanguage_id = trim(isset($request['book_language_id']) ? $request['book_language_id'] : "");
        $book_bookText_id = trim(isset($request['book_text_id']) ? $request['book_text_id'] : "");
        $book_bookTextType_id = trim(isset($request['book_text_type_id']) ? $request['book_text_type_id'] : "");
        $book_access_type_id = trim(isset($request['book_access_type_id']) ? $request['book_access_type_id'] : "");
        $book_file_type_id = trim(isset($request['book_file_type_id']) ? $request['book_file_type_id'] : "");
        $fields_science_id = trim(isset($request['fields_science_id']) ? $request['fields_science_id'] : "");

        $book_author_id = trim(isset($request['book_author_id']) ? $request['book_author_id'] : "");
        $status = trim(isset($request['status']) ? $request['status'] : "");
        $keyword = trim(isset($request['keyword']) ? $request['keyword'] : "");
        $book_subject_id = trim(isset($request['book_subject_id']) ? $request['book_subject_id'] : "");
        $id = trim(isset($request['id']) ? $request['id'] : "");
        $isbn = trim(isset($request['isbn']) ? $request['isbn'] : "");
        $title = trim(isset($request['title']) ? $request['title'] : "");
        $muallif = trim(isset($request['muallif']) ? $request['muallif'] : "");
        $location_index = trim(isset($request['location_index']) ? $request['location_index'] : "");
        $perPage = 20;

        $current_user = Auth::user()->profile;


        if ($book_bookType_id != null && $book_bookType_id > 0) {
            $q->where('books_type_id', '=', $book_bookType_id);
        }

        if ($organization_id != null && $organization_id > 0) {

            $q->where('organization_id', '=', $organization_id);
        } else {
            $organization_id = $current_user->organization_id;
            $q->where('organization_id', '=', $organization_id);
        }

        if ($book_bookLanguage_id != null && $book_bookLanguage_id > 0) {

            $q->where('book_language_id', '=', $book_bookLanguage_id);
        }

        if ($dc_date != null && $dc_date > 0) {
            $q->where('dc_date', '=', $dc_date);
        }
        if ($book_bookText_id != null && $book_bookText_id > 0) {
            $q->where('book_text_id', '=', $book_bookText_id);
        }
        if ($book_bookTextType_id != null && $book_bookTextType_id > 0) {
            $q->where('book_text_type_id', '=', $book_bookTextType_id);
        }
        if ($book_access_type_id != null && $book_access_type_id > 0) {
            $q->where('book_access_type_id', '=', $book_access_type_id);
        }
        if ($book_file_type_id != null && $book_file_type_id > 0) {
            $q->where('book_file_type_id', '=', $book_file_type_id);
        }

        if ($book_subject_id != null && $book_subject_id > 0) {
            $q->where('subject_id', '=', $book_subject_id);
        }

        if ($fields_science_id != null && $fields_science_id > 0) {
            $dc_subjects = \App\Models\BookSubject::GetTitleById($fields_science_id);
            $q->whereJsonContains('dc_subjects', $dc_subjects);
        }

        if ($book_author_id != null && $book_author_id > 0) {
            $author = \App\Models\Author::GetTitleById($book_author_id);
            $q->whereJsonContains('dc_authors', $author);

        }

        if ($status != null) {

            if ($status > 2) {
                if ($status == 3) {
                    $q->where('full_text_path', '<>', "");
                }
                if ($status == 4) {
                    $q->where('dc_source', '<>', "");
                }

            } else {
                $q->where('status', '=', $status);
            }
        } else {
            $status = 1;
        }
        if ($keyword != null) {
            $q->where(function ($query) use ($keyword) {
                $query->orWhere('dc_authors', 'LIKE', '%' . $keyword . '%');
            })
                ->orWhere('dc_title', 'LIKE', "%$keyword%")
                ->orWhere('location_index', 'LIKE', "%$keyword%")
                ->orWhere('dc_UDK', 'LIKE', "%$keyword%")
                ->orWhere('dc_BBK', 'LIKE', "%$keyword%")
                ->orWhere('ISBN', 'LIKE', "%$keyword%")
                ->orWhere('extra1', 'LIKE', "%$keyword%")
                ->orWhere('dc_description', 'LIKE', "%$keyword%")
                ->orWhere('published_year', 'LIKE', "%$keyword%")
                ->orWhereHas('extraAuthorBooks', function ($query) use ($keyword) {
                    if ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    }
                });
        }

        if ($id != null && $id > 0) {
            $q->where('id', '=', $id);
        }
        if ($isbn != null && $isbn > 0) {
            $q->where('ISBN', 'LIKE', "%$isbn%");
        }
        if ($title != "") {
            $q->where('dc_title', 'LIKE', "%$title%");
        }
        if ($muallif != "") {
            $q->where('extra1', 'LIKE', "%$muallif%")
                ->orWhere(function ($query) use ($muallif) {
                    $query->orWhere('dc_authors', 'LIKE', '%' . $muallif . '%');
                });
        }

        if ($location_index != "") {
            $q->where('location_index', 'LIKE', "%$location_index%");
        }

//        $books = $q->orderBy('id', 'desc')->get();
        //        echo "*******************************<br>";
        //        echo $fields_science_id;
        //        echo "*******************************<br>";
        //
//        dd($books);
        return $q->orderBy('id', 'desc')->get();
        //        return Book::all();
    }

    public function map($book): array
    {
        $auhtor = "";
        if ($book->dc_authors) {
            foreach (json_decode($book->dc_authors) as $key => $value) {
                $auhtor .= $value . ', ';
            }
        }


        return [
            $book->id,
            $book->dc_BBK,
            $book->dc_UDK,
            rtrim($auhtor, ', '),
            $book->dc_title,
            $book->books_type_id ? $book->booksType->title : '',
            $book->bookLanguage ? $book->bookLanguage->title : '',
            $book->published_year,
            $book->dc_publisher,
            $book->price,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Id',
            __('Dc BBK'),
            __('Dc UDK'),
            __('Dc Authors'),
            __('Dc Title'),
            __('Books Type'),
            __('Book Language'),
            __('Published Year'),
            __('Dc Publisher'),
            __('Price')
        ];
    }
}
