<?php

namespace App\Http\Controllers;

use App\Models\Postcomments;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Fbpost;

class PostcommentsController extends Controller
{
     protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//echo 'vky';exit;
		$fbpost = Fbpost::find($request->post_id);
    
        if (!$fbpost) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, FB post not found.'
            ], 400);
        }
		else
		{
		
			//Validate data
			$data = $request->only('post_id', 'user_id', 'comments');
			$validator = Validator::make($data, [
				'post_id' => 'required|integer',
				'comments' => 'required'
			]);
	
			//Send failed response if request is not valid
			if ($validator->fails()) {
				return response()->json(['error' => $validator->messages()], 200);
			}
			
			/*$already = Postlike::where('post_id', $request->post_id)->where('user_id', $this->user->id)->get();
			
			if(sizeof($already) > 0){
				return response()->json([
					'success' => false,
					'message' => 'You have already liked!'
				], 400);
			}
			else
			{*/
				//Request is valid, create new postcomment
				$postcomment = $this->user->postcomments()->create([
					'post_id' => $request->post_id,
					'user_id' => 2,
					'comments' => $request->comments
				]);
		
				//Postlike created, return success response
				return response()->json([
					'success' => true,
					'message' => 'Comment posted successfully',
					'data' => $postcomment
				], Response::HTTP_OK);
			/*}*/
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Postcomments  $postcomments
     * @return \Illuminate\Http\Response
     */
    public function show(Postcomments $postcomments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Postcomments  $postcomments
     * @return \Illuminate\Http\Response
     */
    public function edit(Postcomments $postcomments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postcomments  $postcomments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postcomments $postcomments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Postcomments  $postcomments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postcomments $postcomments)
    {
        //
    }
}
