<div class="relative overflow-x-auto mx-10 my-10">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                     Employee 1
                </th>
                <th scope="col" class="px-6 py-3">
                    Employee 2
                </th>
                <th scope="col" class="px-6 py-3">
                    Project Id
                </th>
                <th scope="col" class="px-6 py-3">
                   Days Worked
                </th>
            </tr>
        </thead>
        <tbody>
            @if (empty($pairs))
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        No pairs available. Please add a file to see it listed here.
                    </td>
                </tr>

            @else
                @foreach ($pairs as $pair)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $pair->emp1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $pair->emp2 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pair->project_id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pair->days_worked }}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="container mx-auto my-10 p-6 bg-gray-700 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-white mb-4">
            Employees who have worked together on common projects for the longest period of time
        </h1>

        <div class="p-6 bg-gray-900 text-white rounded-lg shadow-md">
            <h2 class="text-lg font-semibold">Top Pair:</h2>

            @php
                $maxPair = $pairs->sortByDesc('days_worked')->first();
            @endphp

            <p class="text-xl mt-2">
                <span class="font-bold">Employee 1:</span> {{ $maxPair->emp1 }}
            </p>

            <p class="text-xl mt-2">
                <span class="font-bold">Employee 2:</span> {{ $maxPair->emp2 }}
            </p>

            <p class="text-xl mt-2">
                <span class="font-bold">Days Worked Together:</span> {{ $maxPair->days_worked }}
            </p>
        </div>
    </div>

</div>
