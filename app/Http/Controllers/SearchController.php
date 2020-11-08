<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $model_name, $type='filter')
    {
        if($model_name == 'user'){
            $model = "\\App\\".ucfirst($model_name);
        }else{
           $model = "\\App\\Models\\".ucfirst($model_name);
        }

        if($type == 'filter'){
         $result = $model::where($request->all());
          if($model_name == 'user'){
             $result = $result->where('role','!=',1);
          }
          $result = $result->get();
        }else{
          $result = $model::orWhere($request->all());
          if($model_name == 'user'){
             $result = $result->where('role','!=',1);
          }
          $result = $result->get();
        }

          if($request->ajax()){
                return  response()->json(['success' => true, 'data'=>$result ], 200);
            } else {
                return $result;
            }
    }
}
