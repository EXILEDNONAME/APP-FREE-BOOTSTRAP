<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2"> Name </span>
        <div class="kt-form-control flex-1 w-full">
            {{ Html::text('name', (isset($data->name) ? $data->name : ''))->class(['kt-input w-full'])->required() }}
        </div>
    </div>
</div>