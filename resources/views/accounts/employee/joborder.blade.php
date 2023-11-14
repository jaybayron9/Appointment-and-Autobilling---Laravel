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
                        {{-- <tbody id="tbody">
                            <?php 
                            $query = "SELECT ap.id as app_id, ap.*, cs.*, sv.*, bh.*, us.*
                                        FROM appointments ap 
                                        JOIN cars cs ON ap.car_id = cs.id
                                        JOIN services sv ON sv.id = ap.service_type_id
                                        JOIN bussiness_hours bh ON bh.id = ap.service_time_id
                                        JOIN users us ON us.id = ap.user_id
                                    WHERE  
                                        ap.appointment_status <> 'Done' AND 
                                        ap.appointment_status <> 'Pending' AND 
                                        ap.appointment_status <> 'Cancelled'";
    
                            foreach ($conn::DBQuery($query) as $app) {
                                $emp = explode(', ', $app['assigned_employee_id']);
    
                                for ($i = 0; $i < count($emp); $i++) {
                                    if ($emp[$i] == $_SESSION['support_id']) {
                            ?>
                                        <tr data-row-id="<?= $app['app_id'] ?>">
                                            <td class="text-sm capitalize"><?= $app['name'] ?></td>
                                            <td class="text-sm"><?= $app['plate_no'] ?></td>
                                            <td class="flex justify-center gap-x-3">
                                                <select data-row-data="<?= "{$app['app_id']}~{$app['user_id']}~{$app['car_id']}" ?>" class="service-col hover:cursor-pointer" style="height: 33px; padding-top: 3px; padding-right: 35px;">
                                                    <option value="<?= $app['category'] ?>" selected hidden><?= $app['category'] ?></option>
                                                    <?php foreach($conn::select("services") as $serv ) { ?>
                                                    <option value="<?= $serv['category'] ?>"><?= $serv['category'] ?></option>
                                                    <?php } ?> 
                                                </select>
                                            </td> 
                                            <td class="text-sm"><?= date('F d, Y', strtotime($app['schedule_date'])) ?></td>
                                            <td class="text-sm"><?= $app['available_time'] ?></td>
                                            <td class="flex justify-center">
                                                <select data-row-data="<?= $app['app_id'] ?>" class="status-select" style="height: 33px; padding-top: 3px; padding-right: 35px;">
                                                    <option value="" selected hidden><?= $app['appointment_status'] ?></option>
                                                    <option value="Underway">Underway</option>
                                                    <option value="Done">Done</option>
                                                    <option value="Cancelled">Cancel</option>
                                                </select>
                                            </td>
                                        </tr>
                            <?php }
                                }
                            } ?>
                        </tbody> --}}
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
                            url: "?admin_rq=appointment_status",
                            data: {
                                id: id,
                                status: status
                            },
                            success: function(resp) {
                                var tableRow = $('tr[data-row-id="'+ id +'"]');  
                                
                                if (status == "Done" || "Cancelled") {
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
                        window.location.replace(`?vs=_sup/service&serv=${val.toLowerCase()}&app_id=${data[0]}&user_id=${data[1]}&car_id=${data[2]}`);
                    });
        
                    $('.service-col').change(function() {
                        var val = $(this).val();
                        let ids = $(this).data('row-data');
                        let data = ids.split('~');
                        window.location.replace(`?vs=_sup/service&serv=${val.toLowerCase()}&app_id=${data[0]}&user_id=${data[1]}&car_id=${data[2]}`);
                    }); 
                }
            }).columns.adjust().responsive.recalc();
        </script>
    </x-slot:scripts>
</x-layout.employeebody>