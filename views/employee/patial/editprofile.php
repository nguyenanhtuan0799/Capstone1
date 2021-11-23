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
                     <div class="info-desc">
                         <h6 class="info-description"></h6>
                     </div>
                     <img class="info-img" src="/noneUSer.png" width="90" />
                     <div class="info-button_avatar">
                         <button class="btn btn-danger profile-button" type="button">
                             Upload
                         </button>
                     </div>
                     <span class="info-type"></span>
                 </div>
             </div>
             <div class="col l-8">
                 <div class="info-body">
                 </div>
             </div>
         </div>
     </div>
 </div>
 <script src="../../assets/js/employee/edit.js"></script>
 <script type="text/javascript">
     function ImagesFileAsURL() {
         var fileSelected = document.getElementById("upload").files;
         if (fileSelected.length > 0) {
             var fileToLoad = fileSelected[0];
             var fileReader = new FileReader();
             fileReader.onload = function(fileLoaderEvent) {
                 var srcData = fileLoaderEvent.target.result;
                 var newImage = document.createElement("img");
                 newImage.src = srcData;
                 document.getElementById("displayImg").innerHTML =
                     newImage.outerHTML;
             };
             fileReader.readAsDataURL(fileToLoad);
         }
     }
 </script>