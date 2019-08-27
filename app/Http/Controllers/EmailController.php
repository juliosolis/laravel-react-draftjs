<?php

namespace App\Http\Controllers;

use App\Email;
use App\Http\Requests\EmailUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Requests\EmailCreateRequest;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::where('user_id', auth()->user()->id)->get();

        return view('email.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('email.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailCreateRequest $request)
    {
        $email = Email::create($request->all());

        return [
            'success' => true,
            'id' => $email->id,
            'email' => $email
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Email $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        return $email;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Email $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        return view('email.edit', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Email $email
     * @return \Illuminate\Http\Response
     */
    public function update(EmailUpdateRequest $request, Email $email)
    {
        $email->update($request->all());

        return [
            'success' => true,
            'id' => $email->id,
            'email' => $email
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Email $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Email::destroy($request->id);

        return redirect()->route('email');
    }
}
