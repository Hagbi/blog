$('.delete-post-btn').on('click', function () {

  if (confirm('Are you sure?')) {

    return true;

  } else {

    return false;

  }

});
$('#image').on('change', function () {

  $(this).next().text($(this).val());

});

$('.edit-profile-btn').on('click', function () {

  if (confirm('Are you sure?')) {

    return true;

  } else {

    return false;

  }

});