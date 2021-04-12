<?php
namespace App\Http\Controllers;

use App\Models\Postlike;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Fbpost; 


class PostlikeController extends Controller
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
		//echo $this->user->id;exit;
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
			$data = $request->only('post_id', 'user_id');
			$validator = Validator::make($data, [
				'post_id' => 'required|integer'
			]);
	
			//Send failed response if request is not valid
			if ($validator->fails()) {
				return response()->json(['error' => $validator->messages()], 200);
			}
			
			$already = Postlike::where('post_id', $request->post_id)->where('user_id', $this->user->id)->get();
			
			if(sizeof($already) > 0){
				return response()->json([
					'success' => false,
					'message' => 'You have already liked!'
				], 400);
			}
			else
			{
				//Request is valid, create new postlike
				$postlike = $this->user->postlikes()->create([
					'post_id' => $request->post_id,
					'user_id' => $this->user->id
				]);
		
				//Postlike created, return success response
				return response()->json([
					'success' => true,
					'message' => 'Post liked successfully',
					'data' => $postlike
				], Response::HTTP_OK);
			}
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Postlikes  $postlikes
     * @return \Illuminate\Http\Response
     */
    public function show(Postlikes $postlikes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Postlikes  $postlikes
     * @return \Illuminate\Http\Response
     */
    public function edit(Postlikes $postlikes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postlikes  $postlikes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postlikes $postlikes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Postlikes  $postlikes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postlikes $postlikes)
    {
        //
    }
}
