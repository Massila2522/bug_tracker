@extends('base')

@section('title', 'Project')

@section('content')

<div class="w-full flex items-center justify-between flex-wrap mt-2 mb-10">
    <div>
        <p class="text-xl font-bold text-gray-900">
            {{ $project->name }}
        </p>
    </div>
    <div>
        <p class="text-lg font-semibold text-gray-900">
            {{ $project->description }}
        </p>
    </div>
</div>


<div id="accordion-color" data-accordion="collapse" data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">

  <h2 id="accordion-color-heading-1">
    <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-900 border border-b-0 border-gray-500 rounded-t-xl focus:ring-4 focus:ring-blue-200 focus:border-gray-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 hover:border-gray-200 dark:hover:bg-gray-800" data-accordion-target="#accordion-color-body-1" aria-expanded="false" aria-controls="accordion-color-body-1">
      <span>Team</span>
      <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
      </svg>
    </button>
  </h2>
  <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">

        <div class="w-full relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone
                        </th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($project->members as $member)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                <a href="{{ route('project.show', $project) }}">
                                    {{ $member->name }}
                                </a>
                            </th>
                            <td class="px-6 py-4">
                                {{ $member->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $member->phone }}
                            </td>
                            <td class="px-6 py-4">
                                <button aria-expanded="false" data-dropdown-toggle="dropdown-member-{{ $member->id }}">
                                    <i class="fa-solid fa-ellipsis-vertical cursor-pointer"></i>
                                </button>
                                <div class="z-40 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-member-{{ $member->id }}">
                                    <ul class="py-1" role="none">
                                        <li>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" data-modal-target="removeMemberModal{{ $member->id }}" data-modal-toggle="removeMemberModal{{ $member->id }}">Remove</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @include('project.remove_member')
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="button" class="mt-5 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm py-2 px-4 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" data-modal-toggle="add-member-modal" type="button">Add Member</button>

        @include('project.add_member')

    </div>
  </div>

  <h2 id="accordion-color-heading-2">
    <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-900 border border-gray-500 focus:border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 hover:border-gray-200 dark:hover:bg-gray-800" data-accordion-target="#accordion-color-body-2" aria-expanded="false" aria-controls="accordion-color-body-2">
      <span>Tickets</span>
      <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
      </svg>
    </button>
  </h2>
  <div id="accordion-color-body-2" class="hidden" aria-labelledby="accordion-color-heading-2">
    <div class="p-5 border border-gray-200 dark:border-gray-700">

        <div class="w-full overflow-x-auto relative shadow-md sm:rounded-lg mt-2">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Ticket Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ticket Author
                        </th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $ticketsPaginated = $project->tickets()->paginate(4);
                    @endphp
                    @foreach($ticketsPaginated as $ticket)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('ticket.show', $ticket) }}">
                                {{ $ticket->title }}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $ticket->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $ticket->ticketAuthor->name }}
                        </td>
                        <td>
                            <button aria-expanded="false" data-dropdown-toggle="dropdown-ticket-{{ $ticket->id }}">
                                <i class="fa-solid fa-ellipsis-vertical cursor-pointer"></i>
                            </button>
                            <div class="z-40 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-ticket-{{ $ticket->id }}">
                                <ul role="none">
                                    <li>
                                        <a class="cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" data-modal-toggle="editTicketModal{{ $ticket->id }}">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" data-modal-target="deleteTicketModal{{ $ticket->id }}" data-modal-toggle="deleteTicketModal{{ $ticket->id }}">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @include('ticket.edit_ticket')
                    @include('ticket.delete_ticket')
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- pagination -->
        {{ $ticketsPaginated->links() }}

        <button type="button" class="mt-5 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm py-2 px-4 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" data-modal-toggle="createTicketModal" type="button">Add Ticket</button>

        @include('ticket.add_ticket')

    </div>
  </div>
</div>
@endsection
