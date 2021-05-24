<?php

namespace App\Http\Controllers;

use App\Models\upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_uploads = upload::all();

        // dd($all_uploads);

        return view("upload.index", [
            "uploads" => $all_uploads
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // foreach ($request->file('img_path') as $img_path) {
        //     $imageName = $img_path->getClientOriginalName();
        //     $img_path->move(public_path() . '/img/uploads', $imageName);
        //     $imageData[] = $imageName;
        // }
        $upload = new upload();
        $imageName = rand() . '.png';
        $upload->img_name = $imageName;
        $upload->img_path = $request->img_path;
        $upload->save();

        return redirect("images");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(upload $upload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function edit(upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function destroy(upload $upload)
    {
        //
    }
}
