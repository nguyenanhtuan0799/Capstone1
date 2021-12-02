    <?php
    $dt = new DateTime;
    if (isset($_GET['year']) && isset($_GET['week'])) {
      $dt->setISODate($_GET['year'], $_GET['week']);
    } else {
      $dt->setISODate($dt->format('o'), $dt->format('W'));
    }
    $year = $dt->format('o');
    $week = $dt->format('W');
    ?>
  
  <div class="content-table">
    <div class="app-content_header">
      <div class="app-content_headding">
        <h1 class="app-content_headding-content">TIMESHEET</h1>
      </div>
      <div class="app-content_switch">
        <div class="app-content_switch-icon">
          <div class="wrapper-app_icon">
              <a class="current-date" href="../../views/employee/employeeIndex.php">
               Today
             </a>
           </div>
          <div class="wrapper-app_icon">
            <a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year ; ?>">
               <i class="bx bxs-left-arrow app-content_switch-prev"></i>
             </a>
          </div>
          <div class="wrapper-app_icon">
           <a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year ; ?>">
               <i class="bx bxs-right-arrow app-content_switch-next"></i>
             </a>
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
       Name:  <?= $_SESSION['fullname']?>
       <p class="account_id"style="display:none"><?= $_SESSION['user_id']?></p>
      </span>
    </div>

    <table class="table">
      
    </table>
    <div class="note">
      <ul class="note-list">
        <li class="note-item note-late">
          <h5>Late To Work</h5>
        </li>
        <li class="note-item note-OnTime">
          <h5>Workontime</h5>
        </li>
        <li class="note-item note-OverTime">
          <h5>Overtime</h5>
        </li>
      </ul>
    </div>
  </div>
  <script>
     const tdEl = document.querySelector(".table");
     const accountId = document.querySelector(".account_id").innerHTML;
    const urlApi = "http://localhost/caps1/api/manager/detailtimesheet.php";
     //get urlApi
     function getUrlApi(callback) {
       fetch(urlApi+`/?id=${accountId}`)
         .then(res => res.json())
         .then(callback)
     };
      function render({
       data
     }) {
      console.log(data)

       // xử lý data 
      const dataFormat = data.map(({shift_name,...rest})=>{
        const data = [
          shift_name,
          {...rest}
        ]
        return data;
      })
      console.log(dataFormat)
      const dataFormatAccountId = [...
          dataFormat.reduce((map, [key, obj]) => 
            map.set(key, [...(map.get(key) || []), obj])
          , new Map)
          .entries()
        ]
        .map(([key, objArr]) => [key, ...objArr]);
      console.log(dataFormatAccountId)
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
       const jsDateEl = document.querySelector(".js-dislay-date");
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
       tdEl.innerHTML = html;
       jsDateEl.innerHTML = jsDate;
     }
     getUrlApi(render);
  </script>
