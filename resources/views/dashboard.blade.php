<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center justify-center p-3 bg-indigo-100 rounded-full">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Welcome back, {{ Auth::user()->name }}!</h3>
                            <p class="mt-1 text-sm text-gray-600">This is your personal dashboard.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Orders Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Orders</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ Auth::user()->orders()->count() }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="{{ route('orders.index') }}" class="font-medium text-blue-600 hover:text-blue-500"> View all orders <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                </div>

                <!-- Cart Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v5a2 2 0 01-2 2H9a2 2 0 01-2-2v-5m6-5V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Items in Cart</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ \App\Models\Cart::where('user_id', Auth::id())->sum('quantity') }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="{{ route('cart.index') }}" class="font-medium text-green-600 hover:text-green-500"> View cart <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                </div>

                <!-- Account Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Account Settings</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-sm text-gray-900">Manage your profile</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="{{ route('profile.edit') }}" class="font-medium text-purple-600 hover:text-purple-500"> Edit profile <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Orders</h3>
                    @php
                        $recentOrders = Auth::user()->orders()->latest()->limit(3)->get();
                    @endphp
                    @if($recentOrders->count() > 0)
                        <ul class="divide-y divide-gray-200">
                            @foreach($recentOrders as $order)
                                <li class="py-4">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-medium text-gray-900">#{{ $order->id }}</div>
                                        <div class="text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</div>
                                    </div>
                                    <div class="mt-2 flex items-center justify-between">
                                        <div class="text-sm text-gray-500">
                                            <span class="font-medium">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $order->status === 'delivered' ? 'green' : 'yellow' }}-100 text-{{ $order->status === 'delivered' ? 'green' : 'yellow' }}-800">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">View</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @if(Auth::user()->orders()->count() > 3)
                            <div class="mt-4 text-sm">
                                <a href="{{ route('orders.index') }}" class="font-medium text-blue-600 hover:text-blue-500">View all orders <span aria-hidden="true">&rarr;</span></a>
                            </div>
                        @endif
                    @else
                        <p class="text-sm text-gray-500">You haven't placed any orders yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>