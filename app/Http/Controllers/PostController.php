<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{

    public function create(Request $request) {
    // - name : required, only alphabet
    // - birthdate: required, date, only 18 year old can register
    // - email: required, must valid email, unique
    // - phone: required,  only numeric
    // - address: optional, can alphanumeric
      $postValid = [
        'name' => ['required'],
        'birthday' => ['required', 'date'],
        'email' => ['required'],
        'phone' => ['required'],
        'address' => ['string'],
      ];
      $validated = Validator::make($request->all(), $postValid);
      if(!$validated->fails()) {

        $members = new Members();
        $members->fill($request->post())->save();

        echo "true";
      } else {
        echo "false";
      }


    }

    public function show() {
      $members = Members::get()->toArray();
      return response()->json($members);
    }

}
