<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->name }} ... {{ $course->start_date->format("d/m/y") }} - {{ $course->end_date->format("d/m/y") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="flex flex-col space-y-2 items-start" action="{{ route('courses.addLearner', $course) }}" method="POST">
                        @csrf
                        <div>
                            <x-label>Name</x-label>
                            <select name="learner_id">
                                <option selected disabled></option>
                                @foreach ($learners as $learner)
                                    <option value="{{ $learner->id }}">{{ $learner->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-button type="submit">Add</x-button>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="float-right">
                        <a href="{{ route('courses.register', $course) }}" class="mb-4 mr-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Take register</a>
                        <a href="{{ route('courses.register.download', $course) }}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Download</a>
                    </div>
                    @include("courses.table")
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
