<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\ResourcesDocument;
use App\Models\Where;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class DocumentController
 * @package App\Http\Controllers
 */
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language, Request $request)
    {
        $perPage = 20;
        $type = trim($request->get('type'));
         
        $from = trim($request->get('from'));
        $to = (trim($request->get('to')))?trim($request->get('to')):date('Y-m-d');

        $q = Document::query();
        if($from != null && $to!=null){
            // $startMonth = Carbon::createFromFormat('Y-m-d', $from);
            // $endMonth = Carbon::createFromFormat('Y-m-d', $to);
    
            $q->whereBetween(DB::raw('DATE(arrived_date)'), [$from, $to]);
        }
        
        $documents = $q->orderBy('id', 'desc')->paginate($perPage);
        return view('document.index', compact('documents', 'from', 'to', 'request', 'type'))
            ->with('i', (request()->input('page', 1) - 1) * $documents->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $document = new Document();
        $wheres = Where::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('document.create', compact('document', 'wheres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Document::rules());

       
       
        $document = Document::create(Document::GetData($request));
        
        toast(__('Created successfully.'), 'success');
                        

        return redirect()->route('documents.show', [app()->getLocale(), $document->id]);

        // return redirect()->route('documents.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $document = Document::find($id);
        
        return view('document.show', compact('document'));
    }

    public function bymonth($language, Request $request)
    {
        $document_name= 'Dalolatnoma_' . date('Y_m_d_H_i_s') . '.doc';
        $type = $request->get('type');
        
        $from = trim($request->get('from'));
        $to = (trim($request->get('to')))?trim($request->get('to')):date('Y-m-d');
        
        $q = Document::query();
        if($from != null && $to!=null){
            // $startMonth = Carbon::createFromFormat('Y-m-d', $from);
            // $endMonth = Carbon::createFromFormat('Y-m-d', $to);
    
            $q->whereBetween(DB::raw('DATE(arrived_date)'), [$from, $to]);
        }
        $documents = $q->orderBy('id', 'desc')->get();
        
        if($documents){
            if($type==1){
                return view('document.word-month', compact('documents', 'document_name'));
            }
            //     $resDocuments = ResourcesDocument::with(['resource', 'document', 'resource.genType', 'resource.genType.translations', 'resource.publisher', 'resource.publisher.translations', 'resource.basic', 'resource.basic.translations', 'resource.where', 'resource.where.translations'])->where('document_id', '=', $document->id)->orderBy('id', 'desc')->get();
            dd($documents);
        //     $totalPrice=0;
        //     $totalPriceWithDoc = DB::table('resources_documents')
        //         ->select(DB::raw('SUM(resources.price * resources.copies) AS total'))
        //         ->join('resources', 'resources.id', '=', 'resources_documents.resource_id')
        //         ->where('resources_documents.document_id', '=', $document->id)
        //         ->get();
    
        //     if ($totalPriceWithDoc[0] != null) {
        //         $totalPrice = number_format($totalPriceWithDoc[0]->total, 2, '.', ' ');
        //     }
        //     $totalCopiesWithDoc = DB::table('resources_documents')
        //         ->select(DB::raw('SUM(resources.copies) AS total'))
        //         ->join('resources', 'resources.id', '=', 'resources_documents.resource_id')
        //         ->where('resources_documents.document_id', '=', $document->id)
        //         ->get();
        //     $totalCopies=0;
        //     if ($totalCopiesWithDoc[0] != null) {
        //         $totalCopies = number_format($totalCopiesWithDoc[0]->total);
        //     }
    
        //     return view('document.word', compact('document', 'document_name', 'resDocuments'));
        }else{
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function word($language, $id)
    {
        $document_name= 'Dalolatnoma_' . date('Y_m_d_H_i_s') . '.doc';

        $document = Document::find($id);

        if($document){
            $resDocuments = ResourcesDocument::with(['resource', 'document', 'resource.genType', 'resource.genType.translations', 'resource.publisher', 'resource.publisher.translations', 'resource.basic', 'resource.basic.translations', 'resource.where', 'resource.where.translations'])->where('document_id', '=', $document->id)->orderBy('id', 'desc')->get();
            $totalPrice=0;
            $totalPriceWithDoc = DB::table('resources_documents')
                ->select(DB::raw('SUM(resources.price * resources.copies) AS total'))
                ->join('resources', 'resources.id', '=', 'resources_documents.resource_id')
                ->where('resources_documents.document_id', '=', $document->id)
                ->get();
    
            if ($totalPriceWithDoc[0] != null) {
                $totalPrice = number_format($totalPriceWithDoc[0]->total, 2, '.', ' ');
            }
            $totalCopiesWithDoc = DB::table('resources_documents')
                ->select(DB::raw('SUM(resources.copies) AS total'))
                ->join('resources', 'resources.id', '=', 'resources_documents.resource_id')
                ->where('resources_documents.document_id', '=', $document->id)
                ->get();
            $totalCopies=0;
            if ($totalCopiesWithDoc[0] != null) {
                $totalCopies = number_format($totalCopiesWithDoc[0]->total);
            }
    
            return view('document.word', compact('document', 'document_name', 'resDocuments'));
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $document = Document::find($id);
        $wheres = Where::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
         
        return view('document.edit', compact('document', 'wheres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Document $document
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Document $document)
    {
        
        request()->validate(Document::rules());
       
        $document->update(Document::GetData($request));
        toast(__('Updated successfully.'), 'success');
        
        return redirect()->route('documents.show', [app()->getLocale(), $document->id]);
        // return redirect()->route('documents.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $document = Document::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('documents.index', app()->getLocale());
    }
}
