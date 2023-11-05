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
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300"></span>
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">{{ $ticket->priority }}</span>
                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">{{ $ticket->type }}</span>
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

<form>
   <div class="w-full mb-4 border border-blue-200 rounded-lg bg-blue-100 dark:bg-gray-700 dark:border-gray-600">
       <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
           <label for="comment" class="sr-only">Your comment</label>
           <textarea id="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..."></textarea>
       </div>
       <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
           <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
               Post comment
           </button>
       </div>
   </div>
</form>

<article class="p-6 text-base bg-blue-50 rounded-lg dark:bg-gray-900 mt-6">
    <footer class="flex justify-between items-center mb-2">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                Michael Gough
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                <time pubdate datetime="2022-02-08" title="February 8th, 2022">Feb. 8, 2022</time>
            </p>
        </div>
        <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
            </svg>
            <span class="sr-only">Comment settings</span>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdownComment1" class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                <li>
                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                </li>
            </ul>
        </div>
    </footer>
    <p class="text-gray-500 dark:text-gray-400">Very straight-to-point article. Really worth time reading. Thank you! But tools are just the instruments for the UX designers. The knowledge of the design tools are as important as the creation of the design strategy.</p>
</article>

@endsection
