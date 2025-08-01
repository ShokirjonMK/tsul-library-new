<?php

namespace App\Http\Livewire\Admin\Documents;

use App\Models\Basic;
use App\Models\BookLanguage;
use App\Models\BookText;
use App\Models\GenType;
use App\Models\Publisher;
use App\Models\Resource;
use App\Models\ResourcesDocument;
use App\Models\Where;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

class CrudDocuments extends Component
{
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $title, $number, $date, $file, $comment, $consignment_note, $act_number, $ksu, $organization_id, $branch_id, $deportmetn_id;

    public $users, $name, $email, $user_id, $resId, $totalPrice = 0, $totalCopies = 0;

    public $document_id, $resTitle, $resAuthors, $type_id, $publisher_id, $published_year, $published_city, $copies, $price, $status, $resConsignment_note, $resAct_number, $resKsu, $who_id, $where_id, $basic_id, $resComment;
    public $resTypes, $resPublishers, $resWheres, $resBasics;
    public $resourceDocuments, $perPage = 20, $resDocId, $resDocRealId, $book_language_id, $bookLanguage, $book_text_id, $bookTexts;
    public $updateMode = false, $taken_into_account = true;


    private function resetInputFields()
    {
        $this->date = null;
        $this->number = '';
        $this->resTitle = '';
        $this->resAuthors = '';
        $this->published_year = null;
        $this->published_city = null;
        $this->copies = null;
        $this->price = null;
        $this->publisher_id = null;
        $this->type_id = null;
        $this->where_id = null;
        $this->basic_id = null;
    }

    public function mount($document_id)
    {
        $this->document_id = $document_id;


        $user = Auth::user()->profile;
        if ($user != null) {
            $this->organization_id = $user->organization_id;
            $this->branch_id = $user->branch_id;
            $this->deportmetn_id = $user->department_id;
        }
    }

    public function render()
    {
        $this->resTypes = GenType::with('translations')->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->resPublishers = Publisher::with('translations')->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->resWheres = Where::with('translations')->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->resBasics = Basic::with('translations')->active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookLanguage = BookLanguage::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $this->bookTexts = BookText::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $resDocuments = ResourcesDocument::with(['resource', 'document', 'resource.genType', 'resource.genType.translations', 'resource.publisher', 'resource.publisher.translations', 'resource.basic', 'resource.basic.translations', 'resource.where', 'resource.where.translations'])->where('document_id', '=', $this->document_id)->orderBy('id', 'desc')->paginate($this->perPage);

        $totalPriceWithDoc = DB::table('resources_documents')
            ->select(DB::raw('SUM(resources.price * resources.copies) AS total'))
            ->join('resources', 'resources.id', '=', 'resources_documents.resource_id')
            ->where('resources_documents.document_id', '=', $this->document_id)
            ->get();

        if ($totalPriceWithDoc[0] != null) {
            $this->totalPrice = number_format($totalPriceWithDoc[0]->total, 2, '.', ' ');
        }
        $totalCopiesWithDoc = DB::table('resources_documents')
            ->select(DB::raw('SUM(resources.copies) AS total'))
            ->join('resources', 'resources.id', '=', 'resources_documents.resource_id')
            ->where('resources_documents.document_id', '=', $this->document_id)
            ->get();
        if ($totalCopiesWithDoc[0] != null) {
            $this->totalCopies = number_format($totalCopiesWithDoc[0]->total);
        }

        $data = [
            'resDocuments' => $resDocuments,
        ];
        return view('livewire.admin.documents.crud-documents', $data);
    }


    public function store()
    {

        $this->validate(
            [
                'resTitle' => 'required',
                'copies' => 'required',
                'price' => 'required',
            ],
            [
                'resTitle.required' =>  __('The :attribute field is required.'),
                'copies.required' =>  __('The :attribute field is required.'),
                'price.required' =>  __('The :attribute field is required.'),
            ],
            [
                'resTitle' => __('Book Title'),
                'copies' => __('Copies'),
                'price' => __('Price'),
            ]
        );

        $type_id = GenType::GetOrCreate($this->type_id);
        $publisher_id = Publisher::GetOrCreate($this->publisher_id);
        $where_id = Where::GetOrCreate($this->where_id);
        $basic_id = Basic::GetOrCreate($this->basic_id);

        $input = [
            'status' => true,
            'title' => $this->resTitle,
            'authors' => $this->resAuthors,
            'type_id' => $type_id,
            'publisher_id' => $publisher_id,
            'published_year' => $this->published_year,
            'published_city' => $this->published_city,
            'copies' => $this->copies,
            'price' => $this->price,
            'where_id' => $where_id,
            'basic_id' => $basic_id,

            'organization_id' => $this->organization_id,
            'book_language_id' => $this->book_language_id,
            'book_text_id' => $this->book_text_id,
            'organization_id' => $this->organization_id,
            'branch_id' => $this->branch_id,
            'deportmetn_id' => $this->deportmetn_id,
            'taken_into_account' => $this->taken_into_account,
        ];


        DB::beginTransaction();
        try {
            $resource = Resource::create($input);
            ResourcesDocument::create([
                'resource_id' => $resource->id,
                'document_id' => $this->document_id,
            ]);

            DB::commit();
            $this->alert('success',  __('Successfully saved'));

            $this->resetInputFields();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function edit($id)
    {
        $resDoc = ResourcesDocument::findOrFail($id);
        $this->resDocId = $id;
        $this->resTitle = $resDoc->resource->title;
        $this->resAuthors = $resDoc->resource->authors;
        $this->published_year = $resDoc->resource->published_year;
        $this->published_city = $resDoc->resource->published_city;
        $this->copies = $resDoc->resource->copies;
        $this->price = $resDoc->resource->price;
        $this->type_id = $resDoc->resource->type_id;
        $this->publisher_id = $resDoc->resource->publisher_id;
        $this->where_id = $resDoc->resource->where_id;
        $this->basic_id = $resDoc->resource->basic_id;
        $this->book_language_id = $resDoc->resource->book_language_id;
        $this->book_text_id = $resDoc->resource->book_text_id;
        if ($resDoc->resource->taken_into_account == 0) {

            $this->taken_into_account = false;
        } else {
            $this->taken_into_account = $resDoc->resource->taken_into_account;
        }

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate(
            [
                'resTitle' => 'required',
                'copies' => 'required',
                'price' => 'required',
            ],
            [
                'resTitle.required' =>  __('The :attribute field is required.'),
                'copies.required' =>  __('The :attribute field is required.'),
                'price.required' =>  __('The :attribute field is required.'),
            ],
            [
                'resTitle' => __('Book Title'),
                'copies' => __('Copies'),
                'price' => __('Price'),
            ]
        );

        if ($this->resDocId) {

            $type_id = GenType::GetOrCreate($this->type_id);
            $publisher_id = Publisher::GetOrCreate($this->publisher_id);
            $where_id = Where::GetOrCreate($this->where_id);
            $basic_id = Basic::GetOrCreate($this->basic_id);


            $input = [
                'status' => true,
                'title' => $this->resTitle,
                'authors' => $this->resAuthors,
                'type_id' => $type_id,
                'publisher_id' => $publisher_id,
                'published_year' => $this->published_year,
                'published_city' => $this->published_city,
                'taken_into_account' => $this->taken_into_account,
                'copies' => $this->copies,
                'price' => $this->price,
                'where_id' => $where_id,
                'basic_id' => $basic_id,

                'organization_id' => $this->organization_id,
                'organization_id' => $this->organization_id,
                'branch_id' => $this->branch_id,
                'deportmetn_id' => $this->deportmetn_id,
            ];

            $record = Resource::findOrFail($this->resDocId);

            $record->update($input);
            $this->updateMode = false;
            $this->alert('success',  __('Successfully saved'));
            $this->resetInputFields();
            return redirect()->to(app()->getLocale() . '/admin/documents/' . $this->document_id);
        }
    }



    public function deleteRes($resId, $resDocId)
    {

        $this->resId = $resId;
        $this->resDocRealId = $resDocId;
    }

    public function delete()
    {
        Resource::find($this->resId)->delete();
        ResourcesDocument::find($this->resDocRealId)->delete();

        // if (Auth::user()->hasRole('SuperAdmin')) {
        //     BookInventar::find($this->deleteId)->delete();
        //     $this->alert('success',  __('Successfully deleted'));
        // }
    }
}
