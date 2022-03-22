<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->name }}
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
                    <ul class="list-disc list-inside">
                    @foreach ($course->learners as $learner)
                        <li>{{ $learner->name }}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
