@extends('layouts.app')

@section('title', $task -> title)

@section('content')

<div class="mb-4">
    <a href="{{ route('tasks.index')}}"
    class="link">←Go back to the task list!!</a>

</div>
    {{-- the field that shown in window --}}

    <p class="mb-4 text-slate-700">{{ $task -> description }}</p>

    @if($task -> long_description)
        <p class="mb-4 text-slate-700">{{ $task -> long_description  }}</p>
    @endif

    <p class="mb-4 text-sm text-slate-500">  Created {{ $task -> created_at->diffForHumans()}} •
       Updated {{ $task -> updated_at->diffForHumans() }}
    </p>

    {{-- task completed or not --}}
    <p class="mb-4">
        @if ( $task->completed)
        <span class="font-medium text-green-700"> Completed</span>
        @else
        <span class="font-medium text-red-700"> Not Completed</span>
        @endif
    </p>

    {{-- edit part --}}
    <div class="flex gap-2">
        <a href=" {{ route('tasks.edit', ['task' => $task ])}}"
            class="btn">Edit</a>

    {{-- div for showing the toggle --}}

        <form method = "POST" action="{{ route('tasks.toggle-completed', ['task' => $task] ) }}">
            @csrf
            @method("PUT")
            <button type="submit" class="btn">
                Mark as {{ $task->completed ? 'not completed' : 'completed' }}

            </button>
        </form>

    {{-- for deleting --}}
            <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type = "submit" class="btn">Delete</button>

        </form>
    </div>
@endsection
