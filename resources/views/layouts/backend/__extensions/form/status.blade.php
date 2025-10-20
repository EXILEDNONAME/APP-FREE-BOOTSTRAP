@if (!empty($status) && $status == 'true')
<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2"> {{ __('default.label.status') }} </span>
        <div class="kt-form-control flex-1 w-full">
            @if (!empty($statusName))
            @php
            $items = DB::table('system_status_filters')->where('name', $statusName)->first();
            $attributes = json_decode($items->properties ?? '[]', true);
            @endphp
            {{ Html::select('status', $attributes, (isset($data->status) ? $data->status : ''))->class($errors->has('status') ? 'kt-input w-full is-invalid' : 'kt-input w-full')->placeholder('- ' . __("default.select.status") . ' -')->required() }}
            @error('status') {{ Html::span()->text($message)->class('invalid-feedback') }} @enderror
            @else
            {{ Html::select('status')->class($errors->has('status') ? 'kt-input w-full is-invalid' : 'kt-input w-full')->placeholder('- ' . __("default.select.status") . ' -')->required() }}
            @endif
        </div>
    </div>
</div>
@endif