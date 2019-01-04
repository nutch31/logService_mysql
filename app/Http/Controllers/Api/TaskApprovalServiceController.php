<?php

namespace App\Http\Controllers\Api;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use App\Model\TaskApprovalService;

class TaskApprovalServiceController extends BaseController{
    //
    public function index()
    {
        return 'TaskApprovalServiceController Index';
    }

    public function insert(Request $request)
    {

        try {

            $user_type       = $request->get('user_type');
            $user_id         = $request->get('user_id');
            $event           = $request->get('event');
            $auditable_type  = $request->get('auditable_type');
            $auditable_id    = $request->get('auditable_id');
            $url             = $request->get('url');
            $ip_address      = $request->get('ip_address');
            $user_agent      = $request->get('user_agent');
            $tags            = $request->get('tags');

            if(empty($request->get('old_values')))
            {
                $old_values = array();
            }
            else
            {
                $old_values = $request->get('old_values');
            }

            if(empty($request->get('new_values')))
            {
                $new_values = array();
            }
            else
            {
                $new_values = $request->get('new_values');
            }

            if(!empty($old_values) && !empty($new_values))
            {
                $old_values_array = array_diff($old_values, $new_values);
                $new_values_array = array_diff($new_values, $old_values);

                $old_values      = json_encode($old_values_array);
                $new_values      = json_encode($new_values_array);
            }
            else
            {
                $old_values      = json_encode($old_values);
                $new_values      = json_encode($new_values);
            }

            $TaskApprovalService                = new TaskApprovalService;
            $TaskApprovalService->user_type     = $user_type;
            $TaskApprovalService->user_id       = $user_id;
            $TaskApprovalService->event         = $event;
            $TaskApprovalService->auditable_type = $auditable_type;
            $TaskApprovalService->auditable_id  = $auditable_id;
            $TaskApprovalService->old_values    = $old_values;
            $TaskApprovalService->new_values    = $new_values;
            $TaskApprovalService->url           = $url;
            $TaskApprovalService->ip_address    = $ip_address;
            $TaskApprovalService->user_agent    = $user_agent;
            $TaskApprovalService->tags          = $tags;
            $TaskApprovalService->save();

            return response(array(
                'Status' => 'Success'
            ), '200');

        }catch (Exception $e) {

            return response(array(
                'Status' => 'internal server error'
            ), '500');
        }
    }

    public function select(Request $request)
    {
        $audits = TaskApprovalService::where('auditable_type', '=', $request->auditable_type)->where('auditable_id', '=', $request->auditable_id)->orderBy('id', 'Desc')->get();

        return $audits;

    }
}