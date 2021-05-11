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

        // $request->validate($this->getRules());

        // $upload->fill($this->getSafeInput($request));

        // dd($request);

        $imageData = [];
        if ($request->hasFile('img_path')) {
            foreach ($request->file('img_path') as $img_path) {
                $imageName = $img_path->getClientOriginalName();
                $img_path->move(public_path().'/img/uploads', $imageName);
                $imageData[] = $imageName;
                // dd($imageData);
            }

            $upload = new upload();
            $upload->img_name = $imageName;
            $upload->img_path = json_encode($imageData);
            $upload->save();

            return redirect("images");
        } else {
            echo "oi";
        }


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
