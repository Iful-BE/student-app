<div 
    x-show="isOpen" 
    x-transition
    class="fixed inset-0 backdrop-blur-md bg-black/50 flex items-center justify-center z-50"
>
    <div class="bg-white dark:bg-zinc-800 p-6 rounded-lg shadow-lg flex flex-col items-center">
        <img :src="photoUrl" class="max-h-[70vh] max-w-[90vw] object-contain rounded mb-4">
        <button 
            @click="isOpen = false" 
            class="px-4 py-2 bg-gray-600 dark:bg-gray-600 text-white rounded hover:bg-gray-700 dark:hover:bg-gray-700 transition"
        >
            Close
        </button>
    </div>
</div>
