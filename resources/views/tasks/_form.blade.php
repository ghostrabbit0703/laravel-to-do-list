<div class="mb-3">
    <label for="title" class="form-label">Título</label>
    <input
        type="text"
        name="title"
        id="title"
        class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $task->title ?? '') }}"
    >
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descripción</label>
    <textarea
        name="description"
        id="description"
        rows="4"
        class="form-control @error('description') is-invalid @enderror"
    >{{ old('description', $task->description ?? '') }}</textarea>

    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="category_id" class="form-label">Categoría</label>

    <select
        name="category_id"
        id="category_id"
        class="form-select @error('category_id') is-invalid @enderror"
    >
        <option value="">Seleccione una categoría</option>

        @foreach($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected(old('category_id', $task->category_id ?? '') == $category->id)
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- <div class="mb-3">
    <label class="form-label">Etiquetas</label>

    @foreach($tags as $tag)
        <div class="form-check">

            <input
                class="form-check-input"
                type="checkbox"
                name="tags[]"
                value="{{ $tag->id }}"
                id="tag{{ $tag->id }}"

                @checked(
                    in_array(
                        $tag->id,
                        old(
                            'tags',
                            isset($task)
                                ? $task->tags->pluck('id')->toArray()
                                : []
                        )
                    )
                )
            >

            <label
                class="form-check-label"
                for="tag{{ $tag->id }}"
            >
                {{ $tag->name }}
            </label>

        </div>
    @endforeach

    @error('tags')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div> --}}
<div class="mb-3">

    <label for="tags" class="form-label">
        Etiquetas
    </label>

    <select
        name="tags[]"
        id="tags"
        class="form-select"
        multiple
    >

        @foreach($tags as $tag)

            <option
                value="{{ $tag->id }}"
                @selected(
                    in_array(
                        $tag->id,
                        old(
                            'tags',
                            isset($task)
                                ? $task->tags->pluck('id')->toArray()
                                : []
                        )
                    )
                )
            >
                {{ $tag->name }}
            </option>

        @endforeach

    </select>

    @error('tags')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror

</div>
<div class="mb-3">
      <label class="form-label">Completar tarea</label>
    <div class="form-check">

        <input
            class="form-check-input"
            type="checkbox"
            id="completed"
            name="completed"
            value="1"

            @checked(old('completed', $task->completed ?? false))
        >

        <label class="form-check-label" for="completed">
            Completada
        </label>

    </div>

</div>
<script>
    new TomSelect('#tags', {
        plugins: ['remove_button'],
        maxItems: null,
        create: false,
        placeholder: 'Selecciona las etiquetas...'
    });
</script>
