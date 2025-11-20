 @foreach ($toasts as $index => $toast)
<div x-data="{ shown: true }"
     x-show.transition.out.opacity.duration.1500ms="shown"
     x-init="setTimeout(() => { shown = false; @this.removeToast({{ $index }}) }, 3000)"
     class="shadow-lg rounded-lg bg-white  dark:bg-zinc-500 dark:text-white  mx-auto p-4 notification-box flex fixed top-28 right-5 z-50 w-80 items-center space-x-4 mb-2">

    <div class="pr-2">
         <div class="pr-2">
        <svg class="fill-current text-green-600 dark:text-white" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24" width="22" height="22">
            <path class="heroicon-ui"
                d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </svg>
    </div>
    </div>

    <div>
        <div class="text-sm pb-2 font-semibold">
            {{ ucfirst($toast['type']) }}
            <span class="float-right cursor-pointer" @click="shown = false; @this.removeToast({{ $index }})">✕</span>
        </div>
        <div class="text-sm text-gray-600 dark:text-white tracking-tight">{{ $toast['message'] }}</div>
    </div>
</div>
@endforeach
