<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShoeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'shoe_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Block',
            'brand_id' => 'required|exists:brands,id',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'size_id' => 'required|array|min:1',
            'size_id.*' => 'exists:sizes,id',
        ];
    }

    public function messages()
    {
        return [
            'shoe_name.required' => 'Tên giày là bắt buộc.',
            'shoe_name.string' => 'Tên giày phải là một chuỗi ký tự.',
            'shoe_name.max' => 'Tên giày không được vượt quá 255 ký tự.',
            'price.required' => 'Giá tiền là bắt buộc.',
            'price.numeric' => 'Giá tiền phải là một số.',
            'price.min' => 'Giá tiền phải lớn hơn hoặc bằng 0.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.integer' => 'Số lượng phải là một số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'description.string' => 'Mô tả phải là một chuỗi ký tự.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'brand_id.required' => 'Thương hiệu là bắt buộc.',
            'brand_id.exists' => 'Thương hiệu không tồn tại.',
            'categories.required' => 'Danh mục là bắt buộc.',
            'categories.array' => 'Danh mục phải là một mảng.',
            'categories.min' => 'Vui lòng chọn ít nhất một danh mục.',
            'categories.*.exists' => 'Danh mục không tồn tại.',
            'size_id.required' => 'Cỡ giày là bắt buộc.',
            'size_id.array' => 'Cỡ giày phải là một mảng.',
            'size_id.min' => 'Vui lòng chọn ít nhất một cỡ giày.',
            'size_id.*.exists' => 'Cỡ giày không tồn tại.',
        ];
    }
}
