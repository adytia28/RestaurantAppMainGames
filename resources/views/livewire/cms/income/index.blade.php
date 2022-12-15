<div x-data="{showOrder:@entangle('showOrder')}">
    <div class="flex items-center justify-between pb-6">
        <h1 class="text-xl font-semibold ">Order {{ucfirst($typeIncome)}} Paid Income</h1>
        <a href="{{route('home')}}" class="px-2 py-2 flex items-center text-white text-sm font-bold space-x-2 bg-sky-500 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
            <span>Back</span>
        </a>
    </div>

    <table class="table-auto text-sm w-full border border-gray-100">
        <thead class="bg-gray-100 text-gray-600 px-2 py-3">
          <tr>
            <th class="text-left px-2 py-2">No</th>
            <th class="text-left px-2 py-2">Reference Order</th>
            <th class="text-left px-2 py-2 ">Status</th>
            <th class="text-left px-2 py-2 ">Total Order</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($income as $item)
                <tr class="@if($loop->even) bg-gray-50 @endif border border-gray-100 pb-2">
                    <td class="px-2 py-2">{{$loop->iteration}}</td>
                    <td  class="px-2 py-2">{{$item->order->reference_order}}</td>
                    <td class="px-2 py-2 text-sky-500 capitalize">{{$item->order->payment_status}}</td>
                    <td class="px-2 py-2 text-sky-500 capitalize">Rp {{number_format($item->total_order, 0, ',', '.')}}</td>
                </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-3">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
      </table>


      <div class="pt-4">
        {{$income->links()}}
      </div>
</div>
