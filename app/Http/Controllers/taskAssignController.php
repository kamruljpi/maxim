<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MxpMenu;
use App\mxpTask;

class taskAssignController extends Controller
{
    public function taskassign(Request $request)
    {
    	$company_id = $request->session()->get('company_id');

    	if(!empty($company_id) && ($company_id != 0)){
    		$rolesList = DB::select('SELECT * FROM `mxp_role` WHERE `company_id` = '.$company_id.' AND `is_active` =1');
    	}else{
    		$rolesList = DB::select('SELECT * FROM `mxp_role` WHERE `is_active` =1');
    	}

    	$tasksList = DB::select("SELECT * FROM `mxp_task` WHERE `status` = 1");
    	
    	return view('role_management.taskassign', compact('rolesList', 'tasksList'));

    }
    public function taskassignaction(Request $request)
    {
    	$company_id = $request->session()->get('company_id');

    	if(!empty($company_id) && ($company_id != 0)){
    		$rolesList = DB::select('SELECT * FROM `mxp_role` WHERE `company_id` = '.$company_id.' AND `is_active` =1');
    	}else{
    		$rolesList = DB::select('SELECT * FROM `mxp_role` WHERE `is_active` =1');
    	}

    	$tasksList = DB::select("SELECT * FROM `mxp_task` WHERE `status` = 1");
    	
    	self::print_me($request->get('task_1'));
    }
}
