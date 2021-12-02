<div class="app-content">
    <div class="app-content_header">
        <div class="app-content_headding">
            <h1 class="app-content_headding-content">
                CHECK WORKING HOURS
            </h1>
        </div>
    </div>
    <div class="app-content_switch_export">
        <form class="example" action="/action_page.php">
            <input type="text" placeholder="Search.." name="search2" class="input_check">
            <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr class="table-row font-weight" >
                <th class="table-col">SID</th>
                <th class="table-col">EMPLOYEE</th>
                <th class="table-col">DATE</th>
                <th class="table-col">SHIFT</th>
                <th class="table-col">TIME</th>
                <th class="table-col">OVERTIME</th>
                <th class="table-col">LATE</th>
                <th class="table-col">STATUS</th>
                <th class="table-col">ACTION</th>
            </tr>
        </thead>
        <tbody class="table table-js">
            
        </tbody>
    </table>
</div>

<script>
    const urlApi = "http://localhost/caps1/api/manager/checking.php";
    const urlAction = "http://localhost/caps1/api/manager/approval.php";
    const tableEl = document.querySelector(".table-js");
    getUrl(render);
    function getUrl(callback){
        fetch(urlApi)
            .then(res => res.json())
            .then(callback)
    }
    function render({data}){
        const html = data.map(data =>{
            return `
                <tr class="table-row">
                    <th class="table-col">${data.account_id}</th>
                    <th class="table-col">${data.fullname}</th>
                    <th class="table-col">${data.date}</th>
                    <th class="table-col"><p class="highlight">${data.shift_name}</p></th>
                    <th class="table-col">${data.shift_time}</th>
                    <th class="table-col">${data.overtime}H</th>
                    <th class="table-col">${data.late_arrival === "true" ? "<span style='font-size:2rem'><i class='bx bx-check-square'></i></span>" : "<span style='font-size:2.4rem'><i class='bx bx-checkbox' ></i></span>"}</th>
                    <th class="table-col"><p class="highlight">${data.status === "true" ? "Confirm" : "Doing"}</p></th>
                    <th class="table-col"><button class="${data.status === "true" ? "not-button" : "button"}" onclick="${data.status === "true" ? '' : `handleConfirm(${data.ts_id})`}">${data.status === "true" ? "Approved" : "Approval"}</button></th>
                </tr>
            `
        })
        tableEl.innerHTML = html.join("");
    }
    function getUrlAction(formData,callback){
        let option = {
            method: "PUT",
            header: {
            "Content-Type": "application/json",
            "Access-Control-Allow-Origin": "*",
            "Access-Control-Allow-Credentials": true,
            },
            body: JSON.stringify(formData),
        };
        fetch(urlAction, option)
            .then((response) => response)
            .then(callback);
    }

    function handleConfirm(id){
        const status = "true";
        const formData = {
            ts_id : id,
            status : status,
        }
        getUrlAction(formData);
        alert("Approval Successfully");
       location.reload();
    }
</script>