<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Gallery;
use App\Models\Post;


/**
* @OA\Info(
* description="Contoh API doc menggunakan OpenAPI/Swagger",
* version="0.0.1",
* title="Contoh API documentation",
* termsOfService="http://swagger.io/terms/",
* @OA\Contact(
* email="choirudin.emchagmail.com"
* ),
* @OA\License(
* name="Apache 2.0",
* url="http://www.apache.org/licenses/LICENSE-2.0.html"
* )
* )
*/


class GreetController extends Controller
{
    /**
* @OA\Get(
* path="/api/greet",
* tags={"greeting"},
* summary="Returns a Sample API response",
* description="A sample greeting to test out the API",
* operationId="greet",
* @OA\Parameter(
* name="firstname",
* description="nama depan",
* required=true,
* in="query",
* @OA\Schema(
* type="string"
* )
* ),
* @OA\Parameter(
* name="lastname",
* description="nama belakang",
* required=true,
* in="query",
* @OA\Schema(
* type="string"
* )
* ),
* @OA\Response(
* response="default",
* description="successful operation"
* )
* )
*/
    public function greet(Request $request)
    {
    $userData = $request->only([
    'firstname',
    'lastname',
    ]);
    if (empty($userData['firstname']) &&
    empty($userData['lastname'])) {
    return new \Exception('Missing data', 404);
    }
    return 'Halo ' . $userData['firstname'] . ' ' .
    $userData['lastname'];
    }

    public function apigaleri(Request $request)
    {
    $userData = $request->only([
    'title',
    'desc',
    ]);
    if (empty($userData['firstname']) &&
    empty($userData['lastname'])) {
    return new \Exception('Missing data', 404);
    }
    return 'Halo ' . $userData['firstname'] . ' ' .
    $userData['lastname'];
    }

    

/**
 * @OA\Get(
 *     path="/api/gallery",
 *     tags={"gallery"},
 *     summary="Returns a list of gallery images",
 *     description="Returns a paginated list of gallery images where pictures are not empty",
 *     operationId="getGallery",
 * *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="title",
 *                     type="string",
 *                     description="Post title"
 *                 ),
 *                 @OA\Property(
 *                     property="description",
 *                     type="string",
 *                     description="Post description"
 *                 ),
 *                 @OA\Property(
 *                     property="picture",
 *                     type="string",
 *                     format="binary",
 *                     description="Post image"
 *                 ),
 *                 required={"title", "description", "picture"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="201",
 *         description="Post created successfully"
 *     ),
 *     @OA\Response(
 *         response="422",
 *         description="Validation error"
 *     )
 * )
 */
public function getGallery()
{
    $gallery = Post::where('picture', '!=', '')
                   ->whereNotNull('picture')
                   ->orderBy('created_at', 'desc')
                   ->paginate(30);

    return response()->json(['data' => $gallery], 200);
}





}
