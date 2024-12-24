@extends('Layout.Manager')
@section('title', 'Quản lý mã giới thiệu')
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
    <!-- Sidebar Toggle -->
    <div
        class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 md:px-8 lg:hidden dark:bg-gray-800 dark:border-gray-700 py-2">
        <div class="flex flex-wrap justify-between items-center">
            <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                {{-- <li class="flex items-center text-sm text-gray-800 dark:text-gray-400">
                 Application Layout
                 <svg class="flex-shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-gray-600"
                     width="16" height="16" viewBox="0 0 16 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                     <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                 </svg>
             </li> --}}
                <li class="font-semibold text-gray-800 truncate dark:text-gray-400" aria-current="page">
                    <h1>@yield('title', env('APP_NAME'))</h1>
                </li>
            </ol>
            <!-- End Breadcrumb -->
            <div class="flex gap-x-2 md:hidden">
                <a href="{{ route('admin.user.create') }}"
                        class="inline-flex items-center justify-center w-full flex items-center justify-center text-center py-2.5 px-4 gap-x-2  text-sm font-semibold rounded-lg border border-transparent bg-green-700 text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                        <i class="fa-solid fa-plus"></i>

                    </a>
                <button type="button"
                    class="text-sm hs-collapse-toggle py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 focus:outline-none focus:border-blue-500 focus:text-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-blue-500 dark:text-blue-500 dark:hover:text-blue-400 dark:hover:border-blue-400"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-offcanvas-right"
                    data-hs-overlay="#hs-offcanvas-right">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- End Sidebar Toggle -->

    <div class="px-4 mt-3 md:pl-0">
        <div
            class="hidden md:grid md:justify-center md:items-center md:grid-cols-2 md:justify-between md:items-center py-4">
            <p class="font-medium text-2xl dark:text-white">
                @yield('title', env('APP_NAME'))
            </p>
        </div>

        <form class="hidden md:grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-x-1 gap-y-2 mb-4 py-4">
            <div class="max-w-sm">
                <label for="user_code" class="block text-sm font-medium mb-2 dark:text-white">Mã giới thiệu</label>
                <input type="text" value="{{ request()->get('user_code') }}" name="user_code" id="user_code" placeholder="Nhập mã giới thiệu"
                    class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            </div>
            <div class="grid grid-cols-3 mt-7 gap-2">
                <button type="submit"
                    class="inline-flex items-center justify-center w-full text-center py-2.5 px-4 gap-x-2 text-sm font-semibold rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    <i class="fa-solid fa-search"></i>
                </button>
                <a href="{{ route('admin.user.code')}}"
                    class="inline-flex items-center justify-center w-full flex items-center justify-center text-center py-2.5 px-4 gap-x-2  text-sm font-semibold rounded-lg border border-transparent bg-green-700 text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
        </form>

        <!-- Page Heading -->
        <div class="flex flex-col bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <div class=" overflow-x-auto rounded-lg">
                <div class=" min-w-full inline-block align-middle rounded-lg">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 ">
                            <thead class="bg-mainColor">
                                <tr>
                                    <th scope="col"
                                        class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                                        #
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                                        Mã giới thiệu
                                    </th>
                                    <th scope="col"
                                        class="hidden md:table-cell px-3 py-3 text-start text-xs font-medium text-white uppercase">
                                        Người tạo
                                    </th>
                                    <th scope="col"
                                        class="hidden md:table-cell px-3 py-3 text-start text-xs font-medium text-white uppercase">
                                        Thời gian tạo
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 text-start text-xs font-medium text-white uppercase">
                                        Chức năng
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($users as $key => $user)
                                    <tr @if (auth()->user()->role === 'admin') onclick="directEdit({{ $user->id }})" @endif>
                                        <td
                                            class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $key + 1 }}
                                        </td>
                                        <td
                                            class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $user->code ?? '' }}
                                        </td>
                                        <td
                                            class="px-3 py-4 hidden md:table-cell whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $user->user->name ?? '' }}
                                        </td>
                                        <td
                                            class="px-3 py-4 hidden md:table-cell whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ formatDateHIS($user->created_at) ?? '' }}
                                        </td>
                                        <td
                                            class="px-2 gap-2 py-4 whitespace-nowrap text-center text-sm font-medium flex">
                                            @if (auth()->user()->role === 'admin')
                                                <a href="{{ route('admin.user.edit.code', $user->id) }}"
                                                    class="w-7 h-7 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-500 text-white hover:bg-gray-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                                    <i class="fa-solid text-[11px] fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.user.delete.code', $user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="w-7 h-7 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                                        <i class="fa-solid text-[11px] fa-trash"></i>
                                                    </button>
                                                </form>
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
        </div>
    </div>

    <div id="hs-offcanvas-right"
        class="z-20 hs-overlay hs-overlay-open:translate-x-0 hidden translate-x-full fixed top-0 end-0 transition-all duration-300 transform h-full max-w-xs w-full z-[80] bg-white border-s dark:bg-neutral-800 dark:border-neutral-700"
        role="dialog" tabindex="-1" aria-labelledby="hs-offcanvas-right-label">
        <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
            <h3 id="hs-offcanvas-right-label" class="font-bold text-gray-800 dark:text-white">
                Tìm kiếm đại lý
            </h3>
            <button type="button"
                class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                aria-label="Close" data-hs-overlay="#hs-offcanvas-right">
                <span class="sr-only">Close</span>
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-4">
            <form class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-x-1 gap-y-2 mb-4 py-4">
                <div class="max-w-sm">
                    <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Tên Đại lý</label>
                    <input type="text" name="name" id="name"
                        class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                </div>
                <div class="max-w-sm">
                    <label for="email" class="block text-sm font-medium mb-2 dark:text-white">Email</label>
                    <input type="email" name="email" id="email"
                        class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" />
                </div>
                <div class="max-w-sm">
                    <label for="phone" class="block text-sm font-medium mb-2 dark:text-white">Số điện thoại</label>
                    <input type="text" name="phone" id="phone"
                        class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" />
                </div>
                <div class="max-w-sm">
                    <label for="phone" class="block text-sm font-medium mb-2 dark:text-white">Trạng thái nâng cấp
                        gói</label>
                    <select name="upgrade" id="upgrade"
                        class="py-2.5 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        <option value="1">Nâng cấp</option>
                        <option value="0">Không nâng cấp</option>
                        <option value="2" selected>Vừa gửi duyệt</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 mt-7 gap-2">
                    <button type="submit"
                        class=" inline-flex items-center justify-center w-full text-center py-2.5 px-4 gap-x-2 text-sm font-semibold rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                        <i class="fa-solid fa-search"></i>
                    </button>
                    <button type="button"
                        class="inline-flex items-center justify-center w-full text-center py-2.5 px-4 gap-x-2 text-sm font-semibold rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                        <i class="fa-solid fa-download"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- @include('Components.Pagination', [
        'page' => $page ?? 1,
        'pagesize' => $pagesize ?? 50,
        'totalRecord' => $totalRecord ?? 0,
        'pageMax' => $pageMax ?? 0,
    ]) --}}
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

        // function directEdit(id) {
        //     window.location.href = "{{ route('admin.user.show', 'id') }}".replace('id', id);
        // }

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
