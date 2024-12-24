@extends('Layout.Auth')

@section('title', 'Đặt lại mật khẩu')

@section('content')
    <header class="z-10">
        <div class="border-b border-gray-25 bg-white">
            <div class="container mx-auto">
                <div class="relative flex h-16 items-center justify-between px-4">


                    <div></div>

                    <div class="flex justify-center">
                        <a href="tel:#"
                            class="px-3 rounded-lg transition duration-200 inline-flex justify-center items-center whitespace-nowrap focus:outline-none border h-8 text-blue-700 border-blue-700 hover:text-blue-700 hover:border-blue-700 text-md uppercase"
                            type="button">
                            <span class="">HỖ TRỢ KỸ THUẬT: 0912789682</span>
                            <span class="text-md ml-2">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.3333 5.4165C13.9167 3.83317 12 2.9165 10 2.9165C8 2.9165 6.08333 3.83317 4.66667 5.4165C3.25 6.99984 2.5 9.08317 2.5 11.2498V14.5832C2.5 15.9998 3.58333 17.0832 5 17.0832C6.41667 17.0832 7.5 15.9998 7.5 14.5832V12.0832C7.5 10.6665 6.41667 9.58317 5 9.58317C4.75 9.58317 4.58333 9.58317 4.33333 9.6665C4.58333 8.49984 5.16667 7.33317 5.91667 6.49984C7 5.24984 8.5 4.58317 10 4.58317C11.5 4.58317 13 5.24984 14.0833 6.49984C14.8333 7.33317 15.4167 8.49984 15.6667 9.6665C15.4167 9.58317 15.25 9.58317 15 9.58317C13.5833 9.58317 12.5 10.6665 12.5 12.0832V14.5832C12.5 15.9998 13.5833 17.0832 15 17.0832C16.4167 17.0832 17.5 15.9998 17.5 14.5832V11.2498C17.5 9.08317 16.75 6.99984 15.3333 5.4165ZM5 11.2498C5.5 11.2498 5.83333 11.5832 5.83333 12.0832V14.5832C5.83333 15.0832 5.5 15.4165 5 15.4165C4.5 15.4165 4.16667 15.0832 4.16667 14.5832V12.0832C4.16667 11.5832 4.5 11.2498 5 11.2498ZM15.8333 14.5832C15.8333 15.0832 15.5 15.4165 15 15.4165C14.5 15.4165 14.1667 15.0832 14.1667 14.5832V12.0832C14.1667 11.5832 14.5 11.2498 15 11.2498C15.5 11.2498 15.8333 11.5832 15.8333 12.0832V14.5832Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                        </a>
                    </div>


                </div>
            </div>
        </div>
        <div class="pointer-events-none absolute right-0 top-4 h-[74px] w-[74px] bg-cover"
            style="background-image: url({{ asset('assets/img/auth-backdrop.png') }});"></div>
    </header>
    <div class="pointer-events-none absolute -left-[70px] bottom-[10%] h-[145px] w-[145px] bg-cover"
        style="background-image: url({{ asset('assets/img/auth-backdrop.png') }});"></div>
    {{-- badge error --}}
    <div id="error" class="flex justify-center my-5 px-5"></div>
    <div class="px-4 mt-5 max-w-md mx-auto w-full">
        <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800 ">Đặt lại mật khẩu</h1>
        </div>
        <div class="mt-5">

            <form method="post" action="{{ route('resetPWSubmit', $token) }}">
                @csrf
                <div class="grid gap-y-4">
                    <div>
                        <label for="email" class="block text-sm mb-2 dark:text-white">Email</label>
                        <input type="text" value="{{ $email }}" id="email" disabled
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm " value="{{ old('email') }}">
                    </div>
                    <div class="">
                        <label for="newPassword" class="block text-sm mb-2">Mật khẩu mới</label>
                        <div class="relative">
                            <input type="password" id="newPassword" name="newPassword"
                                class="border py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                @error('newpassword') autofocus @enderror />
                            @error('newPassword')
                                <div class="text-red-500"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <label for="confirmNewPassword" class="block text-sm mb-2">Nhập lại mật khẩu mới</label>
                        <div class="relative">
                            <input type="password" id="confirmNewPassword" name="confirmNewPassword"
                                class="border py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                @error('confirmPassword') autofocus @enderror />
                            @error('confirmNewPassword')
                                <div class="text-red-500"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Đặt
                        lại mật khẩu</button>
                </div>
        </div>
        </form>
    </div>
    </div>

@endsection
