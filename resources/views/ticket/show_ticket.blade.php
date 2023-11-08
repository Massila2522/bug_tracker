@extends('base')

@section('title', 'Selected Ticket Info')

@section('content')

<div class="mb-5">
    <p class="text-xl font-bold">
        Selected Ticket Info
    </p>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
        <tbody>
            <tr class="bg-blue-500 border-b border-blue-400">
                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                    Tiltle
                </th>
                <td class="px-6 py-4">
                    {{ $ticket->title }}
                </td>
            </tr>
            <tr class="bg-blue-500 border-b border-blue-400">
                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                    Description
                </th>
                <td class="px-6 py-4">
                    {{ $ticket->description }}
                </td>
            </tr>
            <tr class="bg-blue-500 border-b border-blue-400">
                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                    Author
                </th>
                <td class="px-6 py-4">
                    {{ $ticket->ticketAuthor->name }}
                </td>
            </tr>
            <tr class="bg-blue-500 border-b border-blue-400">
                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                    Status, Priority & Type
                </th>
                <td class="px-6 py-4">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300" id="status-show">
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
                    </span>
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">
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
                    </span>
                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                        @switch($ticket->type)
                            @case("value1")
                                Issue
                            @break

                            @case("value2")
                                Bug
                            @break

                            @case("value3")
                                Feature Request
                            @break
                        @endswitch
                    </span>
                </td>
            </tr>
            <tr class="bg-blue-500 border-blue-40">
                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                    Time Estimated
                </th>
                <td class="px-6 py-4">
                    {{ $ticket->time_estimated }} week
                </td>
            </tr>
            <tr class="bg-blue-500 border-blue-40">
                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                    Assigned Devs
                </th>
                <td class="px-6 py-4">
                    @foreach ($ticket->devs as $dev)
                        <span>{{ $dev->name }}</span>
                        @if ($dev != $ticket->devs->last())
                            <span>,&nbsp;</span>
                        @endif
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="mb-5 mt-16">
    <p class="text-xl font-bold">
        Comments
    </p>
</div>

<form action="{{ route('comment.save') }}" method="post">
    @csrf
   <div class="w-full mb-4 border border-blue-200 rounded-lg bg-blue-100 dark:bg-gray-700 dark:border-gray-600">
       <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
           <label for="content" class="sr-only">Your comment</label>
           <textarea id="content" name="content" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..."></textarea>
       </div>
       <input type="hidden" name="author" value="{{ Auth::id() }}">
       <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
       <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
           <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
               Post comment
           </button>
       </div>
   </div>
</form>
@php
$commentsPaginated = $ticket->comments()->paginate(2);
@endphp
@foreach($commentsPaginated as $comment)
<article class="px-4 py-2 text-base bg-blue-50 rounded-lg dark:bg-gray-900 mt-6">
    <footer class="flex justify-between items-center mb-2">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                {{ $comment->commentAuthor->name }}
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                <time pubdate>{{ $comment->created_at }}</time>
            </p>
        </div>
        @if($comment->author == Auth::id())
        <button id="dropdownComment{{ $comment->id }}Button" data-dropdown-toggle="dropdownComment{{ $comment->id }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
            </svg>
            <span class="sr-only">Comment settings</span>
        </button>
        @endif
        <!-- Dropdown menu -->
        <div id="dropdownComment{{ $comment->id }}" class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                <li>
                    <a class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editCommentModal{{ $comment->id }}">Edit</a>
                </li>
                <li>
                    <a class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-target="deleteCommentModal{{ $comment->id }}" data-modal-toggle="deleteCommentModal{{ $comment->id }}">Remove</a>
                </li>
            </ul>
        </div>
    </footer>
    <p class="text-gray-500 dark:text-gray-400">
        {{ $comment->content }}
    </p>
</article>
    @include('comment.edit_comment')
    @include('comment.delete_comment')
@endforeach

<!-- pagination -->
{{ $commentsPaginated->links() }}

<br><br>

@endsection

@section('scripts')
@endsection
