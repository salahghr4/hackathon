// Apply an error style on the form inuts
const errorsSpans = document.querySelectorAll('.errorMsj');
errorsSpans.forEach(span => {
    if (span.innerHTML != "") {
        span.previousElementSibling.previousElementSibling.classList.add('errorStyle');
    }
})