function SubmitFormData() {
    var id = '<?=$_POST['some_value']?>';
    $.post("submit.php", { name: name, email: email, phone: phone, gender: gender },
    function(data) {
	 $('#results').html(data);
	 $('#myForm')[0].reset();
    });
}