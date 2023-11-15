<aside id="sidebar" class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal lg:flex" aria-label="Sidebar">
    <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200">
                <ul class="pb-2 space-y-2">
                    <li>
                        <a href="/dashboard" class="{{ Route::currentRouteName() === 'dashboard' ? 'bg-gray-100 shadow border border-gray-300' : '' }} text-gray-700 flex items-center p-4 text-base hover:bg-gray-100 rounded-md group font-semibold text-sm"> 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ Route::currentRouteName() === 'dashboard' ? 'text-gray-900' : 'text-gray-500' }}   group-hover:text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/appointments" class="{{ Route::currentRouteName() == 'appointments' ? 'bg-gray-100 shadow border border-gray-300' : '' }} flex items-center p-4 text-base text-gray-700 hover:bg-gray-100 rounded-md group font-semibold text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 {{  Route::currentRouteName() === 'appointments' ? 'text-gray-900' : 'text-gray-500' }}  group-hover:text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                            <span class="ml-3">Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="/status" class="{{ Route::currentRouteName() == 'status' ? 'bg-gray-100 shadow border border-gray-300' : '' }} flex items-center p-4 text-base text-gray-700 hover:bg-gray-100 rounded-md group font-semibold text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 {{ Route::currentRouteName() == 'status' ? 'text-gray-900' : 'text-gray-500' }} group-hover:text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                            <span class="ml-3">Status</span>
                        </a>
                    </li>
                    <li>
                        <a href="/history" class="{{ Route::currentRouteName() == 'history' ? 'bg-gray-100 shadow border border-gray-300' : '' }} flex items-center p-4 text-base text-gray-700 hover:bg-gray-100 rounded-md group font-semibold text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 {{ Route::currentRouteName() == 'history' ? 'text-gray-900' : 'text-gray-500' }}   group-hover:text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                            </svg>
                            <span class="ml-3">History</span>
                        </a>
                    </li>
                    <li>
                        <a href="/cars" class="{{ Route::currentRouteName() == 'cars' ? 'bg-gray-100 shadow border border-gray-300' : '' }} flex items-center p-4 text-base text-gray-700 hover:bg-gray-100 rounded-md group font-semibold text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-6 w-6 {{ Route::currentRouteName() == 'cars' ? 'text-gray-900' : 'text-gray-500' }} group-hover:text-gray-900" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 20H5V21C5 21.5523 4.55228 22 4 22H3C2.44772 22 2 21.5523 2 21V12L4.51334 5.29775C4.80607 4.51715 5.55231 4 6.386 4H17.614C18.4477 4 19.1939 4.51715 19.4867 5.29775L22 12V21C22 21.5523 21.5523 22 21 22H20C19.4477 22 19 21.5523 19 21V20ZM4.136 12H19.864L17.614 6H6.386L4.136 12ZM6.5 17C7.32843 17 8 16.3284 8 15.5C8 14.6716 7.32843 14 6.5 14C5.67157 14 5 14.6716 5 15.5C5 16.3284 5.67157 17 6.5 17ZM17.5 17C18.3284 17 19 16.3284 19 15.5C19 14.6716 18.3284 14 17.5 14C16.6716 14 16 14.6716 16 15.5C16 16.3284 16.6716 17 17.5 17Z"></path></svg>
                            <span class="ml-3">My Car</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50" id="sidebarBackdrop"></div>