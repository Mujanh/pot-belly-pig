jQuery(function() {

    //Show alert when user tries to mark own answer as accepted
    $( ".notaccepted-owner" ).click(function() {
        alert( "Du kan inte markera ditt eget svar som accepterat" );
    });

    //Show alert when user tries to vote on his/her own entry
    $( ".vote-owner" ).click(function() {
        alert( "Du kan inte rösta på ditt eget inlägg" );
    });

    //Show alert when user tries to vote more than once on the same entry
    $( ".voted" ).click(function() {
        alert( "Du kan bara rösta en gång på samma inlägg" );
    });

})
