<div class="app-timekeeping">
    <div class="grid wide">
        <div class="row app-cover">
            <div class="col l-4">
                <div class="app-tk-info">
                    <h3 class="title">TimeKeeping Information</h3>
                    <p class="sub">
                        Enter the information to conduct timekeeping in and out of the
                        system.
                    </p>
                </div>
            </div>
            <div class="col l-8">
                <div class="app-tk-content">
                    <div class="shift">
                        <div class="shift-title">
                            <label for="shift">Selected Shift </label>
                            <select name="shift" id="shift" class="shift-select">
                                <option>( Choose another shift )</option>
                                <option value="Morning Shift, 07:00 - 11h:00">
                                    Morning Shift (07:00 - 11h:00)
                                </option>
                                <option value="Afternoon Shift, 13:00 - 17:00">
                                    Afternoon Shift (13:00 - 17:00 )
                                </option>
                                <option value="Night Shift, 18:00 - 21:00">Night Shift (18:00 - 21:00)</option>
                            </select>
                        </div>
                        <p class="shift-sub">Morning Shift (07:00 - 11h:00)</p>
                    </div>
                    <div class="checkBox">
                        <p>Selected worktime</p>
                        <div class="select-work">
                            <div class="select-work-time">
                                <label for="main"> Main</label>
                                <input type="checkbox" id="main" name="main" value="main" />
                            </div>
                            <div class="select-work-time">
                                <label for="overtime"> Overtime</label>
                                <input type="checkbox" id="overtime" name="overtime" value="overtime" />
                            </div>
                        </div>
                    </div>

                    <div class="signature-content">
                        <span class="signature-content_label">Electronic signature</span>

                        <div class="signature-content_upload">
                            <input type="file" name="signature-upload" id="upload" onchange="ImagesFileAsURL()" />
                        </div>
                    </div>
                    <div id="displayImg" class="displayImg"></div>
                </div>
            </div>
        </div>
        <div class="row app-cover-m20">
            <div class="col l-4">
                <div class="app-tk_desc">
                    <p>*Obligatory</p>
                </div>
            </div>
            <div class="col l-8">
                <div class="app-tk_submit">
                    <button class="btn btn-danger profile-button mt-auto" onclick="handleCheck()" type="button">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const selectEl = document.querySelector(".shift-select");
    const subShift = document.querySelector(".shift-sub");
    subShift.innerHTML = selectEl.value;
    selectEl.onchange = () => subShift.innerHTML = selectEl.value;

    const mainEl = document.getElementById("main");
    const overtimeEl = document.getElementById("overtime");
    mainEl.onchange = () => {
        if(mainEl.checked) {
        overtimeEl.checked = false;
    }
    }
    overtimeEl.onchange = () => {
        if(overtimeEl.checked) {
        mainEl.checked = false;
    }
    }
    const account_id = document.querySelector(".empty").dataset.index;
    const urlApi = "http://localhost/caps1/api/employee/timekeeping.php";

    function createTimesheet(formData, callback) {
        let option = {
            method: "POST",
            header: {
            "Content-Type": "application/json",
            "Access-Control-Allow-Origin": "*",
            "Access-Control-Allow-Credentials": true,
            },
            body: JSON.stringify(formData),
        };
        fetch(urlApi, option)
            .then((response) => {
            response;
            })
            .then(callback)
            .catch((error) => console.log(error));
    }

    function handleCheck(){
        let isConfirm = true;
        if(isConfirm){
            handleTimekeeping();
        }else{

        }
    }

    function handleTimekeeping () {
    const date = new Date();
    //get fulldate
    const day = date.getDate();
    const month = date.getMonth();
    const year = date.getFullYear();
    const dateFull = `${day}/${month}/${year}`;
    //get full hours
    const hours = date.getHours();
    const minute = date.getMinutes();
    const startTime = `${hours}:${minute}`;
    const days = date.getDay("dateFull");
    //get main,overtime
    let hoursMain ;
    let hourOvertime;
    if(mainEl.checked) {
        hoursMain = "4";
        hourOvertime = "0";
    }else{
        hourOvertime = "3";
        hoursMain = "0";
    }
    //check late,shift
    let shiftName ;
    let shiftTime;
    let isLate;
    const valueCheck = selectEl.value.split(",")
    switch (valueCheck[0]){
        case "Morning Shift":
            shiftName = "Morning Shift";
            shiftTime = "07:00 - 11:00";
            const time1 = "07:00";
            if(startTime > time1){
                isLate = "true";
            }else{
                isLate= "false";
            }
            break;
        case"Afternoon Shift": 
            shiftName = "Afternoon Shift";
            shiftTime = "13:00 - 18:00";
            const time2 = "13:00";
            if(startTime > time2){
                isLate = "true";
            }else{
                isLate="false";
            }
            break;
        case"Night Shift": 
            shiftName = "Night Shift";
            shiftTime = "18:00 - 21:00";
            const time3 = "18:00";
            if(startTime > time3){
                isLate = "true";
            }else{
                isLate="false";
            }
            break;
        default:
            break;
    }
    const formData = {
        account_id : account_id,
        date:dateFull,
        start_time:startTime,
        hours: hoursMain,
        overtime: hourOvertime,
        dayofweek: days,
        late_arrival: isLate,
        status: "false",
        shift_name: shiftName,
        shift_time: shiftTime,
    }
    createTimesheet(formData);
    }

</script>