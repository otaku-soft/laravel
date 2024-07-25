@extends('layouts/public')
@section('content')
    @php($hasCategory = false)
    @forelse ($sections as $section)
        @if (Session::get("role")->hasPermissionTo("section_".$section->id))
            <h2>{{ $section->name }} </h2>
            <br/>
            <table class="table table-dark table-bordered">
                @foreach ($section->categories()->orderBy("order")->get() as $category)
                    @if (Session::get("role")->hasPermissionTo("category_".$category->id))
                        <tr>
                            <td>
                                <a href="{{ url('forum/topicList', ["category_id" => $category->id]) }}"
                                   class="link-secondary "> <b>{{ $category->name }}</b></a>
                            </td>
                            <td>
                                {{ $category->description }}
                            </td>
                        </tr>
                        @php($hasCategory = true)
                    @endif
                @endforeach
            </table>
            <br/>
        @endif
        @empty
            <b>No Forums Available</b>
    @endforelse
    @if (!$hasCategory && !empty($sections))
        No Access
    @endif
@endsection
