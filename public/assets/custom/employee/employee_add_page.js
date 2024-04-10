const datePickers = ['flatpickrDate1', 'flatpickrDate2', 'birthday'];
datePickers.forEach(function (pickerId) {
    const pickerElement = document.querySelector('#' + pickerId);
    if (pickerElement) {
        pickerElement.flatpickr({
            monthSelectorType: 'static'
        });
    }
});


const previewTemplate = `<div class="dz-preview dz-file-preview">
<div class="dz-details">
  <div class="dz-thumbnail">
    <img data-dz-thumbnail>
    <span class="dz-nopreview">No preview</span>
    <div class="dz-success-mark"></div>
    <div class="dz-error-mark"></div>
    <div class="dz-error-message"><span data-dz-errormessage></span></div>
    <div class="progress">
      <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
    </div>
  </div>
  <div class="dz-filename" data-dz-name></div>
  <div class="dz-size" data-dz-size></div>
</div>
</div>`;

const myDropzone = new Dropzone('#pic-employee', {
    previewTemplate: previewTemplate,
    parallelUploads: 1,
    maxFilesize: 5,
    addRemoveLinks: true,
    maxFiles: 1,
    acceptedFiles: 'image/*'
});

myDropzone.on("success", function (file, response) {
    console.log(response, file['dataURL']);
    document.getElementById('baseimg').value = file['dataURL'];
});
myDropzone.on("removedfile", function (file) {
    document.getElementById('baseimg').value = '';
});


