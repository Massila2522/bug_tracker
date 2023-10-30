@extends('base')

@section('title', 'Project')

@section('content')

<div class="w-full flex items-center justify-between pb-4 overflow-x-auto flex-wrap">

    <!-- members table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('project.show', $project) }}">
                                {{ $project->projectAuthor->name }}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $project->projectAuthor->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $project->projectAuthor->phone }}
                        </td>
                        <td>
                            <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-3 py-1.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" data-modal-target="deleteProjectModal{{ $project->id }}" data-modal-toggle="deleteProjectModal{{ $project->id }}">Remove</button>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>

    <!-- tickets table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('project.show', $project) }}">

                            </a>
                        </th>
                        <td class="px-6 py-4">

                        </td>
                        <td class="px-6 py-4">

                        </td>
                        <td>
                            <button aria-expanded="false" data-dropdown-toggle="dropdown-project-{{ $project->id }}">
                                <i class="fa-solid fa-ellipsis-vertical cursor-pointer"></i>
                            </button>
                            <div class="z-40 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-project-{{ $project->id }}">
                                <ul class="py-1" role="none">
                                    <li>
                                        <a class="cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" data-modal-toggle="">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" data-modal-target="" data-modal-toggle="">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>

</div>

@endsection
