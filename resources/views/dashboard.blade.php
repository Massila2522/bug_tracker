@extends('base')

@section('title', 'Dashboard')

@section('content')
<div class="mb-4">
</div>

    <div class="w-full flex items-center justify-between pb-4 overflow-x-auto flex-wrap">

        <!-- projects search -->
        <div>
            <form action="{{ url('/search') }}" type="get">
            <!-- route('dashboard.searchProjects') -->
                @csrf
                <label for="search-projects" class="sr-only">Search</label>
                <div class="flex items-center">
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" name="query" id="search-projects" class="block p-2 pl-10 ml-1 text-sm text-gray-900 border border-gray-300 rounded-lg max-w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for projects" value="{{ old('search-projects') }}">
                    </div>
                    <div>
                        <button type="submit" class="mt-1 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm p-2 ml-1 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Search</button>
                    </div>
                </div>
            </form>
        </div>

      <div>
        <button type="button" class="mt-1 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm py-2 px-4 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" id="defaultModalButton" data-modal-toggle="createProjectModal" type="button">Add</button>

        @include('project.add_project')

      </div>
    </div>

    <!-- Projects table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Project
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Author
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Contributors
                    </th>
                    <th scope="col" class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($projects as $project)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('project.show', $project) }}">
                                {{ $project->name }}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $project->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $project->projectAuthor->name }}
                        </td>
                        <td class="px-6 py-4">
                            @foreach ($project->members as $member)
                                <span>{{ $member->name }}</span>
                                @if ($member != $project->members->last())
                                    <span>,&nbsp;</span>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <button aria-expanded="false" data-dropdown-toggle="dropdown-project-{{ $project->id }}">
                                <i class="fa-solid fa-ellipsis-vertical cursor-pointer"></i>
                            </button>
                            <div class="z-40 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-project-{{ $project->id }}">
                                <ul role="none">
                                    <li>
                                        <a class="cursor-pointer block px-4 py-1 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" data-modal-toggle="editProjectModal{{ $project->id }}">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-1 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" data-modal-target="deleteProjectModal{{ $project->id }}" data-modal-toggle="deleteProjectModal{{ $project->id }}">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    @include('project.edit_project')
                    @include('project.delete_project')

                @endforeach

            </tbody>
        </table>
    </div>

    <!-- pagination -->
    {{ $projects->links() }}


<div class="mt-20 mb-4 w-full flex justify-between items-center flex-wrap">
<!-- tickets type -->
<div>
<div class="my-4 max-w-xs w-xs bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

<div class="flex justify-between items-start w-full">
    <div class="flex-col items-center">
      <div class="flex items-center mb-1">
          <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Tickets by Type</h5>
          <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
              <div class="p-3 space-y-2">
          </div>
          <div data-popper-arrow></div>
      </div>
    </div>
  </div>
</div>

<div class="py-6" id="pie-chart-type"></div>
</div>
</div>

<!-- tickets priority -->
<div>
<div class="my-4 max-w-xs w-xs bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

<div class="flex justify-between items-start w-full">
    <div class="flex-col items-center">
      <div class="flex items-center mb-1">
          <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Tickets by Priority</h5>
          <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
              <div class="p-3 space-y-2">
          </div>
          <div data-popper-arrow></div>
      </div>
    </div>
  </div>
</div>

<div class="py-6" id="pie-chart-priority"></div>
</div>
</div>

<!-- tickets status -->
<div>
<div class="my-4 max-w-xs w-xs bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

<div class="flex justify-between items-start w-full">
    <div class="flex-col items-center">
      <div class="flex items-center mb-1">
          <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Tickets by Status</h5>
          <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
              <div class="p-3 space-y-2">
          </div>
          <div data-popper-arrow></div>
      </div>
    </div>
  </div>
</div>

<div class="py-6" id="pie-chart-status"></div>
</div>
</div>
</div>



<script>
// ApexCharts options and config
window.addEventListener("load", function() {
  const getChartOptionsType = () => {
      return {
        series: [{{$issueTickets}}, {{$bugTickets}}, {{$featureTickets}}],
        colors: ["#1C64F2", "#16BDCA", "#9061F9"],
        chart: {
          height: 320,
          width: "100%",
          type: "pie",
        },
        stroke: {
          colors: ["white"],
          lineCap: "",
        },
        plotOptions: {
          pie: {
            labels: {
              show: true,
            },
            size: "100%",
            dataLabels: {
              offset: -25
            }
          },
        },
        labels: ["Issue", "Bug", "Feature request"],
        dataLabels: {
          enabled: true,
          style: {
            fontFamily: "Inter, sans-serif",
          },
        },
        legend: {
          position: "bottom",
          fontFamily: "Inter, sans-serif",
        },
        yaxis: {
          labels: {
            formatter: function (value) {
              return value + "%"
            },
          },
        },
        xaxis: {
          labels: {
            formatter: function (value) {
              return value  + "%"
            },
          },
          axisTicks: {
            show: false,
          },
          axisBorder: {
            show: false,
          },
        },
      }
    }

    if (document.getElementById("pie-chart-type") && typeof ApexCharts !== 'undefined') {
      const chartType = new ApexCharts(document.getElementById("pie-chart-type"), getChartOptionsType());
      chartType.render();
    }
});

window.addEventListener("load", function() {
    const getChartOptionsPriority = () => {
      return {
        series: [{{$immediateTickets}}, {{$highTickets}}, {{$lowTickets}}, {{$mediumTickets}}],
        colors: ["#1C64F2", "#16BDCA", "#9061F9", "#CCCCCC"],
        chart: {
          height: 320,
          width: "100%",
          type: "pie",
        },
        stroke: {
          colors: ["white"],
          lineCap: "",
        },
        plotOptions: {
          pie: {
            labels: {
              show: true,
            },
            size: "100%",
            dataLabels: {
              offset: -25
            }
          },
        },
        labels: ["Immediate", "High", "Low", "Medium"],
        dataLabels: {
          enabled: true,
          style: {
            fontFamily: "Inter, sans-serif",
          },
        },
        legend: {
          position: "bottom",
          fontFamily: "Inter, sans-serif",
        },
        yaxis: {
          labels: {
            formatter: function (value) {
              return value + "%"
            },
          },
        },
        xaxis: {
          labels: {
            formatter: function (value) {
              return value  + "%"
            },
          },
          axisTicks: {
            show: false,
          },
          axisBorder: {
            show: false,
          },
        },
      }
    }

    if (document.getElementById("pie-chart-priority") && typeof ApexCharts !== 'undefined') {
      const chartPriority = new ApexCharts(document.getElementById("pie-chart-priority"), getChartOptionsPriority());
      chartPriority.render();
    }
});


window.addEventListener("load", function() {
    const getChartOptionsStatus = () => {
      return {
        series: [{{$resolvedTickets}}, {{$newTickets}}, {{$inProgressTickets}}],
        colors: ["#1C64F2", "#16BDCA", "#9061F9"],
        chart: {
          height: 320,
          width: "100%",
          type: "pie",
        },
        stroke: {
          colors: ["white"],
          lineCap: "",
        },
        plotOptions: {
          pie: {
            labels: {
              show: true,
            },
            size: "100%",
            dataLabels: {
              offset: -25
            }
          },
        },
        labels: ["Resolved", "New", "In Progress"],
        dataLabels: {
          enabled: true,
          style: {
            fontFamily: "Inter, sans-serif",
          },
        },
        legend: {
          position: "bottom",
          fontFamily: "Inter, sans-serif",
        },
        yaxis: {
          labels: {
            formatter: function (value) {
              return value + "%"
            },
          },
        },
        xaxis: {
          labels: {
            formatter: function (value) {
              return value  + "%"
            },
          },
          axisTicks: {
            show: false,
          },
          axisBorder: {
            show: false,
          },
        },
      }
    }

    if (document.getElementById("pie-chart-status") && typeof ApexCharts !== 'undefined') {
      const chartStatus = new ApexCharts(document.getElementById("pie-chart-status"), getChartOptionsStatus());
      chartStatus.render();
    }
});

</script>



@endsection


