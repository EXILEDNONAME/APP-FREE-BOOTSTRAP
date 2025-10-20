@if (!empty($daterange) && $daterange == 'true')
<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2"> Date Start </span>
        <div class="kt-form-control flex-1 w-full">
            {{ Html::text('date_start', (isset($data->date_start) ? $data->date_start : ''))->class(['kt-input filter_form filter_date w-full'])->placeholder('- Select Date Start -')->id('datepicker')->required() }}
        </div>
    </div>
</div>
<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2"> Date End </span>
        <div class="kt-form-control flex-1 w-full">
            {{ Html::text('date_end', (isset($data->date_end) ? $data->date_end : ''))->class(['kt-input filter_form filter_date w-full'])->placeholder('- Select Date End -')->id('datepicker')->required() }}
        </div>
    </div>
</div>
@endif