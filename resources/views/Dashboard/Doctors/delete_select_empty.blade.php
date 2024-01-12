<!-- Modal -->
<div class="modal fade" id="delete_select_empty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('Doctors.Error') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="#">
                {{ csrf_field() }}
                <div class="modal-body">
                    <h5> {{ __('Doctors.Please_select_items_delete') }}</h5>
                </div>
            </form>
        </div>
    </div>
</div>
