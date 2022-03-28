<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Course Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('courses.storeRegister', $course) }}" method="POST">
                        @csrf
                        <input type="date" name="attendance_date" value="{{ old('attendance_date') }}" required>
                        <table class="w-full table-fixed">
                            <thead>
                                <tr>
                                    <th class="text-left px-2">Learner name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->learners as $learner)
                                    <tr class="odd:bg-white even:bg-slate-50">
                                        <td class="px-2 py-3">{{ $learner->name }}</td>
                                        <td>
                                            <select
                                                @if ($loop->first) autofocus @endif
                                                name="attendance[{{ $learner->id }}][status]"
                                                required
                                                @class([
                                                    'border-red-400 bg-rose-100' => $errors->has('attendance.' . $learner->id . '.*')
                                                ])
                                            >
                                                <option selected disabled value="">-</option>
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->id }}" @selected(old('attendance.' . $learner->id . '.status') == $status->id)>{{ $status->code }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <x-button>Submit</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
