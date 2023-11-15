<x-layout.customerbody>  
    <main id="main-content" class="relative h-full overflow-y-auto lg:ml-64">
        <div class="px-4 h-full my-[80px]">
            <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <div class="overflow-x-auto overflow-y-auto" style=" max-height: 700px;">
                    <table id="table" class="stripe hover w-full">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap text-xs text-center uppercase py-2 text-white">Name</th>
                                <th class="whitespace-nowrap text-xs text-center uppercase py-2 text-white">Plate No.</th>
                                <th class="whitespace-nowrap text-xs text-center uppercase py-2 text-white">Services</th>
                                <th class="whitespace-nowrap text-xs text-center uppercase py-2 text-white">Status</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"> 
                            @foreach ($status as $stats) 
                                <tr class="border-b border-gray-300 hover:bg-blue-100">
                                    <td class="capitalize text-center text-sm py-2">{{ $stats->name }}</td>
                                    <td class="capitalize text-center text-sm py-2">{{ $stats->plate_number }}</td>
                                    <td class="capitalize text-center text-sm py-2">{{ $stats->category }}</td>
                                    <td class="capitalize text-center text-sm">
                                        <span class="text-white rounded-md px-2 {{ $stats->appointment_status == 'Underway' ? 'bg-sky-500' : 'bg-green-500' }}">
                                            {{ $stats->appointment_status }} 
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main> 
</x-layout.customerbody>  