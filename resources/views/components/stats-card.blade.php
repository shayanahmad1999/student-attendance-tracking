<div class="flex flex-col p-4 md:p-5 dark:bg-neutral-800 dark:border-neutral-700 bg-gradient-to-r from-blue-200 to-blue-300 border shadow-sm rounded-xl dark:bg-gradient-to-r dark:from-neutral-800 dark:to-neutral-700">
    <div class="flex items-center gap-x-2">
      <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
        {{ $title }}
      </p>
      @if($tooltip)
        <div class="relative group">
          <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
            <path d="M12 17h.01"/>
          </svg>
          <span class="absolute left-1/2 -translate-x-1/2 mt-1 opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900 text-white text-xs font-medium py-1 px-2 rounded-md shadow-2xs dark:bg-neutral-700">
            {{ $tooltip }}
          </span>
        </div>
      @endif
    </div>
  
    <div class="mt-1 flex items-center gap-x-2">
      <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
        {{ $value }}
      </h3>
      @if($percentage)
        <span class="flex items-center gap-x-1 {{ $percentage > 0 ? 'text-green-600' : 'text-red-600' }}">
          <svg class="inline-block size-4 self-center" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
            <polyline points="16 7 22 7 22 13"/>
          </svg>
          <span class="inline-block text-sm">
            {{ $percentage }}%
          </span>
        </span>
      @endif
    </div>
  </div>
  