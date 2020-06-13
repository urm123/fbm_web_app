@component('mail::message')
Hi you have assigned following tasks today:
<table class="table table-responsive">
<tr>
    <th>Cleaner</th>
<th>Client:</th>
<th>Task:</th>
<th>Start Time:</th>
<th>End Time:</th>
</tr>
@foreach($data as $datum)

        @foreach($datum['tasks'] as $task)

<tr>

    <td>{{$datum['cleaner']->first_name}} {{$datum['cleaner']->last_name}}</td>

    <td>{{$task->client_name}}</td>

    <td>{{$task->task_name}}</td>

    <td>{{\Carbon\Carbon::parse($task->start_time)->toTimeString()}}</td>

    <td>{{\Carbon\Carbon::parse($task->end_time)->toTimeString()}}</td>
</tr>

        @endforeach

@endforeach
</table>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
