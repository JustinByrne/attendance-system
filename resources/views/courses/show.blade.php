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
                    <table class="w-full table-fixed">
                        <thead>
                            <tr>
                                <th>Learner name</th>
                                @foreach ($dates as $date)
                                    <th>{{ $date->format('d/m/y') }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course->learners as $learner)
                                <tr>
                                    <td>{{ $learner->name }}</td>
                                    @foreach ($dates as $date)
                                        <td class="text-center">-</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
