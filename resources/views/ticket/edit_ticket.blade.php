@php
    $devsIds = $ticket->devs()->pluck('id');
@endphp

<div id="editTicketModal{{ $ticket->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 max-w-full h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add New Ticket
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editTicketModal{{ $ticket->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('ticket.edit', $ticket) }}" method="post">
                @csrf
                <div class="grid mb-4 grid-cols-4 gap-4">
                <!-- sm:grid-cols-2 sm:gap-6 -->
                    <div class="col-span-4">
                    <!-- sm:col-span-2 -->
                        <label for="title-edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ticket Title</label>
                        <input type="text" name="title" id="title-edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type ticket title" required="" value="{{ old('title', $ticket->title) }}">
                        @error("title")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-span-4">
                        <label for="ticket-description-edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="ticket-description-edit" name="description" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type ticket description">{{ old('description', $ticket->description) }}</textarea>
                        @error("description")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="status-edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status-edit" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option @selected($ticket->status == "value1") value="value1">Resolved</option>
                            <option @selected($ticket->status == "value2") value="value2">Now</option>
                            <option @selected($ticket->status == "value3") value="value3">In Progress</option>
                        </select>
                        @error("status")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="priority-edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Priority</label>
                        <select id="priority-edit" name="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option @selected($ticket->priority == "value1") value="value1">Immediate</option>
                            <option @selected($ticket->priority == "value2") value="value2">High</option>
                            <option @selected($ticket->priority == "value3") value="value3">Low</option>
                            <option @selected($ticket->priority == "value4") value="value3">Medium</option>
                        </select>
                        @error("priority")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="type-edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                        <select id="type-edit" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option @selected($ticket->type == "value1") value="value1">Issue</option>
                            <option @selected($ticket->type == "value2") value="value2">Bug</option>
                            <option @selected($ticket->type == "value3") value="value3">Feature Request</option>
                        </select>
                        @error("type")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="time_estimated-edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time Estimated</label>
                        <input type="number" name="time_estimated" id="time_estimated-edit" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="" value="{{ old('time_estimated', $ticket->time_estimated) }}" placeholder="Type number of weeks">
                        @error("time_estimated")
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="col-span-4">
                        <label for="dev-edit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add Developers</label>
                        <select id="dev-edit" name="devs[]" size="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" multiple>
                            @foreach($project->members as $member)
                                <option @selected($devsIds->contains($member->id)) value="{{$member->id}}"> {{ $member->name }} </option>
                            @endforeach
                        </select>
                        @error("devs")
                            {{ $message }}
                        @enderror
                    </div>
                    <input type="hidden" name="author" value="{{ Auth::id() }}">
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new ticket
                </button>
            </form>
        </div>
    </div>
</div>

