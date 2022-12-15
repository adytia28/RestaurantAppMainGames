<div x-data="{showOrder:@entangle('showOrder')}">
    <div class="flex items-center justify-between pb-6">
        <h1 class="text-xl font-semibold">Order List {{$typeOrder != 'all' ? $typeOrder : ''}}</h1>
        <a href="{{route('order.create')}}" class="w-8 h-8 flex items-center justify-center bg-sky-500 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
              </svg>

            </a>
    </div>

    @if($typeOrder == 'all')
    <div class="relative text-sm border border-gray-200 rounded-md w-max mb-4" x-data="{open:false, status:@entangle('status')}">
        <div x-on:click="open = !open" class=" flex items-center space-x-2 px-4 py-2 ">
            <span class="capitalize">{{$status}}</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>
        </div>
        <div x-cloak x-show="open" x-on:click.away="open = false" class="absolute top-10 left-0 w-full bg-white border border-gray-100  cursor-pointer rounded-md shadow-md">
            <div x-on:click="status = 'paid'; open = false" class="px-2 py-2 hover:bg-gray-100 border-b border-gray-100">Paid</div>
            <div x-on:click="status = 'unpaid'; open = false" class="px-2 py-2 hover:bg-gray-100 border-b border-gray-100">Unpaid</div>
        </div>
    </div>
    @endif

    @if(session()->has('orderSuccess'))
        <div class="w-full px-4 py-2 mb-4 text-sm text-white bg-green-500">
            {{session('orderSuccess')}}
        </div>
    @endif

    <table class="table-auto text-sm w-full border border-gray-100">
        <thead class="bg-gray-100 text-gray-600 px-2 py-3">
          <tr>
            <th class="text-left px-2 py-2">No</th>
            <th class="text-left px-2 py-2">Reference Order</th>
            <th class="text-left px-2 py-2 ">Status</th>
            <th class="text-left px-2 py-2">Action</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($orders as $item)
                <tr class="@if($loop->even) bg-gray-50 @endif border border-gray-100 pb-2">
                    <td class="px-2 py-2">{{$loop->iteration}}</td>
                    <td  class="px-2 py-2">{{$item->reference_order}}</td>
                    <td class=" text-sky-500 capitalize">{{$item->payment_status}}</td>
                    <td class="px-2 py-2 flex items-center space-x-2">
                        <a href="{{route('order.show', $item->reference_order)}}" class="w-8 h-8 flex items-center justify-center rounded-md bg-green-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              </svg>
                        </a>
                        @if($item->payment_status == 'unpaid')
                        <div wire:key="showOrder{{$loop->iteration}}" wire:click="showOrder({{$item->reference_order}})" class="bg-sky-500 text-white rounded-md  w-8 h-8 flex items-center cursor-pointer justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                              </svg>
                        </div>
                        @endif
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-3">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
      </table>

        <div x-cloak x-show="showOrder" class="fixed top-0 left-0 right-0 z-50  h-screen">
            <div class="relative  h-screen flex items-center justify-center w-full">
                <div class="absolute top-0 z-10 left-0 right-0 bottom-0 h-screen bg-black bg-opacity-50">

                </div>
                <div class="relative   z-20 bg-white rounded-lg shadow  w-96">
                    <button x-on:click="showOrder = null" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 pt-10">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-semibold text-sm">Ref. Order : {{$showOrder}}</div>
                            </div>
                        </div>
                        <div class="py-4 text-center">
                            Are you sure want update this order to paid ?
                        </div>

                        <div class="flex items-center justify-end pt-4">
                            <button type="button" wire:click="updateOrder()" class="bg-sky-500 text-white px-4 rounded-md py-2 text-sm">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


      <div class="pt-4">
        {{$orders->links()}}
      </div>
</div>
