<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookFileType;
use App\Models\BookInventar;
use App\Models\BookLanguage;
use App\Models\BooksType;
use App\Models\BookTakenWithoutPermission;
use App\Models\BookText;
use App\Models\BookTextType;
use App\Models\Debtor;
use App\Models\Subject;
use App\Models\User;
use App\Models\Where;
use App\Models\Who;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Uri\Http;
use Maatwebsite\Excel\Mixins\StoreCollection;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function books(Request $request)
    {

        $q = Book::query();

        $book_bookType_id=trim($request->get('book_type_id'));
        $book_bookLanguage_id=trim($request->get('book_language_id'));
        $book_bookText_id=trim($request->get('book_text_id'));
        $book_bookTextType_id=trim($request->get('book_text_type_id'));
        $book_access_type_id=trim($request->get('book_access_type_id'));
        $book_file_type_id=trim($request->get('book_file_type_id'));
        $book_subject_id=trim($request->get('book_subject_id'));
        $book_author_id=trim($request->get('book_author_id'));
        $status=trim($request->get('status'));
        $keyword=trim($request->get('keyword'));
        $book_subject_id=trim($request->get('book_subject_id'));
        $id=trim($request->get('id'));
        $isbn=trim($request->get('isbn'));
        $title=trim($request->get('title'));
        $location_index=trim($request->get('location_index'));

        $per_page = trim($request->get('per_page')) ?: 20;


        if ($book_bookType_id != null && $book_bookType_id>0)
        {
            $q->where('books_type_id', '=', $book_bookType_id);
        }

        if ($book_bookLanguage_id != null && $book_bookLanguage_id>0)
        {
            $q->where('book_language_id', '=', $book_bookLanguage_id);
        }
        if ($book_bookText_id != null && $book_bookText_id>0)
        {
            $q->where('book_text_id', '=', $book_bookText_id);
        }
        if ($book_bookTextType_id != null && $book_bookTextType_id>0)
        {
            $q->where('book_text_type_id', '=', $book_bookTextType_id);
        }
        if ($book_access_type_id != null && $book_access_type_id>0)
        {
            $q->where('book_access_type_id', '=', $book_access_type_id);
        }
        if ($book_file_type_id != null && $book_file_type_id>0)
        {
            $q->where('book_file_type_id', '=', $book_file_type_id);
        }

        // if ($book_subject_id != null && $book_subject_id>0)
        // {
        //     $show_accardion=true;
        //     $q->where('subject_id', '=', $book_subject_id);
        // }

        if ($book_subject_id != null && $book_subject_id>0)
        {

            $dc_subjects = \App\Models\BookSubject::GetTitleById($book_subject_id);
            $q->whereJsonContains('dc_subjects', $dc_subjects);
        }

        if ($book_author_id != null && $book_author_id>0)
        {
            $author = \App\Models\Author::GetTitleById($book_author_id);
            $q->whereJsonContains('dc_authors', $author);
        }
        if ($status != null)
        {
             if($status>2){
                if($status==3){
                    $q->where('full_text_path', '<>', "");
                }
                if($status==4){
                    $q->where('dc_source', '<>', "");
                }

            }else{
                $q->where('status', '=', $status);
            }
        }else{
            $status=1;
        }
        if($keyword != null){
            $q->where(function($query) use($keyword){
                $query->orWhere('dc_authors', 'LIKE', '%'.$keyword.'%');
            })
            ->orWhere('dc_title', 'LIKE', "%$keyword%")
            ->orWhere('dc_UDK', 'LIKE', "%$keyword%")
            ->orWhere('ISBN', 'LIKE', "%$keyword%")
            ->orWhere('published_year', 'LIKE', "%$keyword%")->orWhereHas('extraAuthorBooks', function ($query) use ($keyword) {
                if($keyword) {
                    $query->where('name', 'like', '%'.$keyword.'%');
                }
            });
        }

        if ($id != null && $id>0)
        {
            $q->where('id', '=', $id);
        }
        if ($isbn != null && $isbn>0)
        {
            $q->where('ISBN', 'LIKE', "%$isbn%");
        }
        if ($title != "")
        {
            $q->where('dc_title', 'LIKE', "%$title%");
        }
        if ($location_index != "")
        {
            $q->where('location_index', 'LIKE', "%$location_index%");
        }

        $stores = $q->with(['BooksType', 'BooksType.translations', 'BookLanguage', 'BookLanguage.translations'])->orderBy('id', 'desc')->paginate($per_page);
        // $stores = Book::active()->paginate(20);

        return response()->json($stores, 200);
    }

    public function booksshow($id){

        $book = Book::with(['bookInventar', 'BooksType', 'BooksType.translations', 'BookLanguage', 'BookLanguage.translations'])->find($id);
        return response()->json($book, 200);
    }

    public function booksrfid($rfid_tag_id){
        $q = BookInventar::query();
        if ($rfid_tag_id != "") {
            $q->where('rfid_tag_id', '=', $rfid_tag_id);
        }
        $bookInventar = $q->with(['book'])->orderBy('id', 'desc')->first();

//        $book = Book::with(['bookInventar', 'BooksType', 'BooksType.translations', 'BookLanguage', 'BookLanguage.translations'])->find($id);
        return response()->json($bookInventar, 200);
    }


    public function bookInventarByRfid($id){

        if($id=='E28068940000501A4F65C5AA'){
            return response()->json(true, 200);
        }else{
            return response()->json(false, 404);
        }
//        $bookInventar = BookInventar::find($id);
//        return response()->json($bookInventar, 200);
    }

    public function geInventarByRfidCode($id){
        $inventor = BookInventar::where('rfid_tag_id', $id)->first();
        if ($inventor){
            $bookBibliographics = Book::GetBibliographicById($inventor->book_id);
            return response()->json($bookBibliographics, 200);
        }else{
            return response()->json(false, 404);
        }
//        if($id=='E28068940000501A4F65C5AA'){
//            return response()->json(true, 200);
//        }else{
//            return response()->json(false, 404);
//        }
//        $bookInventar = BookInventar::find($id);
//        return response()->json($bookInventar, 200);
    }



    public function bookTypes()
    {
        $stores = BooksType::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function bookLanguages()
    {
        $stores = BookLanguage::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function bookTexts()
    {
        $stores = BookText::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function bookTextType()
    {
        $stores = BookTextType::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function bookFileTypes()
    {
        $stores = BookFileType::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function subjects()
    {
        $stores = Subject::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function whos()
    {
        $stores = Who::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function wheres()
    {
        $stores = Where::active()->paginate(20);

        return response()->json($stores, 200);
    }

    public function inventars(Request $request)
    {
        $from = trim($request->get('from'));
        $to = trim($request->get('to'));
        $inventar = trim($request->get('inventar'));
        $perPage = 20;
        $q = BookInventar::query();

        if (!empty($from) && !empty($to)) {
            $q->whereBetween('bar_code', [intval($from), intval($to)]);
        } elseif (!empty($from)) {
            $q->where('bar_code', '=', $from);
        } elseif (!empty($to)) {
            $q->where('bar_code', '=', $to);
        }

        if ($inventar != "") {
            $q->where('inventar_number', '=', $inventar);
        }

//        $current_roles = Auth::user()->getRoleNames()->toArray();
//        $current_user = Auth::user()->profile;
//        if($current_user != null){
//            $q->where('organization_id', '=', $current_user->organization_id);
//        }

        $stores= $q->with(['book', 'organization', 'organization.translations', 'branch', 'branch.translations', 'department', 'department.translations'])->orderBy('id', 'desc')->paginate($perPage);



        // return view('book.inventar', compact('barcodes', 'from', 'to', 'inventar'));
        // $stores = BookInventar::active()->with(['book'])->paginate(20);
        return response()->json($stores, 200);
    }

    public function usersrfid($rfid_tag_id){

        $q = User::query();
        if ($rfid_tag_id != "") {
            $q->where('rfid_tag_id', '=', $rfid_tag_id);
        }
        $user = $q->with(['profile', 'activeDebtors', 'activeDebtors.book'])->orderBy('id', 'desc')->first();

//        $book = Book::with(['bookInventar', 'BooksType', 'BooksType.translations', 'BookLanguage', 'BookLanguage.translations'])->find($id);
        return response()->json($user, 200);
    }

    public function addBookDebtors(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer|exists:users,id',
            'books'  => 'required|array|min:1',
            'books.*.bookId' => 'required|integer|exists:books,id',
            'books.*.inventarNumberId' => 'required|integer|exists:book_inventars,id',
            'books.*.bookInformationId' => 'required|integer|exists:book_informations,id',
            'books.*.days'   => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors'  => $validator->errors()
            ], 422);
        }
        $user = User::find($request->get('userId'));

        if ($user == null){
            return response()->json([
                'message' => 'User not found',
                'errors'  => "bad requesr"
            ], 400);
        }

        $finalArray = array();
        $branch_id = null;
        $department_id = null;
        if ($user->profile) {
            $branch_id = $user->profile->branch_id;
            $department_id = $user->profile->department_id;
        }
        $books = $request->get('books');


        foreach ($books as $key => $value) {
            $qaytarish_vaqti = strtotime(date("Y-m-d") . "+ " . $value['days'] . " days");
            array_push(
                $finalArray,
                array(
                    'status' => Debtor::$GIVEN,
                    'taken_time' => date("Y-m-d"),
                    'return_time' => date("Y-m-d", $qaytarish_vaqti),
                    'count_prolong' => 1,
                    'how_many_days' => $value['days'],
                    'reader_id' => $user->id,
                    'book_id' => $value['bookId'],
                    'book_information_id' => $value['bookInformationId'],
                    'book_inventar_id' => $value['inventarNumberId'],
                    'branch_id' => $branch_id,
                    'department_id' => $department_id,
                    'created_at' =>  \Carbon\Carbon::now(),
                    'created_by' =>  $user->id,
                )
            );
            BookInventar::changeStatus($value['inventarNumberId'], BookInventar::$GIVEN);
        };
        $debtors = Debtor::insert($finalArray);
        // If validation passes:
        return response()->json([
            'message' => 'saved',
            'data' => $debtors
        ], 200);

    }


    public function accept(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer|exists:users,id',
            'debtorId' => 'required|integer|exists:debtors,id',
            'inventarNumberId' => 'required|integer|exists:book_inventars,id',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors'  => $validator->errors()
            ], 422);
        }
        $user = User::find($request->get('userId'));

        $debtor = Debtor::find($request->get('debtorId'));

        if ($debtor != null) {
            $debtor->status = Debtor::$TAKEN;
            $debtor->returned_time = date("Y-m-d");
            $debtor->updated_at  = \Carbon\Carbon::now();
            $debtor->updated_by = $user->id;
            $debtor->save();
            \App\Models\BookInventar::changeStatus($request->get('inventarNumberId'), BookInventar::$ACTIVE);
            $debtors = Debtor::where('reader_id', '=', $user->id)->where('status', '=', Debtor::$GIVEN)->orderBy('return_time',  'ASC')->get();
            return response()->json([
                'message' => 'saved',
                'data' => $debtors
            ], 200);
        }

        return response()->json([
            'message' => 'saved',
            'data' => "Qarzdorlik yo'q"
        ], 400);

    }

    public function acceptByRfid(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rfid_tag_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors'  => $validator->errors()
            ], 422);
        }

        $inventar = BookInventar::where('rfid_tag_id','=',$request->get('rfid_tag_id'))->first();
        if ($inventar==null){
            return response()->json([
                'message' => 'Book not found.',
                'errors'  => "Book not found."
            ], 404);
        }


        $debtorHas = Debtor::where('book_inventar_id', '=', $inventar->id)->whereNull('returned_time')->first();

        if ($debtorHas != null) {
            $debtor = Debtor::find($debtorHas->id);
            $debtor->status = Debtor::$TAKEN;
            $debtor->returned_time = date("Y-m-d");
            $debtor->updated_at  = \Carbon\Carbon::now();
            $debtor->save();
            \App\Models\BookInventar::changeStatus($debtor->book_inventar_id, BookInventar::$ACTIVE);
            return response()->json([
                'message' => 'saved',
                'data' => "success"
            ], 200);
        }

        return response()->json([
            'message' => 'not saved',
            'data' => "Kitob berilgani yo'q"
        ], 200);

    }


    public function takenBookWithoutPermission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rfid_tag_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors'  => $validator->errors()
            ], 422);
        }

        $inventar = BookInventar::where('rfid_tag_id','=',$request->get('rfid_tag_id'))->where('isActive', '!=', BookInventar::$GIVEN)->first();

        if ($inventar==null){
            return response()->json([
                'message' => 'Book not found.',
                'errors'  => "Book not found."
            ], 404);
        }

        $data = [];
        $data['bar_code'] = $inventar->bar_code;
        $data['rfid_tag_id'] = $inventar->rfid_tag_id;
        $data['book_id'] = $inventar->book_id;
        $data['book_information_id'] = $inventar->book_information_id;
        $data['book_inventar_id'] = $inventar->id;
        $data['organization_id'] = $inventar->organization_id;
        $data['branch_id']  = $inventar->branch_id;
        $data['deportmetn_id'] = $inventar->deportmetn_id;

        $bookTakenWithoutPermission = BookTakenWithoutPermission::create($data);

        return response()->json([
            'message' => 'saved',
            'data' => $bookTakenWithoutPermission
        ], 200);


    }



}
