@extends('Layout.Manager')
@push('css')

    <style>
        .select2-container .select2-selection--single {
            line-height: 46px !important;
            height: 46px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 46px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 11px;
            right: 1px;
            width: 20px;
        }
    </style>
@endpush
@section('content')
    <div class="flex justify-between items-center p-4">
        <p class="font-medium text-xl sm:text-2xl dark:text-white">
            Thêm mới đại lý
        </p>
        <div class="hidden md:flex">
            <a href="{{ route('admin.user.index') }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Quay
                lại</a>
            <button id="saveUser" type="button"
                class="saveUser ml-2 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-full text-sm px-5 py-2.5 text-center">
                <i class="fa-solid fa-save"></i>
                Lưu
            </button>
        </div>

    </div>
    <div class="px-4 mt-3 md:pl-0">
        <form action="{{ route('admin.user.store') }}" method="post" id="form_create_user"
            class="bg-white py-3 rounded-lg">
            @csrf
            <div class="grid grid-cols-2 gap-2 md:gap-6 mb-6 md:grid-cols-4 px-4 mt-4">
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Tên</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Nhập tên" />
                    <div class="text-red-600">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="user_code" class="block mb-2 text-sm font-medium text-gray-900">Mã giới thiệu</label>
                    <input type="text" id="user_code" value="{{ $random_code }}" name="user_code"
                        placeholder="Mã giới thiệu" readonly
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <span class="text-red-500 d-flex justify-content-start">
                        @error('user_code')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Nhập email" />
                    <div class="text-red-600">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Số điện
                        thoại</label>
                    <input type="number" name="phone" value="{{ old('phone') }}"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Nhập số điện thoại" />
                    <div class="text-red-600">
                        @error('phone')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Mật
                        khẩu</label>
                    <input type="password" name="password" value="{{ old('password') }}"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Nhập mật khẩu" />
                    <div class="text-red-600">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                {{-- <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Tiền tệ</label>
                    <select
                        data-hs-select='{
                    "placeholder": "Chọn tiền tệ...",
                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                  }'
                        class="hidden" name="is_currency">
                        <option value="">Choose</option>
                        @foreach (config('currency') as $key => $currency)
                            <option value="{{ $key }}" {{ old('currency') == $key ? 'selected' : '' }}>
                                {{ $key }}</option>
                        @endforeach
                    </select>
                    <div class="text-red-600">
                        @error('is_currency')
                            {{ $message }}
                        @enderror
                    </div>
                </div> --}}
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Địa
                        chỉ</label>
                    <input type="text" name="address_detail" value="{{ old('address_detail') }}"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Nhập địa chỉ" />
                    <div class="text-red-600">
                        @error('address_detail')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Địa
                        chỉ IP</label>
                    <input type="text" name="ip_address" value="{{ old('ip_address') }}"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Nhập địa chỉ IP " />
                    <div class="text-red-600">
                        @error('ip_address')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Trạng
                        thái</label>
                    <select
                        data-hs-select='{
                    "placeholder": "Select option...",
                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                  }'
                        class="hidden" name="status">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Kích hoạt
                        </option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Vô hiệu hoá
                        </option>
                    </select>
                    <div class="text-red-600">
                        @error('status')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Tỉnh/Thành phố</label>
                    <div id="spinner_province" class="text-center"><i id="" class="fa-solid fa-spinner fa-spin my-auto"></i></div>
                    <div id="province_div">
                        <select class="select2" name="province" id="province" onchange="getDistrictKr(this.value)">
                        </select>
                    </div>
{{--                    <input type="text" name="province" value="{{ old('province') }}"--}}
{{--                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "--}}
{{--                     />--}}
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Quận/huyện/thị xã</label>

                    <div id="spinner_district" class="text-center"><i id="" class="fa-solid fa-spinner fa-spin my-auto"></i></div>
                    <div id="district_div">
                        <select class="select2" name="district" id="district" onchange="getWardKr($('#province').val(), this.value)">
                            <option value="" selected>Chọn quận/huyện</option>
                        </select>
                    </div>
{{--                    <input type="text" name="district" value="{{ old('district') }}"--}}
{{--                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "--}}
{{--                     />--}}
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Xã, phường, thị trấn</label>
                    <div id="spinner_ward" class="text-center"><i id="" class="fa-solid fa-spinner fa-spin my-auto"></i></div>
                    <div id="ward_div">
                        <select class="select2" name="ward" id="ward">
                            <option value="" selected>Chọn phường/xã</option>
                        </select>
                    </div>
{{--                    <input type="text" name="ward" value="{{ old('ward') }}"--}}
{{--                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "--}}
{{--                     />--}}
                </div>

                <div class="col-span-full">
                    <div class="grid grid-cols-2 md:gap-x-6 gap-x-2 md:hidden text-center">
                        <a href="{{ route('admin.user.index') }}"
                            class="my-3 gap-2 text-gray-900 font-medium text-sm dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 inline-flex justify-center items-center border border-gray-600 rounded-full">
                            <i class="fa-solid fa-arrow-left"></i>
                            Quay lại
                        </a>
                        <button id="saveUser" type="button"
                            class="saveUser my-3 w-full text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-full text-sm px-5 py-2.5 text-center">
                            <i class="fa-solid fa-save"></i>
                            Lưu
                        </button>

                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.saveUser').click(function() {
                $('#form_create_user').submit();
            });
            getProvinceKr();
            getDistrictKr();
            getWardKr();
        });
    </script>
@endpush
