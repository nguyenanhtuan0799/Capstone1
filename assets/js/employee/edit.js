const profileURL = "http://localhost/caps1/api/account/viewInfo.php";
const editURL = "http://localhost/caps1/api/account/editInfo.php";
const idProfile = document.querySelector(".empty").dataset.index;
const infoBody = document.querySelector(".info-body");
const infoName = document.querySelector(".info-description");
const infoImg = document.querySelector(".info-img");
const infoType = document.querySelector(".info-type");
const btnUploadImg = document.querySelector(".js-btn-img");
const CLOUDINARY_NAME = "https://api.cloudinary.com/v1_1/nguyenanhtuan/upload";
const CLOUDINARY_PRESET = "zjra8sp2";
let UrlImg;

btnUploadImg.onchange = (e) => {
  const file = e.target.files[0];
  var formData = new FormData();
  formData.append("file", file);
  formData.append("upload_preset", CLOUDINARY_PRESET);

  axios({
    url: CLOUDINARY_NAME,
    method: "POST",
    header: {
      "content-type": "application/x-www-form-urlencoded",
    },
    data: formData,
  })
    .then((res) => {
      infoImg.src = res.data.secure_url;
    })
    .then((err) => console.log(err));
};

function start() {
  getInfo(idProfile, render);
}

start();
//view info
function getInfo(idProfile, callback) {
  fetch(profileURL + `?id=${idProfile}`)
    .then((response) => response.json())
    .then(callback);
}
function render(data) {
  infoName.innerHTML = `Infomation ${data.fullname}`;
  infoImg.src = data.avatar ? data.avatar : "../../assets/img/noneUSer.png";
  infoType.innerHTML = data.role_id;
  const htmls = `
                    <div class="row">
                         <div class="col l-6">
                             <div class="info-body-wrapper">
                                 <label class="info-boy_labels">Username:</label><input type="text" class="form-control" value="${data.user_name}" placeholder="Doe" disabled />
                             </div>
                         </div>
                         <div class="col l-6">
                             <div class="info-body-wrapper">
                                 <label class="info-boy_labels">Phone:</label><input type="text" class="form-control" name="phone" value="${data.phone_number}" placeholder="Phone" />
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col l-6">
                             <div class="info-body-wrapper">
                                 <label class="info-boy_labels">Fullname:</label><input type="text" class="form-control" name="fullname" placeholder="Fullname" value="${data.fullname}" />
                             </div>
                         </div>
                         <div class="col l-6">
                             <div class="info-body-wrapper">
                                 <label class="info-boy_labels">Type:</label><input type="text" class="form-control" placeholder="headline" value="${data.role_id}" disabled />
                             </div>
                         </div>
                         <div class="col l-12">
                             <div class="info-body-wrapper">
                                 <label class="info-boy_labels">Email:</label><input type="text" class="form-control" name="email" placeholder="Email" value="${data.email}" />
                             </div>
                         </div>
                         <div class="col l-12">
                             <div class="info-body-wrapper">
                                 <label class="info-boy_labels">Address:</label><input type="text" class="form-control" name="address" placeholder="Address" value="${data.address}" />
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col l-12">
                             <div class="info-body-wrapper">
                                 <label class="info-boy_labels">Headquarters:</label><input type="text" class="form-control" placeholder="country" value="Office" disabled />
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col l-12">
                             <div class="info-body-wrapper_signal">
                                 <span class="info-boy_labels">Electronic signature</span>
                                 <div class="info-body-upload">
                                     <input type="file" name="upload" id="upload" onchange="ImagesFileAsURL()" />
                                 </div>
                             </div>
                             <div class="info-body-wrapper_img">
                                 <div id="displayImg" class="displayImg">
                                     <img src="../../assets/img/noneImg.png" alt="" />
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col l-6">
                             <div onclick="handleEdit(${idProfile})" class="info-button_wrapper" >
                                 <button class="btn btn-primary profile-button" style="margin-left: 120px" type="button">
                                     Save Profile
                                 </button>
                             </div>
                         </div>
                         <div class="col l-6">
                             <div class="info-button_wrapper" >
                                 <button class="btn btn-danger profile-button" type="button">
                                     <a href="../../views/employee/employeeProfile.php" style="text-decoration: none;
    color: #fff">Cancel</a>
                                 </button>
                             </div>
                         </div>
                     </div>
  `;

  infoBody.innerHTML = htmls;
}

/// edit

function getEditInfo(formData, callback) {
  let option = {
    method: "PUT",
    header: {
      "Content-Type": "application/json",
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Credentials": true,
    },
    body: JSON.stringify(formData),
  };
  fetch(editURL, option)
    .then((response) => response)
    .then(callback);
}

function handleEdit(id) {
  const phone = document.querySelector("input[name='phone']").value;
  const fullname = document.querySelector("input[name='fullname']").value;
  const email = document.querySelector("input[name='email']").value;
  const address = document.querySelector("input[name='address']").value;
  UrlImg = infoImg.src;
  const headquerter = "Office";
  formData = {
    account_id: id,
    phone_number: phone,
    email: email,
    address: address,
    fullname: fullname,
    headquerter: headquerter,
    avatar: UrlImg,
  };
  if (phone && fullname && email && address) {
    getEditInfo(formData);

    alert("Update Account Successfully");
  } else {
    alert("Please enter enough information");
  }
}
