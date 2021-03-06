@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card">
                <div class="card-header">{{ __('Post') }}</div>
                <div class="card-body">
                    <div class="card" style="width: 40rem;">
                        @if ($post->image)
                            <img src="{{ asset("storage/{$post->image}") }}" class="card-img-top"
                                alt="{{ $post->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            @if ($post->published)
                                <span class="badge badge-success">Pubblico</span>
                            @else
                                <span class="badge badge-secondary">Privato</span>
                            @endif

                            @if ($post->category)
                                <p class="card-text bg-info">Categoria: {{ $post->category->name }}</p>
                            @endif

                            <p class="card-text">Slug: {{ $post->slug }}</p>

                            @if (count($post->tags) > 0)
                                <div class="my-3">
                                    <strong>Tags: </strong>
                                    @foreach ($post->tags as $tag)
                                        <span class="badge badge-dark">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            @endif

                            @if (count($post->comments) > 0)
                                <div class="comments-box">
                                  <h4>Commenti</h4>
                                    <table class="table">
                                        <tbody>
                                            @foreach ($post->comments as $comment)
                                                <tr>
                                                    <th>{{ $comment->content }}</th>
                                                    <td>
                                                        @if (!$comment->approved)
                                                            <form action="{{ route('comments.update', $comment->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method("PATCH")
                                                                {{-- <input type="hidden" name="approved" value="1"> --}}
                                                                <button type="submit"
                                                                    class="btn btn-success">Approva</button>
                                                            </form>
                                                        @else
                                                            Approvato
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('comments.destroy', $comment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method("DELETE")
                                                            {{-- <input type="hidden" name="approved" value="1"> --}}
                                                            <button type="submit" class="btn btn-danger">Elimina</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            @endif

                            <div class="btn-container d-flex my-3">
                                {{-- Pulsante Modifica --}}
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning mr-2">Modifica</a>

                                {{-- Pulsante Elimina --}}
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
