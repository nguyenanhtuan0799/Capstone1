     <?php
    $dt = new DateTime;
    if (isset($_GET['year']) && isset($_GET['week'])) {
      $dt->setISODate($_GET['year'], $_GET['week']);
    } else {
      $dt->setISODate($dt->format('o'), $dt->format('W'));
    }
    $year = $dt->format('o');
    $week = $dt->format('W');
    $id = $_GET['id'];
    
    ?>
    <div class="wrapper-id" style="display: none"><?=$id?></div>
  <div class="content-table">
    <div class="app-content_header">
      <div class="app-content_headding">
        <h1 class="app-content_headding-content">TIMESHEET</h1>
      </div>
      <div class="app-content_switch">
        <div class="app-content_switch-icon">
          <div class="wrapper-app_icon">
              <a class="current-date today-php" href="../../views/manager/detail.php<?="?id=". $id?>">
               Today
             </a>
             <p class="current-date today-btn hide">
               Today
             </p>
           </div>
          <div class="wrapper-app_icon">
            <a class='prev-php' href="<?php echo $_SERVER['PHP_SELF'] .'?id='. $id . '&week=' . ($week - 1) . '&year=' . $year ; ?>">
               <i class="bx bxs-left-arrow app-content_switch-prev"></i>
             </a>
             <div class="btn-prev-date hide">
               <i class="bx bxs-left-arrow app-content_switch-prev"></i>
             </div>
          </div>
          <div class="wrapper-app_icon">
           <a class='next-php' href="<?php echo $_SERVER['PHP_SELF'] .'?id='. $id . '&week=' . ($week + 1) . '&year=' . $year ; ?>">
               <i class="bx bxs-right-arrow app-content_switch-next"></i>
             </a>
             <div class="btn-next-date hide">
               <i class="bx bxs-right-arrow app-content_switch-next"></i>
             </div>
          </div>
        </div>
        <div class="app-content_switch-date js-dislay-date"></div>
      </div>
    </div>
    <div class="wrapper-empty" style="display: none">
       <?php
        do {
          if($dt->format('d/m/Y')==date("d/m/Y")){
          echo "<p class='empty-col empty-currentDate'>" . $dt->format('l') . "<br>" . $dt->format('d/m/Y') . "</p>\n";
          }else{
          echo "<p class='empty-col'>" . $dt->format('l') . "<br>" . $dt->format('d/m/Y') . "</p>\n";
          }
          $dt->modify('+1 day');
        } while ($week == $dt->format('W'));
        ?>
     </div>
    
    <div class="app-content-pagination">
      <span class="pagination-user">
       Name:  
      </span>
    </div>
     <div class="switch-style_date">
       <div class="switch-date_month">Month</div>
       <div class="switch-date_week active">Week</div>
     </div>
   <div class="table-div">
    </div>
   <table class="table">
    </table>
    
    <div class="note">
    </div>
  </div>
  <script>
     const tdEl = document.querySelector(".table");
     const accountId = document.querySelector(".wrapper-id").innerHTML;
    const urlApi = "http://localhost/caps1/api/manager/detailtimesheet.php";
    const NoteEl = document.querySelector(".note");
       const jsDateEl = document.querySelector(".js-dislay-date");


     //get urlApi
     function getUrlApi(callback) {
       fetch(urlApi+`/?id=${accountId}`)
         .then(res => res.json())
         .then(callback)
     };
      function render({
       data
     }) {
       // xử lý data 
      const dataFormat = data.map(({shift_name,...rest})=>{
        const data = [
          shift_name,
          {...rest}
        ]
        return data;
      })
      const dataFormatAccountId = [...
          dataFormat.reduce((map, [key, obj]) => 
            map.set(key, [...(map.get(key) || []), obj])
          , new Map)
          .entries()
        ]
        .map(([key, objArr]) => [key, ...objArr]);

        // date time
       const colEl = document.querySelectorAll(".empty-col");
       let colElCurr = document.querySelector(".empty-col.empty-currentDate");
       colElArr = Array.from(colEl);
       const firstDate = colElArr[0];
       const secondDate = colElArr[1];
       const thirdDate = colElArr[2];
       const fourDate = colElArr[3];
       const fiveDate = colElArr[4];
       const sixDate = colElArr[5];
       const lastDate = colElArr[6];
       const firstDateFormat = firstDate.innerHTML.slice(10, 21);
       const secondDateFormat = secondDate.innerHTML.slice(11, 22);
       const thirdDateFormat = thirdDate.innerHTML.slice(13, 24);
       const fourDateFormat = fourDate.innerHTML.slice(12, 23);
       const fiveDateFormat = fiveDate.innerHTML.slice(10, 21);
       const sixDateFormat = sixDate.innerHTML.slice(12, 23);
       const lastDateFormat = lastDate.innerHTML.slice(10, 21);
       const jsDate = `${firstDateFormat} - ${lastDateFormat}`;
       const html = `
            <tr class="table-row">
              <td class='table-col' ${colElCurr ? (colElCurr.innerHTML==firstDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${firstDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==secondDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${secondDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==thirdDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${thirdDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==fourDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${fourDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==fiveDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${fiveDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==sixDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${sixDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==lastDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${lastDate.innerHTML}</td>
            </tr>
    ${dataFormatAccountId.map((data) => {
      
      let fullname ;
      const nameEl = document.querySelector(".pagination-user");
      data.map(data => {
        fullname = data.fullname;
      })
      nameEl.innerHTML = `Name: ${fullname}`;
      let firstLate = false; 
       let secondLate = false; 
       let thirdLate = false; 
       let fourLate = false; 
       let fiveLate = false; 
       let sixLate = false; 
       let lastLate = false; 
       let firstOvertime = false; 
       let secondOvertime = false; 
       let thirdOvertime = false; 
       let fourOvertime = false; 
       let fiveOvertime = false; 
       let sixOvertime = false; 
       let lastOvertime = false; 
      let firstShiftTime ; 
       let secondShiftTime ; 
       let thirdShiftTime ; 
       let fourShiftTime ; 
       let fiveShiftTime ; 
       let sixShiftTime ; 
       let lastShiftTime ; 
      data.map(data => {
        switch (data.date){
          case firstDateFormat:
           if(data.late_arrival === "true"){
             firstLate = true;
           }
           if(data.overtime >0){
            firstOvertime = true;
           }
           if(data.status === "true"){
             firstShiftTime = data.shift_time;
           }
          break;
         case secondDateFormat:
           if(data.late_arrival === "true"){
             secondLate = true;
           }
           if(data.overtime >0){
            secondOvertime = true;
           }
           if(data.status === "true"){
             secondShiftTime = data.shift_time;
           }
          break;
         case thirdDateFormat:
            if(data.late_arrival === "true"){
             thirdLate = true;
           }
           if(data.overtime >0){
            thirdOvertime = true;
           }
           if(data.status === "true"){
             thirdShiftTime = data.shift_time;
           }
          break;
         case fourDateFormat:
            if(data.late_arrival === "true"){
             fourLate = true;
           }
           if(data.overtime >0){
            fourOvertime = true;
           }
           if(data.status === "true"){
             fourShiftTime = data.shift_time;
           }
          break;
         case fiveDateFormat:
            if(data.late_arrival === "true"){
             fiveLate = true;
           }
           if(data.overtime >0){
            fiveOvertime = true;
           }
           if(data.status === "true"){
             fiveShiftTime = data.shift_time;
           }
          break;
         case sixDateFormat:
            if(data.late_arrival === "true"){
             sixLate = true;
           }
           if(data.overtime >0){
            sixOvertime = true;
           }
           if(data.status === "true"){
             sixShiftTime = data.shift_time;
           }
          break;
          case lastDateFormat:
             if(data.late_arrival === "true"){
             lastLate = true;
           }
           if(data.overtime >0){
            lastOvertime = true;
           }
           if(data.status === "true"){
             lastShiftTime = data.shift_time;
           }
          break;
         default:
           break;
        }
      })
       return `
       <tbody>
        <tr class="table-row">
          <td class="table-col">
            <div id="${firstLate ? "late" : (firstOvertime ? "overtime" : "ontime")}" class="table-wrapper" style="${firstShiftTime ? "" : "display:none;"}">
              <span class="table-col-time">${firstShiftTime ? firstShiftTime : ""}</span>
            </div>
          </td>
          <td class="table-col">
            <div id="${secondLate ? "late" : (secondOvertime ? "overtime" : "ontime")}" class="table-wrapper" style="${secondShiftTime ? "" : "display:none;"}">
              <span class="table-col-time">${secondShiftTime ? secondShiftTime : ""}</span>
            </div>
          </td>
          <td class="table-col">
            <div id="${thirdLate ? "late" : (thirdOvertime ? "overtime" : "ontime")}" class="table-wrapper" style="${thirdShiftTime ? "" : "display:none;"}">
              <span class="table-col-time">${thirdShiftTime ? thirdShiftTime : ""}</span>
            </div>
          </td>
          <td class="table-col">
            <div id="${fourLate ? "late" : (fourOvertime ? "overtime" : "ontime")}" class="table-wrapper" style="${fourShiftTime ? "" : "display:none;"}">
              <span class="table-col-time">${fourShiftTime ? fourShiftTime : ""}</span>
            </div>
          </td>
          <td class="table-col">
            <div id="${fiveLate ? "late" : (fiveOvertime ? "overtime" : "ontime")}" class="table-wrapper" style="${fiveShiftTime ? "" : "display:none;"}">
              <span class="table-col-time">${fiveShiftTime ? fiveShiftTime : ""}</span>
            </div>
          </td>
          <td class="table-col">
            <div id="${sixLate ? "late" : (sixOvertime ? "overtime" : "ontime")}" class="table-wrapper" style="${sixShiftTime ? "" : "display:none;"}">
              <span class="table-col-time">${sixShiftTime ? sixShiftTime : ""}</span>
            </div>
          </td>
          <td class="table-col">
            <div id="${lastLate ? "late" : (lastOvertime ? "overtime" : "ontime")}" class="table-wrapper" style="${lastShiftTime ? "" : "display:none;"}">
              <span class="table-col-time">${lastShiftTime ? lastShiftTime : ""}</span>
            </div>
          </td>
        </tr>
        
      </tbody>
       `
   }).join("")}
    `
    const htmlNote = `<ul class="note-list">
    <li class="note-item note-late">
    <h5>Late To Work</h5>
    </li>
    <li class="note-item note-OnTime">
    <h5>Workontime</h5>
    </li>
    <li class="note-item note-OverTime">
    <h5>Overtime</h5>
    </li>
    </ul>`
    tdEl.innerHTML = html;
    jsDateEl.innerHTML = jsDate;
    NoteEl.innerHTML = htmlNote;
  }
     getUrlApi(render);
  </script>

<script>
  const nextPhp = document.querySelector(".next-php");
  const prevPhp = document.querySelector(".prev-php");
  const todayPhp = document.querySelector(".today-php");
  const btnNext = document.querySelector(".btn-next-date");
  const btnPre = document.querySelector(".btn-prev-date");
  const btnToday = document.querySelector(".today-btn");

  const divEl = document.querySelector(".table-div");
    const date = new Date();
 const monthCurr = date.getMonth() ;
    const yearCurr = date.getFullYear();
  function renderMonth({data}){

//  xử lý data 
      const dataFormat = data.map(({date,hours,overtime})=>{
        const data = [
          date,
          {hours,
          overtime
          }
        ]
        return data;
      })

      const dataFormatAccountId = [...
          dataFormat.reduce((map, [key, obj]) => 
            map.set(key, [...(map.get(key) || []), obj])
          , new Map)
          .entries()
        ]
        .map(([key, objArr]) => [key, ...objArr]);



    const html =`<div class="weekdays">
    <div class="day-js">Mon</div>
    <div class="day-js">Tue</div>
    <div class="day-js">Wed</div>
    <div class="day-js">Thu</div>
    <div class="day-js">Fri</div>
    <div class="day-js">Sat</div>
    <div class="day-js">Sun</div>
        </div>
        <div class="days"></div>
    `;
    divEl.innerHTML = html;
    NoteEl.innerHTML = "";

   
    const renderCalendar = () => {
      date.setDate(1)
      const monthDays = document.querySelector(".days");

      const lastDay = new Date(
        date.getFullYear(),
        date.getMonth() + 1,
        0
      ).getDate();

      const prevLastDay = new Date(
        date.getFullYear(),
        date.getMonth(),
        0
      ).getDate();

      const firstDayIndex = date.getDay()-1;

      const lastDayIndex = new Date(
        date.getFullYear(),
        date.getMonth() + 1,
        0
      ).getDay() -1;

      const nextDays = 7 - lastDayIndex -1;

      const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ];


      jsDateEl.innerHTML =`${ months[date.getMonth()]} - ${date.getFullYear()}`;

      let days = "";

      for (let x = firstDayIndex; x > 0; x--) {
        days += `<div class="prev-date js-timesheet">${prevLastDay - x + 1}</div>`;
      }

      for (let i = 1; i <= lastDay; i++) {
        let dateData = `${i <= 9 ? "0"+i : i }/${date.getMonth()+1 <=9 ? "0"+ (date.getMonth()+1) : date.getMonth()+1}/${date.getFullYear()}`;
     
        if (
          i === new Date().getDate() &&
          date.getMonth() === new Date().getMonth()
        ) {
          days += `<div class="js-timesheet">
          <div class="date-check"  style="display:none">${dateData}</div>
          <div class="current-today highlight-date">${i}</div>
          <div class="data-timesheet" id="${dateData}">Total: 0H Overtime: 0</div>
          </div>`;
        } else {
          days += `<div class="js-timesheet">
          <div class="date-check"  style="display:none">${dateData}</div>
          <div class="highlight-date">${i}</div>
          <div class="data-timesheet" id="${dateData}">Total: 0H Overtime: 0H</div>
          </div>`;
        }
      }

      for (let j = 1; j <= nextDays; j++) {
        days += `<div class="next-date js-timesheet">${j}</div>`;
        monthDays.innerHTML = days;
      }
    };
    renderCalendar();
    //check data
      dataFormatAccountId.map(data=>{
      let total;
      let overtime;
      const dateEl = document.getElementById(`${data[0]}`);
      data.shift();
      const dataCurr = data.reduce((init,curr)=>{
        return {
          hours:(parseInt(init.hours) + parseInt(curr.hours)),
          overtime:(parseInt(init.overtime) + parseInt(curr.overtime))
        }
      },{
        hours:"0",
        overtime:"0"
      })
      total = (parseInt(dataCurr.hours) + parseInt(dataCurr.overtime));
      overtime = dataCurr.overtime;
      const html = `Total: ${total}H Overtime: ${overtime}H`
      if(dateEl){
      dateEl.innerHTML = html;

      }
                      console.log(dataCurr)

    })




  }
  btnPre.addEventListener("click", () => {
    date.setMonth(date.getMonth() - 1);
      getUrlApi(renderMonth)
  });

  btnNext.addEventListener("click", () => {
    date.setMonth(date.getMonth() + 1);
      getUrlApi(renderMonth)
  });

  btnToday.addEventListener("click", () => {
    date.setMonth(monthCurr);
    date.setYear(yearCurr);
      getUrlApi(renderMonth)
  })
</script>


<script>
  const switchMonth = document.querySelector(".switch-date_month");
  const switchWeek = document.querySelector(".switch-date_week");
  


  switchMonth.onclick = () =>{
    const active = document.querySelector(".switch-date_week.active");
    if(active){
      active.classList.remove("active");
    }
    switchMonth.classList.add("active");
    nextPhp.classList.add("hide");
    prevPhp.classList.add("hide");
    todayPhp.classList.add("hide");
    btnNext.classList.remove("hide");
    btnPre.classList.remove("hide");
    btnToday.classList.remove("hide");
   
    getUrlApi(renderMonth)
    tdEl.innerHTML = "";
  }

  switchWeek.onclick = () =>{
    const active = document.querySelector(".switch-date_month.active");
    if(active){
      active.classList.remove("active");
    }
    switchWeek.classList.add("active");
     nextPhp.classList.remove("hide");
    prevPhp.classList.remove("hide");
    todayPhp.classList.remove("hide");
    btnNext.classList.add("hide");
    btnPre.classList.add("hide");
    btnToday.classList.add("hide");
     getUrlApi(render);
divEl.innerHTML = "";
  }


</script>
