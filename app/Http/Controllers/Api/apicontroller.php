<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\createController;
use App\traits\GenralTrait;
use app\traits\response;
use App\User;
use Validator;
use Illuminate\Http\Request;





class apicontroller extends Controller
{
    use GenralTrait;

public function index(Request $request){
    $data=User::find($request->id);
if(!$data){
 return   $this->fail(0,'not found');
}
else {
    return $this->succ('done', $data);

}
}
public function show(){
    $data=User::get();
    if(!$data){
        return   $this->fail(0,'not found');
    }
    else {
        return $this->succ('there is data', $data);

    }

}
public function create(createController $request){
  $request->merge(['password'=>encrypt($request->password)]);
    $user=User::create($request->all());
    if(!$user){
        return   $this->fail(0,'not create');
    }
    else{
        return   $this->fail(1,'the create is done');
    }

}
public function delete(Request $request){
    $data=User::find($request->id);
    if(!$data){
        return   $this->fail(0,'not found');
    }
    else {
        $data->delete();
        return $this->succ('delete is done', $data);

    }

}
    public function update(Request $request){
        $data=User::find($request->id);
        if(!$data){
            return   $this->fail(0,'not found');
        }
        else
           $rules=$this->rules();
         $message=$this->messages();
            $validator=Validator::make($request->all(),$rules,$message);
        $request->merge(['password'=>encrypt($request->password)]);
        $data->update($request->except($request->email_id));
        if(!$data){
            return   $this->fail(0,'not update');
        }
        else{
            return   $this->fail(1,'the update is done');
        }


    }
    private function rules(){
    return  $rules=[
        'name'=>'required|string|min:5',
        'email'=>'required_if:email_id,==,1|email',
        'password'=>'required'
    ];
    }
    private function messages(){
        return  $messages=[
            'name.required'=>'ادخل الاسم',
            'email.email'=>'دخل الايميل صحيحا',
            'password.required'=>'ادخل الباسورد'
        ];
    }
}
