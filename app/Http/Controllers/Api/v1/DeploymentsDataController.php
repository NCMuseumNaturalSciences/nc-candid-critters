<?php

namespace App\Http\Controllers\Api\v1;

use DB;
use Validator;
use Response;
use App\Deployment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeploymentsDataController extends Controller
{
    public function setStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'selected' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        else {
            $selected = $request->get('selected');
            $newStatus = $request->get('status');

            foreach ($selected as $s) {
                Deployment::where('id','=',$s)
                    ->update([
                        'upload_status' => $newStatus
                    ]);
                };
            return Response::json(array('success' => true));
        }
    }
}
