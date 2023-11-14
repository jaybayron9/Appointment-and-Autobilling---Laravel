<x-layout.body> 
    <x-slot:links> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
    </x-slot:links>
        
    <x-layout.navbar />  

    <div class="flex justify-center items-center mt-[40px]">
        <div class="w-5/6">
            <div class="flex justify-center items-center mb-5">
                <a href="/" class="flex justify-center items-center  gap-x-3">
                    <img src="{{ asset('storage/system/logo.png') }}" alt="logo" class="h-14 w-14">
                    <p class="font-bold text-2xl mt-1 capitalize font-mono">CJCE</p>
                </a>
            </div>
            <form action="/register" method="POST" class="rounded border border-gray-300 bg-white p-10">
                @csrf
                <div id="alert" hidden class="py-3">
                    <p id="msg" class="border-y border-r border-l-red-600 border-l-4 rounded py-3 px-5 shadow text-red-700 text-[14.5px]"></p>
                </div>
                <div class="grid md:grid-cols-3 grid-cols-1 md:gap-5 justify-center items-center">
                    <div class="cols-span-1 md:pr-5 md:border-r-2 md:border-gray-300">
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="name" class="text-[14.5px]">Full Name</label>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}" id="name" maxlength="50" placeholder="Enter name" class="block w-full border border-gray-300 bg-gray-50 text-sm p-2 rounded outline-none focus:border-gray-400 focus:ring-4 focus:ring-blue-200 focus:transition focus:duration-300">
                            @if ($errors->has('name')) 
                                @foreach ($errors->get('name') as $error) 
                                    <span class="text-xs text-red-700">{{ $error }}</span>
                                @endforeach 
                            @endif
                        </div>
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="email" class="text-[14.5px]">Email Address</label>
                            </div>
                            <input type="text" name="email" value="{{ old('email') }}" id="email" maxlength="50" placeholder="Enter email address"  class="block w-full border border-gray-300 bg-gray-50 text-sm p-2 rounded outline-none focus:border-gray-400 focus:ring-4 focus:ring-blue-200 focus:transition focus:duration-300">
                            @if ($errors->has('email')) 
                                @foreach ($errors->get('email') as $error) 
                                    <span class="text-xs text-red-700">{{ $error }}</span>
                                @endforeach 
                            @endif
                        </div> 
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="phone" class="text-[14.5px]">Phone Number</label>
                            </div>
                            <input type="text" name="phone" value="{{ old('phone') }}" id="phone" maxlength="12" placeholder="ex. 912-345-6781"  class="block w-full border border-gray-300 bg-gray-50 text-sm p-2 rounded outline-none focus:border-gray-400 focus:ring-4 focus:ring-blue-200 focus:transition focus:duration-300">
                            @if ($errors->has('phone')) 
                                @foreach ($errors->get('phone') as $error) 
                                    <span class="block text-xs text-red-700">{{ $error }}</span>
                                @endforeach 
                            @endif
                        </div>
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="password" class="text-[14.5px]">Password</label>
                            </div>
                            <input type="password" name="password" id="password" maxlength="50" placeholder="Enter password"  autocomplete="off" class="block w-full border border-gray-300 bg-gray-50 text-sm p-2 rounded outline-none focus:border-gray-400 focus:ring-4 focus:ring-blue-200 focus:transition focus:duration-300">
                            @if ($errors->has('password'))
                                <ul class="list-disc grid grid-cols-2 ml-4 mt-1">
                                    @foreach ($errors->get('password') as $error)
                                        <li class="text-xs text-red-600">{{ $error }}</li>   
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="mb-2">
                                <label for="pasword-confirmation" class="text-[14.5px]">Confirm Password</label>
                            </div>
                            <input type="password" name="password_confirmation" id="password-confirmation" maxlength="50" placeholder="Re-enter the password"  autocomplete="off" class="block w-full border border-gray-300 bg-gray-50 text-sm p-2 rounded outline-none focus:border-gray-400 focus:ring-4 focus:ring-blue-200 focus:transition focus:duration-300">
                            <span id="confirm-pass-msg" class="text-xs text-red-700"></span>
                        </div>
                    </div>
                    <div class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-x-5 md:mb-20">
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="platenumber" class="text-[14.5px]">Plate number</label>
                            </div>
                            <input type="text" name="platenumber" value="{{ old('platenumber') }}" id="platenumber" maxlength="8" placeholder="Enter plate number ex. XZC 8920"  class="plate_no block w-full border border-gray-300 bg-gray-50 text-sm p-2 rounded outline-none focus:border-gray-400 focus:ring-4 focus:ring-blue-200 focus:transition focus:duration-300 mb-1">
                            @if ($errors->has('platenumber')) 
                                @foreach ($errors->get('platenumber') as $error) 
                                    <span class="text-xs text-red-700">{{ $error }}</span>
                                @endforeach 
                            @endif
                        </div>
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="brand" class="text-[14.5px]">Car Brand</label>
                            </div>
                            <input type="text" name="brand" value="{{ old('brand') }}" id="brand" maxlength="50" placeholder="Enter car brand"  class="block w-full border border-gray-300 bg-gray-50 text-sm p-2 rounded outline-none focus:border-gray-400 focus:ring-4 focus:ring-blue-200 focus:transition focus:duration-300 mb-1">
                            @if ($errors->has('brand')) 
                                @foreach ($errors->get('brand') as $error) 
                                    <span class="text-xs text-red-700">{{ $error }}</span>
                                @endforeach 
                            @endif
                        </div>
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="model" class="text-[14.5px]">Model</label>
                            </div>
                            <input type="text" name="model" value="{{ old('model') }}" id="model" maxlength="50" list="modellist" placeholder="Enter car model" autocomplete="off" class="block w-full border border-gray-300 bg-gray-50 text-sm p-2 rounded outline-none focus:border-gray-400 focus:ring-4 focus:ring-blue-200 focus:transition focus:duration-300">
                            @if ($errors->has('model')) 
                                @foreach ($errors->get('model') as $error) 
                                    <span class="text-xs text-red-700">{{ $error }}</span>
                                @endforeach 
                            @endif
                        </div>
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="color" class="text-[14.5px]">Color</label>
                            </div>
                            <input type="text" name="color" value="{{ old('color') }}" id="color" maxlength="50" placeholder="Enter car color"  autocomplete="off" class="block w-full border border-gray-300 bg-gray-50 text-sm p-2 rounded outline-none focus:border-gray-400 focus:ring-4 focus:ring-blue-200 focus:transition focus:duration-300">
                            @if ($errors->has('color')) 
                                @foreach ($errors->get('color') as $error) 
                                    <span class="text-xs text-red-700">{{ $error }}</span>
                                @endforeach 
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="mb-2">
                                <label for="car type" class="text-[14.5px]">Car Type</label>
                            </div> 
                            <select name="cartype" id="cartype" class="block w-full border border-gray-300 bg-gray-50 text-sm p-2 rounded outline-none focus:border-gray-400 focus:ring-4 focus:ring-blue-200 focus:transition focus:duration-300">
                                <option value="" selected disabled>Select car type</option>
                                <option value="SUV" {{ old('cartype') === 'SUV' ? 'selected' : '' }}>SUV</option>
                                <option value="Sports car" {{ old('cartype') === 'Sports car' ? 'selected' : '' }}>Sports car</option>
                                <option value="Van" {{ old('cartype') === 'Van' ? 'selected' : '' }}>Van</option>
                                <option value="Hatchback" {{ old('cartype') === 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                                <option value="Hybrid car" {{ old('cartype') === 'Hybrid car' ? 'selected' : '' }}>Hybrid car</option>
                                <option value="Coupe" {{ old('cartype') === 'Coupe' ? 'selected' : '' }}>Coupe</option>
                                <option value="Sedan etc." {{ old('cartype') === 'Sedan etc.' ? 'selected' : '' }}>Sedan etc.</option>
                            </select>
                            @if ($errors->has('cartype')) 
                                @foreach ($errors->get('cartype') as $error) 
                                    <span class="text-xs text-red-700">{{ $error }}</span>
                                @endforeach 
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="mb-2">
                                <label for="fuel type" class="text-[14.5px]">Fuel Type</label>
                            </div>
                            <select name="fueltype" id="fueltype"  class="block w-full border border-gray-300 bg-gray-50 text-sm p-2 rounded outline-none focus:border-gray-400 focus:ring-4 focus:ring-blue-200 focus:transition focus:duration-300">
                                <option value="" selected disabled>Select fuel type</option>
                                <option value="Gas" {{ old('fueltype') === 'Gas' ? 'selected' : '' }}>Gas</option>
                                <option value="Diesel" {{ old('fueltype') === 'Diesel' ? 'selected' : '' }}>Diesel</option>
                            </select>
                            @if ($errors->has('fueltype')) 
                                @foreach ($errors->get('fueltype') as $error) 
                                    <span class="text-xs text-red-700">{{ $error }}</span>
                                @endforeach 
                            @endif
                        </div> 
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="transmission" class="text-[14.5px]">Transmission Type</label>
                            </div>
                            <select name="transmission" id="transmission"  class="select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type of car">
                                <option value="" selected disabled>Select transmission type</option>
                                <option value="Automatic" {{ old('transmission') === 'Automatic' ? 'selected' : '' }}>Automatic</option>
                                <option value="Manual" {{ old('transmission') === 'Manual' ? 'selected' : '' }}>Manual</option>
                            </select> 
                            @if ($errors->has('transmission')) 
                                @foreach ($errors->get('transmission') as $error) 
                                    <span class="text-xs text-red-700">{{ $error }}</span>
                                @endforeach 
                            @endif
                        </div>
                    </div>
                </div>
                <div class="md:flex gap-5">
                    <div class="ml-auto flex items-center">
                        <input id="agree" type="checkbox" name="agree" checked  class="w-4 h-4">
                        <label for="agree" class="ml-2 text-sm text-gray-900 select-none">I've read and agree to the <a href="" class="text-blue-700">terms and service.</a></label>
                    </div>
                    <div class="text-center my-2">
                        <button type="submit" class="flex items-center justify-center w-full bg-blue-700 text-base text-white hover:bg-blue-500 py-[6px] px-3 rounded transition duration-200">
                            <span id="submit-txt">Sign up</span>
                            <svg id="spinner" hidden class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="flex mt-3 gap-x-2 justify-center items-center text-sm mb-10">
        <p class="text-[14.5px] text-gray-600">Already have account?</p>
        <a href="/login" class="text-blue-700 hover:underline hover:text-blue-600">Log In</a>
    </div>

    <x-slot:scripts> 
        <script src="{{ asset('js/script.js') }}"></script>
    </x-slot:scripts>
</x-layout.body>