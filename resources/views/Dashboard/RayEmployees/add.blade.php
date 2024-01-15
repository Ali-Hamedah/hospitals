<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">  {{ __('laboratorie_employee.Add_New_Employee') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ray_employee.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label for="name">{{trans('Services.name')}}</label>
                    <input type="text" name="name" id="name" class="form-control"><br>

                    <label for="email">{{trans('Doctors.email')}}</label>
                    <input type="email" name="email" id="email" class="form-control" autocomplete="off"><br>

                    <label for="password">{{trans('Doctors.password')}}</label>
                    <input type="password" class="form-control" name="password" id="password" rows="5" >
                </div>
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-1">
                        <label for="exampleInputEmail1">
                            {{ trans('Doctors.doctor_photo') }}</label>
                    </div>
                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                        <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                        <img style="border-radius:50%" width="150px" height="150px" id="output"/>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('sections.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('sections.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
