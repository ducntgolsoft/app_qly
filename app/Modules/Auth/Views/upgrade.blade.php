@extends('Layout.Site')

@section('title', 'Nâng cấp')

@section('content')
<div class="">  
    <div class="">
        <div class="">
            <div class="rounded-xl bg-white shadow-xl">
                <div class="p-6 sm:p-16">
                    <div class="mt-16 grid space-y-4">
                        @foreach ($service as $key => $item)
                            <button type="button" id="button-{{ $key }}" class="group h-12 px-6 border-2 border-gray-300 rounded-full transition duration-300 hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                                <div class="relative flex items-center space-x-4 justify-center">
                                    <span class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">đ{{ formatPrice($item->price) }} / {{ $item->duration }} tháng</span>
                                    <input type="hidden" name="bank_money" value="{{$item->price}}">
                                    <input type="hidden" name="service_id" value="{{$item->id}}">
                                </div>
                            </button>
                        @endforeach
                        {{-- <button type="button" id="button-3-months" class="group h-12 px-6 border-2 border-gray-300 rounded-full transition duration-300 hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                            <div class="relative flex items-center space-x-4 justify-center">
                                <span class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">đ599,000 / 3 tháng</span>
                                <input type="hidden" name="bank_money2" value="599000">
                            </div>
                        </button> --}}
                    </div>
                    <div class="mt-32 space-y-4 text-gray-600 text-center sm:-mb-8">
                        <button type="button" onclick="upgrade()" id="upgrade-now" class="group h-12 px-6 border-2 border-gray-300 rounded-full transition duration-300 
                                     hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                            <div class="relative flex items-center space-x-4 justify-center">
                                <span class="block w-max font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">Nâng cấp ngay</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    let selectedValue = null;
    let serviceId = null;

    document.querySelectorAll('button[id^="button-"]').forEach(button => {
        button.addEventListener('click', function() {
            toggleButton(this);
            selectedValue = this.querySelector('input[name="bank_money"]').value;
            serviceId = this.querySelector('input[name="service_id"]').value;
        });
    });

    function toggleButton(selectedButton) {
        document.querySelectorAll('button[id^="button-"]').forEach(button => {
            if (button === selectedButton) {
                button.classList.add('bg-blue-600', 'border-blue-600', 'text-white');
            } else {
                button.classList.remove('bg-blue-600', 'border-blue-600', 'text-white');
            }
        });
    }

    function upgrade() {
        if (selectedValue) {
            let url = '{{ route('banking', ['money' => 'selectedValue', 'serviceId' => 'serviceId']) }}'.replace('selectedValue', selectedValue).replace('serviceId', serviceId);
            window.location.href = url;
        } else {
            alert('Vui lòng chọn một gói nâng cấp.');
        }
    }
</script>
@endpush