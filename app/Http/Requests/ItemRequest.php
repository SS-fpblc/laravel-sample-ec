<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function authorize()
    {
        return \Auth::check();
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'string', 'max:255'],
            'image' => [
              'file', // ファイルがアップロードされている
              'image', // 画像ファイルである
              'mimes:jpeg,png', // 形式はjpegかpng
              'dimensions:min_width=50,min_height=50,max_width=1000,max_height=1000', // 50*50 ~ 1000*1000 まで
            ],
        ];
    }

}
