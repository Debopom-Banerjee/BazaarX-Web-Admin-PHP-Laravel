<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserEnquiry;
use App\Models\Testimonial;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return redirect('/login');
        $testimonials = Testimonial::where('type','testimonials')->latest()->take(4)->get();
        return view('frontend.website.contact.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // return $request->all();
            $this->validate($request, [
                'name' => 'required',
                'phone' => 'required',
                'subject' => 'required',
            ]);
            // return $request->all();
            $data = new UserEnquiry();
            $data->name=$request->name;
            $data->type=$request->phone;
            $data->type_value='phone';
            $data->status=0;
            $data->subject=$request->subject;
            $data->description=$request->message;
            $data->save();
            // Push On Site Notification
            $data_notification = [
                'title' => $data->name."have a enquiry",
                'notification' => $data->description,
                'link' => "#",
                'user_id' => $data->id,
            ];
            pushOnSiteNotification($data_notification);
            // End Push On Site Notification
            return redirect()->back()->with('success', 'Thank you for contacting '.config('app.name').'! Our team of experts will get in touch with you shortly.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
