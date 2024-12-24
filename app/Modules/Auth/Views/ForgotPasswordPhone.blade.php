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

    <div class="px-4 mt-5 max-w-md mx-auto w-full" style="padding-top: 64px;" id="inputPhoneNumber">
        <h1 class="text-3xl font-semibold mb-6 text-gray-600">Khôi phục mật khẩu</h1>
        <p class="text-gray-600">Vui lòng nhập số điện thoại để MMAS gửi yêu cầu đổi mật khẩu đến tài khoản của bạn</p>
        <div class="">
            <input placeholder="Số điện thoại" type="text" id="phone" name="phone"
                class="mt-1 p-2 w-full border@enderror rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300"
                value="{{ old('phone') }}">
            <div id="errorphone">
            </div>
        </div>
        <div id="recaptcha-container"></div>
        <div class="my-3">
            <a href="{{ route('forgotPW') }}" class="text-gray-500">Đổi mật khẩu bằng Email
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <button id="submitButton" type="button"
            class="w-full bg-blue-300 text-white p-2 rounded-md hover:bg-gray-800 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">Lấy
            OTP</button>
        <div class="mt-4 text-gray-600 text-center">
            <p>Quay lại trang <a href="{{ route('login') }}" class="text-blue-700 hover:underline">Đăng nhập</a></p>
        </div>

        <script></script>
    </div>

    <div class="relative overflow-hidden hidden" id="inputOTP">
        <div class="relative px-6 pb-9 mx-auto w-full max-w-lg rounded-2xl">
            <div class="mx-auto flex w-full max-w-md flex-col">
                <p class="text-sm text-gray-500 uppercase font-bold">Quên mật khẩu</p>
                <p class="text-xl font-bold my-2">Nhập mã xác thực</p>
                <span class="text-xs">
                    Mã xác thực đã được gửi đến Số điện thoại của bạn. Vui lòng kiểm tra tin nhắn và
                    nhập mã xác thực.
                </span>
                <div class="mt-6">
                    <div class="flex flex-col">
                        <div class="flex gap-x-3" data-hs-pin-input="">
                            <input type="text" name="otp[]"
                                class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                data-hs-pin-input-item="">
                            <input type="text" name="otp[]"
                                class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                data-hs-pin-input-item="">
                            <input type="text" name="otp[]"
                                class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                data-hs-pin-input-item="">
                            <input type="text" name="otp[]"
                                class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                data-hs-pin-input-item="">
                            <input type="text" name="otp[]"
                                class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                data-hs-pin-input-item="">
                            <input type="text" name="otp[]"
                                class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                data-hs-pin-input-item="">
                        </div>

                        <div class="flex flex-col mt-6">
                            <div>
                                <button
                                    id="codeverify"
                                    onclick="codeverify()"
                                    class="flex flex-row items-center justify-center text-center w-full border rounded-xl outline-none py-3 bg-blue-700 border-none text-white text-sm shadow-sm">
                                    Xác nhận
                                </button>
                            </div>

                            <div
                                class="flex flex-row items-center justify-center text-center text-sm font-medium space-x-1 text-gray-500 mt-3">
                                <p>Không nhận được mã ?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="disabled:text-blue-300 mt-4 disabled:cursor-not-allowed" id="resend" disabled>
                    Gửi lại mã <span id="coundown">(chờ 60 giây)</span>
                </button>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyDon_v_I3AT_dzSwP95xgf03kfXBNii-j8",
            authDomain: "webapp-b559f.firebaseapp.com",
            projectId: "webapp-b559f",
            storageBucket: "webapp-b559f.firebasestorage.app",
            messagingSenderId: "381126656938",
            appId: "1:381126656938:web:ed3689c48a378aa72f61d3",
            measurementId: "G-C17JRBJSDZ"
        };
        firebase.initializeApp(firebaseConfig);
    </script>
    <script type="text/javascript">
        // countdown
        var timeleft = 60;
        var downloadTimer = setInterval(function() {
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                document.getElementById("resend").disabled = false;
                document.getElementById("resend").innerHTML = "Gửi lại mã";
            } else {
                document.getElementById("resend").disabled = true;
                document.getElementById("resend").innerHTML = "Gửi lại mã <span id='coundown'>(chờ " + timeleft +
                    " giây)</span>";
            }
            timeleft -= 1;
        }, 1000);


        window.onload = function() {
            render();
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                'size': 'invisible',
                'callback': (response) => {}
            });
            recaptchaVerifier.render();
        }

        function phoneSendAuth() {
            $('#error').html('');
            var number = $("#phone").val();

            instance.post('/check-phone', {
                phone: number
            }).then(function(response) {
                if (response.data.status == 'error') {
                    $("#error").html(`
                        <div class="w-full bg-red-100 border border-red-200 text-sm text-red-800 rounded-lg dark:bg-red-800/10 dark:border-red-900 dark:text-red-500" role="alert" tabindex="-1" aria-labelledby="hs-toast-soft-color-red-label">
                            <div id="hs-toast-soft-color-red-label" class="flex p-4">
                            ${response.data.message}

                            <div class="ms-auto">
                                <button type="button" class="inline-flex shrink-0 justify-center items-center size-5 rounded-lg text-red-800 opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100 dark:text-red-200" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                                </button>
                            </div>
                            </div>
                        </div>
                    `);
                    return;
                }
                number = "+84" + number.slice(1);
                firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(
                    confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    coderesult = confirmationResult;
                    $("#sentSuccess").text("Message Sent Successfully.");
                    $("#sentSuccess").show();
                    $('#inputPhoneNumber').addClass('hidden');
                    $('#inputOTP').removeClass('hidden');
                }).catch(function(error) {
                    $("#phone").val('')
                    $("#error").html(`
                        <div class="w-full bg-red-100 border border-red-200 text-sm text-red-800 rounded-lg dark:bg-red-800/10 dark:border-red-900 dark:text-red-500" role="alert" tabindex="-1" aria-labelledby="hs-toast-soft-color-red-label">
                            <div id="hs-toast-soft-color-red-label" class="flex p-4">
                            Đã có lỗi xảy ra. Vui lòng thử lại sau.

                            <div class="ms-auto">
                                <button type="button" class="inline-flex shrink-0 justify-center items-center size-5 rounded-lg text-red-800 opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100 dark:text-red-200" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                                </button>
                            </div>
                            </div>
                        </div>
                    `);
                    $('#resend').prop('disabled', true).attr('id', '')
                    setTimeout(() => {
                        $('#error').html('');
                    }, 3000);
                });
            })


        }

        function codeverify() {
            var otp = [];
            $("input[name='otp[]']").each(function() {
                otp.push($(this).val());
            });
            $('#codeverify').html('Đang xác thực...').prop('disabled', true);
            $('#resend').prop('disabled', true).attr('id', '')
            $("#error").html('');
            var code = otp.join('');
            coderesult.confirm(code).then(function(result) {
                var user = result.user;
                instance.post("{{route('forgotPWSubmitPhone')}}", {
                    'phone': $("#phone").val(),
                    'code': code
                })
                .then(res=>{
                    if(res.data.status == 'success'){
                        window.location.href = res.data.url;
                    } else{
                        alert('Có lỗi xảy ra');
                        $('#codeverify').html('Lỗi xác thực, Vui lòng thử lại sau').removeClass('bg-blue-700').addClass('bg-red-500')
                        $('#resend').prop('disabled', false).attr('id', 'resend')
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                })
            }).catch(function(error) {
                $('#codeverify').html('Lỗi xác thực, Vui lòng thử lại sau').removeClass('bg-blue-700').addClass('bg-red-500')
                $('#resend').prop('disabled', false).attr('id', 'resend')
                $("#error").html(`
                    <div class="w-full bg-red-100 border border-red-200 text-sm text-red-800 rounded-lg dark:bg-red-800/10 dark:border-red-900 dark:text-red-500" role="alert" tabindex="-1" aria-labelledby="hs-toast-soft-color-red-label">
                        <div id="hs-toast-soft-color-red-label" class="flex p-4">
                        Đã có lỗi xảy ra. Vui lòng thử lại sau.

                        <div class="ms-auto">
                            <button type="button" class="inline-flex shrink-0 justify-center items-center size-5 rounded-lg text-red-800 opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100 dark:text-red-200" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                            </button>
                        </div>
                        </div>
                    </div>
                `);
                setTimeout(() => {
                    location.reload();
                }, 2000);
            });
        }

        $('#submitButton').click(function() {
            phoneSendAuth();
        });

        $('#resend').click(function() {
            timeleft = 60;
            // render();
            phoneSendAuth();
        });
    </script>
@endpush
