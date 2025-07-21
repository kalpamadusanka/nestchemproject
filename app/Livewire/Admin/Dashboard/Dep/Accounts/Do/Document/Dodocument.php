<?php

namespace App\Livewire\Admin\Dashboard\Dep\Accounts\Do\Document;

use App\Models\Dodocument as ModelsDodocument;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Dodocument extends Component
{
      use WithFileUploads;

    public $newDocument,$doNo;
    public $showUploadModal = false;
    public $documents = [];

    protected $rules = [
        'newDocument' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ];

    public function mount($dono)
    {
       $this->doNo=$dono;
        $this->loadDocuments($dono);
    }

    public function loadDocuments($dono)
    {
        $this->documents = ModelsDodocument::where('do_no',$dono)->get()->map(function ($doc) {
            return [
                'id' => $doc->id,
                'name' => $doc->filename,
                'type' => $this->getFileType($doc->filepath),
                'path' => $doc->filepath,
                'icon' => $this->getFileIcon($doc->filepath),
                'color' => $this->getFileColor($doc->filepath)
            ];
        })->toArray();
    }

    private function getFileType($path)
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        return in_array($extension, ['jpg', 'jpeg', 'png']) ? 'image' : 'pdf';
    }

    private function getFileIcon($path)
    {
        return $this->getFileType($path) === 'image' ? 'file-image' : 'file-pdf';
    }

    private function getFileColor($path)
    {
        return $this->getFileType($path) === 'image' ? 'primary' : 'danger';
    }

    public function clickshowmodal()
    {

        $this->showUploadModal = true;
    }

    public function uploadDocument()
    {
        $this->validate();

        // Store the file


                $extension = $this->newDocument->getClientOriginalExtension();
                    $uniqueFilename = time() . '_' . uniqid() . '.' . $extension;

                    // Store the image in the public disk (storage/app/public/product)
                   $path = $this->newDocument->storeAs('dodocument', $uniqueFilename, 'public');

        // Save to database
        ModelsDodocument::create([
            'do_no'=>$this->doNo,
            'filename' => $uniqueFilename,
            'filepath' => $path,
            'filetype' => $this->getFileType($path),
            'filesize' => $this->newDocument->getSize(),
            'status'=>1,
            // Add any other required fields from your Dodocument model
        ]);

        // Reload documents
        $this->loadDocuments();

        // Reset and close modal
        $this->reset('newDocument', 'showUploadModal');
        session()->flash('message', 'Document uploaded successfully!');
    }

    public function downloadDocument($documentId)
    {
        $document = ModelsDodocument::findOrFail($documentId);
        return response()->download(public_path('dodocument/' . basename($document->filepath)), $document->filename);

    }

    public function viewDocument($documentId)
    {
        $document = ModelsDodocument::findOrFail($documentId);

        return response()->download(public_path('dodocument/' . basename($document->filepath)), $document->filename);
    }

    public function deleteDocument($documentId)
    {
        try {
            $document = ModelsDodocument::findOrFail($documentId);

        // Delete file from storage
      if (file_exists(public_path('dodocument/'.$document->file_path))) {
    unlink(public_path('dodocument/'.$document->filename)); // Delete the file
}
$document->delete();
        } catch (\Throwable $th) {
            DB::table('error_logs')->insert([
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTraceAsString(),
                'created_at' => now(),
      ]);
        }

        // Reload documents
        $this->loadDocuments();

        session()->flash('message', 'Document deleted successfully!');
    }
    public function render()
    {
        return view('livewire.admin.dashboard.dep.accounts.do.document.dodocument');
    }
}
