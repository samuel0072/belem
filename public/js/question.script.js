var form = document.forms.namedItem("create-question");
form.addEventListener("submit", (event) => {
    event.preventDefault();
    var input = document.getElementById("correct-answer");
    var val = input.value.toUpperCase().charCodeAt(0);
    input.value = val - 64;
    form.submit();
});
