<div>
    @if ($message === true)
        <script>
            alert(' تم ارسال تفاصيل الحجز الي المستشفي وسيتم ارسال معلومات الموعد عبر الهاتف والبريد الالكتروني')
            location.reload()
        </script>
    @endif
    @if ($messageEmpty === true)
        <script>
            alert("{{ __('Website/website.please_choose_doctor') }}")
        </script>
    @endif
    <form wire:submit.prevent="store">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <input type="text" name="username" wire:model="name" d placeholder="{{ __('Website/website.name') }}" required="">
                @error('name') <span class="error">{{ $message }}</span> @enderror
                <span class="icon fa fa-user"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <input type="email" name="email" wire:model="email" placeholder=" {{ __('Website/website.email') }}" required="">
                @error('email') <span class="error">{{ $message }}</span> @enderror
                <span class="icon fa fa-envelope"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1">{{ __('Website/website.doctors') }}</label>
                <select name="doctor" wire:model="doctor" class="form-select" id="exampleFormControlSelect1">
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1">{{ __('Website/website.sections') }}</label>
                <select class="form-select" name="section" wire:model="section" id="exampleFormControlSelect1">
                    <option>-- {{ __('Doctors.Choose') }}--</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                <input type="tel" name="phone" wire:model="phone" placeholder="{{ __('Website/website.phone') }}" required="">
                @error('phone') <span class="error">{{ $message }}</span> @enderror
                <span class="icon fas fa-phone"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1"> {{ __('Website/website.choose_the_time') }}</label>
                <select class="form-select" name="time_patient" wire:model="time_patient" required class="form-control"
                    @if ($isTimeFieldDisabled) disabled @endif>
                    @for ($i = 8; $i <= 20; $i++)
                        @for ($j = 0; $j < 60; $j += 15)
                            @php
                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                $minute = str_pad($j, 2, '0', STR_PAD_LEFT);
                                $time = "$hour:$minute";
                                $color = $this->checkIfTimeReserved($this->doctor, $this->appointment_patient, $time);
                            @endphp
                            <option value="{{ $time }}" style="color:   {{ $color }}"
                                @if ($color == 'disabled') disabled @endif> {{ $time }} </option>
                        @endfor
                    @endfor
                </select>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1"> {{ __('Website/website.appointment_date') }}</label>
                <input type="date" name="appointment_patient" wire:model="appointment_patient" required
                    class="form-control" id="appointmentDate">
                @if ($isDateReserved)
                    <small class="text-danger">{{ __('Website/website.date_reserved_date') }}</small>
                @endif
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <textarea name="notes" wire:model="notes" placeholder="{{ __('Website/website.notes') }}"></textarea>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <button class="theme-btn btn-style-two" type="submit" name="submit-form">
                    <span class="txt">{{ __('Website/website.Confirm') }}</span></button>
            </div>
        </div>
    </form>
</div>
