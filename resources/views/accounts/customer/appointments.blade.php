<x-layout.customerbody>  
    <main class="relative h-full overflow-y-auto lg:ml-64">
        <div class="px-4 h-full my-[80px]">
            <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <div class="overflow-x-auto overflow-y-auto p-1" style=" max-height: 700px;">
                    <table id="table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th data-priority="1" class="whitespace-nowrap uppercase text-xs text-center text-white">Plate no.</th> 
                                <th data-priority="3" class="whitespace-nowrap uppercase text-xs text-center text-white">Service</th>
                                <th data-priority="4" class="whitespace-nowrap uppercase text-xs text-center text-white">Date Scheduled</th>
                                <th data-priority="5" class="whitespace-nowrap uppercase text-xs text-center text-white">Service Time</th>
                                <th data-priority="6" class="whitespace-nowrap uppercase text-xs text-center text-white">Status</th>
                                <th data-priority="7" data-priority="1" class="whitespace-nowrap uppercase text-xs text-center text-white">Date created</th>
                                <th data-priority="2" class="whitespace-nowrap uppercase text-xs text-white text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($appointments as $appointment) 
                                <tr data-row-id="<?= $appointment->id ?>">
                                    <td class="text-sm"><?= $appointment->plate_number ?></td>
                                    <td class="text-sm text-center"><?= $appointment->category ?></td>
                                    <td class="text-sm"><?= date('F d, Y', strtotime($appointment->schedule_date)) ?></td>
                                    <td class="text-sm"><?= $appointment->available_time ?></td>
                                    <td class="text-sm status flex justify-center">
                                        <span class="text-white rounded-md px-2 font-semibold <?= $appointment->appointment_status == 'Pending' || $appointment->appointment_status == 'Confirmed' ? 'bg-green-500' : 'bg-red-500';  ?>">
                                            <?= $appointment->appointment_status ?>
                                        </span>
                                    </td>
                                    <td class="text-sm"><?= date('F d, Y', strtotime($appointment->created_at)) ?></td>
                                    <td class="flex gap-x-2 justify-center text-sm"> 
                                        @if ($appointment->appointment_status !== 'Cancelled')
                                            <button data-row-data="<?= $appointment->id ?>" class="cancel-btn font-semibold bg-red-500 hover:bg-red-700 text-white px-2 rounded shadow-md">
                                                Cancel
                                            </button> 
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main> 

    <x-slot:scripts>  
        <script type="text/javascript"> 
            var table = $('#table').DataTable({
                ordering: false,
                responsive: true,
                "lengthMenu": [10, 25, 50, 100, 1000], 
                "drawCallback": () => {
                    $('.cancel-btn').click(function() { 
                        var id = $(this).data('row-data'); 

                        swal({
                            text: "Are you sure you want to cancel this appointment?",
                            icon: "warning",
                            buttons: ["No", "Yes"],
                            dangerMode: true,
                        })
                        .then((cancel) => {
                            if (cancel) { 
                                $.ajax({
                                    method: "POST",
                                    url: `/cancel_appointment/${id}`, 
                                    headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }, 
                                    success: (res) => {
                                        console.log(res)
                                        var tableRow = $('tr[data-row-id="' + id + '"]'); 
                                        tableRow.find('.status').html('<span class="text-white rounded-md px-2 bg-red-500 bg-red-500">Cancelled</span>');
                                        tableRow.find('.cancel-btn').hide();

                                        dialog('border-green-600 text-green-700', 'Appointment successfully cancelled.');
                                    }
                                }); 
                            }
                        }) 
                    }); 
                }
            }).columns.adjust().responsive.recalc();  
        </script> 
    </x-slot:scripts>
</x-layout.customerbody>