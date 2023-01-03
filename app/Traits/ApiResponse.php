<?php


namespace App\Traits;

trait ApiResponse{

    public function response($status, $message , $data)
    {
         return response()->json([
             'status' => $status,
             'message' => $message,
             'data' => $data,
         ]);
        
		
	}
	


	



}