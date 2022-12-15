<div>
    <div id="printable">
        <h1 style="font-weight:bold;font-size:14" >Ref. Order - {{$orders->reference_order}}</h1>
        <div style="padding-top:18px">

            @foreach ($orders->orderDetail as $subItem)
            @php
                $menuVariant = $subItem->menuVariant;
                $menu = $subItem->menuVariant->menu;
                $menuVariantDetail = $subItem->menuVariant->menuVariantDetail;
            @endphp
                <div style="display:flex;align-content:items-center;justify-content:space-between;">
                    <span>{{$loop->iteration}}. {{$menu->name}} {{$menuVariant->name}}</span>
                    <span>{{$subItem->total_item}} x {{number_format(($menu->price + $menuVariantDetail->price), 0, ',', '.')}}</span>
                </div>
            @endforeach
            <div  style="display:flex;align-content:items-center;justify-content:end;font-weight:bold;padding-top:18px">
                Total : Rp {{number_format($orders->orderPayment->total_order, 0, ',', '.')}}
            </div>

        </div>
    </div>
    <div class="flex items-center justify-end space-x-2 pt-6">
        <a href="{{route('order.index')}}" class="bg-sky-500 text-white px-4 py-2 rounded-md text-sm">Back</a>
        <a onclick="printPageArea('printable')" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-md text-sm">Print</a>
    </div>
    <script>
        function printPageArea(areaID){
            var divContents = document.getElementById(areaID).innerHTML;
            var a = window.open('', '', 'height=auto, width=auto');
            a.document.write('<html>');
            a.document.write('<body > ');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>
</div>
