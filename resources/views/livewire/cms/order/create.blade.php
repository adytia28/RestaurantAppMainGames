<div class="space-y-8 bg-white shadow-md p-4 w-full">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Create Order</h1>
    </div>

    <div class="space-y-4" x-data="{total:@entangle('total'), totalAlpine:1, stock:1, orderId:0}" x-effect="total = totalAlpine">
        <div class="flex items-center space-x-2 justify-between" x-data="{open:false}">
            <div class="relative w-full border-gray-300 rounded-md cursor-pointer text-sm border px-2 py-2">
                <div x-on:click="open = !open" class="w-full">{{$this->category[$this->selectCategory]['name'] ?? 'Pilih Categories'}}</div>
                <div x-cloak x-show="open" x-on:click.away="open = false" class="absolute top-10 bg-white z-20 rounded-md left-0 cursor-pointer border border-gray-100 w-full ">
                    @foreach ($category as $key => $item)
                    <div wire:click="setCategory({{$key}}, {{$item['id']}})" x-on:click="open = false" class="px-4 py-2 border-b border-gray-100 hover:bg-gray-100">{{$item['name']}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        @error('selectCategory')
        <div class="text-xs -mt-6 text-rose-500">{{$message}}</div>
        @enderror

        <div class="flex items-center space-x-2 justify-between" x-data="{open:false}">
            @if(is_numeric($selectCategory))
                <div class="relative w-full border-gray-300 rounded-md cursor-pointer text-sm border px-2 py-2">
                    <div x-on:click="open = !open"  class="w-full ">{{$this->menu[$this->selectMenu]['name'] ?? 'Pilih Menu'}}</div>
                    <div x-cloak x-show="open" x-on:click.away="open = false" class="absolute top-10 bg-white z-20 rounded-md left-0 cursor-pointer border border-gray-100 w-full ">
                        @foreach ($menu as $key => $item)
                        <div wire:click="setMenu({{$key}}, {{$item['id']}})" x-on:click="open = false" class="px-4 py-2 border-b border-gray-100 hover:bg-gray-100">{{$item['name']}}</div>
                        @endforeach
                    </div>
                </div>
            @else
            <div class="relative w-full border-gray-300 bg-gray-100 rounded-md cursor-pointer text-sm border px-2 py-2">
                <div class="w-full ">{{$this->menu[$this->selectMenu]['name'] ?? 'Pilih Menu'}}</div>
            </div>
            @endif
        </div>
        @error('selectMenu')
        <div class="text-xs -mt-6 text-rose-500">{{$message}}</div>
        @enderror

        <div class="flex items-center space-x-2 justify-between" x-data="{open:false}">
            @if(is_numeric($selectMenu))
            <div class="relative w-full border-gray-300 rounded-md cursor-pointer text-sm border px-2 py-2">
                <div x-on:click="open = !open" class="w-full">{{$this->menuVariant[$this->selectMenuVariant]['name'] ?? 'Pilih Menu Variant'}}</div>
                <div x-cloak x-show="open" x-on:click.away="open = false" class="absolute top-10 bg-white z-20 rounded-md left-0 cursor-pointer border border-gray-100 w-full ">
                    @forelse ($menuVariant as $key => $item)
                        @if(isset($stockOrderId[$item['id']]) && $stockOrderId[$item['id']] >= $item->menuVariantDetail->stock)
                        <div class="bg-gray-100 px-4 py-2 border-b border-gray-100 hover:bg-gray-100">{{$item['name']}} - <span class="text-rose-500 text-xs">Order is sufficient stock</span></div>
                        @elseif($item->menuVariantDetail->stock > 0)
                        <div  wire:key="setMenuVariant{{$key}}"  wire:click="setMenuVariant({{$key}})" x-on:click="open = false; stock = {{$item->menuVariantDetail->stock}};orderId = {{$item->id}};totalAlpine = 1" class="px-4 py-2 border-b border-gray-100 hover:bg-gray-100">{{$item['name']}}</div>
                        @else
                        <div class="bg-gray-100 px-4 py-2 border-b border-gray-100 hover:bg-gray-100">{{$item['name']}} - <span class="text-rose-500 text-xs">Out of stock</span></div>
                        @endif
                     @endforeach
                </div>
            </div>
            @else
            <div class="relative w-full border-gray-300 bg-gray-100 rounded-md cursor-pointer text-sm border px-2 py-2">
                <div class="w-full ">{{$this->menu[$this->selectMenuVariant]['name'] ?? 'Pilih Menu Variant'}}</div>
            </div>
            @endif
        </div>
        @error('selectMenuVariant')
        <div class="text-xs -mt-6 text-rose-500">{{$message}}</div>
        @enderror

        <div >
            <div >
                <div class="flex items-center space-x-2 justify-end" x-data="{stockOrderId:@entangle('stockOrderId')}">
                    <div class="flex items-center">
                        <div class="px-2 py-1 border border-gray-100 rounded-md" x-on:click="totalAlpine > 1 ? totalAlpine-- : ''">-</div>
                        <div class="px-2 py-1" x-text="totalAlpine"></div>
                        <div class="px-2 py-1 border border-gray-100 rounded-md" x-on:click="stock > totalAlpine + (stockOrderId[orderId] ?? 0) ? totalAlpine++ : ''">+</div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end space-x-2 mt-3">
                @if(is_numeric($selectMenuVariant))
                <button wire:key="addMenu"  wire:click="addMenu" x-on:click="totalAlpine = 1" type="button" class=" flex items-center justify-center rounded-md text-sm  px-4 py-2 shadow-md bg-sky-500 text-white">
                    Tambah Menu
                 </button>
                 @else
                 <button  disabled type="button" class="flex items-center justify-center rounded-md text-sm  px-4 py-2 shadow-md bg-sky-300 text-white">
                    Tambah Menu
                 </button>
                 @endif
                 <a href="{{route('order.index')}}" class="bg-sky-500 text-white px-4 py-2 rounded-md text-sm">Back</a>
            </div>
        </div>
    </div>

    @if($menuOrder)
    <div class="text-gray-600 text-sm space-y-2">
        @foreach ($menuOrder as $key => $item)
            <div class="relative shadow-md rounded-md p-2 border border-gray-200">
                <h2 class="bg-sky-100 text-sky-500 absolute -top-1 px-2 py-1 text-xs -left-1 font-bold text-md">{{$key}}</h2>
                @foreach ($item ?? [] as $keyMenu => $subItem)
                    @foreach ($subItem as $subChildItem)
                        <div class=" border-gray-100 relative mt-4 shadow-md rounded-md border pt-8 pb-3 px-4">
                            <div wire:click="deleteMenu('{{$key}}', '{{$subChildItem['menu']['name']}}', '{{$subChildItem['menuVariant']['name']}}', {{$subChildItem['menuVariant']['id']}})" class="absolute -top-2 -right-0 px-1 bg-white py-1 border border-gray-100 rounded-md cursor-pointer ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>{{$subChildItem['total']}} x {{$subChildItem['menu']['name']}}</span>
                                <span class="font-bold">{{$subChildItem['total']}} x {{number_format($subChildItem['menu']['price'],0, ',', '.')}}</span>
                            </div>
                            <div class="pl-4 ">
                                <h3 class="font-bold">
                                    Variant Menu
                                </h3>
                                <div class="flex items-center justify-between">
                                    <span>{{$subChildItem['menuVariant']['name']}}</span>
                                    <span class="font-bold">{{$subChildItem['total']}} x {{number_format($subChildItem['menuVariant']['menu_variant_detail']['price'], 0, ',', '.') ?? null}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        @endforeach
        <div class="flex items-center justify-end">
            <div class="font-bold text-lg pt-4">Total : Rp {{number_format($totalPrice, 0, ',', '.')}}</div>
        </div>
        <div class="flex items-center justify-end space-x-2 pt-3">
            <button wire:click="order" type="button" class="flex items-center justify-center rounded-md text-sm  px-4 py-2 shadow-md bg-green-400 text-white">
               Order
            </button>
            <a href="{{route('order.index')}}" class="bg-sky-500 text-white px-4 py-2 rounded-md text-sm">Back</a>
        </div>
    </div>
    @endif

</div>

