@if (!empty($file) && $file == 'true')

@if($formMode == 'create')
<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2"> File </span>
        <div class="kt-form-control flex-1 w-full">
            {{ Html::file('file')->class(['kt-input w-full']) }}
            <div id="uploadProgress" class="kt-progress kt-progress-mono bg-gray-200 h-1 rounded-full overflow-hidden" style="display: none;">
                <div class="kt-progress-indicator progress-bar bg-blue-500 h-full transition-all duration-300" style="width: 0%"></div>
            </div>
        </div>
    </div>
</div>
@endif

@if($formMode == 'edit')
<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2"> File </span>
        {!! !empty($data->file) ? '<a href="javascript:void(0);" class="pt-1"><span class="pt-1" data-kt-modal-toggle="#modalPicture" data-kt-tooltip="#tooltip_preview" data-kt-tooltip-placement="top-end"><i class="ki-filled ki-picture"></i></span></a>' : '' !!}
        <div class="kt-form-control flex-1 w-full">
            {{ Html::file('file')->class(['kt-input w-full']) }}
            <div id="uploadProgress" class="kt-progress kt-progress-mono bg-gray-200 h-1 rounded-full overflow-hidden" style="display: none;">
                <div class="kt-progress-indicator progress-bar bg-blue-500 h-full transition-all duration-300" style="width: 0%"></div>
            </div>
        </div>
    </div>
</div>
@endif

@endif