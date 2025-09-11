<x-input-label for="tags-input" :value="__('Tags')"/>
<div class="mt-2">
    <select name="tags[]" id="tags-input" multiple autocomplete="off"
            placeholder="{{__('Topics of your story')}}"></select>
    <x-input-error :messages="$errors->get('tags')" class="mt-2"/>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        window.initTagsInput(@json($tags));
    });
</script>
