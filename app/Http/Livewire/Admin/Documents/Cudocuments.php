<?php

namespace App\Http\Livewire\Admin\Documents;

use App\Models\Document;
use App\Models\Where;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Cudocuments extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $document, $document_id, $wheres, $organization_id, $branch_id, $deportmetn_id;
    public $title, $number, $name, $arrived_date, $file, $consignment_note, $act_number, $ksu, $old_full_text_path, $comment, $deed_date, $where_id;


    public function mount($document_id)
    {
        $this->document_id = $document_id;
        $this->document = Document::find($this->document_id);
        $this->title=$this->document->title;
        $this->number=$this->document->number;
        $this->arrived_date=$this->document->arrived_date;
        $this->deed_date=$this->document->deed_date;
        $this->where_id=$this->document->where_id;
        $this->consignment_note=$this->document->consignment_note;
        $this->act_number=$this->document->act_number;
        $this->ksu=$this->document->ksu;
        $this->old_full_text_path=$this->document->file;
        $this->comment=$this->document->comment;

        $user = Auth::user()->profile;
        if ($user != null) {
            $this->organization_id = $user->organization_id;
            $this->branch_id = $user->branch_id;
            $this->deportmetn_id = $user->department_id;
        }
    }
    
    public function render()
    {
        
        $this->wheres = Where::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        return view('livewire.admin.documents.cudocuments');
    }

    public function update()
    {
        $this->validate(
            [
                'title' => 'required',
                'number' => 'required',
            ],
            [
                'title.required' =>  __('The :attribute field is required.'),
                'number.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title' => __('Title'),
                'number' => __('Number'),
            ]
        );

        if ($this->document_id) {

            $data = [];

            if($this->file!=null){
                $full_text_path = $this->file->store('books/fulltext', 'public');
                $file_format=$this->file->getClientOriginalExtension();
                $file_format_type=$this->file->getMimeType();
                $file_size=$this->file->getSize();
                if($this->old_full_text_path){
                    $path = public_path('storage/'.$this->old_full_text_path);
                    $isExists = file_exists($path);
                    if($isExists && is_file($path)){
                        unlink($path);
                    }
        
                }
                $data['file'] = $full_text_path;
    
            }

            $data['title'] = $this->title;
            $data['number'] = $this->number;
    
            $data['arrived_date'] = $this->arrived_date;
             
           
            if($this->arrived_date != null){
                $data['arrived_year'] = date('Y',strtotime($this->arrived_date));
                $data['arrived_month'] = date('m',strtotime($this->arrived_date));
                $data['arrived_day'] = date('d',strtotime($this->arrived_date));
            }
           
            // if ($request->file('file')) {
            //     $filePath = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            //     $up = $request->file('file')->storeAs('books/act', $filePath, 'public');
            //     $data['file'] = "books/act/" . $filePath;
            // }
    
            $data['consignment_note'] = $this->consignment_note;
            $data['act_number'] = $this->act_number;
            $data['ksu'] = $this->ksu;
    
            $user = Auth::user()->profile;
            
            $data['organization_id'] = $user->organization_id;
            $data['branch_id']  = $user->branch_id;
            $data['deportmetn_id'] = $user->department_id;
    
            $data['where_id'] = $this->where_id;
            // $data['comment1'] = $this->comment1;
            $data['comment'] = $this->comment;
            // $data['extra1'] = $this->extra1;
            // $data['extra2'] = $this->extra2;
            // $data['extra3'] = $this->extra3;
            // $data['extra4'] = $this->extra4;
            $data['deed_date'] = $this->deed_date;
           
            
            $record = Document::findOrFail($this->document_id);

            $record->update($data);
            $this->alert('success',  __('Successfully saved'));
            $this->resetInputFields();
            return redirect()->to( app()->getLocale().'/admin/documents/'.$this->document_id);
        }
    }
    private function resetInputFields()
    {
        $this->title = '';
        $this->number = '';
        $this->arrived_date = null;
        $this->where_id = null;
    }
}
