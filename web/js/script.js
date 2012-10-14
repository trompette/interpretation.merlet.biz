$(document).ready(function() {
    $('#language-select').change(function (eventObject) {
    	document.location = $(this).val();
    });
});
