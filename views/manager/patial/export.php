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
            <h1 class="app-content_headding-content">
                EXPORT TIMESHEET
            </h1>
        </div>
    </div>
    <div class="app-content_switch_export">
        <div class="export-container">
            <h4>Export To Excel</h4>
            <button type="button" onclick="exportTableToExcel('table-timesheet','timesheet')" class="button mt-top btn-export_week">Export</button>
            <button type="button" onclick="exportTableToExcel('table-div','timesheet')" class="button mt-top btn-export_month hide">Export</button>
        </div>
        <div class="app-content_switch-icon">
             <div class="wrapper-app_icon">
              <a class="current-date today-php" href="../../views/manager/managerExport.php">
               Today
             </a>
             <p class="current-date today-btn hide">
               Today
             </p>
           </div>
           <div class="wrapper-app_icon">
             <!--Previous week-->
             <!--Next week-->
             <a class='prev-php' href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year; ?>">
               <i class="bx bxs-left-arrow app-content_switch-prev"></i>
             </a>
               <div class="btn-prev-date hide">
               <i class="bx bxs-left-arrow app-content_switch-prev"></i>
             </div>
           </div>
           <div class="wrapper-app_icon">
             <a class='next-php' href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year; ?>">
               <i class="bx bxs-right-arrow app-content_switch-next"></i>
             </a>
             <div class="btn-next-date hide">
               <i class="bx bxs-right-arrow app-content_switch-next"></i>
             </div>
           </div>
            <div class="app-content_switch-date js-display-date" style="transform:translateY(8px);margin-left: 10px;">
            </div>
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
      <div class="switch-style_date">
       <div class="switch-date_month">Month</div>
       <div class="switch-date_week active">Week</div>
     </div>
    <div class="scroll-bar">
      
       <table class="table" id="table-timesheet">
       </table>
    
    </div>
    <div class="table-div" id="table-div">
    </div>
</div>

<script>
  

function exportTableToExcel(tableId, filename) {
    let dataType = 'application/vnd.ms-excel';
    let extension = '.xls';

    let base64 = function(s) {
        return window.btoa(unescape(encodeURIComponent(s)))
    };

    let template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';
    let render = function(template, content) {
        return template.replace(/{(\w+)}/g, function(m, p) { return content[p]; });
    };

    let tableElement = document.getElementById(tableId);

    let tableExcel = render(template, {
        worksheet: filename,
        table: tableElement.innerHTML
    });

    filename = filename + extension;

    if (navigator.msSaveOrOpenBlob)
    {
        let blob = new Blob(
            [ '\ufeff', tableExcel ],
            { type: dataType }
        );

        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        let downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        downloadLink.href = 'data:' + dataType + ';base64,' + base64(tableExcel);

        downloadLink.download = filename;

        downloadLink.click();
    }
}
</script>

<script>
    const tdEl = document.querySelector(".table");
       const jsDateEl = document.querySelector(".js-display-date");

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
    let dayCurr = date.getDate();
    let monthCurr = date.getMonth() ;
    let yearCurr = date.getFullYear();
    let monthCount = date.getMonth() ;
    let yearCount = date.getFullYear();
    let DateCurrent = `${dayCurr<=9?"0"+dayCurr:dayCurr}/${monthCurr+1}/${yearCurr}`
  const getDays = (month, year) => {
      let date = new Date(`${year}-${parseInt(month) + 1}-01`);
      let days = [];
      while (date.getMonth() === parseInt(month)) {
        days.push(date.getDate());
        date.setDate(date.getDate() + 1);
      }
      return days;
    };
  let arrayDateInMonth =  getDays(monthCount, yearCount);
   
  function renderMonth({data}){
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
    let days ="";
//  xử lý data 
      const dataFormat = data.map(({fullname,date,hours,overtime})=>{
        const data = [
          fullname,
          {date,
          hours,
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
      console.log(dataFormatAccountId)
      function calendar(DateMonth){
        for(let i=0; i <= DateMonth.length - 1; i++){
          const dateFormat = `${DateMonth[i] <= 9 ? "0"+DateMonth[i] : DateMonth[i]}/${(monthCount+1) <=9 ? "0"+(monthCount+1) : (monthCount+1)}/${yearCount}`
            days += `<th class=" table-date table-col" style="${dateFormat == DateCurrent? "background-color:var(--primary-key)" : ""}">${DateMonth[i] <= 9 ? "0"+DateMonth[i] : DateMonth[i]}</th>`
        }
              const employee = `<tr class="table-row"><th class="table-name table-col">Employee</th>${days}</tr>`;
              
              const html = dataFormatAccountId.map((data,i) =>{
                let count = 0;
                const fullname = data[0];
                  
                return  `
                <tr class="table-row">
                  <td class="table-name table-col"><p>${fullname}</p></td>
                  ${DateMonth.map((date)=>{
                      const dateDay = date <= 9 ? "0"+date : date;
                      const dateFull = `${dateDay}/${monthCount+1}/${yearCount}`
                    return `<td class="table-date table-col"><p id="" class="${dateFull} ${i}">Total: 0H Overtime: 0H</p> 
                    </td>`
                    }).join("")
                  }
                </tr>
                `
              }).join("");
              const render = `<table class="table-timesheet" >${employee}${html}</table>`
              divEl.innerHTML = `${render}`;
                jsDateEl.innerHTML = `${ months[monthCount]} - ${yearCount}`;
      }

      calendar(arrayDateInMonth)
        //check data  
       dataFormatAccountId.map((data,i)=>{
                data.shift()

          const dataFormat1 = data.map(({date,hours,overtime}) => {
                  const data = [
                    date,
                    {
                      hours,
                      overtime
                    }
                  ];
                  return data;
                })
              const dataFormatDate = [...
                        dataFormat1.reduce((map, [key, obj]) => 
                          map.set(key, [...(map.get(key) || []), obj])
                        , new Map)
                        .entries()
                      ]
                      .map(([key, objArr]) => [key, ...objArr]);

              //check data
                dataFormatDate.map((data)=>{
                  let total;
                  let overtime;
                  const dateEl = document.getElementsByClassName(`${data[0]} ${i}`)[0];
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
                })
       })
     

      }
      btnPre.addEventListener("click", () => {
        monthCount--;
        if (monthCount == -1) {
          monthCount = 11;
          yearCount--;
        }
        const monthDate = monthCount + 1;
        arrayDateInMonth =  getDays(monthCount, yearCount);
        getUrlApi(renderMonth)
      });
      btnNext.addEventListener("click", () => {
        monthCount++;
        if (monthCount == 12) {
          monthCount = 0;
          yearCount++;
        }
        const monthDate = monthCount + 1;
        arrayDateInMonth =  getDays(monthCount, yearCount); 
        getUrlApi(renderMonth)
      });
      btnToday.addEventListener("click", () => {
        monthCount = monthCurr;
        yearCount = yearCurr;
        const monthDate = monthCount + 1;
        arrayDateInMonth =  getDays(monthCount, yearCount);
        getUrlApi(renderMonth)
      })

      
</script>



<script>
  const switchMonth = document.querySelector(".switch-date_month");
  const switchWeek = document.querySelector(".switch-date_week");
  const exportWeek = document.querySelector(".btn-export_week");
  const exportMonth = document.querySelector(".btn-export_month");
      const divElement = document.querySelector(".scroll-bar");

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
   exportWeek.classList.add("hide");
    divElement.classList.add("hide");
   exportMonth.classList.remove("hide");
    getUrlApi(renderMonth)
    tdEl.innerHTML = "";
  }

  switchWeek.onclick = () =>{
    const active = document.querySelector(".switch-date_month.active");
    if(active){
      active.classList.remove("active");
    }
    divElement.classList.remove("hide");

    switchWeek.classList.add("active");
     nextPhp.classList.remove("hide");
    prevPhp.classList.remove("hide");
    todayPhp.classList.remove("hide");
    btnNext.classList.add("hide");
    btnPre.classList.add("hide");
    btnToday.classList.add("hide");
   exportWeek.classList.remove("hide");
   exportMonth.classList.add("hide");

     getUrlApi(render);
divEl.innerHTML = "";
  }
    getUrlApi(render);
</script>