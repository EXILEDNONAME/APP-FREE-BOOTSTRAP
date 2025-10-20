@if (!empty($date) && $date == 'true')
<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2"> Date </span>
        <div class="kt-form-control flex-1 w-full">
            {{ Html::text('date', (isset($data->date) ? $data->date : ''))->class(['kt-input filter_form filter_date w-full'])->placeholder('- Select Date -')->id('datepicker')->required() }}
        </div>
    </div>
</div>
@endif