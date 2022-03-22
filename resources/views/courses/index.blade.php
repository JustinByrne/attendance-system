<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="flex flex-col space-y-2 items-start" action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-label>Name</x-label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div>
                            <x-label>Start date</x-label>
                            <input type="date" id="start_date" name="start_date">
                        </div>
                        <div>
                            <x-label>End date</x-label>
                            <input type="date" id="end_date" name="end_date">
                        </div>
                        <x-button type="submit">Add</x-button>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul class="list-disc list-inside">
                    @foreach ($courses as $course)
                        <li>
                            <a href="{{ route("courses.show", $course) }}">
                                {{ $course->name }}
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
