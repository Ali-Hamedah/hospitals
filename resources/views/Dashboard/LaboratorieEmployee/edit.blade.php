<!-- Modal -->
<div class="modal fade" id="edit{{ $employee->id }}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Services.add_Service')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laboratorie_employee.update',  $employee->id ) }}" method="post" autocomplete="off">
                @csrf
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <label for="name">{{trans('Services.name')}}</label>
                    <input type="text" name="name" id="name" value="{{ $employee->name }}" class="form-control"><br>

                    <label for="email">{{trans('Doctors.email')}}</label>
                    <input type="email" name="email" id="email" value="{{ $employee->email }}" class="form-control" autocomplete="off"><br>

                    <label for="password">{{trans('Doctors.password')}}</label>
                    <input type="password" class="form-control" name="password"  id="password" rows="5" >
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
