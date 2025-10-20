@if(!empty($active) && $active == 'true')
<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2"> {{ __('default.label.active') }} </span>
        <div class="kt-form-control flex-1 w-full">
            {{ Html::select('active', ['1' => __('default.label.yes'), '0' => __('default.label.no')], (isset($data->active) ? $data->active : '1'))->class($errors->has('active') ? 'kt-input w-full is-invalid' : 'kt-input w-full')->required() }}
        </div>
    </div>
</div>
@endif