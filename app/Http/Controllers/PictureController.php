<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class PictureController extends Controller
{
    public function index()
    {
        $post = Picture::orderBy('id', 'DESC')->get();

        return view('post.picUpload',compact('post'));
    }

    public function upload(Request $req)
    {

        $this->validate($req,[
            'post_title' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        //dd($req->all());

        $imgs = array();
        $files = $req->file('images');
        $count = 1;
        foreach($files as $x){
            $a = $x->getClientOriginalName();
            $fileName = time().$count.$a;
            $x->move(public_path('images'),$fileName);
            $count++;
            $imgs[]=$fileName;

        }
        
        Picture::insert([
            'title' => $req->post_title,
            'pic' => implode("|",$imgs)
        ]);

        // toast('Your Post as been submited!','success');
        return redirect()->back()->withSuccess('Data Saved Successfully!');
    }
    public function delete($delete_id)
    {
        $picDelete = Picture::find($delete_id);

        // dd($picDelete->all());
        // return 'images/'.$picDelete->pic;

        if (file_exists($picDelete->pic)) {
            if ($picDelete->pic != "") {
                foreach(explode('|', $picDelete->pic) as $x){

                    unlink('images/'.$x);
                    
                }
            }
        }
        

        $post_delete = Picture::find($delete_id);
        $post_delete->delete();

        // alert()->question('Are you sure to delete?',$post_delete->title)->showCancelButton()->showConfirmButton()->focusConfirm(true);

        toast('Your Post has been deleted successfully!','success');

        return redirect()->back();
    }

}
