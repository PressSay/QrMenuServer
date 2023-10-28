<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Image;
use App\Models\ImageDish;
use App\Models\ImageAccount;
use App\Models\User;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'image.*' => 'present|image|mimes:jpeg,jpg,gif,svg',
            'forWhat' => 'required',
            'dishId' => 'required'
        ]);


        $forWhat = $request['forWhat'];

        if ($forWhat == 'dish') {
            $dish = Dish::find($request['dishId']);
            if ($dish == null) {
                return [
                    'message' => 'dish does not exist'
                ];
            }
            return $this->storeImageDish($request);
        } else if ($forWhat == 'user') {
            $user = ($request['userId']) ? User::find($request['userId']) : $request->user();
            if ($user == null) {
                return [
                    'message' => 'user does not exist'
                ];
            }
            return $this->storeImageUser($request);
        }

        return [
            'message' => 'forWhat is not valid'
        ];
    }
    public function storeImageDish(Request $request)
    {
        $source = $this->store($request, false);

        $image = Image::create([
            'source' => $source
        ]);

        $imageDish = ImageDish::create([
            'dishId' => $request['dishId'],
            'imageId' => $image->imageId
        ]);

        return [
            'source' => $source,
            'imageDish' => $imageDish,
            'image' => $image
        ];
    }

    public function storeImageUser(Request $request)
    {
        $source = $this->store($request, true);

        $image = Image::create([
            'source' => $source
        ]);

        $userId = ($request['userId']) ? $request['userId'] : $request->user()->userId;
        $imageUser = ImageAccount::create([
            'userId' => $userId,
            'imageId' => $image->imageId
        ]);

        return [
            'source' => $source,
            'imageUser' => $imageUser,
            'image' => $image
        ];
    }

    public function store(Request $request, $isImageUser)
    {
        $path = $isImageUser ? "image-user" : "image-dish";
        $file = $request['image'];

        $nameFileArray = explode('.', $file->getClientOriginalName());
        $extentionFile = end($nameFileArray);
        $source = $file->storeAs($path,  md5(microtime()).'.'.$extentionFile);

        return $source;
    }
}