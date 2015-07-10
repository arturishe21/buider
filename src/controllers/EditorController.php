<?php namespace Vis\Builder;

use Controller, Input, Validator, Response;

class EditorController extends Controller
{
    /*
   * Loading photos from froala Editor
   */
    public function uploadFoto()
    {
        $photo = Input::file('file');

        $rules = array(
            'file'	=> 'required|image|max:5000',
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Response::json( array('status' => 'error', "errors_messages"=>$validator->messages()));
        }

        $destinationPath = "storage/editor/fotos";

        $ext      = $photo->getClientOriginalExtension();  // Get real extension according to mime type
        $fullname = $photo->getClientOriginalName(); // Client file name, including the extension of the client
        $hashname = md5(date('H.i.s')."_".$fullname).'.'.$ext; // Hash processed file name, including the real extension

        $full_path_img = "/".$destinationPath.'/'.$hashname;

        $upload_success = Input::file('file')->move($destinationPath, $hashname);

        return Response::json(array('link' => $full_path_img));
    }//end uploadFoto

    /*
     * Loading files from froala Editor
     */
    public function uploadFile()
    {
        $file = Input::file('file');

        $rules = array(
            'file'	=> 'required|max:5000',
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Response::json( array('status' => 'error', "errors_messages"=>$validator->messages()));
        }

        $destinationPath = "storage/editor/files";

        $ext      = $file->getClientOriginalExtension();  // Get real extension according to mime type
        $fullname = $file->getClientOriginalName(); // Client file name, including the extension of the client
        $hashname = md5(date('H.i.s')."_".$fullname).'.'.$ext; // Hash processed file name, including the real extension

        $full_path_img = "/".$destinationPath.'/'.$hashname;

        $upload_success = Input::file('file')->move($destinationPath, $hashname);

        return Response::json(array('link' => $full_path_img));
    } //end uploadFile
}