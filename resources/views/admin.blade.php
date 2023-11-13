@extends('base')

@section('title', 'Administration')

@section('content')

<div class="mb-5">
    <p class="text-2xl font-bold">
        Users
    </p>
</div>

@foreach($users as $user)
<div id="accordion-flush" data-accordion="collapse" data-active-classes="px-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white" data-inactive-classes="text-gray-600 dark:text-gray-400">
  <h2 id="accordion-flush-heading-{{ $user->id }}">
    <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-900" data-accordion-target="#accordion-flush-body-{{ $user->id }}" aria-expanded="false" aria-controls="accordion-flush-body-{{ $user->id }}">
      <span>{{ $user->name }}</span>
      <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
      </svg>
    </button>
  </h2>
  <div id="accordion-flush-body-{{ $user->id }}" class="hidden" aria-labelledby="accordion-flush-heading-{{ $user->id }}">
    <div class="py-5 px-6 border-b border-gray-200 dark:border-gray-700">

        <form method="post" action="{{ route('profile.adminUpdate', $user->id) }}">
        @csrf
        @method('patch')
          <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
              <div class="w-full">
                  <label for="name-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                  <input type="text" name="name" id="name-admin" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('name', $user->name) }}">
                @error("name")
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="w-full">
                  <label for="email-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                  <input type="email" name="email" id="email-admin" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('email', $user->email) }}">
                @error("email")
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div>
                  <label for="phone-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                  <input type="string" name="phone" id="phone-admin" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('phone', $user->phone) }}">
                @error("phone")
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div>
                  <label for="admin-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                  <select id="admin-admin" name="admin" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                      <option @selected(old('admin' == 0, $user->admin == 0)) value=0>User</option>
                      <option @selected(old('admin' == 1, $user->admin == 1)) value=1>Admin</option>
                  </select>
                @error("admin")
                    <div class="text-red-500">
                        {{ $message }}
                    </div>
                @enderror
              </div>
          </div>
          <div class="flex items-center space-x-4">
              <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-primary-800">
                  Update User
              </button>
              <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" data-modal-target="deleteUserModal{{ $user->id }}" data-modal-toggle="deleteUserModal{{ $user->id }}">
                  <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                  Delete
              </button>
          </div>
      </form>
      @include('delete_user')
    </div>
  </div>
</div>
@endforeach

@endsection
