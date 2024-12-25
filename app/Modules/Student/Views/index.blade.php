@extends('Layout.Site')

@section('content')
    <div class="border-b pb-3 flex justify-between">
        <h1 class="text-2xl font-bold">Student Manager</h1>
        <div>
            <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded"
                href="{{ route('students.export') }}">Export PDF</a>
            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                href="{{ route('students.create') }}">Add Student</a>
            <a class="bg-gray-500 text-white text-sm px-4 py-2 cursor-pointer rounded-md" aria-haspopup="dialog"
                aria-expanded="false" aria-controls="importExcelStudent" data-hs-overlay="#importExcelStudent">
                <i class="fa-solid fa-file-excel"></i>
                Import Excel
            </a>

        </div>
    </div>
    <form action="/students" method="get" class="grid grid-cols-5 gap-3">
        <div>
            <label for="full_name" class="block text-sm font-medium mb-2">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="{{ request('full_name') }}"
                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
        </div>
        <div>
            <label for="username" class="block text-sm font-medium mb-2">Username</label>
            <input type="text" id="username" name="username" value="{{ request('username') }}"
                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
        </div>
        <div>
            <label for="class" class="block text-sm font-medium mb-2">Class</label>
            <input type="text" id="class" name="class" value="{{ request('class') }}"
                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium mb-2">Phone</label>
            <input type="text" id="phone" name="phone" value="{{ request('phone') }}"
                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">&nbsp;</label>
            <div class="grid grid-cols-2 text-center gap-3">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2.5 px-2 rounded">Search</button>
                <a href="{{ route('students.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2.5 px-2 rounded">Reset</a>
            </div>
        </div>

    </form>
    <div class="grid grid-cols-12 gap-10">
        <div class="mt-5 col-span-9">
            <table class="w-full border">
                <thead>
                    <tr>
                        <th class="border text-left py-3 px-2">ID</th>
                        <th class="border text-left py-3 px-2">Username</th>
                        <th class="border text-left py-3 px-2">Name</th>
                        <th class="border text-left py-3 px-2">Email</th>
                        <th class="border text-left py-3 px-2">Phone</th>
                        <th class="border text-left py-3 px-2">Class</th>
                        <th class="border text-left py-3 px-2">Dob</th>
                        <th class="border text-left py-3 px-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $key => $student)
                        <tr>
                            <td class="border text-left py-3 px-2">{{ $key + 1 }}</td>
                            <td class="border text-left py-3 px-2">{{ $student->user->username }}</td>
                            <td class="border text-left py-3 px-2">{{ $student->full_name }}</td>
                            <td class="border text-left py-3 px-2">{{ $student->email }}</td>
                            <td class="border text-left py-3 px-2">{{ $student->phone }}</td>
                            <td class="border text-left py-3 px-2">{{ $student->class }}</td>
                            <td class="border text-left py-3 px-2">{{ $student->dob }}</td>
                            <td class="border text-left py-3 px-2">
                                <a class="bg-violet-500 hover:bg-violet-500 text-white font-bold py-1.5 px-2 rounded" href="{{ route('students.detail', $student->id) }}">Detail</a>
                                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2 rounded" href="{{ route('students.edit', $student->id) }}">Edit</a>
                                <form action="{{ route('students.delete', $student->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="border text-center py-2">No students found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-span-3">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <div id="importExcelStudent"
        class="hs-overlay [--overlay-backdrop:static] hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="importExcelStudent-label" data-hs-overlay-keyboard="false">
        <div
            class="hs-overlay-animation-target hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 id="importExcelStudent-label" class="font-bold text-gray-800 dark:text-white">
                        Import Student List
                    </h3>
                </div>
                <div class="p-4 overflow-y-auto">
                    <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data"
                        id="formImportExcelStudent">
                        @csrf
                        <label for="file" class="sr-only">Choose file</label>
                        <input type="file" name="file" id="file"
                            class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:outline-none focus:ring-0 disabled:opacity-50 disabled:pointer-events-none 
                      file:bg-gray-50 file:border-0
                      file:me-4
                      file:py-3 file:px-4
                      dark:file:bg-neutral-700 dark:file:text-neutral-400">
                    </form>
                    <div>
                        <small class="text-xs text-red-500">Upload Excel file (.xls, .xlsx)</small> <br>
                    </div>
                </div>
                <div class="flex justify-between items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                    <a download href="/students.xlsx" class="text-gray-600 mr-2">
                        Download sample file <i class="fa-solid fa-download"></i>
                    </a>
                    <div>
                        <button type="button" id="cancelImportExcelStudent"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            data-hs-overlay="#importExcelStudent">
                            Cancel
                        </button>
                        <button type="button" id="btnImportExcelStudent"
                            onclick="document.getElementById('formImportExcelStudent').submit()"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Start Import
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src=" https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

    <script>
        var canvas = document.getElementById("barChart");
        var ctx = canvas.getContext('2d');
        var data = {
            labels: ["Excellent", "Good", "Average", "Poor"],
            datasets: [{
                fill: true,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                data: @json($percentages),
                borderColor: ['gray'],
                borderWidth: [0.5]
            }]
        };
        var options = {
            title: {
                display: true,
                text: 'What happens ?',
                position: 'top'
            },
            rotation: -0.7 * Math.PI,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var value = tooltipItem.raw;
                            var total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                            var percentage = ((value / total) * 100).toFixed(0);
                            return percentage + '%';
                        }
                    }
                }
            }
        };
        var myBarChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    </script>
@endsection
