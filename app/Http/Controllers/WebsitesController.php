<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebsitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $websites = Website::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.website.index')->withWebsites($websites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('dashboard.website.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required',
            'logo' => 'required'
        ]);
        $website = new Website;
        $website->title = $request->input('title');
        $website->url = $request->input('url');
        $website->logo = $this->uploadFile('logo', public_path('uploads/'), $request)["filename"];
        $website->save();

        return redirect()->route('websites.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('dashboard.website.edit')->withWebsite(Website::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required'
        ]);
        $website = Website::find($id);
        $website->title = $request->input('title');
        $website->url = $request->input('url');
        if($request->file('logo') != null) {
            $website->logo = $this->uploadFile('logo', public_path('uploads/'), $request)["filename"];
        }
        $website->save();
        return redirect()->route('websites.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
