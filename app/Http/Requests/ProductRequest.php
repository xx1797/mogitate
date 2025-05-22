<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'name'        => ['required'],
            'price'       => ['required', 'numeric', 'between:0,10000'],
            'seasons'     => ['required', 'array', 'min:1'],
            'description' => ['required', 'max:120'],
            'image'       => ['required', 'mimes:jpeg,png'],
        ];
    }

    public function messages()
    {
        return [
            // 商品名
            'name.required'        => '商品名を入力してください',

            // 値段
            'price.required'       => '値段を入力してください',
            'price.numeric'        => '数値で入力してください',
            'price.between'        => '0~10000円以内で入力してください',

            // 季節
            'seasons.required'     => '季節を選択してください',
            'seasons.array'        => '季節を選択してください',
            'seasons.min'          => '季節を選択してください',

            // 商品説明
            'description.required' => '商品説明を入力してください',
            'description.max'      => '120文字以内で入力してください',

            // 画像
            'image.required'       => '商品画像を登録してください',
            'image.mimes'          => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}