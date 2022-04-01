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
            <tr class="odd:bg-white even:bg-slate-50">
                <td class="px-2 py-3">{{ $learner->name }}</td>
                @foreach ($dates as $date)
                    <td class="text-center" title="{{ $learner->attendances->where('attendance_date', $date->format('Y-m-d'))->first()?->attendanceStatus->description ?? "-" }}">
                        {{ $learner->attendances->where('attendance_date', $date->format('Y-m-d'))->first()?->attendanceStatus->code ?? "-" }}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>