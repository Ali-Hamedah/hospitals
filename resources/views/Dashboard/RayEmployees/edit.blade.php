<!-- Modal -->
<div class="modal fade" id="edit{{ $RayEmployee->id }}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Services.add_Service')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ray_employee.update',  $RayEmployee->id ) }}" method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label for="name">{{trans('Services.name')}}</label>
                    <input type="text" name="name" id="name" value="{{ $RayEmployee->name }}" class="form-control"><br>

                    <label for="email">{{trans('Doctors.email')}}</label>
                    <input type="email" name="email" id="email" value="{{ $RayEmployee->email }}" class="form-control" autocomplete="off"><br>

                    <label for="password">{{trans('Doctors.password')}}</label>
                    <input type="password" class="form-control" name="password"  id="password" rows="5" >
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('sections.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('sections.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
