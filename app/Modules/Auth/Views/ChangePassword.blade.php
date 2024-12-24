@extends('Layout.singlePage')
@push('css')
    <style>

    </style>
@endpush
@section('content')
    <header class="sticky top-0 z-20 container-mb">
        <div class="sm:container bg-white border-none">
            <div class="relative flex h-16 flex-col justify-center pr-14 h-[64px] pl-4 !pl-12">
                <h5 class="!font-bold leading-snug font-semibold text-gray-900 text-lg truncate">
                    <div class="flex space-x-2">
                        Đổi mật khẩu
                    </div>
                </h5>
                <a href="{{ route('home.index') }}"
                    class="!absolute left-2 center-y relative rounded-md text-2xl h-10 w-10 transition duration-500 border border-transparent bg-transparent text-blue-600 hover:text-blue-800 inline-flex items-center justify-center whitespace-nowrap text-center leading-none transition duration-200 focus:outline-none cursor-pointer"
                    type="button" aria-label="Trở về tất cả">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="absolute right-3 center-y">
                    <a href="{{ route('cart.index') }}">
                        <button
                            class="relative rounded-md text-2xl h-10 w-10 transition duration-500 border border-transparent bg-transparent text-blue-600 hover:text-blue-800 inline-flex items-center justify-center whitespace-nowrap text-center leading-none transition duration-200 focus:outline-none cursor-pointer"
                            type="button" aria-label="4 sản phẩm trong giỏ hàng">
                            {{-- <svg class="h-6 w-6" height="18" width="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_1731_35192" maskUnits="userSpaceOnUse" x="0" y="0" width="18"
                                    height="18" style="mask-type: alpha;">
                                    <g clip-path="url(#clip0_1731_35192)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.5 2.27587C1.5 1.84737 1.83157 1.5 2.24059 1.5H3.77629C4.32206 1.5 4.78699 1.91534 4.87322 2.47993L5.13828 4.2154H15.0182C15.9658 4.2154 16.6697 5.13467 16.4641 6.10377L15.441 10.9273C15.2151 11.9922 14.3135 12.75 13.2721 12.75H6.83626C5.74472 12.75 4.81486 11.9193 4.64241 10.7901L3.46054 3.05175H2.24059C1.83157 3.05175 1.5 2.70438 1.5 2.27587ZM5.37527 5.76715L6.10498 10.545C6.16246 10.9213 6.47242 11.1983 6.83626 11.1983H13.2721C13.6192 11.1983 13.9198 10.9457 13.9951 10.5907L15.0182 5.76716L5.37527 5.76715Z"
                                            fill="white"></path>
                                        <path
                                            d="M6 15C6 14.1716 6.67157 13.5 7.5 13.5C8.32843 13.5 9 14.1716 9 15C9 15.8284 8.32843 16.5 7.5 16.5C6.67157 16.5 6 15.8284 6 15Z"
                                            fill="white"></path>
                                        <path
                                            d="M12.75 13.5C11.9216 13.5 11.25 14.1716 11.25 15C11.25 15.8284 11.9216 16.5 12.75 16.5C13.5784 16.5 14.25 15.8284 14.25 15C14.25 14.1716 13.5784 13.5 12.75 13.5Z"
                                            fill="white"></path>
                                    </g>
                                </mask>
                                <g mask="url(#mask0_1731_35192)">
                                    <rect width="18" height="18" fill="currentColor"></rect>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1731_35192">
                                        <rect width="18" height="18" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg> --}}

                        </button>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main class="bg-gray-100">
        <div class="mt-2 bg-white shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
            <div class="p-4 sm:p-7">
                <div class="mt-5">
                    <form action="{{route('changePWSubmit')}}" method="POST">
                        @csrf
                        <div class="grid gap-y-4">
                            <div>
                                <label for="old_password" class="block text-sm mb-2 dark:text-white">Mật khẩu cũ</label>
                                <div class="relative">
                                    <input type="password" id="old_password" name="old_password"
                                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                       >
                                </div>
                                @error('old_password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div>
                                <label for="password" class="block text-sm mb-2 dark:text-white">Mật khẩu mới</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password"
                                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                       >
                                </div>
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm mb-2 dark:text-white">Nhập lại mật khẩu mới</label>
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                       >
                                </div>
                                @error('password_confirmation')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit"
                                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Đổi mật khẩu
                                </button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
    <script></script>
@endpush
