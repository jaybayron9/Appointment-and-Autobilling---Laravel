<x-layout.employeebody>
    <main id="main-content" class="relative h-full overflow-y-auto lg:ml-64">
        <div class="px-4 h-full my-[80px]">
            <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <div class="overflow-x-auto overflow-y-auto p-1" style=" max-height: 700px;">
                    <table id="table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th data-priority="1" class="whitespace-nowrap text-xs text-center uppercase text-white">Name</th>
                                <th data-priority="3" class="whitespace-nowrap text-xs text-center uppercase text-white">Plate no.</th>
                                <th data-priority="4" class="whitespace-nowrap text-xs text-center uppercase text-white">Service</th> 
                                <th data-priority="6" class="whitespace-nowrap text-xs text-center uppercase text-white">Date Scheduled</th>
                                <th data-priority="7" class="whitespace-nowrap text-xs text-center uppercase text-white">Service Time</th> 
                                <th data-priority="2" class="whitespace-nowrap text-xs text-center uppercase text-white">Status (Action)</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($appointments as $appointment)
                                @php $emp = explode(', ', $appointment->assigned_employee_id); @endphp

                                @for ($i = 0; $i < count($emp); $i++)
                                    @if ($emp[$i] == auth()->user()->employee_id)
                                        <tr data-row-id="{{ $appointment->id }}">
                                            <td class="text-sm capitalize">{{ $appointment->name }}</td>
                                            <td class="text-sm">{{ $appointment->plate_number }}</td>
                                            <td class="flex justify-center gap-x-3">
                                                <select data-row-data="{{ "{$appointment->id}~{$appointment->user_id}~{$appointment->car_id}" }}" class="service-col hover:cursor-pointer" style="height: 33px; padding-top: 3px; padding-right: 35px;">
                                                    <option value="{{ $appointment->category }} " selected hidden>{{ $appointment->category }}</option>
                                                    @foreach($services as $serv )
                                                        <option value="{{ $serv->category }}">{{ $serv->category }}</option>
                                                    @endforeach
                                                </select>
                                            </td> 
                                            <td class="text-sm"><?= date('F d, Y', strtotime($appointment->schedule_date)) ?></td>
                                            <td class="text-sm"><?= $appointment->available_time ?></td>
                                            <td class="flex justify-center">
                                                <select data-row-data="<?= $appointment->id ?>" class="status-select" style="height: 33px; padding-top: 3px; padding-right: 35px;">
                                                    <option value="" selected hidden><?= $appointment->appointment_status ?></option>
                                                    <option value="Underway">Underway</option>
                                                    <option value="Done">Done</option>
                                                    <option value="Cancelled">Cancel</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endif
                                @endfor
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
                responsive: true,
                "lengthMenu": [10, 25, 50, 100, 1000],
                "drawCallback": () => {
                    $('.status-select').change(function() {
                        var id = $(this).data('row-data');
                        var status = $(this).val();
                        $.ajax({
                            type: "POST",
                            url: "/employee/update_appointment_status",
                            data: {
                                id: id,
                                status: status
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                            },
                            success: (res) => {
                                console.log(res);
                                var tableRow = $('tr[data-row-id="'+ id +'"]');  
                                
                                if (status === "Confirmed" || status === "Cancelled" || status === "Done") {
                                    table.row(tableRow).remove().draw();
                                }
                                
                                dialog('border-green-600 text-green-700', 'Appointment status successfully updated.');
                            }
                        });
                    });
        
                    $('.service-col').dblclick(function() {
                        var val = $(this).val();
                        let ids = $(this).data('row-data');
                        let data = ids.split('~');
                        window.location.replace(`/employee/estimator?serv=${val.toLowerCase()}&app_id=${data[0]}&user_id=${data[1]}&car_id=${data[2]}`);
                    });
        
                    $('.service-col').change(function() {
                        var val = $(this).val();
                        let ids = $(this).data('row-data');
                        let data = ids.split('~');
                        window.location.replace(`/employee/estimator?serv=${val.toLowerCase()}&app_id=${data[0]}&user_id=${data[1]}&car_id=${data[2]}`);
                    }); 
                }
            }).columns.adjust().responsive.recalc();
        </script>
    </x-slot:scripts>
</x-layout.employeebody>