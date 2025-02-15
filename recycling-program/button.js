function show_content(id) {
    let content = document.getElementById(id);
    let currentDisplay = window.getComputedStyle(content).display;

    content.style.display = (currentDisplay === "none") ? "block" : "none";
}

function create_form(id){
    let form = document.getElementById(id);
    let formShow = window.getComputedStyle(form).display;

    form.style.display = (formShow === "none") ? "block" : "none";
}

function delete_form(id){
    let dlt = document.getElementById(id);
    let dltShow = window.getComputedStyle(dlt).display;

    dlt.style.display = (dltShow === "none") ? "block" : "none";
}
