<x-layout.employeebody>
    <main class="relative h-screen overflow-y-auto lg:ml-64">
        <div class="px-0 sm:px-4 my-[80px]">
            <div id="estimator-page" class="animate__animated grid grid-cols-1 md:grid-cols-5 gap-5">
                <div class="relative col-span-3">
                    <div class="sticky top-14 z-10 bg-white border-b border-gray-200 mb-3 rounded-md">
                        <ul data-tabs-toggle="#myTabContent" role="tablist" class="grid grid-cols-4 text-center">
                            <li class="border border-slate-300 hover:cursor-pointer flex align-text-bottom rounded-l-md">
                                <button id="pms-tab" data-tabs-target="#pms" type="button" role="tab" aria-controls="pms" aria-selected="{{ $select_tab('pmg') }}" class="inline-block px-4 font-semibold leading-4 py-2 break-words">PMS PACKAGE</button>
                            </li>
                            <li class="border border-slate-300 hover:cursor-pointer flex align-text-bottom">
                                <button id="services-tab" data-tabs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="{{ $select_tab('multi-inspection') }}" class="inline-block px-4 font-semibold leading-4 py-2 break-words">PERIODIC SERVICES</button>
                            </li>
                            <li class="border border-slate-300 hover:cursor-pointer flex align-text-bottom">
                                <button id="services_repair-tab" data-tabs-target="#services_repair" type="button" role="tab" aria-controls="services_repair" aria-selected="{{ $select_tab('repair') }}" class="inline-block px-4 font-semibold leading-4 py-2 break-words">AC SERVICES & REPAIR</button>
                            </li>
                            <li id="" class="border border-slate-300 hover:cursor-pointer flex align-text-bottom rounded-r-md">
                                <button id="tires_wheel-tab" data-tabs-target="#tires_wheel" type="button" role="tab" aria-controls="tires_wheel" aria-selected="false" class="inline-block px-4 font-semibold leading-4 py-2 break-words">
                                    TIRES & WHEELS CARE
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div id="myTabContent">
                        
                        <div id="pms" role="tabpanel" aria-labelledby="pms-tab" class="hidden">
                            @php 
                                $car_type = $appointment_details('fuel_type') !== "Gas" ? 2 : 1; 

                                if (isset($_GET['type']) && $_GET['type'] == 'Diesel') { 
                                    $car_type = 2; 
                                } else if (isset($_GET['type']) && $_GET['type'] == 'Gas') { 
                                    $car_type = 1; 
                                }
                            @endphp  
                            @foreach ($estimators(1, $car_type) as $estimator)
                                <div class="shadow bg-white rounded-md p-3 mb-3">
                                    <div class="grid grid-cols-3 justify-between">
                                        <div class="col-span-2">
                                            <h2 class="text-2xl font-bold mb-4">{{  $estimator->name }}</h2>
                                            @php $inc = array_filter(explode(',', $estimator->inclusions)); @endphp
                                            <div class="grid grid-cols-2 gap-y-2 mb-4">
                                                @for ($i = 0; $i < count($inc); $i++)
                                                    <p>
                                                        <span class="bg-green-100 rounded-full text-sm px-[0.5px] py-[1px]">✔</span>
                                                        <label class="text-sm">{{ $inc[$i] }}</label>
                                                    </p>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="col-span-1 relative">
                                            <p class="absolute top-0 right-0 font-semibold text-xl">₱ {{ number_format($estimator->price, 2) }}</p>
                                            <button id="product_{{ $estimator->id }}" data-row-data="{{ "{$estimator->id}~{$estimator->name}~{$estimator->price}~{$estimator->img}" }}" class="add-cart-btn animate__animated animate__bounce animate__faster absolute bottom-0 right-0 bg-red-700 text-white px-2 py-1 font-semibold rounded shadow-md whitespace-nowrap text-1xl hover:text-yellow-300">
                                                ADD TO CART
                                            </button>
                                            <div id="after-add{{ $estimator->id }}" hidden class="px-2 py-1 ">
                                                <p class="absolute bottom-0 right-0 text-gray-500 text-sm">
                                                    <span class="rounded-full text-sm px-[0.5px] py-[1px]">✔</span>
                                                    Added to Cart
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="services" role="tabpanel" aria-labelledby="services-tab" class="hidden">
                            @foreach ($estimators(2) as $estimator)
                                <div class="shadow bg-white rounded-md p-3 mb-3">
                                    <div class="grid grid-cols-3 justify-between">
                                        <div class="col-span-2">
                                            <h2 class="text-2xl font-bold">{{ $estimator->name }}</h2>
                                            <p class="mb-4 text-sm">
                                                {{ $estimator->inclusions }} 
                                            </p>
                                        </div>
                                        <div class="col-span-1 relative h-36">
                                            <p class="absolute top-0 right-0 font-semibold text-xl">₱ {{ number_format($estimator->price, 2) }}</p>
                                            <button id="product_{{ $estimator->id }}" data-row-data="{{ "{$estimator->id}~{$estimator->name}~{$estimator->price}~{$estimator->img}" }}" class="add-cart-btn animate__animated animate__bounce animate__faster absolute bottom-0 right-0 bg-red-700 text-white px-2 py-1 font-semibold rounded shadow-md whitespace-nowrap text-1xl hover:text-yellow-300">
                                                ADD TO CART
                                            </button>
                                            <div id="after-add{{ $estimator->id }}" hidden class="px-2 py-1 ">
                                                <p class="absolute bottom-0 right-0 text-gray-500 text-sm">
                                                    <span class="rounded-full text-sm px-[0.5px] py-[1px]">✔</span>
                                                    Added to Cart
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="services_repair" role="tabpanel" aria-labelledby="services_repair-tab" class="hidden">
                            @foreach ($estimators(3) as $estimator)
                                <div class="shadow bg-white rounded-md p-3 mb-3">
                                    <div class="grid grid-cols-3 justify-between">
                                        <div class="col-span-2">
                                            <h2 class="text-2xl font-bold">{{ $estimator->name }}</h2>
                                            <p class="mb-4 text-sm">
                                                {{ $estimator->inclusions }} 
                                            </p>
                                        </div>
                                        <div class="col-span-1 relative h-36">
                                            <p class="absolute top-0 right-0 font-semibold text-xl">₱ {{ number_format($estimator->price, 2) }}</p>
                                            <button id="product_{{ $estimator->id }}" data-row-data="{{ "{$estimator->id}~{$estimator->name}~{$estimator->price}~{$estimator->img}" }}" class="add-cart-btn animate__animated animate__bounce animate__faster absolute bottom-0 right-0 bg-red-700 text-white px-2 py-1 font-semibold rounded shadow-md whitespace-nowrap text-1xl hover:text-yellow-300">
                                                ADD TO CART
                                            </button>
                                            <div id="after-add{{ $estimator->id }}" hidden class="px-2 py-1 ">
                                                <p class="absolute bottom-0 right-0 text-gray-500 text-sm">
                                                    <span class="rounded-full text-sm px-[0.5px] py-[1px]">✔</span>
                                                    Added to Cart
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="tires_wheel" role="tabpanel" aria-labelledby="tires_wheel-tab" class="hidden"> 
                            @foreach ($estimators(4) as $estimator)  
                                <div class="shadow bg-white rounded-md p-3 mb-3">
                                    <div class="grid grid-cols-3 justify-between">
                                        <div class="col-span-2">
                                            <h2 class="text-2xl font-bold">{{ $estimator->name }}</h2>
                                            <p class="mb-4 text-sm">
                                                {{ $estimator->inclusions }}
                                            </p>
                                        </div>
                                        <div class="col-span-1 relative h-36">
                                            <p class="absolute top-0 right-0 font-semibold text-xl">₱ {{ number_format($estimator->price, 2) }}</p>
                                            <button id="product_{{ $estimator->id }}" data-row-data="{{ "{$estimator->id}~{$estimator->name}~{$estimator->price}~{$estimator->img}" }}" class="add-cart-btn animate__animated animate__bounce animate__faster absolute bottom-0 right-0 bg-red-700 text-white px-2 py-1 font-semibold rounded shadow-md whitespace-nowrap text-1xl hover:text-yellow-300">
                                                ADD TO CART
                                            </button>
                                            <div id="after-add{{ $estimator->id }}" hidden class="px-2 py-1 ">
                                                <p class="absolute bottom-0 right-0 text-gray-500 text-sm">
                                                    <span class="rounded-full text-sm px-[0.5px] py-[1px]">✔</span>
                                                    Added to Cart
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-3 md:col-span-2 ">
                    <div class="sticky top-14 z-14">
                        <div class="bg-white flex justify-between border-b-2 border-gray-500 pb-2 pt-4 px-3">
                            <div class="px-2 border-l-4 border-gray-400">
                                <p class="text-xl font-bold capitalize text-red-600">
                                    {{ $appointment_details('model') }}
                                    <span class="font-semibold text-gray-700 capitalize">
                                        {{ $appointment_details('fuel_type') }}
                                    </span>
                                </p>
                            </div>
                            <div class="mt-1">
                                @if (isset($_GET['serv']))  
                                    <button type="button" onclick="window.location.replace('/employee/job_order')" class="font-light text-red-600 hover:scale-125 ease-in-out duration-150">
                                        BACK
                                    </button>
                                @else
                                    <select name="" id="fuel-type" class="border-none font-light text-red-600 hover:scale-125 ease-in-out duration-150 hover:cursor-pointer">
                                        <option value="" selected disabled>CHOOSE</option>
                                        <option value="Diesel" {{ isset($_GET['type']) && $_GET['type'] == 'Diesel' ? "Selected" : '' }}>DIESEL</option>
                                        <option value="Gas" {{ isset($_GET['type']) && $_GET['type'] == 'Gas' ? "Selected" : '' }}>GAS</option>
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="bg-white shadow-lg px-3 py-2">
                            <table class="w-full">
                                <thead class="border-b-2 border-slate-400">
                                </thead>
                                <tbody id="added-list"></tbody>
                            </table>
                            <div class="flex justify-between mt-3">
                                <div class="font-semibold text-2xl text-slate-800 whitespace-nowrap">
                                    Subtotal ( <span id="total-items">0 Item(s)</span> )
                                </div>
                                <div class="font-semibold text-2xl whitespace-nowrap text-slate-800">
                                    <span id="total-price">₱ 0.00</span>
                                </div>
                            </div>
                            <div id="checkout-btn" hidden class="flex justify-between bg-red-600 mt-5 p-3 text-xl font-bold text-white hover:text-yellow-300 hover:cursor-pointer mb-2">
                                <div class="total-price">
                                    ₱ 0.00
                                </div>
                                <div>
                                    CHECKOUT
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="checkout-page" class="hidden animate__animated animate__bounceInRight bg-white rounded-md">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex items-center justify-between p-5 border-b rounded-t">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 italic">
                                Booking summary
                            </h3>
                            <div class="text-center">
                                <span class="text-sm font-base">Customer Details</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-3 text-center border-b-2 border-gray-400 pb-2">
                            <h1 class="text-xl font-semibold">Customer details</h1>
                            <h1 class="text-xl font-semibold">Vehicle detail </h1>
                            <h1 class="text-xl font-semibold">Schedule</h1>
                        </div>
                        <div class="grid grid-cols-3 border-b-2 border-gray-400 pb-2">
                            <div class="-mt-4 ml-6">
                                <p class="whitespace-nowrap font-semibold">Name : <span class="font-normal">{{ $appointment_details('name') }}</span></p>
                                <p class="whitespace-nowrap font-semibold">Email : <span class="font-normal">{{ $appointment_details('email') }}</span></p>
                                <p class="whitespace-nowrap font-semibold">Contact : <span class="font-normal">{{ $appointment_details('phone') }}</span></p>
                            </div>
                            <div class="-mt-4 ml-6">
                                <p class="whitespace-nowrap font-semibold">Brand : <span class="font-normal">{{ $appointment_details('brand') }}</span></p>
                                <p class="whitespace-nowrap font-semibold">Model : <span class="font-normal">{{ $appointment_details('model') }}</span></p>
                            </div>
                            <div class="-mt-4 text-center">
                                <p>{{ date('F Y, d', strtotime($appointment_details('schedule_date'))) }}</p>
                                <p>{{ $appointment_details('available_time') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col px-20">
                            <table class="w-full -mt-4">
                                <thead class="bg-white">
                                    <tr>
                                        <th class="text-xl font-semibold text-left">Service/s</th>
                                        <th class="text-xl font-semibold text-center">Quantity</th>
                                        <th class="text-xl font-semibold text-center">Price</th>
                                    </tr>
                                </thead>
                                <tbody id="checkout-summary"></tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-center">TOTAL</td>
                                        <td id="quantity-summary" class="text-center"></td>
                                        <td id="total-summary" class="text-center"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="button" id="back-btn" class="btn ml-auto text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                            Back
                        </button>
                        <input type="hidden" id="app_id" value="{{ $appointment_details('app_id') }}">
                        <input type="hidden" id="user_id" value="{{ $appointment_details('user_id') }}">
                        <input type="hidden" id="car_id" value="{{ $appointment_details('car_id') }}">
                        <button id="confirm-booking-btn" type="button" class="btn text-white font-semibold hover:text-yellow-300 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 text-center">
                            Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main> 

    <x-slot:scripts>
        <script src="{{ asset('js/estimator.js') }}"></script>
        <script type="text/javascript">
            $('#confirm-booking-btn').click(function() {
                $('#checkout-summary').html('');
                var data = tableData();

                $.ajax({
                    url: "/save_payment_slip",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    data: {
                        app_id: $('#app_id').val(),
                        user_id: $('#user_id').val(),
                        car_id: $('#car_id').val(),
                        data: data,
                        total_items: $('#total-items').text(),
                        total: $('#total-price').text(),
                    },  
                    success: function(res) {  
                        console.log(res);
                        dialog('border-green-600 text-green-700', 'Booking summary saved.');
                        $('#checkout-page').html('<object data="/pdf.php?pdf=generate_payment_slip" type="application/pdf" async defer class="w-full h-screen">');
                    }
                });
            });

            $('#fuel-type').change(function() {
                var type = $(this).val();
                if (type == 'Diesel') {
                    window.location.href = "/employee/estimator?type=Diesel";
                } else if (type == 'Gas') {
                    window.location.href = "/employee/estimator?type=Gas";
                }
            });
        </script>
    </x-slot:scripts>
</x-layout.employeebody>