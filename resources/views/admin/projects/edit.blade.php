@extends('layouts.app')

@section('content')
    <div class="container pb-2">
        <h1>Modifica "{{ $project->title }}"</h1>

        <form action="{{ route('admin.projects.update', $project) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="" class="form-label">Nome Progetto</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}" />

            {{-- type selection --}}
            <label for="type_id" class="form-label">Tipo</label>
            <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                <option value="">Nessun tipo</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if (old('type_id') ?? $project->type_id == $type->id) selected @endif>
                        {{ $type->label }}
                    </option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            {{-- techs selection --}}
            <label class="form-label">Tecnologie</label>

            <div class="form-check @error('techs') is-invalid @enderror p-0">
                @foreach ($techs as $tech)
                    <input type="checkbox" id="tech-{{ $tech->id }}" value="{{ $tech->id }}" name="techs[]"
                        class="form-check-control" @if (in_array($tech->id, $project_techs)) checked @endif>

                    <label for="tech-{{ $tech->id }}">
                        {{ $tech->label }}
                    </label>
                    <br>
                @endforeach
            </div>

            @error('tech')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror


            <label for="number" class="form-label">Descrizione</label>
            <textarea class="form-control" id="description" name="description">{{ $project->description }}</textarea>

            <button type="submit" class="btn btn-primary mt-2">Salva</button>
        </form>
    </div>
@endsection
