@extends('Layout.Manager')
@push('css')
@endpush
@section('content')
    <div class="flex justify-between items-center p-4">
        <p class="font-medium text-xl sm:text-2xl dark:text-white">
            Thêm mới mã giới thiệu
        </p>
        <div class="hidden md:flex">
            <a href="{{ route('admin.user.index') }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Quay
                lại</a>
            <button id="saveUserCode" type="button"
                class="saveUser ml-2 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-full text-sm px-5 py-2.5 text-center">
                <i class="fa-solid fa-save"></i>
                Lưu
            </button>
        </div>

    </div>
    <div class="px-4 mt-3 md:pl-0">
        <form action="{{ route('admin.user.update.code', $user->id)}}" method="post" id="form_update_user_code"
            class="bg-white py-3 rounded-lg">
            @method('PUT')
            @csrf
            <div class="grid grid-cols-2 gap-2 md:gap-6 mb-6 md:grid-cols-4 px-4 mt-4">
                <div>
                    <label for="user_code" class="block mb-2 text-sm font-medium text-gray-900">Mã giới thiệu</label>
                    <input type="text" id="user_code" value="{{ $user->code}}" name="user_code"
                        placeholder="Mã giới thiệu"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <span class="text-red-500 d-flex justify-content-start">
                        @error('user_code')
                            {{ $message }}
                        @enderror
                    </span>
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
            $('#saveUserCode').click(function() {
                $('#form_update_user_code').submit();
            });
        });
    </script>
@endpush
