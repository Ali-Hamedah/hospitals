<!-- Modal -->
<div class="modal fade" id="Delete{{ $patient_record->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    حذف حالة المريض</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Diagnostics.destroy',  $patient_record->id ) }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <h5>{{trans('sections.Warning')}}</h5>
                    <input type="hidden" value="1" name="page_id">
                    @if($patient_record->image)
                        <input type="hidden" name="filename" value="{{$patient_record->image->filename}}">
                    @endif
                    {{-- <input type="hidden" name="id" value="{{ $invoice->id }}"> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('sections.Close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('sections.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
