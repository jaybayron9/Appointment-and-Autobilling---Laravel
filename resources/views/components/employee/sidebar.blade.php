<aside id="sidebar" class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
    <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200">
                <ul class="pb-2 space-y-2">
                    <li>
                        <a href="/employee" class="{{ Route::currentRouteName() === 'employee.dashboard' ? 'bg-gray-100 shadow border border-gray-300' : '' }} flex items-center p-4 text-gray-700 hover:bg-gray-100 rounded-md group font-semibold text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ Route::currentRouteName() === 'employee.dashboard' ? 'text-gray-900' : 'text-gray-500' }} group-hover:text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/employee/job_order" class="{{ Route::currentRouteName() === 'employee.job_order' ? 'bg-gray-100 shadow border border-gray-300' : '' }} flex items-center p-4 text-gray-700 hover:bg-gray-100 rounded-md group font-semibold text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ Route::currentRouteName() === 'admin.employees' ? 'text-gray-900' : 'text-gray-500' }}   group-hover:text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="ml-3">Job Order</span>
                        </a>
                    </li>
                    <li>
                        <a href="?vs=_sup/serv_his" class="{{ Route::currentRouteName() === 'admin.employees' ? 'bg-gray-100 shadow border border-gray-300' : '' }} flex items-center p-4 text-gray-700 hover:bg-gray-100 rounded-md group font-semibold text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ Route::currentRouteName() === 'admin.employees' ? 'text-gray-900' : 'text-gray-500' }}   group-hover:text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-3">Service History</span>
                        </a>
                    </li>
                    <li>
                        <a href="?vs=_sup/service" class="{{ Route::currentRouteName() === 'admin.employees' ? 'bg-gray-100 shadow border border-gray-300' : '' }} flex items-center p-4 text-gray-700 hover:bg-gray-100 rounded-md group font-semibold text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ Route::currentRouteName() === 'admin.employees' ? 'text-gray-900' : 'text-gray-500' }}   group-hover:text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <span class="ml-3">Estimator</span>
                        </a>
                    </li>
                </ul> 
            </div>
        </div> 
    </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>