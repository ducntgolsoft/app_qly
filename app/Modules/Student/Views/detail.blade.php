@extends('Layout.Site')

@section('content')
    <div class="border-b pb-3">
        <a href="{{ route('students.index') }}" class="text-blue-500">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Student Detail</h1>
            <a href="{{ route('students.edit', $student->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit Student
            </a>
        </div>
    </div>
    <div class="grid grid-cols-5 gap-5">
        <div class="col-span-3">
            <div class="px-4 py-5 sm:px-6 bg-white shadow overflow-hidden sm:rounded-lg">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Personal Information
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Personal details and application.
                </p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Full name
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $student->full_name ?? '' }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Class
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 uppercase">
                            {{ $student->class ?? '' }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Email address
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $student->email ?? '' }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Username
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $student->user->username ?? '' }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Dob
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $student->dob ?? '' }}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="mt-10">
                <div class="font-bold">
                    <h1>Add More Record Course</h1>
                </div>
                <div>
                    <form action="{{route('students.add-score', $student->id)}}" method="post" class="mt-3">
                        @csrf
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label for="course_id" class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                                <select data-hs-select='{
                                    "placeholder": "Select option...",
                                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500",
                                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50",
                                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                }' class="hidden" id="course_id" name="course_id">
                                    <option value="">Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_name }} ({{$course->course_code}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="score" class="block text-sm font-medium text-gray-700">Score</label>
                                <input type="number" min="0" max="10" maxlength="2" name="score" id="score" class="mt-1 block w-full py-2 px-3 border border-gray-200 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-1 px-4 rounded-md">
                                Add Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Courses
                </h3>
            </div>
            <table class="w-full border border-gray-100">
                <thead>
                    <tr>
                        <th class="border text-left py-3 px-2">ID</th>
                        <th class="border text-left py-3 px-2">Course</th>
                        <th class="border text-left py-3 px-2">Point</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grades as $key => $grade)
                        <tr>
                            <td class="border text-left py-2 px-2">{{ $key + 1 }}</td>
                            <td class="border text-left py-2 px-2">{{ $grade->course->course_name }}</td>
                            <td class="border text-left py-2 px-2">{{ $grade->score ?? 0 }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border text-center py-2">No record</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#point').on('input', function() {
                if ($(this).val() > 10) {
                    $(this).val(10);
                }
                if($(this).val() < 0) {
                    $(this).val(0);
                }
            });
        });
    </script>
@endpush