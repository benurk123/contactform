const contacts = document.getElementById('contacts');

if (contacts) {
  contacts.addEventListener('click', e => {
    if (e.target.className === 'fas fa-trash-alt delete-contact') {
      if (confirm('Weet u zeker dat u deze contactpersoon wilt verwijderen?')) {
        const id = e.target.getAttribute('data-id');

        fetch(`/contact/delete/${id}`, {
          method: 'DELETE'
        }).then(res => window.location.reload());
      }
    }
  });
}
