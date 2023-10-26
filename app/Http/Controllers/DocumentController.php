<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use \PhpOffice\PhpWord\Shared\Html;
use Illuminate\Support\Facades\Auth;
use LaravelFileViewer;
class DocumentController extends Controller
{
    public function Upload(Request $request)
    {
        //
        $file = $request->file('file');
        $name=null;
        $type=null;
        if(file_exists($file))
        {
            $name = $file->getClientOriginalName();
            $type = $file->getMimeType();
            //dd($name, $type);
        }
        //
        if (!in_array($type, ['application/octet-stream','application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/pdf', 'text/html'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Định dạng tài liệu không được hỗ trợ.',
            ]);
        }
        //
        Storage::putFileAs('',$file,$name);
        $filePath = Storage::path($name);
        // 
        $document = new Document();
        $document->id = rand(1,1000000);
        $document->name = $name;
        $document->short_description= $request->short_description;
        $document->type = $file->getClientOriginalExtension();
        //
        $document->user_id= Auth::User()->id;
        $document->last_time_modified = now();
        $document->size = $file->getSize();
        $document->path=$filePath;
        $document->save();

        return redirect()->route('user.GetFileData');
    }
     public function GetFileData(){
      $documents = Document::join('users', 'users.id', '=', 'documents.user_id')
      ->where(function ($query) {
         $query->where('documents.user_id', Auth::user()->id);
         $query->orWhere('documents.visibility', 'public');
         $query->orWhere('documents.visibility', 'Member Only')->where('users.group_user',Auth::user()->group_user);
      })
      ->select('documents.*', 'users.name as user_name')
      ->get();
      //dd($documents);
        return view('documents',['documents' => $documents]);
     }

     public function DownloadDocumentFromTiny(Request $request){
        $content = $request->input('full-featured');
        $name=$request->input('filename').'.docx';
        $short=$request->input('short_description');
        //dd($content);
        $word = new PhpWord();
        
        $section = $word->addSection();

        Html::addHtml($section,$content,false,false);
        //$section->addHTML($escapedContent);

        //$word->setDownloadPathDialog();
        $objWriter = IOFactory::createWriter($word, 'Word2007');
        ob_clean();
        $objWriter->save($name);
        return redirect()->route('user.create_document')->with('success', 'Make document updated successfully!');
     }
     public function ShowDocument(Request $request)
     {
        $word = IOFactory::load('document.docx');

        $html = $word->addHtml();

        echo $html;
     }

     public function EditDocument(Request $request)
     {
        $document = Document::find($request->id);
        Storage::disk('local')->move($document->name, $request->filename);
        $document->name = $request->filename;
        $document->short_description = $request->short_description;
        $document->visibility = $request->visibility;
        $document->save();

        return redirect()->route('user.GetFileData')->with('success', 'User updated successfully!');
     }
     public function AdminEditDocument(Request $request)
     {
        $document = Document::find($request->id);
        //dd($request->id);
        Storage::disk('local')->move($document->name, $request->filename);
        $document->name = $request->filename;
        $document->short_description = $request->short_description;
        $document->visibility = $request->visibility;
        $document->save();

        return redirect()->route('admin.admin_documents')->with('success', 'User updated successfully!');
     }
     public function DeleteDocument(Request $request)
     {
        $document = Document::find($request->id);
        if ($document) {

            //dd($document->name);
            Storage::disk('local')->delete($document->name);
            $document->delete();

            return redirect()->route('user.GetFileData');
        }
     }
     public function AdminDeleteDocument(Request $request)
     {
        $document = Document::find($request->id);
        if ($document) {

            //dd($document->name);
            Storage::disk('local')->delete($document->name);
            $document->delete();

            return redirect()->route('admin.admin_documents');
        }
     }

     public function DownloadDocument(Request $request)
     {
        $document = Document::find($request->id);
        $path= $document->path;
        $name= $document->name;
        $content=file_get_contents($path);
        //return response()->file($path,$name);
        return response()->download($path, $name);
     }

     public function file_preview(Request $request){
        $id=$request->id;
        $document = Document::find($id);
        //$filepath=$document->path;
        $filepath=$document->name;
        $filename=$document->name;
        $file_url=asset('user/'.$filename);
        $file_data=[
          [
            'label' => __('Label'),
            'value' => "Value"
          ]
        ];
        return LaravelFileViewer::show($filename,$filepath,$file_url,$file_data);
      }

      public function GetAllFile(){
         $documents = Document::All();
         return view('admin_documents',['documents' => $documents]);
      }
   
}