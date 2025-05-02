<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Các dòng ngôn ngữ sau đây chứa các thông báo lỗi mặc định được sử dụng bởi
    | lớp validator. Một số quy tắc trong số này có nhiều phiên bản khác nhau,
    | chẳng hạn như quy tắc kích thước. Bạn có thể điều chỉnh từng thông báo ở đây.
    |
    */

    'accepted' => ':attribute phải được chấp nhận.',
    'active_url' => ':attribute không phải là một URL hợp lệ.',
    'after' => ':attribute phải là một ngày sau :date.',
    'after_or_equal' => ':attribute phải là một ngày sau hoặc bằng :date.',
    'alpha' => ':attribute chỉ có thể chứa chữ cái.',
    'alpha_dash' => ':attribute chỉ có thể chứa chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => ':attribute chỉ có thể chứa chữ cái và số.',
    'array' => ':attribute phải là một mảng.',
    'before' => ':attribute phải là một ngày trước :date.',
    'before_or_equal' => ':attribute phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'numeric' => ':attribute phải nằm trong khoảng :min và :max.',
        'file' => ':attribute phải nằm trong khoảng :min và :max kilobytes.',
        'string' => ':attribute phải nằm trong khoảng :min và :max ký tự.',
        'array' => ':attribute phải có từ :min đến :max mục.',
    ],
    'boolean' => 'Trường :attribute phải đúng hoặc sai.',
    'confirmed' => 'Xác nhận :attribute không khớp.',
    'date' => ':attribute không phải là một ngày hợp lệ.',
    'date_equals' => ':attribute phải là một ngày bằng :date.',
    'date_format' => ':attribute không khớp với định dạng :format.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải là :digits chữ số.',
    'digits_between' => ':attribute phải nằm trong khoảng :min và :max chữ số.',
    'dimensions' => ':attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường :attribute có giá trị trùng lặp.',
    'email' => ':attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng một trong những giá trị sau: :values.',
    'exists' => ':attribute đã chọn không hợp lệ.',
    'file' => ':attribute phải là một tệp.',
    'filled' => 'Trường :attribute phải có giá trị.',
    'gt' => [
        'numeric' => ':attribute phải lớn hơn :value.',
        'file' => ':attribute phải lớn hơn :value kilobytes.',
        'string' => ':attribute phải lớn hơn :value ký tự.',
        'array' => ':attribute phải có nhiều hơn :value mục.',
    ],
    'gte' => [
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'file' => ':attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'string' => ':attribute phải lớn hơn hoặc bằng :value ký tự.',
        'array' => ':attribute phải có :value mục trở lên.',
    ],
    'image' => ':attribute phải là một hình ảnh.',
    'in' => ':attribute đã chọn không hợp lệ.',
    'in_array' => 'Trường :attribute không tồn tại trong :other.',
    'integer' => ':attribute phải là một số nguyên.',
    'ip' => ':attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute phải là một chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'file' => ':attribute phải nhỏ hơn :value kilobytes.',
        'string' => ':attribute phải nhỏ hơn :value ký tự.',
        'array' => ':attribute phải có ít hơn :value mục.',
    ],
    'lte' => [
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'file' => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'string' => ':attribute phải nhỏ hơn hoặc bằng :value ký tự.',
        'array' => ':attribute không được có nhiều hơn :value mục.',
    ],
    'max' => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'string' => ':attribute không được lớn hơn :max ký tự.',
        'array' => ':attribute không được có nhiều hơn :max mục.',
    ],
    'mimes' => ':attribute phải là một tệp có loại: :values.',
    'mimetypes' => ':attribute phải là một tệp có loại: :values.',
    'min' => [
        'numeric' => ':attribute phải ít nhất là :min.',
        'file' => ':attribute phải ít nhất là :min kilobytes.',
        'string' => ':attribute phải ít nhất là :min ký tự.',
        'array' => ':attribute phải có ít nhất :min mục.',
    ],
    'not_in' => ':attribute đã chọn không hợp lệ.',
    'not_regex' => 'Định dạng :attribute không hợp lệ.',
    'numeric' => ':attribute phải là một số.',
    'password' => 'Mật khẩu không chính xác.',
    'present' => 'Trường :attribute phải có mặt.',
    'regex' => 'Định dạng :attribute không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other có trong :values.',
    'required_with' => 'Trường :attribute là bắt buộc khi :values có mặt.',
    'required_with_all' => 'Trường :attribute là bắt buộc khi :values có mặt.',
    'required_without' => 'Trường :attribute là bắt buộc khi :values không có mặt.',
    'required_without_all' => 'Trường :attribute là bắt buộc khi không có :values nào có mặt.',
    'same' => ':attribute và :other phải khớp nhau.',
    'size' => [
        'numeric' => ':attribute phải là :size.',
        'file' => ':attribute phải là :size kilobytes.',
        'string' => ':attribute phải là :size ký tự.',
        'array' => ':attribute phải chứa :size mục.',
    ],
    'starts_with' => ':attribute phải bắt đầu bằng một trong những giá trị sau: :values.',
    'string' => ':attribute phải là một chuỗi.',
    'timezone' => ':attribute phải là một vùng hợp lệ.',
    'unique' => ':attribute đã được sử dụng.',
    'uploaded' => ':attribute tải lên không thành công.',
    'url' => 'Định dạng :attribute không hợp lệ.',
    'uuid' => ':attribute phải là một UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Tại đây bạn có thể chỉ định thông điệp xác thực tùy chỉnh cho các thuộc tính
    | bằng cách sử dụng quy tắc "attribute.rule" để đặt tên các dòng. Điều này giúp
    | bạn dễ dàng chỉ định một dòng ngôn ngữ tùy chỉnh cho một quy tắc thuộc tính nhất định.
    |
    */

    'custom_member' => [
        'required' => ':attribute bắt buộc phải điền.',

        'address.string' => ':attribute phải là chữ cái.',
        'avatar.string' => ':attribute không hợp lệ.',

        'in' => ':attribute không tồn tại',

        'before' => 'Bạn không đủ 18 tuổi.',

        'image' => ':attribute định dạng không hợp lệ.',

        'date' => 'Ngày tháng năm không hợp lệ.',

        'phone.unique' => ':attribute đã tồn tại',
        'email.unique' => ':attribute đã tồn tại',

        'name.min' => ':attribute không được nhỏ hơn 3 ký tự.',
        'address.min' => ':attribute không được nhỏ hơn 5 ký tự.',

        'name.max' => ':attribute không được lớn hơn 50 ký tự.',
        'address.max' => ':attribute không được lớn hơn 100 ký tự.',

        'name.regex' => ':attribute phải viết hoa chữ cái đầu mỗi từ.',
        'phone.regex' => ':attribute không hợp lệ.',
        'email.regex' => ':attribute không hợp lệ.',

        'city_id.exists' => ':attribute không tồn tại.',
        'district_id.exists' => ':attribute không tồn tại.',
        'ward_id.exists' => ':attribute không tồn tại.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Các dòng ngôn ngữ sau đây được sử dụng để thay thế trình giữ chỗ thuộc tính
    | bằng những gì dễ đọc hơn như "Địa chỉ Email" thay vì "email". Điều này giúp
    | chúng tôi làm cho thông điệp của mình rõ ràng hơn.
    |
    */

    'attributes' => [
        'name' => 'Tên',
        'avatar' => 'Ảnh đại diện',
        'new_avatar' => 'Ảnh đại diện mới',
        'gender' => 'Giới tính',
        'phone' => 'Số điện thoại',
        'email' => 'Email',
        'city_id' => 'Tỉnh/Thành phố',
        'district_id' => 'Quận/Huyện',
        'ward_id' => 'Phường/Xã',
        'address' => 'Địa chỉ',
        'data' => 'ID',
    ],

];
