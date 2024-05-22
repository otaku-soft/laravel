<div class="font-medium text-gray-900 dark:text-gray-100">
    <h2>Sections</h2>
    <ul id="sectionList" class="pb-3">
        @foreach ($sections as $section)
            <li class="pb-3 pt-3">
                <input type="checkbox" class="sectionElement" data-section="{{ $section->id }}"
                       @if ($role->hasPermissionTo("section_".$section->id,"web")) checked @endif />
                <b>{{ $section->name }} </b>
            </li>
            @foreach ($section->categories()->orderBy("order")->get() as $category)
                <li class="p-4 border">
                    <input type="checkbox" data-section="{{ $section->id }}" data-id="{{ $category->id }}"
                           class="categoryElement"
                           @if ($role->hasPermissionTo("category_".$category->id,"web")) checked @endif /> {{ $category->name }}
                </li>
            @endforeach
        @endforeach
    </ul>
    <x-primary-button x-data="" x-on:click.prevent="savePermissions()">
        Save
    </x-primary-button>
</div>
<script>
    $(".sectionElement").click(function ()
    {
        $("[data-section=" + $(this).data("section") + "]").prop('checked', $(this).is(":checked"));
    });
    $(".categoryElement").click(function ()
    {
        $(".sectionElement[data-section=" + $(this).data("section") + "]").prop('checked', $(".categoryElement[data-section=" + $(this).data("section") + "]:checked").length > 0);
    });

    function savePermissions()
    {
        let sections = new Array();
        let categories = new Array();
        let request = new Object();
        let htmlSections = $(".sectionElement:checked");
        let htmlCategories = $(".categoryElement:checked");
        for (section of htmlSections)
        {
            sections.push($(section).data("section"));
        }
        for (category of htmlCategories)
        {
            categories.push($(category).data("id"))
        }
        request =
        {
            id: {{ $role->id }},
            sections: sections,
            categories: categories
        };
        $.post("{{ route('roles_setForumPermissionsSave') }}", request).done(function (data)
        {
            window.location = "";
        });
    }
</script>
