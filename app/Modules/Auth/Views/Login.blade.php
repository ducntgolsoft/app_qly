@extends('Layout.Auth')

@section('title', 'Đăng nhập')

@section('content')

    <div class="bg-gray-50 font-[sans-serif]">
        <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
            <div class="max-w-md w-full">
                <a href="/"><img src="{{ asset('assets/img/mmas_logo.png') }}" alt="logo"
                        class='w-40 mb-8 mx-auto block rounded-lg' />
                </a>
                @if (Session::has('success'))
                    <div id="success-alert" class="bg-teal-50 border-t-2 border-teal-500 rounded-lg p-4 dark:bg-teal-800/30"
                        role="alert" tabindex="-1" aria-labelledby="hs-bordered-success-style-label">
                        <div class="flex">
                            <div class="shrink-0">
                                <span
                                    class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-400">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z">
                                        </path>
                                        <path d="m9 12 2 2 4-4"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="ms-3">
                                <h3 id="hs-bordered-success-style-label"
                                    class="text-gray-800 font-semibold dark:text-white">
                                    {{ Session::get('success') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                @elseif (Session::has('error'))
                    <div id="error-alert" class="my-3 bg-red-50 border-s-4 border-red-500 p-4 dark:bg-red-800/30"
                        role="alert" tabindex="-1" aria-labelledby="hs-bordered-red-style-label">
                        <div class="flex">
                            <div class="shrink-0">
                                <span
                                    class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800 dark:border-red-900 dark:bg-red-800 dark:text-red-400">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="ms-3">
                                <h3 id="hs-bordered-red-style-label" class="text-gray-800 font-semibold dark:text-white">
                                    {{ Session::get('error') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="p-8 rounded-2xl bg-white shadow">
                    <h2 class="text-gray-800 text-center text-2xl font-bold">Đăng nhập</h2>
                    <form action="{{ route('loginSubmit') }}" method="POST" class="mt-8 space-y-4">
                        @csrf
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Email/Số điện thoại</label>
                            <div class="relative flex items-center">
                                <input name="userInfo" type="text" value="{{ old('userInfo') }}"
                                    class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="example@mmas.net" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                    class="w-4 h-4 absolute right-2.5" viewBox="0 0 24 24">
                                    <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                                    <path
                                        d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                                        data-original="#000000"></path>
                                </svg>
                            </div>
                            @error('userInfo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div>
                            <label class="text-gray-800 text-sm mb-2 block">Mật khẩu</label>
                            <div class="relative flex items-center">
                                <input name="password" type="password"
                                    class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
                                    placeholder="Nhập mật khẩu" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                    class="w-4 h-4 absolute right-4 cursor-pointer" viewBox="0 0 128 128">
                                    <path
                                        d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"
                                        data-original="#000000"></path>
                                </svg>
                            </div>
                            @error('password')
                                <span class="text-red-500 text-sm">{{$message}}</span>
                            @enderror
                        </div> --}}

                        <div class="max-w-sm">
                            <label class="block text-sm mb-2 dark:text-white">Mật khẩu</label>
                            <div class="relative">
                                <input id="password" type="password" name="password"
                                    class="py-3 ps-4 pe-10 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="*********">
                                <button type="button"
                                    data-hs-toggle-password='{
                                  "target": "#password"
                                }'
                                    class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
                                    <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                        <path class="hs-password-active:hidden"
                                            d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68">
                                        </path>
                                        <path class="hs-password-active:hidden"
                                            d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61">
                                        </path>
                                        <line class="hs-password-active:hidden" x1="2" x2="22" y1="2"
                                            y2="22"></line>
                                        <path class="hidden hs-password-active:block"
                                            d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle class="hidden hs-password-active:block" cx="12" cy="12"
                                            r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center">
                                <input id="rememberMe" name="rememberMe" type="checkbox"
                                    {{ old('rememberMe') ? 'checked' : '' }}
                                    class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                    checked />
                                <label for="rememberMe" class="ml-1 block text-sm text-gray-800">
                                    Ghi nhớ đăng nhập
                                </label>
                            </div>
                            <div class="text-sm">
                                <a href="{{ route('forgotPW') }}" class="text-blue-600 hover:underline font-semibold">
                                    Bạn quên mật khẩu?
                                </a>
                            </div>
                        </div>

                        <div class="!mt-8">
                            <button type="submit"
                                class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                                Đăng nhập
                            </button>
                        </div>
                        <p class="text-gray-800 text-sm !mt-8 text-center">Chưa có tài khoản?
                            <a href="{{ route('register') }}"
                                class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">Đăng ký ngay</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="min-h-screen flex flex-col justify-between">
    <div class="relative min-h-[450px] overflow-auto overflow-x-hidden px-8">
        <div class="pointer-events-none absolute left-0 h-[204px] w-full bg-cover bg-left-bottom bg-no-repeat" style="background-image: url({{ asset('assets/img/bg-login.png') }});"></div>
        <header class="relative mx-auto flex max-w-md justify-center pb-2 pt-6">
            <img src="{{ asset('assets/img/logo-Auth.png') }}" alt="Logo" class="h-16 w-auto">
        </header>
        <div class="absolute left-0 flex w-full justify-center space-y-2">
            <p class="max-w-xs whitespace-pre-wrap text-center text-white">Dropii Business<br>Nền tảng hỗ trợ Kinh Doanh Online</p>
        </div>
        <div class="relative mt-36">
            <p class="mb-4 text-center font-bold text-gray-900 text-3xl">Đăng nhập tài khoản</p>
            <form action="{{route('loginSubmit')}}" method="POST" class="m-auto max-w-lg bg-white" id="loginForm">
                @csrf
                @if (Session::has('success'))
                <div id="success-alert" class="bg-teal-50 border-t-2 border-teal-500 rounded-lg p-4 dark:bg-teal-800/30" role="alert" tabindex="-1" aria-labelledby="hs-bordered-success-style-label">
                    <div class="flex">
                        <div class="shrink-0">
                            <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-400">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="ms-3">
                            <h3 id="hs-bordered-success-style-label" class="text-gray-800 font-semibold dark:text-white">
                                {{Session::get('success')}}
                            </h3>
                        </div>
                    </div>
                </div>
                @elseif (Session::has('error'))
                <div id="error-alert" class="my-3 bg-red-50 border-s-4 border-red-500 p-4 dark:bg-red-800/30" role="alert" tabindex="-1" aria-labelledby="hs-bordered-red-style-label">
                    <div class="flex">
                        <div class="shrink-0">
                            <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800 dark:border-red-900 dark:bg-red-800 dark:text-red-400">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="ms-3">
                            <h3 id="hs-bordered-red-style-label" class="text-gray-800 font-semibold dark:text-white">
                                {{Session::get('error')}}
                            </h3>
                        </div>
                    </div>
                </div>
                @endif
                <div class="mb-4 space-y-4">
                    <div>
                        <input placeholder="Email/Số điện thoại" type="text" id="userInfo" name="userInfo" class="mt-1 p-2 w-full border @error('userInfo') border-red-500 @else border-gray-300 @enderror rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300" onkeyup="removeError('errorUserInfo', 'userInfo')" value="{{old('userInfo')}}">
                        <div id="errorUserInfo">
                            @error('userInfo')
                            <span class="text-red-500 text-sm">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="relative">
                        <input placeholder="Mật khẩu" type="password" id="password" name="password" class="mt-1 p-2 w-full pr-10 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300" onkeyup="removeError('errorPassword', 'password')">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <div id="showPasswordIcon">
                            <i class="fa-regular fa-eye" ></i>
                        </div>
                        <div class="hidden" id="hidePasswordIcon">
                            <i class="fa-regular fa-eye-slash " ></i>
                        </div>
                        </button>
                        <div id="errorPassword">
                            @error('password')
                            <span class="text-red-500 text-sm">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end"><a class="w-fit text-gray-900" href="{{route('forgotPW')}}">Quên mật khẩu?</a></div>

                    <div>
                        <button type="submit" id="loginButton" data-modal-target="static-modal" data-modal-toggle="static-modal" class="w-full bg-blue-700 text-white p-2 rounded-md hover:bg-blue-900 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 transition-colors duration-300">Đăng nhập</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="bg-slate-200 p-8 pt-4 text-center w-full">
        <p class="mb-4 text-gray-600 text-sm">Trở thành đối tác của Dropii?</p>
        <a href="{{route('register')}}" class="px-auto rounded-lg transition duration-200 justify-center items-center whitespace-nowrap leading-none focus:outline-none border h-10 w-full flex text-blue-700 border-blue-700 hover:text-blue-700 hover:border-blue-700 max-w-lg !text-nm capitalize" type="button">Đăng ký ngay</a>
    </div>
</div>
<script>
    function removeError(divErrorId, inputId) {
        document.getElementById(divErrorId).innerHTML = '';
        document.getElementById(inputId).classList.remove('border-red-500');
    }
    document.addEventListener('DOMContentLoaded', function() {
        sessionStorage.removeItem('hiddenModalNoti');
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const showPasswordIcon = document.querySelector('#showPasswordIcon');
        const hidePasswordIcon = document.querySelector('#hidePasswordIcon');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the icons
            showPasswordIcon.classList.toggle('hidden');
            hidePasswordIcon.classList.toggle('hidden');
        });
    });
</script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    successAlert.style.display = 'none';
                }

                var errorAlert = document.getElementById('error-alert');
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, 5000);
        });
    </script>
@endsection
@push('js')
@endpush
