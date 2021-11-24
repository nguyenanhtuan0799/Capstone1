const profileURL = "http://localhost/caps1/api/account/viewInfo.php";
const editURL = "http://localhost/caps1/api/account/editInfo.php";
const idProfile = document.querySelector(".empty").dataset.index;
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

//render
function render(data) {
  const infoBody = document.querySelector(".info-body");
  const infoName = document.querySelector(".info-description");
  const infoImg = document.querySelector(".info-img");
  const infoType = document.querySelector(".info-type");
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
                <label class="info-boy_labels">Phone:</label><input type="text" class="form-control" value="${data.phone_number}" placeholder="" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col l-6">
            <div class="info-body-wrapper">
                <label class="info-boy_labels">Fullname:</label><input type="text" class="form-control" placeholder="" value="${data.fullname}" />
            </div>
        </div>
        <div class="col l-6">
            <div class="info-body-wrapper">
                <label class="info-boy_labels">Type:</label><input type="text" class="form-control" placeholder="" value="${data.role_id}" disabled />
            </div>
        </div>
        <div class="col l-12">
            <div class="info-body-wrapper">
                <label class="info-boy_labels">Email:</label><input type="text" class="form-control" placeholder="" value="${data.email}" />
            </div>
        </div>
        <div class="col l-12">
            <div class="info-body-wrapper">
                <label class="info-boy_labels">Address:</label><input type="text" class="form-control" placeholder="" value="${data.address}" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col l-12">
            <div class="info-body-wrapper">
                <label class="info-boy_labels">Headquarters:</label><input type="text" class="form-control" placeholder="" value="Office" disabled />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col l-12">
            <div class="info-button_wrapper" style="margin-top:300px">
                <button class="btn btn-primary profile-button"  type="button">
                    <a href="../../views/manager/managerEditprofile.php">Edit</a>
                </button>
            </div>
        </div>
    </div>
  `;

  infoBody.innerHTML = htmls;
}
