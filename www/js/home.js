document.getElementById("submitAddFormButton").addEventListener("click", submitAddForm);
document.getElementById("submitUpdateFormButton").addEventListener("click", submitUpdateForm);

const genericErrorMessage = "Something went wrong.";

function submitAddForm() {
    // Sends AJAX POST request and call toast.
    // In happy scenario it closes the modal window and redirects.
    const name = document.getElementById('add.name').value;
    const url = '/home/add?name=' + name;
    disablePage();
    axios
        .post(url)
        .then((response) => {
            if (response.data.status === 'success') {
                toastSuccess("Brand added!", {
                    didDestroy: () => {
                        closeModal("addFormModal");
                        redirect("/");
                    }
                });
            } else {
                toastError(response.data.message ?? genericErrorMessage);
                enablePage();
            }

        })
        .catch(() => {
            toastError(genericErrorMessage);
            enablePage();
        });
}

function submitUpdateForm() {
    // Sends AJAX POST request and call toast.
    // In happy scenario it closes the modal window and redirects.
    const id = document.getElementById('update.id').value;
    const name = document.getElementById('update.name').value;
    const url = '/home/update/' + id + '/?name=' + name;
    disablePage();
    axios
        .post(url)
        .then((response) => {
            if (response.data.status === 'success') {
                toastSuccess("Brand updated!", {
                    didDestroy: () => {
                        closeModal("updateFormModal");
                        redirect("/");
                    }
                });

            } else {
                toastError(response.data.message ?? genericErrorMessage);
                enablePage();
            }

        })
        .catch(() => {
            toastError(genericErrorMessage);
            enablePage();
        });
}

function handleDelete(id) {
    // Sends AJAX POST request and call toast.
    // In happy scenario it redirects.
    const url = '/home/delete/' + id;
    disablePage();
    axios
        .post(url)
        .then((response) => {
            if (response.data.status === 'success') {
                toastSuccess("Brand deleted!", {
                    didDestroy: () => {
                        redirect("/");
                    }
                });
            } else {
                toastError(response.data.message ?? genericErrorMessage);
                enablePage();
            }
        })
        .catch(() => {
            toastError(genericErrorMessage);
            enablePage();
        });
}

function openUpdateFormModal(brand) {
    // Set form fields
    const data = JSON.parse(brand);
    document.getElementById("update.id").value = data.id;
    const updateElement = document.getElementById("update.name");
    updateElement.value = data.name;

    // Open modal
    const element = document.getElementById('updateFormModal');
    const instance = M.Modal.init(element, null, null);
    instance.open();

    // Focus on update element
    updateElement.focus();
}