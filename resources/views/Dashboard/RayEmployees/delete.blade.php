<!-- Modal -->
<div class="modal fade" id="delete{{ $RayEmployee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Services.delete_Service')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ray_employee.destroy',  $RayEmployee->id) }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $RayEmployee->id }}">
                <h5>{{trans('sections.Warning')}} {{ $RayEmployee->name }} </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('sections.Close')}}</button>
                <button type="submit" class="btn btn-danger">{{trans('sections.submit')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
