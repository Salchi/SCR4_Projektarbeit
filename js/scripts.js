function submitOnConfirmation(form, confirmModal) {
    
    confirmModal.find('#confirmButton').on('click', function(){
        form.submit();
    });
    
    return false;
}


