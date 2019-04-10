var constraints = { video: { facingMode: "enviroment" }, audio: false };

const cameraView = document.querySelector("#camera--view"),
      cameraOutput = document.querySelector("#camera--output"),
      cameraSensor = document.querySelector("#camera--sensor"),
      cameraTrigger = document.querySelector("#camera--trigger"),
      cameraRetake = document.querySelector("#camera--retake"),
      cameraPicture = document.querySelector("#camera--picture"),
      sendtoUs = document.querySelector("#send--to-us");
      
      

function cameraStart() {
    navigator.mediaDevices
        .getUserMedia(constraints)
        .then(function(stream) {
        track = stream.getTracks()[0];
        cameraView.srcObject = stream;
    })
    .catch(function(error) {
        console.error("Oops. Something is broken.", error);
    });
}

cameraTrigger.onclick = function() {
    cameraSensor.width = cameraView.videoWidth;
    cameraSensor.height = cameraView.videoHeight;
    cameraSensor.getContext("2d").drawImage(cameraView, 0, 0);
    cameraOutput.src = cameraSensor.toDataURL("image/webp");
    cameraPicture.value = cameraOutput.src;
    cameraView.classList.add("hide");
    cameraTrigger.classList.add("hide");
    cameraRetake.classList.remove("hide");
    cameraOutput.classList.remove("hide");
    sendtoUs.classList.remove('hide');
    
};


cameraRetake.onclick = function() {

    cameraPicture.value = null;
    cameraOutput.classList.add("hide");
    cameraRetake.classList.add("hide");
    sendtoUs.classList.add('hide');
    cameraView.classList.remove("hide");
    cameraTrigger.classList.remove("hide");

};






window.addEventListener("load", cameraStart, false);



         
         