 <div class="app-container-info">
     <div class="grid wide">
         <div class="row">
             <div class="col l-12">
                 <div class="wrapper-cover"></div>
             </div>
         </div>
         <div class="row">
             <div class="col l-4">
                 <div class="info-wrapper-right">
                     <div class="info-desc" style="margin: 0 32px;text-align:center;">
                         <h6 class="info-description"></h6>
                     </div>
                     <img class="info-img" src="" width="90" />
                     <span class="info-type"></span>
                 </div>
             </div>
             <div class="col l-8">
                 <div class="info-body-wrapper_ac" style="height:none"></div>
             </div>
         </div>
     </div>
 </div>

 <script>
    const idProfile = document.querySelector(".empty").dataset.index;
    const infoBody = document.querySelector(".info-body-wrapper_ac");
    const infoName = document.querySelector(".info-description");
    const infoImg = document.querySelector(".info-img");
    const infoType = document.querySelector(".info-type");
     const urlApi = "http://localhost/caps1/api/account/changepass.php";
const profileURL = "http://localhost/caps1/api/account/viewInfo.php";

 getInfo(idProfile,render)
     
    function getChangePass(formData, callback) {
        let option = {
            method: "PUT",
            header: {
            "Content-Type": "application/json",
            "Access-Control-Allow-Origin": "*",
            "Access-Control-Allow-Credentials": true,
            },
            body: JSON.stringify(formData),
        };
        fetch(urlApi, option)
            .then((response) => response)
            .then(callback);
    }
    function getInfo(idProfile, callback) {
        fetch(profileURL + `?id=${idProfile}`)
            .then((response) => response.json())
            .then(callback);
    }

    function render(data){
          infoName.innerHTML = `${data.fullname}`;
        infoImg.src = data.avatar ? data.avatar : "../../assets/img/noneUSer.png";
        infoType.innerHTML = data.role_id;
        const html = `
            <div class="row">
                <div class="col l-12">
                    <div class="info-body-wrapper">
                        <label class="info-boy_labels">Username:</label><input type="text" class="form-control" placeholder="country" value="${data.user_name}" disable/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col l-12">
                    <div class="info-body-wrapper">
                        <label class="info-boy_labels">New Password:</label><input type="password" name="password" class="form-control" style="border:1px solid var(--primary-key)" placeholder="Enter Password"disable/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col l-12">
                    <div class="info-body-wrapper">
                        <label class="info-boy_labels">Confirm Password:</label><input type="password" name="Repassword" class="form-control" style="border:1px solid var(--primary-key)" placeholder="Enter Re-Password"disable/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col l-12">
                    <div onclick="handleChange(${idProfile})" class="info-button_wrapper" style="margin-top:300px">
                        <button class="btn btn-primary profile-button" style="margin-left: 80px;width: 200px;padding:14px" type="button">
                            Change Password
                        </button>
                    </div>
                </div>
            </div>
            `;
        
    infoBody.innerHTML = html;
    }
    function handleChange(id) {
        const password = document.querySelector("input[name='password']").value;
        const Repassword = document.querySelector("input[name='Repassword']").value;
        if (password && Repassword) {

            if(password === Repassword){
                formData = {
                    account_id: id,
                    password: password,
                };
                getChangePass(formData);
                alert("Update Account Successfully");
            }
            else {
                alert("Enter Password compare Repassword");
            }
        } else{
                alert("Please enter enough information");
            
        }
    }
 </script>