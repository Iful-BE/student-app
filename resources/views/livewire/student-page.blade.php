<div>

    @include('components.toast')

    <div class="relative flex flex-col w-full h-full text-slate-700 rounded-xl bg-clip-border overflow-auto">
     
      
        <div class="relative  my-4 text-slate-700 bg-white dark:bg-zinc-800 dark:text-white rounded-none bg-clip-border">
           <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h3 class="text-lg font-semibold text-slate-800  dark:bg-zinc-800 dark:text-white ">Students List</h3>

                <div class="flex items-center gap-2 mt-2">
                    <select wire:model.live="perPage"
                        class="rounded border border-slate-300 bg-white  dark:bg-zinc-800 dark:text-white py-2.5 px-4 text-sm font-normal text-slate-700 
                        focus:ring focus:ring-slate-300 focus:border-blue-500 transition-all cursor-pointer">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="50">100</option>
                    </select>
                    <label class="text-sm font-semibold text-slate-600  dark:bg-zinc-800 dark:text-white">Show</label>
                </div>
            </div>

         
            <div class="flex flex-col gap-2 w-full md:w-auto md:flex-row md:items-center">

                <div class="relative w-full md:w-auto">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input
                        wire:model.live="search"
                        class="w-full md:w-72 bg-gray-50 border  dark:bg-zinc-800 dark:text-white border-gray-300 text-gray-900 text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block pl-10 p-2.5"
                        placeholder="Search NIS or Name">
                </div>

             
                <select wire:model.live="filterLembaga"
                    class="rounded border border-slate-300 bg-white  dark:bg-zinc-800 dark:text-white py-2.5 px-4 text-sm text-slate-700  cursor-pointer 
                    focus:ring focus:ring-slate-300 focus:border-blue-500 transition-all">
                    <option value="">All Institution</option>
                    @foreach($lembagas as $l)
                    <option value="{{ $l->id }}">{{ $l->nama }}</option>
                    @endforeach
                </select>
                <button 
                    wire:click="openModal"
                    class="px-4 py-2 rounded-lg bg-gray-900  dark:bg-orange-600 dark:hover:bg-orange-700 dark:text-white text-white font-semibold text-sm hover:bg-gray-700 cursor-pointer">
                    + Add Student
                </button>

                <button 
                    wire:click="exportExcel"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-semibold hover:bg-green-700 cursor-pointer">
                    Export Excel
                </button>

            </div>
        </div>

        </div>

        <div class="p-0 overflow-scroll">
            <div x-data="{ isOpen: false, photoUrl: '' }">
           <table class="w-full mt-4 text-left table-auto min-w-max border-collapse">
                <thead>
                    <tr>
                        <th class="p-4 border-b border-slate-200 bg-slate-50 text-slate-500 dark:border-zinc-700 dark:bg-zinc-700 dark:text-white font-normal text-sm">
                            No
                        </th>
                        <th 
                            wire:click="sortBy('nis')" 
                            class="cursor-pointer p-4 border-b border-slate-200 bg-slate-50 text-slate-500 dark:border-zinc-700 dark:bg-zinc-700 dark:text-white font-normal text-sm"
                        >
                            NIS
                            @if($sortField === 'nis')
                                @if($sortDirection === 'asc')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @endif
                        </th>

                        <th 
                            wire:click="sortBy('nama')" 
                            class="cursor-pointer p-4 border-b border-slate-200 bg-slate-50 text-slate-500 dark:border-zinc-700 dark:bg-zinc-700 dark:text-white font-normal text-sm"
                        >
                            Name
                            @if($sortField === 'nama')
                                @if($sortDirection === 'asc')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @endif
                        </th>

                        <th class="p-4 border-b border-slate-200 bg-slate-50 text-slate-500 dark:border-zinc-700 dark:bg-zinc-700 dark:text-white font-normal text-sm">
                            Email
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50 text-slate-500 dark:border-zinc-700 dark:bg-zinc-700 dark:text-white font-normal text-sm">
                            Institution
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50 text-slate-500 dark:border-zinc-700 dark:bg-zinc-700 dark:text-white font-normal text-sm">
                            Foto
                        </th>
                        <th 
                            wire:click="sortBy('status')" 
                            class="cursor-pointer p-4 border-b border-slate-200 bg-slate-50 text-slate-500 dark:border-zinc-700 dark:bg-zinc-700 dark:text-white font-normal text-sm"
                        >
                            Status
                            @if($sortField === 'status')
                                @if($sortDirection === 'asc')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @endif
                        </th>
                        <th class="p-4 border-b border-slate-200 bg-slate-50 dark:border-zinc-700 dark:bg-zinc-700"></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($students as $s)
                    <tr class="hover:bg-slate-100 dark:hover:bg-zinc-600">
                        <td class="p-4 border-b border-slate-200 dark:border-zinc-700 dark:text-white">
                            {{ $students->firstItem() + $loop->index }}.
                        </td>

                        <td class="p-4 border-b border-slate-200 text-sm text-slate-700 dark:text-white dark:border-zinc-700">
                            {{ $s->nis }}
                        </td>

                        <td class="p-4 border-b border-slate-200 dark:border-zinc-700">
                            <div class="flex items-center gap-3">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700 dark:text-white">
                                        {{ ucwords($s->nama) }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="p-4 border-b border-slate-200 text-sm text-slate-500 dark:text-slate-300 dark:border-zinc-700">
                            {{ $s->email }}
                        </td>

                        <td class="p-4 border-b border-slate-200 text-sm text-slate-700 dark:text-white dark:border-zinc-700">
                            {{ $s->lembaga->nama }}
                        </td>

                         <td class="p-4 border-b border-slate-200 dark:border-zinc-700">
                            @if ($s->foto)
                                <img 
                                    src="{{ asset('storage/' . $s->foto) }}" 
                                    class="h-10 w-10 rounded-lg object-cover cursor-pointer hover:opacity-90 transition"
                                    @click="isOpen = true; photoUrl = '{{ asset('storage/' . $s->foto) }}'"
                                >
                            @else
                                <div class="w-10 h-10 bg-gray-200 dark:bg-zinc-500 rounded-lg"></div>
                            @endif
                        </td>

                        <td class="p-4 border-b border-slate-200 dark:border-zinc-700 ">
                            <select 
                                wire:change="updateStatus({{ $s->id }}, $event.target.value)"
                                class="text-xs rounded-lg border-gray-300 px-2 py-1 cursor-pointer
                                    focus:ring-emerald-500 focus:border-emerald-500
                                    {{ $s->status == 0 ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300 cursor-pointer' }}"
                            >
                                <option value="0" {{ $s->status == 0 ? 'selected' : '' }}>Active</option>
                                <option value="1" {{ $s->status == 1 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </td>

                        <td class="p-4 border-b border-slate-200 dark:border-zinc-700">
                            <button
                                wire:click="edit({{ $s->id }})"
                                class="px-3 py-2 text-xs rounded-lg bg-gray-900 text-white hover:bg-gray-700 dark:bg-yellow-500 dark:hover:bg-yellow-600 cursor-pointer"
                            >
                                Edit
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-4 text-center text-sm text-slate-500 dark:text-slate-300">
                            No data found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @include('components.modal-photo')
        </div>

   
        <div class="flex items-center justify-between p-3">
            <p class="block text-sm text-slate-500 dark:bg-zinc-800 dark:text-white">
                Page {{ $students->currentPage() }} of {{ $students->lastPage() }}
            </p>

            <div class="flex gap-1">

                <button wire:click="previousPage"
                    class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-600  dark:bg-zinc-800 dark:text-white cursor-pointer 
                    hover:opacity-75 active:opacity-85 disabled:opacity-40"
                    {{ $students->onFirstPage() ? 'disabled' : '' }}>
                    Previous
                </button>

                <button wire:click="nextPage"
                    class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-600  dark:bg-zinc-800 dark:text-white cursor-pointer 
                    hover:opacity-75 active:opacity-85 disabled:opacity-40"
                    {{ $students->hasMorePages() ? '' : 'disabled' }}>
                    Next
                </button>

            </div>
        </div>

    </div>

  
    @include('livewire.student-modal')
    

</div>


