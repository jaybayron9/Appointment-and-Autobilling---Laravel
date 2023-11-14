<div id="create-appointment" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <form id="appointment-form" class="relative bg-white rounded-lg shadow">
            {{ csrf_field() }}
            <div class="flex items-start justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Appointment Form
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="create-appointment">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div> 
            <div>
                <div class="px-6 py-4">
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Your car(s)</label>
                            <select name="car_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @foreach ($cars as $car)
                                    <option value="<?= $car->id ?>"><?= $car->plate_number ?></option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="service" class="block mb-2 text-sm font-medium text-gray-900">Service</label>
                            <select name="service" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                <option value="" selected disabled>Select service</option>
                                @foreach ($services as $service)
                                    <option value="<?= $service->id ?>"><?= $service->category ?></option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Schedule Date</label>
                            <input type="date" name="schedule_date" id="date" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                        <div>
                            <label for="service_time" class="block mb-2 text-sm font-medium text-gray-900">Service Time</label>
                            <select name="time" id="time" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                <option value="" selected disabled>Select time</option> 
                                @foreach ($bussiness_hours as $buss) {
                                    <option value='{{ $buss->id }}'>{{ $buss->available_time }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                <button data-modal-hide="create-appointment" type="button" class="btn ml-auto text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                <button type="submit" class="btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $('#appointment-form').submit(function(e) {
        e.preventDefault(); 
        $.post("/book_appointment", $(this).serialize(), (res) => {
            window.location.replace('/appointments')
        });  
    }); 

    var currentDate = new Date().toISOString().split('T')[0];
    $('#date').attr('min', currentDate);
</script>