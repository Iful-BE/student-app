        <div x-data="{ open: @entangle('showModal') }">
            <div 
                x-cloak
                x-show="open"
                x-transition.opacity
                class="fixed inset-0 backdrop-blur-md bg-transparent z-40 pointer-events-auto"
            ></div>
            <div 
                x-cloak
                x-show="open"
                x-transition
                class="fixed inset-0 flex items-center justify-center z-50 pointer-events-none"
            >
                <div class="bg-white dark:bg-zinc-600 dark:text-white rounded-lg shadow-xl w-full max-w-2xl p-6 pointer-events-auto">

                    <h2 class="text-xl font-semibold mb-4">
                        {{ $student_id ? 'Edit Student' : 'Add Student' }}
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="text-sm font-semibold">Institution</label>
                <select wire:model="lembaga_id" class="w-full border rounded p-2 dark:bg-zinc-600 dark:text-white">
                    <option value="">-- Choice --</option>
                    @foreach($lembagas as $l)
                        <option value="{{ $l->id }}">{{ $l->nama }}</option>
                    @endforeach
                </select>
              @error('lembaga_id')
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    x-show="show"
                    x-transition
                    class="mt-1"
                    role="alert" aria-live="polite"
                >
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                </div>
            @enderror
            </div>

            <div>
                <label class="text-sm font-semibold">NIS</label>
                <input wire:model="nis" type="text" class="w-full border rounded p-2">
              @error('nis')
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    x-show="show"
                    x-transition
                    class="mt-1"
                    role="alert" aria-live="polite"
                >
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                </div>
            @enderror
            </div>

            <div>
                <label class="text-sm font-semibold">Name</label>
                <input wire:model="nama" type="text" class="w-full border rounded p-2">
               @error('nama')
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    x-show="show"
                    x-transition
                    class="mt-1"
                    role="alert" aria-live="polite"
                >
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                </div>
            @enderror
            </div>

            <div>
                <label class="text-sm font-semibold">Email</label>
                <input wire:model="email" type="email" class="w-full border rounded p-2">
               @error('email')
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    x-show="show"
                    x-transition
                    class="mt-1"
                    role="alert" aria-live="polite"
                >
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                </div>
            @enderror
            </div>
            
       <div class="md:col-span-2">
        <label class="text-sm font-semibold">Foto</label>
                <input type="file" wire:model="fotoFile" class="w-full border rounded p-2" accept="image/*">
                <label for="preview">Preview</label>
                <span wire:loading wire:target="fotoFile" class="ml-2 text-sm text-gray-500">Uploading...</span>

            @if($photoPreview)
                    <img src="{{ $photoPreview }}" class="w-32 h-32 object-cover rounded mt-2">
                @endif


                @error('fotoFile')
                    <div 
                        x-data="{ show: true }" 
                        x-init="setTimeout(() => show = false, 3000)" 
                        x-show="show"
                        x-transition
                        class="mt-1"
                        role="alert" aria-live="polite"
                    >
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    </div>
                @enderror
            </div>
        </div>


            <div class="mt-6 text-right">
                <button 
                    wire:click="closeModal"
                    class="px-4 py-2 bg-gray-300 dark:bg-zinc-800 dark:text-white rounded mr-2 cursor-pointer">
                    Cancel
                </button>
                <button 
                    wire:click="save"
                    wire:loading.attr="disabled" 
                    wire:target="fotoFile"
                    class="px-4 py-2 bg-blue-600 dark:bg-orange-600 dark:hover:bg-orange-700 text-white rounded cursor-pointer
                        disabled:bg-gray-400 disabled:dark:bg-orange-800 disabled:cursor-not-allowed">
                    Submit
                </button>
            </div>

        </div>
    </div>

</div>
