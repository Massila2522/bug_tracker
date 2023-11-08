@extends('base')

@section('title', 'Tickets')

@section('content')
<div class="mb-5">
    <p class="text-xl font-bold">
        Tickets
    </p>
</div>
    <!-- Tickets table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Project
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ticket
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Days Outstanding
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Priority
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($tickets as $ticket)

                    @php
                        $createdAt = $ticket->created_at;
                        $currentDate = now();

                        $duration = $currentDate->diff($createdAt);
                    @endphp

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('project.show', $ticket->project->id) }}">
                                {{ $ticket->project->name }}
                            </a>
                        </th>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('ticket.show', $ticket) }}">
                                {{ $ticket->title }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            @switch($ticket->status)
                                @case("value1")
                                    Resolved
                                @break

                                @case("value2")
                                    Now
                                @break

                                @case("value3")
                                    In Progress
                                @break
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            {{ $duration->d }} days ago
                        </td>
                        <td class="px-6 py-4">
                            @switch($ticket->priority)
                                @case("value1")
                                    Immediate
                                @break

                                @case("value2")
                                    High
                                @break

                                @case("value3")
                                    Low
                                @break

                                @case("value4")
                                    Medium
                                @break
                            @endswitch
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <!-- pagination -->
    {{ $tickets->links() }}

@endsection
