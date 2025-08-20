<x-app-layout>
    <form action="" method="POST" class="flex flex-col gap-5 ml-10 mt-20 w-fit">
        @csrf
        <label for="title">
            Title
            <input type="text" name="title" id="title">
        </label>

        <label for="text">
            Text
            <textarea name="text" id="text" cols="30" rows="10"></textarea>
        </label>
        <select name="tags" multiple>
            @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
        </select>
        <input type="submit" class="shadow-md" value="Сохранить">
    </form>
</x-app-layout>
