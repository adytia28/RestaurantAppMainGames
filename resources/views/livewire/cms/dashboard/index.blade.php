<div>
    <h1 class="font-semibold text-xl">Dashboard</h1>

    <div class="grid grid-cols-12 gap-8 pt-8">
        <div wire:click="showListIncome('weekly')" class="col-span-4 cursor-pointer border border-gray-200 rounded-md p-4 bg-gray-50 hover:bg-gray-100">
            <h2 class="font-bold text-md flex items-center justify-between">
                Weekly income
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
            </h2>
            <div class="pt-4 text-right text-green-500 font-bold text-lg">
                Rp {{number_format($weeklyIncome, 0, ',', '.')}}
            </div>
        </div>
        <div wire:click="showListIncome('monthly')" class="col-span-4 cursor-pointer border border-gray-200 rounded-md p-4 bg-gray-50 hover:bg-gray-100">
            <h2 class="font-bold text-md flex items-center justify-between">
                Monthly income
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
            </h2>
            <div class="pt-4 text-right text-green-500 font-bold text-lg">
                Rp {{number_format($monthlyIncome, 0, ',', '.')}}
            </div>
        </div>
        <div wire:click="showListIncome('annual')" class="col-span-4 cursor-pointer border border-gray-200 rounded-md p-4 bg-gray-50 hover:bg-gray-100">
            <h2 class="font-bold text-md flex items-center justify-between">
                Annual income
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
            </h2>
            <div class="pt-4 text-right text-green-500 font-bold text-lg">
                Rp {{number_format($annualIncome, 0, ',', '.')}}
            </div>
        </div>

        <div wire:click="showListOrder('daily')" class="col-span-4 cursor-pointer border border-gray-200 rounded-md p-4 bg-gray-50 hover:bg-gray-100">
            <h2 class="font-bold text-md flex items-center justify-between">
                Daily Orders
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                </svg>
            </h2>
            <div class="pt-4 text-right text-green-500 font-bold text-lg">
                {{number_format($dailyOrder, 0, ',', '.')}}
            </div>
        </div>

        <div wire:click="showListOrder('monthly')" class="col-span-4 cursor-pointer border border-gray-200 rounded-md p-4 bg-gray-50 hover:bg-gray-100">
            <h2 class="font-bold text-md flex items-center justify-between">
                Monthly Orders
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                  </svg>

            </h2>
            <div class="pt-4 text-right text-green-500 font-bold text-lg">
                {{number_format($monthlyOrder, 0, ',', '.')}}
            </div>
        </div>

        <div wire:click="showListOrder('annual')" class="col-span-4 cursor-pointer border border-gray-200 rounded-md p-4 bg-gray-50 hover:bg-gray-100">
            <h2 class="font-bold text-md flex items-center justify-between">
                Annual Orders
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                  </svg>

            </h2>
            <div class="pt-4 text-right text-green-500 font-bold text-lg">
                {{number_format($annualOrder, 0, ',', '.')}}
            </div>
        </div>

    </div>
    <div class="mt-8 ">
        <h3 class="font-bold text-lg">Note :</h3>
        <div class="text-rose-500 italic text-xs">* Click menu to see detail list</span>
    </div>
</div>
