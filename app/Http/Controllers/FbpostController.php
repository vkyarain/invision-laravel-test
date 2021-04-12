<?php
namespace App\Http\Controllers;

use App\Models\Fbpost;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class FbpostController extends Controller
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
	
		return $this->user->fbposts()->paginate(3);
		//return Fbpost::paginate(5);
		//echo 'waqar';
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
        //Validate data
        $data = $request->only('name', 's_desc', 'd_desc', 'status');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            's_desc' => 'required',
            'd_desc' => 'required',
            'status' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new fbpost
        $fbpost = $this->user->fbposts()->create([
            'name' => $request->name,
            's_desc' => $request->s_desc,
            'd_desc' => $request->d_desc,
            'status' => $request->status
        ]);

        //Fbpost created, return success response
        return response()->json([
            'success' => true,
            'message' => 'FB post created successfully',
            'data' => $fbpost
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fbpost  $fbpost
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		//$fbpost = $this->user->fbposts()->find($id)->getComments;
    	$fbpost = $this->user->fbposts()->find($id);
    
        if (!$fbpost) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, FB post not found.'
            ], 400);
        }
    
        return $fbpost;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fbpost  $fbpost
     * @return \Illuminate\Http\Response
     */
    public function edit(Fbpost $fbpost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fbpost  $fbpost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fbpost $fbpost)
    {
        //Validate data
        $data = $request->only('name', 's_desc', 'd_desc', 'status');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            's_desc' => 'required',
            'd_desc' => 'required',
            'status' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, update fbpost
        $fbpost = $fbpost->update([
            'name' => $request->name,
            's_desc' => $request->s_desc,
            'd_desc' => $request->d_desc,
            'status' => $request->status
        ]);

        //Fbpost updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'FB post updated successfully',
            'data' => $fbpost
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fbpost  $fbpost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fbpost $fbpost)
    {
        $fbpost->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'FB post deleted successfully'
        ], Response::HTTP_OK);
    }
}