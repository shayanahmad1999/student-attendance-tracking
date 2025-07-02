<div>
    <div class="inline-flex gap-x-2">
        <select wire:model="year"
            class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-full text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            <option selected="">Select Year</option>
            @foreach (range(now()->year - 10, now()->year) as $y)
                <option value="{{ $y }}">{{ $y }}</option>
            @endforeach
        </select>
        <select wire:model="month"
            class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-full text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            <option selected="">Select Month</option>
            @foreach (range(1, 12) as $m)
                <option value="{{ $m }}">{{ Carbon\Carbon::create()->month($m)->format('F') }}
                </option>
            @endforeach
        </select>
        <select wire:model="grade"
            class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-full text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            <option selected="">Select Grade</option>
            @foreach ($grades as $grade)
                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
            @endforeach
        </select>
        <button type="button" wire:click="fetchStudents()"
            class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg border border-transparent bg-green-500 text-white hover:bg-green-600 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
        @if ($year && $month && $grade)
        <button type="button" wire:click="exportToExcel()"
            class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg border border-transparent bg-green-500 text-white hover:bg-green-600 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
              </svg>
        </button>
        @endif
    </div>
    <!-- Table Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        @if ($year && $month && $grade)
            <!-- Card -->
        <div class="flex flex-col mt-1">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div
                        class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
                        <!-- Header -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                    Attendance
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    Attendance Management.
                                </p>
                            </div>

                            <div>

                            </div>
                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead
                                class="bg-gray-50 divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start border-s border-gray-200 dark:border-neutral-700">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Student Name
                                        </span>
                                    </th>
                                    @foreach (range(1, $daysInMonth) as $day)
                                        <th scope="col"
                                            class="px-6 py-3 text-start border-s border-gray-200 dark:border-neutral-700">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                {{ $day }}
                                                <select wire:change="markAll({{ $day }}, $event.target.value)"
                                                    class="dark:bg-neutral-900">
                                                        <option  value="">All</option>
                                                        <option  value="present">Present</option>
                                                        <option  value="absent">Absent</option>
                                                        <option  value="sick">Sick</option>
                                                        <option  value="other">Other</option>
                                                </select>
                                        </span>
                                        </th>
                                    @endforeach

                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @foreach ($students as $student)
                                <tr :key="{{ $student->id }}">
                                    <td class="h-px w-auto whitespace-nowrap">
                                        <div class="px-6 py-2">
                                            <span
                                                class="font-semibold text-sm text-gray-800 dark:text-neutral-200">{{ $student->first_name }} {{ $student->last_name }} </span>
                                            {{-- <span class="text-xs text-gray-500 dark:text-neutral-500">(23.16%)</span> --}}
                                        </div>
                                    </td>
                                    @foreach (range(1, $daysInMonth) as $day)
                                    <td class="h-px w-auto whitespace-nowrap">
                                        <div class="px-6 py-2">
                                            <select wire:change="updateAttendance({{ $student->id}}, {{ $day }}, $event.target.value )"
                                            class="dark:bg-neutral-900">
                                                <option  value="present" {{ $attendance[$student->id][$day] == 'present' ? 'selected' : ''}}>Present</option>
                                                <option  value="absent" {{ $attendance[$student->id][$day] == 'absent' ? 'selected' : ''}}>Absent</option>
                                                <option  value="sick"  {{ $attendance[$student->id][$day] == 'sick' ? 'selected' : ''}}>Sick</option>
                                                <option  value="other" {{ $attendance[$student->id][$day] == 'other' ? 'selected' : ''}}>Other</option>
                                        </select>
                                        </div>
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
        @endif
        
    </div>
    <!-- End Table Section -->
</div>