<div x-data="{showStock:@entangle('showStock')}">
    <div class="flex items-center justify-between pb-6">
        <h1 class="text-xl font-semibold">Stock List</h1>
    </div>

    @if(session()->has('updateSuccess'))
        <div class="w-full px-4 py-2 mb-4 text-sm text-white bg-green-500">
            {{session('updateSuccess')}}
        </div>
    @endif

    <table class="table-auto text-sm w-full border border-gray-100">
        <thead class="bg-gray-100 text-gray-600 px-2 py-3">
          <tr>
            <th class="text-left px-2 py-2">No</th>
            <th class="text-left px-2 py-2">Menu</th>
            <th class="text-left px-2 py-2 ">Stock</th>
            <th class="text-left px-2 py-2">Action</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($stocks as $item)
                <tr class="@if($loop->even) bg-gray-50 @endif border border-gray-100 pb-2">
                    <td class="px-2 py-2">{{$loop->iteration}}</td>
                    <td  class="px-2 py-2">{{$item->menuVariant->menu->name}} {{$item->menuVariant->name}}</td>
                    <td class=" text-sky-500 capitalize">{{$item->stock}}</td>
                    <td class="px-2 py-2 flex items-center space-x-2">
                        <div wire:key="showStock{{$loop->iteration}}" wire:click="showStock({{$item->id}})" class="bg-sky-500 text-white rounded-md  w-8 h-8 flex items-center cursor-pointer justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                              </svg>
                        </div>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-3">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
      </table>

        <div x-cloak x-show="showStock" class="fixed top-0 left-0 right-0 z-50  h-screen">
            <div class="relative  h-screen flex items-center justify-center w-full">
                <div class="absolute top-0 z-10 left-0 right-0 bottom-0 h-screen bg-black bg-opacity-50">

                </div>
                <div class="relative   z-20 bg-white rounded-lg shadow  w-96">
                    <button x-on:click="showStock = null" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 pt-10">
                        <h1>Update Stock</h1>

                        <div class="text-xs pt-8">
                            <label for="addStock">Stock</label>
                            <input type="number" wire:model.debounce.500ms="addStock" class="w-full py-2 px-2 rounded-md border border-gray-300 text-sm" placeholder="Masukkan penambahan stock">
                        </div>
                        <div class="flex items-center justify-end pt-4">
                            <button type="button" wire:click="updateStock()" class="bg-sky-500 text-white px-4 rounded-md py-2 text-sm">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


      <div class="pt-4">
        {{$stocks->links()}}
      </div>
</div>
