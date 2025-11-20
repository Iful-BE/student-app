<div>
    <h1 class="text-zinc-800 dark:text-white mb-4 text-2xl font-bold">Dashboard Students</h1>

    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 mb-6">
      
        <div class="flex items-center gap-4 p-4 bg-white dark:bg-zinc-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700">
         
            <div class="flex h-12 w-12 items-center justify-center bg-green-100 dark:bg-green-700 rounded-full">
                <svg class="h-6 w-6 text-green-600 dark:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
          
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-300">Active Students</p>
                <p class="text-2xl font-bold text-zinc-800 dark:text-white">{{ $activeStudents }}</p>
            </div>
        </div>

      
        <div class="flex items-center gap-4 p-4 bg-white dark:bg-zinc-800 rounded-xl shadow border border-neutral-200 dark:border-neutral-700">
           
            <div class="flex h-12 w-12 items-center justify-center bg-red-100 dark:bg-red-700 rounded-full">
                <svg class="h-6 w-6 text-red-600 dark:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
         
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-300">Inactive Students</p>
                <p class="text-2xl font-bold text-zinc-800 dark:text-white">{{ $inactiveStudents }}</p>
            </div>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    @foreach($lembagaStudents as $item)
        <div class="flex items-center gap-4 p-4 bg-white rounded-xl shadow border border-neutral-200 dark:border-neutral-700">
         
            <div class="flex h-12 w-12 items-center justify-center bg-blue-100 rounded-full">
                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

          
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->lembaga->nama }}</p>
                <p class="text-2xl font-bold text-zinc-800 dark:text-white">{{ $item->total }} Students</p>
            </div>
        </div>
    @endforeach
</div>

</div>
