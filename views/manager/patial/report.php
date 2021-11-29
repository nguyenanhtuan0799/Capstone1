    <?php
    $dt = new DateTime;
    if (isset($_GET['year']) && isset($_GET['week'])) {
      $dt->setISODate($_GET['year'], $_GET['week']);
    } else {
      $dt->setISODate($dt->format('o'), $dt->format('W'));
    }
    $year = $dt->format('o');
    $week = $dt->format('W');
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    ?>

<div class="app-content">
    <div class="empty-search" style="display: none"><?=$search?></div>
    <div class="report-wrapper">
      <div class="top-report">
        <ul class="abc">
          <li>
            <h1>Report Timesheet</h1>
          </li>
          <li>
            <button class="button button1" onclick="handelPrint()">Print</button>
          </li>
        </ul>
        <div class="search-container">
          <form action="http://localhost/caps1/views/manager/managerReport.php" method="POST">
            <!-- http://localhost/caps1/views/manager/managerReport.php -->
            <input class="form-search-input" type="text" placeholder="Search.." name="search">
            <button class="form-search-btn" type="submit">Search</button>
          </form>
        </div>
      </div>
                  <div class="wrapper-body">
                    <div class="body-report">
                    <div class="row">
                    <div class="col l-5">
                        <div class="image-profile">
                          <p>Avatar</p>
                            <img class="report-img" src="https://icon-library.com/images/avatar-icon-images/avatar-icon-images-4.jpg" alt="" width="180" height="180" style="border-radius:50%;">
                        </div>
                    </div>
                    <div class="col l-7">
                      <div class="report-info_desc">
                        <div class="row">
                                <div class="col l-12">
                                  <div class="row">
                                    <div class="report-info_ID">
                                      <div class="col l-2">
                                    <label>Fullname:</label>
                                    </div>
                                    <div class="col l-10 ">
                                    <p class="report-info_inner report-fullname"></p>
                                    </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col l-12">
                                <div class="row">
                                  <div class="report-info_ID">
                                        <div class="col l-2">
                                        <label>Email:</label>
                                        </div>
                                        <div class="col l-6 ">
                                        <p class="report-info_inner report-email"></p>
                                        </div>
                                  </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col l-12">
                                  <div class="report-info_ID">
                                    <label>Type :</label>
                                    <p class="report-info_inner report-mg report-type"></p>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col l-12">
                                  <div class="report-info_ID">
                                    <label>Phone :</label>
                                    <p class="report-info_inner report-phone"></p>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col l-12">
                                  <div class="report-info_ID">
                                    <label>Address :</label>
                                    <p class="report-info_inner report-address"></p>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col l-12">
                                  <div class="report-info_ID">
                                    <label>Headquarters :</label>
                                    <p class="report-info_inner report-headquarters"></p>
                                  </div>
                                </div>
                              </div>
                    
                            </div>
                          </div>
                        </div>
                  </div>
                  <div class="table-timesheet">
                      <div class="row">
                      <div class="col l-12">
                          <div class="content-table">
                            <div class="app-content_header">
                              <div class="app-content_switch">
                                <div class="app-content_switch-icon">
                                  <div class="wrapper-app_icon">
                                      <a class="current-date js-today" href="">
                                      Today
                                    </a>
                                  </div>
                                  <div class="wrapper-app_icon">
                                    <a class="js-prev " href="<?php echo $_SERVER['PHP_SELF']. '?week=' . ($week - 1) . '&year=' . $year . '&search=' . $search; ?>">
                                      <i class="bx bxs-left-arrow app-content_switch-prev"></i>
                                    </a>
                                  </div>
                                  <div class="wrapper-app_icon ">
                                  <a class="js-next" href="<?php echo $_SERVER['PHP_SELF']. '?week=' . ($week + 1) . '&year=' . $year . '&search=' . $search; ?>">
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
                          </div>
                          <table class="table">

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
      </div>
<script>
     const tdEl = document.querySelector(".table");
     const infoReport = document.querySelector(".report-info_desc");
     const inputSearch = document.querySelector('.empty-search');
     const inputSearchForm = document.querySelector('.form-search-input');
     const btnSearch = document.querySelector('.form-search-btn');
     const reportFullname = document.querySelector(".report-fullname");
     const reportEmail = document.querySelector(".report-email");
     const reportType = document.querySelector(".report-type");
     const reportPhone = document.querySelector(".report-phone");
     const reportAddress = document.querySelector(".report-address");
     const reportHeadquarters = document.querySelector(".report-headquarters");
     const reportImage = document.querySelector(".report-img");
     const nextDate = document.querySelector(".js-next");
     const prevDate = document.querySelector(".js-prev");
     const todayEL = document.querySelector(".js-today");
     let stringInput;
     const urlApi = "http://localhost/caps1/api/manager/report.php";
     if(inputSearch.innerHTML){
        stringInput = inputSearch.innerHTML;
       renderReport(stringInput,urlApi);
      const today = `../../views/manager/managerReport.php?search=${stringInput}`;
      todayEL.href = today;
     }
     btnSearch.onclick = (e) =>{
        stringInput = inputSearch.innerHTML ? inputSearch.innerHTML : inputSearchForm.value;
       renderReport(stringInput,urlApi);
       const next = `<?php echo $_SERVER['PHP_SELF']. '?week=' . ($week + 1) . '&year=' . $year . '&search=' . $search; ?>${stringInput}`;
       const prev = `<?php echo $_SERVER['PHP_SELF']. '?week=' . ($week - 1) . '&year=' . $year . '&search=' . $search; ?>${stringInput}`;
       nextDate.href = next; 
       prevDate.href = prev; 
       e.preventDefault();
     }
     
     

     // render timesheet report
    function renderReport(search,urlApi){
     //get urlApi
     function getUrlApi(callback) {
       fetch(urlApi+`/?fullname=${search}`)
         .then(res => res.json())
         .then(callback)
         .catch(err => alert("Please enter the correct fullname"))
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
      let accountId = data[0];
      data.map(data => {
         reportFullname.innerHTML = data.fullname;
     reportEmail.innerHTML = data.email;
     reportType.innerHTML = data.role_id == 2 ? "Employee" : "";
     reportPhone.innerHTML = data.phone_number;
     reportAddress.innerHTML = data.address;
     reportHeadquarters.innerHTML = data.headquerter;
     reportImage.src = data.avatar;
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
    }
    HTMLElement.prototype.printMe = printMe;
    function printMe(query){
      var myframe = document.createElement('IFRAME');
      myframe.domain = document.domain;
      myframe.style.position = "absolute";
      myframe.style.top = "-10000px";
      document.body.appendChild(myframe);
      myframe.contentDocument.write(this.innerHTML) ;
      setTimeout(function(){
      myframe.focus();
      myframe.contentWindow.print();
      myframe.parentNode.removeChild(myframe) ;// remove frame
      },3000); // wait for images to load inside iframe
      window.focus();
    }
    function handelPrint(){
      const printEl = document.querySelector(".wrapper-body");
      printEl.printMe();
    }
   </script>