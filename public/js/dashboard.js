//initialize plugins and components
$(document).ready(function () {
    $('.selectize-singular').selectize({
        //options
    });

    $('.selectize-singular-linked').selectize({
        onChange(value) {
            window.location = value;
        }
    });

    $('.selectize-multiple').selectize({
        //options
    });
});


// Add headers into Ajax Request
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// Enable Bootstraps 5 tooltips everywhere
let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})


// Initialize Simditor WYSIWYG
Simditor.locale = 'ru-RU';
let editors = document.getElementsByClassName('simditor-wysiwyg');
let textareas = [];

for (i = 0; i < editors.length; i++) {
   textareas[i] = new Simditor({
      textarea: editors[i],
      toolbarFloatOffset: '60px',
      upload: {
        //  url: '/upload/simditor_photo',   //image upload url by server
        //  params: {
        //     folder: 'news' //used in store folder path
        //  },
        //  fileKey: 'simditor_photo', //name of input
        //  connectionCount: 10,
        //  leaveConfirm: 'Пожалуйста дождитесь окончания загрузки изображений на сервер! Вы уверены что хотите закрыть страницу?'
      },
    //   defaultImage: '/img/news/simditor/default/default.png', //default image thumb while uploading
    //  cleanPaste: true, //clear all styles while copy pasting,
      imageButton: 'upload',
      toolbar: ['title', 'bold', 'italic', 'underline', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'hr', '|', 'indent', 'outdent', 'alignment'] //image removed
   });
}


//toggle Aside Visibility
let content = document.getElementById('content')
let asideToggler = document.getElementById('aside-toggler')

function toggleAside() {
    content.classList.toggle('content--max');

    if (asideToggler.innerHTML == 'chevron_left') {
        asideToggler.innerHTML = 'menu';
    } else {
        asideToggler.innerHTML = 'chevron_left';
    }
}


//toggle checkboxes
function toggleCheckboxes() {
    let tableForm = document.getElementById('table-form')
    let checkboxes = tableForm.querySelectorAll('input[type="checkbox"]');
    let all_checked = true;

    for (chb of checkboxes) {
        if (!chb.checked) {
            all_checked = false;
            break;
        }
    }

    //select all items if not all of them selected
    if (!all_checked) {
        for (chb of checkboxes) {
            chb.checked = true;
        }
    }

    // else unselect them all
    else {
        for (chb of checkboxes) {
            chb.checked = false;
        }
    }
}


// MODALS FOR DELETING ITEMS
// One modal is used for deleting any item in Table Form
function showSingleDestroyModal(id) {
    // Change the value of input and show Single Item Destroy Modal
    let modal = new bootstrap.Modal(document.getElementById('destroy-single-modal'));
    document.getElementById('destroy-single-modal-input').value = id;

    modal.show();
}

// Submit Table Form on Multiple destroy button click
function submitTableForm() {
    document.getElementById('table-form').submit();
}


// Show image from local on image input change
document.querySelectorAll('[data-action="show-image-from-local"]').forEach(input => {
    input.addEventListener("change", event => {
        var file = input.files[0];
        var imageType = /image.*/;

        if (file.type.match(imageType)) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById(input.dataset.target).src = reader.result;
            }

            reader.readAsDataURL(file);	
        } else {
            input.value = '';
            alert('Формат файла не поддерживается!');
        }
    });
});