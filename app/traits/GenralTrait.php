<?php


namespace App\traits;


trait GenralTrait
{
  public function fail($statues,$msg){

      return response()->json([
          'status'=>$statues,
          'msg'=>$msg
      ]);
  }
    public function succ($msg,$data){

        return response()->json([
            'status'=>true,
            'msg'=>$msg,
            'data'=>$data
        ]);
    }

}
