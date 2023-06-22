$(document).ready(function () {
  $('#form').submit(function (e) {
    // pre data from being sent before they are checked
    e.preventDefault();

    if (checkFormFields()) {
      $(this).unbind('submit').submit();
    }
  });
});

function checkFormFields() {
  // retrieve the elements in the DOM that have to be checked
  const company = $('#company').val();
  const lastname = $('#lastname').val();
  const firstname = $('#firstname').val();
  const phone = $('#phone').val();
  const email = $('#email').val();
  const reason = $('#reason').val();
  const description = $('#description').val();

  // the phone number must contain 10 digits, nothing else
  const regex = /^\d{10}$/;

  if (!regex.test(phone)) {
    const errorMsg = $('#error-msg');
    errorMsg.addClass('error');
    errorMsg.html('Le numéro de téléphone doit contenir 10 chiffres.');
    return false;
  }

  if (
    company.length === 0 ||
    lastname.length === 0 ||
    firstname.length === 0 ||
    !email.includes('@') ||
    !reason ||
    description.length === 0
  ) {
    return false;
  }

  return true;
}
