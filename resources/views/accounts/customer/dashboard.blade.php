<x-layout.body>
    <x-customer.topbar /> 
    <x-customer.sidebar />

    {{-- <script src='assets/js/fullcallendar.min.js'></script> --}}
    <script type="text/javascript"> 
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', 
                height: 'auto',  
                eventOrder: 'start', 
                eventSources: [
                    {
                        url: '?user_rq=my_appointments',
                        type: 'POST',
                        data: { app_id:  },
                        success: function(resp) { 
                            var events = [];
                            for (var i = 0; i < resp.length; i++) {
                                events.push({
                                    title: resp[i].category,
                                    start: resp[i].schedule_date, 
                                });
                            } 
                            calendar.setOption('events', events); 
                        }
                    },
                ], 
            });
            calendar.render();
        }); 
    </script>

    <main id="main-content" class="relative overflow-y-auto lg:ml-64">
        <div class="px-4 my-[80px]">
            <div class="p-5 mt-6 lg:mt-0 rounded shadow bg-white">
                <h1 class="font-bold text-3xl font-sans mb-3 text-center">Welcome to CJCE Autoparts</h1>
                <div id="calendar"></div>
            </div>
        </div>
    </main> 
</x-layout.body>