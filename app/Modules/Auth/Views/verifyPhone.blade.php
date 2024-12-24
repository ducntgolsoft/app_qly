@extends('Layout.Auth')

@section('title', 'Đăng ký')

@section('content')
    <div class="relative w-full bg-gray-100 lg:w-1/2">
        <div class="pointer-events-none absolute right-0 -top-8 h-36 w-32 bg-cover"
            style="background-image: url('assets/img/auth-backdrop.png');"></div>
        <div>
            <div class="border-b-2 flex items-center justify-between mb-6 mx-5 py-3">
                <a href="/register">
                    <i class="fas fa-arrow-left text-xl text-gray-500"></i>
                </a>
                <button
                    class="border px-4 py-1 rounded-xl border-mainColor text-mainColor hover:bg-mainColor hover:text-white transition">
                    Dropii Hỗ trợ <i class="fa-solid fa-headphones text-xl"></i>
                </button>
            </div>
            <div class="relative overflow-hidden">
                <div class="relative px-6 pb-9 mx-auto w-full max-w-lg rounded-2xl">
                    <div class="mx-auto flex w-full max-w-md flex-col">
                        <p class="text-sm text-gray-500 uppercase font-bold">Đăng ký</p>
                        <p class="text-xl font-bold my-2">Nhập mã xác thực</p>
                        <span class="text-xs">
                            Mã xác thực đã được gửi đến Số điện thoại <b>+84823565831</b>. Vui lòng kiểm tra tin nhắn và
                            nhập mã xác thực.
                        </span>
                        <div class="mt-6">
                            <form action="" method="post">
                                <div class="flex flex-col">
                                    <div class="flex gap-x-3" data-hs-pin-input="">
                                        <input type="text"
                                            class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            data-hs-pin-input-item="">
                                        <input type="text"
                                            class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            data-hs-pin-input-item="">
                                        <input type="text"
                                            class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            data-hs-pin-input-item="">
                                        <input type="text"
                                            class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            data-hs-pin-input-item="">
                                        <input type="text"
                                            class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            data-hs-pin-input-item="">
                                        <input type="text"
                                            class="block w-[45px] text-center border-gray-200 rounded-md text-sm [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            data-hs-pin-input-item="">
                                    </div>

                                    <div class="flex flex-col mt-6">
                                        <div>
                                            <button
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
                            </form>
                        </div>
                        <button class="disabled:text-blue-300 mt-4 disabled:cursor-not-allowed" id="resend" disabled>
                            Gửi lại mã <span id="coundown">(chờ 60 giây)</span>
                        </button>
                        <div class="text-blue-800 font-bold mt-3">
                            <a href="/register">Đổi số điện thoại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="recaptcha-container"></div>
    </div>
@endsection

@push('js')
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script>
        
        const firebaseConfig = {
            apiKey: "AIzaSyCAOGZthX8sVbjDOv-a8kF5_cdFPy-HyNQ",
            authDomain: "camdo68-2671e.firebaseapp.com",
            projectId: "camdo68-2671e",
            storageBucket: "camdo68-2671e.appspot.com",
            messagingSenderId: "414179609604",
            appId: "1:414179609604:web:d203715fc5db4b6d6ef951",
            measurementId: "G-2ZKFQTR62S"
        };
        firebase.initializeApp(firebaseConfig);
    
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
            setTimeout(() => {
                phoneSendAuth();
            }, 2000);
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                'size': 'invisible',
                'callback': (response) => {
                }
            });
            recaptchaVerifier.render();
        }

        function phoneSendAuth() {
            var number = '+84823565831';
            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                $("#sentSuccess").text("Message Sent Successfully.");
                $("#sentSuccess").show();
            }).catch(function(error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }

        function codeverify() {
            var code = $("#verificationCode").val();
            coderesult.confirm(code).then(function(result) {
                var user = result.user;
                console.log(user);
                $("#successRegsiter").text("you are register Successfully.");
                $("#successRegsiter").show();

            }).catch(function(error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
    </script>
@endpush
