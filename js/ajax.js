const form_ajax = document.querySelectorAll(".form-ajax");

function store_form (e) {
    e.preventDefault();

    let store=confirm("quieres enviar el formulario?? ")

    if(store){
        let data = new FormData(this);
        let method = this.getAttribute('method')
        let action = this.getAttribute('action')

        let headers = new Headers()

        let config={
            method:method,
            headers:headers,
            mode: "cors",
            cache: "no-cache",
            body: data,
        }

        fetch(action, config)
        .then(response => response.text())
        .then(response => {
            let container = document.querySelector('.form-rest');
            container.innerHTML = response;
        })
    }
}

form_ajax.forEach(form => {
    form.addEventListener('submit', store_form)
})