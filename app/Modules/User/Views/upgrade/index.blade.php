@extends('Layout.Manager')
@section('title', 'Gói nâng cấp')
@push('css')
@endpush
@section('content')
    @if (Session::has('success'))
        <div id="alert-border-3"
            class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ Session::get('success') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-border-3" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    @if (Session::has('fail'))
        <div id="alert-border-2"
            class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ Session::get('fail') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-border-2" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    <div class="px-4 mt-3 md:pl-0">
        <div
            class="hidden md:grid md:justify-center md:items-center md:grid-cols-2 md:justify-between md:items-center py-4">
            <p class="font-medium text-2xl dark:text-white">
                @yield('title', env('APP_NAME'))
            </p>
        </div>
        <!-- Page Heading -->
        <div class="flex flex-col bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <div class="w-full overflow-x-scroll rounded-xl">
                <table class="w-full table-auto border-collapse min-w-full divide-y divide-gray-200 dark:divide-gray-700 ">
                    <thead class="bg-mainColor">
                        <tr>
                            <th scope="col"
                                class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                                #
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                                Tên gói nâng cấp
                            </th>
                            <th scope="col"
                                class="hidden md:table-cell px-3 py-3 text-start text-xs font-medium text-white uppercase">
                                Viết tắt
                            </th>
                            {{-- <th scope="col"
                                class="hidden md:table-cell px-3 py-3 text-start text-xs font-medium text-white uppercase">
                                Giá
                            </th> --}}
                            <th scope="col"
                                class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                                T/gian hết hạn gói
                            </th>
                            <th scope="col"
                                class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                                Chiết khấu
                        </th>
                        <th
                                class="px-3 py-3 text-start text-xs font-medium text-white uppercase sticky right-0 h-fit">
                                Chức năng
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($services as $key => $service)
                            <tr @if (auth()->user()->role === 'admin') onclick="directEdit({{ $service->id }})" @endif>
                                <td
                                    class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ $key + 1 }}
                                </td>
                                <td
                                    class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ $service->name ?? '---' }} <br>
                                </td>
                                <td
                                    class="px-3 py-4 hidden md:table-cell whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ $service->slug ?? '---' }}
                                </td>
                                {{-- <td
                                    class="px-3 py-4 hidden md:table-cell whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ number_format($service->price, 0, ',', '.') }} VNĐ
                                </td> --}}
                                <td
                                    class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ ($service->duration)}}  ({{$service->duration_type }})
                                </td>
                                <td
                                    class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ ($service->percent ) }} % <br>
                                </td>
                                <td
                                    class="px-2 gap-2 py-4 whitespace-nowrap text-center text-sm font-medium flex justify-center sticky right-0 h-fit">
                                    @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.user.upgradeEdit', $service->id) }}"
                                            class="w-7 h-7 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-500 text-white hover:bg-gray-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                            <i class="fa-solid text-[11px] fa-pencil"></i>
                                        </a>
                                        {{-- <form action="{{ route('admin.user.delete', $user->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="w-7 h-7 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                                <i class="fa-solid text-[11px] fa-trash"></i>
                                            </button>
                                        </form> --}}
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9"
                                    class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 text-center">
                                    Không có dữ liệu
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function closeAlert(alertId) {
            setTimeout(function() {
                const alertElement = document.getElementById(alertId);
                if (alertElement) {
                    alertElement.style.display = 'none';
                }
            }, 2000);
        }

        if (document.getElementById('alert-border-3')) {
            closeAlert('alert-border-3');
        }

        if (document.getElementById('alert-border-2')) {
            closeAlert('alert-border-2');
        }

        function directEdit(id) {
            window.location.href = "{{ route('admin.user.upgradeEdit', 'id') }}".replace('id', id);
        }

        $(document).ready(function() {
            getRealTime('chat', 'message', (data) => {
                var result = JSON.parse(data);
                Toastify({
                    text: result.data,
                    duration: 5000,
                    gravity: "top",
                    position: 'center',
                    backgroundColor: "#00c853",
                }).showToast();
            });
        });
    </script>
@endpush
