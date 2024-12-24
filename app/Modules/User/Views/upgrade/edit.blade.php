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
        .select2-container-multi .select2-choices .select2-search-field input.select2-active {
            background: #fff url(select2-spinner.gif) no-repeat 100% !important;
        }

    </style>
@endpush
@section('content')
    <div class="flex justify-between items-center py-4">
        <p class="font-medium text-xl sm:text-2xl dark:text-white">
            Cập nhật gói nâng cấp
        </p>
        <div class="hidden md:flex">
            <a href="{{ route('admin.user.upgrade') }}"
               class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Quay
                lại</a>
            <button id="saveUpgrade" type="button"
                    class="saveUpgrade ml-2 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-full text-sm px-5 py-2.5 text-center">
                <i class="fa-solid fa-save"></i>
                Lưu
            </button>
        </div>

    </div>
    <form action="{{ route('admin.user.upgradeUpdate', $service->id) }}" method="post" id="form_update_upgrade"
          class="bg-white py-3 rounded-lg">
        @method('PUT')
        @csrf
        <div class="grid grid-cols-2 gap-2 md:gap-6 mb-6 md:grid-cols-4 px-4 mt-4">
            <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900">Tên gói nâng cấp</label>
                <input type="text" name="name" value="{{ $service->name ?? '' }}"
                       class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                       placeholder="Nhập tên gói nâng cấp"/>
                <div class="text-red-600">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900">Tên viết tắt</label>
                <input type="text" name="slug" value="{{ $service->slug ?? '' }}"
                       class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                       placeholder="Tên viết tắt"/>
                <div class="text-red-600">
                    @error('slug')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900">Giá gói</label>
                <input type="text" name="price" value="{{ $service->price ?? '' }}"
                       class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                       placeholder="Nhập giá gói"/>
                <div class="text-red-600">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900">Thời gian hết hạn gói</label>
                <input type="text" name="duration" value="{{ $service->duration ?? '' }}"
                       class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                       placeholder="Nhập thời gian hết hạn gói"/>
                <div class="text-red-600">
                    @error('duration')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900">Kiểu thời gian</label>
                <select
                    data-hs-select='{
                    "placeholder": "Chọn kiểu thời gian",
                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                    }'
                    class="hidden" name="duration_type">
                    <option value="">Chọn kiểu thời gian</option>

                    <option value="month" {{ $service->duration_type === 'month' ? 'selected' : '' }}>Tháng</option>
                    <option value="day" {{ $service->duration_type === 'day' ? 'selected' : '' }}>Ngày</option>
                </select>
                <div class="text-red-600">
                    @error('duration_type')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900">Chiết khấu (%)</label>
                <input type="text" name="percent" value="{{$service->percent}}"
                       class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                       placeholder="Nhập chiết khẩu "/>
                <div class="text-red-600">
                    @error('percent')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="col-span-full">
                <div class="grid grid-cols-2 md:gap-x-6 gap-x-2 md:hidden text-center">
                    <a href="{{ route('admin.user.upgrade') }}"
                       class="my-3 gap-2 text-gray-900 font-medium text-sm dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 inline-flex justify-center items-center border border-gray-600 rounded-full">
                        <i class="fa-solid fa-arrow-left"></i>
                        Quay lại
                    </a>
                    <button id="saveUpgrade" type="button"
                            class="saveUpgrade my-3 w-full text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-full text-sm px-5 py-2.5 text-center">
                        <i class="fa-solid fa-save"></i>
                        Lưu
                    </button>

                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.saveUpgrade').click(function () {
                $('#form_update_upgrade').submit();
            });
        });
    </script>
@endpush
