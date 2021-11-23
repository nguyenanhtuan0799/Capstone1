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

   <div class="app-content">
     <div class="app-content_header">
       <div class="app-content_headding">
         <h1 class="app-content_headding-content">TIMESHEET</h1>
       </div>
       <div class="app-content_switch">
         <div class="app-content_switch-icon">
           <div class="wrapper-app_icon">
              <a class="current-date" href="../../views/manager/managerIndex.php">
               Today
             </a>
           </div>
           <div class="wrapper-app_icon">
             <!--Previous week-->
             <!--Next week-->
             <a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year; ?>">
               <i class="bx bxs-left-arrow app-content_switch-prev"></i>
             </a>
           </div>
           <div class="wrapper-app_icon">
             <a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year; ?>">
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
     <table class="table">

     </table>
   </div>
   <script>
     const tdEl = document.querySelector(".table");
     const urlApi = "http://localhost/caps1/api/manager/timsheet.php";
     //get urlApi
     function getUrlApi(callback) {
       fetch(urlApi)
         .then(res => res.json())
         .then(callback)
     };

     function render({
       data
     }) {
       // xử lý data 
      const dataFormat = data.map(({account_id,...rest})=>{
        const data = [
          account_id,
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
       const jsDateEl = document.querySelector(".js-dislay-date");
       const html = `
            <tr class="table-row">
             <td class="table-col-first">Employee</td>
              <td class='table-col' ${colElCurr ? (colElCurr.innerHTML==firstDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${firstDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==secondDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${secondDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==thirdDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${thirdDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==fourDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${fourDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==fiveDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${fiveDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==sixDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${sixDate.innerHTML}</td>
              <td class='table-col'${colElCurr ? (colElCurr.innerHTML==lastDate.innerHTML ? "style='background-color:#4ea3ff'": "" ) : ""}>${lastDate.innerHTML}</td>
            </tr>
    ${dataFormatAccountId.map((data) => {
      let firstCheckDateFormat = 0; 
       let secondCheckDateFormat = 0; 
       let thirdCheckDateFormat = 0; 
       let fourCheckDateFormat = 0; 
       let fiveCheckDateFormat = 0; 
       let sixCheckDateFormat = 0; 
       let lastCheckDateFormat = 0; 
       let firstOvertimeDateFormat; 
       let secondOvertimeDateFormat; 
       let thirdOvertimeDateFormat; 
       let fourOvertimeDateFormat; 
       let fiveOvertimeDateFormat; 
       let sixOvertimeDateFormat; 
       let lastOvertimeDateFormat; 
      let fullname ;
      let accountId = data[0];
      data.map(data => {
       fullname = data.fullname;
       switch (data.date){
         case firstDateFormat:
          if(data.status === "true"){
            if(data.hours>0){
              firstCheckDateFormat += parseInt(data.hours);
            }
          }else{
            firstCheckDateFormat = 0;
          }
          break;
         case secondDateFormat:
           if(data.status === "true"){
            if(data.hours>0){
              secondCheckDateFormat += parseInt(data.hours);
            }
          }else{
            secondCheckDateFormat = 0;
          }
          break;
         case thirdDateFormat:
           if(data.status === "true"){
            if(data.hours>0){
              thirdCheckDateFormat += parseInt(data.hours);
            }
          }else{
            thirdCheckDateFormat = 0;
          }
          break;
         case fourDateFormat:
            if(data.status === "true"){
            if(data.hours>0){
              fourCheckDateFormat += parseInt(data.hours);
            }
          }else{
            fourCheckDateFormat = 0;
          }
          break;
         case fiveDateFormat:
           if(data.status === "true"){
            if(data.hours>0){
              fiveCheckDateFormat += parseInt(data.hours);
            }
          }else{
            fiveCheckDateFormat = 0;
          }
          break;
         case sixDateFormat:
            if(data.status === "true"){
            if(data.hours>0){
              sixCheckDateFormat += parseInt(data.hours);
            }
          }else{
            sixCheckDateFormat = 0;
          }
          break;
          case lastDateFormat:
            if(data.status === "true"){
            if(data.hours>0){
              lastCheckDateFormat += parseInt(data.hours);
            }
          }else{
            lastCheckDateFormat = 0;
          }
          break;
         default:
           break;
       }
     })
data.forEach(data => {
       switch (data.date){
         case firstDateFormat:
              firstOvertimeDateFormat = {overtime : data.overtime};
          break;
         case secondDateFormat:
              secondOvertimeDateFormat = {overtime : data.overtime};
          break;
         case thirdDateFormat:
             thirdOvertimeDateFormat = {overtime : data.overtime};
          break;
         case fourDateFormat:
             fourOvertimeDateFormat = {overtime : data.overtime};
          break;
         case fiveDateFormat:
             fiveOvertimeDateFormat = {overtime : data.overtime};
          break;
         case sixDateFormat:
             sixOvertimeDateFormat = {overtime : data.overtime};
          break;
          case lastDateFormat:
              lastOvertimeDateFormat = {overtime : data.overtime};          
              break;
         default:
           break;
       }
     })
     
       return `
       <tr class="table-row ">
         <td class="table-col-first">
           <a href="../../views/manager/detail.php?id=${data[0]}" class="table-col-content">${fullname}</a>
         </td>
         <td class="table-col">
           <span class="table-col-time"> 
           ${firstCheckDateFormat || firstOvertimeDateFormat? `Total: ${firstCheckDateFormat + parseInt(firstOvertimeDateFormat.overtime)}h Overtime: ${firstOvertimeDateFormat.overtime}h` : "Total: 0h Overtime: 0h"} 
           </span>
         </td>
         <td class="table-col">
           <span class="table-col-time">
           ${secondCheckDateFormat || secondOvertimeDateFormat ? `Total: ${secondCheckDateFormat + parseInt(secondOvertimeDateFormat.overtime)}h Overtime: ${secondOvertimeDateFormat.overtime}h` : "Total: 0h Overtime: 0h"}
           </span>
         </td>
         <td class="table-col">
           <span class="table-col-time">
           ${thirdCheckDateFormat || thirdOvertimeDateFormat ? `Total: ${thirdCheckDateFormat + parseInt(thirdOvertimeDateFormat.overtime)}h Overtime: ${thirdOvertimeDateFormat.overtime}h` : "Total: 0h Overtime: 0h"}
           </span>
         </td>
         <td class="table-col">
           <span class="table-col-time">
           ${(fourCheckDateFormat || fourOvertimeDateFormat) ? `Total: ${fourCheckDateFormat + parseInt(fourOvertimeDateFormat.overtime)}h Overtime: ${fourOvertimeDateFormat.overtime}h` : "Total: 0h Overtime: 0h"}
           </span>
         </td>
         <td class="table-col">
           <span class="table-col-time">
           ${fiveCheckDateFormat || fiveOvertimeDateFormat? `Total: ${fiveCheckDateFormat + parseInt(fiveOvertimeDateFormat.overtime)}h Overtime: ${fiveOvertimeDateFormat.overtime}h` : "Total: 0h Overtime: 0h"}
           </span>
         </td>
         <td class="table-col">
           <span class="table-col-time">
           ${sixCheckDateFormat || sixOvertimeDateFormat ? `Total: ${sixCheckDateFormat + parseInt(sixOvertimeDateFormat.overtime)}h Overtime: ${sixOvertimeDateFormat.overtime}h` : "Total: 0h Overtime: 0h"}
           </span>
         </td>
         <td class="table-col">
           <span class="table-col-time">
           ${lastCheckDateFormat || lastOvertimeDateFormat ? `Total: ${lastCheckDateFormat + parseInt(lastOvertimeDateFormat.overtime)}h Overtime: ${lastOvertimeDateFormat.overtime}h` : "Total: 0h Overtime: 0h"}
           </span>
         </td>
       </tr>
       `
   }).join("")}
    `
       tdEl.innerHTML = html;
       jsDateEl.innerHTML = jsDate;
     }
     getUrlApi(render);
   </script>