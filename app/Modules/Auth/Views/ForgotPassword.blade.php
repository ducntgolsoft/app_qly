@extends('Layout.Auth')

@section('title', 'Quên mật khẩu')

@section('content')
<header class="z-10">
    <div class="border-b border-gray-25 bg-white">
        <div class="container mx-auto">
            <div class="relative flex h-16 items-center justify-between px-4">

                <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left text-xl"></i>
                </button>

                <div class="flex justify-center">
                    <a href="tel:+84912789682" class="px-3 rounded-lg transition duration-200 inline-flex justify-center items-center whitespace-nowrap focus:outline-none border h-8 text-blue-700 border-blue-700 hover:text-blue-700 hover:border-blue-700 text-md uppercase" type="button">
                        <span class="">HỖ TRỢ KỸ THUẬT: 0912789682</span>
                        <span class="text-md ml-2">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.3333 5.4165C13.9167 3.83317 12 2.9165 10 2.9165C8 2.9165 6.08333 3.83317 4.66667 5.4165C3.25 6.99984 2.5 9.08317 2.5 11.2498V14.5832C2.5 15.9998 3.58333 17.0832 5 17.0832C6.41667 17.0832 7.5 15.9998 7.5 14.5832V12.0832C7.5 10.6665 6.41667 9.58317 5 9.58317C4.75 9.58317 4.58333 9.58317 4.33333 9.6665C4.58333 8.49984 5.16667 7.33317 5.91667 6.49984C7 5.24984 8.5 4.58317 10 4.58317C11.5 4.58317 13 5.24984 14.0833 6.49984C14.8333 7.33317 15.4167 8.49984 15.6667 9.6665C15.4167 9.58317 15.25 9.58317 15 9.58317C13.5833 9.58317 12.5 10.6665 12.5 12.0832V14.5832C12.5 15.9998 13.5833 17.0832 15 17.0832C16.4167 17.0832 17.5 15.9998 17.5 14.5832V11.2498C17.5 9.08317 16.75 6.99984 15.3333 5.4165ZM5 11.2498C5.5 11.2498 5.83333 11.5832 5.83333 12.0832V14.5832C5.83333 15.0832 5.5 15.4165 5 15.4165C4.5 15.4165 4.16667 15.0832 4.16667 14.5832V12.0832C4.16667 11.5832 4.5 11.2498 5 11.2498ZM15.8333 14.5832C15.8333 15.0832 15.5 15.4165 15 15.4165C14.5 15.4165 14.1667 15.0832 14.1667 14.5832V12.0832C14.1667 11.5832 14.5 11.2498 15 11.2498C15.5 11.2498 15.8333 11.5832 15.8333 12.0832V14.5832Z" fill="currentColor"></path>
                            </svg>
                        </span>
                    </a>
                </div>


            </div>
        </div>
    </div>
    <div class="pointer-events-none absolute right-0 top-4 h-[74px] w-[74px] bg-cover" style="background-image: url({{ asset('assets/img/auth-backdrop.png') }});"></div>
</header>
<div class="pointer-events-none absolute -left-[70px] bottom-[10%] h-[145px] w-[145px] bg-cover" style="background-image: url({{ asset('assets/img/auth-backdrop.png') }});"></div>

<div class="px-4 mt-5 max-w-md mx-auto w-full" style="padding-top: 64px;">
    <h1 class="text-3xl font-semibold mb-6 text-gray-600">Khôi phục mật khẩu</h1>
    <p class="text-gray-600">Vui lòng nhập tên tài khoản để MMAS gửi yêu cầu đổi mật khẩu đến tài khoản của bạn</p>
    <form action="{{route('forgotPWSubmit')}}" method="POST" class="space-y-4 mt-5">
        @csrf
        <div class="">
            <input placeholder="Email" type="text" id="userInfo" name="userInfo" class="mt-1 p-2 w-full border @error('userInfo') border-red-500 @else border-gray-300 @enderror rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300" onkeyup="removeError('errorUserInfo', 'userInfo')" value="{{old('userInfo')}}">
            <div id="errorUserInfo">
                @error('userInfo')
                <span class="text-red-500 text-sm">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="">
            {{-- <a href="{{route('forgotPWPhone')}}" class="text-gray-500">Đổi mật khẩu bằng SĐT 
                <i class="fas fa-arrow-right"></i>
            </a> --}}
        </div>
        <button id="submitButton" type="submit" class="w-full bg-blue-300 text-white p-2 rounded-md hover:bg-gray-800 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">Đặt mật khẩu mới</button>
    </form>
    <div class="mt-4 text-gray-600 text-center">
        <p>Quay lại trang <a href="{{route('login')}}" class="text-blue-700 hover:underline">Đăng nhập</a></p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userInfoInput = document.getElementById('userInfo');
            const submitButton = document.getElementById('submitButton');

            function updateButtonState() {
                if (userInfoInput.value.trim() !== '') {
                    submitButton.classList.remove('bg-blue-300');
                    submitButton.classList.add('bg-blue-700');
                } else {
                    submitButton.classList.remove('bg-blue-700');
                    submitButton.classList.add('bg-blue-300');
                }
            }

            userInfoInput.addEventListener('input', updateButtonState);

            // Kiểm tra trạng thái ban đầu trong trường hợp có giá trị cũ
            updateButtonState();
        });
    </script>
</div>

@endsection