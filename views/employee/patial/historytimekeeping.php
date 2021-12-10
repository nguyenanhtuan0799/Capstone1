     <div class="app-content">
         <div class="app-content_header">
             <div class="app-content_headding">
                 <h1 class="app-content_headding-content">
                     HISTORY TIMEKEEPING
                 </h1>
             </div>
             
         </div>
         <div class="app-content-pagination">
             <span class="pagination-user"> Name: <?=$_SESSION['fullname']?></span>
         </div>
         <div class="scroll-bar">
             <table class="table">
             <thead>
                 <tr class="table-row">
                     <th class="table-col">STT</th>
                     <th class="table-col">Date</th>
                     <th class="table-col">Shift</th>
                     <th class="table-col">Time</th>
                     <th class="table-col">Main</th>
                     <th class="table-col">Overtime</th>
                     <th class="table-col">Late arrival</th>
                     <th class="table-col">Status</th>
                 </tr>
             </thead>
             <tbody class="tab">
                 
             </tbody>
         </table>
         </div>

     </div>
     <script src="../../assets/js/vendor/moment.js"></script>
<script>

    const tab = document.querySelector('.tab')
    const urlApi = 'http://localhost/caps1/api/employee/history.php'
    const accountID = document.querySelector('.empty').dataset.index;
    
    function viewHistory(callback) {
        fetch (urlApi+`/?id=${accountID}`)
        .then(function(res){
            return res.json();
        })
        .then (callback)
    }
    function render({data}){
        let now = new Date();
        const dataSort = data.sort((a,b)=> new Date(b.date).getTime() - new Date(a.date).getTime());
            console.log(dataSort);
        const html = dataSort.map(function(data,i){
            return `
            <tr class="table-row">
                     <td class="table-col">${i+1}</td>
                     <td class="table-col">${data.date}</td>
                     <td class="table-col">${data.shift_name}</td>
                     <td class="table-col">${data.shift_time}</td>
                     <td class="table-col">${data.hours}h</td>
                     <td class="table-col">${data.overtime}h</td>
                     <td class="table-col">
                         ${data.late_arrival==='true'? '<input type="checkbox" checked disabled />':'<input type="checkbox"  disabled />'}
                     </td>
                     <td class="table-col">${data.status==='true'? 'Approved':'Unapproved'}</td>
                 </tr>
            `
            
        }).join('');
        tab.innerHTML=html;
    }
    viewHistory(render);

</script>