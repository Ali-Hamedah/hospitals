<!-- Deleted insurance -->
<div class="modal fade" id="approval{{ $appointment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('laboratorie_employee.Confirmation_Patient_Appointment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('appointments.approval', $appointment->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{ $appointment->id }}">
                    <p class="mg-b-20">{{ $appointment->name }}</p>
                    <!--div-->
                    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- تاريخ الموعد -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label
                                            for="appointmentDate{{ $appointment->id }}">{{ __('Website/website.appointment_date') }}</label>
                                        <input
                                            value="{{ old('appointment_patient', $appointment->appointment_patient) }}"
                                            type="date" name="appointment_patient" required class="form-control"
                                            id="appointmentDate{{ $appointment->id }}">
                                    </div>


                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label for="time_patient{{ $appointment->id }}" class="form-label">
                                            <i class="far fa-clock"></i>
                                            {{ __('Website/website.choose_the_time') }}
                                        </label>
                                        <div class="input-group">
                                            <select class="form-select rounded-pill shadow-sm" name="time_patient"
                                                required id="time_patient{{ $appointment->id }}">
                                                @for ($i = 8; $i <= 20; $i++)
                                                    @for ($j = 0; $j < 60; $j += 30)
                                                        @php
                                                            $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                            $minute = str_pad($j, 2, '0', STR_PAD_LEFT);
                                                            $time = "$hour:$minute";
                                                            $appointmentTime = substr($appointment->time_patient, 0, 5); // قطع الثواني
                                                            $isSelected =
                                                                old('time_patient', $appointmentTime) == $time
                                                                    ? 'selected'
                                                                    : ''; // للتحقق من القيمة المحددة
                                                            $optionColor = $isSelected
                                                                ? 'style="color: rgb(23, 144, 13)"'
                                                                : ''; // لون أخضر للقيمة الافتراضية
                                                        @endphp
                                                        <option value="{{ $time }}" {{ $isSelected }}
                                                            {!! $optionColor !!}>
                                                            {{ $time }}
                                                        </option>
                                                    @endfor
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('insurance.close') }}</button>
                                    <button class="btn btn-success">{{ trans('insurance.save') }}</button>
                                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function updateTimeOptions(appointmentId) {
        let selectedDate = document.getElementById('appointmentDate' + appointmentId).value;
        let timeSelect = document.getElementById('time_patient' + appointmentId);

        // جلب المواعيد المحجوزة عبر AJAX
        fetch(`/get-appointments/${selectedDate}`)
            .then(response => response.json())
            .then(data => {
                let options = timeSelect.options;

                // إزالة الثواني من الأوقات المسترجعة
                let bookedTimes = data.map(time => time.substring(0, 5)); // إزالة الثواني

                for (let i = 0; i < options.length; i++) {
                    let option = options[i];
                    let timeValue = option.value;

                    // تحقق إذا كان الوقت محجوزًا
                    if (bookedTimes.includes(timeValue)) {
                        option.style.color = 'red';
                         option.textContent = defaultValue + ' (محجوز)'; // لون أحمر للمواعيد المحجوزة
                    } else {
                        option.style.color = ''; // اللون الافتراضي
                    }
                }
            });
    }

    // تشغيل التحقق عند تغيير التاريخ
    document.querySelectorAll('[id^=appointmentDate]').forEach(element => {
        element.addEventListener('change', function() {
            let appointmentId = this.id.replace('appointmentDate', '');
            updateTimeOptions(appointmentId);
        });
    });

    // تشغيل التحقق عند تحميل الصفحة (عند وجود قيمة افتراضية)
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[id^=appointmentDate]').forEach(element => {
            let appointmentId = element.id.replace('appointmentDate', '');
            updateTimeOptions(appointmentId);
        });
    });
</script>
