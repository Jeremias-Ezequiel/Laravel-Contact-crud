<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index(){
        return new ContactCollection(Contact::all());
    }

    public function store(ContactRequest $request){
        
        $userValidated = $request->validated();
    
        $contact = Contact::create($userValidated);
        
        return response()->json([
            "message" => "Was created correctly",
            "user" => $contact
        ]);
    }

    public function show(int $id){
        $currentContact = Contact::find($id);

        if(!$currentContact){
            return response()->json([
                "message" => "The user does not exist",
                "error" => 404
            ],404);
        }

        return new ContactResource($currentContact);
    }

    public function update(ContactUpdateRequest $request,int $id){
        
        $currentContact = Contact::find($id);

        if(!$currentContact){
            return response()->json([
                "message" => "The user does not exist",
                "error" => Response::HTTP_NOT_FOUND
            ],Response::HTTP_NOT_FOUND); 
        }

        $validated = $request->validated();
        $currentContact->update($validated); 

        return response()->json([
            "message" => "The user was updated",
            "status" => 201,
            "contact" => $currentContact
        ]); 
    }

    public function destroy(int $id){
        $currentContact = Contact::find($id);

        if(!$currentContact){
            return response()->json([
                "message" => "The user does not exist",
                "error" => "Not found"
            ],Response::HTTP_NOT_FOUND); 
        }

        $currentContact->delete();

        return response()->json([
            "message" => "The contact was deleted successfully"
        ],Response::HTTP_OK);
    }
}
