@extends('Layout.Auth')

@section('title', 'Đăng ký')

@section('content')
    <a href="/"><img src="{{ asset('assets/img/mmas_logo.png') }}" alt="logo"
            class='w-40 mb-8 mx-auto block rounded-lg mt-8' />
    </a>
    <div
        class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700 container mx-auto max-w-lg">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Đăng ký tài khoản</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                    Đã có tài khoản?
                    <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500"
                        href="/login">
                        Đăng nhập ngay
                    </a>
                </p>
            </div>

            <div class="mt-5">
                <!-- Form -->
                <form id="signUpForm" action="/register" method="POST" class="mt-6 flex flex-col gap-4">
                    @csrf
                    <div class="alert alert-success" id="sentSuccess" style="display: none;"></div>
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Họ và tên <span
                                aria-hidden="true" class="ml-0.5 text-red-500">*</span></label>
                        <input type="text" id="name" name="name" placeholder="Nhập họ và tên"
                            value="{{ old('name') }}"
                            class="mt-1 py-2 w-full border rounded-md border-gray-200 focus:ring-gray-300 transition-colors duration-300 placeholder:text-sm">
                        <span class="text-red-500 text-sm">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại <span
                                aria-hidden="true" class="ml-0.5 text-red-500">*</span></label>
                        <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại"
                            value="{{ old('phone') }}"
                            class="mt-1 py-2 w-full border rounded-md border-gray-200 focus:ring-gray-300 transition-colors duration-300 placeholder:text-sm">
                        <span class="text-red-500 text-sm">
                            @error('phone')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" id="email" name="email" placeholder="Nhập email"
                            value="{{ old('email') }}"
                            class="mt-1 py-2 w-full border rounded-md border-gray-200 focus:ring-gray-300 transition-colors duration-300 placeholder:text-sm">
                        <span class="text-red-500 text-sm">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    {{-- <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu"
                            value="{{ old('password') }}"
                            class="mt-1 py-2 w-full border rounded-md border-gray-200 focus:ring-gray-300 transition-colors duration-300 placeholder:text-sm">
                        <span class="text-red-500 text-sm">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div> --}}

                    <div>
                        <label class="block text-sm mb-2 dark:text-white">Mật khẩu</label>
                        <div class="relative">
                            <input id="password" type="password" name="password"
                                class="py-2 ps-4 pe-10 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
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
                                    <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3">
                                    </circle>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Nhập lại mật
                            khẩu</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Nhập lại mật khẩu"
                            class="mt-1 py-2 w-full border rounded-md border-gray-200 focus:ring-gray-300 transition-colors duration-300 placeholder:text-sm">
                        <span class="text-red-500 text-sm">
                            @error('password_confirmation')
                                {{ $message }}
                            @enderror
                        </span>
                    </div> --}}

                    <div>
                        <label class="block text-sm mb-2 dark:text-white">Nhập lại mật khẩu</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="py-2 ps-4 pe-10 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="*********">
                            <button type="button"
                                data-hs-toggle-password='{
                              "target": "#password_confirmation"
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
                                    <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3">
                                    </circle>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>



                    {{-- <div id="recaptcha-container"></div> --}}
                    <div>
                        <button type="submit" id="signUpButton"
                            class="w-full bg-blue-700 text-white p-2 rounded-md hover:blue-700 focus:outline-none focus:blue-700 focus:outline-none 
                            focus:ring-2 focus:ring-offset-2 focus:blue-700 transition-colors duration-300 ">
                            Đăng ký
                        </button>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
@endsection
