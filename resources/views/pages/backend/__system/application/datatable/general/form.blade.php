<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2"> Name </span>
        <div class="kt-form-control flex-1 w-full">
            {{ Html::text('name', (isset($data->name) ? $data->name : ''))->class(['kt-input w-full'])->required() }}
        </div>
    </div>
</div>

<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2"> Description </span>
        <div class="kt-form-control flex-1 w-full">
            {{ Html::textarea('description', (isset($data->description) ? $data->description : ''))->class(['kt-textarea'])->id('ex-textarea')->rows(4) }}
        </div>
    </div>
</div>