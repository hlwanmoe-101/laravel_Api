<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    public function __construct()
    {
//        $this->middleware('my');
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function checkContact($id){
//        $contact=Contact::find($id);
//        if(is_null($contact)){
//            return response(["message"=>"not found"],404);
//        }
//        return $contact;
//    }
    public function index()
    {
        $contacts=Contact::latest()->where('user_id',Auth::id())->get();
//        return $contacts;
        return response()->json($contacts,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        $contact=new Contact();
        $contact->name=$request->name;
        $contact->phone=$request->phone;
        $contact->user_id=Auth::id();
        $contact->save();

        return $contact;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $contact=$this->checkContact($id);
        $contact=Contact::find($id);
        if(Gate::denies('view',$contact)){
            return response()->json([
                'messsage'=>'forbidden'
            ],403);
        }

        if(is_null($contact)){
            return response(["message"=>"not found"],404);
        }
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        if(Gate::denies('update',$contact)){
            return response()->json([
                'messsage'=>'forbidden'
            ],403);
        }

        if($request->has('name')){
            $contact->name=$request->name;
        }
        if($request->has('phone')){
            $contact->phone=$request->phone;
        }
        $contact->update();
        return response()->json($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $contact=Contact::find($id);

        if(is_null($contact)){
            return response(["message"=>"not found"],404);
        }
        if(Gate::denies('delete',$contact)){
            return response()->json([
                'messsage'=>'forbidden'
            ],403);
        }
        $contact->delete();
        return response()->json("",204);
    }

}
