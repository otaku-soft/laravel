@extends('layouts/public')
@section('content')

@foreach ($sections as $section)
    <h2>{{ $section->name }} </h2>
    <br/>
    <table class="table table-dark table-bordered">
    @foreach ($section->categories()->orderBy("order")->get() as $category)
        <tr>
            <td>
                <a href = "{{ url('forum/topicList', ["category_id" => $category->id]) }}" class="link-secondary "> <b>{{ $category->name }}</b></a>
            </td>
            <td>
                {{ $category->description }}
            </td>
        </tr>
    @endforeach
    </table>
    <br/>
@endforeach
@endsection
